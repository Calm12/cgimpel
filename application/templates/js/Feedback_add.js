function add(){

    var title = document.getElementById('title');
    var body = document.getElementById('letter');

    $.ajax({
        type: 'POST',
        url: '/feedback/create',
        data: {
            title: title.value,
            body: body.value
        },
        success: function(res) {
            if(res === 'created'){
                window.location.href = '/feedback/';
            }
            else{
                alert('Ошибка. И вообще надо сделать popup для таких сообщений епт');
            }
        }
    });
}

jQuery(document).ready(function($){

    /* Вставляем tab при нажатии на tab в поле textarea
     ---------------------------------------------------------------- */
    $("#letter").keydown(function(event){
        // выходим если это не кропка tab
        if( event.keyCode != 9 )
            return;

        event.preventDefault();

        // Opera, FireFox, Chrome
        var
            obj = $(this)[0],
            start = obj.selectionStart,
            end = obj.selectionEnd,
            before = obj.value.substring(0, start),
            after = obj.value.substring(end, obj.value.length);

        obj.value = before + "\t" + after; //'&nbsp;&nbsp;&nbsp;&nbsp;'

        // устанавливаем курсор
        obj.setSelectionRange(start+1, start+1);
    });

});

/*$("#btn-p").click(function() {
    var tag = "p";
    $('textarea').val("<" + tag + ">" + $('textarea').val() + "</" + tag + ">");
});*/