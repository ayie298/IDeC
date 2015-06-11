<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('files');
		$this->load->library('user');

		$this->load->model('modules/users/user_model');
		$this->load->model('idec_model');

		$this->template->set_template('login');
	}

	public function index($page = 1, $module = "")
	{
		$data = $this->idec_model->get_page($page);

	    $data['page'] 	   	 = $page;
	    $data['subs'] 	   	 = $this->idec_model->get_page_subs($page);
		$data['pagetab']     = strtolower(str_replace(" ","",$data['filename']));

		$this->template->write_view('dashboard',MODULE_VIEW_PATH.'login/dashboard', $data);

		if(!logged_in()) {
			$this->template->write_view('login',MODULE_VIEW_PATH.'login/login', $data);	
		} else {
			$user = $this->session->userdata('identity');

			$data['user'] = $this->user_model->find(array('username' => $user['username']));

			$this->template->write_view('login',MODULE_VIEW_PATH.'login/logedin', $data);	
		}
		
		$this->template->render();
	}

	public function login()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if($this->form_validation->run()){
			if($this->user->login($this->input->post('username'), $this->input->post('password'))){
				$this->session->set_flashdata('notification', 'Login successful...');			
			}else{
				$this->session->set_flashdata('notification', 'Login failed...');
			}
		} else {
			$this->session->set_flashdata('notification', validation_errors());
		}

		redirect('idec');

		$data['title_form']="&raquo; Login";
		$data['panel']= "";
		$data['page'] 	   	 = 1;
	    $data['subs'] 	   	 = '';
	    $data['filename']	 = 'Home';
	    $data['description'] = '';
		$data['pagetab']     = strtolower(str_replace(" ","",'Home'));

		$this->template->write_view('login',MODULE_VIEW_PATH.'login/login', $data);
		$this->template->render();
	}

	public function logout()
	{
		$this->user->logout();

		redirect('idec');
	}
}
