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
            <div class="col-sm-4 col-sm-offset-1">
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
            <div class="col-sm-4 col-sm-offset-1">
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

            <div class="col-sm-10 col-sm-offset-1">

                <div>
                    <a style="margin-left: -1px;" class="btn btn-primary" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Kliknij aby wykorzystać już wcześniej dodane zdjęcia
                    </a>
                </div>

                <div class="collapse" id="collapseExample">
                    <div class="mt-3">
                        <div class="row" style="padding:0 10px;">

                            @foreach(Auth::user()->images as $image)

                                <div class="col-md-2 no-padding" style="padding:2px;">

                                    <label class="image-checkbox">
                                        <img class="img-responsive" src="{{url('storage/users') . '/' . $image->user_id . '/images/' . 'thumb-' . $image->path }}" />
                                        <input type="checkbox" name="check_image[]" value="{{$image->id}}" />
                                    </label>

                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="row mt-4" style="margin-left: -1px">
            <input style="margin-left: -1px"  type="submit" value="Zapisz album" class="btn btn-secondary pull-right">
        </div>

    </form>


    <script>
        // image gallery
        // init the state from the input
        $(".image-checkbox").each(function () {
            if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
                $(this).addClass('image-checkbox-checked');
            }
            else {
                $(this).removeClass('image-checkbox-checked');
            }
        });

        // sync the state to the input
        $(".image-checkbox").on("click", function (e) {
            $(this).toggleClass('image-checkbox-checked');
            var $checkbox = $(this).find('input[type="checkbox"]');
            $checkbox.prop("checked",!$checkbox.prop("checked"))

            e.preventDefault();
        });
    </script>

@endsection