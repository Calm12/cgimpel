<?php

    class View {

        private $controller;
        private $title = 'Новая страница';
        private $page = 'page';
        private $menu;
        private $content;

        public function __construct($controller){
            $this->controller = $controller;
        }

        public function render($template){
            if(file_exists(ROOT.'/application/views/' . $template . '.php')){
                include ROOT . '/application/views/' . $template . '.php';
            }
            else{
                include(ROOT.'/application/views/404.php');
            }
        }

        public function includePage(){
            if(file_exists($this->getPage())){
                include($this->getPage());
            }
            else{
                include(ROOT.'/application/views/pages/404.php');
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

        public function includeDynamicMenu(){
            if(file_exists($this->getDynamicMenu())){
                include($this->getDynamicMenu());
            }
        }

        public function getDynamicMenu(){
            return ROOT.'/application/views/control_panels/'.$this->page.'.php';
        }

        public function includeHeaders(){
            if(file_exists($this->getHeaders())){
                include($this->getHeaders());
            }
        }

        public function getHeaders(){
            return ROOT.'/application/views/headers/'.$this->page.'.php';
        }

    }