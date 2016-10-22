<?php

    class Utils {

        private function __construct(){

        }

        public static function getUri(){
            if(strpos($_SERVER['REQUEST_URI'], '?') !== false){
                return substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?'));
            }
            else{
                return $_SERVER['REQUEST_URI'];
            }
        }

    }