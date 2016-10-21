<?php

    class MessagesController extends Controller {

        public function actionIndex(){
            $this->checkAccess();

            $this->view->render("template");
        }

        public function actionDialog(){
            $this->checkAccess();

            $this->view->setTitle('Диалог');
            $this->view->setContent(array(
                0 => 'лилтипил мдии фволарлоывафы офвыаолфыв а',
                1 => 'оыв рыфовр рфылоалф оралфыр лафыда рфдыа дфыа',
                2 => 'азазастиан лаа лилтими фывфывфы фыфазф ухади фыа',
            ));
            $this->view->setPage('dialog');
            $this->view->render('template');
        }

    }