<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qa_edit extends CI_Controller {

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
		$data['url'] = base_url('qa/qa_edit?id='.$id);
		$data['id'] = $id;
		if($qa!=false){
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
					$this->template->write_view('content','themes/modules/qa/qa_edit',$data);
					$this->template->render();			
				}else{
					$this->db->where(array('id_qa_product'=>$id));
					$update = array(	'product_name'=>$name_produk,
										'start_date'=>$thn_1.'-'.$bln_1.'-01',
										'end_date'=>$thn_2.'-'.$bln_2.'-01',
										'executive_summary'=>$summary,
										'conclusion'=>$kesimpulan,
										'testing_recomendation'=>$rekomendasi,
										'tester_name'=>$nama_penguji,
										'information'=>$keterangan
									
									); 	
					$result = 	$this->db->update('QA_product',$update);
					$this->session->set_flashdata('notice', 'Activity has been update' );
					redirect('qa/qa_list');
				}
						
			}else{
				$data['name_produk']		=$qa->product_name;
				$data['bln_1']				=date('mm',strtotime($qa->start_date));
				$data['bln_2']				=date('mm',strtotime($qa->end_date));
				$data['thn_1']				=date('YY',strtotime($qa->start_date));
				$data['thn_2']				=date('YY',strtotime($qa->end_date));
				$data['summary']			=$qa->executive_summary;
				$data['kesimpulan']			=$qa->conclusion;
				$data['rekomendasi']		=$qa->testing_recomendation;
				$data['nama_penguji']		=$qa->tester_name;
				$data['keterangan']			=$qa->information;				
				$this->template->write_view('content','themes/modules/qa/qa_edit',$data);
				$this->template->render();							
			}
			
		}else{
			$this->session->set_flashdata('notice', 'Data not found' );
			redirect('qa/qa_list');
		}

		
	} 
	
	

}	
		