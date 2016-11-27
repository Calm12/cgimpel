<?php
require_once ROOT.'/core/exceptions/GimpelException.php';

class FileNotFoundException extends GimpelException {

	public function __construct($message, $code = 0, Exception $previous = null) {
		parent::__construct($message, $code, $previous);
	}

}