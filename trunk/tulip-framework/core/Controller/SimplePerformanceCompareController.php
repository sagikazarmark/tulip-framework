<?php

namespace Controller;

use System\Diagnostics;

class SimplePerformanceCompareController extends Controller
{

	public function index( $first, $second, $count )
	{
		set_time_limit(-1);
		$startTime = Diagnostics\Benchmark::getMicrotime();
		for ($i = 1; $i <= $count; $i++) {
			@$first();
		}
		$partTime = Diagnostics\Benchmark::getMicrotime();
		for ($i = 1; $i <= $count; $i++) {
			@$second();
		}
		$endTime = Diagnostics\Benchmark::getMicrotime();
		header('Content-Type: text/plain');
		echo "First result: " . ($partTime - $startTime) . "\n";
		echo "Second result: " . ($endTime - $partTime) . "\n";
		echo "Difference: " . abs(($partTime - $startTime) - ($endTime - $partTime)) . "\n";
	}

}