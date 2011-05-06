<?php
namespace System\IO;

class FileNotFoundException extends IOException
{
	public function __construct( $path, $previous = null )
	{
		parent::__construct("The file \"$path\" cannot be found.", EXCODE_FILE_NOT_FOUND, $previous, "An error occoured on the server. Please contact the developers of the application.");
	}
}