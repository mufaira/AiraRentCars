<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'rental_date',
        'duration_days',
        'return_date',
        'total_price',
        'status',
        'notes',
    ];

    protected $casts = [
        'rental_date' => 'date',
        'return_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function refundRequest()
    {
        return $this->hasOne(RefundRequest::class);
    }

    public function calculateTotalPrice()
    {
        if ($this->car && $this->duration_days) {
            return $this->car->price_per_day * $this->duration_days;
        }
        return 0;
    }
}
