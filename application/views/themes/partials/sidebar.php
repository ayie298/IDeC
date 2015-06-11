
<div style="position:fixed;z-index:9999;">
	<div id="sidebar" class="nav-collapse collapse">

	 <!-- BEGIN RESPONSIVE QUICK SEARCH FORM 
	 <div class="navbar-inverse">
		<form class="navbar-search visible-phone">
		   <input type="text" class="search-query" placeholder="Search" />
		</form>
	 </div>
	 <!-- END RESPONSIVE QUICK SEARCH FORM -->
     
     <!-- BEGIN SIDEBAR MENU -->
	  <ul class="sidebar-menu">
      <?php
      $this->db->order_by('sort','asc');
      $query = $this->db->get_where('app_menus', array('id_theme'=>2,'position'=>3,'sub_id'=>'0'));
      foreach($query->result() as $row){
           $query_e = $this->db->get_where('app_files', array('id'=>$row->file_id,'lang'=>'ina'));
           $data_e = $query_e->row_array();  
	  ?>
			<li class="<?php if($data_e['id']=='1') echo "sub-menu active"; else echo "sub-menu"; ?>">
			  <a style="padding-top:0;padding-bottom:0" href="<?php echo base_url() ?>" id="bar_<?php echo strtolower(str_replace(" ","",$data_e['filename'])); ?>">
				  <i class="<?php echo $data_e['class']; ?>"></i>
				  <span><?php echo $data_e['filename']; ?></span>
			  </a>
			</li>
      <?php
	  }
	  $this->db->order_by('sort','asc');
	  $query = $this->db->get_where('app_menus', array('id_theme'=>2,'position'=>3,'sub_id'=>'1'));
	  foreach($query->result() as $row){
		   $query_e = $this->db->get_where('app_files', array('id'=>$row->file_id,'lang'=>'ina'));
		   $data_e = $query_e->row_array();  
	  ?>
			<li class="<?php if($data_e['id']=='1') echo "sub-menu active"; else echo "sub-menu"; ?>">
			  <a style="padding-top:0;padding-bottom:0" href="<?php echo ($data_e['module']!="#" ? base_url().$data_e['module'] : "#"); ?>" id="bar_<?php echo strtolower(str_replace(" ","",$data_e['filename'])); ?>">
				  <i class="<?php echo $data_e['class']; ?>"></i>
				  <span><?php echo $data_e['filename']; ?><?php echo ($data_e['module']!="#" ? "" : " &nbsp; &raquo;"); ?></span>
			  </a>
			  <?php
			  $query_b = $this->db->get_where('app_menus', array('file_id'=>$row->file_id));
			  $data_b = $query_b->row_array();
			
			  $this->db->order_by('sort','asc');
			  $query_c = $this->db->get_where('app_menus', array('position'=>3,'sub_id'=>$data_b['id']));
			  if($query_c->num_rows()>0){
				  echo "<ul class='sub'>";
				  foreach($query_c->result() as $row_c){
						$query_d = $this->db->get_where('app_files', array('id'=>$row_c->file_id,'lang'=>'ina'));
						$data_d = $query_d->row_array();
								  $query_e = $this->db->get_where('app_menus', array('file_id'=>$row_c->file_id));
								  $data_e = $query_e->row_array();
								
								  $this->db->order_by('sort','asc');
								  $query_f = $this->db->get_where('app_menus', array('position'=>3,'sub_id'=>$data_e['id']));
								  if($query_f->num_rows()>0){
									?>
									<li><a style="padding-top:6px;padding-bottom:6px;font-weight:bold" href="<?php echo base_url().'idec/index/'.$data_d['id'].'/'.strtolower($data_d['description']); ?>"><?php echo $data_d['filename']; ?></a>
									<?php
									  foreach($query_f->result() as $row_f){
											$query_g = $this->db->get_where('app_files', array('id'=>$row_f->file_id,'lang'=>'ina'));
											$data_g = $query_g->row_array();
												?><a style="padding-top:6px;padding-bottom:6px" href="<?php echo base_url().$data_g['module']; ?>"> - <?php echo $data_g['filename']; ?></a><?php
											  
									  }
								  }else{
									?>
									<li><a style="padding-top:6px;padding-bottom:6px" href="<?php echo base_url().$data_d['module']; ?>"><?php echo $data_d['filename']; ?></a>
									<?php
								  }
								  ?>

							</li>
							<?php
						  
				  }
				  echo "</ul>";  
			  }
			  ?>
			</li>
	  <?php
	  }
      ?>
 </div>
</div>


