<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct(){
		parent::__construct();

		$this->load->model('modules/employee/employee_model');
	}
	
	function index(){
		$this->template->write('content','<div class="alert alert-danger" style="margin-top:20%"><center><h3>PAGE UNDER CONSTRUCTION</h3></cente></div>');
		$this->template->render();
	}
	
}	