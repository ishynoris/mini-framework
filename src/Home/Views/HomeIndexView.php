<?php

namespace Home\Views;

use Core\Interfaces\IView;

class HomeIndexView implements IView {

	public function render() {
		include_once "includes/home_index.php";
	}
}
