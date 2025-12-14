<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class UserCarController extends Controller
{
    /**
     * Display catalog of cars for users
     */
    public function index(Request $request)
    {
        $query = Car::where('is_active', true)->with('photos');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by transmission type
        if ($request->filled('type')) {
            $query->where('transmission', $request->type);
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price_per_day', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price_per_day', '<=', $request->max_price);
        }

        $cars = $query->paginate(12);
        $maxPrice = Car::max('price_per_day');

        return view('cars.index', compact('cars', 'maxPrice'));
    }

    /**
     * Display the specified car
     */
    public function show(Car $car)
    {
        if (!$car->is_active) {
            abort(404);
        }

        $car->load('photos');
        $relatedCars = Car::where('is_active', true)
            ->where('id', '!=', $car->id)
            ->where('transmission', $car->transmission)
            ->limit(3)
            ->get();

        return view('cars.show', compact('car', 'relatedCars'));
    }
}
