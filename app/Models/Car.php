<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price_per_day',
        'transmission',
        'capacity',
        'status',
        'is_active',
        'is_featured',
    ];

    public function photos()
    {
        return $this->hasMany(CarPhoto::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function getFeaturedPhotoAttribute()
    {
        return $this->photos()->where('is_featured', true)->first() 
            ?? $this->photos()->first();
    }

    // Helper method for blade templates
    public function getFeaturedPhoto()
    {
        return $this->photos()->where('is_featured', true)->first() 
            ?? $this->photos()->first();
    }
}
