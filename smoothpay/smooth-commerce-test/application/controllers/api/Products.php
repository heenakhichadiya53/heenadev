<?php

use Restserver\Libraries\REST_Controller;
require APPPATH . '/libraries/REST_Controller.php';
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends REST_Controller {
	public function __construct()
    {
        // Construct the parent class
        parent::__construct();

		$this->load->database();
		$this->load->library('form_validation');       
        $this->load->model('Product_model');      

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: ACCEPT, CONTENT-TYPE, X-CSRF-TOKEN");
        header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	//Task:list all products
	public function index_get()
    {
        $product_data = $this->Product_model->getAllProducts();
		$this->response([
			'status' => true,
			'message' => 'Product List Successfully',
			'data' => $product_data,
		], Restserver\Libraries\REST_Controller_Definitions::HTTP_CREATED); // CREATED (201) being the HTTP response code
		exit;
	}

	//Task:retrieve a single product
	public function getSingleProduct_post()
    {
		$product_id = ($this->post('product_id')) ? $this->post('product_id') : '';	
		
		if($product_id == '' ){
			$empty_msg = "Product Id is required";
			$this->response([
                'status' => false,
				'message' => $empty_msg,
			], Restserver\Libraries\REST_Controller_Definitions::HTTP_CREATED); // CREATED (201) being the HTTP response code
			exit;
		}
		
			if($product_id != ''){
				$product_details = $this->Product_model->getProductById($product_id);
			}
		
			$this->response([
                'status' => true,
				'message' => "Get data successfully",
				"data"=> $product_details,
			], Restserver\Libraries\REST_Controller_Definitions::HTTP_CREATED); // CREATED (201) being the HTTP response code
			exit;
		
	}

	//Task:create a product
	public function add_post()
    {
        $name = $this->post('name');
        $category = $this->post('category');
        $sku = $this->post('sku');
        $price = $this->post('price');
     

        $success_msg = 'Insertion Successfully';
        
        $error_msg = 'Some Error';
        $productData = array(
            'name' => $name,
            'category' => $category,
            'sku' => $sku,
            'price' => $price    
        );
        
     
        $config = [
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required',
                'errors' => [
                    'required' => 'name is required',
                ],
            ],
            [
                'field' => 'category',
                'label' => 'Category',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Category is required',
                ],
            ],
            [
                'field' => 'price',
                'label' => 'Price',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Price is required',
                ],
            ],
            [
                'field' => 'sku',
                'label' => 'SKU',
                'rules' => 'required',
                'errors' => [
                    'required' => 'SKU is required',
                ],
            ]
        ];        
      
        $this->form_validation->set_data($productData);
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {        					
					$last_insert_product_id = $this->Product_model->saverecords($productData);
                    if ($last_insert_product_id > 0) {                       
                        $product_data = $this->Product_model->getProductById($last_insert_product_id);
                        $this->response([
                            'status' => true,
                            'message' => $success_msg,
                            'data' => $product_data,
                        ], Restserver\Libraries\REST_Controller_Definitions::HTTP_CREATED); // CREATED (201) being the HTTP response code
					}
					exit;
              
        } else {
            $this->response([
                'status' => false,
                'message' => validation_errors(),
			], Restserver\Libraries\REST_Controller_Definitions::HTTP_CREATED); // CREATED (201) being the HTTP response code
			exit;
        }

	}
	
	//Task:Delete a product
	public function delete_post()
    {
		$product_id = $this->post('product_id');
			if($product_id != ''){
				$delete_status = $this->Product_model->deleteRecord('products',$product_id,'id');
				if($delete_status == 2){
					$this->response([
						'status' => false,
						'message' => "Product is already deleted",
					], Restserver\Libraries\REST_Controller_Definitions::HTTP_CREATED); // CREATED (201) being the HTTP response code
					exit;
				} else if($delete_status == 1){
					$this->response([
						'status' => true,
						'message' => "Delete product successfully",
					], Restserver\Libraries\REST_Controller_Definitions::HTTP_CREATED); // CREATED (201) being the HTTP response code
					exit;
				} else {
					$this->response([
						'status' => false,
						'message' => "Delete product failed",
					], Restserver\Libraries\REST_Controller_Definitions::HTTP_CREATED); // CREATED (201) being the HTTP response code
					exit;
				}
			} else {
				$this->response([
					'status' => false,
					'message' => "Product Id is required for delete product",
				], Restserver\Libraries\REST_Controller_Definitions::HTTP_CREATED); // CREATED (201) being the HTTP response code
				exit;
			}
	}

	//Task: Allow the API users to update one or more attributes of a product at once
	//Task: Allow the API users to update all attributes of a product at once (i.e., replace a product)
	public function update_post()
    {
		$product_id = $this->post('product_id');
		$name = $this->post('name');
        $sku = $this->post('sku');
        $category = $this->post('category');
        $price = $this->post('price');


		$productData = array(
            'name' => $name,
            'sku' => $sku,
            'category' => $category,
            'price' => $price,            
        );
	
		$this->db->where('id', $product_id);
		$this->db->update('products', $productData);
		$this->response([
			'status' => true,
			'message' => "Update product details successfully",
		], Restserver\Libraries\REST_Controller_Definitions::HTTP_CREATED); // CREATED (201) being the HTTP response code
		exit;
	}
}
