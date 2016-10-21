
<? if($this->getContent() !== null):?>

    <? foreach($this->getContent() as $key=>$article){ ?>

        <div class="content">

            <h1><? echo $article->getName(); ?></h1>
            <? echo $article->getBody(); ?>

        </div>

    <? } ?>

<? endif;?>