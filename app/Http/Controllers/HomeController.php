<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Profile;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        $games = Game::query()
            ->where('is_visible', true)
            ->with(['developers', 'publishers', 'genres', 'platforms'])
            ->latest('release_date')
            ->limit(10)
            ->get();

        $profiles = Inertia::optional(fn () => Profile::query()
            ->with('media')
            ->latest()
            ->limit(10)
            ->get()
            ->setHidden(['media'])
        );

        return Inertia::render('home', compact('games', 'profiles'));
    }
}
