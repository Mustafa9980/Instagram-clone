<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Story;
use App\Models\User;

class StoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    
    public function create()
    {
        return view('stories.create');
    }

  
    public function store(Request $request)
    {
        $data = request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imagePath = request('image')->store('/story', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"));
        $image->resize(500, 751);
        $image->save();

        auth()->user()->stories()->create([
            'image' => "http://localhost:8000/storage/" . $imagePath
        ]);

        return redirect('/profile/' . auth()->user()->username);
    }

  
    public function show(User $user)
    {
        $stories = $user->stories;
        return view('stories.show', compact('stories', 'user'));
    }
}
