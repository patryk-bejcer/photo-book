@extends('layouts.app')

@section('content')

    <div class="row justify-content-center mb-4">

            <ul id="gallery" class="list-unstyled row">

                @foreach($images as $image)

                    <li data-toggle="modal" data-target="#modal_{{$image->id}}"  class="col-xs-6 col-sm-4 col-md-3 no-padding"  data-src="{{url('storage/users') . '/' . $image->user_id . '/images/' . $image->path }}">
                        <div class="view overlay hm-red-strong">
                            <img class="img-fluid hm-red-light" src="{{url('storage/users') . '/' . $image->user_id . '/images/' . 'thumb-' . $image->path }}">
                            <div class="mask flex-center">
                                <p class="white-text">Strong overlay</p>
                            </div>
                        </div>
                    </li>

                @endforeach

            </ul>

                @foreach($images as $image)

                    @include('layouts.includes.image-right-sidebar')

                @endforeach

    </div>


    <div class="row justify-content-center">
    {{ $images->links() }}
    </div>


@endsection
