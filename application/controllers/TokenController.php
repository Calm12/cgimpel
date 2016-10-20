<?php

    class TokenController extends Controller {

        public function actionIndex(){
            $this->checkAccess();

            $this->view->render("empty");
        }

    }