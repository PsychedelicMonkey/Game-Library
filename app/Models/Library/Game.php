<?php

namespace App\Models\Library;

use App\Traits\HasTags;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Game extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\Library\GameFactory> */
    use HasFactory, HasTags, HasUlids, InteractsWithMedia;

    /**
     * @var string
     */
    protected $table = 'library_games';

    /**
     * @var list<string>
     */
    protected $appends = [
        'cover_art',
    ];

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

    /** @return HasMany<Rating, $this> */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class, 'library_game_id');
    }

    /** @return HasManyThrough<Review, Rating, $this> */
    public function reviews(): HasManyThrough
    {
        return $this->hasManyThrough(Review::class, Rating::class, 'library_game_id', 'library_rating_id');
    }

    /**
     * @return Attribute<string, null>
     */
    protected function coverArt(): Attribute
    {
        $this->load('media');

        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl('game-cover-art')
        );
    }

    /**
     * Determine if the game is visible.
     */
    public function isVisible(): bool
    {
        return $this->is_visible;
    }

    /**
     * Scope a query to only include visible games.
     *
     * @param  Builder<Game>  $query
     */
    #[Scope]
    protected function visible(Builder $query): void
    {
        $query->where('is_visible', true);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('game-cover-art')
            ->singleFile();
    }
}
