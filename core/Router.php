<?php

    class Router {

        /**
         *
         */
        public function run(){
            Logger::getRootLogger()->debug('Router init');
            $uri = Utils::getUri();

            $piecesOfUrl = explode('/', $uri);

            if(count($piecesOfUrl) > 3){
                (new Errors())->error_404();
            }

            if(!empty($piecesOfUrl[1]) AND isset($piecesOfUrl[1])){
                $controllerName = $piecesOfUrl[1];
            }
            else{
                $controllerName = 'news';
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