<?php
	class Cart extends CI_Controller {

		/* Add an item to the cart */
		function add() {
			$this->load->model('product_model');

			/* Fetch the posted product object */
			$product = $this->product_model->get($this->input->post('id'));

			$item_not_in_cart = TRUE;
	        $cart_contents = $this->cart->contents();

	        // If the item is in the cart, update its quantity.
	        foreach ($cart_contents as $item) {
	            if ($item['id'] == $this->input->post('id')) {
	                $this->cart->update(array(
	                	'rowid' => $item['rowid'],
	                	'qty' => $item['qty'] + 1
	                ));
                	$item_not_in_cart = FALSE;
                	break;
				}
	        }

	        // The item was not in the cart, insert it.
	        if ($item_not_in_cart) {
	            $data = array(
	                'id' => $this->input->post('id'),
	                'qty' => 1,
	              	'price' => $product->price,
					'name' => $product->name
	            );
	            $this->cart->insert($data);
	        }
	        
			redirect('store');
		}

		/* Remove an item from the cart */
		function remove($rowid) {
			$this->cart->update(array(
					'rowid' => $rowid,
					'qty' => 0 
			));
			redirect('store');
		}

		/* Update the cart */
		function update() {
			$this->cart->update();
			redirect('store');
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
			redirect('store');
		}
	}
?>