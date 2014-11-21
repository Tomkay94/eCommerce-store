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
      'smtp_port' => 587,
      'smtp_user' => 'estore.mailer@gmail.com',
      'smtp_pass' => 'estoremailer'
    );

    // Load the library with the email configuration
    $this->load->library('email', $config);
    $this->email->set_newline("\r\n");
    $this->email->set_mailtype('html');

    $this->email->from('estore.mailer@gmail.com', 'eStore-no-reply');
    $this->email->to($this->session->userdata('email'));
    $this->email->subject('some subject');
    $this->email->message('its working!');

    // Attempt to send the email
    if($this->email->send()) {
      redirect('store/index', 'refresh');
    $this->session->set_flashdata('warning', 'Purchase receipt successfully sent to ' . $this->session->userdata('email') . '!');  

    } else {
      show_error($this->email->print_debugger());
    }
  }
}

?>