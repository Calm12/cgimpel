<?php
	ini_set('display_errors', 1);
	//ini_set('error_reporting',2047);
	define('ROOT', dirname(__FILE__));

	try{
		require_once ROOT . '/config/config.php';
		require_once ROOT . '/core/Session.php';
		require_once ROOT . '/core/Permissions.php';
		require_once ROOT . '/core/Utils.php';
		require_once ROOT . '/core/Router.php';
		require_once ROOT . '/core/Model.php';
		require_once ROOT . '/core/View.php';
		require_once ROOT . '/core/Controller.php';
		require_once ROOT . '/core/Error.php';
		require_once ROOT . '/core/DataBase.php';
		require_once ROOT . '/core/UserActivity.php';
		require_once ROOT . '/core/include/log4php/Logger.php';

		Logger::configure(ROOT . '/config/log4php.properties');
		Session::init();
		$db = DataBase::getConnection();
		UserActivity::fix();
		//UserActivity::log();

		$router = new Router();
		$router->run();
	}
	catch(GimpelException $e){
		Logger::getRootLogger()->fatal($e->getMessage() . "\n" . $e->getTraceAsString());
	}