<?php

namespace App\Models\Library;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;
use Symfony\Component\Uid\Ulid;

/**
 * @property Ulid $id
 * @property string $name
 * @property string $slug
 * @property ?string $description
 * @property bool $is_visible
 * @property bool $is_featured
 * @property ?CarbonInterface $release_date
 * @property int $position
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 * @property Developer[] $developers
 * @property Publisher[] $publishers
 */
class Game extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\Library\GameFactory> */
    use HasFactory;
    use HasTags;
    use HasUlids;
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

    /** @return BelongsToMany<Developer, $this> */
    public function developers(): BelongsToMany
    {
        return $this
            ->belongsToMany(Developer::class, 'library_developer_game', 'library_game_id', 'library_developer_id')
            ->using(DeveloperGame::class)
            ->withPivot(['is_primary', 'sort'])
            ->withTimestamps();
    }

    /** @return HasMany<GamePlatform, $this> */
    public function gamePlatforms(): HasMany
    {
        return $this->hasMany(GamePlatform::class, 'library_game_id');
    }

    /** @return BelongsToMany<Genre, $this> */
    public function genres(): BelongsToMany
    {
        return $this
            ->belongsToMany(Genre::class, 'library_game_genre', 'library_game_id', 'library_genre_id')
            ->using(GameGenre::class)
            ->withPivot(['is_primary', 'sort'])
            ->withTimestamps();
    }

    /** @return BelongsToMany<Platform, $this> */
    public function platforms(): BelongsToMany
    {
        return $this
            ->belongsToMany(Platform::class, 'library_game_platform', 'library_game_id', 'library_platform_id')
            ->using(GamePlatform::class)
            ->withPivot(['url', 'release_date', 'sort'])
            ->withTimestamps();
    }

    /** @return BelongsToMany<Publisher, $this> */
    public function publishers(): BelongsToMany
    {
        return $this
            ->belongsToMany(Publisher::class, 'library_game_publisher', 'library_game_id', 'library_publisher_id')
            ->using(GamePublisher::class)
            ->withPivot(['is_primary', 'sort'])
            ->withTimestamps();
    }

    /** @return HasMany<Review, $this> */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'library_game_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('screenshots');
    }
}
