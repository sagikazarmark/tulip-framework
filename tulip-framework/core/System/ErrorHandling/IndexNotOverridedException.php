<?php

// @todo: Documentation needed

namespace System\ErrorHandling;

class IndexNotOverridedException extends TulipException
{

	public function __construct( $previous = null )
	{
		parent::__construct("The automatic controller loading mechanism failed with the provided Request URL, because the index method is not overrided.", EXCODE_INDEX_NOT_OVERRIDED, $previous);
	}

}