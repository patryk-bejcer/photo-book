@extends('layouts.app')

@section('content')

    @if (belongs_to_auth($user->id))
        {{--<a href="{{url('/users/' . $user->id . '/images/upload')}}" class="btn btn-primary">Dodaj zdjęcia</a>--}}
        {{--<a href="{{url('/users/' . $user->id . '/albums/create')}}" class="btn btn-secondary">Dodaj album</a>--}}
        <a href="{{url('/users/' . $user->id . '/albums/' . $album->id . '/edit')}}" class="btn btn-success">Edytuj ten album</a>
        <a onclick="event.preventDefault();document.getElementById('remove-album-form').submit();" href="{{url('/users/' . $user->id . '/albums/' . $album->id . '/edit')}}" class="btn btn-danger">Usuń ten album</a>

        <form id="remove-album-form" action="{{url('/users/' . $user->id . '/albums/' . $album->id )}}" method="POST" style="display: none;">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
        </form>
    @endif

    <h2 class="mt-3 mb-4"> <i class="fa fa-user-circle-o" aria-hidden="true"></i> {{ $user->name }}</h2>

    <h4 class="mt-3"> <i class="fa fa-photo" aria-hidden="true"></i> {{$album->title}} <a href="{{url('/users/' . $user->id)}}">{{ $user->name }}</a></h4>
    <hr>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="row justify-content-center " style="padding: 0 30px;">

        <ul id="gallery" class="list-unstyled row">
            @foreach($album->images as $image)
                @include('layouts.includes.image')
            @endforeach
        </ul>

        @foreach($album->images as $image)
            @include('layouts.includes.image-right-sidebar')
        @endforeach
    </div>

@endsection