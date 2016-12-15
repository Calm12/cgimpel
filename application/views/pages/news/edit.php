
<div class="content">
    <form action="javascript:update()">
        <textarea id="newstitle" placeholder="Заголовок" maxlength="64" required><? echo $this->getContent()->getTitle() ?></textarea>
        <textarea id="letter" placeholder="Введите текст новости..." maxlength="4000" required><? echo str_replace('<br />', '', $this->getContent()->getBody()) ?></textarea>
        <input hidden id="id" value="<? echo $this->getContent()->getId() ?>"/>
        <button type="submit" class="flat_button">Сохранить</button>
    </form>
</div>
