<?php

	require_once ROOT . '/application/models/News.php';
	require_once ROOT . '/application/models/NewsComment.php';
	require_once ROOT . '/core/Paginator.php';
	require_once ROOT . '/application/models/Date.php';

	class NewsController extends Controller{

		public function actionIndex(){
			$this->checkAccess();

			$this->view->setTitle('Новости');

			$this->setPaginator(new Paginator());
			$this->getPaginator()->setCount(News::getCount());
			$this->getPaginator()->setOffset((int)($_GET['o'] ?? 0));
			$this->getPaginator()->setSection((int)($_GET['s'] ?? 10));

			$this->view->setProperties(
				array(
					'count' => $this->getPaginator()->getCount(),
					'offset' => $this->getPaginator()->getOffset(),
					'section' => $this->getPaginator()->getOffset() + $this->getPaginator()->getSection(),
					'left' => Utils::gets('o', $this->getPaginator()->getLeftPointer()),
					'right' => Utils::gets('o', $this->getPaginator()->getRightPointer()),
				)
			);

			$this->view->setContent(
				News::load($this->getPaginator()->getOffset(), $this->getPaginator()->getSection())
			);

			$this->view->setMenu(
				array(
					'/news/add' => 'Добавить новость',
					'/news/my' => 'Ваши новости',
				)
			);
			$this->view->setPage('news/index');
			try{
				$this->view->render('template');
			}
			catch(FileNotFoundException $ex){
				Logger::getRootLogger()->error($ex->getMessage());
			}
		}

		public function actionPost(){
			$this->checkAccess();

			$id = (int)$_GET['id'];

			$this->setPaginator(new Paginator());
			$this->getPaginator()->setCount(NewsComment::getCount($id));
			$this->getPaginator()->setOffset((int)($_GET['o'] ?? 0));
			$this->getPaginator()->setSection((int)($_GET['s'] ?? 10));

			$this->view->setProperties(
				array(
					'count' => $this->getPaginator()->getCount(),
					'offset' => $this->getPaginator()->getOffset(),
					'section' => $this->getPaginator()->getOffset() + $this->getPaginator()->getSection(),
					'left' => Utils::gets('o', $this->getPaginator()->getLeftPointer()),
					'right' => Utils::gets('o', $this->getPaginator()->getRightPointer()),
				)
			);

			$this->view->setProperty('news', News::loadById($id));
			$this->view->setContent(
				NewsComment::load($id, $this->getPaginator()->getOffset(), $this->getPaginator()->getSection())
			);

			$this->view->setMenu(
				array(
					'/news/' => 'Все новости',
					'/news/add' => 'Добавить новость',
					'/news/my' => 'Ваши новости',
				)
			);

			try{
				$this->view->setTitle($this->view->getProperty('news')->getTitle());
			}
			catch(Error $ex){
				Logger::getRootLogger()->warn('News not found! ' . $ex->getMessage());
				$this->view->render('404');
				exit();
			}

			$this->view->setPage('news/post');
			$this->view->render('template');
		}

		public function actionAdd(){ // можно сделать, чтобы панелька редактирования появлялась при нажатии на таб
			$this->checkAccess();

			$this->view->setTitle('Добавление новости');

			$this->view->setMenu(
				array(
					'/news/' => 'Все новости',
					'/news/my' => 'Ваши новости',
				)
			);
			$this->view->setPage('news/add');
			$this->view->render('template');
		}

		public function actionCreate(){
			$this->checkAccess();

			$title = $_POST['title'];
			$body = nl2br($_POST['body']);
			$author = User::getUser()->getId();

			if(News::create($title, $body, $author)){
				echo 'created';
			}

		}

		public function actionCommentCreate(){
			$this->checkAccess();

			if($_POST['key'] === '79b3b448c88c46ea8be90b3a993c2313'){
				$post = $_POST['post'];
				$body = nl2br($_POST['body']);
				$author = User::getUser()->getId();

				if($id = NewsComment::create($body, $post, $author)){
					echo '{"response":"created", "comment":{"id":"' . $id . '", "body":"' . $body . '", "post":"' . $post . '", "author":"' . User::getUser()->getLogin() . '"}}';
				}
			}
			else{
				echo '{"response":"error", "code":"0", "body":"Access denied!"}';
			}

		}

		public function actionUpdate(){
			$this->checkAccess();

			$id = (int)$_POST['id'];
			$title = $_POST['title'];
			$body = nl2br($_POST['body']);

			if(News::edit($id, $title, $body)){
				echo 'updated';
			}
			else{
				echo 'err';
			}

		}

		public function actionEdit(){
			$this->checkAccess();

			$this->view->setTitle('Редактирование новости');

			$this->view->setMenu(
				array(
					'/news/' => 'Все новости',
					'/news/my' => 'Ваши новости',
				)
			);

			$id = (int)$_GET['id'];
			$this->view->setContent(News::loadById($id));

			$this->view->setProperties(
				array(
					'id' => $id,
				)
			);

			$this->view->setPage('news/edit');
			$this->view->render('template');
		}

		public function actionDelete(){
			$this->checkAccess();

			$id = (int)$_POST['id'];

			if(News::delete($id)){
				echo 'deleted';
			}
			else{
				echo 'err';
			}

		}

		public function actionRestore(){
			$this->checkAccess();

			$id = (int)$_POST['id'];

			if(News::restore($id)){
				echo 'restored';
			}
			else{
				echo 'err';
			}
		}

	}