@extends('layouts.app')

@section('content')

    @include('users.includes.user')

    <h4 class="mt-3"><i class="fas fa-images"></i> Albumy użytkownika <a href="{{url('/users/' . $user->id)}}">{{ $user->name }}</a></h4>
    <hr>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="row" style="padding: 0 15px;">

        @foreach($user->albums as $album)
            <div class="col-md-3 no-padding" style="padding:2px;">
                <a href="{{ url('/users/' . $user->id . '/albums/' . $album->id) }}">
                    <img title="{{$album->title}}" class="img-fluid" src="{{url('storage/users') . '/' . $user->id . '/images/' . $album->primary_image }}" alt="">
                </a>
            </div>
        @endforeach

    </div>

@endsection