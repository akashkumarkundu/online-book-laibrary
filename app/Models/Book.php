<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $grade_level_id
 * @property int $subject_id
 * @property int $author_id
 * @property string $title
 * @property string $slug
 * @property string $cover_color
 * @property string $description
 * @property float $price
 * @property float|null $discount_price
 * @property string|null $isbn
 * @property string $publisher
 * @property string $stock_status
 * @property bool $is_featured
 * @property int $page_count
 * @property float $rating
 * @property int $reader_count
 * @property Carbon|null $published_date
 * @property-read float $effective_price
 * @property-read GradeLevel|null $gradeLevel
 * @property-read Subject|null $subject
 * @property-read Author|null $author
 */
class Book extends Model
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    protected $fillable = [
        'grade_level_id',
        'subject_id',
        'author_id',
        'title',
        'slug',
        'cover_color',
        'description',
        'price',
        'discount_price',
        'isbn',
        'publisher',
        'stock_status',
        'is_featured',
        'page_count',
        'rating',
        'reader_count',
        'published_date',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'published_date' => 'date',
    ];

    /**
     * @return BelongsTo<GradeLevel, $this>
     */
    public function gradeLevel(): BelongsTo
    {
        return $this->belongsTo(GradeLevel::class);
    }

    /**
     * @return BelongsTo<Subject, $this>
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * @return BelongsTo<Author, $this>
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * @return HasMany<Chapter, $this>
     */
    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class)->orderBy('chapter_number');
    }

    public function getEffectivePriceAttribute(): float
    {
        return (float) ($this->discount_price ?? $this->price);
    }
}
