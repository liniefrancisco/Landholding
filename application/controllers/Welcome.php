<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends App_Controller {
	public function __construct(){
		parent::__construct();
		$this->not_logged_in();
		// Load the model
		$this->load->model('Account_model');
		$this->load->model('Notification_model');
		$this->load->model('Notification_bar_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library('user_agent');
  	}

	public function index(){
		$data['title'] 					= "Home"; 
		$recepient 						=  $this->session->userdata('user_id');
		$data['all_notifications']		= $this->Notification_model->get_notif_per_user($recepient);
		$data['all_notification_no']	= $this->Notification_model->get_all_notification_no($recepient);

		if($this->session->userdata('user_type') == 'Administrator'){
			$this->render_template('administrator/home',$data);
		}elseif($this->session->userdata('user_type') == 'Secretary'){
			$data['pending_acq'] 		= $this->Notification_bar_model->getds_status_pending();
			$data['approved_acq'] 		= $this->Notification_bar_model->getds_status_approved();
			$this->render_template('secretary/home',$data);
		}elseif($this->session->userdata('user_type') == 'Legal'){
			$data['pending_acq'] 		= $this->Notification_bar_model->getds_status_pending();
			$data['approved_acq1'] 		= $this->Notification_bar_model->getds_status_approved1();
			$this->render_template('legal/home',$data);
		}elseif ($this->session->userdata('user_type') == 'GM') {
			$data['pending_acq'] 		= $this->Notification_bar_model->getds_status_pending();
			$data['approved_acq'] 		= $this->Notification_bar_model->getds_status_approved();
			$data['approved_acq1'] 		= $this->Notification_bar_model->getds_status_approved1();
			$data['reviewed_acq'] 		= $this->Notification_bar_model->getds_status_reviewed();
			$data['pending_payment'] 	= $this->Notification_bar_model->getpr_status_pending();
			$this->render_template('3A/home',$data);
		}elseif($this->session->userdata('user_type') == 'Accounting'){
			$data['approved_payment'] 	= $this->Notification_bar_model->getpr_status_approved();
			$data['approved_acq'] 		= $this->Notification_bar_model->getds_status_approved();
			$this->render_template('accounting/home',$data);
		}elseif($this->session->userdata('user_type') == 'CCD'){
			$data['land_info'] 			= $this->Ccd_notification_model->get_all_approved();
			$this->render_template('ccd/home',$data);  
		}else{
			redirect('login');
		}
	}
  	public function set_time_active(){ 
		$user =  $this->session->userdata('user_id');
		$this->Account_model->set_active_time($user);
  	}
	public function logout(){
		$user =  $this->session->userdata('user_id');
		$this->Account_model->logout($user);
		session_destroy();
		redirect('');       
  	}
 	public function decrypt_password(){
		echo '<form action="http://localhost/landholding/welcome/decrypt_password" method="POST">
				<input type="text" name="password" value="" >
				<input type="submit" value="submit" name="submit">
		  	</form>';
		echo $this->encryption->decrypt(@$_POST['password']);
  	}
}
