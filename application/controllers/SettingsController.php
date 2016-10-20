<?php

    class SettingsController extends Controller {

        public function actionIndex(){
            $this->checkAccess();


            $this->view->render("empty");
        }

    }