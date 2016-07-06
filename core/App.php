<?php

namespace core;

class App {

	private $controller = 'IndexController';
	private $action = 'indexAction';
	private $param;

	public function __construct() {
		$part = explode('/', $_SERVER['REQUEST_URI']);

		if (!empty($part[1])) {
			$this->controller = ucfirst($part[1]) . 'Controller';
		}
		if (!empty($part[2])) {
			$this->action = $part[2] . 'Action';
		}
		$this->params = [];
		if (isset($part[3]) && !empty($part[3])) {
			$this->params[] = $part[3];
		}
		if (isset($part[4]) && !empty($part[4])) {
			$this->params[] = $part[4];
		}
	}

	//Execute Controller Action
	public function run() {
		$strController = '\\controller\\' . $this->controller;
		$controller = new $strController();

		$action = $this->action;
		$controller->$action($this->params);
	}
}

?>
