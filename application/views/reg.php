<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="/application/templates/images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="/application/templates/css/auth.css" />
    <script type="text/javascript" src="/application/templates/js/jquery-1.11.1.min.js"></script>
    <script src="/application/templates/js/Auth_validation.js"></script>
    <title>Регистрация — CGimpel</title>
</head>

<body>
    <div id="auth-form">
      <h1>РЕГИСТРАЦИЯ</h1>
        <fieldset>
			<div id="msg">
            </div>
            <form action="javascript:reg()" method="post">
                <input type="text" id="login" required autofocus onBlur="javascript:loginCheck()" placeholder="Логин" maxlength="32"/>
				<input type="email" id="email" required placeholder="E-mail" maxlength="64"/>
                <input type="password" id="confirm" required placeholder="Пароль" maxlength="32"/>
				<input type="password" id="password" required placeholder="Повторный ввод пароля" maxlength="32"/>
                <input type="submit" value="РЕГИСТРАЦИЯ">
				<input type="button" value="АВТОРИЗАЦИЯ" onclick="window.location.href='/auth/'">
            </form>
        </fieldset>
		
    </div> 
</body>
</html>