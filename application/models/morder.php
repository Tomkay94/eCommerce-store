<?php
class MOrder extends CI_Model {
  public $id;
  public $customer_id;
  public $order_date;
  public $order_time;
  public $total;
  public $creditcard_number;
  public $creditcard_month;
  public $creditcard_year;

  /*
    DB Access
    Note: these functions do not mutate $this user itself
  */

  function all() {
    $query = $this->db->get('orders');
    return $query->result('Order');
  }

  function find($id) {
    $query = $this->db->get_where('orders', array('id' => $id));
    return $query->row(0, 'Order');
  }

  // create order objects and the items together in an trasaction
  // $order is an Order object, $order_items is an shopping cart array..
  function insert($order, $order_items) {
    $this->db->trans_start();
    // create order
    $this->db->insert("orders", array('customer_id' => $order->customer_id,
                                      'order_date' => $order->order_date,
                                      'order_time' => $order->order_time,
                                      'total' => $order->total,
                                      'creditcard_number' => $order->creditcard_number,
                                      'creditcard_month' => $order->creditcard_month,
                                      'creditcard_year' => $order->creditcard_year));
    $order_id = $this->db->insert_id();
    // create order items
    foreach ($order_items as $order_item) {
      $this->db->insert("order_items", array('order_id' => $order_id,
                                             'product_id' => $order_item['id'],
                                             'quantity' => $order_item['qty']));
    }
    $this->db->trans_complete();

    return $this->db->trans_status();
  }

  function delete($id) {
    return $this->db->delete("orders", array('id' => $id ));
  }

  function delete_all() {
    // is delete sequential?
    $this->db->trans_start();
    $this->db->query("DELETE FROM orders");
    $this->db->trans_complete();

    return $this->db->trans_status();
  }

}
