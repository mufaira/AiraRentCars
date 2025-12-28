<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

/**
 * Class RefundRequest
 * 
 * @property int $id
 * @property int $rental_id
 * @property string $reason
 * @property string|null $custom_reason
 * @property string $status
 * @property string|null $admin_notes
 * @property float $refund_amount
 * @property Carbon|null $processed_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Rental $rental
 * @method static self create(array $attributes = [])
 * @method static int count(string $columns = '*')
 * @method static Builder where(string $column, mixed $operator = null, mixed $value = null)
 * @method static Builder whereHas(string $relation, callable|Builder $callback = null)
 * @method static Builder with(string|array $relations)
 * @method static Builder latest(string $column = 'created_at')
 * @method static Builder paginate(int $perPage = 15, array $columns = ['*'], string $pageName = 'page', int $page = null)
 * @method static Builder belongsTo(string $related, string $foreignKey = null, string $ownerKey = null)
 * @method bool update(array $attributes = [], array $options = [])
 * @method self load(string|array $relations)
 * @method Builder get()
 */
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
