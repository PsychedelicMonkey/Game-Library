<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game): Response
    {
        if (! $game->isVisible()) {
            throw new NotFoundHttpException;
        }

        $game->load([
            'developers',
            'genres',
            'media',
            'publishers',
            'platforms',
            'tags',
        ])
            ->loadAvg('ratings', 'score')
            ->loadCount('ratings');

        $reviews = Inertia::optional(function () use ($game) {
            return $game
                ->reviews()
                ->with(['rating.profile', 'rating.profile.media', 'rating'])
                ->latest()
                ->limit(10)
                ->get()
                ->makeHidden('laravel_through_key');
        });

        return Inertia::render('library/game/show', compact('game', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
}
