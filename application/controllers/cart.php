<?php
	class Cart extends CI_Controller {

		/* Add an item to the cart */
		function add() {
			$this->load->model('product_model');

			/* Fetch the posted product object */
			$product = $this->product_model->get($this->input->post('id'));

			/* Build the cart item product data */
			$product_data = array(
				'id' => $this->input->post('id'),
				'qty' => 1,
				'price' => $product->price,
				'name' => $product->name
			);
			
			/* Add the product to the cart */
			$this->cart->insert($product_data);
			redirect('store');
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
			$this->cart->total();			
		}

		/* Destroys the shopping cart */
		function destroy() {
			$this->cart->destroy();
		}
	}
?>