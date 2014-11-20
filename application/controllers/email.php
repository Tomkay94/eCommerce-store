<?php

class Email extends CI_Controller {

  /* Constructor */
  function __construct() {
    // Call the Controller constructor
    parent::__construct();	
  }

  /* Sends purchase receipt to user */
  function send_mail($user) {
    // Setup the email protocol configuration
    $config = Array(
	  	'protocol' => 'smtp',
	  	'smtp_host' => 'ssl://smtp.googlemail.com',
	  	'smtp_port' => 465,
	  	'smtp_user' => 'estore.mailer@gmail.com',
	  	'smtp_pass' => 'estoremailer1',
	  	'mailtype' => 'html',
	  	'charset' => 'iso-8859-1',
	  	'wordwrap' => TRUE
		);

    // Populate the email
    $message = '';
    $this->load->library('email', $config);
    $this->email->set_newline("\r\n");
    $this->email->from('estore.mailer@gmail.com');
    $this->email->to($user->email);
    $this->email->subject('Purchase Receipt');
    $this->email->message($message);
  
  	// Attempt to send the email
    if($this->email->send()) {
      echo 'Purchase receipt successfully sent to ' . $user->email . '!';
    } else {
     show_error($this->email->print_debugger());
    }
	}
}

?>