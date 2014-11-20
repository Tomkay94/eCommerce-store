<!-- Page Content -->
<div class="container" id="products-list">

  <div class="row">

    <div class="col-md-3">
		<h2>Products</h2>
    
          <div class="list-group">
              <a href=<?= base_url() . "store/newForm" ?> class="list-group-item">Add New Product</a>
              <a href="#" class="list-group-item">Checkout</a>
          </div>

          <!-- Show the shopping cart, if it exists -->
          <? if ($cart = $this->cart->contents()): ?>
            <table class="table" id="shopping-cart">
              <caption id="cart-header">Shopping Cart</caption>
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <? foreach ($cart as $product) { ?>
                  <tr>
                    <td><?= $product['name'] ?></td>
                    <td><?= '$' . $product['subtotal'] ?></td>
                    <td><?= form_input('item_' . $product['rowid'], $product['qty'], "class='form-control'", "required") ?></td>
                    <td><?= anchor(base_url() . 'cart/remove/' . $product['rowid'], 'X'); ?></td>
                  </tr>
                <? } ?>
              </tbody>
              <td><strong>Total:</strong></td>
              <td><?= '$' . $this->cart->total();?></td>  
            </table>
            
          <? endif ?>
      </div><!-- ./col-md-3 -->

      <div class="col-md-9">

        <div class="row">
        <? foreach ($products as $product) { ?>
          <?= form_open('cart/add'); ?>
          <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">
		          <?= "<img src='" . base_url() . "images/product/" . $product->photo_url . "' width='320px' height='150px'/>"; ?>
              <div class="caption">
                <h4 class="pull-right">$<?= $product->price ?></h4>
                <h4><a href=<?= base_url() . "store/read/$product->id"?>><?= $product->name ?></a></h4>
                <p><?= $product->description ?></p>
                    
                <!-- product actions -->
				        <!-- if admin, show edit and delete links -->
                <?= anchor(base_url() . "store/delete/$product->id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'"); ?>
				        <?= anchor(base_url() . "store/editForm/$product->id",'Edit'); ?>
				
                <?= anchor(base_url() . "store/read/$product->id",'View'); ?>
              </div>
              <?= form_submit('action', 'Add to Cart', "class='btn btn-default'"); ?>
            </div>
          </div>
          <?= form_hidden('id', $product->id); ?>
          <?= form_close(); ?>
        <? } ?><!-- end foreach -->
        </div><!-- ./row -->
      </div><!-- ./col-md-9 -->
  </div><!-- ./row -->
</div><!-- ./container -->