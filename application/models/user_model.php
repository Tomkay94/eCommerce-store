<?php
class User_model extends CI_Model {

  function getAll()
  {
    $query = $this->db->get('customers');
    return $query->result('MUser');
  }

  function get($login)
  {
    $query = $this->db->get_where('customers', array('login' => $login));

    if ($query && $query->num_rows() > 0)
      return $query->row(0, 'MUser');
    else
      return null;
  }

  function delete($id) {
    return $this->db->delete("customers",array('id' => $id ));
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

}
?>
