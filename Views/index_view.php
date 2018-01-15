<?php

class IndexView {

	private $model;
	private $controller;
	

    function __construct($controller,$model)
    {
			$this->controller=$controller;
			$this->model=$model;
			print "Home -";
	}

	public function index()
	{	// this pretty much sums up working for view part.
		return $this->controller->sayWelcome();
	}


}


?>