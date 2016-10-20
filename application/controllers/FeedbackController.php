<?php

    class FeedbackController extends Controller {

        public function actionIndex(){
            $this->checkAccess();

            $this->view->setTitle('Обратная связь');
            $this->view->setPage('feedback');
            $this->view->render('template');
        }

    }