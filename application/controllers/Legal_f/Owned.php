<?php
class Owned extends App_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
		// Load the model
		$this->load->model('Aspayment_model');
		$this->load->model('Land_model');
		$this->load->model('Legal_model');
		$this->load->model('Payment_model');
		$this->load->model('DataTables');
		$this->load->model('Gm/GM_DataTables');
		$this->load->model('Notification_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('GM_model');
	}

	public function lists_of_lot(){
		$this->sess_legal();
		$data['title'] = "Owned";
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['li_approved'] = $this->Land_model->getli_status_approved();
		$data['li_disapproved'] = $this->Land_model->getli_status_disapproved();
		$data['li_pending'] = $this->Land_model->getli_status_pending();
		$data['disapproved_payments'] = $this->Payment_model->getnum_payment_disapproved();
		// $data['pending_payment_requests'] = $this->Payment_model->getnum_pending_payment_requests();
		$data['pending_payment_requests']= $this->GM_model->getnum_pending_payment_requests();
		$data['pending_rcp'] = $this->Payment_model->getpending_rcp_numrows();
		$data['pending_es'] = $this->Aspayment_model->get_pending_es_aspayment();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$data['disap_es'] = $this->Aspayment_model->get_disapproved_es_aspayment();
		$data['disap_js'] = $this->Aspayment_model->get_disapproved_js_aspayment();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		//$data['no_of_notifications']= $this->Notification_model->getnumrows_unread_notification();
		$recepient = $this->session->userdata('user_id');
		$data['all_notifications'] = $this->Notification_model->get_notif_per_user($recepient);
		$data['all_notification_no'] = $this->Notification_model->get_all_notification_no($recepient);
		$data['ud_pending'] = $this->GM_model->getud_status_pending();
		$data['land_info'] = $this->Land_model->getregistry_land();
		
		$this->render_template('legal/lists_of_lot', $data);
	}


}