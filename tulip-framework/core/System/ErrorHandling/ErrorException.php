<?php

namespace System\ErrorHandling;

/**
 * When PHP fires an error, you can catch the error using a try structure.
 * The thrown exception will be an instance of ErrorException class.
 *
 * @author Tamás
 */
class ErrorException extends TulipException
{

	private static $prevHandler;
	private static $prevErrorLevel;
	private $severity;

	public static function setUpErrorHandling()
	{
		self::$prevHandler = \set_error_handler(array( self, 'errorHandler' ));
		self::$prevErrorLevel = \error_reporting(0);
	}

	public static function restoreErrorHandling()
	{
		\set_error_handler(self::$prevHandler);
		\error_reporting(self::$prevErrorLevel);
	}

	final private static function errorHandler( int $errno, string $errstr,
			string $errfile = __FILE__, int $errline = __LINE__,
			array $errcontext = array( ) )
	{
		return true;
	}

	public function getSeverity()
	{

	}

}