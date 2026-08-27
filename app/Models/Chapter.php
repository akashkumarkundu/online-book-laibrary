<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'chapter_number',
        'title',
        'content',
        'audio_narration',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
