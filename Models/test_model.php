<?php

class TestModel{

	private $message = " Message is returned when Test Model called. ";
	public function __construct(){

	}

	public function returnTestData()
	{
		return $this->message;
	}
}



?>