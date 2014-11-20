<?php
class MUser {
  public $id;
  public $first;
  public $last;
  public $login;
  public $password;
  public $email;

  function passwordMatch($pass) {
    return $this->password == pass;
  }

}
