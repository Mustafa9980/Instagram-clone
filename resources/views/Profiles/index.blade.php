@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-3 p-5 pt-2">
        

                <img src="{{$user->profile->profileImage()}}" class="rounded-circle w-100">
                
            </div>
            <div class="col-9 pt-5">
                <div class="d-flex justify-content-between align-items-baselin ">

                    <div class="d-flex align-items-center pb-3 ">
                        <div class="h4 fw-bolder">{{ $user->username }}</div>
    
                        <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                    </div>                    

                    @can('update',$user->profile)
                        <a href="/p/create">Add New Post</a>
                    @endcan
                </div>
                @can('update', $user->profile)
                    <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
                @endcan

                <div class="d-flex">
                <div class="px-3"><strong>{{ $postCount }}</strong>posts</div> 
                <div class="px-3"><strong>{{ $followersCount }}</strong> followers</div>
                <div class="px-3"><strong>{{$followingCount}}</strong> following</div>
                </div>
            
            <div class="pt-4  fw-bold">{{ $user->profile->title }}</div>
            <p> {{ $user->profile->description }}</p>
            <div><a href="#">{{ $user->profile->url }}</a></div>

            <div class="row pt-5">
                @foreach ($user->posts as $post)
                    <div class="col-4 pb-4">
                        <a href="/p/{{ $post->id }}">
                            <img src="/storage/{{ $post->image }}" class="w-100">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
    </div>
    </div>
    </div>
@endsection
