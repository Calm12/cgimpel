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