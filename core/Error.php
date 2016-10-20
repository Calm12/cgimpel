<?php

    class Errors extends Controller{

        public function error_404(){
            $this->view->render('404');
            exit();
        }

    }