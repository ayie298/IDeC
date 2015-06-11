<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Files {
  var $CI;

  public function __construct()
  {
      $this->CI =& get_instance();

      $this->CI->load->library('upload');
  }

  public function uploads($field = 'userfile', $types, $folder = '', $encrypt_name = TRUE)
  {
      $config['upload_path']      = './uploads/default/' . $folder;
      $config['allowed_types']    = $types;
      $config['file_ext_tolower'] = TRUE;
      $config['encrypt_name']     = $encrypt_name;

      $this->CI->upload->initialize($config);

      if(!$this->CI->upload->do_upload($field)) {
        return array('error' => 1, 'message' => $this->CI->upload->display_errors());
      }

      $file  = $this->CI->upload->data();
      $datas = array(
        'filename'   => $file['file_name'],
        'mime'       => $file['file_type'],
        'created'    => date('Y-m-d H:i:s'),
        'is_deleted' => 0
      );

      return $datas;
  }
   
}