<?php

class User extends CI_Controller {

  function __construct() {
    // Call the Controller constructor
    parent::__construct();
  }

  function _remap($method, $params = array()) {
    // enforce access control to protected functions
    $protected = array('index', 'show', 'edit', 'update', 'delete', 'delete_all');
    $admin_only = array('delete', 'delete_all');

    // authentication
    if (in_array($method, $protected) && !$this->session->userdata('signed_in')) {
      $this->session->set_flashdata('warning', 'we will need to authenticate you first!');
      redirect('user/login', 'refresh');
    }

    // authorization
    if (in_array($method, $admin_only) && !$this->MUser->isAdmin($this->session->userdata('login'))) {
      $this->session->set_flashdata('warning', 'only admin can perform this operation');
      redirect('', 'refresh');
    }

    return call_user_func_array(array($this, $method), $params);
  }

  // user table for admin
  function index() {
    $users = $this->MUser->all();
    $data = array(
      'title' => 'list of users',
      'main' => 'user/list',
      'users' => $users
    );
    $this->load->view('template', $data);
  }

  function show($id) {
    $user = $this->MUser->find($id);
    $data = array(
      'title' => 'Account Info for '.$user->login,
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
    $this->load->library('form_validation');
    $this->form_validation->set_rules('login', 'Username', 'required');
    $this->form_validation->set_rules('pass', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('warning', 'You have not filled in the required fields');
        redirect('user/login', 'refresh');

    } else {
      $login = $this->input->post('login');
      $pass = $this->input->post('pass');

      $user = $this->MUser->find_by_username($login);

      if (isset($user) && $user->passwordMatch($pass)) {
        $this->session->set_userdata('signed_in', true);
        $this->session->set_userdata($user);
        $this->session->set_flashdata('info', 'Welcome back!');
        redirect('', 'refresh');
      } else {
        $this->session->set_flashdata('warning', 'Incorrect username or password!');
        redirect('user/login', 'refresh');
      }
    }
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
    $this->load->library('form_validation');
    $this->form_validation->set_rules('login', 'Username', 'required|xss_clean|is_unique[customers.login]');
    $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|is_unique[customers.email]|valid_email');
    $this->form_validation->set_rules('first', 'First Name', 'required|xss_clean');
    $this->form_validation->set_rules('last', 'Last Name', 'required|xss_clean');
    $this->form_validation->set_rules('pass', 'Password', 'required|xss_clean|min_length[6]');
    $this->form_validation->set_rules('pass_conf', 'Password Confirmation', 'required|xss_clean|matches[pass]');

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('warning',
          'Sorry, some of the data you provided does not pass our requirement filter.');
        redirect('user/register', 'refresh');

    } else {
      $user = new MUser();

      $user->login = $this->input->post('login');
      $user->email = $this->input->post('email');
      $user->first = $this->input->post('first');
      $user->last = $this->input->post('last');
      $user->password = $this->input->post('pass');
      $pass_conf = $this->input->post('pass_conf');

      // check password confirmation
      if (!$user->passwordMatch($pass_conf)) {
        $this->session->set_flashdata('warning', 'Passwords do not match! Please try again.');
        redirect('user/register', 'refresh');
      }

      if ($this->MUser->insert($user)) {
        $this->session->set_flashdata('info', 'Success! You are now registered.');
        redirect('user/login', 'refresh');
      } else {
        $this->session->set_flashdata('warning', 'Our DB encountered error storing your data.');
        redirect('user/register', 'refresh');
      }

    }
  }

  function logout() {
    // pretty hackish, but it signs the client out.
    $this->session->unset_userdata('signed_in');
    $this->cart->destroy();
    $this->session->set_flashdata('info', 'You have signed out.');
    redirect('store', 'refresh');
  }

  function edit($id) {
    $user = $this->MUser->find($id);
    $data = array(
      'title' => 'Editing user',
      'main' => 'user/edit',
      'user' => $user
    );
    $this->load->view('template', $data);
  }

  function update($id) {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('first', 'First Name', 'required|xss_clean');
    $this->form_validation->set_rules('last', 'Last Name', 'required|xss_clean');
    $this->form_validation->set_rules('pass', 'New Password', 'required|matches[pass_conf]|xss_clean');
    $this->form_validation->set_rules('pass_conf', 'New Password Confirmation', 'required|xss_clean');

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('warning',
          'Sorry, some of the data you provided does not pass our requirement filter.');
        redirect('user/edit/'.$this->session->userdata('id'), 'refresh');

    } else {

      // only admin can modify other user's data
      if (!$this->MUser->isAdmin($this->session->userdata('login'))) {
        // never ever change this session variable!
        $id = $this->session->userdata('id');
      }

      $user = $this->MUser->find($id);
      $user->first = $this->input->post('first');
      $user->last = $this->input->post('last');
      $user->password = $this->input->post('pass');
      $pass_conf = $this->input->post('pass_conf');

      // check password confirmation
      if (!$user->passwordMatch($pass_conf)) {
        $this->session->set_flashdata('warning', 'Passwords do not match! Please try again.');
        redirect('user/register', 'refresh');
      }

      if ($this->MUser->update($user)) {
        $this->session->set_flashdata('info', 'User info successfully modified.');
        redirect('user/show/'.$this->session->userdata('id'), 'refresh');
      } else {
        $this->session->set_flashdata('warning', 'Unsuccessful update');
        redirect('user/edit/'.$this->session->userdata('id'), 'refresh');
      }

    }
  }

  function delete($id) {
    // only admin can reach here
    if ($this->session->userdata('id') == $id) {
      $this->session->set_flashdata('warning', 'Admin account cannot be removed!');
      redirect('user/show/'.$this->session->userdata('id'), 'refresh');
    }

    if ($this->MUser->delete($id)) {
      $this->session->set_flashdata('info', 'Account deleted.');
      redirect('user', 'refresh');
    } else {
      $this->session->set_flashdata('warning', 'Error deleteing account.');
      redirect('user', 'refresh');
    }
  }

  function delete_all() {
    // only admin can reach here

    if ($this->MUser->delete_all()) {
      $this->session->set_flashdata('info', 'All non-admin user accounts removed.');
      redirect('user', 'refresh');
    } else {
      $this->session->set_flashdata('warning', 'Error deleteing account.');
      redirect('user', 'refresh');
    }
  }

}
?>
