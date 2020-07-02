<?php 

namespace Produto\Views;

use Core\Interfaces\IView;

class ProdutoListView implements IView {

	private $produtos;

	public function __construct(array $aProdutos) {
		$this->produtos = $aProdutos;
	}

	public function render() {
		$this->produtos[] = "Carne";
		include_once "inc/list_produtos.php";
	}
}