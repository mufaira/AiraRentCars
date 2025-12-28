<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

/**
 * Class Blog
 * 
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string|null $excerpt
 * @property string|null $featured_image
 * @property bool $is_published
 * @property Carbon|null $published_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property array $attributes
 * @property-read User $user
 * @method static self create(array $attributes = [])
 * @method static int count(string $columns = '*')
 * @method static Builder where(string $column, mixed $operator = null, mixed $value = null)
 * @method static Builder select(string|array $columns)
 * @method static Builder with(string|array $relations)
 * @method static Builder latest(string $column = 'created_at')
 * @method static Builder paginate(int $perPage = 15, array $columns = ['*'], string $pageName = 'page', int $page = null)
 * @method static Builder belongsTo(string $related, string $foreignKey = null, string $ownerKey = null)
 * @method static self|null first()
 * @method bool update(array $attributes = [], array $options = [])
 * @method bool delete()
 * @method self load(string|array $relations)
 * @method Builder get()
 * @method void setTitleAttribute(string $value)
 */
class Blog extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    // Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Generate slug from title
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = \Illuminate\Support\Str::slug($value);
    }
}
