@extends('layouts.app')

@section('content')

    @include('users.includes.user')

    <a href="{{url('/users/' . $user->id . '/albums' )}}"><h4>Ostatnio dodane albumy</h4></a>
    <hr>

    <div class="row mb-4" style="padding: 0 15px;">

        @foreach($user->lastAlbums as $album)
            <div class="col-md-3 no-padding" style="padding:2px;">
                <a href="">
                    <img class="img-fluid" src="{{url('storage/users') . '/' . $user->id . '/images/' . $album->primary_image }}" alt="">
                </a>
            </div>
        @endforeach
    </div>

    <a href="{{url('/users/' . $user->id . '/images' )}}"><h4>Ostatnio dodane zdjęcia</h4></a>
    <hr>

    <div class="row" style="padding: 0 15px;">

        @foreach($user->lastImages as $image)
            <div class="col-md-3 no-padding" style="padding:2px;">
                <a href="">
                    <img class="img-fluid" src="{{url('storage/users') . '/' . $user->id . '/images/thumb-' . $image->path }}" alt="">
                </a>
            </div>
        @endforeach

    </div>

@endsection