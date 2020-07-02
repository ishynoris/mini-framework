<?php

namespace Produto\Models;

class Produto {

	private $id;
	private $nome;

	public function __construct(string $nome) {
		$this->id = 0;
		$this->nome = $nome;
	}
}