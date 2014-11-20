<?php

class Checkout extends CI_Controller {

	function __construct() {
    // Call the Controller constructor
    parent::__construct();
	}

	function show() {
		$this->load->helper('date');
		$this->load->view('checkout/show');
		// show a view that has a form for the credit card showing the order
	}

	function validate_order() {
		$valid = TRUE;
		
		if($valid) {
			// create the order record 
		}
	}



}

?>
