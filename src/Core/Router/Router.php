<?php

namespace Core\Router;

use Core\Form;
use Core\Sistema;
use Core\Interfaces\IController;
use Core\Interfaces\IForm;
use Core\Interfaces\IView;
use Produto\Controllers\ProdutoController;
use Home\Controllers\HomeController;

$url = $_SERVER['REQUEST_URI'];
if (strpos($url, ".php")){
	header("Location: 404");
	exit;
}

class Router {
	private $modules;

	function __construct(){

		$this->modules = [];

		$this->setRoute("", new HomeController);
		$this->setRoute("home", new HomeController);
		$this->setRoute("index", new HomeController);
		$this->setRoute("produto", new ProdutoController);
	}

	public function route(){
		$module = $_GET['module'] ?? "";
		$action = $_GET['action'] ?? "";

		try {
			$view = empty($module) 
				? (new HomeController)->index()
				: $this->getView($module, $action);
			$view->render();
		} catch (Throwable $throwable) {
			echo "<h1><span style='color: #f00'>{$throwable->getMessage()}</span></h1>";
		}
	}

	private function setRoute(string $module, IController $controller){
		$this->modules[$module] = $controller;
	}

	private function getView(string $module, string $action): IView {
		if (!isset($this->modules[$module])) {
			return Sistema::pageNotFound();
		}

		$controller = $this->modules[$module];
		if (empty($action)) {
			return $controller->index();
		}

		$form = $this->getForm();
		$view = $controller->getView($action, $form);
		if (empty($view)) {
			return Sistema::pageNotFound();
		}
		return $view;
	}

	private function getForm(): IForm {
		$form = $_POST;
		if (isset($_GET['value'])) {
			$form['id'] = $_GET['value'];
		}
		return new Form($form);
	}
}
