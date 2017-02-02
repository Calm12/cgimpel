<? if($this->getProperty('news') !== null){ ?>

    <div class="content" id="post" data-id="<? echo $this->getProperty('news')->getId() ?>">
        <div class="control">
            <div class="actions_menu">
                <a class="actions_menu_item" href="/news/edit?id=<? echo $this->getProperty('news')->getId(); ?>">Редактировать</a>
                <a class="actions_menu_item" onclick="postDelete(this);">Удалить</a>
            </div>
        </div>

        <h1><? echo $this->getProperty('news')->getTitle(); ?></h1>
		<? echo $this->getProperty('news')->getBody(); ?>
        <br/>
        <div class="post_info"><? echo Date::convertDate($this->getProperty('news')->getDate()); ?> <a
                    href="/users/calm">@<? echo $this->getProperty('news')->getAuthor() ?></a></div>
        <div class="post_comments">
            <a id="comment_add">Комментировать</a>
        </div>
    </div>

	<? if($this->getContent() !== null){ ?>
        <div id="comments">
		<? foreach($this->getContent() as $key => $comment){ ?>

            <div class="comment_content" id="<? echo $comment->getId() ?>">
                <div class="control">
                    <div class="actions_menu">
                        <a class="actions_menu_item"
                           href="/news/edit?id=<? echo $this->getProperty('news')->getId() ?>">Пожаловаться</a>
                    </div>
                </div>
                <div class="comment_author"><a
                            href="/users/<? echo $comment->getAuthor() ?>">@<? echo $comment->getAuthor() ?></a></div>
				<? echo $comment->getBody(); ?>
                <br/>
                <div class="comment_info"><? echo Date::convertDate($comment->getDate()); ?></div>
            </div>

		<? } ?>
        </div>
	<? }?>

    <div class="comment_content" id="comment_add_area">
        <textarea id="comment_text" placeholder="Введите текст вашего комментария..." maxlength="4000" required></textarea>
        <div class="comment_add_control">
            <button type="button" id="flat_button">Отправить</button>
        </div>
    </div>

<? } ?>