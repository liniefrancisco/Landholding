<?php
class About_Us extends App_Controller{
    public function __construct(){
        parent::__construct();
        $this->not_logged_in();
        $this->load->model('Notification_bar_model');
		$this->load->model('Notification_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
    }
    public function Notification(){
		$data = array();
		#TAB NOTIFICATION
	    $data['pending_acq'] 			= $this->Notification_bar_model->getds_status_pending();
	    $data['reviewed_acq'] 			= $this->Notification_bar_model->getds_status_reviewed();
	    $data['approved_acq'] 			= $this->Notification_bar_model->getds_status_approved();
	    $data['returned_acq'] 			= $this->Notification_bar_model->getds_status_returned();
	    $data['disapproved_acq'] 		= $this->Notification_bar_model->getds_status_disapproved();
	    $data['pending_payment'] 		= $this->Notification_bar_model->getpr_status_pending();
	    $data['approved_payment'] 		= $this->Notification_bar_model->getpr_status_approved();
		#Message Notification
		$recepient 						=  $this->session->userdata('user_id');
		$data['all_notifications']		= $this->Notification_model->get_notif_per_user($recepient);
		$data['all_notification_no']	= $this->Notification_model->get_all_notification_no($recepient);
		return $data;
	}
    function index(){
		$data['title'] 	= "About Us";
		$data 			= $this->Notification();

		if (in_array($this->session->userdata('user_type'), ['Secretary', 'Legal', 'GM', 'Accounting'])) {
			$this->render_template('templates/about_us',$data);
		}else{
			redirect('');
		}  
    }
}