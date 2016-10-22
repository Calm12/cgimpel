<?php

    require_once ROOT . '/config/permissions.php';

    class Permissions {

        public static function getPermission($uri){
            global $permissions;

            if(isset($permissions[$uri])){
                return $permissions[$uri];
            }
            else{
                return 500;
            }
        }

    }