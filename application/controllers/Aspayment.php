<?php
class Aspayment extends App_Controller{
	public function __construct(){
        parent::__construct();
        $this->not_logged_in();
        $this->load->model('Aspayment_model');
        $this->load->model('Notification_bar_model');
		$this->load->model('Notification_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
    }
    public function judicial(){
		$data['title'] 		= "Judicial Settlement Form";
		$data['judicial'] 	= $this->Aspayment_model->get_js_new();

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
			$area 		= $this->input->post('lot_size');
			$price 		= $this->input->post('bid_price');
			$lot_area 	= str_replace(',', '', $area);
			$bid_p 		= str_replace(',', '', $price);
			$fno 		= $this->input->post('js_no');
			$ftype 		= "LAPF-JS";
			$uid 		= $this->session->userdata('user_id');

			$this->Aspayment_model->add_customer_bal();
			$this->Aspayment_model->add_customer_info();
			$this->Aspayment_model->add_customer_add();
			$this->Aspayment_model->add_land_info($lot_area);
			$this->Aspayment_model->add_owner_info();
			$this->Aspayment_model->add_lot_location();
			$this->Aspayment_model->add_bidding_details($bid_p);
			$this->Aspayment_model->add_tct();
			$this->Aspayment_model->add_oct();
			$this->Aspayment_model->add_forms($fno, $ftype, $uid);

			$this->session->set_flashdata('notif', 'Request has been sent!');
			redirect('');
		}
	}
	#ADDRESS
	public function getregion(){
		$result = $this->Aspayment_model->get_tesdaregion();
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
		$result 	= $this->Aspayment_model->get_tesdaprovince($regCode);
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
		$result 	= $this->Aspayment_model->get_tesdacitymun($provCode);
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
		$result 		= $this->Aspayment_model->get_tesdabrgy($citymunCode);
		$output 		= [];
		$i 				= 0;
		foreach ($result as $value) {
			$output[$i]['brgyDesc'] = $value->brgyDesc;
			$output[$i]['brgyCode'] = $value->brgyCode;
			$i++;
		}
		echo json_encode($output);
	}
	public function province(){
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
	public function citymun(){
		$provCode 	= $_POST['provCode'];
		$result 	= $this->Aspayment_model->get_citymun($provCode);
		$output 	= [];
		$i 			= 0;
		foreach ($result as $value) {
			$output[$i]['citymunDesc'] = $value->citymunDesc;
			$output[$i]['citymunCode'] = $value->citymunCode;
			$i++;
		}
		echo json_encode($output);
	}
	public function brgy(){
		$citymunCode 	= $_POST['citymunCode'];
		$result 		= $this->Aspayment_model->get_brgy($citymunCode);
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
		$row 	= $this->Aspayment_model->getforms_byid($str);
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
			$row 		= $this->Aspayment_model->getforms_byid($str);
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
	#END
}