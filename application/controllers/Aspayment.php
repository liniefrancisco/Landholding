<?php
class Aspayment extends App_Controller{
	public function __construct(){
        parent::__construct();
        $this->not_logged_in();
        $this->load->model('Aspayment_model');
        $this->load->model('Acquisition_model');
        $this->load->model('Datatable_model');
        $this->load->model('Notification_bar_model');
		$this->load->model('Notification_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
    }
    public function Notification(){
		$data = array();
		#TAB NOTIFICATION
		$data['reviewed_acq'] 			= $this->Notification_bar_model->getds_status_reviewed();
		$data['pending_payment'] 		= $this->Notification_bar_model->getpr_status_pending();
		$data['approved_payment'] 		= $this->Notification_bar_model->getpr_status_approved();
	    $data['pending_aspayment'] 		= $this->Notification_bar_model->getds_status_pending_js_es();
	    $data['approved_aspayment'] 	= $this->Notification_bar_model->getds_status_approved_js_es();
	    $data['disapproved_aspayment'] 	= $this->Notification_bar_model->getds_status_disapproved_js_es();
	    $data['paid_aspayment'] 		= $this->Notification_bar_model->getds_status_paid_js_es();
		#Message Notification
		$recepient 						=  $this->session->userdata('user_id');
		$data['all_notifications']		= $this->Notification_model->get_notif_per_user($recepient);
		$data['all_notification_no']	= $this->Notification_model->get_all_notification_no($recepient);
		return $data;
	}
    public function judicial(){
		$data['title'] 		= "Judicial Settlement Form";
		$data 				= $this->Notification();
		$data['judicial'] 	= $this->Aspayment_model->get_js_new();

		$this->form_validation->set_rules('js_no', 'LAPF-JS No.', 'required|callback_check_jsno_new');
		$this->form_validation->set_rules('date', 'Date', 'required|callback_checkDateFormat');
		$this->form_validation->set_rules('case_type', 'Case Type', 'required|in_list[Small claim case,Collection of Sum Money]');
		$this->form_validation->set_rules('business_unit', 'Business Unit', 'required|regex_match[/^[a-zA-Z -]+$/]|max_length[60]');
		$this->form_validation->set_rules('customer_fname', 'Customer Firstname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]');
		$this->form_validation->set_rules('customer_mname', 'Customer Middlename', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]');
		$this->form_validation->set_rules('customer_lname', 'Customer Lastname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]');
		$this->form_validation->set_rules('lot', 'Lot No.', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[30]');
		$this->form_validation->set_rules('cad', 'Cad No.', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[30]');
		$this->form_validation->set_rules('lot_type', 'Lot Type', 'required|in_list[Agricultural,Commercial,Residential]');
		$this->form_validation->set_rules('lot_fname', 'Lot Owner Firstname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]');
		$this->form_validation->set_rules('lot_mname', 'Lot Owner Middlename', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]');
		$this->form_validation->set_rules('lot_lname', 'Lot Owner Lastname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]');
		$this->form_validation->set_rules('gender', 'gender', 'required|in_list[Male,Female]');
		$this->form_validation->set_rules('vital_status', 'Vital Status', 'required|in_list[Alive,Deceased]');
		$this->form_validation->set_rules('lot_sold', 'Lot for bidding', 'required|in_list[Portion,Whole]');
		$this->form_validation->set_rules('lot_size', 'Lot Size', 'required|callback_check_currency');
		$this->form_validation->set_rules('available_proof', 'Proof', 'required|in_list[oct,tct]');
		if (@$_POST['available_proof'] == "oct") {
			$this->form_validation->set_rules('oct', 'OCT', 'callback_check_oct');
		} else {
			$this->form_validation->set_rules('tct', 'TCT', 'callback_check_tct');
		}
		$this->form_validation->set_rules('bid_price', 'bid price', 'required|callback_check_currency');
		$this->form_validation->set_rules('status', 'Highest Bidder', 'min_length[4]|regex_match[/^[a-zA-Z ]+$/]|max_length[90]');
		
		if ($this->form_validation->run() == FALSE) {
			$this->render_template('ccd/Aspayment/judicial_settlement_form', $data);
		} else {
			$area 		= $this->input->post('lot_size');
			$price 		= $this->input->post('bid_price');
			$lot_area 	= str_replace(',', '', $area);
			$bid_p 		= str_replace(',', '', $price);

			$is_no 		= $this->input->post('js_no');
			$tag 		= "New LAPF-JS";
			$form_type 	= "LAPF-JS";
			$user_id 	= $this->session->userdata('user_id');
			$user_name 	= $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname');

			#Running Collateral Control No. 
			$cid 			= 1;
			$lastCIDData 	= $this->Aspayment_model->getcl_id();
			if (!empty($lastCIDData)) {
				$lastCID 	= (int) substr($lastCIDData['control_no'], -2);
			} else {
				$lastCID 	= 0;
			}
			$year 			= date('Y'); // Get the current year.
			$month 			= date('m'); // Get the current month.
			$nextCID 		= $lastCID + 1;
			$cl_id 			= $year . '-CL-' . $month . str_pad($nextCID, 2, '0', STR_PAD_LEFT);
			#End

			$this->Aspayment_model->add_customer_bal($is_no);
			$this->Aspayment_model->add_customer_info($is_no);
			$this->Aspayment_model->add_customer_add($is_no);
			$this->Aspayment_model->add_land_info($is_no,$lot_area,$tag);
			$this->Aspayment_model->add_owner_info($is_no);
			$this->Aspayment_model->add_lot_location($is_no);
			$this->Aspayment_model->add_bidding_details($bid_p,$is_no);
			$this->Aspayment_model->add_tct_oct_js();
			$this->Aspayment_model->add_forms($is_no, $form_type, $user_id);
			$this->Aspayment_model->add_document_status($is_no,$user_name);
			$this->Aspayment_model->add_payment_request($is_no,$cl_id,$bid_p,$user_name);

			$this->session->set_flashdata('notif', 'Your Request has been submitted!');
			redirect('Aspayment/Aspayment_tbl');
		}
	}
	public function extrajudicial(){
		$data['title'] 	= "Extra-Judicial Settlement Form";
		$data 			= $this->Notification();
		$data['extra'] 	= $this->Aspayment_model->get_es_new();

		$this->form_validation->set_rules('es_no', 'LAPF-ES No.', 'required|callback_check_esno_new');
		$this->form_validation->set_rules('date', 'Date', 'required|callback_checkDateFormat');
		$this->form_validation->set_rules('lot', 'Lot No.', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[30]');
		$this->form_validation->set_rules('cad', 'Cad No.', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[30]');
		$this->form_validation->set_rules('lot_type', 'Lot Type', 'required|in_list[Agricultural,Commercial,Residential]');
		$this->form_validation->set_rules('lot_fname', 'Firstname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]');
		$this->form_validation->set_rules('lot_mname', 'Middlename', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]');
		$this->form_validation->set_rules('lot_lname', 'Lastname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]');
		$this->form_validation->set_rules('gender', 'gender', 'required|in_list[Male,Female]');
		$this->form_validation->set_rules('vital_status', 'Vital Status', 'required|in_list[Alive,Deceased]');
		$this->form_validation->set_rules('lot_sold', 'Lot for payment', 'required|in_list[Portion,Whole]');
		$this->form_validation->set_rules('lot_size', 'Lot Size', 'required|callback_check_currency');
		$this->form_validation->set_rules('proof_title', 'Proof', 'required|in_list[oct,tct]');
		if (@$_POST['proof_title'] == "oct") {
			$this->form_validation->set_rules('oct', 'OCT', 'callback_check_oct');
		} else {
			$this->form_validation->set_rules('tct', 'TCT', 'callback_check_tct');
		}
		$this->form_validation->set_rules('mv_tax', 'MV from Latest Tax Declaration', 'required|callback_check_currency');
		$this->form_validation->set_rules('neighbor_inq', 'Neighboring Inquiry', 'required|callback_check_currency');
		$this->form_validation->set_rules('assessor', 'Assessor', 'required|callback_check_currency');
		$this->form_validation->set_rules('banks', 'Banks', 'required|callback_check_currency');
		$this->form_validation->set_rules('final_value', 'Final Value', 'required|callback_check_currency');

		if ($this->form_validation->run() == FALSE) {
			$this->render_template('ccd/Aspayment/extrajudicial_settlement_form', $data);
		} else {
			$area 			= $this->input->post('lot_size');
			$mv 			= $this->input->post('mv_tax');
			$neighbor		= $this->input->post('neighbor_inq');
			$ass 			= $this->input->post('assessor');
			$bank 			= $this->input->post('banks');
			$final 			= $this->input->post('final_value');

			$lot_area 		= str_replace(',', '', $area);
			$mv_tax 		= str_replace(',', '', $mv);
			$neighbor_inq 	= str_replace(',', '', $neighbor);
			$assessor 		= str_replace(',', '', $ass);
			$banks 			= str_replace(',', '', $bank);
			$final_value 	= str_replace(',', '', $final);
						
			$is_no 			= $this->input->post('es_no');
			$tag 			= "New LAPF-ES";
			$form_type 		= "LAPF-ES";
			$user_id 		= $this->session->userdata('user_id');
			$user_name 		= $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname');

			#Running Collateral Control No. 
			$cid 			= 1;
			$lastCIDData 	= $this->Aspayment_model->getcl_id();
			if (!empty($lastCIDData)) {
				$lastCID 	= (int) substr($lastCIDData['control_no'], -2);
			} else {
				$lastCID 	= 0;
			}
			$year 			= date('Y'); // Get the current year.
			$month 			= date('m'); // Get the current month.
			$nextCID 		= $lastCID + 1;
			$cl_id 			= $year . '-CL-' . $month . str_pad($nextCID, 2, '0', STR_PAD_LEFT);
			#End

			$this->Aspayment_model->add_land_info($is_no,$lot_area,$tag);
			$this->Aspayment_model->add_owner_info($is_no);
			$this->Aspayment_model->add_lot_location($is_no);
			$this->Aspayment_model->add_tct_oct_es();
			$this->Aspayment_model->add_amount_basis($is_no,$mv_tax, $neighbor_inq, $assessor, $banks, $final_value);
			$this->Aspayment_model->add_es_uploads($is_no);
			$this->Aspayment_model->add_document_status($is_no,$user_name);
			$this->Aspayment_model->add_forms($is_no,$form_type,$user_id);
			$this->Aspayment_model->add_payment_request($is_no,$cl_id,$final_value,$user_name);

			$this->session->set_flashdata('notif', 'Proceed to the next form!');
			redirect('Aspayment/extrajudicial_customer_info/'.$is_no);
		}
	}
	public function extrajudicial_customer_info($is_no){
		$data['title'] 	= "Extra-Judicial Settlement Form"; 
		$data 			= $this->Notification();
		$data['es_no'] 	= $is_no;

		$this->form_validation->set_rules('balance_type', 'Balance Type', 'required|in_list[Bounced Check,Bad Account]');
		$this->form_validation->set_rules('business_unit', 'Business Unit', 'required|regex_match[/^[a-zA-Z -]+$/]|max_length[60]');
		$this->form_validation->set_rules('customer_fname', 'Firstname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]');
		$this->form_validation->set_rules('customer_mname', 'Middlename', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]');
		$this->form_validation->set_rules('customer_lname', 'Lastname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]');
		$this->form_validation->set_rules('doubtful_account', 'Turnover of doubtful account form', 'callback_check_doubtful_account');
		$this->form_validation->set_rules('latest_soa', 'Latest SOA', 'callback_check_latest_soa');
		$this->form_validation->set_rules('supporting_docs', 'Supporting Documents ', 'callback_check_supporting_docs');
		if ($this->form_validation->run() == FALSE) {
			$this->render_template('ccd/Aspayment/extrajudicial_customer_form', $data);
		} else {
			$this->Aspayment_model->add_customer_bal1($is_no);
			$this->Aspayment_model->add_customer_info($is_no);
			$this->Aspayment_model->add_customer_add($is_no);
			$this->Aspayment_model->update_es_uploads($is_no);

			$this->session->set_flashdata('notif', 'Your Request has been submitted!');
			redirect('Aspayment/Aspayment_tbl');
		}
	}
	public function Aspayment_tbl(){
		$data['title'] 		= "Land As Payment";
		$data 				= $this->Notification();
		$status 			= ['Disapproved'];
		$data['reason'] 	= $this->Acquisition_model->getds_reason($status);
		$this->render_template('ccd/Aspayment/table',$data);
	}
	public function Aspayment_datatable(){
	    $data 		= array();
	    $status 	= $this->input->post('status');
	    $all_info 	= $this->Datatable_model->get_row($_POST);
	    foreach($all_info as $ai){
	        if($ai->tag == "New LAPF-JS" || $ai->tag == "New LAPF-ES"){
	            $lot_owner 			= $ai->firstname . " " . substr(($ai->middlename), 0, 1) . ". " . $ai->lastname;
	            $lot_location 		= $ai->street . "- " . $ai->baranggay . ", " . $ai->municipality . ", " . $ai->province;
	            $submission_date 	= $ai->submission_date ? date_format(date_create($ai->submission_date), "F d, Y") : '';
	            $approval_date 		= $ai->approval_date ? date_format(date_create($ai->approval_date), "F d, Y") : '';
	            $disapproval_date 	= $ai->disapproval_date ? date_format(date_create($ai->disapproval_date), "F d, Y") : '';
	            if ($ai->tag == "New LAPF-JS") {
	            	$reason 		= '<a data-toggle="modal" data-target=".reason_disapproved_'.$ai->is_no.'" data-backdrop="static" data-keyboard="false"><i class="fa fa-eye"></i> View Reason</a>';
		            $action 		='<center>
										<a 	href=" '.base_url('Aspayment/judicial_settlement_form/'.$ai->is_no).' " 
											class="btn btn-xs btn-primary"
											style="border-radius:10px; border-color:#fff;font-size:9px">
											<span class="fa fa-eye"></span> View
										</a>
		 							</center>';
	            } elseif ($ai->tag == "New LAPF-ES") {
	            	$reason 		= '<a data-toggle="modal" data-target=".reason_disapproved_'.$ai->is_no.'" data-backdrop="static" data-keyboard="false"><i class="fa fa-eye"></i> View Reason</a>';
	                $action 		='<center>
										<a 	href=" '.base_url('Aspayment/extrajudicial_settlement_form/'.$ai->is_no).' " 
											class="btn btn-primary btn-xs" 
											style="border-radius:10px; border-color:#fff;font-size:9px">
											<span class="fa fa-eye"></span> View
										</a>
		 							</center>';
	            }
	            $row = array($ai->is_no,$lot_owner,$ai->lot_type,$lot_location,$submission_date);
	            if ($status === 'Approved') {
	                $row[] = $approval_date;
	                $row[] = $ai->approved_by;
	            }else if($status === 'Disapproved'){
	            	$row[] = $disapproval_date;
	                $row[] = $ai->disapproved_by;
	                $row[] = $reason;
	            }
	            $row[] 	= $action;
	            $data[] = $row;
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
	public function judicial_settlement_form($is_no){
		// check if the uri id is valid==========
		$li = $this->Acquisition_model->getli_byid($is_no);
		if(empty($is_no)){
			redirect('');
		}elseif($is_no[0].$is_no[1].$is_no[2] !== "JS-"){
			redirect('');
		}elseif( $li['tag'] !== "New LAPF-JS"){
			redirect('');
		}
		// check if the uri id is valid==========	
		$data['title'] 	= "Judicial Settlement (LAPF-JS)";
		$data 			= $this->Notification();
		$data['li']		= $this->Acquisition_model->getli_byid($is_no);
		$data['oi']		= $this->Acquisition_model->getoi_byid($is_no);
		$data['ll']		= $this->Acquisition_model->getll_byid($is_no);
		$data['ud']		= $this->Acquisition_model->getud_byid($is_no);
		$data['ci'] 	= $this->Acquisition_model->getci_byid($is_no);
		$data['cbi'] 	= $this->Acquisition_model->getcbi_byid($is_no);
		$data['ca'] 	= $this->Acquisition_model->getca_byid($is_no);
		$data['bd'] 	= $this->Acquisition_model->getbidding_byid($is_no);
		$data['ds']		= $this->Acquisition_model->getds_byid($is_no);
		$status 		= ['Disapproved'];
		$data['reason'] = $this->Acquisition_model->getds_reason($status);

		$this->render_template('ccd/Aspayment/view_js',$data);        
	}
  	public function submit_approved($is_no){
	    $this->sess_gm();
	    $status = 'Approved';
	    $this->Aspayment_model->update_ds_approved($is_no, $status); 
	    $this->Aspayment_model->update_pr_approved($is_no, $status);      
  	}
  	public function submit_disapproved_request($is_no){
	    $this->sess_gm();
	    $status = 'Disapproved';
	    $message = $this->input->post('disapproved_message');
	    $this->Aspayment_model->update_ds_disapproved($status,$message,$is_no);  
	    $this->Aspayment_model->update_pr_disapproved($status,$is_no);           
  	}
  	public function pop_up_notification($status){
	    $this->session->set_flashdata('notif','Request '. $status .' Successfully!');
	    redirect('Aspayment/Aspayment_tbl');
  	}	
	public function extrajudicial_settlement_form($is_no){
		// check if the uri id is valid==========
		$li = $this->Acquisition_model->getli_byid($is_no);
		if(empty($is_no)){
			redirect('');
		}elseif($is_no[0].$is_no[1].$is_no[2] !== "ES-"){
			redirect('');
		}elseif( $li['tag'] !== "New LAPF-ES"){
			redirect('');
		}
		// check if the uri id is valid==========
					
		$data['title'] 	= "Extra judicial Settlement (LAPF-ES)";
		$data 			= $this->Notification();
		$data['li']		= $this->Acquisition_model->getli_byid($is_no);
		$data['oi']		= $this->Acquisition_model->getoi_byid($is_no);
		$data['ll']		= $this->Acquisition_model->getll_byid($is_no);
		$data['ud']		= $this->Acquisition_model->getud_byid($is_no);
		$data['ab'] 	= $this->Acquisition_model->getab_byid($is_no);
		$data['cbi'] 	= $this->Acquisition_model->getcbi_byid($is_no);
		$data['ci'] 	= $this->Acquisition_model->getci_byid($is_no);
		$data['ca'] 	= $this->Acquisition_model->getca_byid($is_no);
		$data['eu'] 	= $this->Acquisition_model->getesupload_byid($is_no);
		$data['ds']		= $this->Acquisition_model->getds_byid($is_no);
		$status 		= ['Disapproved'];
		$data['reason'] = $this->Acquisition_model->getds_reason($status);

		$this->render_template('ccd/Aspayment/view_es',$data);        
	}
	#ADDRESS
	public function getregion(){
		$result = $this->Aspayment_model->get_region();
		$output = [];
		$i 		= 0;
		foreach ($result as $value) {
			$output[$i]['regDesc'] = $value->regDesc;
			$output[$i]['regCode'] = $value->regCode;
			$i++;
		}
		echo json_encode($output);
	}
	public function getprovince(){
		$regCode 	= $_POST['regCode'];
		$result 	= $this->Aspayment_model->get_province($regCode);
		$output 	= [];
		$i 			= 0;
		foreach ($result as $value) {
			$output[$i]['provDesc'] = $value->provDesc;
			$output[$i]['provCode'] = $value->provCode;
			$i++;
		}
		echo json_encode($output);
	}
	public function getcitymun(){
		$provCode 	= $_POST['provCode'];
		$result 	= $this->Aspayment_model->get_municipality($provCode);
		$output 	= [];
		$i 			= 0;
		foreach ($result as $value) {
			$output[$i]['citymunDesc'] 	= $value->citymunDesc;
			$output[$i]['citymunCode'] 	= $value->citymunCode;
			$output[$i]['zipcode'] 		= $value->zipcode;
			$i++;
		}
		echo json_encode($output);
	}
	public function getbrgy(){
		$citymunCode 	= $_POST['citymunCode'];
		$result 		= $this->Aspayment_model->get_barangay($citymunCode);
		$output 		= [];
		$i 				= 0;
		foreach ($result as $value) {
			$output[$i]['brgyDesc'] = $value->brgyDesc;
			$output[$i]['brgyCode'] = $value->brgyCode;
			$i++;
		}
		echo json_encode($output);
	}
	#VALIDATION
	public function check_jsno_new($str){
		$row 	= $this->Acquisition_model->getforms_byid($str);
		$format = substr($str, 0, 3);
		if ($format == "JS-") {
			$land_id = $this->Aspayment_model->get_js_new();
			foreach ($land_id as $li) {
				$is_id = substr($li['is_no'], 3) + 1;
			}
			$is_input = substr($str, 3); //from form
			if (empty($is_id)) {
				$is_id = 1; //means 1 by default
			}
			if (!ctype_digit($is_input)) { //check if transaction number is not alpa contain
				$this->form_validation->set_message('check_jsno_new', '' . $str . ' is not a valid transaction no.');
				return FALSE;
			}
			if ($is_id < $is_input) {
				$this->form_validation->set_message('check_jsno_new', '' . $str . ' is greater than the current transaction no.');
				return FALSE;
			} else {
				if ($is_id > $is_input) {
					$this->form_validation->set_message('check_jsno_new', '' . $str . ' is not valid.');
					return FALSE;
				}
				if (substr($row['form_no'], 3) == $is_input) { // the same with the form submitted
					$this->form_validation->set_message('check_jsno_new', 'The {field} cant be duplicated');
					return FALSE;
				} else {
					return TRUE;
				}
			}
		} else {
			$this->form_validation->set_message('check_jsno_new', ' ' . $str . ' is not a valid transaction no.');
			return FALSE;
		}
	}
	public function check_esno_new($str){
		@$format = substr($str, 0, 3);
		if ($format == "ES-") {
			$row 		= $this->Acquisition_model->getforms_byid($str);
			$land_id 	= $this->Aspayment_model->get_es_new();
			$is_input 	= substr($str, 3); //user input or default from form

			foreach ($land_id as $li) {
				$is_id = substr($li['is_no'], 3) + 1; //current trans. no.
			}
			if (empty($is_id)) {
				$is_id = 1; //1 by default
			}

			if (!ctype_digit($is_input)) { //check if transaction number is not alpa contain
				$this->form_validation->set_message('check_esno_new', '' . $str . ' is not a valid transaction no.');
				return FALSE;
			} elseif ($is_id < $is_input) {
				$this->form_validation->set_message('check_esno_new', '' . $str . ' is greater than the current transaction no.');
				return FALSE;
			} elseif ($is_id > $is_input) {
				$this->form_validation->set_message('check_esno_new', '' . $str . ' is not valid.');
				return FALSE;
			} elseif (substr($row['form_no'], 3) == $is_input) { // the same with the form submitted
				$this->form_validation->set_message('check_esno_new', 'The {field} cant be duplicated');
				return FALSE;
			} else {
				return TRUE;
			}
		} else {
			$this->form_validation->set_message('check_esno_new', ' ' . $str . ' is not a valid transaction no.');
			return FALSE;
		}
	}
	public function checkDateFormat($date) {
        $dt = date_create_from_format('m/d/Y', $date);
        
        if (!$dt) {
            $this->form_validation->set_message('checkDateFormat', '' . $date . ' is not a valid date format.');
            return FALSE;
        } else {
            $conv_date = $dt->format('Y-m-d');
            if (date('Y-m-d') < $conv_date) {
                $this->form_validation->set_message('checkDateFormat', '' . $date . ' cannot be a future date.');
                return FALSE;
            }
            return TRUE;
        }
    }
    public function check_currency($inp){
		$amount = str_replace(',', '', $inp);
		if (!preg_match('/^\d+(\.\d{2})?$/', $amount)) {
			$this->form_validation->set_message('check_currency', '{field} is invalid.');
			return FALSE;
		} else {
			if ($amount == 0.00) {
				$this->form_validation->set_message('check_currency', '{field} cannot be zero value.');
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}
	public function check_oct(){
		$file = $_FILES["oct"]['name'];

		if (empty($file)) {
			$this->form_validation->set_message('check_oct', 'The %s file is required!');
			return FALSE;
		} else {
			$allowed 	= array('gif', 'png', 'jpg', 'jpeg');
			$filename 	= $file;
			$ext 		= pathinfo($filename, PATHINFO_EXTENSION);
			if (strlen($filename) > 200) {
				$this->form_validation->set_message('check_oct', 'rename your %s file, it exceeds the maximum no. of string which is 200');
				return FALSE;
			} elseif (!in_array(strtolower($ext), $allowed)) { //not in array
				$this->form_validation->set_message('check_oct', 'your %s file is not a valid file format');
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}
	public function check_tct(){
		$file = $_FILES["tct"]['name'];
		if (empty($file)) {
			$this->form_validation->set_message('check_tct', 'The %s file is required!');
			return FALSE;
		} else {
			$allowed 	= array('gif', 'png', 'jpg', 'jpeg');
			$filename 	= $file;
			$ext 		= pathinfo($filename, PATHINFO_EXTENSION);

			if (strlen($filename) > 200) {
				$this->form_validation->set_message('check_tct', 'rename your %s file, it exceeds the maximum no. of string which is 200');
				return FALSE;
			} elseif (!in_array(strtolower($ext), $allowed)) { //not in array
				$this->form_validation->set_message('check_tct', 'your %s file is not a valid file format');
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}
	public function check_doubtful_account(){
		$file = $_FILES["doubtful_account"]['name'];
		if (empty($file)) {
			$this->form_validation->set_message('check_doubtful_account', 'The %s file is required!');
			return FALSE;
		} else {
			$allowed 	= array('gif', 'png', 'jpg', 'jpeg');
			$filename 	= $file;
			$ext 		= pathinfo($filename, PATHINFO_EXTENSION);
			if (strlen($filename) > 200) {
				$this->form_validation->set_message('check_doubtful_account', 'rename your %s file, it exceeds the maximum no. of string which is 200');
				return FALSE;
			} elseif (!in_array(strtolower($ext), $allowed)) { //not in array
				$this->form_validation->set_message('check_doubtful_account', 'your %s file is not a valid file format');
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}
	public function check_latest_soa(){
		$file = $_FILES["latest_soa"]['name'];
		if (empty($file)) {
			$this->form_validation->set_message('check_latest_soa', 'The %s file is required!');
			return FALSE;
		} else {
			$allowed 	= array('gif', 'png', 'jpg', 'jpeg');
			$filename 	= $file;
			$ext 		= pathinfo($filename, PATHINFO_EXTENSION);
			if (strlen($filename) > 200) {
				$this->form_validation->set_message('check_latest_soa', 'rename your %s file, it exceeds the maximum no. of string which is 200');
				return FALSE;
			} elseif (!in_array(strtolower($ext), $allowed)) { //not in array
				$this->form_validation->set_message('check_latest_soa', 'your %s file is not a valid file format');
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}
	public function check_supporting_docs(){
		$file = $_FILES["supporting_docs"]['name'];
		if (empty($file)) {
			$this->form_validation->set_message('check_supporting_docs', 'The %s file is required!');
			return FALSE;
		} else {
			$allowed 	= array('gif', 'png', 'jpg', 'jpeg');
			$filename 	= $file;
			$ext 		= pathinfo($filename, PATHINFO_EXTENSION);
			if (strlen($filename) > 200) {
				$this->form_validation->set_message('check_supporting_docs', 'rename your %s file, it exceeds the maximum no. of string which is 200');
				return FALSE;
			} elseif (!in_array(strtolower($ext), $allowed)) { //not in array
				$this->form_validation->set_message('check_supporting_docs', 'your %s file is not a valid file format');
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}
	#END
}