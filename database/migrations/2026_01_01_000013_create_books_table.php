<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grade_level_id')->constrained('grade_levels')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('author_id')->constrained('authors')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('cover_color')->default('from-emerald-600 to-teal-700');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->string('isbn')->nullable();
            $table->string('publisher')->default('NCTB Board');
            $table->string('stock_status')->default('in_stock'); // in_stock, out_of_stock
            $table->boolean('is_featured')->default(false);
            $table->integer('page_count')->default(120);
            $table->decimal('rating', 3, 2)->default(4.80);
            $table->integer('reader_count')->default(15000);
            $table->date('published_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
