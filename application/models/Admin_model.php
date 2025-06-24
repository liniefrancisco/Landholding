<?php
class Admin_model extends CI_Model{
	#==================================================
	#CRUD QUERY
	#==================================================
	public function create_account(){
		$data = array(
			 'firstname' 		=> $this->input->post('fname'),
			 'lastname' 		=> $this->input->post('lname'),
			 'position' 		=> $this->input->post('position'),
			 'username' 		=> $this->input->post('username'),
			 'password' 		=> $this->encryption->encrypt($this->input->post('password')),
			 'user_type' 		=> $this->input->post('user_type'),
			 'date_created' 	=> date('M-d-Y H:i:s'),
		);
		$this->db->insert('users', $data);
	}
	public function remove_user($id){
		$this->db->delete('users', array('user_id' => $id));
	}
	#==================================================
	#QUERY
	#==================================================
	public function check_username($un){
		$user   = array();
		$query  = $this->db->select('*')
						   ->from('users')
						   ->where(array('username' => $un))
						   ->get()->result_array();       

		foreach ($query as $u){
				$user = $u;
		}
		return $user;
	}
	public function getuser_lists(){
		$query = $this->db->get('users');
		return $query->result_array();   
	}
}