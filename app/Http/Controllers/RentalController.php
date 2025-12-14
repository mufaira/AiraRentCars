<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class RentalController extends Controller
{
    /**
     * Show rental form for a specific car
     */
    public function create(Car $car)
    {
        // Prevent admin from renting cars
        if (\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->is_admin) {
            return redirect()->route('cars.catalog')->with('error', 'Admin tidak dapat merental mobil');
        }

        if (!$car->is_active || $car->status !== 'Tersedia') {
            return redirect()->route('cars.catalog')->with('error', 'Mobil tidak tersedia untuk disewa');
        }

        return view('rentals.create', compact('car'));
    }

    /**
     * Store rental request
     */
    public function store(Request $request, Car $car)
    {
        $validated = $request->validate([
            'rental_date' => 'required|date|after_or_equal:today',
            'duration_days' => 'required|integer|min:1|max:90',
            'notes' => 'nullable|string|max:500',
        ]);

        $rentalDate = Carbon::parse($validated['rental_date']);
        $durationDays = (int)$validated['duration_days'];
        $returnDate = $rentalDate->addDays($durationDays);
        $totalPrice = $car->price_per_day * $durationDays;

        $rental = Rental::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'car_id' => $car->id,
            'rental_date' => $rentalDate,
            'duration_days' => $validated['duration_days'],
            'return_date' => $returnDate,
            'total_price' => $totalPrice,
            'status' => 'Pending',
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('rentals.payment', $rental)->with('success', 'Rental berhasil dibuat, silakan lakukan pembayaran');
    }

    /**
     * Show payment form
     */
    public function payment(Rental $rental)
    {
        if ($rental->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        $rental->load('car', 'payment');

        return view('rentals.payment', compact('rental'));
    }

    /**
     * Store payment
     */
    public function storePayment(Request $request, Rental $rental)
    {
        if ($rental->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Delete old payment if exists
        if ($rental->payment) {
            Storage::disk('public')->delete($rental->payment->payment_proof_path);
            $rental->payment->delete();
        }

        $path = $request->file('payment_proof')->store('payments', 'public');

        Payment::create([
            'rental_id' => $rental->id,
            'amount' => $rental->total_price,
            'payment_proof_path' => $path,
            'status' => 'Pending',
        ]);

        $rental->update(['status' => 'Paid']);

        return redirect()->route('rentals.show', $rental)->with('success', 'Pembayaran berhasil dikirim, tunggu verifikasi admin');
    }

    /**
     * Show rental detail
     */
    public function show(Rental $rental)
    {
        if ($rental->user_id !== \Illuminate\Support\Facades\Auth::id() && !(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->is_admin)) {
            abort(403);
        }

        $rental->load('car', 'user', 'payment');

        return view('rentals.show', compact('rental'));
    }

    /**
     * List user rentals
     */
    public function index()
    {
        $rentals = Rental::where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->with('car', 'payment')
            ->latest()
            ->paginate(10);

        return view('rentals.index', compact('rentals'));
    }

    /**
     * Admin: List all rentals
     */
    public function adminIndex()
    {
        $rentals = Rental::with('user', 'car', 'payment')
            ->latest()
            ->paginate(15);

        return view('admin.rentals.index', compact('rentals'));
    }

    /**
     * Admin: Verify payment
     */
    public function verifyPayment(Request $request, Rental $rental)
    {
        $validated = $request->validate([
            'action' => 'required|in:approve,reject',
            'admin_notes' => 'nullable|string|max:500',
        ]);

        $payment = $rental->payment;

        if (!$payment) {
            return redirect()->back()->with('error', 'Pembayaran tidak ditemukan');
        }

        if ($validated['action'] === 'approve') {
            $payment->update([
                'status' => 'Verified',
                'verified_at' => now(),
                'admin_notes' => $validated['admin_notes'] ?? null,
            ]);
            $rental->update(['status' => 'Active']);
            // Update car status to "Disewa" (not available)
            $rental->car->update(['status' => 'Disewa']);

            return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi');
        } else {
            $payment->update([
                'status' => 'Rejected',
                'admin_notes' => $validated['admin_notes'],
            ]);
            $rental->update(['status' => 'Pending']);

            return redirect()->back()->with('error', 'Pembayaran ditolak');
        }
    }

    /**
     * API: Get payment details for verification
     */
    public function getPaymentDetails(Rental $rental)
    {
        $rental->load('user', 'car', 'payment');

        if (!$rental->payment) {
            return response()->json(['error' => 'Payment not found'], 404);
        }

        return response()->json([
            'rental' => $rental,
            'payment' => $rental->payment,
        ]);
    }

    /**
     * Admin: Complete rental and make car available again
     */
    public function completeRental(Rental $rental)
    {
        // Check if authorized
        if (!(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->is_admin)) {
            abort(403);
        }

        // Update rental status
        $rental->update(['status' => 'Completed']);
        
        // Update car status back to "Tersedia"
        $rental->car->update(['status' => 'Tersedia']);

        return redirect()->back()->with('success', 'Rental selesai, mobil kembali tersedia untuk disewa');
    }
}
