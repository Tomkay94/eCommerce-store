<?php
class Order_Item extends CI_Model {
  public $id;
  public $order_id;
  public $product_id;
  public $quantity;

  function find($id) {
    $query = $this->db->get_where('order_items', array('id' => $id));
    return $query->row(0, 'Order_Item');
  }

  function find_all_from_order($id) {
    $query = $this->db->get_where('order_items', array('order_id' => $id));
    return $query->result('Order_Item');
  }

  // delete will automatically handled by database constraints
}
