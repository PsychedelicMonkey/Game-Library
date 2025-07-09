<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory, HasUlids;

    /**
     * @var string
     */
    protected $table = 'library_reviews';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'library_rating_id',
        'body',
        'is_public',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_public' => 'boolean',
        ];
    }

    /** @return BelongsTo<Rating, $this> */
    public function rating(): BelongsTo
    {
        return $this->belongsTo(Rating::class, 'library_rating_id');
    }
}
