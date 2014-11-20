<section class="closed-container">
  
  	<h2 class="container-header">New Product</h2>

	<?= "<p>" . anchor('store/index','Back') . "</p>"; ?>

	<?= form_open_multipart('store/create'); ?>
    
	    <div class="form-group">
			<?= form_label('Name'); ?> 
			<?= form_error('name'); ?>
			<?= form_input('name',set_value('name'),"required"); ?>
	    </div>

	    <div class="form-group">
			<?= form_label('Description'); ?>
			<?= form_error('description'); ?>
			<?= form_input('description',set_value('description'),"required"); ?>
	    </div>

	    <div class="form-group">
			<?= form_label('Price'); ?>
			<?= form_error('price'); ?>
			<?= form_input('price',set_value('price'),"required"); ?>
	    </div>
		

	    <div class="form-group">
			<?= form_label('Photo'); ?>
			<?php
				if(isset($fileerror)) { $fileerror; }
			?>
		</div>
			
		<input type="file" name="userfile" size="20" />
		<?= form_submit('submit', 'Create'); ?>

	<?= form_close(); ?>
</section>