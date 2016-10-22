<div class="content">
    Ниже отображены все активные тикеты.
</div>

<? if($this->getContent() !== null):?>

    <? foreach($this->getContent() as $key=>$article){ ?>

        <div class="content">

            <h1><? echo $article->getTitle(); ?></h1>
            <? echo $article->getBody(); ?>

        </div>

    <? } ?>

<? endif;?>