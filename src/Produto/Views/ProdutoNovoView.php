<?php 

namespace Produto\Views;

use Core\Interfaces\IView;

class ProdutoNovoView implements IView {

	public function render() {
		include_once "inc/novo_produto.php";
	}
}