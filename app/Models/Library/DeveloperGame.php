<?php

namespace App\Models\Library;

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
}
