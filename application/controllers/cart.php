<?php

	class Carts extends CI_Controller {
		function __construct() {
    		// Call the Controller constructor
	    	parent::__construct();	
    	}

    	/* Displays all carts */
		function index() {
			$this->load->model('cart_model');
    		$carts = $this->cart_model->getAll();
    		$data['carts']=$carts;
			$this->load->view('cart/index.php',$data);
		}

		/* Displays a single cart */
		function show($id) {
			$this->load->model('cart_model');
			$this->load->view('cart/show.php',$data);
		}

		/* Displays a form to create a new cart */
		function newForm() {
			$this->load->view('cart/new.php'
		}

		/* Displays a form to edit a cart */
		function editForm($id) {
			$this->load->model('cart_model');
			$this->load->view('cart/edit.php',$data);
		}

		/* Retrieve form values from new and creates the record */
		function create($id) {
			$this->load->model('cart_model');
			redirect('store/index', 'refresh');		

			/* Validations here */
		}

		/* Retrieve form values from edit and updates the record */
		function update($id) {
			$this->load->model('cart_model');
			redirect('store/index', 'refresh');		

			/* Validations here */
		}

		/* Destroy this cart */
		function delete($id) {
			$this->load->model('cart_model');
			if (isset($id))  {
				$this->cart_model->delete($id);
			}
			redirect('store/index', 'refresh');
		}
	}
?>