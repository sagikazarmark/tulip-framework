<?php

namespace Controller;

class MainController extends Controller
{

	public function index()
	{
		$this->view['title'] = 'Tulip Demo 2012!';
		$this->loadComposition('cump');
	}

	public function mindegmas()
	{
		$a = "cucc";
		$c = "cuccC";
		{
			$b = "cuccB";
			$c = "cuccCC";
		}
		echo $a;
		echo $b;
		echo $c;
	}
	
}