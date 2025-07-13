<?php

namespace App\Models\Library;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GamePublisher extends Pivot
{
    /**
     * @var string
     */
    protected $table = 'library_game_publisher';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'library_game_id',
        'library_publisher_id',
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
}
