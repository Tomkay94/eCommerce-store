<?php

class Store extends CI_Controller {

  function __construct() {
    // Call the Controller constructor
    parent::__construct();

    $config['upload_path'] = './images/product/';
    $config['allowed_types'] = 'gif|jpg|png';
    /*
      $config['max_size'] = '100';
      $config['max_width'] = '1024';
      $config['max_height'] = '768';
    */

    $this->load->library('upload', $config);
  }

  function _remap($method, $params = array()) {
    // enforce access control to protected functions
    $protected = array('newForm', 'create', 'editForm', 'update', 'delete');
    $admin_only = array('newForm', 'create', 'editForm', 'update', 'delete');

    // authentication
    if (in_array($method, $protected) && !$this->session->userdata('signed_in')) {
      $this->session->set_flashdata('warning', 'we will need to authenticate you first!');
      redirect('user/login', 'refresh');
    }

    // authorization
    if (in_array($method, $admin_only) && !$this->MUser->isAdmin($this->session->userdata('login'))) {
      $this->session->set_flashdata('warning', 'only admin can perform this operation');
      redirect('', 'refresh');
    }

    return call_user_func_array(array($this, $method), $params);
  }

    function index() {
        $products = $this->product_model->getAll();
        $data = array(
            'title' => 'eStore\'s store front',
            'main' => 'product/list',
            'products' => $products
        );
        $this->load->view('template', $data);
    }

    function newForm() {
        $data = array(
            'title' => 'Add a new Product',
            'main' => 'product/newForm'
        );
        $this->load->view('template', $data);
    }

    function create() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name','Name','required|is_unique[products.name]|xss_clean');
        $this->form_validation->set_rules('description','Description','required|xss_clean');
        $this->form_validation->set_rules('price','Price','required|xss_clean|numeric');

        $fileUploadSuccess = $this->upload->do_upload();

        if ($this->form_validation->run() == true && $fileUploadSuccess) {
            $product = new Product();
            $product->name = $this->input->get_post('name');
            $product->description = $this->input->get_post('description');
            $product->price = $this->input->get_post('price');

            $data = $this->upload->data();
            $product->photo_url = $data['file_name'];

            $this->product_model->insert($product);

            //Then we redirect to the index page again
            redirect('store/index', 'refresh');
        } else {
            $data = array(
                'title' => 'Add a new Product',
                'main' => 'product/newForm'
            );

            if (!$fileUploadSuccess) {
                $data['fileerror'] = $this->upload->display_errors();
                $this->load->view('template', $data);
                return;
            }

            $this->load->view('template', $data);
        }
    }

    function read($id) {
        $product = $this->product_model->get($id);
        $data = array(
            'title' => 'Would you buy a '.$product->name.'?',
            'main' => 'product/read',
            'product' => $product
        );
        $this->load->view('template', $data);
    }

    function editForm($id) {
        $product = $this->product_model->get($id);
        $data = array(
            'title' => 'Editing product #'.$product->id,
            'main' => 'product/editForm',
            'product' => $product
        );
        $this->load->view('template', $data);
    }

    function update($id) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name','Name','required|xss_clean');
        $this->form_validation->set_rules('description','Description','required|xss_clean');
        $this->form_validation->set_rules('price','Price','required|numeric|xss_clean');

        // We have validated form data, create a product.
        if ($this->form_validation->run() == true) {
            $product = new Product();
            $product->id = $id;
            $product->name = $this->input->get_post('name');
            $product->description = $this->input->get_post('description');
            $product->price = $this->input->get_post('price');

            $this->product_model->update($product);
            //Then we redirect to the index page again
            redirect('store/index', 'refresh');
        
        // Validation failed, goto the product edit view.
        } else {
            $product = new Product();
            $product->id = $id;
            $product->name = set_value('name');
            $product->description = set_value('description');
            $product->price = set_value('price');
            $data = array(
                'title' => 'Editing product #'.$product->id,
                'main' => 'product/editForm',
                'product' => $product
            );
            $this->load->view('template', $data);
        }
    }

    function delete($id) {
        if (isset($id))
            $this->product_model->delete($id);

        //Then we redirect to the index page again
        redirect('store/index', 'refresh');
    }
}
