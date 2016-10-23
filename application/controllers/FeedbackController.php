<?php

    require_once ROOT . '/application/models/Ticket.php';
    require_once ROOT . '/core/Paginator.php';

    class FeedbackController extends Controller {

        public function actionIndex(){
            $this->checkAccess();

            $this->view->setTitle('Обратная связь');

            $this->setPaginator(new Paginator());
            $this->getPaginator()->setCount(Ticket::getCount(User::getUser()->getId()));
            $this->getPaginator()->setOffset((int)($_GET['o'] ?? 0));
            $this->getPaginator()->setSection((int)($_GET['s'] ?? 10));

            $this->view->setProperties(array(
                'count' => $this->getPaginator()->getCount(),
                'offset' => $this->getPaginator()->getOffset(),
                'section' => $this->getPaginator()->getOffset() + $this->getPaginator()->getSection(),
                'left' => Utils::gets('o',$this->getPaginator()->getLeftPointer()),
                'right' => Utils::gets('o',$this->getPaginator()->getRightPointer()),
            ));

            $this->view->setContent(Ticket::load($this->getPaginator()->getOffset(), $this->getPaginator()->getSection(), User::getUser()->getId()));

            $this->view->setMenu(array(
                '/feedback/new' => 'Создать тикет',
                '/feedback/active' => 'Активные тикеты',
            ));
            $this->view->setPage('feedback/index');
            $this->view->render('template');
        }

        public function actionActive(){
            $this->checkAccess();

            $this->view->setTitle('Активные тикеты');

            $this->setPaginator(new Paginator());
            $this->getPaginator()->setCount(Ticket::getCountAll());
            $this->getPaginator()->setOffset((int)($_GET['o'] ?? 0));
            $this->getPaginator()->setSection((int)($_GET['s'] ?? 10));

            $this->view->setProperties(array(
                'count' => $this->getPaginator()->getCount(),
                'offset' => $this->getPaginator()->getOffset(),
                'section' => $this->getPaginator()->getOffset() + $this->getPaginator()->getSection(),
                'left' => Utils::gets('o',$this->getPaginator()->getLeftPointer()),
                'right' => Utils::gets('o',$this->getPaginator()->getRightPointer()),
            ));

            $this->view->setContent(Ticket::loadAll($this->getPaginator()->getOffset(), $this->getPaginator()->getSection()));

            $this->view->setMenu(array(
                '/feedback/new' => 'Создать тикет',
                '/feedback/' => 'Ваши тикеты',
            ));
            $this->view->setPage('feedback/active');
            $this->view->render('template');
        }

        public function actionNew(){
            $this->checkAccess();

            $this->view->setTitle('Новое сообщение');

            $this->view->setMenu(array(
                '/feedback/' => 'Ваши тикеты',
                '/feedback/active' => 'Активные тикеты',
            ));
            $this->view->setPage('feedback/add');
            $this->view->render('template');
        }

        public function actionCreate(){
            $this->checkAccess();

            $title = $_POST['title'];
            $body = nl2br($_POST['body']);
            $author = User::getUser()->getId();

            if(Ticket::create($title, $body, $author)){
                echo 'created';
            }
        }

    }