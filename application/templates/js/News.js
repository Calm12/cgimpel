$(document).ready(function() {

    $('#comment_add').click(function(){
        $('body,html').animate({scrollTop: $(document).outerHeight(true)}, 400);
        $('#comment_add_area').fadeIn(400);
        $('#comment_text').focus();
    });

    $('#flat_button').click(function (){

        var body = $('#comment_text').val();
        var post = $('#post').data('id');

        $.ajax({
            type: 'POST',
            url: '/news/commentcreate',
            data: {
                post: post,
                body: body,
                key: '79b3b448c88c46ea8be90b3a993c2313'
            },
            success: function(res) {
                var response = JSON.parse(res.replace(/\n/g, "\\n"));
                if(response.response === 'created'){
                    $('#comment_text').val('');
                    var child = '<div class="comment_content" id="'+response.comment.id+'">' +
                        '<div class="control"><div class="actions_menu"><a class="actions_menu_item" href="/">Пожаловаться</a></div></div>' +
                        '<div class="comment_author"><a href="/users/'+response.comment.author+'">@'+response.comment.author+'</a>' +
                        '</div>'+response.comment.body+'<br><div class="comment_info">только что</div></div>';

                    $('#comments').append(child);

                    $('body,html').animate({scrollTop: 0}, 400);
                    $('#comment_add_area').fadeOut(400);
                }
                else{
                    alert('Ошибка. И вообще надо сделать popup для таких сообщений епт');
                }
            }
        });

    });

});

function add(){

    var title = document.getElementById('newstitle');
    var body = document.getElementById('letter');

    $.ajax({
        type: 'POST',
        url: '/news/create',
        data: {
            title: title.value,
            body: body.value
        },
        success: function(res) {
            if(res === 'created'){
                window.location.href = '/news/';
            }
            else{
                alert('Ошибка. И вообще надо сделать popup для таких сообщений епт');
            }
        }
    });
}

function postDelete(el) {

    var id = el.parentNode.parentNode.parentNode.id;

    if (confirm('Удалить новость?')) {
        $.ajax({
            type: 'POST',
            url: '/news/delete',
            data: {
                id: id
            },
            success: function (res) {
                if (res === 'deleted') {
                    document.getElementById(id).innerHTML = 'Новость удалена. <a onclick="postRestore(this);">Вернуть</a>';
                }
                else {
                    alert('Ошибка удаления');
                }
            }
        });
    }

}

function postRestore(el) {

    var id = el.parentNode.id;

    $.ajax({
        type: 'POST',
        url: '/news/restore',
        data: {
            id: id
        },
        success: function (res) {
            if (res === 'restored') {
                window.location.reload();
            }
            else {
                alert('Ошибка восстановления');
            }
        }
    });

}

