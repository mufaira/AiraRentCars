<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

/**
 * Class CarPhoto
 * 
 * @property int $id
 * @property int $car_id
 * @property string $photo_path
 * @property bool $is_featured
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Car $car
 * @method static self create(array $attributes = [])
 * @method static Builder where(string $column, mixed $operator = null, mixed $value = null)
 * @method static Builder paginate(int $perPage = 15, array $columns = ['*'], string $pageName = 'page', int $page = null)
 * @method static BelongsTo belongsTo(string $related, string $foreignKey = null, string $ownerKey = null)
 * @method bool delete()
 * @method bool update(array $attributes = [], array $options = [])
 */
class CarPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'photo_path',
        'is_featured',
    ];

    /**
     * Get the car that owns the photo.
     * 
     * @return BelongsTo
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
