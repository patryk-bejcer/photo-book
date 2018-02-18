@extends('layouts.app')

@section('content')
    <h3>Użytkownik: {{ $user->name }}</h3>
    <a href="{{url('/users/' . $user->id . '/images/upload')}}" class="btn btn-primary">Dodaj zdjęcia</a>
    <a href="{{url('/users/' . $user->id . '/albums/upload')}}" class="btn btn-secondary">Dodaj album</a>

    <br><br>

    <h4>Albumy</h4>

    <hr>

    <h4>Zdjęcia</h4>

    <hr>

    <div class="row">

        @foreach($user->images as $image)
            <div class="col-md-3 no-padding" style="padding:2px;">
                <img class="img-fluid" src="{{url('storage/users') . '/' . $user->id . '/images/' . $image->path }}" alt="">
            </div>
        @endforeach

    </div>

@endsection