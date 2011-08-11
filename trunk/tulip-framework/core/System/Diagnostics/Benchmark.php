<?php

namespace System\Diagnostics;

class Benchmark extends \Object
{
	
	public static function getMicrotime()
	{
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
	
}