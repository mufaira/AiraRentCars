<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use App\Models\RefundRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * User personal dashboard dengan grafik data mereka sendiri
     */
    public function userDashboard()
    {
        $user = Auth::user();
        
        // User's Rental Statistics
        $totalRentals = Rental::where('user_id', $user->id)->count();
        $activeRentals = Rental::where('user_id', $user->id)->where('status', 'Aktif')->count();
        $completedRentals = Rental::where('user_id', $user->id)->where('status', 'Selesai')->count();
        $cancelledRentals = Rental::where('user_id', $user->id)->where('status', 'Dibatalkan')->count();
        
        // User's Refund Statistics
        $totalRefunds = RefundRequest::whereHas('rental', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();
        
        $approvedRefunds = RefundRequest::whereHas('rental', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('status', 'Disetujui')->count();
        
        $pendingRefunds = RefundRequest::whereHas('rental', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('status', 'Pending')->count();
        
        // Total spent
        $totalSpent = Rental::where('user_id', $user->id)
            ->where('status', 'Selesai')
            ->sum('total_price');
        
        // Rental Trends (last 7 days) - User only
        $rentalTrends = Rental::select(
            DB::raw("strftime('%Y-%m-%d', rental_date) as date"),
            DB::raw('COUNT(*) as count')
        )
        ->where('user_id', $user->id)
        ->where('rental_date', '>=', now()->subDays(7))
        ->whereNotNull('rental_date')
        ->groupByRaw("strftime('%Y-%m-%d', rental_date)")
        ->orderByRaw("strftime('%Y-%m-%d', rental_date)")
        ->get();
        
        $trendDates = $rentalTrends->pluck('date')->toArray();
        $trendCounts = $rentalTrends->pluck('count')->toArray();
        
        // Rental Status breakdown - User only
        $rentalStatus = Rental::where('user_id', $user->id)
            ->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();
        
        $statusLabels = $rentalStatus->pluck('status')->toArray();
        $statusCounts = $rentalStatus->pluck('count')->toArray();
        
        // Monthly spending - User only
        $monthlySpending = Rental::select(
            DB::raw("strftime('%m', rental_date) as month"),
            DB::raw("strftime('%Y', rental_date) as year"),
            DB::raw('SUM(total_price) as spending')
        )
        ->where('user_id', $user->id)
        ->where('status', 'Selesai')
        ->whereNotNull('rental_date')
        ->groupByRaw("strftime('%Y', rental_date), strftime('%m', rental_date)")
        ->orderByRaw("strftime('%Y', rental_date) desc, strftime('%m', rental_date) desc")
        ->limit(12)
        ->get();
        
        $monthlyLabels = $monthlySpending->map(function($item) {
            return \Carbon\Carbon::createFromDate($item->year, $item->month, 1)->format('M Y');
        })->reverse()->toArray();
        
        $monthlyValues = $monthlySpending->pluck('spending')->reverse()->toArray();
        
        return view('dashboard.user-dashboard', compact(
            'totalRentals', 'activeRentals', 'completedRentals', 'cancelledRentals',
            'totalRefunds', 'approvedRefunds', 'pendingRefunds',
            'totalSpent',
            'trendDates', 'trendCounts',
            'statusLabels', 'statusCounts',
            'monthlyLabels', 'monthlyValues'
        ));
    }

    /**
     * Admin-only dashboard dengan data sensitif
     */
    public function index()
    {
        // Total Statistics
        $totalCars = Car::count();
        $availableCars = Car::where('status', 'Tersedia')->count();
        $rentedCars = Car::where('status', 'Disewa')->count();
        
        $totalRentals = Rental::count();
        $activeRentals = Rental::where('status', 'Aktif')->count();
        $completedRentals = Rental::where('status', 'Selesai')->count();
        
        $totalRefunds = RefundRequest::count();
        $approvedRefunds = RefundRequest::where('status', 'Disetujui')->count();
        $pendingRefunds = RefundRequest::where('status', 'Pending')->count();
        
        // Rental Trends (last 7 days) - SQLite compatible
        $rentalTrends = Rental::select(
            DB::raw("strftime('%Y-%m-%d', rental_date) as date"),
            DB::raw('COUNT(*) as count')
        )
        ->where('rental_date', '>=', now()->subDays(7))
        ->whereNotNull('rental_date')
        ->groupByRaw("strftime('%Y-%m-%d', rental_date)")
        ->orderByRaw("strftime('%Y-%m-%d', rental_date)")
        ->get();
        
        $trendDates = $rentalTrends->pluck('date')->toArray();
        $trendCounts = $rentalTrends->pluck('count')->toArray();
        
        // Occupancy Rate by Car
        $occupancyData = Car::where('is_active', true)
            ->select('cars.id', 'cars.name')
            ->withCount(['rentals as active_rentals' => function($query) {
                $query->where('status', 'Aktif');
            }])
            ->orderByDesc('active_rentals')
            ->limit(10)
            ->get();
        
        $occupancyNames = $occupancyData->pluck('name')->toArray();
        $occupancyCounts = $occupancyData->pluck('active_rentals')->toArray();
        
        // Cancellation Rate
        $totalCancellations = RefundRequest::count();
        $cancellationRate = $totalRentals > 0 ? round(($totalCancellations / $totalRentals) * 100, 2) : 0;
        
        // Monthly Revenue (SQLite compatible)
        $monthlyRevenue = Rental::select(
            DB::raw("strftime('%m', rental_date) as month"),
            DB::raw("strftime('%Y', rental_date) as year"),
            DB::raw('SUM(total_price) as revenue')
        )
        ->where('status', 'Selesai')
        ->whereNotNull('rental_date')
        ->groupByRaw("strftime('%Y', rental_date), strftime('%m', rental_date)")
        ->orderByRaw("strftime('%Y', rental_date) desc, strftime('%m', rental_date) desc")
        ->limit(12)
        ->get();
        
        $monthlyLabels = $monthlyRevenue->map(function($item) {
            return \Carbon\Carbon::createFromDate($item->year, $item->month, 1)->format('M Y');
        })->reverse()->toArray();
        
        $monthlyValues = $monthlyRevenue->pluck('revenue')->reverse()->toArray();
        
        // Status breakdown
        $rentalStatus = Rental::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();
        
        $statusLabels = $rentalStatus->pluck('status')->toArray();
        $statusCounts = $rentalStatus->pluck('count')->toArray();
        
        return view('dashboard.infografis', compact(
            'totalCars', 'availableCars', 'rentedCars',
            'totalRentals', 'activeRentals', 'completedRentals',
            'totalRefunds', 'approvedRefunds', 'pendingRefunds',
            'cancellationRate',
            'trendDates', 'trendCounts',
            'occupancyNames', 'occupancyCounts',
            'monthlyLabels', 'monthlyValues',
            'statusLabels', 'statusCounts'
        ));
    }
}
