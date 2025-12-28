<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use App\Models\Payment;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalCars = Car::count();
        $totalRentals = Rental::count();
        $totalUsers = User::count();
        $totalRevenue = Payment::where('status', 'Verified')->sum('amount');
        
        $stats = [
            'total_cars' => $totalCars,
            'total_rentals' => $totalRentals,
            'total_users' => $totalUsers,
            'total_revenue' => $totalRevenue,
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
