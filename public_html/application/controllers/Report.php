<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

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
	function __construct(){
         parent::__construct();
		 
		 $this->load->helper('date');
         $this->load->model('m_account'); 
		 $this->load->helper(array('url','form'));
		 $this->load->database();
    }
	public function index()
	{
		$this->data['posts'] = $this->m_account->collection_dataAll(); 
		 $this->load->view('report', $this->data); 
	}
	
}
