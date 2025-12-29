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
        try {
            // Verify this is a PUT/PATCH request and not accidental DELETE
            if (!in_array($request->getMethod(), ['PUT', 'PATCH'])) {
                Log::warning('Invalid request method for car update', [
                    'car_id' => $car->id,
                    'method' => $request->getMethod(),
                ]);
                return response()->json(['error' => 'Invalid request method'], 405);
            }

            Log::info('Car update request received', [
                'car_id' => $car->id,
                'method' => $request->getMethod(),
                'route' => $request->route()->getName(),
            ]);
            
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price_per_day' => 'required|numeric|min:0',
                'transmission' => 'required|in:Manual,Matic',
                'capacity' => 'required|integer|min:1',
                'status' => 'required|in:Tersedia,Disewa',
                'is_active' => 'required|in:0,1',
                'is_featured' => 'nullable',
                'photos' => 'nullable|array',
                'photos.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            Log::info('Validation passed, updating car', [
                'car_id' => $car->id,
                'name' => $validated['name'],
                'price' => $validated['price_per_day'],
                'status' => $validated['status'],
            ]);

            // Convert is_active to integer
            $validated['is_active'] = (int) $validated['is_active'];
            
            // Convert is_featured checkbox to boolean (0 or 1)
            $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;

            // Update car basic info
            $updated = $car->update($validated);
            Log::info('Car updated successfully', ['car_id' => $car->id, 'updated' => $updated]);

            // Delete all existing photos (if user wants to change them, they upload new ones)
            foreach ($car->photos as $photo) {
                try {
                    if (Storage::disk('public')->exists($photo->photo_path)) {
                        Storage::disk('public')->delete($photo->photo_path);
                        Log::info('Old photo deleted during update', ['path' => $photo->photo_path]);
                    }
                    $photo->delete();
                } catch (\Exception $e) {
                    Log::warning('Error deleting photo', ['photo_id' => $photo->id, 'error' => $e->getMessage()]);
                }
            }

            // Handle new photo uploads
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    try {
                        $path = $photo->store('cars', 'public');
                        CarPhoto::create([
                            'car_id' => $car->id,
                            'photo_path' => $path,
                        ]);
                        Log::info('New photo uploaded', ['car_id' => $car->id, 'path' => $path]);
                    } catch (\Exception $e) {
                        Log::error('Photo upload failed', ['car_id' => $car->id, 'error' => $e->getMessage()]);
                    }
                }
            }

            Log::info('Car update completed successfully', ['car_id' => $car->id]);
            return redirect()->route('cars.admin.edit', $car)->with('success', 'Mobil berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Car update failed', [
                'car_id' => $car->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('cars.admin.edit', $car)->with('error', 'Update gagal: ' . $e->getMessage());
        }
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
