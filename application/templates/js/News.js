$(document).ready(function() {

    $('#comment_add').click(function(){
        $('body,html').animate({scrollTop: $(document).outerHeight(true)}, 400);
        $('#comment_add_area').fadeIn(400);
        $('#comment_text').focus();
    });

    $('#flat_button').click(function (){

        var body = $('#comment_text').val();
        var post = $('#post').data('id');

        if(body !== ''){
            $.ajax({
                type: 'POST',
                url: '/news/commentcreate',
                data: {
                    post: post,
                    body: body,
                    key: '79b3b448c88c46ea8be90b3a993c2313'
                },
                beforeSend: function(){
                    $('#flat_button').html('<div class="button_animation_container">&nbsp;</div>');
                    $('#flat_button').addClass('button_animation');
                },
                success: function (res) {
                    $('#flat_button').html('Отправить');
                    $('#flat_button').removeClass('button_animation');
                    var response = JSON.parse(res.replace(/\n/g, "\\n"));
                    if (response.response === 'created') {
                        $('#comment_text').val('');
                        var child = '<div class="comment_content" id="' + response.comment.id + '">' +
                            '<div class="control"><div class="actions_menu"><a class="actions_menu_item" onclick="commentEditShow(this);">Редактировать</a>' +
                            '<a class="actions_menu_item" onclick="commentDelete(this);">Удалить</a></div></div>' +
                            '<div class="comment_author"><a href="/users/' + response.comment.author + '">@' + response.comment.author + '</a>' +
                            '</div>' + response.comment.body + '<br><div class="comment_info">только что</div></div>';

                        $('#comments').append(child);

                        //$('body,html').animate({scrollTop: 0}, 400); // по просьбе сиськи
                        $('#comment_add_area').fadeOut(400);
                    }
                    else {
                        alert('Ошибка. И вообще надо сделать popup для таких сообщений епт');
                    }
                }
            });
        }
        else{
            alert('слыш псина');
        }

    });

});

var comment = '';
var editing = false;

function commentEditShow(el){
    if(!editing) {
        var box = el.parentNode.parentNode.parentNode;
        var id = box.id;
        comment = box.innerHTML;
        var body = box.getElementsByClassName('body')[0].innerHTML;

        box.innerHTML = '<textarea id="comment_text_edit" class="comment_text" placeholder="Введите текст вашего комментария..." maxlength="4000" required>' + body.replace(/<br\s*[\/]?>/gi, "\n") + '</textarea> ' +
            '<div class="comment_add_control"> ' +
            '<button type="button" id="edit_button" class="flat_button_comments" onclick="commentEditHide(this)">Сохранить</button> ' +
            '</div>';

        editing = true;
    }
}

function commentEditHide(el){
    var box = el.parentNode.parentNode;
    var body = box.getElementsByTagName('textarea')[0].value;
    var id = box.id;

    $.ajax({
        type: 'POST',
        url: '/news/commentupdate',
        data: {
            id: id,
            body: body
        },
        success: function (res) {
            if (res === 'updated') {
                box.innerHTML = comment;
                box.getElementsByClassName('body')[0].innerHTML = body.replace(/([^>])\n/g, '$1<br/>');
                editing = false;
            }
            else {
                console.log('Ошибка сохранения '+res);
            }
        }
    });
}

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

function postViewDelete(el) {

    var id = el.parentNode.parentNode.parentNode.dataset.id;

    if (confirm('Удалить новость?')) {
        $.ajax({
            type: 'POST',
            url: '/news/delete',
            data: {
                id: id
            },
            success: function (res) {
                if (res === 'deleted') {
                    document.getElementById('post').innerHTML = 'Новость удалена. <a onclick="postViewRestore(this);">Вернуть</a>';
                }
                else {
                    alert('Ошибка удаления');
                }
            }
        });
    }

}

function commentDelete(el){
    var id = el.parentNode.parentNode.parentNode.id;
    if (confirm('Удалить комментарий?')) {
        $.ajax({
            type: 'POST',
            url: '/news/commentdelete',
            data: {
                id: id
            },
            success: function (res) {
                if (res === 'deleted') {
                    document.getElementById(id).innerHTML = 'Комментарий удален. <a onclick="commentRestore(this);">Вернуть</a>';
                }
                else {
                    alert('Ошибка удаления '+res);
                }
            }
        });
    }
}

function commentRestore(el) {

    var id = el.parentNode.id;

    $.ajax({
        type: 'POST',
        url: '/news/commentrestore',
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

function postViewRestore(el) {

    var id = el.parentNode.dataset.id;

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
