<?php

namespace Controller\Error;

class ErrorController extends \Controller\Controller
{

	public function __construct()
	{
		$this->composition = 'ErrorComposition';
	}

	public function main()
	{
		$this->loadComposition();
	}

}