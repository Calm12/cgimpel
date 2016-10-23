<?php

    class User {

        private $id;
        private $login;
        private $hash;
        private $email;
        private $last_ip;
        private $last_active;
        private $access_level;
        private $used_token;
        private $approved;

        private function __construct($id, $login, $hash, $email, $last_ip, $last_active, $access_level, $used_token, $approved){
            $this->id = $id;
            $this->login = $login;
            $this->hash = $hash;
            $this->email = $email;
            $this->last_ip = $last_ip;
            $this->last_active = $last_active;
            $this->access_level = $access_level;
            $this->used_token = $used_token;
            $this->approved = $approved;
        }

        /**
         * Создает в БД новую запись с текущими параметрами.
         * @param $login
         * @param $email
         * @param $password
         * @return bool результат записи в БД
         */
        public static function create($login, $email, $password) : bool{
            global $db;
            $sql = 'INSERT INTO accounts (login, password, email) VALUES(:login, :password, :email);';
            $stm = $db->prepare($sql);

            try{
                $db->beginTransaction();
                $result = $stm->execute(array(
                    ':login' => $login,
                    ':password' => $password,
                    ':email' => $email,
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

        /**
         * Загружает из БД пользователя по логину и возвращает объект User
         * @param string $login
         * @return User|null
         */
        public static function load(string $login){
            global $db;
            $sql = 'SELECT * FROM accounts WHERE login = :login AND deleted = 0;';
            $stm = $db->prepare($sql);

            try{
                $stm->bindParam(':login', $login);
                $stm->execute();
                $arr = $stm->fetch();
                if($arr){
                    return new User($arr['id'], $arr['login'], $arr['password'], $arr['email'], $arr['last_ip'], $arr['last_active'], $arr['access_level'], $arr['used_token'], $arr['approved']);
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

        public static function loadById(int $id){

        }

        public function save(){

        }

        /**
         * Обнлвоение полей last_ip и last_active.
         */
        public function updateActivity(){
            $this->setLastActive(date(('Y-m-d H:i:s'), time()));
            $this->setLastIp($_SERVER['REMOTE_ADDR']);
        }

        /**
         * Фиксация изменений last_ip и last_active в БД.
         */
        public function commitActivity(){
            global $db;
            $sql = 'UPDATE accounts SET last_ip = :last_ip, last_active = :last_active WHERE id = :id;';
            $stm = $db->prepare($sql);

            try{
                $db->beginTransaction();
                $result = $stm->execute(array(
                    ':last_ip' => $this->getLastIp(),
                    ':last_active' => $this->getLastActive(),
                    ':id' => $this->getId(),
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

        /**
         * Проверка существования логина в БД.
         * @param $login
         * @return mixed false или id
         */
        public static function loginCheck($login){
            global $db;

            $sql = 'SELECT id FROM accounts WHERE login = :login;';
            $stm = $db->prepare($sql);

            try{
                $stm->bindParam(':login', $login);
                $stm->execute();
                $id = ($stm->fetch())['id'];
                if($id === null){
                    return false;
                }
                else if($id === false){
                    return false;
                }
                else{
                    return true;
                }
            }
            catch(PDOException $ex){
                //логи
                return 'err';
            }
        }

        public function hashCheck(string $hash) : bool{
            return ($hash === $this->getHash());
        }

        /**
         * @return User|null Объект User или null, если не найдено.
         */
        public static function getUser(){
            return Session::get('user');
        }

        /**
         * Сохраняет объект User в сессии.
         * @param User $user
         */
        public static function setUser(User $user){
            Session::set('user', $user);
        }

        public function getLogin(){
            return $this->login;
        }

        public function getId(){
            return $this->id;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getLastIp(){
            return $this->last_ip;
        }

        public function getLastActive(){
            return $this->last_active;
        }

        public function getAccessLevel() : int{
            return (int)$this->access_level;
        }

        public function getUsedToken(){
            return $this->used_token;
        }

        public function getApproved(){
            return $this->approved;
        }

        private function getHash(){
            return $this->hash;
        }

        public function setLastIp($last_ip){
            $this->last_ip = $last_ip;
        }

        public function setLastActive($last_active){
            $this->last_active = $last_active;
        }

    }

