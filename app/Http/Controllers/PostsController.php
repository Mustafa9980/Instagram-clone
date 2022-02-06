<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Post;
use App\Models\User;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;




class PostsController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }


    public function index(){
        $users = auth()->user()->following()->pluck('profiles.user_id');





        // Get Users Id form $following array
            $sugg_users = User::all()->reject(function ($user) {
            $users_id = auth()->user()->following()->pluck('profiles.user_id')->toArray();
            return $user->id == Auth::id() || in_array($user->id, $users_id);
        });

        // Add Auth user id to users id array
        //   $users_id = $user->$users_id->push(auth()->user()->id);

        // $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        //  $posts = Post::whereIn('user_id', $users_id)->with('user')->latest()->paginate(10)->getCollection();
         $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);


        // dd($posts);

        return view('posts.index', compact('posts', 'sugg_users'));

    }
    public function create()
    {


        return view('posts.create');
    }


    public function store(){
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required','image'],
        ]);

        $imagePath=(request('image')->store('uploads','public'));
     
        $image=Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();
        auth()->user()->posts()->create([
            'caption'=>$data['caption'],
            'image'=>$imagePath,


        ]);

        return redirect('/profile/' . auth()->user()->id);
    }
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return Redirect::back();
    }


    public function show(Post $post ) {
        $posts = $post->user->posts->except($post->id);
        return view('posts.show', compact('post', 'posts'));
    }

   
    
    
    
    public function explore()
    {
        $posts = Post::all()->except(Auth::id())->shuffle();
        

        return view('posts.explore', compact('posts'));
    }

}
