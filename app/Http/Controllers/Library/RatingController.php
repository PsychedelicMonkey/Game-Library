<?php

declare(strict_types=1);

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Library\Rating;
use App\Models\Library\Review;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'score' => ['required', 'integer', 'min:1', 'max:100'],
            'gameId' => ['required', 'ulid'],
            'review' => ['nullable', 'max:1000'],
        ]);

        /** @var User $user */
        $user = $request->user();

        // TODO: Check if user alread has a review.

        DB::transaction(function () use ($request, $user) {
            $rating = Rating::create([
                'score' => $request->integer('score'),
                'library_game_id' => $request->string('gameId'),
                'user_profile_id' => $user->profile->getKey(),
            ]);

            Review::create([
                'library_rating_id' => $rating->getKey(),
                'body' => $request->string('review'),
                'is_public' => true, // TODO: Allow user to set their review to public.
            ]);
        });

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
