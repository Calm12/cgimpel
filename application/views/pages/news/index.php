
<? if($this->getContent() !== null):?>

    <? foreach($this->getContent() as $key=>$article){ ?>

        <div class="content">

            <h1><? echo $article->getTitle(); ?></h1>
            <? echo $article->getBody(); ?>
            <div class="post_info"><? echo Date::convertDate($article->getDate()); ?> <a href="users/calm">@calm</a></div>

        </div>

    <? } ?>

<? endif;?>