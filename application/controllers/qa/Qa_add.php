<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qa_add extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','files'));
		$this->load->helper('date');
		 
	}
	 
	function index(){
		if($_POST){
			$name_produk 		= $this->input->post('name_produk');
			$bln_1 				= $this->input->post('bln_1');
			$thn_1 				= $this->input->post('thn_1');
			$bln_2 				= $this->input->post('bln_2');
			$thn_2 				= $this->input->post('thn_2');
			$summary 			= $this->input->post('summary');
			$kesimpulan 		= $this->input->post('kesimpulan');
			$rekomendasi 		= $this->input->post('rekomendasi');
			$nama_penguji 		= $this->input->post('nama_penguji');
			$keterangan 		= $this->input->post('keterangan');
			
			$this->form_validation->set_rules('name_produk','Nama Produk','required');
			 
			if($this->form_validation->run()==false){
				$this->session->set_flashdata('notice', validation_errors());
				$data['name_produk']		=$name_produk;
				$data['bln_1']				=$bln_1;
				$data['bln_2']				=$bln_2;
				$data['thn_1']				=$thn_1;
				$data['thn_2']				=$thn_2;
				$data['summary']			=$summary;
				$data['kesimpulan']			=$kesimpulan;
				$data['rekomendasi']		=$rekomendasi;
				$data['nama_penguji']		=$nama_penguji;
				$data['keterangan']			=$keterangan;			
				$this->template->write_view('content','themes/modules/qa/qa_add',$data);
				$this->template->render();				
			}else{
				$insert = array(	'product_name'=>$name_produk,
									'start_date'=>$thn_1.'-'.$bln_1.'-01',
									'end_date'=>$thn_2.'-'.$bln_2.'-01',
									'executive_summary'=>$summary,
									'conclusion'=>$kesimpulan,
									'testing_recomendation'=>$rekomendasi,
									'tester_name'=>$nama_penguji,
									'information'=>$keterangan
								
								); 	
				$result = 	$this->db->insert('QA_product',$insert);
				$this->session->set_flashdata('notice', 'Activity has been added' );
				redirect('qa/qa_list');
			}
						
			
			
		}else{
			
			$data['name_produk']		='';
			$data['bln_1']				='';
			$data['bln_2']				='';
			$data['thn_1']				='';
			$data['thn_2']				='';
			$data['summary']			='';
			$data['kesimpulan']			='';
			$data['rekomendasi']		='';
			$data['nama_penguji']		='';
			$data['keterangan']			='';
			$this->template->write_view('content','themes/modules/qa/qa_add',$data);
			$this->template->render();			
		}
	}
 
	function File($id=''){
		if($_POST){ 
			$descripsi  = $this->input->post('Deskripsi');
			$tgl 		= $this->input->post('tanggal');
			$uploads = $this->files->uploads('userfile', 'doc|docx|xlsx|pdf|xls|jpg|gif|png|jpeg', 'qa');
			if($uploads){
				$insert = array('description'=>$descripsi,'received_date'=>$tgl,'id_qa_product'=>$id,'file'=>$uploads['filename']);
				$this->db->insert('QA_product_document',$insert);
				redirect('qa/qa_edit?id='.$id);	
			}else{
				redirect('qa/qa_edit?id='.$id);	
			}
			
		}else{
			redirect('qa/qa_list');	
			
		}
	}
	
}	
		