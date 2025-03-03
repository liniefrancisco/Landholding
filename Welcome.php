<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends App_Controller {
	public function __construct(){
		parent::__construct();
		$this->not_logged_in();
		// Load the model
		$this->load->model('Account_model');
		$this->load->model('Accounting_model');
		$this->load->model('Legal_model');
		$this->load->model('Land_model');
		$this->load->model('Aspayment_model');
		$this->load->model('Payment_model');
		$this->load->model('Notification_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library('user_agent');
	}

	public function index(){
		$data['title'] = "Home"; 

		$data['li_approved'] = $this->Land_model->getli_status_approved();
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['li_disapproved'] = $this->Land_model->getli_status_disapproved();
		$data['li_pending'] = $this->Land_model->getli_status_pending();
		$data['disapproved_payments']= $this->Payment_model->getnum_payment_disapproved();
		$data['pending_payment_requests']= $this->Payment_model->getnum_pending_payment_requests();
		$data['approved_payment_requests']= $this->Payment_model->getnum_payment_approved();
		$data['pending_rcp']= $this->Payment_model->getpending_rcp_numrows();
		$data['uploaded_documents'] = $this->Land_model->getuploaded_documents(); // get complete upload title
		$data['ud_pending'] = $this->Land_model->getud_status_pending();
		$data['ud_uploaded'] = $this->Land_model->getud_status_uploaded();
		$data['ud_checked'] = $this->Land_model->getud_status_checked();
		$data['ud_incomplete'] = $this->Land_model->getud_status_incomplete();
		$data['pending_es']= $this->Aspayment_model->get_pending_es_aspayment();
		$data['pending_js']= $this->Aspayment_model->get_pending_js_aspayment();
		$data['disap_es']= $this->Aspayment_model->get_disapproved_es_aspayment();
		$data['disap_js']= $this->Aspayment_model->get_disapproved_js_aspayment();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();

		if($this->session->userdata('user_type') == 'Administrator'){
			$this->render_template('administrator/home',$data);
		}elseif ($this->session->userdata('user_type') == 'GM') {
			$this->render_template('3A/home',$data);
		}elseif($this->session->userdata('user_type') == 'Secretary'){
			$recepient =  $this->session->userdata('user_id');
			$data['all_notifications']= $this->Notification_model->get_notif_per_user($recepient);
			$data['all_notification_no']= $this->Notification_model->get_all_notification_no($recepient);

			$this->render_template('secretary/home',$data);
		}elseif($this->session->userdata('user_type') == 'Legal'){
			$this->render_template('legal/home',$data);
		}elseif($this->session->userdata('user_type') == 'CCD'){
			$recepient =  $this->session->userdata('user_id');
			$data['all_notifications']= $this->Notification_model->get_notif_per_user($recepient);
			$data['all_notification_no']= $this->Notification_model->get_all_notification_no($recepient);
			$data['app_es']= $this->Aspayment_model->get_approved_es_aspayment();
			$data['app_js']= $this->Aspayment_model->get_approved_js_aspayment();
		
			$this->render_template('ccd/home',$data);  

		}elseif($this->session->userdata('user_type') == 'Accounting'){
			$this->render_template('accounting/home',$data);
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