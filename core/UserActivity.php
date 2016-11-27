<?php

    require_once ROOT . '/application/models/User.php';

    class UserActivity {

        public static function fix(){
            if(Session::get('user') !== null){
                $current_time = time();

                $last_unix_time = strtotime(Session::get('user')->getLastActive());

                if((((int)$last_unix_time) + 300) < (int)$current_time){
                    User::getUser()->updateActivity();
                    User::getUser()->commitActivity();
                }
            }
        }

        public static function log(){
			$ip = $_SERVER['REMOTE_ADDR'];
			$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			$from = $_SERVER['HTTP_REFERER'];
			$login = Session::get('user')->getLogin();
			$used_token = Session::get('user')->getUsedToken();
			$user_browser = 'NONE';
			$os = 'NONE';

			Logger::getLogger('users')->info('|'.$ip.'|'.$url.'|'.$from.'|'.$login.'|'.$used_token.'|'.$user_browser.'|'.$os.'|');
		}

    }