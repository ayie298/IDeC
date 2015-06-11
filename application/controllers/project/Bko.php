<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bko extends CI_Controller {

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

	public function index()
	{
		if($_POST) {
			$this->session->set_userdata('unit', $this->input->post('unit'));
			$this->session->set_userdata('unitYear', $this->input->post('year'));

			return FALSE;
		}

		$this->db->order_by('org_name', 'ASC');

		$data['unit'] 		= $this->employee_model->organization(array('level' => 'subunit'));
		$data['researcher']	= $this->researcher_model->findAll(array('employee.id_mas_employee_position' => 1));
		
		$this->template->write_view('content', MODULE_VIEW_PATH.'researcher/researcher_map', $data);
		$this->template->render();
	}

	public function bko_json($id = 0)
	{
		$data	  	= array();
		$filter 	= array();
		$json 		= "";

		$id = $this->session->userdata('unit') == '' ? 4 : $this->session->userdata('unit');
		$date = $this->session->userdata('unitYear') == '' ? date('Y') : $this->session->userdata('unitYear');

		$bidang = $this->employee_model->organization(array('level' => 'subunit'));
		$researcher = $this->researcher_model->findAll(array('employee.id_mas_employee_position' => 1));

		foreach($bidang as $bidang) {
			$haveOneLab = $this->employee_model->organization(array('level' => 'lab', 'id_organization_item_parent' => $bidang->id_organization_item), 'row');
			$lab = !empty($haveOneLab) ? ',"lab":"'.$haveOneLab->org_name.'"' : ',"lab":""';
			$no = 1;
			$jsonRes	= "";

			if(!empty($haveOneLab)) {
				$project = $this->program_model->find(array('program.id_organization_item' => $haveOneLab->id_organization_item));
			} else {
				$project = $this->program_model->find(array('program.id_organization_item' => $bidang->id_organization_item));
			}

			$prName = !empty($project) ? $project->name : '';
			$prID = !empty($project) ? $project->id_program : '';

			foreach($researcher as $res) {
				$id = !empty($haveOneLab) ? $haveOneLab->id_organization_item : $bidang->id_organization_item;

				$bobot = $this->project_model->memberProject($res->id_employee, 'result', array('id_program' => $prID));
				$jsonRes .= ',"r'.$no.'":' . sizeof($bobot);

				$no++;
			}

			$json .= '{"id":'.$bidang->id_organization_item.', "parent":"", "bidang":"'.$bidang->abbreviation.'"'.$lab.$jsonRes.',"program":"'.$prName.'" },';

			$otherLab = $this->employee_model->organization(array('level' => 'lab', 'id_organization_item_parent' => $bidang->id_organization_item), 'result');

			foreach($otherLab as $labs) {
				$lab = ',"lab":"'.$labs->org_name.'"';
				$project = $this->program_model->findAll(array('program.id_organization_item' => $labs->id_organization_item));
				$jsonRes	= "";
				$bobot = 0;

				foreach($project as $pr) {
					foreach($researcher as $res) {
						$id = $labs->id_organization_item;

						$bobot = $this->project_model->memberProject($res->id_employee, 'result', array('id_program' => $pr->id_program));
						
						$jsonRes .= ',"r'.$no.'":' . sizeof($bobot);

						$no++;
					}

					$json .= '{"id":'.$labs->id_organization_item.', "parent":"", "bidang":""'.$lab.$jsonRes.',"program":"'.$pr->name.'" },';
				}
			}
		}

		$json = substr($json, 0,strlen($json)-1);
		echo '[{"Rows":['.$json.'] } ]';

		$this->session->unset_userdata('unit');
		$this->session->unset_userdata('unitYear');
	}
}
