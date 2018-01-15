<?php

class TestController {
	private $model;
	function __construct ($model)
	{
		$this->model=$model;
	}

	public function test(){
		return $this->model->returnTestData();
	}

}


?>