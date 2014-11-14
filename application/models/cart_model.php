<?php
class Cart_model extends CI_Model {

	function getAll()
	{  
		$query = $this->db->get('carts');
		return $query->result('Cart');
	}  
	
	function get($id)
	{
		$query = $this->db->get_where('cart',array('id' => $id));
		
		return $query->row(0,'Cart');
	}
	
	function delete($id) {
		return $this->db->delete("carts",array('id' => $id ));
	}
	
	function insert($cart) {
		return $this->db->insert("carts", array('name' => $cart->name,
				                                  'description' => $cart->description,
											      'price' => $cart->price,
												  'photo_url' => $cart->photo_url));
	}
	 
	function update($cart) {
		$this->db->where('id', $cart->id);
		return $this->db->update("carts", array('name' => $cart->name,
				                                  'description' => $cart->description,
											      'price' => $cart->price));
	}
	
	
}
?>
