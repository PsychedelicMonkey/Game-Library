<?php

namespace App\Models\Library;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Platform extends Model
{
    /** @use HasFactory<\Database\Factories\Library\PlatformFactory> */
    use HasFactory;

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
        'position',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_visible' => 'boolean',
            'position' => 'integer',
        ];
    }

    /** @return BelongsToMany<Game> */
    public function games(): BelongsToMany
    {
        return $this
            ->belongsToMany(Game::class, 'library_game_platform', 'library_platform_id', 'library_game_id')
            ->using(GamePlatform::class)
            ->withPivot(['url', 'release_date', 'sort'])
            ->withTimestamps();
    }
}
