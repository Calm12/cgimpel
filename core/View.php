<?php

    class View {

        private $title = 'Новая страница';
        private $page = 'page';
        private $content;

        public function render($template){
            include ROOT.'/application/views/' . $template . '.php';
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

        public function includeHeaders(){
            if(file_exists($this->getHeaders())){
                include($this->getHeaders());
            }
        }

        public function getHeaders(){
            return ROOT.'/application/views/headers/'.$this->page.'.php';
        }

    }