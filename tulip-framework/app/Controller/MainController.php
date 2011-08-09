<?php

namespace Controller;

class MainController extends Controller
{

	public function index()
	{
		$this->loadComposition();
	}

}