<?php

class Checkout extends CI_Controller {

  function __construct() {
    // Call the Controller constructor
    parent::__construct();
  }

  function show() {
    $this->load->helper('date');

    // show a view that has a form for the credit card showing the order
    $data = array(
        'title' => 'Checkout',
        'main' => 'checkout/show'
    );
    $this->load->view('template', $data);
  }
}

?>
