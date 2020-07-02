<?php

namespace Core\Interfaces;

interface IForm {

	public function hasValue(string $name): bool;

	public function getString(string $name): string;

	public function getInt(string $name): int;

	public function getArray(string $name): array;
}