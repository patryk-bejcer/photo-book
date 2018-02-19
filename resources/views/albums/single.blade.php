@extends('layouts.app')

@section('content')

    @include('users.includes.user')

    <h4 class="mt-3"><i class="fas fa-image"></i> {{$album->title}} <a href="{{url('/users/' . $user->id)}}">{{ $user->name }}</a></h4>
    <hr>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="row" style="padding: 0 15px;">

        @foreach($album->images as $image)
            <div class="col-md-2 no-padding" style="padding:2px;">
                <img class="img-fluid" src="{{url('storage/users') . '/' . $user->id . '/images/thumb-' . $image->path }}" alt="">
            </div>
        @endforeach

    </div>

@endsection