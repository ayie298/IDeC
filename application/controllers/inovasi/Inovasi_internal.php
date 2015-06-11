<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inovasi_internal extends CI_Controller {

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
        $data = array();

		$this->template->write_view('content', MODULE_VIEW_PATH.'inovasi/inovasi_internal', $data);
		$this->template->render();
	}

    function add($id=""){
        $data = array();        
        $data['document']   = $this->load->view(MODULE_VIEW_PATH.'inovasi/inovasi_document', $data, TRUE);
        $data['pemanfaatan'] = $this->load->view(MODULE_VIEW_PATH.'inovasi/inovasi_pemanfaatan_list', $data, TRUE);
        $this->template->write_view('content', MODULE_VIEW_PATH.'inovasi/inovasi_internal_add', $data);
        $this->template->render();
    }

    function edit($id=""){
        $data = array();        
        $data['document']   = $this->load->view(MODULE_VIEW_PATH.'inovasi/inovasi_document', $data, TRUE);
        $data['pemanfaatan'] = $this->load->view(MODULE_VIEW_PATH.'inovasi/inovasi_pemanfaatan_list', $data, TRUE);
        $this->template->write_view('content', MODULE_VIEW_PATH.'inovasi/inovasi_internal_add', $data);
        $this->template->render();
    }

    function detail($id=""){
        $data = array();        
        $data['document']   = $this->load->view(MODULE_VIEW_PATH.'inovasi/inovasi_document', $data, TRUE);
        $data['pemanfaatan'] = $this->load->view(MODULE_VIEW_PATH.'inovasi/inovasi_pemanfaatan_list', $data, TRUE);
        $this->template->write_view('content', MODULE_VIEW_PATH.'inovasi/inovasi_internal_add', $data);
        $this->template->render();
    }

	public function json()
	{
        die('
        [{"TotalRows":"4","Rows":[
            {
                "id":"1",
                "title":"X-Igent",
                "lab":"Public Services",
                "tim":"Rendy Azhari",
                "file":"1 file",
                "tgl":"2014/02/02",
                "hasil":"Handover to DDB"
            },{
                "id":"2",
                "title":"Petualangan Khatulistiwa, Loku dan Naga",
                "lab":"Digital Media Entertainment",
                "tim":"Vicky Indrawan",
                "file":"1 file",
                "tgl":"2014/02/02",
                "hasil":"Business Model validation"
            },{
                "id":"3",
                "title":"Website Iconesia",
                "lab":"Tourism Application",
                "tim":"Yanitra Dharmawan",
                "file":"1 file",
                "tgl":"2014/02/02",
                "hasil":"Product validation"
            },{
                "id":"4",
                "title":"Video Training TIK Garuda Media",
                "lab":"Education",
                "tim":"NIZAR LUTHFIANSYAH",
                "file":"1 file",
                "tgl":"2014/02/02",
                "hasil":"Product validation"
            }]
        }]
        ');
	}
    
    function document_json(){
        die('
        [{"TotalRows":"3","Rows":[
            {
                "id":"1",
                "deskripsi":"Business Plan",
                "tgl":"2013\/11\/12 12:14:05"
            },{
                "id":"2",
                "deskripsi":"Market Goal",
                "tgl":"2013\/11\/12 12:14:05"
            },{
                "id":"3",
                "deskripsi":"Future Plan",
                "tgl":"2013\/11\/12 12:14:05"
            }]
        }]
        ');
    }

}	
		