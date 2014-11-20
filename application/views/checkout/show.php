<!-- Page Content -->
<section class="closed-container">
  
  <h2 class="container-header">Sign up</h2>
  
	<h3>Checkout</h3>

	  <?= form_open('order/create', "role='form'") ?>

	<?php
		$total = $this->cart->total();
		$customer_id = $this->session->userdata('id');
		$order_time = date("H:i:s");
		$order_date = date("Ymd");
	?>

	<div class="form-group">
	  <?= form_label('creditcard_number')?>
	  <?= form_error('creditcard_number')?>
	  <?= form_input('creditcard_number', set_value('creditcard_number'), "class='form-control'", "required")?>
	</div>

	<div class="form-group">
	  <?= form_label('creditcard_month')?>
	  <?= form_error('creditcard_month')?>
	  <?= form_input('creditcard_month', set_value('creditcard_month'), "class='form-control'", "required")?>
	</div>

	<div class="form-group">
	  <?= form_label('creditcard_year')?>
	  <?= form_error('creditcard_year')?>
	  <?= form_input('creditcard_year', set_value('creditcard_year'), "class='form-control'", "required")?>
	</div>

	<!-- for testing purposes, will show the cart contents -->
	<?= print_r($this->cart->contents()); ?>   

    <br>
    <?= form_submit('submit', 'Create Order', "class='btn btn-default'")?>
	<?= form_close()?>

</section>
