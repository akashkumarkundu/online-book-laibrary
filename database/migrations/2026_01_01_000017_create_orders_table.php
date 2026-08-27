<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('customer_name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('district');
            $table->text('address');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('shipping_charge', 10, 2)->default(60.00);
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_method')->default('cod'); // cod, bkash, nagad, rocket
            $table->string('payment_status')->default('pending'); // pending, paid
            $table->string('order_status')->default('pending'); // pending, processing, completed, cancelled
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
