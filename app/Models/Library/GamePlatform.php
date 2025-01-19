<?php

namespace App\Models\Library;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GamePlatform extends Pivot
{
    use HasUlids;

    /**
     * @var string
     */
    protected $table = 'library_game_platform';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'library_game_id',
        'library_platform_id',
        'url',
        'release_date',
        'sort',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'release_date' => 'date',
            'sort' => 'integer',
        ];
    }

    /** @return BelongsTo<Game, $this> */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'library_game_id');
    }

    /** @return BelongsTo<Platform, $this> */
    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class, 'library_platform_id');
    }
}
