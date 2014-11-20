<?php
	class Cart extends CI_Controller {

		function __construct() {
		  $this->load->library('cart');
		  parent::__construct();		  		  
		}

		/* Add an item to the cart */
		function add() {
			$this->cart->insert($data);
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