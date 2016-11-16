<?php

    ini_set('display_errors', 1);
	//ini_set('error_reporting',2047);
    define('ROOT', dirname(__FILE__));

    @require_once ROOT . '/config/config.php';
    @require_once ROOT . '/core/Session.php';
    @require_once ROOT . '/core/Permissions.php';
    @require_once ROOT . '/core/Utils.php';
    @require_once ROOT . '/core/Router.php';
    @require_once ROOT . '/core/Model.php';
    @require_once ROOT . '/core/View.php';
    @require_once ROOT . '/core/Controller.php';
    @require_once ROOT . '/core/Error.php';
    @require_once ROOT . '/core/DataBase.php';
    @require_once ROOT . '/core/UserActivity.php';

    Session::init();
    $db = DataBase::getConnection();
    UserActivity::fix();

    $router = new Router();
    $router->run();