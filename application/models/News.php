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
				Logger::getRootLogger()->error($ex->getMessage());
                return false;
            }
        }

		public static function edit($id, $title, $body){
			global $db;
			$sql = 'UPDATE news SET title = :title, body = :body WHERE id = :id';
			$stm = $db->prepare($sql);

			try{
				$db->beginTransaction();
				$result = $stm->execute(array(
					':id' => $id,
					':title' => $title,
					':body' => $body,
				));
				$db->commit();

				return $result;
			}
			catch(PDOException $ex){
				$db->rollBack();
				Logger::getRootLogger()->error($ex->getMessage());
				return false;
			}
		}

		public static function delete($id){
			global $db;
			$sql = 'UPDATE news SET deleted = 1 WHERE id = :id';
			$stm = $db->prepare($sql);

			try{
				$db->beginTransaction();
				$result = $stm->execute(array(
					':id' => $id,
				));
				$db->commit();

				return $result;
			}
			catch(PDOException $ex){
				$db->rollBack();
				Logger::getRootLogger()->error($ex->getMessage());
				return false;
			}
		}

		public static function restore($id){
			global $db;
			$sql = 'UPDATE news SET deleted = 0 WHERE id = :id';
			$stm = $db->prepare($sql);

			try{
				$db->beginTransaction();
				$result = $stm->execute(array(
					':id' => $id,
				));
				$db->commit();

				return $result;
			}
			catch(PDOException $ex){
				$db->rollBack();
				Logger::getRootLogger()->error($ex->getMessage());
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
				Logger::getRootLogger()->error($ex->getMessage());
                return null;
            }
            catch(Error $exx){   //throw FATAL ERRORS
				Logger::getRootLogger()->fatal($exx->getMessage());
				return null;
            }
        }

        public static function load(int $offset, int $count){
            global $db;
            $sql = 'SELECT n.*, a.login as author FROM news n LEFT JOIN accounts a ON a.id = n.author WHERE n.deleted = 0 ORDER BY n.id DESC LIMIT :offset,:count;';
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
				Logger::getRootLogger()->error($ex->getMessage());
                return null;
            }
        }

        public static function loadById(int $id){
            global $db;
            $sql = 'SELECT n.*, a.login as author FROM news n LEFT JOIN accounts a ON a.id = n.author WHERE n.id = :id AND n.deleted = 0;';
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
				Logger::getRootLogger()->error($ex->getMessage());
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