<?php

    class TokenController extends Controller {

        public function actionIndex(){
            $this->checkAccess();

			try{
				$this->view->setTitle('сабака');

				$this->view->setMenu(array(
					'/news/add' => 'Мдииии',
				));

				$this->view->render('template');
			}
			catch(FileNotFoundException $ex){
				Logger::getRootLogger()->error($ex->getMessage());
			}
        }

    }