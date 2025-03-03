<?php
class Aspayment extends App_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
		// Load the model
		$this->load->model('Land_model');
		$this->load->model('Legal/Aspayment_model');
		$this->load->model('Registry_model');
		$this->load->model('Payment_model');
		$this->load->model('GM_model');
		$this->load->model('Notification_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('string');
		$this->load->helper('url');
	}

	public function judicial()
	{
		$this->sess_legal();

		$data['customer'] = $this->Aspayment_model->get_customer_info();
		$data['owner_info'] = $this->Land_model->getowner_info();

		$recepient = $this->session->userdata('user_id');
		$data['all_notifications'] = $this->Notification_model->get_notif_per_user($recepient);
		$data['all_notification_no'] = $this->Notification_model->get_all_notification_no($recepient);

		$data['pending_es'] = $this->Aspayment_model->get_pending_es_aspayment();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$data['disap_es'] = $this->Aspayment_model->get_disapproved_es_aspayment();
		$data['disap_js'] = $this->Aspayment_model->get_disapproved_js_aspayment();
		$data['app_es'] = $this->Aspayment_model->get_approved_es_aspayment();
		$data['app_js'] = $this->Aspayment_model->get_approved_js_aspayment();


		$this->form_validation->set_rules('js_no', 'LAPF-JS No.', 'required|callback_check_jsno_old');
		$this->form_validation->set_rules('date', 'Date', 'required|callback_checkDateFormat');
		$this->form_validation->set_rules('case_type', 'Case Type', 'required|in_list[Small claim case,Collection of Sum Money]');
		$this->form_validation->set_rules('business_unit', 'Business Unit', 'required|regex_match[/^[a-zA-Z -]+$/]|max_length[60]');
		$this->form_validation->set_rules('cfname', 'firstname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the customer is required!'));
		$this->form_validation->set_rules('cmname', 'middlename', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the customer is required!'));
		$this->form_validation->set_rules('clname', 'lastname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the customer is required!'));
		$this->form_validation->set_rules('cstreet', 'Street', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[50]');
		$this->form_validation->set_rules('cbarangay', 'Barangay', 'required|max_length[50]');
		$this->form_validation->set_rules('ctown', 'Town', 'required|max_length[50]');
		$this->form_validation->set_rules('cprovince', 'Province', 'required|max_length[50]');
		$this->form_validation->set_rules('cregion', 'Region', 'required|max_length[50]');
		$this->form_validation->set_rules('lot_type', 'Lot Type', 'required|in_list[Agricultural,Commercial,Residential]');
		$this->form_validation->set_rules('lot', 'Lot No.', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[30]');
		$this->form_validation->set_rules('cad', 'Cad No.', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[30]');
		$this->form_validation->set_rules('ofname', 'Firstname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the owner is required!'));
		$this->form_validation->set_rules('omname', 'Middlename', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the owner is required!'));
		$this->form_validation->set_rules('olname', 'Lastname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the owner is required!'));
		$this->form_validation->set_rules('vital_status', 'Vital Status', 'required|in_list[Alive,Deceased]');
		$this->form_validation->set_rules('status', 'Status', 'required|in_list[Paid,Pending]');
		$this->form_validation->set_rules('ostreet', 'Street', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[50]');
		$this->form_validation->set_rules('obarangay', 'Barangay', 'required|max_length[50]');
		$this->form_validation->set_rules('otown', 'Town', 'required|max_length[50]');
		$this->form_validation->set_rules('oprovince', 'Province', 'required|max_length[50]');
		$this->form_validation->set_rules('oregion', 'Region', 'required|max_length[50]');
		$this->form_validation->set_rules('ozipcode', 'Zipcode', 'required|exact_length[4]|numeric');
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
			$data['judicial'] = $this->Land_model->get_js_old();
			$this->render_template('legal/js_land_info', $data);
		} else { //success
			$area = $this->input->post('lot_size');
			$price = $this->input->post('bid_price');

			$lot_area = str_replace(',', '', $area);
			$bid_p = str_replace(',', '', $price);
			$bal = "";
			$case = $this->input->post('case_type');

			$fno = $this->input->post('js_no');
			$ftype = "LAPF-JS";
			$uid = $this->session->userdata('user_id');
			$this->Aspayment_model->insert_form_request($fno, $ftype, $uid);

			$stat = "Approved";
			$date_acq = $this->input->post('date');
			$tag = "Old LAPF-JS";
			$this->Aspayment_model->add_js_land_info($lot_area, $stat, $date_acq, $tag);

			$id = "";
			$this->Aspayment_model->add_customer_balance($bal, $case, $id);
			$this->Aspayment_model->add_customer_info($id);
			$this->Aspayment_model->add_customer_address($id);
			$this->Aspayment_model->add_owner_info();
			$this->Aspayment_model->add_lot_location();

			$this->Aspayment_model->add_tct();
			$this->Aspayment_model->add_oct();
			$this->Aspayment_model->add_bidding_details($bid_p);
			redirect('Legal_f/Aspayment/update_js_id/' . $this->input->post('js_no'));
		}

	}

	function check_jsno_new($str)
	{
		$row = $this->Land_model->getforms_byid($str);
		$format = substr($str, 0, 3);
		if ($format == "JS-") {
			$land_id = $this->Land_model->get_js_new();
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

	function check_jsno_old($str)
	{
		$row = $this->Land_model->getforms_byid($str);
		$format = substr($str, 0, 4);
		if ($format == "JSO-") {
			$land_id = $this->Land_model->get_js_old();
			foreach ($land_id as $li) {
				$is_id = substr($li['is_no'], 4) + 1;
			}
			$is_input = substr($str, 4); //from form
			if (empty($is_id)) {
				$is_id = 1; //means 1 by default
			}
			if (!ctype_digit($is_input)) { //check if transaction number is not alpa contain
				$this->form_validation->set_message('check_jsno_old', '' . $str . ' is not a valid transaction no.');
				return FALSE;
			}
			if ($is_id < $is_input) {
				$this->form_validation->set_message('check_jsno_old', '' . $str . ' is greater than the current transaction no.');
				return FALSE;
			} else {
				if ($is_id > $is_input) { //means zero
					$this->form_validation->set_message('check_jsno_old', '' . $str . ' is not valid.');
					return FALSE;
				}
				if (substr($row['form_no'], 4) == $is_input) { // the same with the form submitted
					$this->form_validation->set_message('check_jsno_old', 'The {field} cant be duplicated');
					return FALSE;
				} else {
					return TRUE;
				}
			}
		} else {
			$this->form_validation->set_message('check_jsno_old', ' ' . $str . ' is not a valid transaction no.');
			return FALSE;
		}

	}

	function check_currency($inp)
	{

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

	function check_zipcode($str)
	{

		if (!ctype_digit($str)) {
			$this->form_validation->set_message('check_zipcode', '{field} contains invalid character');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function checkDateFormat($date)
	{
		$dt = date_create($date);
		$conv_date = @date_format($dt, "Y-m-d");

		if (!$this->date_valid($date)) {
			$this->form_validation->set_message('checkDateFormat', '' . $date . ' is not a valid date format.');
			return FALSE;
		} else {
			if (date('Y-m-d') < $conv_date) {
				$this->form_validation->set_message('checkDateFormat', '' . $conv_date . ' is not a valid date.');
				return FALSE;
			}
			return TRUE;
		}
	}
	public function date_valid($str)
	{
		if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $str)) {
			$date_parts = explode('-', $str);
			if (count($date_parts) == 3) {
				$year = (int) $date_parts[0];
				$month = (int) $date_parts[1];
				$day = (int) $date_parts[2];
				return checkdate($month, $day, $year);
			}
		}
		return FALSE;
	}



	public function update_js_id($id)
	{
		$this->sess_legal();
		$cus = $this->Aspayment_model->getcustomer_byid($id);
		$this->Aspayment_model->update_custbal_id($cus['reference_id'], $cus['id']); //pass data
		$this->Aspayment_model->update_custadd_id($cus['reference_id'], $cus['id']); //pass data
		$this->session->set_flashdata('notif', 'Land as payment Judicial Settlement added successfully!');

		redirect('Legal_f/Registry/judicial/');
	}

	public function extrajudicial()
	{
		$this->sess_legal();
		$new_aspayment = $this->Land_model->getaspayment_es_new();
		$sess_id = $this->session->userdata('user_id');

		foreach ($new_aspayment as $key => $value) {
			$es = $this->Aspayment_model->getesupload_result($value['is_no']);
			$form = $this->Registry_model->getforms_byid($es['reference_id']);
			if ($sess_id == $form['user_id']) {
				$this->session->set_flashdata('notif', 'Proceed');
				redirect('Legal_f/Aspayment/es_customer_info/' . $es['reference_id']);
			}
		}

		$recepient = $this->session->userdata('user_id');
		$data['all_notifications'] = $this->Notification_model->get_notif_per_user($recepient);
		$data['all_notification_no'] = $this->Notification_model->get_all_notification_no($recepient);

		$data['pending_es'] = $this->Aspayment_model->get_pending_es_aspayment();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$data['disap_es'] = $this->Aspayment_model->get_disapproved_es_aspayment();
		$data['disap_js'] = $this->Aspayment_model->get_disapproved_js_aspayment();
		$data['app_es'] = $this->Aspayment_model->get_approved_es_aspayment();
		$data['app_js'] = $this->Aspayment_model->get_approved_js_aspayment();

		$this->form_validation->set_rules('es_no', 'LAPF-ES No.', 'required|callback_check_esno_old');
		$this->form_validation->set_rules('date', 'Date', 'required|callback_checkDateFormat');
		$this->form_validation->set_rules('lot_type', 'Lot Type', 'required|in_list[Agricultural,Commercial,Residential]');
		$this->form_validation->set_rules('lot', 'Lot No.', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[30]');
		$this->form_validation->set_rules('cad', 'Cad No.', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[30]');
		$this->form_validation->set_rules('ofname', 'Firstname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the owner is required!'));
		$this->form_validation->set_rules('omname', 'Middlename', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the owner is required!'));
		$this->form_validation->set_rules('olname', 'Lastname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the owner is required!'));
		$this->form_validation->set_rules('vital_status', 'Vital Status', 'required|in_list[Alive,Deceased]');
		$this->form_validation->set_rules('ostreet', 'Street', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[50]');
		$this->form_validation->set_rules('obarangay', 'Baranggay', 'required|max_length[50]');
		$this->form_validation->set_rules('otown', 'Municipality', 'required|max_length[50]');
		$this->form_validation->set_rules('oprovince', 'Province', 'required|max_length[50]');
		$this->form_validation->set_rules('ozipcode', 'Zipcode', 'required|exact_length[4]|numeric');
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

			$data['extra'] = $this->Land_model->get_es_old();
			$this->render_template('legal/es_land_info', $data);

		} else { //success post

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

			//$this->Aspayment_model->add_aspayment_es();							
			$this->Aspayment_model->add_owner_info();

			$fno = $this->input->post('es_no');
			$ftype = "LAPF-ES";
			$uid = $this->session->userdata('user_id');
			$this->Aspayment_model->insert_form_request($fno, $ftype, $uid);


			$date_acq = $this->input->post('date');
			$stat = "Processing";
			$tag = "Old LAPF-ES";

			$this->Aspayment_model->add_es_land_info($lot_area, $stat, $date_acq, $tag);
			$this->Aspayment_model->add_lot_location();
			$this->Aspayment_model->add_oct();
			$this->Aspayment_model->add_tct();
			$this->Aspayment_model->add_amount_basis($mv_tax, $neighbor_inq, $assessor, $banks, $final_value);
			$this->Aspayment_model->insert_esupload_id();
			$this->session->set_flashdata('notif', 'You may now proceed!');
			redirect('Legal_f/Registry/es_customer_info/' . $this->input->post('es_no'));

		}

	}

	function check_esno_new($str)
	{
		@$format = substr($str, 0, 3);
		if ($format == "ES-") {
			$row = $this->Land_model->getforms_byid($str);
			$land_id = $this->Land_model->get_es_new();
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

	function check_esno_old($str)
	{
		@$format = substr($str, 0, 4);
		if ($format == "ESO-") {
			$row = $this->Land_model->getforms_byid($str);
			$land_id = $this->Land_model->get_es_old();
			$is_input = substr($str, 4); //user input or default from form

			foreach ($land_id as $li) {
				$is_id = substr($li['is_no'], 4) + 1;
			}
			if (empty($is_id)) {
				$is_id = 1;
			}

			if (!ctype_digit($is_input)) { //check if transaction number is not alpa contain
				$this->form_validation->set_message('check_esno_old', '' . $str . ' is not a valid transaction no.');
				return FALSE;
			} elseif ($is_id < $is_input) {
				$this->form_validation->set_message('check_esno_old', '' . $str . ' is greater than the current transaction no.');
				return FALSE;
			} elseif ($is_id > $is_input) { //means zero
				$this->form_validation->set_message('check_esno_old', '' . $str . ' is not valid.');
				return FALSE;
			} elseif (substr($row['form_no'], 4) == $is_input) { // the same with the form submitted
				$this->form_validation->set_message('check_esno_old', 'The {field} cant be duplicated');
				return FALSE;
			} else {
				return TRUE;
			}
		} else {

			$this->form_validation->set_message('check_esno_old', ' ' . $str . ' is not a valid transaction no.');
			return FALSE;
		}
	}

	function check_oct()
	{

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

	function check_tct()
	{

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

	function check_doubtful_account()
	{

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

	function check_latest_soa()
	{

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

	function check_supporting_docs()
	{

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



	public function es_customer_info($id)
	{
		$this->sess_legal();
		if (empty($id)) {
			redirect();
		}

		$li = $this->Land_model->getli_byid($id);
		$es = $this->Aspayment_model->getesupload_result($id);
		$form = $this->Registry_model->getforms_byid($es['reference_id']);
		if ($this->session->userdata('user_id') !== $form['user_id']) {
			redirect('');
		} elseif (!$es['reference_id'] || $li['status'] !== "Processing") {
			redirect('');
		}

		$data['es_no'] = $id;
		$recepient = $this->session->userdata('user_id');
		$data['all_notifications'] = $this->Notification_model->get_notif_per_user($recepient);
		$data['all_notification_no'] = $this->Notification_model->get_all_notification_no($recepient);

		$data['pending_es'] = $this->Aspayment_model->get_pending_es_aspayment();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$data['disap_es'] = $this->Aspayment_model->get_disapproved_es_aspayment();
		$data['disap_js'] = $this->Aspayment_model->get_disapproved_js_aspayment();
		$data['app_es'] = $this->Aspayment_model->get_approved_es_aspayment();
		$data['app_js'] = $this->Aspayment_model->get_approved_js_aspayment();

		$this->form_validation->set_rules('balance_type', 'Balance Type', 'required|in_list[Bounced Check,Bad Account]');
		$this->form_validation->set_rules('business_unit', 'Business Unit', 'required|regex_match[/^[a-zA-Z -]+$/]|max_length[60]');
		$this->form_validation->set_rules('cfname', 'Firstname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the customer is required!'));
		$this->form_validation->set_rules('cmname', 'Middlename', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the customer is required!'));
		$this->form_validation->set_rules('clname', 'Lastname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the customer is required!'));
		$this->form_validation->set_rules('cstreet', 'Street', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[50]');
		$this->form_validation->set_rules('cbarangay', 'Baranggay', 'required|max_length[50]');
		$this->form_validation->set_rules('ctown', 'Town', 'required|max_length[50]');
		$this->form_validation->set_rules('cprovince', 'Province', 'required|max_length[50]');

		$this->form_validation->set_rules('doubtful_account', 'Turnover of doubtful account form', 'callback_check_doubtful_account');
		$this->form_validation->set_rules('latest_soa', 'Latest SOA', 'callback_check_latest_soa');
		$this->form_validation->set_rules('supporting_docs', 'Supporting Documents ', 'callback_check_supporting_docs');

		if ($this->form_validation->run() == FALSE) {

			$this->render_template('legal/es_customer_info', $data);

		} else { //success

			$bal = "";
			$case = "";
			$bal = $this->input->post('balance_type');
			$this->Aspayment_model->add_customer_balance($bal, $case, $id);
			$this->Aspayment_model->add_customer_info($id);
			$this->Aspayment_model->add_customer_address($id);
			$this->Aspayment_model->add_es_uploads($id);

			$stat = "Approved";
			$this->Aspayment_model->update_land_info_status($id, $stat);

			redirect('Legal_f/Aspayment/update_es_id/' . $id);
		}

	}

	function sample($bal_type)
	{
		return $bal_type;
	}


	public function update_es_id($id)
	{

		$this->sess_legal();
		$cus = $this->Aspayment_model->getcustomer_byid($id);

		$this->Aspayment_model->update_custbal_id($cus['reference_id'], $cus['id']); //pass data
		$this->Aspayment_model->update_custadd_id($cus['reference_id'], $cus['id']); //pass data
		if ($this->session->userdata('user_type') == "CCD") {
			$this->session->set_flashdata('notif', 'Request has been sent and waiting for its Approval');
			redirect('Legal_f/Aspayment/extrajudicial');
		} else {
			$this->session->set_flashdata('notif', 'Land as payment Extrajudicial Settlement added successfully!');
			redirect('Legal_f/Registry/extrajudicial');
		}


	}


	public function cancel_es_entry($es_no)
	{

		$this->sess_legal();

		if (isset($_POST['es_cancel'])) {
			if (empty($es_no)) {
				redirect('');
			}

			$li = $this->Land_model->getli_byid($es_no);
			$es = $this->Aspayment_model->getesupload_result($es_no);
			$form = $this->Registry_model->getforms_byid($es['reference_id']);
			if ($this->session->userdata('user_id') !== $form['user_id']) {
				redirect('');
			} elseif (!$es['reference_id'] || $li['status'] !== "Processing") {
				redirect('');
			}

			//deleting previous image
			//call our function
			$path = 'assets/img/uploaded_documents/' . $es_no;
			$this->deleteAll($path);
			//end deleting
			$this->Aspayment_model->delete_land_info($es_no);
			$this->Aspayment_model->delete_lot_location($es_no);
			$this->Aspayment_model->delete_owner_info($es_no);
			$this->Aspayment_model->delete_upload_docs($es_no);
			$this->Aspayment_model->delete_es_upload($es_no);
			// $this->Aspayment_model->delete_es_aspayment($es_no);
			$this->Aspayment_model->delete_amount_basis($es_no);
			$this->Aspayment_model->delete_form($es_no);
			$this->session->set_flashdata('notif', 'Extrajudicial Settlement entry has been cancelled successfully!');
			
			redirect('Legal_f/Registry/extrajudicial');
			
		} else {
			redirect();
		}
	}

	public function deleteAll($str)
	{
		//It it's a file.
		if (is_file($str)) {
			//Attempt to delete it.
			return unlink($str);
		}
		//If it's a directory.
		elseif (is_dir($str)) {
			//Get a list of the files in this directory.
			$scan = glob(rtrim($str, '/') . '/*');
			//Loop through the list of files.
			foreach ($scan as $index => $path) {
				//Call our recursive function.
				$this->deleteAll($path);
			}
			//Remove the directory itself.
			return @rmdir($str);
		}
	}


	public function view_js($id)
	{

		$this->sess_legal();

		// check if the uri id is valid===================================
		$li = $this->Land_model->getli_byid($id);
		if ($li['tag'] !== "New LAPF-JS" || empty($id)) {
			redirect('');
		}

		// check if the uri id is valid===================================

		$data['pending_es'] = $this->Aspayment_model->get_pending_es_aspayment();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$data['disap_es'] = $this->Aspayment_model->get_disapproved_es_aspayment();
		$data['disap_js'] = $this->Aspayment_model->get_disapproved_js_aspayment();
		$data['li'] = $this->Land_model->getli_byid($id);
		$data['oi'] = $this->Land_model->getoi_byid($id);
		$data['ll'] = $this->Land_model->getll_byid($id);
		$data['ud'] = $this->Land_model->getud_byid($id);
		$data['bd'] = $this->Aspayment_model->getbidding_byid($id);
		$data['ci'] = $this->Aspayment_model->getcustomer_byid($id);
		$ci = $this->Aspayment_model->getcustomer_byid($id);
		$data['cbal'] = $this->Aspayment_model->getcusbalinf_byid($ci['id']);
		$data['cadd'] = $this->Aspayment_model->getcusaddr_byid($ci['id']);
		$data['li_approved'] = $this->Land_model->getli_status_approved();
		$data['li_disapproved'] = $this->Land_model->getli_status_disapproved();
		$data['li_pending'] = $this->Land_model->getli_status_pending();
		// $data['pending_payment_requests']= $this->Payment_model->getnum_pending_payment_requests();
		$data['pending_rcp'] = $this->Payment_model->getpending_rcp_numrows();
		$data['pending_payment_requests'] = $this->GM_model->getnum_pending_payment_requests();
		$data['approved_payment_requests'] = $this->GM_model->getnum_payment_approved();
		$data['disapproved_payment_requests'] = $this->GM_model->getnum_payment_disapproved();
		$data['payed_payment_requests'] = $this->GM_model->getnum_payment_payed();
		$data['ud_pending'] = $this->GM_model->getud_status_pending();
		$this->render_template('legal/judicial_new', $data);

	}

	public function judicial_request()
	{
	  $this->sess_legal();
  
	  $data['title'] = "Land as payment";
	  $data['li_approved'] = $this->Land_model->getli_status_approved();
	  $data['li_disapproved'] = $this->Land_model->getli_status_disapproved();
	  $data['li_pending'] = $this->Land_model->getli_status_pending();
	 
	  $data['pending_rcp'] = $this->Payment_model->getpending_rcp_numrows();
	//   $data['pending_es'] = $this->Aspayment_model->get_pending_es_aspayment();
	//   $data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
	//   $data['disap_es'] = $this->Aspayment_model->get_disapproved_es_aspayment();
	//   $data['disap_js'] = $this->Aspayment_model->get_disapproved_js_aspayment();
		$data['pending_es'] = $this->Aspayment_model->get_pending_es_aspayment();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$data['disap_es'] = $this->Aspayment_model->get_disapproved_es_aspayment();
		$data['disap_js'] = $this->Aspayment_model->get_disapproved_js_aspayment();
		$data['app_es'] = $this->Aspayment_model->get_approved_es_aspayment();
		$data['app_js'] = $this->Aspayment_model->get_approved_js_aspayment();
	 
	  $data['js_aspayment'] = $this->Aspayment_model->get_judicial_requests('Pending');
	  $data['pending_payment_requests'] = $this->GM_model->getnum_pending_payment_requests();
	  $data['approved_payment_requests'] = $this->GM_model->getnum_payment_approved();
	  $data['disapproved_payment_requests'] = $this->GM_model->getnum_payment_disapproved();
	  $data['payed_payment_requests'] = $this->GM_model->getnum_payment_payed();
	  $data['ud_pending'] = $this->GM_model->getud_status_pending();
	  $this->render_template('legal/judicial_request/pending_judicial', $data);
	}
	public function approved_judicial_request()
	{
	  $this->sess_legal();
  
	  $data['title'] = "Land as payment";
	  $data['li_approved'] = $this->Land_model->getli_status_approved();
	  $data['li_disapproved'] = $this->Land_model->getli_status_disapproved();
	  $data['li_pending'] = $this->Land_model->getli_status_pending();
	 
	//   $data['pending_rcp'] = $this->Payment_model->getpending_rcp_numrows();
	//   $data['pending_es'] = $this->Aspayment_model->get_pending_es_aspayment();
	//   $data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
	//   $data['disap_es'] = $this->Aspayment_model->get_disapproved_es_aspayment();
	//   $data['disap_js'] = $this->Aspayment_model->get_disapproved_js_aspayment();
	$data['pending_es'] = $this->Aspayment_model->get_pending_es_aspayment();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$data['disap_es'] = $this->Aspayment_model->get_disapproved_es_aspayment();
		$data['disap_js'] = $this->Aspayment_model->get_disapproved_js_aspayment();
		$data['app_es'] = $this->Aspayment_model->get_approved_es_aspayment();
		$data['app_js'] = $this->Aspayment_model->get_approved_js_aspayment();
		
	  $data['js_aspayment'] = $this->Aspayment_model->get_judicial_requests('Approved');
	  $data['pending_payment_requests'] = $this->GM_model->getnum_pending_payment_requests();
	  $data['approved_payment_requests'] = $this->GM_model->getnum_payment_approved();
	  $data['disapproved_payment_requests'] = $this->GM_model->getnum_payment_disapproved();
	  $data['payed_payment_requests'] = $this->GM_model->getnum_payment_payed();
	  $data['ud_pending'] = $this->GM_model->getud_status_pending();
	  $this->render_template('legal/judicial_request/approved_judicial', $data);
	}
	public function disapproved_judicial_request()
	{
	  $this->sess_legal();
  
	  $data['title'] = "Land as payment";
	  $data['li_approved'] = $this->Land_model->getli_status_approved();
	  $data['li_disapproved'] = $this->Land_model->getli_status_disapproved();
	  $data['li_pending'] = $this->Land_model->getli_status_pending();
	 
	//   $data['pending_rcp'] = $this->Payment_model->getpending_rcp_numrows();
	//   $data['pending_es'] = $this->Aspayment_model->get_pending_es_aspayment();
	//   $data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
	//   $data['disap_es'] = $this->Aspayment_model->get_disapproved_es_aspayment();
	//   $data['disap_js'] = $this->Aspayment_model->get_disapproved_js_aspayment();
	  $data['pending_es'] = $this->Aspayment_model->get_pending_es_aspayment();
	$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
	$data['disap_es'] = $this->Aspayment_model->get_disapproved_es_aspayment();
	$data['disap_js'] = $this->Aspayment_model->get_disapproved_js_aspayment();
	$data['app_es'] = $this->Aspayment_model->get_approved_es_aspayment();
	$data['app_es'] = $this->Aspayment_model->get_approved_es_aspayment();
	$data['app_js'] = $this->Aspayment_model->get_approved_js_aspayment();

	  $data['js_aspayment'] = $this->Aspayment_model->get_judicial_requests('Disapproved');
	  $data['pending_payment_requests'] = $this->GM_model->getnum_pending_payment_requests();
	  $data['approved_payment_requests'] = $this->GM_model->getnum_payment_approved();
	  $data['disapproved_payment_requests'] = $this->GM_model->getnum_payment_disapproved();
	  $data['payed_payment_requests'] = $this->GM_model->getnum_payment_payed();
	  $data['ud_pending'] = $this->GM_model->getud_status_pending();
	  $this->render_template('legal/judicial_request/disapproved_judicial', $data);
	}

	
	public function approve_lapf_js($id)
	{
	  $this->sess_legal();
  
	  $li = $this->Land_model->getli_byid($id);
		
	  if ($this->session->flashdata('approved') == "") {
  
		if ($li['tag'] !== "New LAPF-JS" || $li['status'] !== "Pending" || empty($id) || empty($li['status'])) {
  
		  $this->session->set_flashdata('approved', 'no');
		} else {
  
		  $this->session->set_flashdata('approved', 'yes');
		}
  
	  } elseif ($this->session->flashdata('approved') == "no") {
  
		redirect();
	  } else {
		$name = $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname');
		$data = $this->Aspayment_model->getform_req_byid($id,$name);
		$action = "approved";
  
		$this->Aspayment_model->approve_aspayment($id,$name);
		$this->Notification_model->notify_user($data['form_type'], $id, $action, $data['user_id']);
  
		$this->session->set_flashdata('notif', 'Judicial Settlement approved succesfully!');
		redirect('Legal_f/Aspayment/judicial_request');
	  }
  
	}
  
  
  
	public function disapprove_lapf_js($id)
	{
	  $this->sess_legal();
  
	  $li = $this->Land_model->getli_byid($id);
  
	  if ($this->session->flashdata('disapproved') == "") {
  
		if ($li['tag'] !== "New LAPF-JS" || $li['status'] !== "Pending" || empty($id) || empty($li['status'])) {
  
		  $this->session->set_flashdata('disapproved', 'no');
		} else {
  
		  $this->session->set_flashdata('disapproved', 'yes');
		}
  
	  } elseif ($this->session->flashdata('disapproved') == "no") {
  
		redirect();
	  } else {
  
		$data = $this->Aspayment_model->getform_req_byid($id);
		$action = "disapproved";
		$name = $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname');
		$this->Aspayment_model->disapprove_aspayment($id,$name);
		$this->Notification_model->notify_user($data['form_type'], $id, $action, $data['user_id']);
  
		$this->session->set_flashdata('notif', 'Judicial Settlement disapproved succesfully!');
		redirect('Legal_f/Aspayment/judicial_request');

	  }
	}

	public function fetch_judicial_request(){
		$this->sess_legal();
		$status =  $this->input->post('status');
		$fetch_data = $this->Aspayment_model->get_judicial_request($status);
		foreach($fetch_data as $row){

		}
	}



}