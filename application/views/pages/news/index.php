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
			<div class="post_info"><? echo Date::convertDate($article->getDate()); ?> <a
					href="users/calm">@<? echo $article->getAuthor() ?></a></div>

		</div>

	<? } ?>

<? endif; ?>