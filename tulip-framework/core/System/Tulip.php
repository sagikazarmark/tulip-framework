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

	public static function init($initScript = NULL)
	{
		self::initConstants($initScript);
		self::setupEnvironment();
	}

	public static function initConstants($initScript = NULL)
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
		if (!is_null($initScript)) {
			$appName = basename(dirname(dirname($initScript)));
			if ($appName == 'core') {
				$appName = 'app';
			}
		} else {
			$appName = "app";
		}
		/**
		 * Path to ROOT . DS . '<appfoldername>'
		 * For example:
		 * <code>/var/www/app</code>
		 * <code>/var/www/app2</code>
		 * From this you can see, that multiple apps can use the same Core. This
		 * constant always returns the path for the actual web application.
		 */
		\define('APP', ROOT . DS . $appName);
	}

	public static function setupEnvironment()
	{
		\define('REQUEST_URL', $_GET['requestURL']);
		unset($_GET['requestURL']);
	}

}

?>
