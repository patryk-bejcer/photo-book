@extends('layouts.app')

@section('content')
    <h4>Dodawanie nowych zdjęć</h4>

    <form action="{{url('/users/' . $user->id . '/images/upload')}}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                    <label for="">Wybierz zdjęcia które chcesz dodać (.jpg) </label>
                    <input name="images[]" type="file" class="form-control upload-input" placeholder="Wybierz zdjęcia" accept=".jpg,.jpeg" multiple>

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