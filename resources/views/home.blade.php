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

                    <!-- Modal -->
                        <div class="modal single-image-rightbar fade" id="modal_{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Autor: <a href="{{url('/users/' . $image->user->id)}}">{{ $image->user->name }}</a></h5>
                                    </div>
                                    <div class="modal-body">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci et necessitatibus nemo quam quo quos repellat reprehenderit sapiente, temporibus velit? Asperiores cumque cupiditate ipsum laborum recusandae reprehenderit rerum vero! Recusandae!</p>

                                        <hr>

                                        <h6>Dodaj komentarz</h6>


                                        <form action="">
                                            <textarea name="" id="" cols="30" rows="20"></textarea>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

                @endforeach

    </div>



    <div class="row justify-content-center">
    {{ $images->links() }}
    </div>

    <script type="text/javascript">
        $(document).ready(function(){

            $('#gallery').lightGallery({
                counter: false,
                controls: false,
                mousewheel: false,
                enableSwipe: false,
                closable: false,
            });

            $('#gallery').lightGallery();

            var $lg = $('#gallery');

            $lg.lightGallery();

            // Perform any action just before opening the gallery
            $lg.on('onBeforeClose.lg',function(event){
                $(".single-image-rightbar").modal("hide");
            });

            // $lg.on('onBeforeNextSlide.lg',function(event){
            //     $(".single-image-rightbar").modal("hide");
            //     $("#modal_77").modal("show");
            // });


            // custom event with extra parameters
            // index - index of the slide
            // fromTouch - true if slide function called via touch event or mouse drag
            // fromThumb - true if slide function called via thumbnail click
            $lg.on('onBeforeSlide.lg',function(event, index, fromTouch, fromThumb){
                console.log(index, fromTouch, fromThumb);
            });
        });

    </script>


@endsection
