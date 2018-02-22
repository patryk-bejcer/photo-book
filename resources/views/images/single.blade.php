@extends('layouts.app')

@section('content')

    {{--@include('users.includes.user')--}}

    <div class="row">
        <a style="" class="btn btn-secondary btn-sm pull-right" href="{{url('/users/' . $user->id . '/images')}}">Powrót do profilu</a>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-9 no-padding">
            <img class="img-fluid hm-red-light" src="{{url('storage/users') . '/' . $image->user_id . '/images/' . $image->path }}">
        </div>
        <div class="col-md-3">
            @if($image->title)
                <h5 class="mt-3"><i class="fas fa-image"></i> {{$image->title}} </h5>
            @endif
            <h6 class="mt-3"><i class="fas fa-user"></i> Autor: <a href="{{url('/users/' . $user->id)}}">{{ $user->name }}</a></h6>

                @if($image->description)
            <p><small>Opis zdjęcia: {{$image->description}}</small></p>
                    @endif
        </div>
    </div>


@endsection