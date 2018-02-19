@extends('layouts.app')

@section('content')


    <div class="row justify-content-center mb-4">

    @foreach($images as $image)



                <div class="col-md-3 no-padding" style="padding:2px;">
                    <div class="">
                        {{--<div class="card-header">--}}
                            {{--<a href="{{url('users/' . $image->user_id )}}">{{ $image->user->name }}</a>--}}
                        {{--</div>--}}

                        <div class="single-img">
                            <img class="img-fluid" src="{{url('storage/users') . '/' . $image->user_id . '/images/' . 'thumb-' . $image->path }}" alt="">
                        </div>

                    </div>
                </div>

    @endforeach


    </div>

    <div class="row justify-content-center">
    {{ $images->links() }}
    </div>


@endsection
