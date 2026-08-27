<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $order_id
 * @property int|null $book_id
 * @property string $book_title
 * @property float $unit_price
 * @property int $quantity
 * @property float $total_price
 */
class OrderItem extends Model
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id',
        'book_id',
        'book_title',
        'unit_price',
        'quantity',
        'total_price',
    ];

    /**
     * @return BelongsTo<Order, $this>
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return BelongsTo<Book, $this>
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
