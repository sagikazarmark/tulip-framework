<?php

namespace Controller;

class Controller extends \Object {

	public $composition = '';
	public $view = '';

	public static function loadController( $path = REQUEST_URL )
	{
		$parameters = \explode('/', $path);
		$parameters = \array_filter($parameters, '\strlen');
		$parameterCount = \count($parameters);
		for ($i = $parameterCount; $i !== 0; $i--) {
			try {
				$controllerFullName = 'Controller\\';
				$controllerFullName .= \implode('\\', \array_slice($parameters, 0, $i - 1));
				$controllerFullName .= \ucwords($parameters[$i-1]) . 'Controller';
				\System\AutoLoader::autoLoad($controllerFullName);
				$controller = new $controllerFullName;
				break;
			} catch (\System\ErrorHandling\AutoLoaderException $e) {
				
			}
		}
		if ($i == 0) {
			try {
				$controllerFullName = 'Controller\\MainController';
				\System\AutoLoader::autoLoad($controllerFullName);
				$controller = new $controllerFullName;
				$method = 'index';
				\call_user_func_array(array( $controller, $method ), $parameters);
			} catch (\System\ErrorHandling\AutoLoaderException $e) {
				throw new \System\ErrorHandling\LoadControllerException($e);
			}
		} else {
			if (isset($parameters[$i]) && \method_exists($controller, $parameters[$i])) {
				$method = $parameters[$i];
				$slicenum = $i + 1;
			} else {
				$method = 'index';
				$slicenum = $i;
			}
			\call_user_func_array(array( $controller, $method ), \array_slice($parameters, $slicenum));
		}
	}

	public function loadComposition( $viewName = null, $compositionName = null )
	{
		$viewName = $viewName ? $viewName : $this->view;
		$compositionName = $compositionName ? $compositionName : $this->composition;
		$this->view = $viewName;
		$this->loadView($compositionName);
	}

	public function loadView( $viewName = null )
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

	protected function getControllerName()
	{
		return get_class($this);
	}

	public function index()
	{
		throw new \System\ErrorHandling\IndexNotOverridedException();
	}

}
