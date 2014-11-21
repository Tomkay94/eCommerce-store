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
    $this->form_validation->set_rules(
      'creditcard_number',
      'Creditcard Number',
      'required|numeric|xss_clean|exact_length[16]'
    );
    $this->form_validation->set_rules(
      'creditcard_month',
      'Creditcard Month',
      'required|numeric|xss_clean|exact_length[2]|greater_than[0]|less_than[13]'
    );
    $this->form_validation->set_rules(
      'creditcard_year',
      'Creditcard Year',
      'required|numeric|xss_clean|exact_length[2]|greater_than['.(number_format(sprintf("%02s", date("y"))) - 1).']'
    );

    // if the credit card expires this year, check the month
    if (number_format($_POST['creditcard_year']) == number_format(sprintf("%02s", date('y')))) {
      if (number_format($_POST['creditcard_month']) < (number_format(sprintf("%02s", date('m'))))) {
        $this->session->set_flashdata('warning', 'that credit card has expired');
        redirect('checkout/show', 'refresh');
      }
    }

    // credit card is good, proceed with form validation
    if ($this->form_validation->run() == true) {
      $order = new $this->MOrder();
      $order->customer_id = $this->session->userdata('id');
      $order->total = $this->cart->total();
      $order->creditcard_number = $_POST['creditcard_number'];
      $order->creditcard_month = $_POST['creditcard_month'];
      $order->creditcard_year = $_POST['creditcard_year'];

      // attempt to create an Order record
      if ($order->id = $this->MOrder->insert($order, $this->cart->contents())) {
        $this->session->set_flashdata('info', 'order successfully created, a email will be sent to you.');
        // Send the order email
        $this->send_mail($order);
        // remove contents from cart as those were just bought
        $this->cart->destroy();
      }

      // the order record could not be created  
      else {
        $this->session->set_flashdata('warning', 'failed to process transaction');
        redirect('checkout/show', 'refresh');
      }
    }

    // credit card validation failed
    else {
      $this->session->set_flashdata('warning', 'those credentials were not valid');
      redirect('checkout/show', 'refresh');
    }

    redirect('store', 'refresh');
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

  // simpler to just put the method here..
  function send_mail($order) {
    $this->email->initialize($this->config->config);
    $this->email->set_mailtype("html");



    $this->email->from('estore.mailer@gmail.com', 'eStore-Mailer-no-reply');
    $this->email->to($this->session->userdata('email'));

    $order_items = $this->Order_Item->find_all_from_order($order->id);
    
    $this->email->subject('Your purchase receipt:');
    $receipt = "
    <p>Hi there,</p>
    <p>Thanks for your order at eStore. You were charged <strong>$$order->total</strong> 
    through your creditcard ($order->creditcard_number).</p>
    
    $order_items

    <p>Your order ID is $order->id.</p>
    <p>Please keep it safe for future reference.</p>
    ";

    $this->email->message($receipt);

    // Attempt to send the email
    if($this->email->send()) {
      $this->session->set_flashdata('info', 'Purchase receipt successfully sent to ' .
                                    $this->session->userdata('email') . '!');
    } else {
      $this->session->set_flashdata('warning', 'an error occured during send mail');
      show_error($this->email->print_debugger());
    }
  }
}
?>
