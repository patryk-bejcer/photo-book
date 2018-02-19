@extends('layouts.app')

@section('content')
    <h4>Dodawanie nowego albumu</h4>

    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <form action="{{url('/users/' . $user->id . '/albums/create')}}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                    <label for="">Wybierz zdjęcia które chcesz dodać (.jpg) </label>
                    <input type="text" name="name" id="name" placeholder="Nazwa albumu">

                    @if ($errors->has('primaryImage'))
                        <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                    @endif

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                    <label for="">Wybierz zdjęcie głowne albumu </label>
                    <input name="primary_image" type="file" class="form-control upload-input" placeholder="Wybierz zdjęcie główne" accept=".jpg,.jpeg" multiple>

                    @if ($errors->has('primaryImage'))
                        <span class="help-block">
                                                <strong>{{ $errors->first('primaryImage') }}</strong>
                                            </span>
                    @endif

                </div>
            </div>
        </div>

        <div class="row">
            <input type="submit" class="btn btn-secondary right">
        </div>

    </form>

@endsection