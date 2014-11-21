<!-- Page Content -->
<div class="container" id="products-list">
  <div class="row">

    <div class="col-md-3">
    <?php
      if ($this->session->userdata('signed_in') &&
          $this->MUser->isAdmin($this->session->userdata('login'))):
    ?>
      <h2>Products</h2>

      <div class="list-group">
        <?= anchor(base_url() . 'store/newForm', "Add New Product", "class='list-group-item'"); ?>
      </div>
    <?php endif; ?>

      <!-- Show the shopping cart, if it exists -->

        <table class="table" id="shopping-cart">
          <caption id="cart-header">Shopping Cart</caption>
      <?php
        if ($cart = $this->cart->contents()) {
      ?>
          <thead>
            <tr>
              <th>Product</th>
              <th>Price</th>
              <th>Quantity</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($cart as $product) { ?>
              <tr>
                <td><?= $product['name'] ?></td>
                <td><?= '$' . $product['subtotal'] ?></td>
                <td><?= form_input('item_' . $product['rowid'], $product['qty'], "class='form-control'", "required") ?></td>
                <td>
                  <?= anchor(base_url() . 'cart/remove/' . $product['rowid'], "&times;",
                              "id='cart-remove'".
                              "onClick='return confirm(".
                                '"Do you really want to remove these items from cart?"'.
                              ");'"
                            );
                  ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
          <td><strong>Total:</strong></td>
          <td><?= '$' . $this->cart->total();?></td>
      <?php
        }
      ?>
        </table>

      <!-- Shopping cart selections -->
      <div class="list-group">
      <?php
        if ($cart = $this->cart->contents()) {

          if ($this->session->userdata('signed_in')) {
            echo anchor(base_url() . 'checkout/show', "Checkout", "class='list-group-item'");
          } else {
      ?>
            <div class='list-group-item'>
              Before you can checkout<br>
              You need to sign in first
            </div>
      <?php
          }
      ?>
          <div class='list-group-item'>
            To increase quantity of items in cart,<br>
            just click 'add to cart' multiple times.
          </div>
      <?php
          echo anchor(base_url() . 'cart/destroy', "Clear Cart",
                      "class='list-group-item'".
                      "onClick='return confirm(".
                        '"You are about to remove all items from your shopping cart."'.
                      ");'"
                     );

        } else {
      ?>
          <div class='list-group-item'>
            You cart is currently empty,<br>
            add some products to cart!
          </div>
      <?php
        }
      ?>
      </div>
    </div><!-- ./col-md-3 -->

      <div class="col-md-9">

        <div class="row">
        <?php foreach ($products as $product) { ?>
          <?= form_open('cart/add'); ?>
          <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">
		          <?= "<img src='" . base_url() . "images/product/" . $product->photo_url . "' width='320px' height='150px'/>"; ?>
              <div class="caption">
                <h4 class="pull-right">$<?= $product->price ?></h4>
                <h4><a href=<?= base_url() . "store/read/$product->id"?>><?= $product->name ?></a></h4>
                <p><?= $product->description ?></p>

                <div class="pull-right">
                  <!-- product actions -->
                  <?= anchor(base_url() . "store/read/$product->id",'View'); ?>
                  <!-- if the admin is logged in, show product crud actions-->
                  <?php if ($this->session->userdata('signed_in') &&
                            $this->MUser->isAdmin($this->session->userdata('login'))): ?>
                    <?= anchor(base_url() . "store/editForm/$product->id", 'Edit'); ?>
                    <?= anchor(base_url() . "store/delete/$product->id", 'Delete',
                               "onClick='return confirm(\"Do you really want to delete this record?\");'"); ?>
                  <?php endif ?>
                </div>
              </div>
              <?= form_submit('action', 'Add to Cart', "class='btn btn-default'"); ?>
            </div>
          </div>
          <?= form_hidden('id', $product->id); ?>
          <?= form_close(); ?>
        <?php } ?><!-- end foreach -->
        </div><!-- ./row -->
      </div><!-- ./col-md-9 -->
  </div><!-- ./row -->
</div><!-- ./container -->