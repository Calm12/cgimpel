<? if($this->getContent() !== null): ?>

	<? foreach($this->getContent() as $key => $article){ ?>

		<div class="content" id="<? echo $article->getId() ?>">
			<div class="control">
				<div class="actions_menu">
					<a class="actions_menu_item" href="/news/edit?id=<? echo $article->getId() ?>">Редактировать</a>
					<a class="actions_menu_item" onclick="postDelete(this);">Удалить</a>
				</div>
			</div>

			<h1><? echo $article->getTitle(); ?></h1>
			<? echo $article->getBody(); ?>
			<br/>
			<div class="post_info"><? echo Date::convertDate($article->getDate()); ?> <a
					href="/users/<? echo $article->getAuthor() ?>">@<? echo $article->getAuthor() ?></a></div>
			<div class="post_comments">
                <a href="/news/post?id=<? echo $article->getId() ?>">
                    <div class="comments_icon"></div>
                    <!--img src="/application/templates/images/comments.png" style="vertical-align: middle;" width="20" height="18" alt="Комментировать"/-->
                    <? echo NewsComment::getCount($article->getId()); ?>
                </a>
            </div>

		</div>

	<? } ?>

<? endif; ?>