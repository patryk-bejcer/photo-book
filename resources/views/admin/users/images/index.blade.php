@extends('layouts.admin')

@section('title', '| Zarządzanie zdjęciami ')

@section('content')

    <div class="col-lg-9 col-lg-offset-1">
        <h1><i class="fa fa-users"></i> Zdjęcia użytkownika {{$user->name}}</h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                <tr>
                    <th>Tytuł</th>
                    <th>Alt</th>
                    <th>Opis</th>
                    <th>Komentarze</th>
                    <th>Oceny</th>
                    <th>Data</th>
                    <th>Zdjęcie</th>
                    <th>Operacje</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($user->imagesWithPaginate as $image)
                    <tr>
                        <td>{{ $image->title }}</td>
                        <td>{{ $image->alt }}</td>
                        <td>{{ $image->description }}</td>
                        <td>@if($image->comments == 1) Tak @else Nie @endif</td>
                        <td>@if($image->rating == 1) Tak @else Nie @endif</td>
                        <td>{{ $image->created_at->format('F d, Y h:ia') }}</td>
                        <td><img style="max-height: 150px;" class="img-fluid" src="{{url('storage/users') . '/' . $image->user_id . '/images/' . 'thumb-' . $image->path }}" alt=""></td>
                        <td style="min-width: 150px;">
                            <a href="" class="btn btn-info pull-left mb-3"  style="margin-right: 3px;">Edycja</a>
                            <a onclick="event.preventDefault();document.getElementById('remove-image-form').submit();"  class="btn btn-danger">Usuń</a>
                            <form id="remove-image-form" action="{{url('/users/' . $user->id . '/images/' . $image->id )}}" method="POST" style="display: none;">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

    </div>

@endsection