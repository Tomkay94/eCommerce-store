<?php
	class Cart extends CI_Controller {

		/* Add an item to the cart */
		function add() {
			$this->load->model('product_model');

			// Fetch the posted products id
			$product = $this->product_model->get($this->input->post('id'));

			$product_data = array(
				'id' => $product->id,
				'qty' => 1,
				'price' => $product->price,
				'name' => $product->name
			);
			
			// Add the product to the cart
			$this->cart->insert($product_data);
		}

		/* Remove an item from the cart */
		function remove() {
			$this->cart->update($data);
		}

		/* Update the cart */
		function update() {
			$this->cart->update();
		}

		/* Returns the shopping carts contents */
		function show() {
			$this->cart->contents();
		}

		/* Calculates shopping cart total price */
		function total() {
			echo $this->cart->total();			
		}

		/* Destroys the shopping cart */
		function destroy() {
			$this->cart->destroy();
		}
	}
?>