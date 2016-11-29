<?php

    require_once ROOT . '/application/models/News.php';
    require_once ROOT . '/core/Paginator.php';
	require_once ROOT .	'/application/models/Date.php';

    class NewsController extends Controller {

        public function actionIndex(){
            $this->checkAccess();

            $this->view->setTitle('Новости');

            $this->setPaginator(new Paginator());
            $this->getPaginator()->setCount(News::getCount());
            $this->getPaginator()->setOffset((int)($_GET['o'] ?? 0));
            $this->getPaginator()->setSection((int)($_GET['s'] ?? 10));

            $this->view->setProperties(array(
                'count' => $this->getPaginator()->getCount(),
                'offset' => $this->getPaginator()->getOffset(),
                'section' => $this->getPaginator()->getOffset() + $this->getPaginator()->getSection(),
                'left' => Utils::gets('o',$this->getPaginator()->getLeftPointer()),
                'right' => Utils::gets('o',$this->getPaginator()->getRightPointer()),
            ));

            $this->view->setContent(News::load($this->getPaginator()->getOffset(), $this->getPaginator()->getSection()));

            $this->view->setMenu(array(
                '/news/add' => 'Добавить новость',
                '/news/my' => 'Ваши новости',
            ));
            $this->view->setPage('news/index');
			try {
				$this->view->render('template');
			}
			catch(FileNotFoundException $ex){
				Logger::getRootLogger()->error($ex->getMessage());
			}
		}


        public function actionAdd(){ // можно сделать, чтобы панелька редактирования появлялась при нажатии на таб
            $this->checkAccess();

            $this->view->setTitle('Добавление новости');

            $this->view->setMenu(array(
                '/news/' => 'Все новости',
                '/news/my' => 'Ваши новости',
            ));
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

    }