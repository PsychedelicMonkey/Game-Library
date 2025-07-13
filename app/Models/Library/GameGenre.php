<?php

namespace App\Models\Library;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GameGenre extends Pivot
{
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
        'sort',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'sort' => 'integer',
        ];
    }
}
