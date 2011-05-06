<?php

namespace Controller;

class Controller extends \Object
{

	public $composition = '';
	public $view = '';

	public static function loadController($path = REQUEST_URL)
	{
		$parameters = \explode('/', $path);
		$parameterCount = \count($parameters);
		for ($i = 1; $i <= $parameterCount; $i++) {
			try {
				$controllerFullName = 'Controller\\';
				\System\AutoLoader::autoLoad($controllerFullName);
			} catch (\System\ErrorHandling\AutoLoaderException $e) {
				
			}
		}
	}

	public function loadComposition($viewName = null, $compositionName = null)
	{
		$viewName = $viewName ? $viewName : $this->view;
		$compositionName = $compositionName ? $compositionName : $this->composition;
		$this->view = $viewName;
		$this->loadView($compositionName);
	}

	public function loadView($viewName = null)
	{
		$viewName = $viewName ? $viewName : $this->view;
		$extensions = &\System\Tulip::$viewExtensions;
		$success = false;
		$exception = null;
		foreach ($extensions as $extension) {
			try {
				\System\AutoLoader::load('View' . DS . $viewName . '.' . $extension);
				$success = true;
				break;
			} catch (\System\IO\FileNotFoundException $e) {
				$exception = $e;
			}
		}
		if (!$success) {
			throw $exception;
		}
	}

}
