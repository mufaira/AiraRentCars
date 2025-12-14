<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefundRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_id',
        'reason',
        'custom_reason',
        'status',
        'admin_notes',
        'refund_amount',
        'processed_at',
    ];

    protected $casts = [
        'processed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the rental associated with refund request
     */
    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    /**
     * Get reason text
     */
    public function getReasonTextAttribute()
    {
        $reasons = [
            'change_plan' => 'Berubah Rencana',
            'time_issue' => 'Masalah Waktu',
            'car_issue' => 'Masalah dengan Mobil',
            'other' => 'Lainnya',
        ];

        return $reasons[$this->reason] ?? $this->reason;
    }
}
