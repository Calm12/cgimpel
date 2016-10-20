<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="shortcut icon" href="/application/templates/images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="/application/templates/css/news.css"/>
    <title>Обратная связь — CGimpel</title>
</head>
<body>
<div class="wrapper">

    <div class="container">
        <main class="main">
            <?php if(Session::get('user')->getEmail() == ''):?>
            <div class="content">
                К вашему аккаунту не привязана почта. Укажите ваш email в настройках!
            </div>
            <?php endif;?>

            <div class="content">
                <form>
                    <textarea id="letter" placeholder="Введите текст вашего сообщения..." maxlength="4000" required></textarea>
                    <button class="flat_button" onclick="">Отправить письмо</button>
                </form>
            </div>

            <!--div class="footer">
                <hr>
                CGimpel.ru (c) 2014-2016
            </div-->
        </main><!-- .content -->
    </div><!-- .container-->

    <aside class="left-sidebar">
        <?php include 'parts/menu.php' ?>
    </aside><!-- .left-sidebar -->

</div><!-- .wrapper -->
</body>
</html>