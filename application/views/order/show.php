<section class="closed-container">
  <h2 class="container-header">Transaction #<?= $order->id ?></h2>

  <table class="table">
    <thead>
      <tr>
        <th>transaction id</th>
        <th>customer username</th>
        <th>order time</th>
        <th>total</th>
      </tr>
    </thead>
    <tr>
      <td><?= $order->id ?></td>
      <td><?= $this->MUser->find($order->customer_id)->login ?></td>
      <td><?= $order->order_date . ' ' . $order->order_time ?></td>
      <td><?= $order->total ?></td>
      <td><?= anchor("order/delete/$order->id", 'Delete',
                      "onClick='return confirm(".
                        '"Do you really want to delete this record?"'.
                      ");'"
                    );
          ?>
      </td>
    </tr>
  </table>

  <h2 class="container-header">Items purchased</h2>

  <table class="table">
    <thead>
      <tr>
        <th>item name</th>
        <th>description</th>
        <th># purchased</th>
      </tr>
    </thead>
  <?php
    $order_items = $this->Order_Item->find_all_from_order($order->id);
    foreach ($order_items as $order_item) {
      $item = $this->product_model->get($order_item->product_id);
      echo "<tr>";
      echo "<td>" . $item->name . "</td>";
      echo "<td>" . $item->description . "</td>";
      echo "<td>" . $order_item->quantity . "</td>";

      echo "<td>" . anchor("store/read/$item->id", 'Show product details') . "</td>";
      echo "</tr>";
    }
  ?>
  </table>

</section><!-- ./closed-container -->
