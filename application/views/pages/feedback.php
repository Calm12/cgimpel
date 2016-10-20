<?php if(User::getUser()->getEmail() == ''): ?>
    <div class="content">
        К вашему аккаунту не привязана почта. Укажите ваш email в настройках!
    </div>
<?php endif; ?>

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