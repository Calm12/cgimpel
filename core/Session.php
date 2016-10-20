<?php

    class Session {
        public static function init(){
            session_start();
        }

        public static function set($key, $value){
            $_SESSION[$key] = $value;
        }

        public static function get($key){
            if(isset($_SESSION[$key])){
                return $_SESSION[$key];
            }
        }

        public static function destroy(){
            // unset($_SESSION);
            session_destroy();
        }

        public static function setCookie($name = '', $value = '', $time = 31556926, $domain = '/'){
            setcookie($name, $value = '', time() + $time, $domain);
        }

        public static function delCookie($name){
            self::setCookie($name, '', 0);
        }
    }