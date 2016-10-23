<div class="menu-middle">
        <div class="menu-text">Новостей: <? echo $this->getProperty('count'); ?></div>
        <div class="menu-text">Показано: <? echo $this->getProperty('offset'); ?>-<? echo $this->getProperty('section'); ?></div>
        <a id="left" href="<? echo $this->getProperty('left'); ?>"><div class="menu-item">&lt;&lt;&lt;Туда</div></a><a id="right" href="<? echo $this->getProperty('right'); ?>"><div class="menu-item">Сюда&gt;&gt;&gt;</div></a>
</div>

<div class="horizontal-separator">
    <hr>
</div>
