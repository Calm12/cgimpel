<?php

    class MainController extends Controller { //// надо сделать таблицу с правами для роутера

        public function actionIndex(){
            $this->checkAccess();

            $this->view->setTitle('Новости');

            $this->view->setPage('news');
            $this->view->render('template');
        }

    }