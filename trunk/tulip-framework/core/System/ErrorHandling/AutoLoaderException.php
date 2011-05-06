<?php

// @todo: Documentation needed

namespace System\ErrorHandling;

class AutoLoaderException extends TulipException
{

	public function __construct( $class, $previous = null )
	{
		parent::__construct("The class $class can not be found nor in the framework core nor in the application.", \EXCODE_CLASS_NOT_EXISTS, $previous);
	}

}