<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Calcutta");
class Signupapi extends CI_Controller {

	 public function __construct()
	 {
	   parent::__construct();
	   $this->load->model('User_model');
	 }
	 

	public function index()
	{
		if(isset($_POST['signup']))
		{
			if(isset($_POST['key']))
			{
				$key = $this->security->xss_clean($this->input->post('key'));
				if($key=='kowsalya')
				{
					$u_name 		  = $this->security->xss_clean($this->input->post('u_name'));
					$u_email 		  = $this->security->xss_clean($this->input->post('u_email'));
					$u_password 	  = $this->security->xss_clean($this->input->post('u_password'));
					$u_phone_number   = $this->security->xss_clean($this->input->post('u_phone_number'));
					
					if(!empty($u_name) && !empty($u_email) && !empty($u_password) && !empty($u_phone_number))
					{
						if (filter_var($u_email, FILTER_VALIDATE_EMAIL)) 
						{
							if(strlen($u_phone_number)>=10 && is_numeric($u_phone_number))
							{
								$u_data = array(
													'u_name' 	 	 => $u_name,
													'u_email' 	 	 => $u_email,
													'u_password' 	 => md5($u_password),
													'u_phone_number' => $u_phone_number
												);
								$this->db->insert('user_register',$u_data);
								$output['success'] = 'Registration Successfully Completed!';
							}
							else
							{
								$output['error'] = 'Invalid Mobile Number!';
							}
						}
						else
						{
							$output['error'] = 'Invalid Email Id';
						}
					}
					else
					{
						$output['error'] = 'Please Fill All Form Fields';
					}
				}
				else
				{
					$output['error'] = 'Invalid Access key';
				}
			}
			else
			{
				$output['error'] = 'Authentication Failed';
			}
		}
		else
		{
			$output['error'] = 'Invalid Details';
		}
		echo json_encode($output);die;
		
	}
	
	
	
	
	
}
