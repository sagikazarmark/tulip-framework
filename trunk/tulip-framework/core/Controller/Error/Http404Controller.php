<?php

namespace Controller\Error;

class Http404Controller extends \Controller\Error\ErrorController
{

	public function __construct()
	{
		parent::__construct();
		$this->view = 'Http404';
	}

}