<?php

    require_once ROOT . '/application/models/News.php';

    class NewsController extends Controller { // можно сравнивать в checkAcess $_SERVER['REQUEST_URI'] с таблицей прав

        public function actionIndex(){
            $this->checkAccess();

            $this->view->setTitle('Новости');

            $this->view->setContent(News::load('0', '10'));

            $this->view->setPage('news');
            $this->view->render('template');
        }

        public function actionAdd(){
            $this->checkAccess();

            $this->view->setTitle('Добавление новости');

            $this->view->setPage('newsadd');
            $this->view->render('template');
        }

        public function actionCreate(){
            $title = $_POST['title'];
            $body = nl2br($_POST['body']);

            if(News::create($title, $body)){
                echo 'created';
            }
        }
    }