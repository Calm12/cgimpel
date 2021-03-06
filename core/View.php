<?php
	require_once ROOT.'/core/exceptions/FileNotFoundException.php';

    class View {

        private $controller;
        private $title = 'Новая страница';
        private $page = 'page';
        private $menu;
        private $content;
        private $properties = array();

        public function __construct($controller){
            $this->controller = $controller;
        }

        public function render($template){
            if(file_exists(ROOT.'/application/views/' . $template . '.php')){
                include ROOT . '/application/views/' . $template . '.php';
            }
            else{
				include(ROOT.'/application/views/404.php');
				throw new FileNotFoundException('File '.ROOT.'/application/views/' . $template . '.php'.' does not exists!');
            }
        }

        public function includePage(){
            if(file_exists($this->getPage())){
                include($this->getPage());
            }
            else{
				include(ROOT.'/application/views/pages/404.php');
				throw new FileNotFoundException('File '.$this->getPage().' does not exists!');
            }
        }

        public function getTitle(): string{
            return $this->title;
        }

        public function getPage(): string{
            return ROOT.'/application/views/pages/'.$this->page.'.php';
        }

        public function setTitle(string $title){
            $this->title = $title;
        }

        public function setPage(string $page){
            $this->page = $page;
        }

        public function getContent(){
            return $this->content;
        }

        public function setContent($content){
            $this->content = $content;
        }

        public function getMenu(){
            return $this->menu;
        }

        public function setMenu(array $menu){
            $this->menu = $menu;
        }

        public function getProperties(){
            return $this->properties;
        }

        public function setProperties($properties){
            $this->properties = $properties;
        }

        public function setProperty($key, $value){
            $this->properties[$key] = $value;
        }

        public function getProperty($key){
            return $this->properties[$key];
        }

        public function includeDynamicMenu(){
            if(file_exists($this->getDynamicMenu())){
                include($this->getDynamicMenu());
            }
            else{
            	throw new FileNotFoundException('File '.$this->getDynamicMenu().' does not exists!');
			}
        }

        public function getDynamicMenu(){
            return ROOT.'/application/views/control_panels/'.$this->page.'.php';
        }

        public function includeHeaders(){
            if(file_exists($this->getHeaders())){
                include($this->getHeaders());
            }
            else{
				throw new FileNotFoundException('File '.$this->getHeaders().' does not exists!');
			}
        }

        public function getHeaders(){
            return ROOT.'/application/views/headers/'.$this->page.'.php';
        }

    }