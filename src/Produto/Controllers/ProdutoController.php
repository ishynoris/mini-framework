<?php 

namespace Produto\Controllers;

use Core\Interfaces\IController;
use Core\Interfaces\IForm;
use Core\Interfaces\IView;
use Produto\Models\Produto;
use Produto\Views\ProdutoListView;
use Produto\Views\ProdutoNovoView;
use Produto\Views\ProdutoIndexView;

class ProdutoController implements IController {

	public function index(): IView {
		return new ProdutoIndexView;
	}

	public function getView(string $action, IForm $form): ?IView {
		switch ($action) {
			case "consultar": return $this->listarProdutos();
			case "novo": return $this->novoProduto();
			case "cadastrar": return $this->cadastrarProduto($form);
			case "remover-elemento": return $this->index();
			default: return null;
		}
	}

	private function novoProduto(): IView {
		return new ProdutoNovoView;
	}

	private function listarProdutos(): IView {
		$produtos = [ "Farinha", "Ovos", "Açucar" ];
		return new ProdutoListView($produtos);
	}

	private function cadastrarProduto(IForm $form): IView {

		
		if ($form->hasValue("nome_produto")) {
			$produto = new Produto($form->getString("nome_produto"));
		}

		return $this->index();
	}
}