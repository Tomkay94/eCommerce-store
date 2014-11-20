<!-- Page Content -->
<div class="container" id="products-list">

    <div class="row">

        <div class="col-md-3">
			<h2>Products</h2>
            <div class="list-group">
                <a href=<?= base_url() . "store/newForm" ?> class="list-group-item">Add New Product</a>
                <a href="#" class="list-group-item">Category 2</a>
                <a href="#" class="list-group-item">Category 3</a>
            </div>
        </div>

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