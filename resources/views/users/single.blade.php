@extends('layouts.app')

@section('content')

    @include('users.includes.user')

    <a href="{{url('/users/' . $user->id . '/albums' )}}"><h4>Ostatnio dodane albumy</h4></a>
    <hr>

    <div class="row mb-4" style="padding: 0 15px;">

        @foreach($user->lastAlbums as $album)
            @include('layouts.includes.album')
        @endforeach
    </div>

    <a href="{{url('/users/' . $user->id . '/images' )}}"><h4>Ostatnio dodane zdjęcia</h4></a>
    <hr>

    <div class="row justify-content-center " style="padding: 0 30px;">

        <ul id="gallery" class="list-unstyled row">
            @foreach($user->lastImages as $image)
                @include('layouts.includes.image')
            @endforeach
        </ul>

        @foreach($user->lastImages as $image)
            @include('layouts.includes.image-right-sidebar')
        @endforeach
    </div>

@endsection