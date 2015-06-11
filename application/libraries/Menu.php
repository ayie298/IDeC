<?php

	class Menu {

		var $menus;
		var $app_menus			= 'app_menus';
		var $app_files			= 'app_files';
		var $app_users_access	= 'app_users_access';
		
		function Menu()
		{
			$this->obj =& get_instance();
			$_SESSION['lang'] = (!isset($_SESSION['lang']) || $_SESSION['lang']=="" ? $this->obj->config->item('language') : $_SESSION['lang']) ;

			$this->create_sitemap(0);
			$query = $this->obj->db->get('app_web_modules');
			foreach ($query->result_array() as $row)
			{
			   $this->web_modules[] = $row['modules'];
			}

		}


		function create_menu($position,$class,$sub_id=0){
			if($this->obj->session->userdata('level') == "super administrator"){
				$query = $this->obj->db-> query("SELECT a.id,a.file_id,c.filename,c.module,c.class FROM ".$this->app_menus." AS a,".$this->app_files." as c WHERE a.file_id=c.id AND a.`position`=".$position." AND a.sub_id='".$sub_id."' AND c.lang='".$_SESSION['lang']."' GROUP BY a.position,a.id ORDER BY sort ASC");
			}
			elseif($this->obj->session->userdata('level') != ""){
				$query = $this->obj->db-> query("SELECT a.id,a.file_id,c.filename,c.module,c.class FROM ".$this->app_menus." AS a,".$this->app_users_access." AS b,".$this->app_files." as c WHERE a.file_id=c.id AND a.file_id=b.file_id AND b.doshow=1 AND b.level_id='".$this->obj->session->userdata('level')."' AND a.`position`=".$position." AND a.sub_id='".$sub_id."' AND c.lang='".$_SESSION['lang']."' GROUP BY a.position,a.id ORDER BY sort ASC");
			}else{
				$query = $this->obj->db-> query("SELECT a.id,a.file_id,c.filename,c.module,c.class FROM ".$this->app_menus." AS a,".$this->app_users_access." AS b,".$this->app_files." as c WHERE a.file_id=c.id AND a.file_id=b.file_id AND b.doshow=1 AND b.level_id='guest' AND a.`position`=".$position." AND a.sub_id='".$sub_id."' AND c.lang='".$_SESSION['lang']."' GROUP BY a.position,a.id ORDER BY sort ASC");
			}

			if(!isset($this->menus[$position])){
				$this->menus[$position]="<ul class='".$class."'>";
			}
			elseif($sub_id<10){
				$this->menus[$position].="<ul class='".$class."'>";
			}

			//$unread = $this->obj->db-> query("SELECT COUNT(*) as unread FROM app_user_msgs_read WHERE username='".$this->obj->session->userdata('username')."' AND dtime_seen=0");
			//$unread = $unread->row_array();
			//$unread = intval($unread['unread']);

			foreach ($query->result() as $row){
				if($sub_id<10){
					$row->filename = "<i class='".$row->class."'></i>&nbsp; <span>".$row->filename."</span>";
				}else{
					$row->filename = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>".$row->filename."</span>";
				}

				if(in_array($row->module,$this->web_modules)){
					$row->module=base_url()."".$row->module."/".$row->file_id."/".$row->filename;
				}

				if($row->module == "#" && $sub_id==0) {
					$this->menus[$position] .= "<li id=".$row->id."><a href=#>".$row->filename."</a>";
				}
				elseif($row->module == "##") {
					$this->menus[$position] .= "<li id=".$row->id."><a href=#>".$row->filename."</a>";
				}
				elseif($row->module == "#" || $row->module=="" ) {
					$this->menus[$position] .= "<li id='list_".$row->id."'>".anchor("idec/index/".$row->file_id,$row->filename);
				}
				else{
					$this->menus[$position] .= "<li id='list_".$row->id."'>".anchor($row->module,$row->filename);
				}
				$this->create_menu($position,$class,$row->id);

				$this->menus[$position] .= "</li>";
			}
			if($sub_id<10){
				$this->menus[$position].="</ul>";
			}

		}
		
		function create_menu_basic($position,$class,$sub_id=0){
			if($this->obj->session->userdata('level') == "super administrator"){
				$query = $this->obj->db-> query("SELECT a.id,a.file_id,c.filename,c.module FROM ".$this->app_menus." AS a,".$this->app_files." as c WHERE a.file_id=c.id AND a.`position`=".$position." AND a.sub_id='".$sub_id."' AND c.lang='".$_SESSION['lang']."' GROUP BY a.position,a.id ORDER BY sort");
			}
			elseif($this->obj->session->userdata('level') != ""){
				$query = $this->obj->db-> query("SELECT a.id,a.file_id,c.filename,c.module FROM ".$this->app_menus." AS a,".$this->app_users_access." AS b,".$this->app_files." as c WHERE a.file_id=c.id AND a.file_id=b.file_id AND b.doshow=1 AND b.level_id='".$this->obj->session->userdata('level')."' AND a.`position`=".$position." AND a.sub_id='".$sub_id."' AND c.lang='".$_SESSION['lang']."' GROUP BY a.position,a.id ORDER BY sort");
			}else{
				$query = $this->obj->db-> query("SELECT a.id,a.file_id,c.filename,c.module FROM ".$this->app_menus." AS a,".$this->app_users_access." AS b,".$this->app_files." as c WHERE a.file_id=c.id AND a.file_id=b.file_id AND b.doshow=1 AND b.level_id='guest' AND a.`position`=".$position." AND a.sub_id='".$sub_id."' AND c.lang='".$_SESSION['lang']."' GROUP BY a.position,a.id ORDER BY sort");
			}
			
			$this->menus[$position] = "";
			foreach ($query->result() as $row){
				if($this->menus[$position]!="") $this->menus[$position] .= " | ";

				if(in_array($row->module,$this->web_modules)){
					$row->module=base_url()."".$row->module."/".$row->file_id."/".$row->filename;
				}
				if($row->module == "#" || $row->module=="" ) $this->menus[$position] .= "<a href=#>".$row->filename."</a>";
				else	$this->menus[$position] .= anchor($row->module,$row->filename);
			}

		}
		
		function create_sitemap($sub_id){
			$this->sitemap="<ul class='sitemap'>";
			if($this->obj->session->userdata('level') == "super administrator"){
				$query = $this->obj->db-> query("SELECT c.* FROM ".$this->app_menus." AS a,".$this->app_files." as c WHERE a.file_id=c.id AND a.`position`=1 AND a.sub_id='".$sub_id."' AND c.lang='".$_SESSION['lang']."' GROUP BY a.position,a.id ORDER BY sort");
			}
			elseif($this->obj->session->userdata('level') != ""){
				$query = $this->obj->db-> query("SELECT c.* FROM ".$this->app_menus." AS a,".$this->app_users_access." AS b,".$this->app_files." as c WHERE a.file_id=c.id AND a.file_id=b.file_id AND b.doshow=1 AND b.level_id='".$this->obj->session->userdata('level')."' AND a.`position`=1 AND a.sub_id='".$sub_id."' AND c.lang='".$_SESSION['lang']."' GROUP BY a.position,a.id ORDER BY sort");
			}else{
				$query = $this->obj->db-> query("SELECT c.* FROM ".$this->app_menus." AS a,".$this->app_users_access." AS b,".$this->app_files." as c WHERE a.file_id=c.id AND a.file_id=b.file_id AND b.doshow=1 AND b.level_id='guest' AND a.`position`=1 AND a.sub_id='".$sub_id."' AND c.lang='".$_SESSION['lang']."' GROUP BY a.position,a.id ORDER BY sort");
			}

			foreach ($query->result() as $row){
				if($row->module == "#" || $row->module=="" ) $this->sitemap .= "<li><a href=#>".$row->filename."</a>";
				else	$this->sitemap .= "<li>".anchor($row->module,$row->filename);
				$this->create_sitemap($row->id);

				$this->sitemap .= "</li>";
			}
			$this->sitemap.="</ul>";

		}
		
	}	
