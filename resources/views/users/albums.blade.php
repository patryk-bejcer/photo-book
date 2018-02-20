@extends('layouts.app')

@section('content')

    @include('users.includes.user')

    <h4 class="mt-3"><i class="fas fa-images"></i> Albumy użytkownika <a href="{{url('/users/' . $user->id)}}">{{ $user->name }}</a></h4>
    <hr>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="row mb-4" style="padding: 0 15px;">
        @foreach($user->albums as $album)
            @include('layouts.includes.album')
        @endforeach
    </div>

@endsection