<section class="closed-container">
  
  	<h2 class="container-header">Edit Product</h2>

		<p><?= anchor('store/index','Back')?></p>
		
		<?= form_open("store/update/$product->id"); ?>
		
	    <div class="form-group">
			<?= form_label('Name'); ?> 
			<?= form_error('name'); ?>
			<?= form_input('name', $product->name, "class='form-control'", "required"); ?>
	    </div>

	    <div class="form-group">
			<?= form_label('Description'); ?>
			<?= form_error('description'); ?>
			<?= form_input('description', $product->description, "class='form-control'", "required"); ?>
	    </div>

	    <div class="form-group">
			<?= form_label('Price'); ?>
			<?= form_error('price'); ?>
			<?= form_input('price', $product->price, "class='form-control'", "required"); ?>
	    </div>
		
		<?= form_submit('submit', 'Save'); ?>
		<?= form_close(); ?>

</section>