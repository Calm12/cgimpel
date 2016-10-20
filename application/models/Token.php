<?php

    class Token {
        private $id;
        private $token;
        private $name;
        private $date;
        private $owner_login;

        public function __construct($id, $token, $name, $date, $owner_login){
            $this->id = $id;
            $this->token = $token;
            $this->name = $name;
            $this->date = $date;
            $this->owner_login = $owner_login;
        }

        public static function load($id){
            global $db;
            $sql = 'SELECT * FROM tokens WHERE token_id = :id;';
            $stm = $db->prepare($sql);

            try{
                $stm->bindParam(':id', $id);
                $stm->execute();
                $arr = $stm->fetch();
                if($arr){
                    return new Token($arr['token_id'], $arr['token'], $arr['name'], $arr['date'], $arr['owner_login']);
                }
                else{
                    return null;
                }

            }
            catch(PDOException $ex){
                //логи
                return null;
            }
        }

        public static function loadAll(){

        }

        public function getId(){
            return $this->id;
        }

        public function getToken(){
            return $this->token;
        }

        public function getName(){
            return $this->name;
        }

        public function getDate(){
            return $this->date;
        }

        public function getOwnerLogin(){
            return $this->owner_login;
        }
    }