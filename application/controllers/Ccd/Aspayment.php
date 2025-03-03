<?php
class Aspayment extends App_Controller{
	public function __construct(){
		parent::__construct();
		$this->not_logged_in();
		if (!$this->session->userdata('user_type') == "CCD") {
			redirect();
		}
		// Load the model
		$this->load->model('Ccd/Aspayment_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('string');
		$this->load->helper('url');
	}

	//==================================================
	//JUDICIAL
	//==================================================
	public function index(){
		$data['title'] = "Judicial Settlement Form";
		//DATA
		$data['judicial'] = $this->Aspayment_model->get_js_new();
		//END DATA

		$this->form_validation->set_rules('js_no', 'LAPF-JS No.', 'required|callback_check_jsno_new');
		$this->form_validation->set_rules('date', 'Date', 'required|callback_checkDateFormat');
		$this->form_validation->set_rules('case_type', 'Case Type', 'required|in_list[Small claim case,Collection of Sum Money]');
		$this->form_validation->set_rules('business_unit', 'Business Unit', 'required|regex_match[/^[a-zA-Z -]+$/]|max_length[60]');
		$this->form_validation->set_rules('customer_fname', 'Customer Firstname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the customer is required!'));
		$this->form_validation->set_rules('customer_mname', 'Customer Middlename', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the customer is required!'));
		$this->form_validation->set_rules('customer_lname', 'Customer Lastname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the customer is required!'));
		$this->form_validation->set_rules('customer_street', 'Street', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[50]');
		$this->form_validation->set_rules('lot', 'Lot No.', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[30]');
		$this->form_validation->set_rules('cad', 'Cad No.', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[30]');
		$this->form_validation->set_rules('lot_type', 'Lot Type', 'required|in_list[Agricultural,Commercial,Residential]');
		
		$this->form_validation->set_rules('lot_fname', 'Lot Owner Firstname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the owner is required!'));
		$this->form_validation->set_rules('lot_mname', 'Lot Owner Middlename', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the owner is required!'));
		$this->form_validation->set_rules('lot_lname', 'Lot Owner Lastname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the owner is required!'));
		$this->form_validation->set_rules('gender', 'gender', 'required|in_list[Male,Female]');
		$this->form_validation->set_rules('vital_status', 'Vital Status', 'required|in_list[Alive,Deceased]');
		$this->form_validation->set_rules('status', 'Status', 'required|in_list[Paid,Pending]');
		$this->form_validation->set_rules('lot_s', 'Lot for bidding', 'required|in_list[Portion,Whole]');
		$this->form_validation->set_rules('lot_size', 'Lot Size', 'required|callback_check_currency');
		$this->form_validation->set_rules('bid_price', 'bid price', 'required|callback_check_currency');
		$this->form_validation->set_rules('available_proof', 'Proof', 'required|in_list[oct,tct]');
		if (@$_POST['available_proof'] == "oct") {
			$this->form_validation->set_rules('oct', 'OCT', 'callback_check_oct');
		} else {
			$this->form_validation->set_rules('tct', 'TCT', 'callback_check_tct');
		}
		$this->form_validation->set_rules('status', 'Highest Bidder', 'min_length[4]|regex_match[/^[a-zA-Z ]+$/]|max_length[90]');

		if ($this->form_validation->run() == FALSE) {
			$this->render_template('ccd/Aspayment/judicial_settlement_form', $data);
		} else {
			$area = $this->input->post('lot_size');
			$price = $this->input->post('bid_price');

			$lot_area = str_replace(',', '', $area);
			$bid_p = str_replace(',', '', $price);

			$fno = $this->input->post('js_no');
			$ftype = "LAPF-JS";
			$uid = $this->session->userdata('user_id');

			$this->Aspayment_model->insert_form_request($fno, $ftype, $uid);
			$this->Aspayment_model->insert_judicial_land_info($lot_area);
			$this->Aspayment_model->insert_judicial_customer_balance();
			$this->Aspayment_model->insert_judicial_customer_info();
			$this->Aspayment_model->insert_judicial_customer_address();
			$this->Aspayment_model->insert_judicial_owner_info();
			$this->Aspayment_model->insert_judicial_lot_location();
			$this->Aspayment_model->insert_tct();
			$this->Aspayment_model->insert_oct();
			$this->Aspayment_model->insert_judicial_bidding_details($bid_p);

			$this->session->set_flashdata('notif', 'Request has been sent!');
			redirect('Ccd/Execute/pending_table/');
		}
	}
	//==================================================
	//END JUDICIAL
	//==================================================

	//==================================================
	//EXTRA JUDICIAL
	//==================================================
	public function extrajudicial(){
		$data['title'] = "Extra-Judicial Settlement Form";

		//DATA
		$data['extra'] = $this->Aspayment_model->get_es_new();
		//END DATA

		$this->form_validation->set_rules('es_no', 'LAPF-ES No.', 'required|callback_check_esno_new');
		$this->form_validation->set_rules('date', 'Date', 'required|callback_checkDateFormat');
		$this->form_validation->set_rules('lot', 'Lot No.', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[30]');
		$this->form_validation->set_rules('cad', 'Cad No.', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[30]');
		$this->form_validation->set_rules('lot_type', 'Lot Type', 'required|in_list[Agricultural,Commercial,Residential]');
		$this->form_validation->set_rules('lot_fname', 'Firstname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the owner is required!'));
		$this->form_validation->set_rules('lot_mname', 'Middlename', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the owner is required!'));
		$this->form_validation->set_rules('lot_lname', 'Lastname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the owner is required!'));
		$this->form_validation->set_rules('gender', 'gender', 'required|in_list[Male,Female]');
		$this->form_validation->set_rules('vital_status', 'Vital Status', 'required|in_list[Alive,Deceased]');
		$this->form_validation->set_rules('lot_s', 'Lot for payment', 'required|in_list[Portion,Whole]');
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
			$area = $this->input->post('lot_size');
			$b = $this->input->post('mv_tax');
			$c = $this->input->post('neighbor_inq');
			$d = $this->input->post('assessor');
			$e = $this->input->post('banks');
			$f = $this->input->post('final_value');

			$lot_area = str_replace(',', '', $area);
			$mv_tax = str_replace(',', '', $b);
			$neighbor_inq = str_replace(',', '', $c);
			$assessor = str_replace(',', '', $d);
			$banks = str_replace(',', '', $e);
			$final_value = str_replace(',', '', $f);
						
			$fno = $this->input->post('es_no');
			$ftype = "LAPF-ES";
			$uid = $this->session->userdata('user_id');

			$this->Aspayment_model->insert_form_request($fno,$ftype,$uid);
			$this->Aspayment_model->insert_es_land_info($lot_area);
			$this->Aspayment_model->insert_es_owner_info();
			$this->Aspayment_model->insert_es_lot_location();
			$this->Aspayment_model->insert_tct();
			$this->Aspayment_model->insert_oct();
			$this->Aspayment_model->insert_es_amount_basis($mv_tax, $neighbor_inq, $assessor, $banks, $final_value);
			$this->Aspayment_model->insert_es_uploads();
			$this->Aspayment_model->insert_es_payment_requests();

			$this->session->set_flashdata('notif', 'You may now Proceed!');
			redirect('Ccd/Aspayment/extrajudicial_customer_info/' . $fno);
		}
	}

	public function extrajudicial_customer_info($id){
		$data['title'] = "Extra-Judicial Settlement Form"; 

		//DATA
		$data['es_no'] = $id;
		//END DATA

		$this->form_validation->set_rules('balance_type', 'Balance Type', 'required|in_list[Bounced Check,Bad Account]');
		$this->form_validation->set_rules('business_unit', 'Business Unit', 'required|regex_match[/^[a-zA-Z -]+$/]|max_length[60]');
		$this->form_validation->set_rules('fname', 'Firstname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the customer is required!'));
		$this->form_validation->set_rules('mname', 'Middlename', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the customer is required!'));
		$this->form_validation->set_rules('lname', 'Lastname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the customer is required!'));
		$this->form_validation->set_rules('doubtful_account', 'Turnover of doubtful account form', 'callback_check_doubtful_account');
		$this->form_validation->set_rules('latest_soa', 'Latest SOA', 'callback_check_latest_soa');
		$this->form_validation->set_rules('supporting_docs', 'Supporting Documents ', 'callback_check_supporting_docs');

		if ($this->form_validation->run() == FALSE) {
			$this->render_template('ccd/Aspayment/extrajudicial_customer_form', $data);
		} else {
			$this->Aspayment_model->insert_es_customer_balance();
			$this->Aspayment_model->insert_es_customer_info();
			$this->Aspayment_model->insert_es_customer_address();
			$this->Aspayment_model->update_es_uploads($id);

			$this->session->set_flashdata('notif', 'Request has been sent!');
			// redirect('Aspayment/update_es_id/' . $id);
			redirect('Ccd/Execute/pending_table/', $data);
		}
	}
	//==================================================
	//END EXTRA JUDICIAL
	//==================================================

	//==================================================
	//ADDRESS
	//==================================================
	public function getregion(){
		$result = $this->Aspayment_model->get_region();
		$output = [];
		$i = 0;
		foreach ($result as $value) {
			$output[$i]['regDesc'] = $value->regDesc;
			$output[$i]['regCode'] = $value->regCode;
			$i++;
		}
		echo json_encode($output);
	}

	public function getprovince(){
		$regCode = $_POST['regCode'];
		$result = $this->Aspayment_model->get_province($regCode);
		$output = [];
		$i = 0;
		foreach ($result as $value) {
			$output[$i]['provDesc'] = $value->provDesc;
			$output[$i]['provCode'] = $value->provCode;
			$i++;
		}
		echo json_encode($output);
	}

	public function getcitymun(){
		$provCode = $_POST['provCode'];
		$result = $this->Aspayment_model->get_citymun($provCode);
		$output = [];
		$i = 0;
		foreach ($result as $value) {
			$output[$i]['citymunDesc'] = $value->citymunDesc;
			$output[$i]['citymunCode'] = $value->citymunCode;
			$output[$i]['zipcode'] = $value->zipcode;
			$i++;
		}
		echo json_encode($output);
	}

	public function getbrgy(){
		$citymunCode = $_POST['citymunCode'];
		$result = $this->Aspayment_model->get_brgy($citymunCode);
		$output = [];
		$i = 0;
		foreach ($result as $value) {
			$output[$i]['brgyDesc'] = $value->brgyDesc;
			$output[$i]['brgyCode'] = $value->brgyCode;
			$i++;
		}
		echo json_encode($output);
	}
	//==================================================
	//END ADDRESS
	//==================================================

	//==================================================
	//VALIDATION
	//==================================================
	function check_jsno_new($str){
		$row = $this->Aspayment_model->getforms_byid($str);
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

	function check_esno_new($str){
		@$format = substr($str, 0, 3);
		if ($format == "ES-") {
			$row = $this->Aspayment_model->getforms_byid($str);
			$land_id = $this->Aspayment_model->get_es_new();
			$is_input = substr($str, 3); //user input or default from form

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

    public function date_valid($str) {
        $dt = date_create_from_format('Y-m-d', $str);
        return $dt && $dt->format('Y-m-d') === $str;
    }

	function check_currency($inp){
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

	function check_oct(){
		$file = $_FILES["oct"]['name'];

		if (empty($file)) {
			$this->form_validation->set_message('check_oct', 'The %s file is required!');
			return FALSE;
		} else {
			$allowed = array('gif', 'png', 'jpg', 'jpeg');
			$filename = $file;
			$ext = pathinfo($filename, PATHINFO_EXTENSION);

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

	function check_tct(){
		$file = $_FILES["tct"]['name'];
		if (empty($file)) {
			$this->form_validation->set_message('check_tct', 'The %s file is required!');
			return FALSE;
		} else {
			$allowed = array('gif', 'png', 'jpg', 'jpeg');
			$filename = $file;
			$ext = pathinfo($filename, PATHINFO_EXTENSION);

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

	function check_doubtful_account(){
		$file = $_FILES["doubtful_account"]['name'];
		if (empty($file)) {
			$this->form_validation->set_message('check_doubtful_account', 'The %s file is required!');
			return FALSE;
		} else {
			$allowed = array('gif', 'png', 'jpg', 'jpeg');
			$filename = $file;
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
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

	function check_latest_soa(){
		$file = $_FILES["latest_soa"]['name'];
		if (empty($file)) {
			$this->form_validation->set_message('check_latest_soa', 'The %s file is required!');
			return FALSE;
		} else {
			$allowed = array('gif', 'png', 'jpg', 'jpeg');
			$filename = $file;
			$ext = pathinfo($filename, PATHINFO_EXTENSION);

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

	function check_supporting_docs(){
		$file = $_FILES["supporting_docs"]['name'];
		if (empty($file)) {
			$this->form_validation->set_message('check_supporting_docs', 'The %s file is required!');
			return FALSE;
		} else {
			$allowed = array('gif', 'png', 'jpg', 'jpeg');
			$filename = $file;
			$ext = pathinfo($filename, PATHINFO_EXTENSION);

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
	//==================================================
	//END VALIDATION
	//==================================================
}