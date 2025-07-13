<?php

namespace App\Models;

use App\Models\Library\Rating;
use App\Models\Library\Review;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property string $id
 * @property string $user_id
 * @property string $username
 * @property ?string $bio
 * @property bool $is_public
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
class Profile extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory, HasUlids, InteractsWithMedia;

    /**
     * @var string
     */
    protected $table = 'user_profiles';

    /**
     * @var list<string>
     */
    protected $appends = ['avatar'];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'username',
        'bio',
        'is_public',
    ];

    /**
     * @var list<string>
     */
    protected $hidden = ['user_id'];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_public' => 'boolean',
        ];
    }

    /** @return HasMany<Rating, $this> */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class, 'user_profile_id');
    }

    /** @return HasManyThrough<Review, Rating, $this> */
    public function reviews(): HasManyThrough
    {
        return $this->hasManyThrough(Review::class, Rating::class, 'user_profile_id', 'library_rating_id');
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return Attribute<string, null>
     */
    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getAvatarUrl('medium'),
        );
    }

    /**
     * Return the profile's avatar object.
     */
    public function getAvatar(): ?Media
    {
        return $this->getFirstMedia('profile-avatars');
    }

    /**
     * Return the profile's avatar URL.
     */
    public function getAvatarUrl(string $conversionName = ''): ?string
    {
        return $this->getFirstMediaUrl('profile-avatars', $conversionName);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile-avatars')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('icon')
            ->nonQueued()
            ->fit(Fit::Crop, 60, 60)
            ->sharpen(10);

        $this->addMediaConversion('medium')
            ->fit(Fit::Crop, 200, 200);
    }
}
