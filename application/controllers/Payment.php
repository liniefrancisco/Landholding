<?php
class Payment extends App_Controller{
	public function __construct(){
		parent::__construct();
		$this->not_logged_in();
		// Load the model
		$this->load->model('Datatable_model');
		$this->load->model('Payment_model');
		$this->load->model('Acquisition_model');
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
	    $data['paid_payment'] 			= $this->Notification_bar_model->getpr_status_paid();
	    $data['disapproved_payment'] 	= $this->Notification_bar_model->getpr_status_disapproved();
		#Message Notification
		$recepient 						=  $this->session->userdata('user_id');
		$data['all_notifications']		= $this->Notification_model->get_notif_per_user($recepient);
		$data['all_notification_no']	= $this->Notification_model->get_all_notification_no($recepient);
		return $data;
	}
	public function index(){
		$this->sess_secretary();
		$data['title'] 	= "In Progress";
		$data 			= $this->Notification();

		$this->render_template('secretary/Progress/table',$data);
	}
	public function payment_datatable(){
		$data  		= array();
		$all_info 	= $this->Datatable_model->get_row($_POST);
			
		foreach($all_info as $ai){
			$a_paid 		= $this->Payment_model->getpt_TotalPaidAmount($ai->is_no);
			$total_price 	= $ai->total_price ?? 0; 
			$percent 		= 0;
			if ($total_price > 0) {
			    $p 			= ($a_paid / $total_price) * 100;
			    $percent 	= (float) number_format($p, 2);
			}

			if($ai->tag == "New"){
				$owner_info 	= 	$ai->firstname." ".substr(($ai->middlename),0,1).". ".$ai->lastname;
				$address 		= 	$ai->street."- ".$ai->baranggay.", ".$ai->municipality.", ".$ai->province;
				$approval_date 	= 	$ai->approval_date ? date_format(date_create($ai->approval_date), "F d, Y") : 'N/A';

				$action 		=	'<center>
										<a type="a" href=" '.base_url('Payment/view_inprogress/'.$ai->is_no).' " class="btn btn-primary btn-xs" style="border-radius: 10px;background:linear-gradient(to top, rgb(9, 32, 63) 0%, rgb(83, 120, 149) 100%); border-color:#fff;" title="View"><span class="fa fa-eye"></span> View</a>
									</center>';
				if($percent == 100){
					$bar 	= 	"<div class='progress' style='border: 1px solid #E6E9ED;'>
									<div class='progress-bar progress-bar-success progress-bar-striped active' data-transitiongoal='$percent' aria-valuenow='$percent' style='width: $percent%;'>$percent%</div>
								</div>";
				}elseif ($percent >= 51) {
					$bar 	= 	"<div class='progress' style='border: 1px solid #E6E9ED;'>
									<div class='progress-bar progress-bar-warning progress-bar-striped active' data-transitiongoal='$percent' aria-valuenow='$percent' style='width: $percent%;'>$percent%</div>
								</div>";
				}elseif ($percent <= 50) {
					$bar 	= 	"<div class='progress' style='border: 1px solid #E6E9ED;'>
									<div class='progress-bar progress-bar-danger progress-bar-striped active' data-transitiongoal='$percent' aria-valuenow='$percent' style='width: $percent%;'>$percent%</div>
								</div>";
				
				}
				$data[] 		= 	array($ai->is_no, $owner_info,$address,$approval_date,$bar, $action);
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
	public function view_inprogress($is_no){
		$data 			= $this->Notification(); 
		// check if the uri id is valid==========
		$li 			= $this->Acquisition_model->getli_byid($is_no);
		$ds 			= $this->Acquisition_model->getds_byid($is_no);
		if(empty($is_no) || $ds['status'] !== "Approved" || $li['tag'] !== "New"){
			redirect('Secretary/Progress');
		}
		// check if the uri id is valid==========
		
		#Running CA Control No. 
		$cid 			= 1;
		$lastCIDData 	= $this->Payment_model->getca_id();
		if (!empty($lastCIDData)) {
			$lastCID 	= (int) substr($lastCIDData['control_no'], -2);
		} else {
			$lastCID 	= 0;
		}
		$year 			= date('Y'); // Get the current year.
		$month 			= date('m'); // Get the current month.
		$nextCID 		= $lastCID + 1;
		$ca_id 			= $year . '-CA-' . $month . str_pad($nextCID, 2, '0', STR_PAD_LEFT);
		$data['ca_id'] 	= $ca_id;
		#Running FP Control No. 
		$cid 			= 1;
		$lastCIDData1 	= $this->Payment_model->getfp_id();
		if (!empty($lastCIDData1)) {
			$lastCID 	= (int) substr($lastCIDData1['control_no'], -2);
		}else{
			$lastCID 	= 0;
		}
		$year 			= date('Y'); // Get the current year.
		$month 			= date('m'); // Get the current month.
		$nextCID 		= $lastCID + 1;
		$fp_id 			= $year . '-FP-' . $month . str_pad($nextCID, 2, '0', STR_PAD_LEFT);
		$data['ref_no'] = $fp_id;
		//Running AR No.
		$cid 			= 1;
		$cd 			=  $this->Payment_model->getca_id();                  
		$customid3 		= 'AR-'.date('ym').$cid;
		$data['nf_no'] 	=  $customid3;
		//data for interview sheet
		$data['is_no'] 	= $is_no;
		$data['li']		= $this->Acquisition_model->getli_byid($is_no);
		$li 			= $this->Acquisition_model->getli_byid($is_no);
		$data['oi']		= $this->Acquisition_model->getoi_byid($is_no);
		$oi 			= $this->Acquisition_model->getoi_byid($is_no);
		$data['ll']		= $this->Acquisition_model->getll_byid($is_no);
		$data['ud']		= $this->Acquisition_model->getud_byid($is_no);
		$data['cp']		= $this->Acquisition_model->getcp_byid($oi['id']);
		$data['rstr']	= $this->Acquisition_model->getrstr_byid($is_no);
		#Full Payment
		$data['bi']						= $this->Acquisition_model->getbi_byid($is_no);
		// $data['pr_status'] 		= $this->Payment_model->check_pr_status($is_no);
		$data['fp_info'] 				= $this->Payment_model->getpr_byid_byfp_result($is_no);
		$data['getpr_byid_byfp_row'] 	= $this->Payment_model->getpr_byid_byfp_row($is_no);
		$data['remaining_balance'] 		= $this->Payment_model->getLatestRemainingBalance($is_no);
		// $data['ar'] 			= $this->Payment_model->get_acknowledgement_receipt_content($is_no);
		$existing_data 			= $this->Payment_model->getpr_checkfp($is_no);
		#CA & SOP
		$data['getpr_byid_byca_result'] = $this->Payment_model->getpr_byid_byca_result($is_no);
		$data['getpt_byid_result'] 		= $this->Payment_model->getpt_byid_result($is_no);
		$data['getpr_byid_result'] 		= $this->Payment_model->getpr_byid_result($is_no);
		//end

		

		if(isset($_POST['submit_ca'])){//REQUEST CASH ADVANCE
			$this->form_validation->set_rules('control_no', 'CA Control No.', 'required');
			$this->form_validation->set_rules('amount', 'Amount', 'required|callback_check_currency');
			$this->form_validation->set_rules('other_purp', 'purpose', "regex_match[/^[a-zA-Z0-9 .,'-]+$/]|max_length[200]");
			$this->form_validation->set_rules('purpose[]', 'purpose', 'trim|in_list[Personal,Affidavit of Surrender of Landholdings,Capital Gains Tax,Estate Tax,Notary Fee,Real Property Tax,Documentary Stamp Tax]');
			if(empty($_POST['purpose']) || ctype_space($_POST['other_purp'])){
				$this->form_validation->set_rules('purpose', 'purpose', 'required');
			}
		}elseif(isset($_POST['submit_ar'])){//ACKNOWLEDGEMENT RECEIPT
			$this->form_validation->set_rules('receipt_file', 'Receipt File', 'required');
		}elseif(isset($_POST['submit_cop'])){//COMPUTATION OF PAYMENT
			$this->form_validation->set_rules('is_no', 'IS NO.', 'required');
		}elseif(isset($_POST['submit_nf'])){//NOTARIAL FEE
			$this->form_validation->set_rules('notarial_fee', 'Notarial Fee Amount', 'required|callback_check_currency');
		}elseif(isset($_POST['submit_ac'])){//AGENT COMMISSION
			$this->form_validation->set_rules('commission_fee', 'Commission Fee', 'required|callback_check_currency');
		}elseif(isset($_POST['submit_lpf'])){//LOT PURCHASE FORM
			$this->form_validation->set_rules('is_no', 'IS NO.', 'required');
		}
		if($this->form_validation->run() == FALSE){
			$this->render_template('secretary/Progress/inprogress_view',$data);
		}else{
			if(isset($_POST['submit_ca'])){//REQUEST CASH ADVANCE
				$amount     	= str_replace(',', '', $this->input->post('amount'));
				$form_type 		= "CA";
				$user_id 		=  $this->session->userdata('user_id');
				$user_name 		=  $this->session->userdata('firstname').' '.$this->session->userdata('lastname');

	            $this->Payment_model->insert_ca($amount, $ca_id, $user_name);
	            $this->Payment_model->insert_form($ca_id, $form_type, $user_id);
	            $this->session->set_flashdata('success', 'Request for Cash Advance successfully sent!');
				redirect('Payment/view_inprogress/'.$is_no);
			}elseif(isset($_POST['submit_lpf'])){//LOT PURCHASE FORM
				$transaction 	= $this->db->get_where('payment_transaction', array('is_no' => $is_no));
				$count 			= $transaction->num_rows();
				$bal 			= $this->Payment_model->getLatestRemainingBalance($is_no);
				$form_type 		= "FP";
				$user_id 		= $this->session->userdata('user_id');
				$purpose 		= $this->input->post('purpose');

				if ($existing_data) {
					$this->Payment_model->update_lpf($is_no,$purpose);
					$this->session->set_flashdata('success', 'Updated successfully!');
				}else{
					if ($count > 0) {
						$this->Payment_model->insert_lpf($is_no,$fp_id,$bal['remaining_balance'],$purpose);
						$this->Payment_model->insert_form($fp_id, $form_type, $user_id);
					}else{
						$this->Payment_model->insert_lpf($is_no,$fp_id,$li['total_price'],$purpose);
						$this->Payment_model->insert_form($fp_id, $form_type, $user_id);
					}
					$this->session->set_flashdata('success', 'Successfully submitted!');
				}
				redirect('Payment/view_inprogress/'.$is_no);
			}elseif(isset($_POST['submit_cop'])){//COMPUTATION OF PAYMENT
				$transaction 	= $this->db->get_where('payment_transaction', array('is_no' => $is_no));
				$count 			= $transaction->num_rows();
				$bal 			= $this->Payment_model->getLatestRemainingBalance($is_no);
				$form_type 		= "FP";
				$user_id 		= $this->session->userdata('user_id');

				if ($existing_data) {
					$this->Payment_model->update_cop($is_no);
					$this->session->set_flashdata('success', 'Updated successfully!');
				}else{
					if ($count > 0) { // Check the count directly
						$this->Payment_model->insert_cop($is_no,$fp_id,$bal['remaining_balance']);
						$this->Payment_model->insert_form($fp_id, $form_type, $user_id);
					}else{
						$this->Payment_model->insert_cop($is_no,$fp_id,$li['total_price']);
						$this->Payment_model->insert_form($fp_id, $form_type, $user_id);
					}
					$this->session->set_flashdata('success', 'Successfully submitted!');
				}
				redirect('Payment/view_inprogress/'.$is_no);
			}elseif(isset($_POST['submit_nf'])){//NOTARIAL FEE
				$transaction 	= $this->db->get_where('payment_transaction', array('is_no' => $is_no));
				$count 			= $transaction->num_rows();
				$bal 			= $this->Payment_model->getLatestRemainingBalance($is_no);
				$nf 			= $this->input->post('notarial_fee');
				$notarial_fee 	= str_replace(',', '', $nf);
				$form_type 		= "FP";
				$user_id 		=  $this->session->userdata('user_id');

				if ($existing_data) {
					$this->Payment_model->update_nf($is_no,$notarial_fee);
					$this->session->set_flashdata('success', 'Updated successfully!');
				}else{
					if ($count > 0) { // Check the count directly
						$this->Payment_model->insert_nf($is_no,$fp_id,$notarial_fee,$bal['remaining_balance']);
						$this->Payment_model->insert_form($fp_id, $form_type, $user_id);
					}else{
						$this->Payment_model->insert_nf($is_no,$fp_id,$notarial_fee,$li['total_price']);
						$this->Payment_model->insert_form($fp_id, $form_type, $user_id);
					}
					$this->session->set_flashdata('success', 'Successfully submitted!');
				}
				redirect('Payment/view_inprogress/'.$is_no);
			}elseif(isset($_POST['submit_ac'])){//AGENT COMMISSION
				$transaction 	= $this->db->get_where('payment_transaction', array('is_no' => $is_no));
				$count 			= $transaction->num_rows();
				$bal 			= $this->Payment_model->getLatestRemainingBalance($is_no);
				$cf 			= $this->input->post('commission_fee');
				$commission_fee = str_replace(',', '', $cf);
				$form_type 		= "FP";
				$user_id 		=  $this->session->userdata('user_id');

				if ($existing_data) {
					$this->Payment_model->update_ac($is_no,$commission_fee);
					$this->session->set_flashdata('success', 'Updated successfully!');
				}else{
					if ($count > 0) { // Check the count directly
						$this->Payment_model->insert_ac($is_no,$fp_id,$commission_fee,$bal['remaining_balance']);
						$this->Payment_model->insert_form($fp_id, $form_type, $user_id);
					}else{
						$this->Payment_model->insert_ac($is_no,$fp_id,$commission_fee,$li['total_price']);
						$this->Payment_model->insert_form($fp_id, $form_type, $user_id);
					}
					$this->session->set_flashdata('success', 'Successfully submitted!');
				}
				redirect('Payment/view_inprogress/'.$is_no);
			}elseif(isset($_POST['submit_ar'])){//ACKNOWLEDGEMENT RECEIPT
				$transaction 	= $this->db->get_where('payment_transaction', array('is_no' => $is_no));
				$count 			= $transaction->num_rows();
				$bal 			= $this->Payment_model->getLatestRemainingBalance($is_no);
				$form_type 		= "FP";
				$user_id 		=  $this->session->userdata('user_id');

				if ($existing_data) {
					$this->Payment_model->update_ar($is_no);
					$this->session->set_flashdata('success', 'Updated successfully!');
				}else{
					if ($count > 0) { // Check the count directly
						$this->Payment_model->insert_ar($is_no,$fp_id,$bal['remaining_balance']);
						$this->Payment_model->insert_form($fp_id, $form_type, $user_id);
					}else{
						$this->Payment_model->insert_ar($is_no,$fp_id,$li['total_price']);
						$this->Payment_model->insert_form($fp_id, $form_type, $user_id);
					}
					$this->session->set_flashdata('success', 'Successfully submitted!');
				}
				redirect('Payment/view_inprogress/'.$is_no);
			}
		}               
	}
	public function upload_owner_documents($is_no){
		$this->sess_secretary();

		$data['title'] 	= "Upload Documents";
		$data 			= $this->Notification();
		$data['is_no'] 	= $is_no;
		$data['ud']		= $this->Acquisition_model->getud_byid($is_no);
		$ud 			= $this->Acquisition_model->getud_byid($is_no);
		$data['li']		= $this->Acquisition_model->getli_byid($is_no);
		$data['oi']		= $this->Acquisition_model->getoi_byid($is_no);

		if(isset($_POST['up_lt_btn'])){ //Land Title
			$prev_land_title_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Land Title/' . $ud['land_title'];
			if (!empty($ud['land_title']) && file_exists($prev_land_title_path)) {
				$this->delete_prev_file($prev_land_title_path);
			}
			$this->Acquisition_model->update_lt($is_no);
			$this->Acquisition_model->insert_title_number($is_no);
		 	echo $this->session->set_flashdata('notif', 'Land Title file successfully uploaded!');
			redirect('Payment/view_inprogress/'. $is_no);
		}elseif(isset($_POST['up_tct_btn'])){ //TCT
			$prev_tct_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/TCT/' . $ud['tct'];
			if (!empty($ud['tct']) && file_exists($prev_tct_path)) {
				$this->delete_prev_file($prev_tct_path);
			}
			$this->Acquisition_model->update_tct($is_no);
			$this->session->set_flashdata('notif','TCT file successfully uploaded!');
			redirect('Payment/view_inprogress/'. $is_no);
		}elseif(isset($_POST['up_dos_btn'])){ //Deed of Sale
			$prev_dos_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Previous Deed Of Sale/' . $ud['previous_deed_of_sale'];
			if (!empty($ud['previous_deed_of_sale']) && file_exists($prev_dos_path)) {
				$this->delete_prev_file($prev_dos_path);
			}
			$this->Acquisition_model->update_dos($is_no);
			$this->session->set_flashdata('notif','Deed of Sale file successfully uploaded!');
			redirect('Payment/view_inprogress/'. $is_no);
		}elseif(isset($_POST['up_ecar_btn'])){ //E-CAR
			$prev_ecar_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/eCAR/' . $ud['e_car'];
			if (!empty($ud['e_car']) && file_exists($prev_ecar_path)) {
				$this->delete_prev_file($prev_ecar_path);
			}
			$this->Acquisition_model->update_ecar($is_no);
			$this->session->set_flashdata('notif','E-CAR file successfully uploaded!');
			redirect('Payment/view_inprogress/'. $is_no);
		}elseif(isset($_POST['up_td_btn'])){ //Tax Declaration
			$prev_tax_dec_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Tax Declaration/' . $ud['latest_tax_dec'];
			if (!empty($ud['latest_tax_dec']) && file_exists($prev_tax_dec_path)) {
				$this->delete_prev_file($prev_tax_dec_path);
			}
			$this->Acquisition_model->update_tax_declaration($is_no);
			$this->Acquisition_model->insert_tax_number($is_no);
			$this->session->set_flashdata('notif','Tax Declaration file successfully uploaded!');
			redirect('Payment/view_inprogress/'. $is_no);
		}elseif(isset($_POST['up_tc_btn'])){ //Tax Clearance
			$prev_tc_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Tax Clearance/' . $ud['tax_clearance'];
			if (!empty($ud['tax_clearance']) && file_exists($prev_tc_path)) {
				$this->delete_prev_file($prev_tc_path);
			}
			$this->Acquisition_model->update_tax_clearance($is_no);
			$this->session->set_flashdata('notif','Tax Clearance file successfully uploaded!');
			redirect('Payment/view_inprogress/'. $is_no);
		}elseif(isset($_POST['up_ls_btn'])){ //Sketch Plan
			$prev_sketch_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Land Sketch/' . $ud['land_sketch'];
			if (!empty($ud['land_sketch']) && file_exists($prev_sketch_path)) {
				$this->delete_prev_file($prev_sketch_path);
			}
			$this->Acquisition_model->update_land_sketch($is_no);
			$this->session->set_flashdata('notif','Sketch Plan file successfully uploaded!');
			redirect('Payment/view_inprogress/'. $is_no);
		}elseif(isset($_POST['up_vm_btn'])){ //vicinity map
			$prev_vicinity_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Vicinity Map/' . $ud['vicinity_map'];
			if (!empty($ud['vicinity_map']) && file_exists($prev_vicinity_path)) {
				$this->delete_prev_file($prev_vicinity_path);
			}
			$this->Acquisition_model->update_vicinity_map($is_no);
			$this->session->set_flashdata('notif','Vicinity Map file successfully uploaded!');
			redirect('Payment/view_inprogress/'. $is_no);
		}elseif(isset($_POST['up_cni_btn'])){ //Certificate of no improvement
			$prev_coni_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Certificate of No Improvement/' . $ud['cert_no_improvement'];
			if (!empty($ud['cert_no_improvement']) && file_exists($prev_coni_path)) {
				$this->delete_prev_file($prev_coni_path);
			}
			$this->Acquisition_model->update_certificate($is_no);
			$this->session->set_flashdata('notif','Certificate of No Improvement file successfully uploaded!');
			redirect('Payment/view_inprogress/'. $is_no);
		}elseif(isset($_POST['up_ret_btn'])){ //Real Estate Tax
			$prev_ret_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Real Estate Tax/' . $ud['real_estate_tax'];
			if (!empty($ud['real_estate_tax']) && file_exists($prev_ret_path)) {
				$this->delete_prev_file($prev_ret_path);
			}
			$this->Acquisition_model->update_real_estate_tax($is_no);
			$this->session->set_flashdata('notif','Real Estate Tax file successfully uploaded!');
			redirect('Payment/view_inprogress/'. $is_no);
		}elseif(isset($_POST['up_mc_btn'])){ //Marriage Contract
			$prev_mc_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Marriage Contract/' . $ud['marriage_contract'];
			if (!empty($ud['marriage_contract']) && file_exists($prev_mc_path)) {
				$this->delete_prev_file($prev_mc_path);
			}
			$this->Acquisition_model->update_marriage_contract($is_no);
			$this->session->set_flashdata('notif','Marriage Contract file successfully uploaded!');
			redirect('Payment/view_inprogress/'. $is_no);
		}elseif(isset($_POST['up_bc_btn'])){ //Birth Certificate
			$prev_bc_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Birth Certificate/' . $ud['birth_certificate'];
			if (!empty($ud['birth_certificate']) && file_exists($prev_bc_path)) {
				$this->delete_prev_file($prev_bc_path);
			}
			$this->Acquisition_model->update_birth_certificate($is_no);
			$this->session->set_flashdata('notif','Birth Certificate file successfully uploaded!');
			redirect('Payment/view_inprogress/'. $is_no);
		}elseif(isset($_POST['up_vi_btn'])){ //Valid Id
			$prev_id_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Valid ID/' . $ud['valid_id'];
			if (!empty($ud['valid_id']) && file_exists($prev_id_path)) {
				$this->delete_prev_file($prev_id_path);
			}
			$this->Acquisition_model->update_valid_id($is_no);
			$this->session->set_flashdata('notif','Valid ID successfully uploaded!');
			redirect('Payment/view_inprogress/'. $is_no);
		}elseif(isset($_POST['up_sp_btn'])){ //Subdivision Plan
			$prev_sp_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Subdivision Plan/' . $ud['subdivision_plan'];
			if (!empty($ud['subdivision_plan']) && file_exists($prev_sp_path)) {
				$this->delete_prev_file($prev_sp_path);
			}
			$this->Acquisition_model->update_subdivision_plan($is_no);
			$this->session->set_flashdata('notif','Subdivision Plan successfully uploaded!');
			redirect('Payment/view_inprogress/'. $is_no);
		}elseif(isset($_POST['up_spa_btn'])){ //Spa
			$prev_spa_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/SPA/' . $ud['spa'];
			if (!empty($ud['spa']) && file_exists($prev_spa_path)) {
				$this->delete_prev_file($prev_spa_path);
			}
			$this->Acquisition_model->update_spa($is_no);
			$this->session->set_flashdata('notif','SPA successfully uploaded!');
			redirect('Payment/view_inprogress/'. $is_no);
		}elseif(isset($_POST['up_denr_btn'])){ //DENR/DAR
			$prev_denr_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/DENR or DAR/' . $ud['denr_dar'];
			if (!empty($ud['denr_dar']) && file_exists($prev_denr_path)) {
				$this->delete_prev_file($prev_denr_path);
			}
			$this->Acquisition_model->update_denr($is_no);
			$this->session->set_flashdata('notif','DENR/DAR successfully uploaded!');
			redirect('Payment/view_inprogress/'. $is_no);
		}elseif(isset($_POST['up_other_btn'])){ //OTHER
			$this->Acquisition_model->insert_other($is_no);
			$this->session->set_flashdata('notif','Other Documents successfully uploaded!');
			redirect('Payment/view_inprogress/'. $is_no);
		}elseif(isset($_POST['delete_other'])){//other documents
			$fileToDelete = trim($this->input->post('file_name')); // Get the filename to delete
			// Get the existing 'other' data from the database
			$existingOther = $this->Acquisition_model->getud_other_byid($is_no);

			// Split the 'other' data by commas
			$fileNames = explode(',', $existingOther);

			// Remove the specified filename from the array
			$id = array_search($fileToDelete, $fileNames);
			$this->session->set_flashdata('fileNames', $fileToDelete);

			unset($fileNames[$id]);
			// Rebuild the 'other' data with commas
			$updatedOther = implode(',', $fileNames);

			// Update the 'other' data in the database
			$this->Acquisition_model->update_ud_other($is_no, $updatedOther);

			// Delete the file from the server
			$filePath = './assets/img/uploaded_documents/' . $is_no . '/OTHER/' . $fileToDelete;
			if (file_exists($filePath)) {
				unlink($filePath);
			}

			$this->session->set_flashdata('notif', 'Successfully Deleted!');
			redirect('Payment/view_inprogress/' . $is_no);
		} 
		if ($this->form_validation->run() == FALSE){
			$this->render_template('secretary/Acquisition/upload_proof_documents/'. $is_no);
		}else{
			$this->render_template('secretary/Acquisition/upload_proof_documents/'. $is_no);
		}
	}
	public function Payment_tbl(){
		$this->sess_gm();
		$data 					= $this->Notification();
	    $data['getpr_reason'] 	= $this->Payment_model->getpr_reason();

		$this->render_template('3A/Payment_request/table',$data);        
  	}
  	public function pending_payment_datatable(){
		$data  		= array();
		$all_info 	= $this->Datatable_model->get_row($_POST);
			
		foreach($all_info as $ai){
			if ($ai->tag == "New" || $ai->tag == "New LAPF-ES") {
				$lot_owner 			= 	$ai->firstname." ".substr(($ai->middlename),0,1).". ".$ai->lastname;
				$lot_location 		= 	$ai->street."- ".$ai->baranggay.", ".$ai->municipality.", ".$ai->province;
				$submission_date 	= 	$ai->submission_date ? date_format(date_create($ai->submission_date), "F d, Y") : 'N/A';

				if ($ai->type == "Cash Advance") {
	                $action 		=	'<center>
	                            			<a href="' . base_url('Payment/request_cash_advance/'.$ai->control_no.'/'.$ai->is_no) . '"
	                                		class="btn btn-sm btn-info" style="border-radius:10px; background-color:#304b73;border-color:#fff;">
	                                		<span class="fa fa-eye"></span> View</a>
	                        			</center>';
	            }else if($ai->type == "Full Payment") {
	                $action 		=	'<center>
	                            			<a href="' . base_url('Payment/request_full_payment_view/'.$ai->control_no.'/'.$ai->is_no) . '"
	                                		class="btn btn-sm btn-info" style="border-radius:10px; background-color:#304b73;border-color:#fff;">
	                                		<span class="fa fa-eye"></span> View</a>
	                        			</center>';
	            }else{
	            	 $action 		=	'<center>
	                            			<a href="' . base_url('Payment/request_extrajudicial_view/'.$ai->is_no) . '"
	                                		class="btn btn-sm btn-info" style="border-radius:10px; background-color:#304b73;border-color:#fff;">
	                                		<span class="fa fa-eye"></span> View</a>
	                        			</center>';
	            }

				$data[] 			=	array($ai->is_no, $lot_owner,$ai->lot_type,$lot_location,$ai->type,$submission_date,$action);
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
	public function request_cash_advance($control_no,$is_no){
		$this->sess_gm();
		$data['title'] 		= "Request Cash Advance";
		$data 				= $this->Notification();
		$data['pr']			= $this->Payment_model->getpr_bycntrl($control_no);
		$data['li']			= $this->Acquisition_model->getli_byid($is_no);
		$data['ll']			= $this->Acquisition_model->getll_byid($is_no);
		$data['oi']			= $this->Acquisition_model->getoi_byid($is_no);
		$data['getpr_reason'] 	= $this->Payment_model->getpr_reason();

		$this->render_template('3A/Payment_request/view_CashAdvance',$data);   
 	}
 	public function submit_approved_payment($control_no){
		$this->sess_gm();
		$data 	= $this->Payment_model->getform_byid($control_no);
		$action = "Approved";
		$name 	=  $this->session->userdata('firstname').' '.$this->session->userdata('lastname');

		$this->Payment_model->approve_cash_advance($control_no,$name,$action);
		$this->Payment_model->notify_user($data['form_type'], $control_no, $action, $data['user_id']);    
  	}
  	public function pop_up_approved($is_no){
		$this->session->set_flashdata('notif','Request Approved Successfully!');
		redirect('Payment/Payment_tbl');
  	}
  	public function submit_disapproved_payment($control_no){
		$this->sess_gm();
		$data 	= $this->Payment_model->getform_byid($control_no);
		$reason = $this->input->post('disapproved_message');
		$action = "Disapproved";
		$name 	= $this->session->userdata('firstname').' '.$this->session->userdata('lastname');

		$this->Payment_model->disapprove_cash_advance($control_no,$name,$action,$reason);
		$this->Payment_model->notify_user($data['form_type'],$control_no, $action, $data['user_id']);
  	}
  	public function pop_up_disapproved($is_no){
		$this->session->set_flashdata('notif','Request Disapproved Successfully!');
		redirect('Payment/Payment_tbl');
  	}
 	public function request_full_payment_view($control_no, $is_no){
	    $this->sess_gm();
	    $data['title'] 	= "Request Full Payment";
	    $data 			= $this->Notification();
	    $data['is_no'] 	= $is_no;
	    $data['li'] 	= $this->Acquisition_model->getli_byid($is_no);
	    $data['oi']		= $this->Acquisition_model->getoi_byid($is_no);
	    $oi 			= $this->Acquisition_model->getoi_byid($is_no);
	    $data['ll']		= $this->Acquisition_model->getll_byid($is_no);
	    $data['cp'] 	= $this->Acquisition_model->getcp_byid($oi['id']);
	    $data['ud'] 	= $this->Acquisition_model->getud_byid($is_no);
	    $data['bi'] 	= $this->Acquisition_model->getbi_byid($is_no);
	    $data['pr']		= $this->Payment_model->getpr_bycntrl($control_no);
	    $data['ar'] 	= $this->Payment_model->get_acknowledgement_receipt_content($is_no);
	    $data['getpr_reason'] 	= $this->Payment_model->getpr_reason();
    
      	$this->render_template('3A/Payment_request/view_FullPayment', $data);
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
	    $data['ca'] = $this->Payment_request_model->getpr_byid_byca($is_no);
	    $data['eu'] = $this->Payment_request_model->getesupload_byid($is_no);
	    $data['payment_request'] = $this->Payment_request_model->get_payment_requests_by_es($is_no);
	    //END DATA
    
      	$this->render_template('3A/Payment_request/extrajudicial_settlement_form_view', $data);
  	}
  	public function approved_payment_datatable(){
		$data  		= array();
		$all_info 	= $this->Datatable_model->get_row($_POST);
			
		foreach($all_info as $ai){
			if ($ai->tag == "New" || $ai->tag == "New LAPF-ES") {
				$lot_owner 			= 	$ai->firstname." ".substr(($ai->middlename),0,1).". ".$ai->lastname;
				$lot_location 		= 	$ai->street."- ".$ai->baranggay.", ".$ai->municipality.", ".$ai->province;
				$submission_date 	= 	$ai->submission_date ? date_format(date_create($ai->submission_date), "F d, Y") : 'N/A';
				$approval_date 		= 	$ai->approval_date ? date_format(date_create($ai->approval_date), "F d, Y") : 'N/A';

				if ($ai->type == "Cash Advance") {
		               $action 		=	'<center>
		                            		<a href="' . base_url('Payment/request_cash_advance/'.$ai->control_no.'/'.$ai->is_no) . '"
		                                	class="btn btn-sm btn-info" style="border-radius:10px; background-color:#304b73;border-color:#fff;">
		                                	<span class="fa fa-eye"></span> View</a>
		                        		</center>';
	            }else if($ai->type == "Full Payment") {
	                $action 		=	'<center>
		                            		<a href="' . base_url('Payment/request_full_payment_view/'.$ai->control_no.'/'.$ai->is_no) . '"
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

				$data[] 		= 	array($ai->is_no, $lot_owner,$ai->lot_type,$lot_location,$ai->type,$submission_date,$approval_date,$action);
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
	public function disapproved_payment_datatable(){
		$data  		= array();
		$all_info 	= $this->Datatable_model->get_row($_POST);
			
		foreach($all_info as $ai){
			if ($ai->tag == "New" || $ai->tag == "New LAPF-ES") {
				$lot_owner 			= 	$ai->firstname." ".substr(($ai->middlename),0,1).". ".$ai->lastname;
				$lot_location 		= 	$ai->street."- ".$ai->baranggay.", ".$ai->municipality.", ".$ai->province;
				$submission_date 	= 	$ai->submission_date ? date_format(date_create($ai->submission_date), "F d, Y") : 'N/A';
				$disapproval_date 	= 	$ai->disapproval_date ? date_format(date_create($ai->disapproval_date), "F d, Y") : 'N/A';

				if ($ai->type == "Cash Advance") {
					$reason 		= 	'<a data-toggle="modal" data-target=".reason_disapproved_'.$ai->control_no.'" data-backdrop="static" data-keyboard="false"><i class="fa fa-eye"></i> View Reason</a>';
	                $action 		=	'<center>
		                            		<a href="' . base_url('Payment/request_cash_advance/'.$ai->control_no.'/'.$ai->is_no) . '"
		                                	class="btn btn-sm btn-info" style="border-radius:10px; background-color:#304b73;border-color:#fff;">
		                                	<span class="fa fa-eye"></span> View</a>
	                        			</center>';
	            }else if($ai->type == "Full Payment") {
	            	$reason 		= 	'<a data-toggle="modal" data-target=".reason_disapproved_'.$ai->control_no.'" data-backdrop="static" data-keyboard="false"><i class="fa fa-eye"></i> View Reason</a>';
	                $action 		=	'<center>
		                            		<a href="' . base_url('Payment/request_full_payment_view/'.$ai->control_no.'/'.$ai->is_no) . '"
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

				$data[] 			= 	array($ai->is_no, $lot_owner,$ai->lot_type,$lot_location,$ai->type,$submission_date,$disapproval_date,$reason,$action);
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
	public function paid_payment_datatable(){
		$data  		= array();
		$all_info 	= $this->Datatable_model->get_row($_POST);
			
		foreach($all_info as $ai){
			if($ai->tag == "New"){
				$lot_owner 		= 	$ai->firstname." ".substr(($ai->middlename),0,1).". ".$ai->lastname;
				$lot_location 	= 	$ai->street."- ".$ai->baranggay.", ".$ai->municipality.", ".$ai->province;
				$submission_date = 	$ai->submission_date ? date_format(date_create($ai->submission_date), "F d, Y") : 'N/A';
				$approval_date 	= 	$ai->approval_date ? date_format(date_create($ai->approval_date), "F d, Y") : 'N/A';
				$date_payed 	= 	$ai->date_payed ? date_format(date_create($ai->date_payed), "F d, Y") : 'N/A';

				if ($ai->type == "Cash Advance") {
	                $action 	=	'<center>
		                            	<a href="' . base_url('Payment/request_cash_advance/'.$ai->control_no.'/'.$ai->is_no) . '"
		                                class="btn btn-sm btn-info" style="border-radius:10px; background-color:#304b73;border-color:#fff;">
		                                <span class="fa fa-eye"></span> View</a>
	                        		</center>';
	            } else {
                	$action 	=	'<center>
	                            		<a href="' . base_url('Payment/request_full_payment_view/'.$ai->control_no.'/'.$ai->is_no) . '"
	                                	class="btn btn-sm btn-info" style="border-radius:10px; background-color:#304b73;border-color:#fff;">
	                                	<span class="fa fa-eye"></span> View</a>
	                        		</center>';
	            }

				$data[] 		= 	array($ai->is_no, $lot_owner,$ai->lot_type,$lot_location,$ai->type,$submission_date,$approval_date,$date_payed,$action);
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
	public function CRF_tbl(){
		$this->sess_acctng();
		$data['title']	 		= "Payment Request";
		$data 					= $this->Notification();
		$data['pr_approved']	=$this->Payment_model->getpr_approved1();
		// $data['payment_processing']	= $this->Payment_model->get_payment_request_processing();

		$this->render_template('accounting/payment_request/table',$data);
	}
	public function pending_crf_datatable() {
	    $data  		= array();
	    $all_info 	= $this->Datatable_model->get_row($_POST);

	    foreach ($all_info as $ai) {
	        if ($ai->tag == "New" || $ai->tag == "New LAPF-ES") {
	            $lot_owner 			= 	$ai->firstname . " " . substr(($ai->middlename), 0, 1) . ". " . $ai->lastname;
	            $lot_location 		= 	$ai->street . "- " . $ai->baranggay . ", " . $ai->municipality . ", " . $ai->province;
	            $submission_date 	= 	$ai->submission_date ? date_format(date_create($ai->submission_date), "F d, Y") : 'N/A';
	            $approval_date 		= 	$ai->approval_date ? date_format(date_create($ai->approval_date), "F d, Y") : 'N/A';

	            if ($ai->type == "Cash Advance") {
	                $action 		= 	'<center>
	                            			<button class="btn btn-default  btn-xs btn-round" data-toggle="modal" data-target="#crf_' . $ai->control_no . '" title="Create"><i class="fa fa-edit text-dark"></i> CRF</button>
	                            			<button class="btn btn-default btn-xs btn-round" data-toggle="modal" data-target="#rca_' . $ai->control_no . '" title="View"><i class="fa fa-eye text-dark"></i> VIEW</button>
	                           			</center>';
	            }else if($ai->type == "Full Payment") {
	                $action 		= 	'<center>
	                            			<button class="btn btn-default btn-xs btn-round" data-toggle="modal" data-target="#crf_' . $ai->control_no . '" title="Create"><i class="fa fa-edit text-dark""></i> CRF</button>
	                            			<a class="btn btn-default btn-xs btn-round" href="' . base_url('Accounting/Progress/view_inprogress/' . $ai->is_no) . '" title="View"><i class="fa fa-eye text-dark"></i> VIEW</a>
	                           			</center>';
	            }else{
	            	$action 		= 	'<center>
	                            			<button class="btn btn-default btn-xs btn-round" data-toggle="modal" data-target="#crf_collateral_' . $ai->is_no . '" title="Create"><i class="fa fa-edit"> CRF</i></button>
	                           			</center>';
	            }
	            $data[] = array($ai->is_no,$lot_owner,$ai->lot_type,$lot_location,$ai->type,$submission_date,$approval_date,$action);
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
	public function submit_crf($control_no, $is_no, $pr_type){
		$this->form_validation->set_rules('crf_no', 'CRF No.', 'required');
		$this->form_validation->set_rules('bank', 'Bank', 'required');
		$this->form_validation->set_rules('cheque_no', 'Cheque No.', 'required');
		$this->form_validation->set_rules('cheque_date', 'Cheque Date', 'required');
		// $this->form_validation->set_rules('particular', 'Particular', 'required');

		$pr_ccn = $this->Payment_model->getpr_bycntrl($control_no);
		$li 	= $this->Acquisition_model->getli_byid($is_no);
		$pr 	= $this->Payment_model->getpr_approved($control_no);
		$get 	= $this->Payment_model->getLatestRemainingBalance($is_no);
		$a_paid = $this->Payment_model->getpaid_ca($is_no); 

		if($this->form_validation->run() == FALSE){                             
			$this->render_template('accounting/payment_request/table',$data);
		}else{
			if(!isset($_POST['submit_crf_ca'])){
				redirect('');
			}
			$name =  $this->session->userdata('firstname').' '.$this->session->userdata('lastname');
			$this->Payment_model->insert_crf($pr['id'], $is_no, $pr['amount'], $get['remaining_balance'], $li['total_price'], $name, $pr_type);

			$this->session->set_flashdata('notif','CRF has been saved successfully!');
			redirect('Payment/CRF_tbl');
		}
	}
	public function history_crf_datatable(){
	    $data  			= array();
	    $all_info 		= $this->Datatable_model->get_row($_POST);
	    $unique_entries = array();

	    foreach($all_info as $ai){
	        if($ai->tag == "New"){
                $lot_owner 				= 	$ai->firstname . " " . substr(($ai->middlename), 0, 1) . ". " . $ai->lastname;
                $lot_location 			= 	$ai->street . "- " . $ai->baranggay . ", " . $ai->municipality . ", " . $ai->province;
                $pr_submission_date 	= 	$ai->pr_submission_date ? date_format(date_create($ai->pr_submission_date), "F d, Y") : 'N/A';
                $crf_submission_date 	= 	$ai->crf_submission_date ? date_format(date_create($ai->crf_submission_date), "F d, Y") : 'N/A';

                if ($ai->pr_type == "Cash Advance") {
		            $action   			=	'<center>
		                                		<button class="btn btn-xs btn-default btn-round" data-toggle="modal" data-target="#view_crf_modal_' . $ai->control_no . '" title="View"><i class="fa fa-eye"> CRF</i></button>
		                                		<button class="btn btn-xs btn-default btn-round" data-toggle="modal" data-target="#view_rca_' . $ai->control_no . '" title="View"><i class="fa fa-eye"> RCA</i></button>
		                            		</center>';
                } else {
                    $action 			=	'<center>
		                                		<button class="btn btn-xs btn-default btn-round" data-toggle="modal" data-target="#view_crf_modal_' . $ai->control_no . '" title="View"><i class="fa fa-eye"> CRF</i></button>
		                                		<a class="btn btn-default btn-xs btn-round" href="' . base_url('Accounting/Progress/view_inprogress/'.$ai->is_no) . '" title="View"><i class="fa fa-file"> VIEW</i></a>
		                            		</center>';
                }

                $data[] 				= 	array($ai->crf_no,$ai->is_no, $lot_owner, $ai->lot_type, $lot_location, $ai->pr_type, $pr_submission_date, $crf_submission_date, $action);
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
	public function inprogress1_tbl(){
    	$this->sess_acctng();
	    $data['title'] 		= "In Progress";
	    $data 				= $this->Notification();
	    $this->render_template('accounting/in_progress/table',$data);
	}
	public function inprogress1_datatable(){
		$data  		= array();
		$all_info 	= $this->Datatable_model->get_row($_POST);
			
		foreach($all_info as $ai){
			$a_paid 		= $this->Payment_model->getpt_TotalPaidAmount($ai->is_no);
			$total_price 	= $ai->total_price ?? 0; 
			$percent 		= 0;
			if ($total_price > 0) {
			    $p 			= ($a_paid / $total_price) * 100;
			    $percent 	= (float) number_format($p, 2);
			}

			if($ai->tag == "New"){
				$owner_info 	= 	$ai->firstname." ".substr(($ai->middlename),0,1).". ".$ai->lastname;
				$address 		= 	$ai->street."- ".$ai->baranggay.", ".$ai->municipality.", ".$ai->province;
				$approval_date 	= 	$ai->approval_date ? date_format(date_create($ai->approval_date), "F d, Y") : 'N/A';

				$action 		=	'<center>
										<a type="a" href=" '.base_url('Payment/view_inprogress/'.$ai->is_no).' " class="btn btn-primary btn-xs" style="border-radius: 10px;background:linear-gradient(to top, rgb(9, 32, 63) 0%, rgb(83, 120, 149) 100%); border-color:#fff;" title="View"><span class="fa fa-eye"></span> View</a>
									</center>';
				if($percent == 100){
					$bar 	= 	"<div class='progress' style='border: 1px solid #E6E9ED;'>
									<div class='progress-bar progress-bar-success progress-bar-striped active' data-transitiongoal='$percent' aria-valuenow='$percent' style='width: $percent%;'>$percent%</div>
								</div>";
				}elseif ($percent >= 51) {
					$bar 	= 	"<div class='progress' style='border: 1px solid #E6E9ED;'>
									<div class='progress-bar progress-bar-warning progress-bar-striped active' data-transitiongoal='$percent' aria-valuenow='$percent' style='width: $percent%;'>$percent%</div>
								</div>";
				}elseif ($percent <= 50) {
					$bar 	= 	"<div class='progress' style='border: 1px solid #E6E9ED;'>
									<div class='progress-bar progress-bar-danger progress-bar-striped active' data-transitiongoal='$percent' aria-valuenow='$percent' style='width: $percent%;'>$percent%</div>
								</div>";
				
				}
				$data[] 		= 	array($ai->is_no, $owner_info,$address,$approval_date,$bar, $action);
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
	#FORM VALIDATION
	public function check_currency($inp){
		$amount = str_replace( ',', '', $inp );
		if (!preg_match('/^\d+(\.\d{2})?$/', $amount)){
			$this->form_validation->set_message('check_currency', '{field} is invalid.');
			return FALSE;
		}else{
			if($amount == 0.00){
				$this->form_validation->set_message('check_currency', '{field} cannot be zero value.');
				return FALSE;
			}else{
				return TRUE;
			}
		}
	}
	public function delete_prev_file($str){
		if (is_file($str)) {
			//Attempt to delete it.
			return unlink($str);
		}
	}
}