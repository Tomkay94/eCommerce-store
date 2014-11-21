<?php
class MUser extends CI_Model {
  public $id;
  public $first;
  public $last;
  public $login;
  public $password;
  public $email;

  // helpers
  function passwordMatch($pass) {
    return $this->password == $pass;
  }

  function isAdmin($login) {
    return strtolower($login) == 'admin';
  }

  /*
    DB Access
    Note: these functions do not mutate $this user itself
  */

  function all() {
    $query = $this->db->get('customers');
    return $query->result('MUser');
  }

  function find($id) {
    $query = $this->db->get_where('customers', array('id' => $id));

    if ($query && $query->num_rows() > 0)
      return $query->row(0, 'MUser');
    else
      return null;
  }

  function find_by_username($login) {
    $query = $this->db->get_where('customers', array('login' => $login));

    if ($query && $query->num_rows() > 0)
      return $query->row(0, 'MUser');
    else
      return null;
  }

  function insert($user) {
    return $this->db->insert("customers", $user);
  }

  function update($user) {
    $this->db->where('id', $user->id);
    return $this->db->update("customers", array('first' => $user->first,
                                                'last' => $user->last,
                                                'password' => $user->password,
                                                'email' => $user->email));
  }

  function delete($id) {
    return $this->db->delete("customers", array('id' => $id ));
  }

  // except admin user
  function delete_all() {
    $this->db->trans_start();
    $this->db->where("UPPER(customers.login) != 'ADMIN'");
    $this->db->delete("customers");
    $this->db->trans_complete();

    return $this->db->trans_status();
  }

}
