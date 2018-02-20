@extends('layouts.app')

@section('content')

    @if (belongs_to_auth($user->id) || Auth::user()->hasRole('Administrator'))
        {{--<a href="{{url('/users/' . $user->id . '/images/upload')}}" class="btn btn-primary">Dodaj zdjęcia</a>--}}
        {{--<a href="{{url('/users/' . $user->id . '/albums/create')}}" class="btn btn-secondary">Dodaj album</a>--}}
        <a href="{{url('/users/' . $user->id . '/albums/' . $album->id . '/edit')}}" class="btn btn-success">Edytuj ten album</a>
    @endif

    <h2 class="mt-3 mb-4"><i class="fas fa-user"></i> {{ $user->name }}</h2>

    <h4 class="mt-3"><i class="fas fa-image"></i> {{$album->title}} <a href="{{url('/users/' . $user->id)}}">{{ $user->name }}</a></h4>
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