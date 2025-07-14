<?php

declare(strict_types=1);

namespace App\Models\Library;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GamePlatform extends Pivot
{
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
        'release_date',
        'url',
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
}
