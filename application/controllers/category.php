<?php 

/**
 * category class
 */
class Category extends CI_Controller {
	
	public function __construct() {
		
	parent::__construct();
	
	// Load form helper library
	$this->load->helper('html');
	$this->load->helper('form');
	$this->load->helper('url');
	
	// Load form validation library
	$this->load->library('form_validation');
	
	// Load session library
	$this->load->library('session');
	
	// Load database
	$this->load->model('category');
	}
	
	public function index(){
	
	$this->load->model('category');
	
	$data['category'] = $this->category->category_detail();

	$this->load->view('tender/index',$data);
}	
	
	public function create_category(){
		
		$data = array (
		'category_name' =>$this->input->post('category_name'));
		$result = $this->category->create_category($data);
		
		if($result == TRUE){
			$data['message_display'] = "successfully created the category";
			$this->load->view('tender/category_list',$data);
		}else {
			$data['message_display'] = "There is a problem creating the category";
			$this->load->view('tender/cat_new',$data);
			
		}
	}
	
 public function showCategoryNames(){
    	
    $data = array();
    $this->load->model('category');
    $query = $this->category->getAllCategories();
    if ($query)
    {
        $data['records'] = $query;
    }
    $this->load->view('itemsView',$data);
 }
	
}
