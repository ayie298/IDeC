<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemanfaatan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('modules/users/user_model');
		$this->load->model('modules/employee/employee_model');
		$this->load->model('modules/research/research_model');
		$this->load->model('modules/program/program_model');
		$this->load->model('idec_model');
	}
	 
	public function index()
	{
		if($_POST) {
			$validation = array(
					array(
							'field' => 'number',
							'label' => 'Number',
							'rules' => 'required'
						)
				);

			$this->form_validation->set_rules($validation);

			if($this->form_validation->run() === TRUE) {
			$data = array(
				'number' => $this->input->post('number'),
				'numbering_date' => $this->input->post('tanggal'),
				'id_organization_item' => $this->input->post('unit'),
				'id_mas_research_group' => $this->input->post('group'),
				'id_mas_research_content' => $this->input->post('content'),
				'title' => $this->input->post('name'),
				'id_program' => $this->input->post('program'),
				'id_mas_research_type' => $this->input->post('type'),
				'id_mas_project_status' => $this->input->post('status'),
				'executive_summary' => $this->input->post('summary'),
				'summary_recomendation' => $this->input->post('kesimpulan'),
				'year' => date('Y')
			);

			$this->db->insert('research', $data);

			$this->session->set_flashdata('notice', 'Data berhasil disimpan');
			} else {
			$this->session->set_flashdata('notice', validation_errors());	
			}

			redirect('research/add');
		}

		$data['organization'] = $this->employee_model->organization(array('level' => 'subunit'));
		$data['program']	  = $this->program_model->findAll();
		$data['groups']		  = $this->idec_model->findMaster('mas_research_group');
		$data['content']	  = $this->idec_model->findMaster('mas_research_content');
		$data['status']		  = $this->idec_model->findMaster('mas_project_status');

		$this->template->write_view('content', MODULE_VIEW_PATH.'inovasi/inovasi_pemanfaatan', $data);
		$this->template->render();
	}

	public function generate()
	{
		if($_POST) {
			$group 		= $this->idec_model->findMaster('mas_research_group', array('where' => 'id_mas_research_group = '.$this->input->post('group')), 'row');
			$content 	= $this->idec_model->findMaster('mas_research_content', array('where' => 'id_mas_research_content = '.$this->input->post('content')), 'row');
			$year 		= date('Y');

			$find 		= $this->db->get('research')->num_rows()+1;

			echo $group->code.' '.$content->code.'-00'.$find.'-'.$year;
		}
	}
}	
		