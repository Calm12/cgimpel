<?php

    class News {

        private $id;
        private $name;
        private $body;
        private $date;

        public function __construct($id, $name, $body, $date){
            $this->id = $id;
            $this->name = $name;
            $this->body = $body;
            $this->date = $date;
        }

        public static function create($title, $body){
            global $db;
            $sql = 'INSERT INTO news (`name`, body) VALUES(:title, :body);';
            $stm = $db->prepare($sql);

            try{
                $db->beginTransaction();
                $result = $stm->execute(array(
                    ':title' => $title,
                    ':body' => $body,
                ));
                $db->commit();

                return $result;
            }
            catch(PDOException $ex){
                $db->rollBack();

                //логи

                return false;
            }
        }

        public static function getCount(){
            global $db;
            $sql = 'SELECT COUNT(*) as count FROM news;';
            $stm = $db->prepare($sql);

            try{
                $stm->execute();
                $arr = $stm->fetch();
                if($arr){
                    return (int)$arr['count'];
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

        public static function load(int $offset, int $count){
            global $db;
            $sql = 'SELECT * FROM news ORDER BY id DESC LIMIT :offset,:count;';
            $stm = $db->prepare($sql);

            try{
                $stm->bindParam(':offset', $offset, PDO::PARAM_INT);
                $stm->bindParam(':count', $count, PDO::PARAM_INT);
                $stm->execute();

                $news = array();
                while($arr = $stm->fetch()){
                    $news[] = new News($arr['id'], $arr['name'], $arr['body'], $arr['date']);
                }

                return $news;
            }
            catch(PDOException $ex){
                //логи
                return null;
            }
        }

        public static function loadById(int $id){
            global $db;
            $sql = 'SELECT * FROM news WHERE id = :id;';
            $stm = $db->prepare($sql);

            try{
                $stm->bindParam(':id', $id);
                $stm->execute();
                $arr = $stm->fetch();
                if($arr){
                    return new News($arr['id'], $arr['name'], $arr['body'], $arr['date']);
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

        public function getId(){
            return $this->id;
        }

        public function getName(){
            return $this->name;
        }

        public function getBody(){
            return $this->body;
        }

        public function getDate(){
            return $this->date;
        }
    }