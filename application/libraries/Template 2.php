<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {

	var $template;

	function Template()
	{
		if ( !isset($this->obj) ) $this->obj =& get_instance();

		$this->obj->lang->load('redzonez', $_SESSION['lang']);
		$data['baseurl']=$this->obj->config->item('base_url');

		$this->obj->db->where('key','title');
		$query = $this->obj->db->get('app_config');
		$title = $query->row_array();
		$data['title']= (isset($title['value']) ? $title['value'] : "");

		$this->obj->db->where('key','description');
		$query = $this->obj->db->get('app_config');
		$description = $query->row_array();
		$data['description']= (isset($description['value']) ? $description['value'] : "");

		$this->obj->db->where('key','keywords');
		$query = $this->obj->db->get('app_config');
		$keywords = $query->row_array();
		$data['keywords']= (isset($keywords['value']) ? $keywords['value'] : "");

		$this->obj->db->where('key','online');
		$query = $this->obj->db->get('app_config');
		$result_off = $query->row_array();
		$query->free_result();   

		$application_theme = array('sertifikasi');
		$segment_theme=explode("_",$this->obj->uri->segment(1));
		if($this->obj->uri->segment(1)=="admin" || substr($this->obj->uri->segment(1),0,5)=="admin") {
			$this->obj->session->set_userdata('ignore_offline',1);
			$this->obj->db->where("app_config.key","theme_admin");
			$this->obj->db->from("app_theme");
			$this->obj->db->join("app_config","app_config.value=app_theme.id_theme","right");
			$query = $this->obj->db->get();
			$result = $query->row_array();
			$query->free_result();    
			if($this->obj->session->userdata('level')!="" && $this->obj->session->userdata('level')!="guest" && $this->obj->session->userdata('level')!="member"){
				$data['panel']= $this->obj->parser->parse("admin/menu",$data,true);
			}else{
				$data['panel']= "";
			}

			$this->set_theme($result['id_theme'],$result['folder'],$result['name']);
		}
		elseif(in_array($segment_theme[0],$application_theme)) {
			if($result_off>0 && $result_off['value']==0 && $this->obj->session->userdata('ignore_offline')!=1){
				$this->obj->db->where("app_config.key","theme_offline");
				$this->obj->db->from("app_theme");
				$this->obj->db->join("app_config","app_config.value=app_theme.id_theme","right");
				$query = $this->obj->db->get();
				$result = $query->row_array();
				$query->free_result();    

				$this->set_theme($result['id_theme'],$result['folder'],$result['name']);
			}else{
				$this->obj->db->where("name",strtolower($segment_theme[0]));
				$this->obj->db->from("app_theme");
				$query = $this->obj->db->get();
				$result = $query->row_array();
				$query->free_result();
				
				$this->set_theme($result['id_theme'],$result['folder'],$result['name']);
			}
			$data['sidebar'] ="";//$this->obj->parser->parse($result['folder']."sidebar",$data,true);
            $data['profile'] =$this->obj->parser->parse($result['folder']."profile",$data,true);
            $data['notification'] =$this->obj->parser->parse($result['folder']."notification",$data,true);
            $data['message'] =$this->obj->parser->parse($result['folder']."message",$data,true);
            
            
		}
		else{
			if($result_off>0 && $result_off['value']==0 && $this->obj->session->userdata('ignore_offline')!=1){
				$this->obj->db->where("app_config.key","theme_offline");
				$this->obj->db->from("app_theme");
				$this->obj->db->join("app_config","app_config.value=app_theme.id_theme","right");
				$query = $this->obj->db->get();
				$result = $query->row_array();
				$query->free_result();    

				$this->set_theme($result['id_theme'],$result['folder'],$result['name']);
			}else{
				$this->obj->db->where("app_config.key","theme_default");
				$this->obj->db->from("app_theme");
				$this->obj->db->join("app_config","app_config.value=app_theme.id_theme","right");
				$query = $this->obj->db->get();
				$result = $query->row_array();
				$query->free_result();

				$this->set_theme($result['id_theme'],$result['folder'],$result['name']);
			}
			$data['sidebar'] ="";//$this->obj->parser->parse($result['folder']."sidebar",$data,true);
            $data['profile'] =$this->obj->parser->parse($result['folder']."profile",$data,true);
            $data['notification'] =$this->obj->parser->parse($result['folder']."notification",$data,true);
            $data['message'] =$this->obj->parser->parse($result['folder']."message",$data,true);
		}
		

		$this->template = $this->obj->session->userdata('folder');
		$this->data = $data;
	}

	function parse_img($content){
		$content = str_ireplace("[img]","<img src='",$content);
		$content = str_ireplace("[/img]","' title='image' alt='image'>",$content);

		return $content;
	}


	function set_theme($id_theme,$folder,$name){
		$this->obj->session->set_userdata('id_theme',$id_theme);
		$this->obj->session->set_userdata('folder',$folder);
		$this->obj->session->set_userdata('name',$name);

	}
	
	function show($data,$file="theme",$nologin=0){
		$data = array_merge($this->data,$data);

		if($this->obj->uri->segment(1)!="admin" && substr($this->obj->uri->segment(1),0,5)!="admin") {

			//Menus
			$menu_config_file = BASEPATH.'../application/views/'.$this->template.'menu.config.php';
			
			if(file_exists($menu_config_file)){
				include_once($menu_config_file);
				foreach($menu as $x){
					$name = $x['name'];
					$position = $x['position'];
					$type = $x['type'];
					$class = $x['class'];
					if($type=="list") {
						$this->obj->menu->create_menu($position,$class);
					}else{
						$this->obj->menu->create_menu_basic($position,$class);
					}
					$data[$name]=$this->obj->menu->menus[$position];
				}
			}

			//Search
			$data['cari'] = $this->obj->lang->line('cari');
			//$data['search']=$this->obj->parser->parse("home/search",$data,true);

			//language
			//$data['language']=$this->obj->parser->parse("home/language",$data,true);

			//image_top
			//$data['image_top']=$this->obj->parser->parse("home/image_top",$data,true);

			//event_new
			$data['event_new']="";

			//Contact
			$query = $this->obj->db->get('app_contact');
			$contact = $query->result_array();
			foreach($contact as $x){
				$data[$x['key']]=$x['value'];
			}
			//$data['contact']=$this->obj->parser->parse("home/contact",$data,true);
			$query->free_result();

			//Login
			if($this->obj->session->userdata('username')!="" && $this->obj->session->userdata('logged_in') || $nologin==1){
				if($nologin==1){
					$data['login'] = "";
				}else{
					$data['login'] = $this->obj->parser->parse($this->obj->session->userdata('folder')."logedin",$data,true);
				}
				$this->obj->parser->parse($this->template.$file,$data);
			}else{
				$data['login'] = $this->obj->parser->parse($this->obj->session->userdata('folder')."login",$data,true);
				$this->obj->parser->parse($this->template."home",$data);
			}
		}else{
			$this->obj->parser->parse($this->template.$file,$data);
		}
	}

}