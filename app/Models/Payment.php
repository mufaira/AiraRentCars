<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

/**
 * Class Payment
 * 
 * @property int $id
 * @property int $rental_id
 * @property float $amount
 * @property string $payment_proof_path
 * @property string $status
 * @property string|null $admin_notes
 * @property Carbon|null $verified_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Rental $rental
 * @method static self create(array $attributes = [])
 * @method static int count(string $columns = '*')
 * @method static Builder where(string $column, mixed $operator = null, mixed $value = null)
 * @method static Builder latest(string $column = 'created_at')
 * @method static Builder paginate(int $perPage = 15, array $columns = ['*'], string $pageName = 'page', int $page = null)
 * @method static Builder with(string|array $relations)
 * @method static Builder belongsTo(string $related, string $foreignKey = null, string $ownerKey = null)
 * @method bool update(array $attributes = [], array $options = [])
 * @method bool delete()
 * @method self load(string|array $relations)
 * @method Builder get()
 */
class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_id',
        'amount',
        'payment_proof_path',
        'status',
        'admin_notes',
        'verified_at',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}
