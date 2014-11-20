<section class="closed-container">
	<p><?= anchor('store/index','Back') ?></p>

    <h2 class="container-header">Product Entry</h2>

	<?= "<img src='" . base_url() . "images/product/" . $product->photo_url . "' class='center-block'/>"; ?>

	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Desc</th>
				<th>Price</th>	
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?= $product->id ?></td>
				<td><?= $product->description ?></td>
				<td><?= $product->name ?></td>
				<td><?= $product->price ?></td>
			</tr>
		</tbody>
	</table>
</section>
