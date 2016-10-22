<?php

    class FeedbackController extends Controller {

        public function actionIndex(){
            $this->checkAccess();

            $this->view->setTitle('Обратная связь');
            $this->view->setPage('feedback');
            $this->view->render('template');
        }

        public function actionCreate(){
            $this->checkAccess();

            //$title = $_POST['title'];
            $body = nl2br($_POST['body']);
            $author = User::getUser()->getId();

            if(Ticket::create($title, $body, $author)){
                echo 'created';
            }
        }

    }