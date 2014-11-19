<?php

class User extends CI_Controller {

  function __construct() {
    // Call the Controller constructor
    parent::__construct();
    $this->load->model('user_model');
  }

  // user table for admin
  function index() {
    $users = $this->user_model->getAll();
    $data = array(
      'title' => 'list of users',
      'main' => 'user/list',
      'users' => $users
    );
    $this->load->view('template', $data);
  }

  function show($id) {
    $user = $this->user_model->get($id);
    $data = array(
      'title' => 'Account Info for '.$product->login,
      'main' => 'user/show',
      'user' => $user
    );
    $this->load->view('template', $data);
  }

  // new action
  function register() {
    $data = array(
      'title' => 'Sign up for new account',
      'main' => 'user/register'
    );
    $this->load->view('template', $data);
  }

  function create() {
    
  }

  function edit($id) {
    $user = $this->user_model->get($id);
    $data = array(
      'title' => 'Editing user',
      'main' => 'user/edit',
      'user' => $user
    );
    $this->load->view('template', $data);
  }

  function update() {
    
  }

  function delete() {
    
  }

}
?>