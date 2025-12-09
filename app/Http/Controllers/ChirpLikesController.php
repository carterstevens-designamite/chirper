<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Support\Facades\Auth;

class ChirpLikesController extends Controller
{

    public function index()
    {
        // Count likes for each chirp
        $chirps = Chirp::all();
        $likedIds = Auth::user()?->likedChirps->pluck('id')->toArray() ?? [];
        return view('welcome', compact('chirps', 'likedIds'));
    }

    public function store(Chirp $chirp)
    {
        if (!Auth::check() || !Auth::user()) {
            return response()->json(['message' => 'not Authenticated'], 403);
        }
        if ($chirp->usersLiked->contains(Auth::user())) {
            return response()->json(['message' => 'Chirp already liked']);
        }
        Auth::user()->likedChirps()->attach($chirp);
        $chirp->increment('likes_count');
    }

    public function destroy(Chirp $chirp)
    {
        if (!Auth::check() || !Auth::user()) {
            return response()->json(['message' => 'not Authenticated'], 403);
        }
        if ($chirp->usersLiked->contains(Auth::user())) {
            Auth::user()->likedChirps()->detach($chirp);
            $chirp->decrement('likes_count');
        }

    }

}
