
jQuery(document).ready(function($){

    $("body").keydown(function(event){

        if( event.keyCode == 37 ){
            window.location.href = document.getElementById('left').getAttribute('href');
        }

        if( event.keyCode == 39 ){
            window.location.href = document.getElementById('right').getAttribute('href');
        }

    });

    /*$(".control").mouseover(function (event) {
        $(".actions_menu").css('visibility', 'visible');
    });

    $(".control").mouseout(function (event) {
        $(".actions_menu").css('visibility', 'hidden');
    })*/

    $('.control').hover(function(){
        $('.block2').addClass('when_block1_hover');
    }, function(){
        $('.block2').removeClass('when_block1_hover');
    })

});