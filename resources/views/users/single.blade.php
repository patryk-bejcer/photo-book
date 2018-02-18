@extends('layouts.app')

@section('content')
    <h3>Użytkownik: {{ $user->name }}</h3>
    <a href="{{url('/users/' . $user->id . '/images/upload')}}" class="btn btn-primary">Dodaj zdjęcia</a>
    <a href="{{url('/users/' . $user->id . '/albums/upload')}}" class="btn btn-secondary">Dodaj album</a>
@endsection