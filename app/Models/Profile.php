<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property string $id
 * @property string $user_id
 * @property ?string $bio
 * @property bool $is_public
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 * @property User $user
 */
class Profile extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;
    use HasUlids;
    use InteractsWithMedia;

    public const AVATAR_COLLECTION = 'profile-avatars';
    public const PHOTO_COLLECTION = 'profile-photos';

    /**
     * @var string
     */
    protected $table = 'profiles';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'bio',
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

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getAvatar(): ?Media
    {
        return $this->getFirstMedia(self::AVATAR_COLLECTION);
    }

    public function getAvatarUrl(string $conversionName = ''): ?string
    {
        return $this->getFirstMediaUrl(self::AVATAR_COLLECTION, $conversionName);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::AVATAR_COLLECTION)
            ->singleFile();

        $this->addMediaCollection(self::PHOTO_COLLECTION);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('icon')
            ->nonQueued()
            ->fit(Fit::Crop, 80, 80)
            ->sharpen(10);
    }
}
