<?php
class Idec_model extends CI_Model {
    
    var $tabel = "app_users_profile";
    
    function get_page($id){
    	$this->db->where(array('id_app_files'=>$id,'lang'=>'ina'),1);
        $query = $this->db->get("app_files");
        
        return $query->row_array();
    }
    
    function get_page_subs($id){
		$this->db->where('file_id',$id);
		$this->db->where('position',3);
		$this->db->where('id_theme',2);
		$query = $this->db->get('app_menus');
		$parent = $query->row_array();

		$this->db->order_by('sort','asc');
		$this->db->where('position',3);
		$this->db->where('sub_id',$parent['id']);
		$this->db->where('app_files.app_theme_id_app_theme',2);
		$this->db->where('app_files.lang','ina');
		$this->db->join('app_files','app_files.id_app_files=app_menus.file_id','INNER');
		$query = $this->db->get('app_menus');

        return $query->result_array();
    }
    
    function get_user_profile($id=0){
		if($id==0){
			$id=$this->session->userdata('id');
		}
        $query = $this->db->get_where($this->tabel, array('id'=>$id),1);
        
        return $query->row_array();
    }
    
    function update_profile($type,$data){
        $val['nip']=str_replace(" ","",$this->input->post('nip'));
        $val['gelar']=$this->input->post('gelar');
        $val['nama']=$this->input->post('nama');
        $val['nama_gelar']=$this->input->post('nama_gelar');
        $val['id_number']=$this->input->post('id_number');
        $val['birthdate']=$this->input->post('birthdate');
        $val['birthplace']=$this->input->post('birthplace');
        $val['gender']=$this->input->post('gendre');
        $val['agama']=$this->input->post('agama');
        $val['jml_anak']=$this->input->post('jml_anak');
        $val['kawin']=$this->input->post('kawin');
        $val['phone_number']=$this->input->post('phone_number');
        $val['mobile']=$this->input->post('mobile');
        $val['email_kantor']=$this->input->post('email_kantor');
        $val['email_pribadi']=$this->input->post('email_pribadi');
        $val['address']=$this->input->post('address');
        $val['propinsi']=$this->input->post('propinsi');
        $val['kota']=$this->input->post('kota');
        $val['kodepos']=$this->input->post('kodepos');
        $val['tglmasuk']=$this->input->post('tglmasuk');
        
        if($type=="1"){
             $val['image'] = $data['file_name'];
        }
       
        $this->db->update($this->tabel, $val, array('id'=> $this->session->userdata('id')));
    }
    
    function update_password($id){
		if($this->input->post('password')!="password" && $this->input->post('password2')!="password"){
			$data['password']=$this->encrypt->sha1($this->input->post('password').$this->config->item('encryption_key'));
            return $this->db->update("app_users_list", $data, array('id' => $id));
		}
	}
	
	function get_content($file_id){
		$query = $this->db->query("SELECT a.file_id, a.id, a.title_content, a.headline, a.author, b.image,
		FROM_UNIXTIME(a.dtime,'%T %d %M %Y' ) AS waktu, a.dtime AS waktu_kegiatan, a.content,
		a.links, a.hits, FROM_UNIXTIME(a.dtime_end,'%T %d %M %Y' ) AS waktu_akhir
		FROM app_files_contents a INNER JOIN app_users_profile b ON b.username = a.author 
		WHERE a.file_id=$file_id AND a.lang='ina' AND a.published=1 ORDER BY id LIMIT 0,10");
		
		return $query->result_array();
	}
	
	function get_detail_content($file_id,$id){
		$query = $this->db->query("SELECT a.file_id, c.filename, a.id, a.title_content, a.author, b.image, a.lang,
		FROM_UNIXTIME(a.dtime,'%T %d %M %Y' ) AS waktu, a.dtime AS waktu_kegiatan, headline,
		a.content, a.links, a.hits, FROM_UNIXTIME(a.dtime_end,'%T %d %M %Y' ) AS waktu_akhir
		FROM app_files_contents a INNER JOIN app_users_profile b ON b.username = a.author INNER JOIN app_files c ON c.id=a.file_id
		WHERE a.file_id=$file_id AND a.id=$id AND a.lang='ina' AND c.lang='ina'");
		
		return $query->result_array();
	}
	
	function get_all_cuti($file_id){
		$query=$this->db->query("SELECT tgl AS start, keterangan AS title FROM spkp_cuti_bersama UNION
		SELECT dtime AS start, title_content AS title FROM app_files_contents WHERE published=1 and file_id=$file_id");
		
		return $query->result_array();
	}

	public function findMaster($table, $options = array(),$type = 'result',$limit = '')
	{
		$this->db->select('*');
        $this->db->from($table);
        
        if(sizeof($options) > 0 OR !$options == '') {
            foreach($options as $key => $val) :
                if($key == 'join') {
                    $ex = explode(",",$val);
                    $this->db->$key($ex[0],$ex[1]);
                } else {
                    $this->db->$key($val);
                }
            endforeach;
        }
        
        if(!empty($limit)) {
        	$ex = explode(',', $limit);
        	$this->db->limit($ex[1], $ex[0]);	
        }
        
        $query = $this->db->get();
                
        return $query->$type();
	}

    public function find($table, $where = array(), $whereOR = array(), $whereLike = array())
    {
        if(!empty($where)) {
            $this->db->where($where);

            if(!empty($whereOR) and sizeof($whereOR) == 1) {
                $this->db->or_where($whereOR);
            }
        }

        if(!empty($whereOR) && sizeof($whereOR) > 1) {
            $queryOr = "";

            foreach($whereOR as $key => $value) {
                if(is_array($whereOR[$key])) {
                    for($j=0;$j<sizeof($whereOR[$key]);$j++) {
                        $queryOr .= $key . ' = ' . $whereOR[$key][$j] . ' OR ';
                    }
                }
            }

            $this->db->where('(' . substr($queryOr, 0, strlen($queryOr)-3) . ')');
        }

        if(!empty($whereLike)) {
            $this->db->like($whereLike);
        }

        return $this->db->get($table)->row();
    }

    public function findAll($table, $where = array(), $whereOR = array(), $whereLike = array())
    {
        if(!empty($where)) {
            $this->db->where($where);

            if(!empty($whereOR) and sizeof($whereOR) == 1) {
                $this->db->or_where($whereOR);
            }
        }

        if(!empty($whereOR) && sizeof($whereOR) > 1) {
            $queryOr = "";

            foreach($whereOR as $key => $value) {
                if(is_array($whereOR[$key])) {
                    for($j=0;$j<sizeof($whereOR[$key]);$j++) {
                        $queryOr .= $key . ' = ' . $whereOR[$key][$j] . ' OR ';
                    }
                }
            }

            $this->db->where('(' . substr($queryOr, 0, strlen($queryOr)-3) . ')');
        }

        if(!empty($whereLike)) {
            $this->db->like($whereLike);
        }

        return $this->db->get($table)->result();
    }
	
}
?>