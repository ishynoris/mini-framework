<?php

namespace Core\Router;

use Throwable;

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
	/** @var array { @type IController } */
	private $modules;
	/** @var IView $pageNotFound */
	private $pageNotFound;

	function __construct(){
		$this->modules = [];
		$this->pageNotFound = Sistema::pageNotFound();
	}

	public function setPageNotFoundDefault(IView $pageNotFound) {
		$this->pageNotFound = $pageNotFound;
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

	public function setRoute(string $module, IController $controller){
		$this->modules[$module] = $controller;
	}

	private function getView(string $module, string $action): IView {
		if (!isset($this->modules[$module])) {
			return $this->pageNotFound;
		}

		$controller = $this->modules[$module];
		if (empty($action)) {
			return $controller->index();
		}

		$form = $this->getForm();
		$view = $controller->getView($action, $form);
		if (empty($view)) {
			return $this->pageNotFound;
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
