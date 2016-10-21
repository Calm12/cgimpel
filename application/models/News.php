<?php

    class News {

        private $id;
        private $name;
        private $body;
        private $date;
        private $author;

        public function __construct($id, $name, $body, $date, $author){
            $this->id = $id;
            $this->name = $name;
            $this->body = $body;
            $this->date = $date;
            $this->author = $author;
        }

        public static function create($title, $body, $author){
            global $db;
            $sql = 'INSERT INTO news (title, body, author) VALUES(:title, :body, :author);';
            $stm = $db->prepare($sql);

            try{
                $db->beginTransaction();
                $result = $stm->execute(array(
                    ':title' => $title,
                    ':body' => $body,
                    ':author' => $author,
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
                    $news[] = new News($arr['id'], $arr['title'], $arr['body'], $arr['date'], $arr['author']);
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
                    return new News($arr['id'], $arr['title'], $arr['body'], $arr['date'], $arr['author']);
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

        public function getAuthor(){
            return $this->author;
        }
    }