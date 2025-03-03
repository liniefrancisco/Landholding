<?php
class Payment_request extends App_Controller{
	public function __construct(){
		parent::__construct();
		$this->not_logged_in();
		// Load the model
		$this->load->model('Accounting/Payment_request_model');
		$this->load->model('Accounting/Accounting_notification_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('security');
	}
	public function index(){
		$this->sess_acctng();
		$data['title'] = "Payment Request";
		$data['payment_approved']= $this->Payment_request_model->get_payment_request_approved();
		$data['payment_processing']= $this->Payment_request_model->get_payment_request_processing();

		$this->render_template('accounting/payment_request/table',$data);
	}
	function datatable_pending_payment_request() {
	    $data  = array();
	    $all_info = $this->Payment_request_model->get_row($_POST);

	    foreach ($all_info as $ai) {
	        if ($ai->tag == "New" || $ai->tag == "New LAPF-ES") {
	            $lot_owner 			= $ai->firstname . " " . substr(($ai->middlename), 0, 1) . ". " . $ai->lastname;
	            $lot_location 		= $ai->street . "- " . $ai->baranggay . ", " . $ai->municipality . ", " . $ai->province;
	            $submission_date 	= $ai->submission_date ? date_format(date_create($ai->submission_date), "F d, Y") : 'N/A';

	            if ($ai->type == "Cash Advance") {
	                $action = '<center>
	                            	<button class="btn btn-default" data-toggle="modal" data-target="#crf_ca_' . $ai->ca_control_no . '" title="Create CRF"><i class="fa fa-edit"> CRF</i></button>
	                            	<button class="btn btn-default" data-toggle="modal" data-target="#rca_' . $ai->ca_control_no . '" title="View RCA"><i class="fa fa-file-text"> RCA</i></button>
	                           </center>';
	            }else if($ai->type == "Full Payment") {
	                $action = '<center>
	                            	<button class="btn btn-default" data-toggle="modal" data-target="#crf_fp_' . $ai->fp_control_no . '" title="Create"><i class="fa fa-edit"> CRF</i></button>
	                            	<a class="btn btn-default btn-xs" href="' . base_url('Accounting/Progress/view_inprogress/' . $ai->is_no) . '" title="View"><i class="fa fa-file"> VIEW</i></a>
	                           </center>';
	            }else{
	            	$action = '<center>
	                            	<button class="btn btn-default" data-toggle="modal" data-target="#crf_collateral_' . $ai->is_no . '" title="Create"><i class="fa fa-edit"> CRF</i></button>
	                           </center>';
	            }

	            $data[] = array($ai->is_no,$lot_owner,$ai->lot_type,$lot_location,$ai->type,$submission_date,$action);
	        }
	    }

	    $output = array(
	        "draw" => $_POST['draw'],
	        "recordsTotal" => $this->Payment_request_model->countAll(),
	        "recordsFiltered" => $this->Payment_request_model->countFiltered($_POST),
	        "data" => $data,
	    );

	    echo json_encode($output);
	}
	function datatable_created_payment_request1(){
	    $data  = array();
	    $all_info = $this->Payment_request_model->get_row($_POST);
	    $unique_entries = array();

	    foreach($all_info as $ai){
	        if($ai->tag == "New"){
	            // Create a unique key for each entry to avoid duplicates
	            $unique_key = $ai->is_no . '_' . $ai->ca_control_no . '_' . $ai->fp_control_no;
	            
	            if (!isset($unique_entries[$unique_key])) {
	                $unique_entries[$unique_key] = true; // Mark this entry as seen

	                $lot_owner = $ai->firstname . " " . substr(($ai->middlename), 0, 1) . ". " . $ai->lastname;
	                $lot_location = $ai->street . "- " . $ai->baranggay . ", " . $ai->municipality . ", " . $ai->province;
	                $date_request = $ai->submission_date ? date_format(date_create($ai->submission_date), "F d, Y") : 'N/A';
	                $date_created = $ai->date_created ? date_format(date_create($ai->date_created), "F d, Y") : 'N/A';

	                if ($ai->type == "Cash Advance") {
	                    $action ='<center>
	                                <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#view_crf_ca_modal_' . $ai->ca_control_no . '" title="View"><i class="fa fa-file"> CRF</i></button>
	                                <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#rca_' . $ai->ca_control_no . '" title="View"><i class="fa fa-file-text"> VIEW</i></button>
	                            </center>';
	                } else {
	                    $action ='<center>
	                                <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#view_crf_fp_modal_' . $ai->is_no . '" title="View"><i class="fa fa-file"> CRF</i></button>
	                                <a class="btn btn-default btn-xs" href="' . base_url('Accounting/Progress/view_inprogress/'.$ai->is_no) . '" title="View"><i class="fa fa-file"> VIEW</i></a>
	                            </center>';
	                }

	                $data[] = array($ai->is_no, $lot_owner, $ai->lot_type, $lot_location, $ai->type, $date_request, $date_created, $action);
	            }
	        }
	    }

	    $output = array(
	        "draw" => $_POST['draw'],
	        "recordsTotal" => $this->Payment_request_model->countAll(),
	        "recordsFiltered" => $this->Payment_request_model->countFiltered($_POST),
	        "data" => $data,
	    );
	    echo json_encode($output);
	}

	//==================================================
	//SUBMIT CHEQUE REQUEST FORM
	//==================================================
	public function submit_crf_ca($ca_control_no, $is_no){
		$this->form_validation->set_rules('crf_no', 'CRF No.', 'required');
		$this->form_validation->set_rules('bank', 'Bank', 'required');
		$this->form_validation->set_rules('cheque_no', 'Cheque No.', 'required');
		$this->form_validation->set_rules('cheque_date', 'Cheque Date', 'required');
		$this->form_validation->set_rules('particular', 'Particular', 'required');

		$pr_ccn = $this->Payment_request_model->getpr($ca_control_no);
		$li = $this->Payment_request_model->getli_byid($is_no);
		$pr = $this->Payment_request_model->getapproved_payment_request($ca_control_no);
		$get = $this->Payment_request_model->getremaining_balance($is_no);
		$a_paid = $this->Payment_request_model->getpaid_ca($is_no); 

		if($this->form_validation->run() == FALSE){                             
			$this->render_template('accounting/payment_request/cheque_request_form_table',$data);
		}else{
			if(!isset($_POST['submit_crf_ca'])){
				redirect('');
			}
			$name =  $this->session->userdata('firstname').' '.$this->session->userdata('lastname');
			$this->Payment_request_model->insert_crf_ca($is_no, $pr['amount'], $get['remaining_balance'], $li['total_price'], $pr['ca_control_no'],$name);

			$this->session->set_flashdata('notif','Cheque Request Form has been created successfully!');
			redirect('Accounting/Payment_request');
		}
	}

	public function submit_crf_fp($fp_control_no,$is_no){
		$this->form_validation->set_rules('crf_no', 'CRF No.', 'required');
		$this->form_validation->set_rules('bank', 'Bank', 'required');
		$this->form_validation->set_rules('cheque_no', 'Cheque No.', 'required');
		$this->form_validation->set_rules('cheque_date', 'Cheque Date', 'required');
		$this->form_validation->set_rules('particular', 'Particular', 'required');

		$li = $this->Payment_request_model->getli_byid($is_no);
		$pr = $this->Payment_request_model->getapproved_payment_request1($is_no);
		$get = $this->Payment_request_model->getremaining_balance($is_no);
		$a_paid = $this->Payment_request_model->getpaid_ca($is_no); 

		if($this->form_validation->run() == FALSE){                             
			$this->render_template('accounting/payment_request/cheque_request_form_table',$data);
		}else{
			if(!isset($_POST['submit_crf_fp'])){
				redirect('');
			}
			$name =  $this->session->userdata('firstname').' '.$this->session->userdata('lastname');
			$this->Payment_request_model->insert_crf_fp($is_no,$pr['amount'],$get['remaining_balance'], $li['total_price'],$pr['fp_control_no'],$name);

			$this->session->set_flashdata('notif','Cheque Request Form has been created successfully!');
			redirect('Accounting/Payment_request');
		}
	}
	//==================================================
	//END SUBMIT CHEQUE REQUEST FORM
	//==================================================

	//==================================================
	//CREATED
	//==================================================
	public function view_crf_ca($id){
		$this->sess_acctng();
		$data['title'] = "Cheque Request Form";
		//Sidebar Notification
		$data['accounting_payment_request'] = $this->Accounting_notification_model->payment_request_notification();
		//End

		$data['crf']= $this->Payment_request_model->getcrf_byid($id);
		
		$this->render_template('accounting/payment_request/view_cheque_request_form_ca',$data);
	}

	public function view_crf_fp($id){
		$this->sess_acctng();
		$data['title'] = "Cheque Request Form";
		$data['pr']= $this->Payment_request_model->getpr_byid1($id);
		$data['li_approved'] = $this->Payment_request_model->getli_status_approved();
		$data['crf']= $this->Payment_request_model->getcrf_byid1($id);
		$data['pt']= $this->Payment_request_model->getremaining_balance($id);
		//Sidebar Notification
		$data['accounting_payment_request'] = $this->Accounting_notification_model->payment_request_notification();
		//End

		$this->render_template('accounting/payment_request/view_cheque_request_form_fp',$data);
	}
	//==================================================
	//END CREATED
	//==================================================
}