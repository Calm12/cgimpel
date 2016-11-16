<?php

    class News {

        private $id;
        private $title;
        private $body;
        private $date;
        private $author;

        public function __construct($id, $title, $body, $date, $author){
            $this->id = $id;
            $this->title = $title;
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
            $sql = 'SELECT COUNT(*) as count FROM news WHERE deleted = 0;';

            try{
                $stm = $db->prepare($sql); //for test
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

                return null;
            }
            catch(Error $exx){   //throw FATAL ERRORS
                echo $exx->getMessage();
            }
        }

        public static function load(int $offset, int $count){
            global $db;
            $sql = 'SELECT * FROM news WHERE deleted = 0 ORDER BY id DESC LIMIT :offset,:count;';
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
            $sql = 'SELECT * FROM news WHERE id = :id AND deleted = 0;';
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

        public function getTitle(){
            return $this->title;
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