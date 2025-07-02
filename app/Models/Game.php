<?php

namespace App\Models;

use App\Traits\HasTags;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Game extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\GameFactory> */
    use HasFactory, HasTags, HasUlids, InteractsWithMedia;

    /**
     * @var string
     */
    protected $table = 'library_games';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'is_visible',
        'is_featured',
        'release_date',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_visible' => 'boolean',
            'is_featured' => 'boolean',
            'release_date' => 'date',
        ];
    }

    /** @return BelongsToMany<Company, $this> */
    public function developers(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'library_developer_game', 'library_game_id', 'library_developer_id');
    }

    /** @return BelongsToMany<Genre, $this> */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'library_game_genre', 'library_game_id', 'library_genre_id');
    }

    /** @return BelongsToMany<Platform, $this> */
    public function platforms(): BelongsToMany
    {
        return $this->belongsToMany(Platform::class, 'library_game_platform', 'library_game_id', 'library_platform_id');
    }

    /** @return BelongsToMany<Company, $this> */
    public function publishers(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'library_game_publisher', 'library_game_id', 'library_publisher_id');
    }

    /**
     * Determine if the game is visible.
     */
    public function isVisible(): bool
    {
        return $this->is_visible;
    }
}
