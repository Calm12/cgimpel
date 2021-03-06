<?php

    class DataBase {
        public static function getConnection(){

            global $config;

            $opt  = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            );

            $dsn = "mysql:host={$config['db']['host']};dbname={$config['db']['dbname']}";
            try{
                $db = new PDO($dsn, $config['db']['user'], $config['db']['password'], $opt);
            }
            catch(PDOException $ex){
                echo 'Database Error. Try again later.';
				Logger::getRootLogger()->fatal('Database connection failed: '.mb_convert_encoding($ex->getMessage(), "utf-8", "windows-1251"));
                exit();
            }

            return $db;
        }
    }