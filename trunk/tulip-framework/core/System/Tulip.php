<?php

namespace System;

/**
 * Description of Tulip
 *
 * @author Tamás
 */
class Tulip extends \Object
{

	public static $viewExtensions = array('view.php', 'php', 'phtml', 'html', 'htm');

	public static function init()
	{
		self::initConstants();
		self::setupEnvironment();
	}

	public static function initConstants()
	{
		/**
		 * Simple alias for DIRECTORY_SEPARATOR
		 */
		\define('DS', \DIRECTORY_SEPARATOR);
		/**
		 * The path to all the files related to the Tulip application
		 * For example:
		 * <code>/var/www</code>
		 */
		\define('ROOT', dirname(dirname(dirname(__FILE__))));
		/**
		 * Path to ROOT . DS . 'core'
		 * For example:
		 * <code>/var/www/core</code>
		 */
		\define('CORE', ROOT . DS . 'core');
		/**
		 * Path to ROOT . DS . 'app'
		 * For example:
		 * <code>/var/www/app</code>
		 */
		\define('APP', ROOT . DS . 'app');
	}

	public static function setupEnvironment()
	{
		\define('REQUEST_URL', $_GET['requestURL']);
		unset($_GET['requestURL']);
	}

}

?>
