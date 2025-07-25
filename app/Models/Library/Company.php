<?php

declare(strict_types=1);

namespace App\Models\Library;

use App\Traits\HasTags;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Company extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\Library\CompanyFactory> */
    use HasFactory;
    use HasTags;
    use HasUlids;
    use InteractsWithMedia;

    /**
     * @var string
     */
    protected $table = 'library_companies';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'is_visible',
        'is_featured',
        'city',
        'country',
        'date_formed',
        'date_defunct',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'is_visible',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_visible' => 'boolean',
            'is_featured' => 'boolean',
            'date_formed' => 'date',
            'date_defunct' => 'date',
        ];
    }

    /** @return HasMany<Company, $this> */
    public function children(): HasMany
    {
        return $this->hasMany(Company::class, 'parent_id');
    }

    /** @return BelongsTo<Company, $this> */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'parent_id');
    }

    /** @return BelongsToMany<Game, $this> */
    public function developedGames(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'library_developer_game', 'library_developer_id', 'library_game_id');
    }

    /** @return BelongsToMany<Game, $this> */
    public function publishedGames(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'library_game_publisher', 'library_publisher_id', 'library_game_id');
    }

    /**
     * Determine if the company is visible.
     */
    public function isVisible(): bool
    {
        return $this->is_visible;
    }

    /**
     *  Scope a query to only include visible companies.
     *
     * @param  Builder<Company>  $query
     */
    #[Scope]
    public function visible(Builder $query): void
    {
        $query->where('is_visible', true);
    }
}
