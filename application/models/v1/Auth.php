<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Model{

	public function insert_users($input){
		$data = array(
			'username' => $input['username'],
			'email' => $input['email'],
			'password' => password_hash($input['password'], PASSWORD_DEFAULT)
		);
		return $this->db->insert('users', $data);
	}
	public function get_users($input){
		$data = $this->db->get_where('users', array('email' => $input['email']));

		if(password_verify($input['password'], $data->result()[0]->password)){
			$token = $this->generate_token();
			$this->db->set('token', $token);
			$this->db->where('id_user', $data->result()[0]->id_user);
			$setToken = $this->db->update('users');
			if($setToken){
				return $token;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function deleteToken($token){
		$this->db->set('token', '');
		$this->db->where('token', $token);
		$w = $this->db->update('users');
		if($w){
			return true;
		}else{
			return false;
		}
	}
	public function generate_token($length = 32){
		$token = '';
		$alpha = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcedfghijklmnopqrstuvwxyz0123456789';
		for($i = 0;$i < $length;$i++){
			$token .= $alpha{rand(0,strlen($alpha)-1)};
		}
		return $token;
	}
}