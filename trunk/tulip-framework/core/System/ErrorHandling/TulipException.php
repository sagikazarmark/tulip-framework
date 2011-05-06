<?php

namespace System\ErrorHandling;

/**
 * Every exception in the framework inherits this class, so they have the
 * printMessage property.
 *
 * @author Tamás
 */
class TulipException extends \Exception
{

	/**
	 * @var string The message, that anyone can see, does not contain any
	 * information related to coding, so you can print that to end users of
	 * your applications.
	 */
	protected $printMessage;

	public function __construct( $message, $code = 0, $previous = null,
		$printMessage = "An error occoured." )
	{
		parent::__construct((string) $message, (int) $code, $previous);
		$this->printMessage = $printMessage;
	}

	/**
	 * All TulipException class contains a message, that even the end users can
	 * see. This function returns this message, which you could set in the
	 * constructor of the class.
	 * @return string The message itself
	 */
	final public function getPrintMessage()
	{
		return $this->printMessage;
	}

}

/*
 *
 * Exception code constants
 *
 */

/**
 * This is a System\IO\FileNotFoundException
 */
\define('EXCODE_FILE_NOT_FOUND', 1);
/**
 * Thrown when you try to set the value of a read-only property on a class.
 */
\define('EXCODE_PROPERTY_READ_ONLY', 2);
/**
 * Thrown when you try to set the value of a read-only property on a class.
 */
\define('EXCODE_PROPERTY_WRITE_ONLY', 3);
/**
 * Thrown when you try to create an instance of a non-existing class.
 */
\define('EXCODE_CLASS_NOT_EXISTS', 4);


/*
 *
 * Common error messages
 *
 */
/**
 * This message is shown to the user, when the exception's details should remain
 * secret.
 */
\define('USER_MESSAGE_NOT_DISCUSSED', 'Internal server error. Please contact the developers, of the application.');
?>
