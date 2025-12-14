<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarPhoto;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::with('photos')->paginate(10);
        return view('admin.cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_day' => 'required|numeric|min:0',
            'transmission' => 'required|in:Manual,Matic',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:Tersedia,Disewa',
            'is_active' => 'nullable|in:0,1',
            'is_featured' => 'nullable',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Convert is_active from select value
        $validated['is_active'] = (int) ($validated['is_active'] ?? 1);
        
        // Convert is_featured checkbox to boolean (0 or 1)
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;

        $car = Car::create($validated);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                $path = $photo->store('cars', 'public');
                CarPhoto::create([
                    'car_id' => $car->id,
                    'photo_path' => $path,
                    'is_featured' => $index === 0,
                ]);
            }
        }

        return redirect()->route('cars.admin.index')->with('success', 'Mobil berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        $car->load('photos');
        return view('admin.cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $car->load('photos');
        return view('admin.cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        Log::info('Car update request received', [
            'car_id' => $car->id,
            'request_data' => $request->all(),
        ]);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_day' => 'required|numeric|min:0',
            'transmission' => 'required|in:Manual,Matic',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:Tersedia,Disewa',
            'is_active' => 'nullable|in:0,1',
            'is_featured' => 'nullable',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        Log::info('Car update validation passed', [
            'validated_data' => $validated,
        ]);

        // Convert is_active from select value
        $validated['is_active'] = (int) ($validated['is_active'] ?? 1);
        
        // Convert is_featured checkbox to boolean (0 or 1)
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;

        $car->update($validated);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('cars', 'public');
                CarPhoto::create([
                    'car_id' => $car->id,
                    'photo_path' => $path,
                ]);
            }
        }

        return redirect()->route('cars.admin.edit', $car)->with('success', 'Mobil berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        foreach ($car->photos as $photo) {
            Storage::disk('public')->delete($photo->photo_path);
            $photo->delete();
        }

        $car->delete();

        return redirect()->route('cars.admin.index')->with('success', 'Mobil berhasil dihapus');
    }

    /**
     * Delete a photo
     */
    public function deletePhoto(CarPhoto $photo)
    {
        $carId = $photo->car_id;
        Storage::disk('public')->delete($photo->photo_path);
        $photo->delete();

        return redirect()->route('cars.admin.edit', $carId)->with('success', 'Foto berhasil dihapus');
    }
}
