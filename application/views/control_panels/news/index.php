<div class="menu-middle">
    <div class="menu-item">Новостей: 317</div>
    <div class="menu-item">Показано: 0-3</div>
    <a href="?offset=0"><span class="menu-item">&lt;&lt;&lt;Туда</span></a><a href="?offset=3"><span class="menu-item">Сюда&gt;&gt;&gt;</span></a>
</div>

<div class="horizontal-separator">
    <hr>
</div>

<div class="menu-bottom">
    <ul type="none">
        <? if($this->controller->checkPermissions("/news/add")): ?>
            <a href="/news/add">
                <li>Добавить новость</li>
            </a>
        <? endif; ?>
        <a href="/news/my">
            <li>Ваши новости</li>
        </a>
    </ul>
</div>