<?php

use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';
defined('BASEPATH') or exit('No direct script access allowed');
class Category extends REST_Controller {
	public function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->database();
       
        $this->load->model('Category_model');
       

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

	//Task:list all product categories
	public function index_get()
    {
        $category_data = $this->Category_model->getAllCategories();
		$this->response([
			'status' => true,
			'message' => 'Category List Successfully',
			'data' => $category_data,
		], Restserver\Libraries\REST_Controller_Definitions::HTTP_CREATED); // CREATED (201) being the HTTP response code
		exit;
	}
}
