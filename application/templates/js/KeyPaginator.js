
jQuery(document).ready(function($){

    $("body").keydown(function(event){

        if( event.keyCode == 37 ){
            window.location.href = document.getElementById('left').getAttribute('href');
        }

        if( event.keyCode == 39 ){
            window.location.href = document.getElementById('right').getAttribute('href');
        }

    });

});
/*
$("#left").click(function() {
    window.location.href = document.getElementById('left').getAttribute('href');
});

$("#right").click(function() {
    window.location.href = document.getElementById('right').getAttribute('href');
});*/