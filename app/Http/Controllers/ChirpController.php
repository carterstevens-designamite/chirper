<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chirps = Chirp::latest()->with('user:id,logo,name')->get();

        return view('welcome', ['chirps' => $chirps]);
    }

    /**
     * Display the user's dashboard with their own chirps.
     */
    public function dashboard()
    {
        $chirps = Chirp::where('user_id', Auth::id())
            ->latest()
            ->with('user:id,logo,name')
            ->get();

        return view('dashboard', ['chirps' => $chirps]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(['user_id' => Auth::user()->id]);
        $chripAtrributes = $request->validate([
            'user_id' => ['required'],
            'message' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg,gif', 'max:2048'],
        ]);

        $chripAtrributes['message'] = preg_replace('/(\r\n|\n|\r){2,}/', "\n", $chripAtrributes['message']);

        if ($request->hasFile('image')) {
            $imagePath = $request->image->store('chirp-images');
            $chripAtrributes['image'] = $imagePath;
        }

        Chirp::create($chripAtrributes);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        return view('chirpAuth.edit', ['chirp' => $chirp]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {

        $chripAtrributes = $request->validate([
            'message' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg,gif', 'max:2048'],
        ]);
        $chripAtrributes['message'] = preg_replace('/(\r\n|\n|\r){2,}/', "\n", $chripAtrributes['message']);

        if ($request->hasFile('image')) {
            $imagePath = $request->image->store('chirp-images');
            $chripAtrributes['image'] = $imagePath;
        }

        $chirp->update($chripAtrributes);

        return Redirect::back()->with('success', 'Chirp updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        $chirp->delete();
        if (Storage::exists($chirp->image)) {
            Storage::delete($chirp->image);
        }

        return redirect()->route('dashboard');
    }
}
