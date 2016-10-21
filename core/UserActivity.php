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

    }