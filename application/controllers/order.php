<?php

class Order extends CI_Controller {

  function __construct() {
    // Call the Controller constructor
    parent::__construct();
  }

  function _remap($method, $params = array()) {
    // enforce access control to protected functions
    $protected = array('index', 'show', 'delete', 'delete_all');
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
    $orders = $this->MOrder->all();
    $data = array(
      'title' => 'all orders',
      'main' => 'order/list',
      'orders' => $orders
    );
    $this->load->view('template', $data);
  }

  function show($id) {
    $order = $this->MOrder->find($id);
    $data = array(
      'title' => 'Details for order #'.$order->id,
      'main' => 'order/show',
      'order' => $order
    );
    // maybe also load up all the order items first..
    $this->load->view('template', $data);
  }

  function create() {
    $this->load->library('form_validation');
    $this->load->model('MOrder');

    $order = new $this->MOrder();
    $order->customer_id = $this->session->userdata('id');
    $order->total = $this->cart->total();
    $order->creditcard_number = $_POST['creditcard_number'];
    $order->creditcard_month = $_POST['creditcard_month'];
    $order->creditcard_year = $_POST['creditcard_year'];

    if ($this->MOrder->insert($order, $this->cart->contents())) {
      $this->session->set_flashdata('info', 'order successfully created, a email will be sent to you.');
      // Send the order email
      redirect('email/send_mail', 'refresh');
    } else {
      $this->session->set_flashdata('warning', 'failed to process transaction');
      redirect('store', 'refresh');
    }
  }

  function delete($id) {
    if (!isset($id)) {
      $this->session->set_flashdata('warning', 'no id provided!');
      redirect('order', 'refresh');
    }

    if ($this->MOrder->delete($id)) {
      $this->session->set_flashdata('info', 'order successfully removed.');
    } else {
      $this->session->set_flashdata('warning', 'cannot remove this record, try again.');
    }
    redirect('order', 'refresh');
  }

  function delete_all() {
    if ($this->MOrder->delete_all()) {
      $this->session->set_flashdata('info', 'all orders successfully removed.');
    } else {
      $this->session->set_flashdata('warning', 'error occured while processing orders removal.');
    }
    redirect('order', 'refresh');
  }

}

?>
