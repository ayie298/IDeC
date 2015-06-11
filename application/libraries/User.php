<?php

class User {
	var $obj;

	public function __construct()
	{
		$this->obj =& get_instance();
	}

	public function row()
	{
		$this->obj->load->model('modules/users/user_model');

		$user = $this->obj->session->userdata('identity');
		$user = $this->obj->session->userdata('identity') == "" ? 0 : $user['username'];

		$find = $this->obj->user_model->find(array('username' => $user));

		return $find;
	}

	public function login($username = "", $password = "")
	{
		$this->obj->load->model('modules/users/user_model');

		$find = $this->obj->user_model->find(array('username' => $username, 'password' => sha1($password)));

		if($find == 1) {
			$this->obj->user_model->updateLogin($username);
			$this->obj->session->set_userdata(array('identity' => array('username' => $username, 'id' => $find->id_user)));
			$this->obj->session->set_userdata('level', $find->level_name);

			return TRUE;
		}

		return FALSE;
	}

	public function logout()
	{
		$this->obj->session->sess_destroy();
	}
}