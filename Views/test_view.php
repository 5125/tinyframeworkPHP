<?php

class TestView {
	
	private $model;
	private $controller;

	function __construct ($controller,$model){
		$this->controller=$controller;
		$this->model=$model;
		print "Test: ";
	}

	public function now()
	{
		return $this->model->returnTestData();
	}
}



?>