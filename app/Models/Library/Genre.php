<?php

declare(strict_types=1);

namespace App\Models\Library;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    /** @use HasFactory<\Database\Factories\Library\GenreFactory> */
    use HasFactory;
    use HasUlids;

    /**
     * @var string
     */
    protected $table = 'library_genres';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_visible',
        'is_featured',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'is_visible',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_visible' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    /** @return BelongsToMany<Game, $this> */
    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'library_game_genre', 'library_genre_id', 'library_game_id');
    }

    /**
     * Determine if the genre is visible.
     */
    public function isVisible(): bool
    {
        return $this->is_visible;
    }

    /**
     *  Scope a query to only include visible genres.
     *
     * @param  Builder<Genre>  $query
     */
    #[Scope]
    public function visible(Builder $query): void
    {
        $query->where('is_visible', true);
    }
}
