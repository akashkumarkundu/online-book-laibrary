<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $order_number
 * @property int|null $user_id
 * @property string $customer_name
 * @property string $phone
 * @property string|null $email
 * @property string $district
 * @property string $address
 * @property float $subtotal
 * @property float $shipping_charge
 * @property float $total_amount
 * @property string $payment_method
 * @property string $payment_status
 * @property string $order_status
 * @property string|null $notes
 * @property Carbon|null $created_at
 * @property-read Collection<int, OrderItem> $items
 */
class Order extends Model
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'phone',
        'email',
        'district',
        'address',
        'subtotal',
        'shipping_charge',
        'total_amount',
        'payment_method',
        'payment_status',
        'order_status',
        'notes',
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<OrderItem, $this>
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
