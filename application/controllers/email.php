<?php

class Email extends CI_Controller {

  /* Constructor */
  function __construct() {
    parent::__construct();	
  }

  /* Sends purchase receipt to user */
  function send_mail() {
    $config = array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'port' => 465,
      'smtp_user' => 'estore.mailer@gmail.com',
      'smtp_pass' => 'estoremailer',
      'mailtype' => 'html',
      'charset' => 'utf-8',
      'newline' => "\r\n"
    );

    // Load the library with the email configuration
    $this->load->library('email', $config);
    
    $this->email->from('estore.mailer@gmail.com', 'eStore-Mailer-no-reply');
    $this->email->to($this->session->userdata('email'));
    $this->email->subject('some subject');
    $this->email->message('its working!');

    // Attempt to send the email
    if($this->email->send()) {
      redirect('store/index', 'refresh');
    } else {
      show_error($this->email->print_debugger());
    }
    $this->session->set_flashdata('warning', 'Purchase receipt successfully sent to ' . $this->session->userdata('email') . '!');  
  }
}
