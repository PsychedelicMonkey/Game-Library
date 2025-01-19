<?php

namespace App\Models\Library;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Symfony\Component\Uid\Ulid;

/**
 * @property Ulid $id
 * @property string $name
 * @property string $slug
 * @property ?string $description
 * @property bool $is_visible
 * @property int $position
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
class Publisher extends Model
{
    /** @use HasFactory<\Database\Factories\Library\PublisherFactory> */
    use HasFactory;
    use HasUlids;

    /**
     * @var string
     */
    protected $table = 'library_publishers';

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

    /** @return BelongsToMany<Game, $this> */
    public function games(): BelongsToMany
    {
        return $this
            ->belongsToMany(Game::class, 'library_game_publisher', 'library_publisher_id', 'library_game_id')
            ->using(GamePublisher::class)
            ->withPivot(['is_primary', 'sort'])
            ->withTimestamps();
    }
}
