<?php
class Owned extends App_Controller{
	public function __construct(){
		parent::__construct();
		$this->not_logged_in();
		// Load the model
		$this->load->model('Datatable_model');
		$this->load->model('Notification_bar_model');
		$this->load->model('Notification_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('security');
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
	public function index(){
		$data['title'] 	= "Owned Land";
		$data 			= $this->Notification();

		if (in_array($this->session->userdata('user_type'), ['Secretary', 'Legal', 'GM', 'Accounting', 'CCD'])) {
			$this->render_template('secretary/Owned/owned_land', $data);
		}else{
			redirect('');
		}
	}
	function owned_land(){
		$data 		= array();
		$all_info 	= $this->Datatable_model->get_row($_POST);

		foreach ($all_info as $ai) {
			$address			= 	'<address>
	                  					<a data-toggle="tooltip" title="click to view map" data-placement="right" href="http://maps.google.com/maps?q='.$ai->street." ".$ai->baranggay." ".$ai->municipality." ".$ai->province.' " target="_blank">
	                    				'.ucfirst($ai->street)."- ".ucfirst($ai->baranggay).", ".ucfirst($ai->municipality).", ".ucfirst($ai->province).'
	                  					</a>
	                				</address>';
			$lot_area 			= 	number_format($ai->lot_size, 2) . " <code>sq/m</code>";
			$date_acquired 		= 	$ai->date_acquired ? date_format(date_create($ai->date_acquired), "F d, Y") : 'N/A';

			$data[] 			=	array($ai->lot, $address, $ai->lot_type, $lot_area,$date_acquired, $ai->tag);
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->Datatable_model->countAll(),
			"recordsFiltered" 	=> $this->Datatable_model->countFiltered($_POST),
			"data" 				=> $data,
		);

		echo json_encode($output);
	}
}