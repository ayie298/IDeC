<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('files');
		$this->load->library('user');

		$this->load->model('modules/users/user_model');
		$this->load->model('modules/employee/employee_model');
		$this->load->model('modules/program/program_model');
		$this->load->model('modules/project/project_model');
		$this->load->model('modules/researcher/researcher_model');
		$this->load->model('idec_model');
	}

	public function index($id = null)
	{
		if($_POST && $this->input->is_ajax_request())
		{
			$this->session->set_userdata('showType', $this->input->post('type'));
		}

		$data['program'] = $this->program_model->find(array('md5(id_program)' => $id));
		$data['lab']     = $this->employee_model->organization(array('id_organization_item' => $data['program']->id_organization_item, 'level' => 'lab'), 'row');
		$data['unit']	 = !empty($lab) ? $this->employee_model->organization(array('id_organization_item' => $lab->id_organization_item_parent), 'row') : NULL;
		$data['title']	 = 'Add';
		$data['types']	 = $this->idec_model->findMaster('mas_review_type');
		$data['popup']	 = '';

		$this->template->write_view('content', MODULE_VIEW_PATH.'review/review_detail', $data);
		$this->template->render();
	}

	public function add($id = NULL)
	{
		$data['program'] = $this->program_model->find(array('md5(id_program)' => md5($this->input->post('id'))));
		$data['lab']     = $this->employee_model->organization(array('id_organization_item' => $data['program']->id_organization_item, 'level' => 'lab'), 'row');
		$data['unit']	 = !empty($lab) ? $this->employee_model->organization(array('id_organization_item' => $lab->id_organization_item_parent), 'row') : NULL;
		$data['title']	 = 'Add';
		$data['types']	 = $this->idec_model->findMaster('mas_review_type');

		$this->load->view(MODULE_VIEW_PATH.'review/review_detail_popup', $data);
	}

	public function update()
	{
		if($_POST) {
			$validation = array(
				array(
					'field' => 'type',
					'label' => 'Type',
					'rules' => 'required'
				),
				array(
					'field' => 'desc',
					'label' => 'Description',
					'rules' => 'required'
				)
			);

			$this->form_validation->set_rules($validation);

			if($this->form_validation->run() === TRUE) {
				$upload = $this->files->uploads('userfile', 'pdf|doc|docx|xls|jpg|jpeg', 'review');

				if(!empty($upload['error']) && $upload['error'] == 1 && $this->input->post('id_review') == "") {
					$this->session->set_flashdata('notice', $upload['message']);

					redirect('review/detail/' . md5($this->input->post('id_program')));

					return FALSE;
				}

				$data = array(
					'period' 			 => '',
					'id_program' 		 => $this->input->post('id_program'),
					'id_mas_review_type' => $this->input->post('type'),
					'files'				 => $upload['filename']
				);

				if($this->input->post('id_review') == "") {
					$this->db->insert('review_management', $data);

					$this->session->set_flashdata('notice', 'Review has been added');
				}
			} else {
				$this->session->set_flashdata('notice', validation_errors());
			}

			redirect('review/detail/' . md5($this->input->post('id_program')));
		}

		show_404();
	}

	public function show()
	{
		if($_POST) {
			$data['id_review'] = $this->input->post('id');
			$data['review']	   = $this->program_model->getReview(array('id_review_management' => $this->input->post('id')), array(), 'row');
			$data['program']   = $this->program_model->find(array('id_program' => $data['review']->id_program));
			$data['lab']       = $this->employee_model->organization(array('id_organization_item' => $data['program']->id_organization_item, 'level' => 'lab'), 'row');
			$data['unit']	   = !empty($lab) ? $this->employee_model->organization(array('id_organization_item' => $lab->id_organization_item_parent), 'row') : NULL;
			$data['comments']  = $this->program_model->reviewComment('result', array('id_review_management' => $this->input->post('id')));

			$this->load->view(MODULE_VIEW_PATH.'review/review_show_popup', $data);

			return FALSE;
		}

		show_404();
	}

	public function delete()
	{
		if($_POST) {
			$id = $this->input->post('id');

			$this->db->where('id_review_management', $id);

			$this->db->delete('review_management');

			//$this->session->set_flashdata('notice', 'Review deleted');

			//redirect('review/detail/' . md5($id_program[0]));
		}
		
	}

	public function comment()
	{
		if($_POST) {
			if($this->input->post('btn_simpan')) {
				$data = array(
					'content' 				=> $this->input->post('comment'),
					'id_review_management'	=> $this->input->post('id'),
					'id_user'				=> $this->user->row()->id_user
				);

				$this->db->insert('review_comment', $data);

				$data['notice'] = 'Data berhasil disimpan';
				$data['error']	= 0;
				$data['id_review'] = $this->input->post('id');

				echo json_encode($data);

				//$review = $this->program_model->getReview(array('id_review_management' => $this->input->post('id')), array(), 'row');

				//redirect('review/detail/' . md5($review->id_program));

				return FALSE;
			}

			$data['id_review'] = $this->input->post('id');
			$data['review']	   = $this->program_model->getReview(array('id_review_management' => $this->input->post('id')), array(), 'row');
			$data['program']   = $this->program_model->find(array('id_program' => $data['review']->id_program));
			$data['lab']       = $this->employee_model->organization(array('id_organization_item' => $data['program']->id_organization_item, 'level' => 'lab'), 'row');
			$data['unit']	   = !empty($lab) ? $this->employee_model->organization(array('id_organization_item' => $lab->id_organization_item_parent), 'row') : NULL;
			$data['comments']  = $this->program_model->reviewComment('result', array('id_review_management' => $this->input->post('id')));

			$this->load->view(MODULE_VIEW_PATH.'review/review_edit_popup', $data);

			return FALSE;
		}

		show_404();
	}

	public function comment_ajax()
	{
		$data['id_review'] = $this->input->post('id');
		$data['review']	   = $this->program_model->getReview(array('id_review_management' => $this->input->post('id')), array(), 'row');
		$data['program']   = $this->program_model->find(array('id_program' => $data['review']->id_program));
		$data['lab']       = $this->employee_model->organization(array('id_organization_item' => $data['program']->id_organization_item, 'level' => 'lab'), 'row');
		$data['unit']	   = !empty($lab) ? $this->employee_model->organization(array('id_organization_item' => $lab->id_organization_item_parent), 'row') : NULL;
		$data['comments']  = $this->program_model->reviewComment('result', array('id_review_management' => $this->input->post('id')));

		$this->load->view(MODULE_VIEW_PATH.'review/review_comment_ajax', $data);

		return FALSE;
	}

	public function json($id = 0)
	{
		$data	 	 = array();
		$filterLike  = array();
		$filterCount = array();

		$filter['md5(review_management.id_program)'] = $id[0];

		if($this->session->userdata('showType') != '') {
			$filter['review_management.id_mas_review_type'] = $this->session->userdata('showType');
		}

		if($_POST) {
			$fil = $this->input->post('filterscount');
			$ord = $this->input->post('sortdatafield');

			for($i=0;$i<$fil;$i++) {
				$field = $this->input->post('filterdatafield'.$i);
				$value = $this->input->post('filtervalue'.$i);
				
				if($field == 'comment') {
					$filterCount[$field] = $value;
				} else {
					$filterLike[$field] = $value;
				}
				
			}

			if(!empty($ord)) {
				if($ord != 'comment') {
					$this->db->order_by($ord, $this->input->post('sortorder'));
				}
			}
		}

		$program = $this->program_model->getReview($filter, $filterLike);

		foreach($program as $prog) {
			$labs		= $this->employee_model->organization(array('id_organization_item' => $prog->id_organization_item, 'level' => 'lab'), 'row');
			$unit		= !empty($labs) ? $this->employee_model->organization(array('id_organization_item' => $labs->id_organization_item_parent), 'row') : NULL;
			$count		= $this->program_model->reviewComment('num_rows', array('id_review_management' => $prog->id_review_management));

			if(!empty($filterCount)) {
				if($filterCount['comment'] == $count) {
					$data[] = array(
						'id'   			=> (int) $prog->id_review_management,
						'id_encrypt'   	=> md5($prog->id_review_management),
						'type'			=> $prog->type,
						'files'			=> $prog->files,
						'comment'		=> (int) $count,
						'date'			=> $prog->date
					);
				}
			} else {

			$data[] = array(
				'id'   			=> (int) $prog->id_review_management,
				'id_encrypt'   	=> md5($prog->id_review_management),
				'type'			=> $prog->type,
				'files'			=> $prog->files,
				'comment'		=> (int) $count,
				'date'			=> $prog->date
			);

			}
		}

		$json = array(
			'TotalRows' => sizeof($data),
			'Rows' => $data
		);

		echo json_encode(array($json));

		$this->session->unset_userdata('showPrime');
		$this->session->unset_userdata('filterName');
		$this->session->unset_userdata('filterYear');
	}

	public function _remap($id, $params = "")
	{
		if(method_exists($this, $id)) {
			return $this->{$id}($params);
		} else {
			$this->index($id);
		}
	}
}