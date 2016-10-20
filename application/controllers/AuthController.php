<?php

    class AuthController extends Controller {

        public function actionIndex(){
            if(!$this->authorised()){
                $this->view->render('auth');
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
            $hash = md5($_POST['password']);

            if((strlen($login) > 3) and (preg_match('/^[a-z][a-z0-9]*?([-_][a-z0-9]+){0,2}$/i', $login))){
                $account = User::load($login);
                if($account !== null){
                    if($account->hashCheck($hash)){
                        if($account->getApproved() == 1){
                            User::setUser($account);
                            /*if(!empty($account->getUsedToken())){
                                Session::set('token_id', $account['token_id']);
                            }*/
                            User::getUser()->updateActivity();
                            User::getUser()->commitActivity();

                            echo 'authorised';
                        }
                        else{
                            echo 'Ваш аккаунт не утверджен. Обратитесь за помощью на Email: info@cgimpel.ru, Skype: ca1m12.';
                        }
                    }
                    else{
                        echo 'Неверный пароль.';
                    }
                }
                else{
                    echo 'Неверный логин.';
                }
            }
            else{
                echo 'Некорректный логин.';
            }
        }

        public function actionLogout(){
            Session::destroy();
            header("Location: /");
            exit();
        }
    }