<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('files');

		$this->load->model('modules/users/user_model');
		$this->load->model('modules/employee/employee_model');
		$this->load->model('modules/program/program_model');
		$this->load->model('idec_model');
	}

	public function index()
	{
		$data = array();

		if($_POST && $this->input->is_ajax_request())
		{
			$this->session->set_userdata('gender', $this->input->post('gender'));
			$this->session->set_userdata('old', $this->input->post('old'));
			$this->session->set_userdata('org', $this->input->post('org'));

			return FALSE;
		}

		if($this->user->row()->level_name == "researcher"){
			$this->detail(md5($this->user->row()->id_employee));
		}else{
			$data['organization'] = $this->employee_model->organization();

			$this->template->write_view('content', MODULE_VIEW_PATH.'employee/employee', $data);
		}

		$this->template->render();
	}

	public function edit($id = ""){
		if($_POST) {
			$validation = array(
				array(
					'field' => 'nik',
					'label' => 'NIK',
					'rules' => 'required'
				),
				array(
					'field' => 'name',
					'label' => 'Name',
					'rules' => 'required'
				),
				array(
					'field' => 'gender',
					'label' => 'Gender',
					'rules' => 'required'
				),
				array(
					'field' => 'bp',
					'label' => 'BP',
					'rules' => 'required'
				),
				array(
					'field' => 'unit',
					'label' => 'Unit',
					'rules' => 'required'
				),
				array(
					'field' => 'title',
					'label' => 'Title',
					'rules' => 'required'
				),
			);

			$this->form_validation->set_rules($validation);

			if($this->form_validation->run() == TRUE) {

			$data['nik']  				  	  = $this->input->post('nik');
			$data['name'] 				  	  = $this->input->post('name');
			$data['gender']				  	  = $this->input->post('gender');
			$data['id_mas_bp'] 			  	  = $this->input->post('bp');
			$data['id_mas_title']			  = $this->input->post('title');
			$data['date_of_birth']			  = $this->input->post('date');
			$data['id_organization_item']	  = $this->input->post('lab') == "" ? $this->input->post('unit') : $this->input->post('lab');
			$data['id_mas_employee_position'] = $this->input->post('position');

			$upload = $this->files->uploads('userfile', 'pdf', 'cv/');

			if((!empty($upload['error']) || $upload['error'] == 1) && !empty($_FILES['userfile']['name'])) {
				$data['notice'] = $upload['message'];
			} else {

			$data['cv_document'] = !empty($_FILES['userfile']['name']) ? $upload['filename'] : '';

			if(empty($id)) {
				$iduser = $this->program_model->getAutoIncrement('user', 'id_user');
				$dataUser = array(
					'id_user' => $iduser,
					'username'=> $this->input->post('nik'),
					'password'=> sha1($this->input->post('nik')),
					'id_user_level' => 2
				);

				$this->db->insert('user', $dataUser);
				$data['id_employee'] = sizeof($this->employee_model->findAll())+1;
				$data['id_user']	 = $iduser;
			}

			$return = $this->employee_model->update($id, $data);

			if(empty($id)) {
				$id = md5($data['id_employee']);
			}

			if($return) {
				$this->session->set_flashdata('notice', 'Data saved');

				redirect('idec/employee/edit/' . $id);
			}
			}

			} else {
				$data['notice'] = validation_errors();
			}
		}

		if(!empty($id)) {
			$employee	= $this->employee_model->find(array('md5(id_employee)' => $id));
			$labs		= $this->employee_model->organization(array('id_organization_item' => $employee->id_organization_item, 'level' => 'lab'), 'row');

			$data['labs']	 = !empty($labs) ? $this->employee_model->organization(array('id_organization_item_parent' => $labs->id_organization_item_parent, 'level' => 'lab')) : array();
			$data['unit']	 = !empty($labs) ? $labs->id_organization_item_parent : $employee->id_organization_item;
		}

		$data['employee'] 	  = $this->employee_model->find(array('md5(id_employee)' => $id));
		$data['bps'] 	  	  = $this->employee_model->getBP();
		$data['position'] 	  = $this->employee_model->position();
		$data['organization'] = $this->employee_model->organization(array('level' => 'subunit'));
		$data['title'] 		  = $this->employee_model->title();
		$data['competence']   = $this->load->view(MODULE_VIEW_PATH.'employee/employee_competence', $data, TRUE);
		$data['training']     = $this->load->view(MODULE_VIEW_PATH.'employee/employee_training', $data, TRUE);
		$data['education']    = $this->load->view(MODULE_VIEW_PATH.'employee/employee_education', $data, TRUE);
		$data['certificate']  = $this->load->view(MODULE_VIEW_PATH.'employee/employee_certificate', $data, TRUE);

		if(empty($id)) {
			$this->template->write_view('content', MODULE_VIEW_PATH.'employee/employee_add', $data);	
		} else {
			$this->template->write_view('content', MODULE_VIEW_PATH.'employee/employee_edit', $data);
		}

		$this->template->render();
	}

	public function update($id = ""){
		if($_POST) {
			$validation = array(
				array(
					'field' => 'nik',
					'label' => 'NIK',
					'rules' => 'required'
				),
				array(
					'field' => 'name',
					'label' => 'Name',
					'rules' => 'required'
				),
				array(
					'field' => 'gender',
					'label' => 'Gender',
					'rules' => 'required'
				),
				array(
					'field' => 'bp',
					'label' => 'BP',
					'rules' => 'required'
				),
				array(
					'field' => 'unit',
					'label' => 'Unit',
					'rules' => 'required'
				),
				array(
					'field' => 'title',
					'label' => 'Title',
					'rules' => 'required'
				),
			);

			$this->form_validation->set_rules($validation);

			if($this->form_validation->run() == TRUE) {

			$data['nik']  				  	  = $this->input->post('nik');
			$data['name'] 				  	  = $this->input->post('name');
			$data['gender']				  	  = $this->input->post('gender');
			$data['id_mas_bp'] 			  	  = $this->input->post('bp');
			$data['id_mas_title']			  = $this->input->post('title');
			$data['date_of_birth']			  = $this->input->post('date');
			$data['id_organization_item']	  = $this->input->post('lab') == "" ? $this->input->post('unit') : $this->input->post('lab');
			$data['id_mas_employee_position'] = $this->input->post('position');

			if(!empty($_FILES['userfile']['name'])) {
				$upload = $this->files->uploads('userfile', 'pdf', 'cv/');

				if(!empty($upload['error'])) {
					$data['notice'] = $upload['message'];
				} else {
					$data['cv_document'] = $upload['filename'];
				}
			}

			if(empty($data['notice'])) {
			if(empty($id)) {

				$data['id_employee'] = sizeof($this->employee_model->findAll())+1;
				$data['id_user']	 = $iduser;
			}

			$return = $this->employee_model->update($id, $data);

			if(empty($id)) {
				$id = md5($data['id_employee']);
			}

			if($return) {
				$data['notice'] = 'Data saved';
			}

			}

			} else {
				$data['notice'] = validation_errors();
			}
		}

		if(!empty($id)) {
			$employee	= $this->employee_model->find(array('md5(id_employee)' => $id));
			$labs		= $this->employee_model->organization(array('id_organization_item' => $employee->id_organization_item, 'level' => 'lab'), 'row');

			$data['labs']	 = !empty($labs) ? $this->employee_model->organization(array('id_organization_item_parent' => $labs->id_organization_item_parent, 'level' => 'lab')) : '';
			$data['unit']	 = !empty($labs) ? $labs->id_organization_item_parent : $employee->id_organization_item;
		}

		$data['employee'] 	  = $this->employee_model->find(array('md5(id_employee)' => $id));
		$data['bps'] 	  	  = $this->employee_model->getBP();
		$data['position'] 	  = $this->employee_model->position();
		$data['organization'] = $this->employee_model->organization(array('level' => 'subunit'));
		$data['title'] 		  = $this->employee_model->title();
		$data['competence']   = $this->load->view(MODULE_VIEW_PATH.'employee/employee_competence', $data, TRUE);
		$data['training']     = $this->load->view(MODULE_VIEW_PATH.'employee/employee_training', $data, TRUE);
		$data['education']    = $this->load->view(MODULE_VIEW_PATH.'employee/employee_education', $data, TRUE);
		$data['certificate']  = $this->load->view(MODULE_VIEW_PATH.'employee/employee_certificate', $data, TRUE);

		if(empty($id)) {
			$this->template->write_view('content', MODULE_VIEW_PATH.'employee/employee_add', $data);	
		} else {
			$this->template->write_view('content', MODULE_VIEW_PATH.'employee/employee_edit', $data);
		}

		$this->template->render();
	}

	public function delete($id = "")
	{
		$this->db->where('md5(id_employee)', $id);

		$this->db->delete('employee');

		$this->session->set_flashdata('notice', 'Data deleted');

		redirect('idec/employee');
	}

	public function detail($id)
	{
		$data['employee'] = $this->employee_model->find(array('md5(id_employee)' => $id));
		$data['competence']   = $this->load->view(MODULE_VIEW_PATH.'employee/employee_competence_detail', $data, TRUE);
		$data['training']     = $this->load->view(MODULE_VIEW_PATH.'employee/employee_training_detail', $data, TRUE);
		$data['education']    = $this->load->view(MODULE_VIEW_PATH.'employee/employee_education_detail', $data, TRUE);
		$data['certificate']  = $this->load->view(MODULE_VIEW_PATH.'employee/employee_certificate_detail', $data, TRUE);

		$this->template->write_view('content', MODULE_VIEW_PATH.'employee/employee_detail', $data);
		$this->template->render();
	}

	public function json()
	{
		$data 	= array();
		$filter = array();
		$filterLike = array();

		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				$filterLike[$field] = $value;
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}

		if($this->session->userdata('old') != '') {
			$old = $this->session->userdata('old');

			if($old == ">50") {
				$this->db->where("DATEDIFF(NOW(), date_of_birth) " . $old);
			}

			if($old == "40") {
				$this->db->where("DATEDIFF(NOW(), date_of_birth) > 40 AND DATEDIFF(NOW(), date_of_birth) < 50");
			}

			if($old == "30") {
				$this->db->where("DATEDIFF(NOW(), date_of_birth) > 30 AND DATEDIFF(NOW(), date_of_birth) < 40");
			}

			if($old == "<30") {
				$this->db->where("DATEDIFF(NOW(), date_of_birth) " . $old);
			}
		}

		if($this->session->userdata('org') != '') {
			$filter['employee.id_organization_item'] = $this->session->userdata('org');
		}

		if($this->session->userdata('gender') != '') {
			$filter['employee.gender'] = $this->session->userdata('gender');
		}

		$employes = $this->employee_model->findAll($filter, array(), $filterLike);

		foreach($employes as $employee) {
			$data[] = array(
				'id'   	=> $employee->id_employee,
				'id_encrypt'   	=> md5($employee->id_employee),
				'nik'  	=> $employee->nik,
				'name' 	=> $employee->name,
				'bp'   	=> $employee->bp,
				'position'=> $employee->position,
				'org_name'	=> $employee->org_name,
			);
		}

		$json = array(
			'TotalRows' => sizeof($data),
			'Rows' => $data
		);

		echo json_encode(array($json));

		$this->session->unset_userdata('gender', $this->input->post('gender'));
		$this->session->unset_userdata('old', $this->input->post('old'));
		$this->session->unset_userdata('org', $this->input->post('org'));
	}

	public function competence()
	{
		$data = array();
		$filter = array();
		$filterLike = array();

		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);

				$this->db->like($field, $value);
			}

			if(!empty($ord)) {
				$this->db->order_by($ord, $this->input->post('sortorder'));
			}
		}

		$employes = $this->employee_model->competence(array('md5(id_employee)' => $this->input->get('id')), $filterLike);

		foreach($employes as $employee) {
			$data[] = array(
				'id'   			=> $employee->id_competence_employee,
				'id_employee'	=> $employee->id_employee,
				'mas_competence.name'  		=> $employee->name,
				'description' 	=> $employee->description
			);
		}

		$json = array(
			'TotalRows' => !empty($data) ? sizeof($data) : 0,
			'Rows' => $data
		);

		echo json_encode(array($json));
	}

	public function certificate()
	{
		$data = array();
		$employes = $this->employee_model->certificate(array('md5(id_employee)' => $this->input->get('id')));

		foreach($employes as $employee) {
			$data[] = array(
				'id'   			=> md5($employee->id_certificate_employee),
				'name'  		=> $employee->name,
				'description' 	=> $employee->description,
				'organizer'		=> $employee->organizer,
				'expired'		=> $employee->expired_date,
				'file'			=> $employee->file_upload
			);
		}

		$json = array(
			'TotalRows' => !empty($data) ? sizeof($data) : 0,
			'Rows' => $data
		);

		echo json_encode(array($json));
	}

	public function training()
	{
		$data = array();
		$employes = $this->employee_model->training(array('md5(id_employee)' => $this->input->get('id')));

		foreach($employes as $employee) {
			$data[] = array(
				'id'   			=> md5($employee->id_training_employee),
				'name'  		=> $employee->name,
				'category' 		=> '',
				'organizer'		=> $employee->organizer,
				'expired'		=> $employee->start_time,
				'type'			=> ''
			);
		}

		$json = array(
			'TotalRows' => !empty($data) ? sizeof($data) : 0,
			'Rows' => $data
		);

		echo json_encode(array($json));
	}

	public function education()
	{
		$data = array();
		$employes = $this->employee_model->education(array('md5(id_employee)' => $this->input->get('id')));

		foreach($employes as $employee) {
			$data[] = array(
				'id'   			=> $employee->id_employee_education,
				'id_employee'	=> $employee->id_employee,
				'degre'  		=> $employee->education_degree,
				'institution' 	=> $employee->institute,
				'major'			=> $employee->major,
				'start'			=> $employee->start_year,
				'end'			=> $employee->end_year
			);
		}

		$json = array(
			'TotalRows' => !empty($data) ? sizeof($data) : 0,
			'Rows' => $data
		);

		echo json_encode(array($json));
	}
}
