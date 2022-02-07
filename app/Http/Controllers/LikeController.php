<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
   

    public function create($id)
    {

        $user = Auth::User();

        $like = Like::where('user_id', $user->id)->where('post_id', $id)->first();

        if ($like) {
            $like->State = !$like->State;
            $like->save();
        } else {
            $like = Like::create([
                "user_id" => $user->id,
                "post_id" => $id,
                "State" => true

            ]);
        }
        return back();

        // return Redirect::to('/');
    }
    //

}
