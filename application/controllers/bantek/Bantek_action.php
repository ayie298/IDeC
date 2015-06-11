<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bantek_action extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->library('parser');
		$this->load->helper(array('master','file','form'));

		$this->load->model('modules/employee/employee_model');
		$this->load->model('modules/program/program_model');
	}
	
	function index(){
		$this->add();
	}
	
	function add(){
		$data['title'] = 'Add';
		$data['unit_choose'] = array();

		if($_POST){
			$user 		= $this->input->post('user');
			$title 		= $this->input->post('judul');
			$status 	= $this->input->post('status');
			$unit 		= $this->input->post('unit');
			$start_date = $this->input->post('tanggal1');
			$end_date 	= $this->input->post('tanggal2');
			

			$this->form_validation->set_rules('judul','Judul','required');
			$this->form_validation->set_rules('user','User','required');
			
			if($this->form_validation->run()==false){
				
				$data['document']	= $this->parser->parse("themes/modules/bantek/bantek_document",$data,true);
				$data['notice'] = validation_errors();
				$data['unit_choose'] = $unit;
				$data['organization'] = $this->employee_model->organization(array('level' => 'subunit'));

				$this->template->write_view('content','themes/modules/bantek/bantek_add',$data);
				$this->template->render();							
			}else{
				$insert = array(
					'title' => $title,
					'user' => $user,
					'start_date' => $start_date,
					'end_date' => $end_date,
					'id_mas_project_status' => $status,
				);

				$insert = $this->db->insert('bantek', $insert);

				if($insert) {
					$last_id = $this->db->insert_id();

					for($i=0;$i<sizeof($unit);$i++) {
						$insert = array(
							'id_organization_item' => $unit[$i],
							'id_bantek' => $last_id
						);

						$insert = $this->db->insert('Bantek_work_unit_executor', $insert);
					}

					$this->session->set_flashdata('notice', 'Data berhasil disimpan');

					redirect('bantek/bantek_action/add');
				}




				$data['document']	= $this->parser->parse("themes/modules/bantek/bantek_document",$data,true);
				$data['organization'] = $this->employee_model->organization(array('level' => 'subunit'));

				$this->template->write_view('content','themes/modules/bantek/bantek_add',$data);
				$this->template->render();
			}
			
		}else{

			$data['document']	= $this->parser->parse("themes/modules/bantek/bantek_document",$data,true);
			$data['organization'] = $this->employee_model->organization(array('level' => 'subunit'));

			$this->template->write_view('content','themes/modules/bantek/bantek_add',$data);
			$this->template->render();	
		}
	}
	
	function detail(){
		$this->template->write_view('content','themes/modules/bantek/bantek_edit');
		$this->template->render();
	}
	
	function edit(){
		$this->template->write_view('content','themes/modules/bantek/bantek_edit');
		$this->template->render();
	}
	
	function delete(){
		$this->template->write_view('content','themes/modules/bantek/bantek');
		$this->template->render();		
		
	}
	
	function bantek_document_json(){
		die('
		[{"TotalRows":"1","Rows":[
			{
				"id":"1",
				"tipe":"Justification",
				"files":"Justification.pdf"
			}]
		}]
		');
	}
	
 	function partnership_activity_json(){
		die('
		[{"TotalRows":"5","Rows":[
			{
				"id":"1",
				"program":"Assessment Implementasi Web Conference",
				"sow":"Melakukan Assessment Implementasi Web Conference untuk enchancement system conference existing",
				"deliverables":"Rekomendasi Implementasi Web Conference, yang terdiri dari:<br>1. Rekomendasi Provisioning Process<br>2. Rekomendasi Teknis (Spesifikasi Teknis & List Vendor)",
				"progress":"80%",
				"waktu":"Maret - April ",
				"pic_idec":"Lab Node Platform (PM)+BCS",
				"pic_netbro":"SN Dev (PM)+CS & VAS Dev"
			},{
				"id":"2",
				"program":"Assessment Implementasi UC/Video Conference",
				"sow":"Melakukan Assessment Implementasi UC/Video  Conference untuk enchancement system conference existing",
				"deliverables":"Rekomendasi Implementasi Web Conference, yang terdiri dari:<br>1. Rekomendasi Provisioning Process<br>2. Rekomendasi Teknis (Spesifikasi Teknis & List Vendor)",
				"progress":"50%",
				"waktu":"Mei - Juli ",
				"pic_idec":"Lab Node Platform (PM)+BCS",
				"pic_netbro":"SN Dev (PM)+CS & VAS Dev"
			},{
				"id":"3",
				"program":"Assessment Implementasi Prepaid PSTN berbasis IMS atau SIP IN",
				"sow":"Melakukan kajian implementasi layanan Prepaid PSTN berbasis IMS / SIP IN",
				"deliverables":"1. Kajian Layanan<br>2. Rancangan Sistem",
				"progress":"40%",
				"waktu":"Maret - Juli ",
				"pic_idec":"Lab BCS (PM) Node Platform + System Integr & Readliness",
				"pic_netbro":"CS & VAS Dev (PM) + SN Dev"
			},{
				"id":"4",
				"program":"IOT IMS dengan SDP dan OCS", 
				"sow":"Melakukan Assessment & Trial interoperability IMS - SDP dan IMS - OCS",
				"deliverables":"1. Trial IMS+SDP untuk case study hunting & IP Centrex<br>2. Trial IMS+SDP+OCS untuk online charging berbasis seasion",
				"progress":"20%",
				"waktu":"April - September ",
				"pic_idec":"Lab Node Platform (PM) + System Integr & Readliness",
				"pic_netbro":"SN Dev (PM)+CS & VAS Dev"
			},{
				"id":"5",
				"program":"Assessment Implementasi Softclient untuk RCS",
				"sow":"Melakukan Assessment dan kajian strategis implementasi serta design teknis & prototype",
				"deliverables":"1. Strategi Implementasi<br>2. Design teknis & spesifikasi<br>3. List Mitra<br>4. Mock-up softclient untuk UI/UX",
				"progress":"10%",
				"waktu":"Maret - Juni ",
				"pic_idec":"Lab BCS (PM) + Node Platform",
				"pic_netbro":"SN Dev (PM)+CS & VAS Dev"
			}]
		}]
		');
	}
}	