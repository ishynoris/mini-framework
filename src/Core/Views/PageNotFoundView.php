<?php

namespace Core\Views;

use Core\Interfaces\IView;

class PageNotFoundView implements IView {

	public function render() {
		echo "<h1>Página não encontrada</h1>";
	}
}
