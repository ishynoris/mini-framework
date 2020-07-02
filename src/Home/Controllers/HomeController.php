<?php

namespace Home\Controllers;

use Core\Interfaces\IController;
use Core\Interfaces\IForm;
use Core\Interfaces\IView;
use Home\Views\HomeIndexView;

class HomeController implements IController {

	public function index(): IView {
		return new HomeIndexView;
	}

	public function getView(string $action, IForm $form): ?IView {
		return $this->index();
	}
}