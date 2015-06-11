<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partnership_action extends CI_Controller {
	
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

		if($_POST){
			$judul 		= $this->input->post('judul');
			$mitra 		= $this->input->post('mitra');
			$program 	= $this->input->post('program');
			$program_1 	= $this->input->post('program_1');
			$kategori 	= $this->input->post('kategori');
			$status 	= $this->input->post('status');
			$budget 	= $this->input->post('budget');
			$tanggal1 	= $this->input->post('tanggal1');
			$tanggal2 	= $this->input->post('tanggal2');
			$tanggal3 	= $this->input->post('tanggal3');

			$date1 = new DateTime($tanggal1.' 00:00:00');
			$date2 = new DateTime($tanggal2.' 00:00:00');
			$interval = $date1->diff($date2);
			

			$this->form_validation->set_rules('judul','Judul','required');
			$this->form_validation->set_rules('budget','Budget','required|numeric');
			
			if($this->form_validation->run()==false){
				
				$data['judul'] 		='';
				$data['kategori'] 	=''; 
				$data['program'] 	=''; 
				$data['program_1'] 	='';
				$data['status'] 	='';
				$data['mitra']	 	='';
				$data['budget']	 	='';
				$data['tanggal1']	='';
				$data['tanggal2']	='';
				$data['tanggal3']	='';
				$data['document']	= $this->parser->parse("themes/modules/partnership/partnership_document",$data,true);
				$data['activity']	= $this->parser->parse("themes/modules/partnership/partnership_activity",$data,true);
				$data['justification']= $this->parser->parse("themes/modules/partnership/partnership_justification",$data,true);
				$data['notice'] = validation_errors();
				$data['organization'] = $this->employee_model->organization(array('level' => 'subunit'));
				$data['programs']	 = $this->program_model->findAll();

				$this->template->write_view('content','themes/modules/partnership/partnership_add',$data);
				$this->template->render();							
			}else{
				$insert = array(
					'title' => $judul,
					'number' => '',
					'description' => '',
					'partner' => $mitra,
					'budget' => $budget,
					'start_date' => $tanggal1,
					'end_date' => $tanggal2,
					'duration' => $interval->days,
					'signature_date' => $tanggal3,
					'id_organization_item_initiator' => $program,
					'id_program' => $program_1,
					'id_mas_project_status' => $status,
					'partnership_category' => $kategori
				);

				$this->db->insert('partnership', $insert);
				$data['notice'] = 'Data berhasil disimpan';

				$data['judul'] 		='';
			$data['kategori'] 	=''; 
			$data['program'] 	=''; 
			$data['program_1'] 	='';
			$data['status'] 	='';
			$data['mitra']	 	='';
			$data['budget']	 	='';
			$data['tanggal1']	='';
			$data['tanggal2']	='';
			$data['tanggal3']	='';
			$data['document']	= $this->parser->parse("themes/modules/partnership/partnership_document",$data,true);
			$data['activity']	= $this->parser->parse("themes/modules/partnership/partnership_activity",$data,true);
			$data['justification']= $this->parser->parse("themes/modules/partnership/partnership_justification",$data,true);
			$data['organization'] = $this->employee_model->organization(array('level' => 'subunit'));
			$data['programs']	 = $this->program_model->findAll();
				$this->template->write_view('content','themes/modules/partnership/partnership_add',$data);
				$this->template->render();
			}
			
		}else{
			$data['judul'] 		='';
			$data['kategori'] 	=''; 
			$data['program'] 	=''; 
			$data['program_1'] 	='';
			$data['status'] 	='';
			$data['mitra']	 	='';
			$data['budget']	 	='';
			$data['tanggal1']	='';
			$data['tanggal2']	='';
			$data['tanggal3']	='';
			$data['document']	= $this->parser->parse("themes/modules/partnership/partnership_document",$data,true);
			$data['activity']	= $this->parser->parse("themes/modules/partnership/partnership_activity",$data,true);
			$data['justification']= $this->parser->parse("themes/modules/partnership/partnership_justification",$data,true);
			$data['organization'] = $this->employee_model->organization(array('level' => 'subunit'));
			$data['programs']	 = $this->program_model->findAll();

			$this->template->write_view('content','themes/modules/partnership/partnership_add',$data);
			$this->template->render();	
		}
	}
	
	function detail(){
		$this->template->write_view('content','themes/modules/partnership/partnership_edit');
		$this->template->render();
	}
	
	function edit(){
		$this->template->write_view('content','themes/modules/partnership/partnership_edit');
		$this->template->render();
	}
	
	function delete(){
		$this->template->write_view('content','themes/modules/partnership/partnership');
		$this->template->render();		
		
	}
	
	function partnership_document_json(){
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