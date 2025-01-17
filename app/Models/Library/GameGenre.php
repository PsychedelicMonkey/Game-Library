<?php

namespace App\Models\Library;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GameGenre extends Pivot
{
    use HasUlids;

    /**
     * @var string
     */
    protected $table = 'library_game_genre';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'library_game_id',
        'library_genre_id',
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

    /** @return BelongsTo<Game, $this> */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'library_game_id');
    }

    /** @return BelongsTo<Genre, $this> */
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class, 'library_genre_id');
    }
}
