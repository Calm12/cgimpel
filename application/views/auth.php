<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="shortcut icon" href="/application/templates/images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="/application/templates/css/auth.css" />
    <script type="text/javascript" src="/application/templates/js/jquery-1.11.1.min.js"></script>
    <script src="/application/templates/js/Auth_validation.js"></script>
    <title>Авторизация — CGimpel</title>
</head>

<body>
    <div id="auth-form">
      <h1>АВТОРИЗАЦИЯ</h1>
        <fieldset>
			<div id="msg"></div>
            <form action="javascript:auth()" method="post">
                <input type="text" id="login" required autofocus placeholder="Логин" maxlength="32"/>
                <input type="password" id="password" required placeholder="Пароль" maxlength="32"/>
                <input type="submit" value="ВОЙТИ"/>
				<input type="button" value="РЕГИСТРАЦИЯ" onclick="window.location.href='/reg/'"/>
            </form>
        </fieldset>
    </div> 
</body>
</html>