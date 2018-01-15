<?php

class IndexModel {
	

		private $dafault_message= " Welcome to my mini-php framework!! :D ";

	    function __construct()
        {

        }

        public function defaultIndex()
        { // default message sent !! 
            return $this->dafault_message;
        }


}


?>