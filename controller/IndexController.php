<?php

namespace controller;

class IndexController {

	public function indexAction() {
		$view = new \helper\Views();
		$view->setTemplate('index');

		$providers = new \models\Providers();

		$view->addVar('providers', $providers);

		$view->compile();
	}
}
