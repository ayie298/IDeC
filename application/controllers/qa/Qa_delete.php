<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qa_delete extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
		
	}
	
	function index(){
		$id = $this->input->get('id');
		$this->db->where(array('id_qa_product'=>$id));
		$result = $this->db->get('QA_product');
		$qa = ($result->num_rows() > 0 )?$result->row():false;
		if($qa!=false){
			$this->db->where(array('id_qa_product'=>$id));
			$this->db->delete('QA_product');
			$this->session->set_flashdata('notice', 'Activity has been Delete' );
			redirect('qa/qa_list');
		}else{
			$this->session->set_flashdata('notice', 'Data not found' );
			redirect('qa/qa_list');
		}
		
	}
}	