<?php
class Rpt extends App_Controller{
	public function __construct(){
		parent::__construct();
		$this->not_logged_in();
		// Load the model
		$this->load->model('Rpt_model');
		$this->load->model('Payment_model');
		$this->load->model('Datatable_model');
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
		#Tab Notification
	    $data['pending_acq'] 			= $this->Notification_bar_model->getds_status_pending();
		#Message Notification
		$recepient 						=  $this->session->userdata('user_id');
		$data['all_notifications']		= $this->Notification_model->get_notif_per_user($recepient);
		$data['all_notification_no']	= $this->Notification_model->get_all_notification_no($recepient);
		return $data;
	}
	public function index(){
		$this->sess_legal();
		$data['title'] 	= "Real Property Tax";
		$data 			= $this->Notification();
		
		$this->render_template('legal/Rpt/rpt_table',$data);
	}
	public function Rpt_datatable(){
		$data 		= array();
		$all_info 	= $this->Datatable_model->get_row($_POST);

		foreach ($all_info as $ai) {
			$lot_owner 		= 	$ai->firstname." ".substr(($ai->middlename),0,1).". ".$ai->lastname;
			$lot_location	= 	'<address>
                  					<a data-toggle="tooltip" title="click to view map" data-placement="right" href="http://maps.google.com/maps?q='.$ai->street." ".$ai->baranggay." ".$ai->municipality." ".$ai->province.' " target="_blank">
                    				'.ucfirst($ai->street)."- ".ucfirst($ai->baranggay).", ".ucfirst($ai->municipality).", ".ucfirst($ai->province).'
                  					</a>
                				</address>';
            $status 		= 	'<center>Declared</center>';
	        $action 		= 	'<center>
							        <div class="btn-group">
							            <button type="button" class="btn btn-danger btn-xs">Action</button>
							            <button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown">
							                <span class="caret"></span>
							                <span class="sr-only">Toggle Dropdown</span>
							            </button>
							            <ul class="dropdown-menu" role="menu">';
										    $action .= '<li class="bg-white">
									                        <a href="' . base_url('Rpt/Real_Property_Tax/' . $ai->is_no) . '" title="Add Payment">
                    											<span class="fa fa-edit"></span> Tax Payment Schedule
                    										</a>
									                    </li>';
			$action 		.= 			'</ul>
			              			</div>
				            	</center>';

			$data[] 		=	array('<input type="checkbox" class="row-check" value="'.$ai->is_no.'">',
										$ai->is_no,
										$ai->tax_dec_no,
										$lot_owner,
										$ai->municipality,
										$ai->lot,
										$ai->lot_type,
										$status,
										$action
									);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->Datatable_model->countAll(),
			"recordsFiltered" 	=> $this->Datatable_model->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}
	public function Real_Property_Tax($is_no){
		$this->sess_legal();
		$data['title'] 	 = "Real Property Tax";
		$data 			 = $this->Notification();
		$data['li'] 	 = $this->Acquisition_model->getli_byid($is_no);
		$data['oi']		 = $this->Acquisition_model->getoi_byid($is_no);
		$data['ud']		 = $this->Acquisition_model->getud_byid($is_no);
		$data['ll']		 = $this->Acquisition_model->getll_byid($is_no);
		$data['rpt_result'] = $this->Rpt_model->select_rpt_yearpaid_asc_result($is_no);
		$data['rpt_num'] 	= $this->Rpt_model->select_rpt_num($is_no);
		$data['asmnts_row'] = $this->Rpt_model->select_assessments_row($is_no);

		$this->render_template('legal/Rpt/real_property_tax',$data);
	}
	public function Post_PerMunicipality() {
	    $is_nos = $this->input->post('is_no');

	    if (!empty($is_nos)) {
	        foreach ($is_nos as $is_no) {
	        	$this->Rpt_model->post_rpt($is_no);
	        }
	        echo json_encode(['status' => 'success']);
	    } else {
	        echo json_encode(['status' => 'error', 'message' => 'No IDs received.']);
	    }
	}
	public function submit_RPT($is_no){
		$this->sess_legal();
		$data['title'] 	 = "Real Property Tax";
		$data 			 = $this->Notification();
		$data['li'] 	 = $this->Acquisition_model->getli_byid($is_no);
		$data['oi']		 = $this->Acquisition_model->getoi_byid($is_no);
		$data['ud'] 	 = $this->Acquisition_model->getud_byid($is_no);
		$data['ll'] 	 = $this->Acquisition_model->getll_byid($is_no);
		$data['rpt_result'] = $this->Rpt_model->select_rpt_yearpaid_asc_result($is_no);
		$data['rpt_num'] 	= $this->Rpt_model->select_rpt_num($is_no);
		$data['asmnts_row'] = $this->Rpt_model->select_assessments_row($is_no);

		if (isset($_POST['submit_assmnt_lvl']) || isset($_POST['update_assmnt_lvl'])) {
			$this->form_validation->set_rules('effective_year', 'Effectivity of Assessment', 'required');
			$this->form_validation->set_rules('ass_lvl', 'Assessment Level', 'required|callback_check_assmnt_lvl');
		}else{
			$this->form_validation->set_rules('year_paid', 'Year Paid', 'required');
			$this->form_validation->set_rules('amount', 'Amount', 'required');
			$this->form_validation->set_rules('file', 'RPT file', 'callback_check_file');	
		}

		if ($this->form_validation->run() == FALSE) {
			$this->render_template('legal/Rpt/real_property_tax', $data);
		} else {
			if (isset($_POST['submit_assmnt_lvl'])) {
				$this->Rpt_model->add_assessment($is_no);
				$this->session->set_flashdata('success', 'Assessment Level set up successfully! you can now upload the RPT file.');
			}elseif (isset($_POST['update_assmnt_lvl'])) {
				$this->Rpt_model->update_assessment_level($is_no);
				$this->session->set_flashdata('success', 'Assessment Level updated successfully!');
			}else{
            	$rpt_result = $this->Rpt_model->select_rpt_yearpaid_asc_result($is_no);
            	$yr_paid    = [];
    			foreach($rpt_result as $paid){
    				$yr_paid[] = (new DateTime($paid['year_paid']))->format('Y');
    			}
    			$yr_paid1 = (new DateTime($this->input->post('year_paid')))->format('Y');
        	    if (in_array($yr_paid1, $yr_paid)) {
					$this->session->set_flashdata('notif','The year you have selected has been already paid!');
				}else{
					$this->Rpt_model->add_rpt($is_no);
			        $this->session->set_flashdata('success', 'Submitted successfully!');
				}
			}
			redirect('Rpt/submit_RPT/'.$is_no);
		}
	}
	
	#VALIDATION
	function check_assmnt_lvl($str){
		if (!ctype_digit($str)) {
			$this->form_validation->set_message('check_assmnt_lvl', '{field} is invalid.');
			return FALSE;
		} else {
			if (strlen($str) <= 3) { //check string length
				if ($str == 0) {
					$this->form_validation->set_message('check_assmnt_lvl', '{field} cannot be zero value.');
					return FALSE;
				} elseif ($str > 100) { //if string is greater than 100
					$this->form_validation->set_message('check_assmnt_lvl', '' . $str . ' exceeds the limit percentage.');
					return FALSE;
				} else {
					return TRUE;
				}
			} else {
				$this->form_validation->set_message('check_assmnt_lvl', '' . $str . ' exceeds the limit percentage.');
				return FALSE;
			}
		}
	}
	function checkDateFormat($date) {
		$day   = (int) substr($date, 0, 2);
	    $month = (int) substr($date, 3, 2);
	    $year  = (int) substr($date, 6, 4);
	    //return checkdate($month, $day, $year);
	    if(checkdate($month, $day, $year) === FALSE){
	    	$this->form_validation->set_message('checkDateFormat', ''.$date.' is not a valid date.');
	    	return FALSE;
	    }else{
	    	$current_date = date('Y-m-d');			    		
	    	if($date > $current_date){
	    		$this->form_validation->set_message('checkDateFormat', ''.$date.' is not a valid date.');
	    		return FALSE;
	    	}else{
	    		return TRUE;
	    	}
	    }
	}
	function check_rpt_amount($inp){
		$amount = str_replace(',', '', $inp);
		if (!preg_match('/^\d+(\.\d{2})?$/', $amount)) {
			$this->form_validation->set_message('check_rpt_amount', '<span class="error-message">'.'{field} is invalid.</span>');
			return FALSE;
		} else {
			if ($amount == 0.00) {
				$this->form_validation->set_message('check_rpt_amount', '<span class="error-message">{field} cannot be zero value.</span>');
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}
	function delete_prev_file($str){
		if (is_file($str)) {
			//Attempt to delete it.
			return unlink($str);
		}
	}
	function check_file(){
        $allowed =  array('gif','png' ,'jpg', 'jpeg');
        $filename = $_FILES['file']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(empty($filename)){
            $this->form_validation->set_message('check_file', 'The %s file is required!');
		    return FALSE;
        }else{

            if(strlen($filename) > 200){
                $this->form_validation->set_message('check_file','rename your %s file, it exceeds the maximum no. of string which is 200');
                return FALSE;
            }elseif(!in_array(strtolower($ext), $allowed) ) { //not in array
                $this->form_validation->set_message('check_file','your %s  is not a valid file format');
                return FALSE;                       
            }else{
                return TRUE;
            }
        }
    }
	public function Rpt_table() {
		$this->sess_acctng();

		// Get notifications and other data
		$data = $this->Notification();

		// Add/override specific data
		$data['title'] = "Real Property Tax";
		$data['approved_payment'] = $this->Notification_bar_model->getpr_status_approved();

		// Load payment requests so you can display in the view (to select pr_id, is_no, type)
		$this->load->model('Payment_model');
		$data['payment_requests'] = $this->Payment_model->get_all_payment_requests();

		// Generate new CRF number
		$latest_crf_no = $this->Payment_model->get_latest_crf_no();

		$new_crf_no = "CRF-0001";
		if (!empty($latest_crf_no)) {
			$max_id = (int) substr($latest_crf_no, 4);
			$new_id = $max_id + 1;
			$new_crf_no = "CRF-" . str_pad($new_id, 4, '0', STR_PAD_LEFT);
		}
		$data['crf_no'] = $new_crf_no;

		// TEMPORARY: avoid undefined variable error in modal
		$data['pr_id'] = '';
		$data['is_no'] = '';
		$data['type'] = '';

		// Render the view with all data
		$this->render_template('accounting/Rpt/rpt_table', $data);
	}
	public function Rptax_datatable() {
		$postData	= $this->input->post();

		// Check if any filter is missing
		if (
			empty($postData['region']) ||
			empty($postData['province']) ||
			empty($postData['town']) 
		) {
			// Return empty DataTables response
			echo json_encode([
				"draw" => intval($postData['draw']),
				"recordsTotal" => 0,
            	"recordsFiltered" => 0,
            	"data" => []
			]);
			return;
		}

		// Proceed only if filters are complete
		$data       = array();
		$all_info   = $this->Datatable_model->get_row($postData);
		
		foreach ($all_info as $ai) {
				// Get values from payment_requests directly
				$pr_id = isset($ai->pr_id) ? $ai->pr_id : '';
				$is_no = isset($ai->payment_is_no) ? $ai->payment_is_no : '';
				$type = isset($ai->pr_type) ? $ai->pr_type : '';
							
				// You can include them as data-* attributes in the button
	            	$action = '<center>
						<a href="#" class="btn btn-primary btn-xs openCrfModalBtn" style="border-radius: 10px; border-color: #fff;"
						data-pr_id="' . htmlspecialchars($pr_id ?? '', ENT_QUOTES) . '"
						data-is_no="' . htmlspecialchars($is_no ?? '', ENT_QUOTES) . '"
						data-type="' . htmlspecialchars($type ?? '', ENT_QUOTES) . '">
						<span class="fa fa-clipboard"></span> Create CRF
						</a>
					</center>';
				

				$data[] = array(
        			$ai->is_no,
					$ai->firstname . ' ' . $ai->lastname,
					$ai->lot_type,
					$ai->street . ' - ' . $ai->baranggay . ', ' . $ai->municipality,
					$ai->tax_dec_no,
					$ai->lot,
					$action
    			);
			}	
				
    	$output = array(
        	"draw"            => intval($postData['draw']),
        	"recordsTotal"    => $this->Datatable_model->countAll(),
        	"recordsFiltered" => $this->Datatable_model->countFiltered($postData),
        	"data"            => $data

    	);
    	echo json_encode($output);
	}
	public function submit_crf_rpt() {
		$this->load->model('Rpt_model');	

		$raw_amount = $this->input->post('amount', TRUE);
    	$amount = floatval(str_replace([',', '₱'], '', $raw_amount)); // remove commas

		$fullname = $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname');

		// Handle file upload if file is present
		$img = null;
		if (!empty($_FILES['file_upload']['name'])) {
			$upload_path = FCPATH . 'assets/img/uploaded_documents/';
        	if (!is_dir($upload_path)) {
            	mkdir($upload_path, 0755, true);
        	}

			$config['upload_path']   = $upload_path;
			$config['allowed_types'] = 'pdf|jpg|png|doc|docx';
			$config['max_size']		 = 2048; // 2MB
			$config['encrypt_name']  = TRUE;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('file_upload')) {
				$upload_data = $this->upload->data();
				$img = $upload_data['file_name'];
			} else {
				$this->session->set_flashdata('error', $this->upload->display_errors());
				redirect('Rpt/Rpt_table/');
				return;
			}
		}

		// Hidden field values (from payment_requests)
		$pr_id = $this->input->post('pr_id', TRUE) ?: null;
		$is_no = $this->input->post('is_no', TRUE) ?: null;
		$type  = $this->input->post('type', TRUE) ?: null;

		$data = array(
			'crf_no'		=> $this->input->post('crf_no', TRUE),
			//'date_requested' => $this->input->post('date_requested'),
            'pay_to'         => $this->input->post('pay_to', TRUE),
            'amount'         => $amount,
            'bank'           => $this->input->post('bank', TRUE),
            'cheque_no'      => $this->input->post('cheque_no', TRUE),
            'cheque_date'    => $this->input->post('cheque_date', TRUE),
			'filename'       => $img,
			'prepared_by' 	 => $fullname,
			'submission_date' => date('Y-m-d'),
			'pr_id'	 		 => $pr_id, 
			'is_no'	 		 => $is_no, 
			'type'	 		 => $type 
		);

		//log_message('debug', 'CRF Insert Data: ' . print_r($data, true));

		$inserted = $this->Rpt_model->insert_crf_rpt($data); // Call model to save

		 // Redirect or return success
        if ($inserted) {
    		$this->session->set_flashdata('success', 'CRF Real Property Tax has been saved successfully.');
		} else {
    		$this->session->set_flashdata('error', 'Failed to save CRF. Please try again.');
		}
		redirect('Rpt/Rpt_table/');

	}


}