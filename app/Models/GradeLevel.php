<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $code
 * @property string $category
 * @property int $sort_order
 */
class GradeLevel extends Model
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'code',
        'category',
        'sort_order',
    ];

    /**
     * @return HasMany<Book, $this>
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
