<?php

namespace Core\Interfaces;

interface IController {

	public function index(): IView;

	public function getView(string $action, IForm $value): ?IView;
}