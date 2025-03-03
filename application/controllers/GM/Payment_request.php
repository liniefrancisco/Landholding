<?php 
class Payment_request extends App_Controller{
  	public function __construct(){
		parent::__construct();
		$this->not_logged_in();
		$this->load->model('GM/Payment_request_model');
		$this->load->model('Datatable_model');
		$this->load->model('Notification_bar_model');
		$this->load->model('Notification_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('Pro');
		$this->load->helper('url');
		$this->load->helper('security');
  	}
  	public function Notification(){
		$data = array();
		#TAB NOTIFICATION
		$data['reviewed_acq'] 			= $this->Notification_bar_model->getds_status_reviewed();
	    $data['pending_payment'] 		= $this->Notification_bar_model->getpr_status_pending();
	    $data['approved_payment'] 		= $this->Notification_bar_model->getpr_status_approved();
	    $data['paid_payment'] 			= $this->Notification_bar_model->getpr_status_paid();
	    $data['disapproved_payment'] 	= $this->Notification_bar_model->getpr_status_disapproved();
		#Message Notification
		$recepient 						=  $this->session->userdata('user_id');
		$data['all_notifications']		= $this->Notification_model->get_notif_per_user($recepient);
		$data['all_notification_no']	= $this->Notification_model->get_all_notification_no($recepient);
		return $data;
	}
  	public function index(){
		$this->sess_gm();
		$data 						= $this->Notification();
	    $data['disapproved_reason'] = $this->Payment_request_model->getpr_disapproved();

		$this->render_template('3A/Payment_request/table',$data);        
  	}
  	function pending_payment_request(){
		$data  		= array();
		$all_info 	= $this->Datatable_model->get_row($_POST);
			
		foreach($all_info as $ai){
			if ($ai->tag == "New" || $ai->tag == "New LAPF-ES") {
				$lot_owner 			= 	$ai->firstname." ".substr(($ai->middlename),0,1).". ".$ai->lastname;
				$lot_location 		= 	$ai->street."- ".$ai->baranggay.", ".$ai->municipality.", ".$ai->province;
				$date_requested 	= 	$ai->date_requested ? date_format(date_create($ai->date_requested), "F d, Y") : 'N/A';

				if ($ai->type == "Cash Advance") {
	                $action 		=	'<center>
	                            			<a href="' . base_url('Gm/Payment_request/request_cash_advance/'.$ai->ca_control_no.'/'.$ai->is_no) . '"
	                                		class="btn btn-sm btn-info" style="border-radius:10px; background-color:#304b73;border-color:#fff;">
	                                		<span class="fa fa-eye"></span> View</a>
	                        			</center>';
	            }else if($ai->type == "Full Payment") {
	                $action 		=	'<center>
	                            			<a href="' . base_url('Gm/Payment_request/request_full_payment_view/'.$ai->fp_control_no.'/'.$ai->is_no) . '"
	                                		class="btn btn-sm btn-info" style="border-radius:10px; background-color:#304b73;border-color:#fff;">
	                                		<span class="fa fa-eye"></span> View</a>
	                        			</center>';
	            }else{
	            	 $action 		=	'<center>
	                            			<a href="' . base_url('Gm/Payment_request/request_extrajudicial_view/'.$ai->is_no) . '"
	                                		class="btn btn-sm btn-info" style="border-radius:10px; background-color:#304b73;border-color:#fff;">
	                                		<span class="fa fa-eye"></span> View</a>
	                        			</center>';
	            }

				$data[] 			=	array($ai->is_no, $lot_owner,$ai->lot_type,$lot_location,$ai->type,$date_requested,$action);
			}
		}
							
		$output = array(
			"draw" 					=> $_POST['draw'],
			"recordsTotal" 			=> $this->Datatable_model->countAll(),
			"recordsFiltered" 		=> $this->Datatable_model->countFiltered($_POST),
			"data" 					=> $data,
		);
		echo json_encode($output);
	}
	function approved_payment_request(){
		$data  		= array();
		$all_info 	= $this->Datatable_model->get_row($_POST);
			
		foreach($all_info as $ai){
			if ($ai->tag == "New" || $ai->tag == "New LAPF-ES") {
				$lot_owner 			= 	$ai->firstname." ".substr(($ai->middlename),0,1).". ".$ai->lastname;
				$lot_location 		= 	$ai->street."- ".$ai->baranggay.", ".$ai->municipality.", ".$ai->province;
				$date_requested 	= 	$ai->date_requested ? date_format(date_create($ai->date_requested), "F d, Y") : 'N/A';
				$date_approved 		= 	$ai->date_approved ? date_format(date_create($ai->date_approved), "F d, Y") : 'N/A';

				if ($ai->type == "Cash Advance") {
		               $action 		=	'<center>
		                            		<a href="' . base_url('Gm/Payment_request/request_cash_advance/'.$ai->ca_control_no.'/'.$ai->is_no) . '"
		                                	class="btn btn-sm btn-info" style="border-radius:10px; background-color:#304b73;border-color:#fff;">
		                                	<span class="fa fa-eye"></span> View</a>
		                        		</center>';
	            }else if($ai->type == "Full Payment") {
	                $action 		=	'<center>
		                            		<a href="' . base_url('Gm/Payment_request/request_full_payment_view/'.$ai->fp_control_no.'/'.$ai->is_no) . '"
		                                	class="btn btn-sm btn-info" style="border-radius:10px; background-color:#304b73;border-color:#fff;">
		                                	<span class="fa fa-eye"></span> View</a>
		                        		</center>';
	            }else{
	            	$action 		=	'<center>
		                            		<a href="' . base_url('Gm/Payment_request/request_extrajudicial_view/'.$ai->is_no) . '"
		                                	class="btn btn-sm btn-info" style="border-radius:10px; background-color:#304b73;border-color:#fff;">
		                                	<span class="fa fa-eye"></span> View</a>
		                        		</center>';
	            }

				$data[] 		= 	array($ai->is_no, $lot_owner,$ai->lot_type,$lot_location,$ai->type,$date_requested,$date_approved,$action);
			}
		}
							
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->Datatable_model->countAll(),
			"recordsFiltered" 	=> $this->Datatable_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}
	function disapproved_payment_request(){
		$data  		= array();
		$all_info 	= $this->Datatable_model->get_row($_POST);
			
		foreach($all_info as $ai){
			if ($ai->tag == "New" || $ai->tag == "New LAPF-ES") {
				$lot_owner 			= 	$ai->firstname." ".substr(($ai->middlename),0,1).". ".$ai->lastname;
				$lot_location 		= 	$ai->street."- ".$ai->baranggay.", ".$ai->municipality.", ".$ai->province;
				$date_request 		= 	$ai->submission_date ? date_format(date_create($ai->submission_date), "F d, Y") : 'N/A';
				$date_disapproved 	= 	$ai->date_disapproved ? date_format(date_create($ai->date_disapproved), "F d, Y") : 'N/A';

				if ($ai->type == "Cash Advance") {
					$reason 		= 	'<a data-toggle="modal" data-target=".ca_reason_disapproved_'.$ai->ca_control_no.'" data-backdrop="static" data-keyboard="false"><i class="fa fa-eye"></i> View Reason</a>';
	                $action 		=	'<center>
		                            		<a href="' . base_url('Gm/Payment_request/request_cash_advance/'.$ai->ca_control_no.'/'.$ai->is_no) . '"
		                                	class="btn btn-sm btn-info" style="border-radius:10px; background-color:#304b73;border-color:#fff;">
		                                	<span class="fa fa-eye"></span> View</a>
	                        			</center>';
	            }else if($ai->type == "Full Payment") {
	            	$reason 		= 	'<a data-toggle="modal" data-target=".fp_reason_disapproved_'.$ai->fp_control_no.'" data-backdrop="static" data-keyboard="false"><i class="fa fa-eye"></i> View Reason</a>';
	                $action 		=	'<center>
	                            			<a href="' . base_url('Gm/Payment_request/request_full_payment_view/'.$ai->is_no.'/'.$ai->id) . '"
			                                class="btn btn-sm btn-info" style="border-radius:10px; background-color:#304b73;border-color:#fff;">
			                                <span class="fa fa-eye"></span> View</a>
	                        			</center>';
	            }else{
	            	$reason 		= 	'<a data-toggle="modal" data-target=".es_reason_disapproved_'.$ai->is_no.'" data-backdrop="static" data-keyboard="false"><i class="fa fa-eye"></i> View Reason</a>';
	            	$action 		=	'<center>
	                            			<a href="' . base_url('Gm/Payment_request/request_extrajudicial_view/'.$ai->is_no) . '"
	                                		class="btn btn-sm btn-info" style="border-radius:10px; background-color:#304b73;border-color:#fff;">
	                                		<span class="fa fa-eye"></span> View</a>
	                        			</center>';
	            }

				$data[] 			= 	array($ai->is_no, $lot_owner,$ai->lot_type,$lot_location,$ai->type,$date_request,$date_disapproved,$reason,$action);
			}
		}
							
		$output = array(
			"draw" 					=> $_POST['draw'],
			"recordsTotal" 			=> $this->Datatable_model->countAll(),
			"recordsFiltered" 		=> $this->Datatable_model->countFiltered($_POST),
			"data" 					=> $data,
		);
		echo json_encode($output);
	}
	function paid_payment_request(){
		$data  		= array();
		$all_info 	= $this->Datatable_model->get_row($_POST);
			
		foreach($all_info as $ai){
			if($ai->tag == "New"){
				$lot_owner 		= 	$ai->firstname." ".substr(($ai->middlename),0,1).". ".$ai->lastname;
				$lot_location 	= 	$ai->street."- ".$ai->baranggay.", ".$ai->municipality.", ".$ai->province;
				$date_requested = 	$ai->date_requested ? date_format(date_create($ai->date_requested), "F d, Y") : 'N/A';
				$date_approved 	= 	$ai->date_approved ? date_format(date_create($ai->date_approved), "F d, Y") : 'N/A';
				$date_payed 	= 	$ai->date_payed ? date_format(date_create($ai->date_payed), "F d, Y") : 'N/A';

				if ($ai->type == "Cash Advance") {
	                $action 	=	'<center>
		                            	<a href="' . base_url('Gm/Payment_request/request_cash_advance/'.$ai->ca_control_no.'/'.$ai->is_no) . '"
		                                class="btn btn-sm btn-info" style="border-radius:10px; background-color:#304b73;border-color:#fff;">
		                                <span class="fa fa-eye"></span> View</a>
	                        		</center>';
	            } else {
	                $action 	=	'<center>
		                            	<a href="' . base_url('Gm/Payment_request/request_full_payment_view/'.$ai->is_no.'/'.$ai->id) . '"
		                                class="btn btn-sm btn-info" style="border-radius:10px; background-color:#304b73;border-color:#fff;">
		                                <span class="fa fa-eye"></span> View</a>
	                        		</center>';
	            }

				$data[] 		= 	array($ai->is_no, $lot_owner,$ai->lot_type,$lot_location,$ai->type,$date_requested,$date_approved,$date_payed,$action);
			}
		}
							
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->Datatable_model->countAll(),
			"recordsFiltered"	=> $this->Datatable_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}
	public function request_cash_advance($ca_control_no,$is_no){
		$this->sess_gm();
		$data['title'] 				= "Request Cash Advance";
		$data 						= $this->Notification();
		$data['payment_request']	= $this->Payment_request_model->get_payment_requests_by_ca($ca_control_no);
		$data['li']					= $this->Payment_request_model->get_land_info_by_id($is_no);
		$data['ll']					= $this->Payment_request_model->get_lot_location_by_id($is_no);
		$data['oi']					= $this->Payment_request_model->get_owner_info_by_id($is_no);

		$this->render_template('3A/Payment_request/request_cash_advance_view',$data);   
 	}
 	public function request_full_payment_view($fp_control_no, $is_no){
	    $this->sess_gm();
	    $data['title'] = "Request Full Payment";

	    //SIDEBAR NOTIFICATION
	    $data['gm_acquisition'] = $this->Gm_notification_model->get_acquisition_count();
	    $data['gm_payment_request'] = $this->Gm_notification_model->get_payment_request_count();
	    //END SIDEBAR NOTIFICATION

	    //DATA
	    $data['is_no'] = $is_no;
	    $data['li'] = $this->Payment_request_model->get_land_info_by_id($is_no);
	    $data['oi'] = $this->Payment_request_model->get_owner_info_by_id($is_no);
	    $oi = $this->Payment_request_model->get_owner_info_by_id($is_no);
	    $data['ll'] = $this->Payment_request_model->get_lot_location_by_id($is_no);
	    $data['cp'] = $this->Payment_request_model->get_contact_person_by_id($oi['id']);
	    $data['ud'] = $this->Payment_request_model->get_uploaded_documents_by_id($is_no);
	    $data['bi']= $this->Payment_request_model->get_broker_info_by_id($is_no);
	    $data['payment_request'] = $this->Payment_request_model->get_payment_requests_by_fp($fp_control_no);
	    $data['ar'] = $this->Payment_request_model->get_acknowledgement_receipt_content($is_no);
	    //END DATA
    
      	$this->render_template('3A/Payment_request/request_full_payment_view', $data);
  	}
 	public function request_extrajudicial_view($is_no){
	    $this->sess_gm();
	    $data['title'] = "Extra Judicial Settlement";

	    //SIDEBAR NOTIFICATION
	    $data['gm_acquisition'] = $this->Gm_notification_model->get_acquisition_count();
	    $data['gm_payment_request'] = $this->Gm_notification_model->get_payment_request_count();
	    //END SIDEBAR NOTIFICATION

	    //DATA
	    $data['li'] = $this->Payment_request_model->get_land_info_by_id($is_no);
	    $data['oi'] = $this->Payment_request_model->get_owner_info_by_id($is_no);
	    $data['ll'] = $this->Payment_request_model->get_lot_location_by_id($is_no);
	    $data['ud'] = $this->Payment_request_model->get_uploaded_documents_by_id($is_no);
	    $data['ab'] = $this->Payment_request_model->getab_byid($is_no);
	    $data['cbi'] = $this->Payment_request_model->getcbi_byid($is_no);
	    $data['ci'] = $this->Payment_request_model->getci_byid($is_no);
	    $data['ca'] = $this->Payment_request_model->getca_byid($is_no);
	    $data['eu'] = $this->Payment_request_model->getesupload_byid($is_no);
	    $data['payment_request'] = $this->Payment_request_model->get_payment_requests_by_es($is_no);
	    //END DATA
    
      	$this->render_template('3A/Payment_request/extrajudicial_settlement_form_view', $data);
  	}
  	public function submit_approved_full_payment($is_no){
		$this->sess_gm();
		$data = $this->Payment_request_model->getform_req_byid($is_no);
		$action = "Approved";
		$name =  $this->session->userdata('firstname').' '.$this->session->userdata('lastname');

		$this->Payment_request_model->approve_full_payment($is_no,$name,$action);
		$this->Payment_request_model->notify_user($data['form_type'],$action,$is_no,$data['user_id']);  
  	}
  	public function submit_approved_cash_advance($is_no){
		$this->sess_gm();
		$data = $this->Payment_request_model->getform_req_byid($is_no);
		$action = "Approved";
		$name =  $this->session->userdata('firstname').' '.$this->session->userdata('lastname');

		$this->Payment_request_model->approve_cash_advance($is_no,$name,$action);
		$this->Payment_request_model->notify_user($data['form_type'], $is_no, $action, $data['user_id']);    
  	}
  	public function submit_approved_es($is_no){
		$this->sess_gm();
		$data = $this->Payment_request_model->getform_req_byid($is_no);
		$action = "Approved";
		$name =  $this->session->userdata('firstname').' '.$this->session->userdata('lastname');

		$this->Payment_request_model->approve_li_es($is_no,$name,$action);
		$this->Payment_request_model->approve_ud_es($is_no,$name);
		$this->Payment_request_model->notify_user($data['form_type'],$action,$is_no,$data['user_id']);  
  	}
  	public function pop_up_approved($is_no){
		$this->session->set_flashdata('notif','Request Approved Successfully!');
		redirect('GM/Payment_request');
  	}
  	public function submit_disapproved_full_payment($is_no){
		$this->sess_gm();
		$data = $this->Payment_request_model->getform_req_byid($is_no);
		$reason = $this->input->post('disapproved_message');
		$action = "Disapproved";
		$name = $this->session->userdata('firstname').' '.$this->session->userdata('lastname');

		$this->Payment_request_model->disapprove_full_payment($is_no, $name, $reason);
		$this->Payment_request_model->notify_user($data['form_type'],$action,$is_no,$data['user_id']);
  	}
  	public function submit_disapproved_cash_advance($id){
		$this->sess_gm();
		$data = $this->Payment_request_model->getform_req_byid($id);
		$reason = $this->input->post('disapproved_message');
		$action = "Disapproved";
		$name = $this->session->userdata('firstname').' '.$this->session->userdata('lastname');

		$this->Payment_request_model->disapprove_cash_advance($id,$name,$action,$reason);
		$this->Payment_request_model->notify_user($data['form_type'],$id, $action, $data['user_id']);
  	}
  	public function submit_disapproved_es($is_no){
		$this->sess_gm();
		$data = $this->Payment_request_model->getform_req_byid($is_no);
		$reason = $this->input->post('disapproved_message');
		$action = "Disapproved";
		$name = $this->session->userdata('firstname').' '.$this->session->userdata('lastname');

		$this->Payment_request_model->disapprove_li_es($is_no, $name,$action, $reason);
		$this->Payment_request_model->disapprove_ud_es($is_no, $name,$reason);
		$this->Payment_request_model->notify_user($data['form_type'],$action,$is_no,$data['user_id']);
  	}
  	public function pop_up_disapproved($is_no){
		$this->session->set_flashdata('notif','Request Disapproved Successfully!');
		redirect('GM/Payment_request');
  	}
}