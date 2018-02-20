@extends('layouts.app')

@section('content')

    <div class="row justify-content-center mb-4">

        <Addtobasket :user="{{ Auth::user() }}"></Addtobasket>

            <ul id="gallery" class="list-unstyled row">

                @foreach($images as $image)

                    @include('layouts.includes.image')

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
