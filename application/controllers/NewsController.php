<?php

    require_once ROOT . '/application/models/News.php';

    class NewsController extends Controller {

        public function actionIndex(){
            $this->checkAccess();

            $this->view->setTitle('Новости');

            $this->view->setContent(News::load(0, 10));

            $this->view->setPage('news/index');
            $this->view->render('template');
        }

        public function actionAdd(){
            $this->checkAccess();

            $this->view->setTitle('Добавление новости');

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