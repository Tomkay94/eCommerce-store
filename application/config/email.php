<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| EMAIL CONFING
| -------------------------------------------------------------------
| Configuration of outgoing mail server.
| */

$config['newline'] = "\r\n";
$config['crlf'] = "\n"; 
$config['charset']='utf-8';
$config['priority']=3;
$config['protocol']='smtp';
$config['smtp_host']='ssl://smtp.googlemail.com';
$config['smtp_port']=465;
$config['smtp_user']='estore.mailer@gmail.com';
$config['smtp_pass']='IJustWannaUseGoogleSMTP';

/* End of file email.php */
/* Location: ./system/application/config/email.php */
