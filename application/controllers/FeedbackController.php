<?php

    require_once ROOT . '/application/models/Ticket.php';

    class FeedbackController extends Controller {

        public function actionIndex(){
            $this->checkAccess();

            $this->view->setTitle('Обратная связь');

            $this->view->setContent(Ticket::load('0', '10', User::getUser()->getId()));

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

            $this->view->setContent(Ticket::loadAll('0', '10'));

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