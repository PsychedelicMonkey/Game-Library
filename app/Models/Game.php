<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Game extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\GameFactory> */
    use HasFactory;
    use HasTags;
    use InteractsWithMedia;

    /**
     * @var string
     */
    protected $table = 'library_games';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_visible',
        'is_featured',
        'release_date',
        'position',
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

    /** @return BelongsToMany<Developer> */
    public function developers(): BelongsToMany
    {
        return $this
            ->belongsToMany(Developer::class, 'library_developer_game', 'library_game_id', 'library_developer_id')
            ->using(DeveloperGame::class)
            ->withPivot(['is_primary', 'sort'])
            ->withTimestamps();
    }

    /** @return BelongsToMany<Genre> */
    public function genres(): BelongsToMany
    {
        return $this
            ->belongsToMany(Genre::class, 'library_game_genre', 'library_game_id', 'library_genre_id')
            ->using(GameGenre::class)
            ->withPivot(['is_primary', 'sort'])
            ->withTimestamps();
    }

    /** @return BelongsToMany<Platform> */
    public function platforms(): BelongsToMany
    {
        return $this
            ->belongsToMany(Platform::class, 'library_game_platform', 'library_game_id', 'library_platform_id')
            ->using(GamePlatform::class)
            ->withPivot(['url', 'release_date', 'sort'])
            ->withTimestamps();
    }

    /** @return BelongsToMany<Publisher> */
    public function publishers(): BelongsToMany
    {
        return $this
            ->belongsToMany(Publisher::class, 'library_game_publisher', 'library_game_id', 'library_publisher_id')
            ->using(GamePublisher::class)
            ->withPivot(['is_primary', 'sort'])
            ->withTimestamps();
    }

    /** @return HasMany<Review> */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'library_game_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('screenshots');
    }
}
