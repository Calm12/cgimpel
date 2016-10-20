<?php

    class RegController extends Controller {

        public function actionIndex(){
            if(!$this->authorised()){
                $this->view->render('reg');
            }
            else{
                header("Location: /");
                exit();
            }
        }

        public function actionCheck(){
            if(!isset($_POST['login'])){
                exit();
            }
            $login = trim(htmlspecialchars(stripslashes($_POST['login'])));
            $email = trim(htmlspecialchars(stripslashes($_POST['email'])));
            $password = md5($_POST['password']);

            if(User::loginCheck($login) === false){
                $result = User::create($login, $email, $password);
                if($result){
                    echo 'registered';
                }
                else{
                    echo 'Ошибка, попробуйте позже.';
                }
            }
            else{
                echo 'Логин уже занят!';
            }
        }

        public function actionLoginCheck(){
            $login = trim(htmlspecialchars(stripslashes($_POST['login'])));
            if(User::loginCheck($login) === false){
                echo 'free';
            }
            else{
                echo 'exists';
            }
        }
    }