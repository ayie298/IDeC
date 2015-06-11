<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qa_list extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		
	}
	
	function index(){
		$this->template->write_view('content','themes/modules/qa/qa');
		$this->template->render();
		
	} 
	
	
	function json(){
		$query = $this->db->get('QA_product');
		$result = ($query->num_rows() > 0)?$query->result():false;
		if($result==false){
			echo ('null');
			
		}else{
			$rows = array();
			foreach($result as $row){
				$rows[] = array(
								'id'=>$row->id_qa_product,
								'nama'=>$row->product_name,
								'deskripsi'=>$row->information,
								'summary'=>$row->executive_summary,
								'file'=> $this->count_file($row->id_qa_product).' File' ,
								'hasil'=>$row->conclusion
								);
				
			}
			$json =array(
			'TotalRows'=>sizeof($rows),
			'Rows'=>$rows);
			echo json_encode(array($json));
		}
	}
	
	function count_file($id=''){
		$this->db->where(array('id_qa_product'=>$id));
		$query = $this->db->get('QA_product_document');
		$result = ($query->num_rows() > 0)?$query->result():false;
		if($result==false){
			$c=0;
		}else{
			$c = sizeof($result);
		}
		return $c;
		
	}	
	function json_file($id=''){
		$this->db->where(array('id_qa_product'=>$id));
		$query = $this->db->get('QA_product_document');
		$result = ($query->num_rows() > 0)?$query->result():false;
		if($result==false){
			echo ('null');
			
		}else{
			$rows = array();
			foreach($result as $row){
				$rows[] = array(
								'id'=>$row->id_qa_product_document,
								'deskripsi'=>$row->description,
								'tgl'=>$row->received_date 
								);
				
			}
			$json =array(
			'TotalRows'=>sizeof($rows),
			'Rows'=>$rows);
			echo json_encode(array($json));
		}

	}
	

}	
		