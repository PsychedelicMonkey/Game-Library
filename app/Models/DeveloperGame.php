<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DeveloperGame extends Pivot
{
    /**
     * @var string
     */
    protected $table = 'library_developer_game';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'library_developer_id',
        'library_game_id',
        'is_primary',
        'sort',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_primary' => 'boolean',
            'sort' => 'integer',
        ];
    }

    /** @return BelongsTo<Developer, self> */
    public function developer(): BelongsTo
    {
        return $this->belongsTo(Developer::class, 'library_developer_id');
    }

    /** @return BelongsTo<Game, self> */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'library_game_id');
    }
}