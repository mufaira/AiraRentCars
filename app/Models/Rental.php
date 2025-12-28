<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

/**
 * Class Rental
 * 
 * @property int $id
 * @property int $user_id
 * @property int $car_id
 * @property Carbon $rental_date
 * @property int $duration_days
 * @property Carbon $return_date
 * @property string $notes
 * @property float $total_price
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read RefundRequest|null $refundRequest
 * @property-read User $user
 * @property-read Car $car
 * @property-read Payment $payment
 * @method static self create(array $attributes = [])
 * @method static int count(string $columns = '*')
 * @method static Builder where(string $column, mixed $operator = null, mixed $value = null)
 * @method static Builder select(string|array $columns)
 * @method static Builder groupBy(string|array $columns)
 * @method static Builder with(string|array $relations)
 * @method static Builder latest(string $column = 'created_at')
 * @method static Builder paginate(int $perPage = 15, array $columns = ['*'], string $pageName = 'page', int $page = null)
 * @method static float sum(string $column)
 * @method static Builder orderByRaw(string $expression)
 * @method static Builder orderByDesc(string $column)
 * @method static Builder limit(int $value)
 * @method static Builder whereNotNull(string $column)
 * @method static Builder belongsTo(string $related, string $foreignKey = null, string $ownerKey = null)
 * @method static Builder hasOne(string $related, string $foreignKey = null, string $localKey = null)
 * @method static self|null first()
 * @method bool update(array $attributes = [], array $options = [])
 * @method self load(string|array $relations)
 * @method Builder get()
 */
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
