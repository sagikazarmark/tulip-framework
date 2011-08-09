<?php

// @todo: Documentation needed

namespace System\ErrorHandling;

class LoadControllerException extends TulipException
{

	public function __construct( $previous = null )
	{
		parent::__construct("The automatic controller loading mechanism failed with the provided Request URL.", \EXCODE_CLASS_NOT_EXISTS, $previous);
	}

}