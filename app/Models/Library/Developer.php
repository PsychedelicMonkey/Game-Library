<?php

namespace App\Models\Library;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Developer extends Model
{
    /** @use HasFactory<\Database\Factories\Library\DeveloperFactory> */
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'library_developers';

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
            ->belongsToMany(Game::class, 'library_developer_game', 'library_developer_id', 'library_game_id')
            ->using(DeveloperGame::class)
            ->withPivot(['is_primary', 'sort'])
            ->withTimestamps();
    }
}
