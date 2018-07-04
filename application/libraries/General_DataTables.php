<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class General_DataTables extends CI_Controller{

	public function __construct(){	
		$this->CI =& get_instance();
		parent::__construct();
		
		// $this->load->model('Main_model', 'main');
		// $this->session->set_userdata("url", base_url());
		$this->load->model('Main_model', 'main');
		echo $this->session->all_userdata();
	}


}