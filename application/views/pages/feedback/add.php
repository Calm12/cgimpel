<?php if(User::getUser()->getEmail() == ''): ?>
    <div class="content">
        К вашему аккаунту не привязана почта. Укажите ваш email в настройках!
    </div>
<?php endif; ?>

<div class="content">
    <form action="javascript:add()">
        <textarea id="title" placeholder="Введите тему вашего сообщения..." maxlength="64" required></textarea>
        <textarea id="letter" placeholder="Введите текст вашего сообщения..." maxlength="4000" required></textarea>
        <button type="submit" class="flat_button">Отправить письмо</button>
    </form>
</div>
