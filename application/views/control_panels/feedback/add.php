<div class="menu-bottom">
    <ul type="none">
        <a href="/feedback/">
            <li>Ваши тикеты</li>
        </a>
        <? if($this->controller->checkPermissions("/feedback/active")): ?>
            <a href="/feedback/active">
                <li>Активные тикеты</li>
            </a>
        <? endif; ?>
    </ul>
</div>