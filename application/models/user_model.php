<?php
class User_model extends CI_Model {

	function getAll()
	{
		$query = $this->db->get('customers');
		return $query->result('User');
	}

	function get($id)
	{
		$query = $this->db->get_where('customers',array('id' => $id));
		return $query->row(0,'User');
	}

	function delete($id) {
		return $this->db->delete("customers",array('id' => $id ));
	}

	function insert($user) {
		return $this->db->insert("customers", array('first' => $user->first,
				                                  'last' => $user->last,
											      'login' => $user->login,
											      'password' => $user->password,
												  'email' => $user->email));
	}

	function update($user) {
		$this->db->where('id', $user->id);
		return $this->db->update("customers", array('first' => $user->first,
				                                  'last' => $user->last,
											      'login' => $user->login,
											      'password' => $user->password,
												  'email' => $user->email));
	}

}
?>
