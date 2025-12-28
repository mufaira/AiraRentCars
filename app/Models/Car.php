<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $price_per_day
 * @property string $transmission
 * @property int $capacity
 * @property string $status
 * @property bool $is_active
 * @property bool $is_featured
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection $rentals
 * @property-read Collection $photos
 * @method static int count(string $columns = '*')
 * @method static Builder where(string $column, mixed $operator = null, mixed $value = null)
 * @method static Builder select(string|array $columns)
 * @method static Builder withCount(string|array $relations)
 * @method static Builder limit(int $value)
 * @method static Builder orderByDesc(string $column)
 * @method static Builder with(string|array $relations)
 * @method static Builder paginate(int $perPage = 15, array $columns = ['*'], string $pageName = 'page', int $page = null)
 * @method static float|int|null max(string $column)
 * @method static self|null first()
 * @method static self create(array $attributes = [])
 * @method static Builder hasMany(string $related, string $foreignKey = null, string $localKey = null)
 * @method bool update(array $attributes = [], array $options = [])
 * @method bool delete()
 * @method self load(string|array $relations)
 * @method Builder get()
 */
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
