<?php

class Users extends CI_Controller {
  // Loads all users
  function index() {
    $this->load->model('user');
    $data['users'] = $this->user->get_users();
  }

  function create() {
  
  }
  
  function delete() {
  
  }
}

?>