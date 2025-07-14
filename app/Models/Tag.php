<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Tags\Tag as SpatieTag;

class Tag extends SpatieTag
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;
    use HasUlids;
}
