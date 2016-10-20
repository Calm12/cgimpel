<?php

    require_once ROOT . '/application/models/User.php';
    require_once ROOT . '/application/models/Token.php';

    class Controller {
        public $view;

        public function __construct(){
            $this->view = new View();
        }

        public function checkAccess(){
            if(!$this->authorised()){
                $this->view->render("auth");
                exit();
            }
        }

        public function authorised() : bool{
            if(User::getUser() === null){
                return false;
            }
            else{
                return true;
            }
        }

        public function actionIndex(){

        }
    }