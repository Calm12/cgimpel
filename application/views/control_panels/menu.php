<? if($this->getMenu() !== null): ?>

    <div class="menu-bottom">
        <ul type="none">

            <? foreach($this->getMenu() as $uri => $name){ ?>

                <? if($this->controller->checkPermissions($uri)): ?>

                    <a href="<? echo $uri ?>">
                        <li><? echo $name ?></li>
                    </a>

                <? endif; ?>

            <? } ?>
        </ul>
    </div>

<? endif; ?>
