<?php
class Account extends App_Controller{
	public function __construct(){
		parent::__construct();
		$this->not_logged_in();
		// Load the model
		$this->load->model('Notification_bar_model');
		$this->load->model('Notification_model');
		$this->load->model('Account_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('encryption');
	}
	public function Notification(){
		$data = array();
		#TAB NOTIFICATION
	    $data['pending_acq'] 			= $this->Notification_bar_model->getds_status_pending();
		#Message Notification
		$recepient 						=  $this->session->userdata('user_id');
		$data['all_notifications']		= $this->Notification_model->get_notif_per_user($recepient);
		$data['all_notification_no']	= $this->Notification_model->get_all_notification_no($recepient);
		return $data;
	}
	public function index(){     
		$data['title'] = "Profile";
		$data 		  = $this->Notification();
		$username 	  = $this->input->post('username');
		$password 	  = $this->input->post('password'); 
		$old_username = $this->input->post('old_username');
		$old_password = $this->input->post('old_password');

		if($username != $old_username){
			$this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[50]|alpha_numeric|callback_check_uname');
		}if($password != $old_password){
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[50]|alpha_numeric');
		}
		$this->form_validation->set_rules('file', 'Profile Picture', 'callback_check_file');

		if ($this->form_validation->run() == FALSE){
			$this->render_template('account/user_account',$data);
		}else{
			$id 	 = $this->session->userdata('user_id');
			$user 	 = $this->Account_model->getuser_byid($id);
			$fr_form = $username.$password;
			$fr_db   = $user['username'].$this->encryption->decrypt($user['password']);
						
			if($_FILES["file"]['name']){
				$this->Account_model->update_profile($id);
				$this->session->set_flashdata('update_user','Profile Saved Successfully');
			}         
			if($fr_form != $fr_db){
				$this->Account_model->update_credentials($id);
				$this->session->set_flashdata('update_user','Your Credentials Updated Successfully!'); 
			}
			redirect('account');
		}
	}

	public function upload_images($targetPaths, $image_name){
		$date = new DateTime();
		$timeStamp = $date->getTimestamp();
		$filename = '';     
		$tmpFilePaths = $_FILES[$image_name]['tmp_name'];
		//Make sure we have a filepath
		if ($tmpFilePaths != ""){
			//Setup our new file path
			$filename =  $timeStamp . $_FILES[$image_name]['name'];
			$newFilePath = $targetPaths . $filename;
			//Upload the file into the temp dir
			move_uploaded_file($tmpFilePaths, $newFilePath);
		}
		return $filename;
	}
	//==================================================
	//END USER PROFILE
	//==================================================

	//==================================================
	//FORM VALIDATION
	//==================================================
	function check_file(){
		$allowed =  array('gif','png' ,'jpg', 'jpeg');
		$filename = $_FILES['file']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);

		if(empty($filename)){
			return TRUE;
		}else{
			if(strlen($filename) > 200){
				$this->form_validation->set_message('check_file','rename your %s , it exceeds the maximum no. of string which is 200');
				return FALSE;
			}elseif(!in_array(strtolower($ext), $allowed) ) { //not in array
				$this->form_validation->set_message('check_file','your %s  is not a valid format');
				return FALSE;                       
			}else{
				return TRUE;
			}
		}
	}

	function check_uname($un){
		$user = $this->Account_model->check_username($un);
		$sess_id = $this->session->userdata('user_id');

		if(@$user['user_id'] == $sess_id || @$user['username'] != $un){
			return TRUE;       
		}else{
			$this->form_validation->set_message('check_uname','%s  must be unique.');
			return FALSE;
		}
	}
	//==================================================
	//END FORM VALIDATION
	//==================================================


	//==================================================
	//ADMIN=> LIST OF ACCOUNT
	//==================================================
	public function remove(){
		$data['user_lists'] = $this->Account_model->getuser_lists();
		$this->render_template('administrator/remove_user',$data);
	}

	// public function delete_user($id){
	// 	$this->Account_model->remove_user($id);
	// 	$this->session->set_flashdata('notif','User Deleted Successfully!');
	// 	redirect('Account/lists');
	// }
	//==================================================
	//END ADMIN=> LIST OF ACCOUNT
	//==================================================
}