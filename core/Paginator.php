<?php

    class Paginator {

        private $count;
        private $offset;
        private $section;

        public function getLeftPointer(){
            $pointer = $this->getOffset() - $this->section;

            if(($this->getOffset() == 0) or (($this->getOffset() - $this->getSection()) < 0)){
                return 0;
            }

            return $pointer;
        }

        public function getRightPointer(){
            $pointer = $this->getOffset() + $this->getSection();

            if(($this->getOffset() + $this->section) >= $this->getCount()){
                return $this->getOffset();
            }

            return $pointer;
        }

        public function getCount(){
            return $this->count;
        }

        public function setCount($count){
            $this->count = $count;
        }

        public function getOffset(){
            if($this->offset < 0){
                return 0;
            }

            return $this->offset;
        }

        public function setOffset($offset){
            $this->offset = $offset;
        }

        public function getSection(){
            if(($this->getOffset() + $this->section) > $this->getCount()){
                return $this->getCount() - $this->getOffset();
            }

            return $this->section;
        }

        public function setSection($section){
            $this->section = $section;
        }
    }