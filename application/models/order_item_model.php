<?php
class OrderItem_model extends CI_Model {

	function get($id)
	{
		$query = $this->db->get_where('order_items',array('id' => $id));
		return $query->row(0,'OrderItem');
	}

	function delete($id) {
		return $this->db->delete("order_items",array('id' => $id ));
	}

	function insert($order) {
		return $this->db->insert("order_items", array('order_id' => $order_item->order_id,
                                                      'product_id' => $order_item->product_id,
                                                      'quantity' => $order_item->quantity));
	}

	function update($order) {
		$this->db->where('id', $order->id);
		return $this->db->update("order_items", array('quantity' => $order_item->quantity));
	}

}
?>
