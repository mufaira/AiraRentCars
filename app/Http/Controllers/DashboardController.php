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
            DB::raw("rental_date as date"),
            DB::raw('COUNT(*) as count')
        )
        ->where('rental_date', '>=', now()->subDays(7)->format('Y-m-d'))
        ->whereNotNull('rental_date')
        ->groupByRaw("rental_date")
        ->orderByRaw("rental_date")
        ->get();
        
        $trendDates = $rentalTrends->isNotEmpty() ? $rentalTrends->pluck('date')->toArray() : [];
        $trendCounts = $rentalTrends->isNotEmpty() ? $rentalTrends->pluck('count')->toArray() : [];
        
        // Ensure we have at least empty arrays
        if (empty($trendDates)) {
            $trendDates = [];
            $trendCounts = [];
        }
        
        // Occupancy Rate by Car
        $occupancyData = Car::where('is_active', true)
            ->select('cars.id', 'cars.name')
            ->withCount(['rentals as active_rentals' => function($query) {
                $query->where('status', 'Aktif');
            }])
            ->orderByDesc('active_rentals')
            ->limit(10)
            ->get();
        
        $occupancyNames = $occupancyData->isNotEmpty() ? $occupancyData->pluck('name')->toArray() : [];
        $occupancyCounts = $occupancyData->isNotEmpty() ? $occupancyData->pluck('active_rentals')->toArray() : [];
        
        // Cancellation Rate
        $totalCancellations = RefundRequest::count();
        $cancellationRate = $totalRentals > 0 ? round(($totalCancellations / $totalRentals) * 100, 2) : 0;
        
        // Monthly Revenue (SQLite compatible)
        $monthlyRevenue = Rental::select(
            DB::raw("substr(rental_date, 1, 7) as month_year"),
            DB::raw('SUM(total_price) as revenue')
        )
        ->where('status', 'Selesai')
        ->whereNotNull('rental_date')
        ->groupByRaw("substr(rental_date, 1, 7)")
        ->orderByRaw("substr(rental_date, 1, 7) desc")
        ->limit(12)
        ->get();
        
        if ($monthlyRevenue->isNotEmpty()) {
            $monthlyLabels = $monthlyRevenue->map(function($item) {
                return \Carbon\Carbon::createFromFormat('Y-m', $item->month_year)->format('M Y');
            })->reverse()->toArray();
            
            $monthlyValues = $monthlyRevenue->pluck('revenue')->reverse()->toArray();
        } else {
            $monthlyLabels = [];
            $monthlyValues = [];
        }
        
        // Status breakdown
        $rentalStatus = Rental::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();
        
        $statusLabels = $rentalStatus->isNotEmpty() ? $rentalStatus->pluck('status')->toArray() : [];
        $statusCounts = $rentalStatus->isNotEmpty() ? $rentalStatus->pluck('count')->toArray() : [];
        
        // Calculate percentages for progress bars
        $availableCarsPercent = $totalCars > 0 ? ($availableCars / $totalCars) * 100 : 0;
        $rentedCarsPercent = $totalCars > 0 ? ($rentedCars / $totalCars) * 100 : 0;
        
        return view('dashboard.infografis', compact(
            'totalCars', 'availableCars', 'rentedCars',
            'totalRentals', 'activeRentals', 'completedRentals',
            'totalRefunds', 'approvedRefunds', 'pendingRefunds',
            'cancellationRate',
            'trendDates', 'trendCounts',
            'occupancyNames', 'occupancyCounts',
            'monthlyLabels', 'monthlyValues',
            'statusLabels', 'statusCounts',
            'availableCarsPercent', 'rentedCarsPercent'
        ));
    }
}
