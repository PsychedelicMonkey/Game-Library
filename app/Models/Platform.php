<?php

namespace App\Models;

use App\Enums\PlatformType;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Platform extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\PlatformFactory> */
    use HasFactory, HasUlids, InteractsWithMedia;

    /**
     * @var string
     */
    protected $table = 'library_platforms';

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
        'discontinued_date',
        'type',
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
            'discontinued_date' => 'date',
            'type' => PlatformType::class,
        ];
    }

    /** @return BelongsToMany<Game, $this> */
    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'library_game_platform', 'library_platform_id', 'library_game_id');
    }
}
