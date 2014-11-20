<?php

class User extends CI_Controller {

  function __construct() {
    // Call the Controller constructor
    parent::__construct();
    $this->load->model('user_model');
  }

  // public?
  function _remap($method, $params = array()) {
    // enforce access control to protected functions
    $protected = array('index', 'show', 'edit', 'update', 'destroy');

    // authentication
    if (in_array($method, $protected) && !$this->session->userdata('user')) {
      $this->session->set_flashdata('warning', 'we will need to authenticate you first!');
      redirect('user/login', 'refresh');
    }

    // TODO: authorization???

    return call_user_func_array(array($this, $method), $params);
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

  function login() {
    $data = array(
      'title' => 'Sign in',
      'main' => 'user/login'
    );
    $this->load->view('template', $data);
  }

  function process_login() {
    
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

  function destroy() {
    
  }

}
?>