<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property bool $is_admin
 * @property bool $is_staff
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static int count(string $columns = '*')
 * @method static Builder where(string $column, mixed $operator = null, mixed $value = null)
 * @method static Builder select(string|array $columns)
 * @method static Builder with(string|array $relations)
 * @method static Builder latest(string $column = 'created_at')
 * @method static Paginator paginate(int $perPage = 15, array $columns = ['*'], string $pageName = 'page', int $page = null)
 * @method static self|null first()
 * @method bool update(array $attributes = [], array $options = [])
 * @method bool delete()
 * @method self load(string|array $relations)
 * @method Builder get()
 * @method self fill(array $attributes = [])
 * @method bool isDirty(string|array|null $attributes = null)
 * @method bool save(array $options = [])
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'is_staff',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if the user is an admin.
     */
    public function is_admin(): bool
    {
        return $this->is_admin;
    }
}
