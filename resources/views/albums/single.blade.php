@extends('layouts.app')

@section('content')

    @include('users.includes.user')

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