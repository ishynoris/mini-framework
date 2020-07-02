<?php
namespace Core;

use Core\Interfaces\IForm;

class Form implements IForm {

	private $form;

	public function __construct(array $form) {
		$this->form = $form;
	}

	public function hasValue(string $name): bool {
		return !empty($this->form[$name]);
	}

	public function getString(string $name): string {
		$value = $this->form[$name];
		return is_string($value) ? $value : "";
	}

	public function getInt(string $name): int {
		$value = $this->form[$name];
		return is_numeric($value) ? $value : 0;
	}

	public function getArray(string $name): array {
		$value = $this->form[$name];
		return is_array($value) ? $value : [];
	}
}