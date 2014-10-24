<?php

class Products extends CI_Controller {
  // Loads all products
  function index() {   
    $this->load->model('product');
    $data['products'] = $this->product->get_products();
  }
  
  function create() {
  
  }
  
  function delete() {
  
  }
}

?>