<?php

    class FeedbackController extends Controller {

        public function actionIndex(){
            $this->checkAccess();

            $this->view->render('feedback');
        }

    }