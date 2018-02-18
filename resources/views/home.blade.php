@extends('layouts.app')

@section('content')



<div class="container">

    <Addtobasket></Addtobasket>

    <div class="row justify-content-center mb-4">

    @foreach($images as $image)



                <div class="col-md-4 mb-4">
                    <div class="card card-default">
                        <div class="card-header">
                            <a href="{{url('users/' . $image->user_id )}}">{{ $image->user->name }}</a>
                        </div>

                        <div class="card-body">
                                <div class="single-img mb-4">
                                    <img class="img-fluid" src="{{url('storage/users') . '/' . $image->user_id . '/images/' . $image->path }}" alt="">
                                </div>
                        </div>

                    </div>
                </div>

    @endforeach


    </div>

    <div class="row justify-content-center">
    {{ $images->links() }}
    </div>
</div>
@endsection
