<div class="modal single-image-rightbar fade" id="modal_{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Autor: <a href="{{url('/users/' . $image->user->id)}}">{{ $image->user->name }}</a></h5>
            </div>
            <div class="modal-body">

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci et necessitatibus nemo quam quo quos repellat reprehenderit sapiente, temporibus velit? Asperiores cumque cupiditate ipsum laborum recusandae reprehenderit rerum vero! Recusandae!</p>
                <hr>

                @if(Auth::user())
                    <h6>Dodaj komentarz</h6>
                    <form action="">
                        <textarea name="" id="" cols="30" rows="20"></textarea>
                    </form>
                @endif

            </div>
        </div>
    </div>
</div>