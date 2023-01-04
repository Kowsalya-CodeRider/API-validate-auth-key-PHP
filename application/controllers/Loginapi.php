<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Calcutta");
class Loginapi extends CI_Controller {

	 public function __construct()
	 {
	   parent::__construct();
	   $this->load->model('User_model');
	 }
	 

	public function index()
	{
		if(isset($_POST['login']))
		{
			if(isset($_POST['key']))
			{
				$key = $this->security->xss_clean($this->input->post('key'));
				if($key=='kowsalya')
				{					
					$u_email 		  = $this->security->xss_clean($this->input->post('u_email'));
					$u_password 	  = $this->security->xss_clean($this->input->post('u_password'));
					
					if(!empty($u_email) && !empty($u_password))
					{
						if (filter_var($u_email, FILTER_VALIDATE_EMAIL)) 
						{
							$u_data = array(
											'u_email' 	 => $u_email,
											'u_password' => md5($u_password)
										);
							$is_user = $this->User_model->userlogin($u_data);
							$rowdata = $is_user->row();
							if($is_user->num_rows()>0)
							{
								$output['error'] = 'Loged In Successfully';
							}
							else
							{
								$output['error'] = 'Invalid Login Credentials';
								
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
