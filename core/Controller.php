<?php

    require_once ROOT . '/application/models/User.php';
    require_once ROOT . '/application/models/Token.php';

    class Controller {
        public $view;

        public function __construct(){
            $this->view = new View($this);
        }

        public function checkAccess(){
            if(!$this->authorised()){
                $this->view->render("auth");
                exit();
            }

            if(!$this->checkPermissions(Utils::getUri())){
                header("Location: /");
                exit();
            }
        }

        public function checkPermissions($uri) : bool{
            if(User::getUser()->getAccessLevel() < Permissions::getPermission($uri)){
                return false;
            }
            else{
                return true;
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