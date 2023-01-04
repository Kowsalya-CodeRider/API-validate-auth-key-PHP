<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function userlogin($data)
	{
		return $this->db->where('u_email',$data['u_email'],'u_password',$data['u_password'])->get('user_register');
	}
}
