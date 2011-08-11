<?php

namespace Controller;

class Controller extends \Object
{

	public $compositionName = 'MainComposition';
	public $viewName = '';
	public $view = array( );

	public static function loadController( $path = REQUEST_URL )
	{
		$parameters = \explode('/', $path);
		$parameters = \array_filter($parameters, '\strlen');
		$parameterCount = \count($parameters);
		for ($i = $parameterCount; $i !== 0; $i--) {
			try {
				$controllerFullName = 'Controller\\';
				$controllerFullName .= \implode('\\', \array_slice($parameters, 0, $i - 1));
				$controllerFullName .= str_replace(' ', '', \ucwords(\str_replace('-', ' ', $parameters[$i - 1]))) . 'Controller';
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
		$viewName = $viewName ? $viewName : $this->viewName;
		$compositionName = $compositionName ? $compositionName : $this->compositionName;
		$this->viewName = $viewName;
		$this->loadView($compositionName);
	}

	public function loadView( $viewName = null )
	{
		$viewName = $viewName ? $viewName : $this->viewName;
		$extensions = &\System\Tulip::$viewExtensions;
		$success = false;
		$exception = null;
		foreach ($this->view as $variableName => $variableValue) {
			$$variableName = $variableValue;
		}
		foreach ($extensions as $extension) {
			try {
				if (\file_exists(APP . DS . 'View' . DS . $viewName . '.' . $extension)) {
					require(APP . DS . 'View' . DS . $viewName . '.' . $extension);
					$success = true;
					break;
				} elseif (\file_exists(CORE . DS . 'View' . DS . $viewName . '.' . $extension)) {
					require(CORE . DS . 'View' . DS . $viewName . '.' . $extension);
					$success = true;
					break;
				} else {
					throw new \System\IO\FileNotFoundException('View' . DS . $viewName . '.' . $extension);
				}
//				\System\AutoLoader::load('View' . DS . $viewName . '.' . $extension);
			} catch (\System\IO\FileNotFoundException $e) {
				$exception = $e;
			}
		}
		if (!$success) {
			throw $exception;
		}
	}

	public function getControllerName()
	{
		return get_class($this);
	}

	public function index()
	{
		throw new \System\ErrorHandling\IndexNotOverridedException();
	}

}
