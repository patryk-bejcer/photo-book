
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

        $lg.on('onBeforeClose.lg',function(event){
            $(".single-image-rightbar").modal("hide");
        });

    });
