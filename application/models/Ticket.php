<?php

    class Ticket {

        private $id;
        private $title;
        private $body;
        private $date;
        private $author;
        private $closed;

        public function __construct($id, $title, $body, $date, $author, $closed){
            $this->id = $id;
            $this->title = $title;
            $this->body = $body;
            $this->date = $date;
            $this->author = $author;
            $this->closed = $closed;
        }

        public static function create($title, $body, $author){
            global $db;
            $sql = 'INSERT INTO feedback (title, body, author) VALUES(:title, :body, :author);';
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

        public function save(){
            global $db;
            $sql = 'UPDATE feedback SET :title, :body, :date, :author, :closed WHERE id = :id;';
            $stm = $db->prepare($sql);

            try{
                $db->beginTransaction();
                $result = $stm->execute(array(
                    ':title' => $this->title,
                    ':body' => $this->body,
                    ':date' => $this->date,
                    ':author' => $this->author,
                    ':closed' => $this->closed,
                    ':id' => $this->id,
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

        public static function getCount(bool $archive = false){
            global $db;
            if($archive){
                $sql = 'SELECT COUNT(*) as count FROM feedback WHERE closed = 1 AND deleted = 0;';
            }
            else{
                $sql = 'SELECT COUNT(*) as count FROM feedback WHERE closed = 0 AND deleted = 0;';
            }
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

        public static function load(int $offset, int $count, $user, bool $archive = false){
            global $db;
            if($archive){
                $sql = 'SELECT * FROM feedback WHERE author = :author AND closed = 1 AND deleted = 0 ORDER BY id DESC LIMIT :offset,:count;';
            }
            else{
                $sql = 'SELECT * FROM feedback WHERE author = :author AND closed = 0 AND deleted = 0 ORDER BY id DESC LIMIT :offset,:count;';
            }
            $stm = $db->prepare($sql);

            try{
                $stm->bindParam(':offset', $offset, PDO::PARAM_INT);
                $stm->bindParam(':count', $count, PDO::PARAM_INT);
                $stm->bindParam(':author', $user);
                $stm->execute();

                $news = array();
                while($arr = $stm->fetch()){
                    $news[] = new Ticket($arr['id'], $arr['title'], $arr['body'], $arr['date'], $arr['author'], $arr['closed']);
                }

                return $news;
            }
            catch(PDOException $ex){
                //логи
                return null;
            }
        }

        public static function loadAll(int $offset, int $count, bool $archive = false){
            global $db;
            if($archive){
                $sql = 'SELECT * FROM feedback WHERE closed = 1 AND deleted = 0 ORDER BY id DESC LIMIT :offset,:count;';
            }
            else{
                $sql = 'SELECT * FROM feedback WHERE closed = 0 AND deleted = 0 ORDER BY id DESC LIMIT :offset,:count;';
            }
            $stm = $db->prepare($sql);

            try{
                $stm->bindParam(':offset', $offset, PDO::PARAM_INT);
                $stm->bindParam(':count', $count, PDO::PARAM_INT);
                $stm->execute();

                $news = array();
                while($arr = $stm->fetch()){
                    $news[] = new Ticket($arr['id'], $arr['title'], $arr['body'], $arr['date'], $arr['author'], $arr['closed']);
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
            $sql = 'SELECT * FROM feedback WHERE id = :id AND deleted = 0;';
            $stm = $db->prepare($sql);

            try{
                $stm->bindParam(':id', $id);
                $stm->execute();
                $arr = $stm->fetch();
                if($arr){
                    return new Ticket($arr['id'], $arr['title'], $arr['body'], $arr['date'], $arr['author'], $arr['closed']);
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

        public function getClosed(){
            return $this->closed;
        }

        public function setClosed($closed){
            $this->closed = $closed;
        }

    }