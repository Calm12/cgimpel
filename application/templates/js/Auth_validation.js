function reg(){

    var login = document.getElementById('login');
    var email = document.getElementById('email');
    var password = document.getElementById('password');
    var confirm = document.getElementById('confirm');
    var msg = document.getElementById('msg');
    msg.innerHTML = '';

    if(!login.value.match(/^[a-z][a-z0-9]*?([-_][a-z0-9]+){0,2}$/i)){
        login.value = '';
        login.focus();
        msg.innerHTML = 'Логин некорректен.';
        return;
    }

    if(login.value.length < 4){
        login.value = '';
        login.focus();
        msg.innerHTML = 'Слишком короткий логин.';
        return;
    }

    if(!confirm.value.match(/^[a-z0-9]*?([-_][a-z0-9]+){0,2}$/i)){
        password.value = '';
        confirm.value = '';
        confirm.focus();
        msg.innerHTML = 'Пароль некорректен.';
        return;
    }

    if(confirm.value.length < 6){
        password.value = '';
        confirm.value = '';
        confirm.focus();
        msg.innerHTML = 'Слишком короткий пароль.';
        return;
    }

    if(password.value != confirm.value){
        password.value = '';
        confirm.value = '';
        confirm.focus();
        msg.innerHTML = 'Пароли не совпадают.';
        return;
    }

    $.ajax({
        type: 'POST',
        url: '/reg/check/',
        data: {
            login: login.value,
            email: email.value,
            password: confirm.value
        },
        success: function(res) {
            if(res === 'registered'){
                //window.location.href = '/';
                msg.style.color = 'lime';
                password.value = '';
                confirm.value = '';
                msg.innerHTML = 'Ваш аккаунт создан. Удачи!';
            }
            else{
                msg.innerHTML = res;
            }
        }
    });
}


function loginCheck() {
    var login = document.getElementById('login');
    var msg = document.getElementById('msg');
    msg.style.color = '#f00';

    if(login.value.length == 0){
        return;
    }
    if((!login.value.match(/^[a-z][a-z0-9]*?([-_][a-z0-9]+){0,2}$/i)) || (login.value.length < 4)){
        login.value = '';
        login.focus();
        msg.innerHTML = 'Логин некорректен.';
        return;
    }

    $.ajax({
        type: 'POST',
        url: '/reg/logincheck/',
        data: {
            login: login.value
        },
        success: function(res) {
            if(res === 'exists'){
                msg.innerHTML = 'Логин ' + login.value + ' занят.';
            }
            else if(res === 'free'){
                msg.innerHTML = '';
            }
        }
    });

}


function auth(){
    var login = document.getElementById('login').value;
    var password = document.getElementById('password').value;
    document.getElementById('msg').innerHTML = ' ';

    $.ajax({
        type: 'POST',
        url: '/auth/check/',
        data: {
            login: login,
            password: password
        },
        success: function(res) {
            if(res === 'authorised'){
                window.location.href = '/';
            }
            else{
                document.getElementById('password').value = '';
                document.getElementById('msg').innerHTML = res;
            }
        }
    });
}
