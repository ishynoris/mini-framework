<?php 

namespace Core;

use Core\Interfaces\IView;
use Core\Views\PageNotFoundView;

final class Sistema {

	public static function pageNotFound(): IView {
		return new PageNotFoundView;
	}
}