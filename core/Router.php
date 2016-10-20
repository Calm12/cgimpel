<?php

    class Router {

        /**
         *
         */
        public function run(){

            if(strpos($_SERVER['REQUEST_URI'], '?') !== false){
                $uri = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?'));
            }
            else{
                $uri = $_SERVER['REQUEST_URI'];
            }

            $piecesOfUrl = explode('/', $uri);

            if(!empty($piecesOfUrl[1]) AND isset($piecesOfUrl[1])){
                $controllerName = $piecesOfUrl[1];
            }
            else{
                $controllerName = 'main';
            }
            if(!empty($piecesOfUrl[2])){
                $action = $piecesOfUrl[2];
            }
            else{
                $action = 'index';
            }

            $controllerName = ucfirst($controllerName) . 'Controller';
            $action = 'action' . ucfirst($action);

            $fileWithController = $controllerName . '.php';
            $fileWithControllerPath = "application/controllers/" . $fileWithController;
            if(file_exists($fileWithControllerPath)){
                include $fileWithControllerPath;
            }
            else{
                (new Errors())->error_404();
            }
            if(class_exists($controllerName)){
                $controller = new $controllerName;
            }
            else{
                (new Errors())->error_404();
            }

            if(method_exists($controller, $action)){
                call_user_func(array(
                    $controller,
                    $action,
                ), $piecesOfUrl);
            }
            else{
                (new Errors())->error_404();
            }
        }
    }