<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Game extends Model
{
    /** @use HasFactory<\Database\Factories\GameFactory> */
    use HasFactory;

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
        return $this->belongsToMany(Developer::class, 'library_developer_game', 'library_game_id', 'library_developer_id');
    }

    /** @return BelongsToMany<Genre> */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'library_game_genre', 'library_game_id', 'library_genre_id');
    }

    /** @return BelongsToMany<Platform> */
    public function platforms(): BelongsToMany
    {
        return $this->belongsToMany(Platform::class, 'library_game_platform', 'library_game_id', 'library_platform_id');
    }

    /** @return BelongsToMany<Publisher> */
    public function publishers(): BelongsToMany
    {
        return $this->belongsToMany(Publisher::class, 'library_game_publisher', 'library_game_id', 'library_publisher_id');
    }
}
