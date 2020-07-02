<?php 

namespace Produto\Views;

use Core\Interfaces\IView;

class ProdutoIndexView implements IView {

	public function render() {
		echo "Produto Index View";
	}
}