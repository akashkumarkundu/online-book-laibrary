<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int|null $user_id
 * @property string|null $session_id
 * @property int $book_id
 * @property int $quantity
 * @property-read Book $book
 * @property-read float $subtotal
 */
class CartItem extends Model
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'book_id',
        'quantity',
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Book, $this>
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function getSubtotalAttribute(): float
    {
        return (float) ($this->book->effective_price * $this->quantity);
    }
}
