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

        public static function gets($param, $value){
            $result = "?";
            $done = false;
            $cnt = 0;
            foreach($_GET as $key => $curr){
                if(!($cnt == 0)){
                    $result .= "&";
                }
                if($key == $param){
                    $result .= $param."=".$value;
                    $done = true;
                }
                else{
                    $result .= $key."=".$curr;
                }
                $cnt++;
            }
            if(!$done){
                if(!($cnt == 0)){
                    $result .= "&";
                }
                $result .= $param."=".$value;
            }
            return $result;
        }

    }