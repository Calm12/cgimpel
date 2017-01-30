<?php

	class NewsComment{

		private $id;
		private $body;
		private $date;
		private $post;
		private $author;

		public function __construct($id, $body, $date, $post, $author){
			$this->id = $id;
			$this->body = $body;
			$this->date = $date;
			$this->post = $post;
			$this->author = $author;
		}

		public static function create($body, $post, $author){
			global $db;
			$sql = 'INSERT INTO news_comment (body, post, author) VALUES(:body, :post, :author);';
			$stm = $db->prepare($sql);

			try{
				$db->beginTransaction();
				$result = $stm->execute(
					array(
						':body' => $body,
						':post' => $post,
						':author' => $author,
					)
				);
				$db->commit();

				return $result;
			}
			catch(PDOException $ex){
				$db->rollBack();
				Logger::getRootLogger()->error($ex->getMessage());

				return false;
			}
		}

		public static function edit($id, $body){
			global $db;
			$sql = 'UPDATE news_comment SET body = :body WHERE id = :id;';
			$stm = $db->prepare($sql);

			try{
				$db->beginTransaction();
				$result = $stm->execute(
					array(
						':id' => $id,
						':body' => $body,
					)
				);
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
			$sql = 'UPDATE news_comment SET deleted = 1 WHERE id = :id;';
			$stm = $db->prepare($sql);

			try{
				$db->beginTransaction();
				$result = $stm->execute(
					array(
						':id' => $id,
					)
				);
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
			$sql = 'UPDATE news_comment SET deleted = 0 WHERE id = :id;';
			$stm = $db->prepare($sql);

			try{
				$db->beginTransaction();
				$result = $stm->execute(
					array(
						':id' => $id,
					)
				);
				$db->commit();

				return $result;
			}
			catch(PDOException $ex){
				$db->rollBack();
				Logger::getRootLogger()->error($ex->getMessage());

				return false;
			}
		}

		public static function getCount($post){
			global $db;
			$sql = 'SELECT COUNT(*) as count FROM news_comment WHERE deleted = 0 AND post = :post;';

			try{
				$stm = $db->prepare($sql); //for test
				$stm->execute(
					array(
						':post' => $post,
					)
				);
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

		public static function load(int $post, int $offset, int $count){
			global $db;
			$sql = 'SELECT n.*, a.login as author FROM news_comment n LEFT JOIN accounts a ON a.id = n.author WHERE n.deleted = 0 AND n.post = :post ORDER BY n.id ASC LIMIT :offset,:count;';
			$stm = $db->prepare($sql);

			try{
				$stm->bindParam(':post', $post, PDO::PARAM_INT);
				$stm->bindParam(':offset', $offset, PDO::PARAM_INT);
				$stm->bindParam(':count', $count, PDO::PARAM_INT);
				$stm->execute();

				$comments = array();
				while($arr = $stm->fetch()){
					$comments[] = new NewsComment($arr['id'], $arr['body'], $arr['date'], $arr['post'], $arr['author']);
				}

				return $comments;
			}
			catch(PDOException $ex){
				Logger::getRootLogger()->error($ex->getMessage());

				return null;
			}
		}

		public static function loadById(int $id){
			global $db;
			$sql = 'SELECT n.*, a.login as author FROM news_comment n LEFT JOIN accounts a ON a.id = n.author WHERE n.id = :id AND n.deleted = 0;';
			$stm = $db->prepare($sql);

			try{
				$stm->bindParam(':id', $id);
				$stm->execute();
				$arr = $stm->fetch();
				if($arr){
					return new NewsComment($arr['id'], $arr['body'], $arr['date'], $arr['post'], $arr['author']);
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

		public function getBody(){
			return $this->body;
		}

		public function getDate(){
			return $this->date;
		}

		/*
		 * returns parent post
		 */
		public function getPost(){
			return $this->post;
		}

		public function getAuthor(){
			return $this->author;
		}

	}