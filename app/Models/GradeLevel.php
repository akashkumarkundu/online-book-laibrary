<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GradeLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'code',
        'category',
        'sort_order',
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
