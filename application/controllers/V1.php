<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class v1 extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('v1/Auth');
	}
	public function Register(){
		$config = [
			[
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required|min_length[3]|alpha_dash',
			],
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|valid_email|is_unique[users.email]'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|min_length[6]',
			],
			[
				'field' => 'password_confirmation',
				'label' => 'Password Confirmation',
				'rules' => 'required|matches[password]',
			],
		];

		$this->form_validation->set_data($this->input->post());
		$this->form_validation->set_rules($config);

		$msg = '';
		$code = 200;
		$data = [];

		if($this->form_validation->run()==FALSE){
			$msg = "Failed to create new account!";
			$code = 400;
			$data = $this->form_validation->error_array();
		}else{
			$register = $this->Auth->insert_users($this->input->post());
			if($register){
				$msg = "Success create your account!";
			}else{
				$code = 400;
				$msg = "There is something wrong!";
			}
			$data = [];
		}

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode(array('messsage' => $msg, 'data' => $data)))
		->set_status_header($code);
	}
	public function Login(){
		$config = [
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|valid_email'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|min_length[6]',
			],
		];

		$this->form_validation->set_data($this->input->post());
		$this->form_validation->set_rules($config);

		$msg = '';
		$code = 200;
		$data = [];
		$token = '';

		if($this->form_validation->run()==FALSE){
			$code = 400;
			$data = $this->form_validation->error_array();
		}else{
			$login = $this->Auth->get_users($this->input->post());

			if($login){
				$msg = "We found your account!";
				$token = $login;
			}else{
				$code = 400;
				$msg = "We did not find the account in our record!";
			}
			
			$data = [];
		}

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode(array('messsage' => $msg, 'data' => $data, 'token' => $token)))
		->set_status_header($code);	
	}
	public function logout(){
		$token = $this->input->get('token');
		$remove = $this->Auth->deleteToken($token);

		$msg = '';
		$code = 200;
		$data = [];

		if($remove){
			$msg = 'Logout successfully!';
		}else{
			$msg = 'Logout Failed';
			$data[0] = 'Current account not found';
			$code = 400;
		}

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode(array('messsage' => $msg, 'data' => $data)))
		->set_status_header($code);	
	}
}