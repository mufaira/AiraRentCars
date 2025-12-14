<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\RefundRequest;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    /**
     * User: Cancel rental (for pending/unpaid rentals)
     */
    public function cancel(Rental $rental)
    {
        // Check if user owns this rental
        if ($rental->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        // Only allow cancel for Pending status (not paid yet)
        if ($rental->status !== 'Pending') {
            return redirect()->route('rentals.show', $rental)->with('error', 'Hanya rental yang belum dibayar yang bisa dibatalkan');
        }

        // Cancel the rental
        $rental->update(['status' => 'Cancelled']);

        return redirect()->route('rentals.show', $rental)->with('success', 'Rental berhasil dibatalkan');
    }

    /**
     * Show refund request form (for paid/active rentals)
     */
    public function create(Rental $rental)
    {
        // Check if user owns this rental
        if ($rental->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        // Check if rental status allows refund (only Paid or Active)
        if (!in_array($rental->status, ['Paid', 'Active'])) {
            return redirect()->route('rentals.show', $rental)->with('error', 'Hanya rental yang sudah dibayar yang bisa di-refund');
        }

        // Check if refund request already exists
        if ($rental->refundRequest) {
            return redirect()->route('rentals.show', $rental)->with('error', 'Permintaan refund sudah ada');
        }

        return view('refunds.create', compact('rental'));
    }

    /**
     * Store refund request
     */
    public function store(Request $request, Rental $rental)
    {
        // Check if user owns this rental
        if ($rental->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'reason' => 'required|in:change_plan,time_issue,car_issue,other',
            'custom_reason' => 'required_if:reason,other|nullable|string|max:500',
        ]);

        // Create refund request
        RefundRequest::create([
            'rental_id' => $rental->id,
            'reason' => $validated['reason'],
            'custom_reason' => $validated['custom_reason'] ?? null,
            'status' => 'Pending',
            'refund_amount' => $rental->total_price,
        ]);

        return redirect()->route('rentals.show', $rental)->with('success', 'Permintaan refund berhasil dibuat, menunggu konfirmasi admin');
    }

    /**
     * Admin: List all refund requests
     */
    public function adminIndex()
    {
        $refunds = RefundRequest::with('rental.user', 'rental.car')
            ->latest()
            ->paginate(15);

        return view('admin.refunds.index', compact('refunds'));
    }

    /**
     * Admin: Show refund detail
     */
    public function adminShow(RefundRequest $refund)
    {
        $refund->load('rental.user', 'rental.car', 'rental.payment');
        return view('admin.refunds.show', compact('refund'));
    }

    /**
     * Admin: Process refund (approve/reject)
     */
    public function process(Request $request, RefundRequest $refund)
    {
        // Check authorization
        if (!(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->is_admin)) {
            abort(403);
        }

        $validated = $request->validate([
            'action' => 'required|in:approve,reject',
            'admin_notes' => 'nullable|string|max:500',
        ]);

        if ($validated['action'] === 'approve') {
            $refund->update([
                'status' => 'Approved',
                'admin_notes' => $validated['admin_notes'] ?? null,
                'processed_at' => now(),
            ]);

            // Update rental status to cancelled
            $refund->rental->update(['status' => 'Cancelled']);

            // Make car available again (change status from Disewa back to Tersedia)
            $refund->rental->car->update(['status' => 'Tersedia']);

            return redirect()->back()->with('success', 'Refund disetujui, mobil kembali tersedia');
        } else {
            $refund->update([
                'status' => 'Rejected',
                'admin_notes' => $validated['admin_notes'],
                'processed_at' => now(),
            ]);

            return redirect()->back()->with('error', 'Refund ditolak');
        }
    }
}
