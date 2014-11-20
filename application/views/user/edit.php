<h2>Edit User #<?= $user->id ?></h2>

<?php
  echo form_open("user/update/$user->id");

//  echo form_label('Username');
//  echo form_error('login');
//  echo form_input('login', set_value('login', $user->login), "required");

//  echo form_label('Email');
//  echo form_error('email');
//  echo form_input('email', set_value('email', $user->email), "required");

  echo form_label('First Name'); 
  echo form_error('first');
  echo form_input('first', set_value('first', $user->first));

  echo form_label('Last Name'); 
  echo form_error('last');
  echo form_input('last', set_value('last', $user->last));

//  echo form_label('Old Password');
//  echo form_error('pass_old');
//  echo form_input('pass_old', "", "required");

  echo form_label('New Password');
  echo form_error('pass');
  echo form_input('pass', "", "required");

  echo form_label('New Password Confirmation');
  echo form_error('pass_conf');
  echo form_input('pass_conf', "", "required");
  echo '<br>';

  echo form_submit('submit', 'Update');
  echo form_close();

  echo "<p>" . anchor("user/show/$user->id",'Back') . "</p>";
?>
