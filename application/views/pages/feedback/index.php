<div class="content">
    Ниже отображены ваши открытые тикеты. Вы можете создать новый тикет, используя кнопку в нижнем меню.
</div>

<? if($this->getContent() !== null):?>

    <? foreach($this->getContent() as $key=>$article){ ?>

        <div class="content">
            <div class="control">
                <div class="actions_menu">
                    <a class="actions_menu_item" href="add.php">Удалить</a>
                    <a class="actions_menu_item" href="https://google.com/">Уйти</a>
                </div>
            </div>

            <h1><? echo $article->getTitle(); ?></h1>
            <? echo $article->getBody(); ?>

        </div>

    <? } ?>

<? endif;?>