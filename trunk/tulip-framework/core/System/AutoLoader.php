<?php

namespace System;

/**
 * At least this class must be included the old fashioned way, after that
 * you can use its load function to load php files, and it will check wether
 * the file exists in the application extension files or the core, or not.
 *
 * @author Tamás
 * @todo: Documentation needed
 */
class AutoLoader
{

	private static $loaded = false;

	public static function setup()
	{
		self::load('System\ErrorHandling\TulipException.php');
		self::load('System\IO\IOException.php');
		self::load('System\IO\FileNotFoundException.php');
		\spl_autoload_register(array('self', 'autoLoad'));
		self::$loaded = true;
	}

	public static function autoLoad($class_name)
	{
		try {
			$found = false;
			$lastException = null;
			foreach (\explode(',', \spl_autoload_extensions()) as $extension) {
				try {
					self::load($class_name . $extension);
					$found = true;
				} catch (IO\FileNotFoundException $e) {
					$lastException = $e;
				}
			}
			if (!$found) {
				if (!empty($lastException)) {
					throw $lastException;
				} else {
					throw new ErrorHandling\TulipException('The "System\AutoLoader::autoload()" function couldn\'t determine what happened. Probably you don\'t have any extension registered with spl_autoload_extensions().', 0, null, 'The system encountered serious problems, from which it couldn\'t recover.');
				}
			}
		} catch (IO\FileNotFoundException $e) {
			throw new ErrorHandling\AutoLoaderException($class_name, $e);
		}
	}

	public static function load($relPath)
	{
		$actualPath = self::file_exists($relPath);
		if (false !== $actualPath) {
			require_once $actualPath;
		} else {
			if (self::$loaded) {
				throw new IO\FileNotFoundException($relPath, null);
			} else {
				throw new \Exception("The file \"$relPath\" cannot be found.");
			}
		}
	}

	/**
	 * Determines the actual path of a file from a virtual path, which could be
	 * found in the core or the application/expansion.
	 * For example:
	 * <code>
	 * $path = AutoLoader::file_exists( 'Controller\\MyController.php' ); // Returns /var/www/app/Controller/MyController.php
	 * if (false !== $path) { //Checks if the file is found, and if it is, the $path can be used to find it
	 *	// found
	 * } else {
	 *	// not found
	 * }
	 * </code>
	 * @param string $relPath The relative path to the file
	 * @return mixed Returns false, if not found, and the full path to the file,
	 * if it could be resolved
	 */
	public static function file_exists($relPath)
	{
		$relPath = \str_replace(array("\\", "/"), \DIRECTORY_SEPARATOR, $relPath);
		$root = \dirname(\dirname(\dirname(__FILE__)));
		$corePath = $root . \DIRECTORY_SEPARATOR . 'core' . \DIRECTORY_SEPARATOR . $relPath;
		$expPath = $root . \DIRECTORY_SEPARATOR . 'app' . \DIRECTORY_SEPARATOR . $relPath;
		if (\file_exists($expPath)) {
			return $expPath;
		} elseif (\file_exists($corePath)) {
			return $corePath;
		} else {
			return false;
		}
	}

}

/*
 * 
 */
AutoLoader::setup();
?>
