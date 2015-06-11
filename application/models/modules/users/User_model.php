<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model {

	public $table = 'user';

	public function __construct()
	{
		parent::__construct();
	}

	public function find($where)
	{
		$this->db->where($where);
		$this->db->join('user_level', 'user_level.id_user_level = user.id_user_level');
		$this->db->join('employee', 'employee.id_user = user.id_user', 'LEFT');

		return $this->db->get($this->table)->row();
	}

	public function updateLogin($username)
	{
		$this->db->where('username', $username);
		$this->db->update($this->table, array('last_login' => date('Y-m-d H:i:s')));
	}

}