<?php

namespace App\Models\Library;

use App\Models\User;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Symfony\Component\Uid\Ulid;

/**
 * @property Ulid $id
 * @property Ulid $library_game_id
 * @property Ulid $user_id
 * @property string $title
 * @property string $content
 * @property ?CarbonInterface $published_at
 * @property bool $is_visible
 * @property bool $is_featured
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 * @property Game $game
 * @property User $user
 */
class Review extends Model
{
    /** @use HasFactory<\Database\Factories\Library\ReviewFactory> */
    use HasFactory;
    use HasUlids;

    /**
     * @var string
     */
    protected $table = 'library_reviews';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'library_game_id',
        'user_id',
        'title',
        'content',
        'published_at',
        'is_visible',
        'is_featured',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_visible' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    /** @return BelongsTo<Game, $this> */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'library_game_id');
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
