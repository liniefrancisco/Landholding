<?php
class Registry extends App_Controller {

	public function __construct() {
		parent::__construct();
		$this->not_logged_in();
		// Load the model
		$this->load->model('Acquisition_model');
		$this->load->model('Aspayment_model');
		$this->load->model('Registry_model');
		$this->load->model('Payment_model');
		$this->load->model('Land_model');
		$this->load->model('Legal_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('string');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('security');
	}



	public function add_land() {
		$this->sess_legal();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['land_id'] = $this->Land_model->getland_old();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$count = $this->Land_model->geli_rows();
		$old = $this->Land_model->getland_old();
		$oi = null;
		$ud = null;
		$sess_id = $this->session->userdata('user_id');

		foreach($old as $o) {
			$oi = $this->Land_model->getowners_byid($o['is_no']);
			$form = $this->Registry_model->getforms_byid($oi['is_no']);

			if($form['user_id'] == $sess_id) {
				if($oi['firstname'] == null) {
					redirect('Legal_f/Registry/owners_info/'.$oi['is_no']);
				}
			}
		}

		if($count == 0 || $count != 0) {
			if(isset($_POST['submit_land_reg'])) {
				if(date('Y-m-d') < $this->input->post('date_acquired') || date('Y-m-d') < $this->input->post('date_approved')) {

					$this->session->set_flashdata('error', 'Date selected is invalid!');
					redirect('Legal_f/Registry/add_land');

				}
				// elseif($this->input->post('date_acquired') > $this->input->post('date_approved')){
				// 	$this->session->set_flashdata('error','Date range is invalid!');
				// 	redirect('Registry/add_land');
				// }
			}

			/*rian comment*/
			$this->form_validation->set_rules('is_no', 'I.S No.', 'required|callback_check_isno');
			$this->form_validation->set_rules('date_acquired', 'Date Acquired', 'trim|required|callback_checkDateFormat');
			// $this->form_validation->set_rules('date_approved', 'Date Approved', 'trim|required|callback_checkDateFormat');
			$this->form_validation->set_rules('lot_type', 'lot type', 'trim|required|in_list[Agricultural,Commercial,Residential]');
			$this->form_validation->set_rules('lot', 'lot no.', 'required|regex_match[/^[a-zA-Z0-9-]+$/]|max_length[30]');
			$this->form_validation->set_rules('cad', 'cad no.', 'required|regex_match[/^[a-zA-Z0-9-]+$/]|max_length[30]');
			// $this->form_validation->set_rules('title_no', 'title no.', 'required|regex_match[/^[a-zA-Z0-9-]+$/]|max_length[50]');
			$this->form_validation->set_rules('tax_no', 'tax no.', 'required|regex_match[/^[a-zA-Z0-9-]+$/]|max_length[50]');
			$this->form_validation->set_rules('street', 'street', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[50]');
			// $this->form_validation->set_rules('baranggay', 'baranggay', 'trim|required|regex_match[/^[a-zA-Z ]+$/]|max_length[50]');
			// $this->form_validation->set_rules('municipality', 'municipality', 'trim|required|regex_match[/^[a-zA-Z ]+$/]|max_length[50]');
			$this->form_validation->set_rules('zipcode', 'zip code', 'required|exact_length[4]|numeric');
			// $this->form_validation->set_rules('province', 'province', 'trim|required|regex_match[/^[a-zA-Z ]+$/]|max_length[50]');
			// $this->form_validation->set_rules('country', 'country', 'trim|required|regex_match[/^[a-zA-Z ]+$/]|max_length[50]');
			$this->form_validation->set_rules('lot_sold', 'lot sold', 'trim|required|in_list[Portion,Whole]');
			$this->form_validation->set_rules('purchase_type', 'purchase type', 'trim|required|in_list[package,per/sq.m.]');
			$this->form_validation->set_rules('lot_area', 'lot area', 'trim|required|callback_check_currency');
			if(@$_POST['purchase_type'] == 'per/sq.m.') {
				$this->form_validation->set_rules('selling_price', 'selling price', 'required|callback_check_currency');
			}
			$this->form_validation->set_rules('total_price', 'total price', 'required|callback_check_currency');
			$this->form_validation->set_rules('liens', 'liens', "regex_match[/^[a-zA-Z0-9 .,'-]+$/]|max_length[500]");
			$this->form_validation->set_rules('easement', 'easement', "regex_match[/^[a-zA-Z0-9 .,'-]+$/]|max_length[500]");
			$this->form_validation->set_rules('encumbrances', 'encumbrances', "regex_match[/^[a-zA-Z0-9 .,'-]+$/]|max_length[500]");

			if($this->form_validation->run() == FALSE) {

				$this->render_template('legal/add_land', $data);

			} else { //success ==========================================================
				$area = $this->input->post('lot_area');
				$price = $this->input->post('selling_price');
				$total = $this->input->post('total_price');

				$lot_area = str_replace(',', '', $area);
				$selling_price = str_replace(',', '', $price);
				$total_price = str_replace(',', '', $total);

				$fno = $this->input->post('is_no');
				$ftype = "IS";
				$uid = $this->session->userdata('user_id');
				$this->Aspayment_model->insert_form_request($fno, $ftype, $uid);

				$this->Registry_model->add_land_registry($lot_area, $selling_price, $total_price);
				$this->Registry_model->add_lot_location();
				if(empty($this->input->post('liens')) && empty($this->input->post('easement')) && empty($this->input->post('encumbrances'))) {

				} else {
					$this->Registry_model->add_lot_restriction();
				}
				$this->Registry_model->add_owner_info();
				$this->session->set_flashdata('notif', 'Land Information has been saved!. You can now proceed');
				$id = $this->input->post('is_no');
				redirect('Legal_f/Registry/owners_info/'.$id);

			}
		}

	}

	public function check_isno($str) {
		$format = substr($str, 0, 3);
		if($format == "OA-") {
			$row = $this->Land_model->getforms_byid($str);
			$land_id = $this->Land_model->getland_old();

			$is_id = 1;
			foreach($land_id as $li) {
				$is_id = substr($li['is_no'], 3) + 1;
			}
			$is_input = substr($str, 3);
			if(!ctype_digit($is_input)) { //check if transaction number is no alpa contain
				$this->form_validation->set_message('check_isno', ''.$str.' is not a valid transaction no.');
				return FALSE;
			}

			if($is_id < $is_input) { //check if current transaction no. is lesser than the submitted no.
				$this->form_validation->set_message('check_isno', ''.$str.' is greater than the current transaction no.');
				return FALSE;
			} else {
				if(substr($row['form_no'], 3) == $is_input) { //check if submitted no. is the same with the submitted no.
					$this->form_validation->set_message('check_isno', 'The {field} cant be duplicated');
					return FALSE;
				} elseif($is_id > $is_input) { //if transaction no. is lesser than 1 then it was invalid.
					$this->form_validation->set_message('check_isno', ''.$str.' is not valid.');
					return FALSE;
				} else {
					return TRUE;
				}
			}
		} else {

			$this->form_validation->set_message('check_isno', ' '.$str.' is not  valid');
			return FALSE;
		}
	}

	function check_zipcode($str) {

		if(!ctype_digit($str)) {
			$this->form_validation->set_message('check_zipcode', '{field} contains invalid character');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function check_currency($inp) {

		$amount = str_replace(',', '', $inp);

		if(!preg_match('/^\d+(\.\d{2})?$/', $amount)) {
			$this->form_validation->set_message('check_currency', '{field} is invalid.');
			return FALSE;
		} else {

			if($amount == 0.00) {
				$this->form_validation->set_message('check_currency', '{field} cannot be zero value.');
				return FALSE;
			} else {
				return TRUE;
			}
		}

	}

	function checkDateFormat($date) {
		$d = DateTime::createFromFormat('Y-m-d', $date);
		if(($d && $d->format('Y-m-d') === $date) === FALSE) {
			$this->form_validation->set_message('checkDateFormat', ''.$date.' is not a valid date format.');
			return FALSE;
		} else {
			return TRUE;
		}
	}


	public function owners_info($id) {
		$this->sess_legal();

		if(empty($id)) { // check if id is empty
			redirect('Legal_f/Registry/add_land');
		}

		$li = $this->Land_model->getli_byid($id);
		$oi = $this->Land_model->getowners_byid($li['is_no']);
		$form = $this->Registry_model->getforms_byid($oi['is_no']);
		if($form['user_id'] !== $this->session->userdata('user_id')) {
			redirect('Legal_f/Registry/add_land');
		}
		if($li['status'] !== "Processing" && $oi['firstname'] !== null && !empty($oi['is_no'])) {
			redirect('Legal_f/Registry/add_land');
		}


		$data['old'] = $this->Land_model->getland_old();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		/*rian comment*/
		$this->form_validation->set_rules('presentor', 'presentor', 'required');
		if($this->input->post('presentor') == "Broker") {
			$this->form_validation->set_rules('broker_first', 'firstname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the broker is required!'));
			$this->form_validation->set_rules('broker_middle', 'middlename', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the broker is required!'));
			$this->form_validation->set_rules('broker_last', 'lastname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the broker is required!'));
		}
		$this->form_validation->set_rules('firstname', 'first name', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the owner is required!'));
		$this->form_validation->set_rules('middlename', 'middle name', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the owner is required!'));
		$this->form_validation->set_rules('lastname', 'last name', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]', array('required' => '%s of the owner is required!'));
		$this->form_validation->set_rules('gender', 'gender', 'required|in_list[Male,Female]');
		$this->form_validation->set_rules('vital', 'vital status', 'required|in_list[Alive,Deceased]');
		$this->form_validation->set_rules('street', 'street', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[50]');
		// $this->form_validation->set_rules('baranggay', 'baranggay', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[50]');
		// $this->form_validation->set_rules('town', 'town', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[50]');
		// $this->form_validation->set_rules('province', 'province', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[50]');
		$this->form_validation->set_rules('zipcode', 'zip code', 'required|exact_length[4]|numeric');
		$this->form_validation->set_rules('fullname', 'fullname', 'min_length[4]|regex_match[/^[a-zA-Z ]+$/]|max_length[90]');
		$this->form_validation->set_rules('address', 'address', 'required|min_length[8]|regex_match[/^[a-zA-Z0-9 -,]+$/]|max_length[150]');
		$this->form_validation->set_rules('tel_no', 'telephone no.', 'regex_match[/^[0-9-]+$/]|max_length[30]');
		$this->form_validation->set_rules('phone_no', 'phone no.', 'required|exact_length[11]|numeric');
		$this->form_validation->set_rules('email', 'email', 'valid_email');

		if($this->form_validation->run() == FALSE) {

			$this->render_template('legal/owners_info', $data);

		} else {
			$fname = $this->input->post('fullname', TRUE);
			$addr = $this->input->post('address', TRUE);
			$tel_no = $this->input->post('tel_no', TRUE);
			$pno = $this->input->post('phone_no', TRUE);
			$email = $this->input->post('email', TRUE);

			$this->Registry_model->update_li_status($id);
			$this->Registry_model->add_owner_information($id);
			$this->Registry_model->add_owner_address($oi['id']);
			if($fname != '' || $addr != '' || $tel_no != '' || $pno != '' || $email != '') {
				$this->Registry_model->add_contact_person($oi['id']);
			}
			$name = $this->session->userdata('firstname').' '.$this->session->userdata('lastname');
			$this->Registry_model->add_broker_info($oi['id']);
			$this->Registry_model->add_uploaded_documents($id, $name);
			$this->session->set_flashdata('notif', 'You may now upload the documents.');
			redirect('Legal_f/Land/for_titling/'.$id);
		}



	}


	public function cancel_acq_owner_intf($is_no) {
		$this->sess_legal();

		if(isset($_POST['cancel_acq'])) {

			if(empty($is_no)) {
				redirect('');
			}
			$li = $this->Land_model->getli_byid($is_no);
			$oi = $this->Land_model->getowners_byid($li['is_no']);
			$form = $this->Registry_model->getforms_byid($oi['is_no']);
			if($form['user_id'] !== $this->session->userdata('user_id')) {
				redirect('');
			}

			if($li['status'] !== "Processing" && $oi['firstname'] !== null && !empty($oi['is_no'])) {
				redirect('');
			}
			$this->Acquisition_model->delete_land_info($is_no);
			$this->Acquisition_model->delete_lot_location($is_no);
			$this->Acquisition_model->delete_restriction($is_no);
			$this->Acquisition_model->delete_owner_info($is_no);
			$this->Aspayment_model->delete_form($is_no);

			$this->session->set_flashdata('notif', 'Adding Land Registry has been cancelled.');
			redirect('Legal_f/Registry/add_land');
		} else {
			redirect();
		}


	}


	public function judicial() {
		$this->sess_legal();

		$data['judicial'] = $this->Land_model->get_js_old();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/js_land_info', $data);

	}

	public function extrajudicial() {
		$this->sess_legal();

		$old_aspayment = $this->Land_model->getaspayment_es_old();
		$sess_id = $this->session->userdata('user_id');

		foreach($old_aspayment as $key => $value) {
			$es = $this->Aspayment_model->getesupload_result($value['is_no']);
			$form = $this->Registry_model->getforms_byid($es['reference_id']);
			if($sess_id == $form['user_id']) {
				redirect('Legal_f/Registry/es_customer_info/'.$es['reference_id']);
			}
		}
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['extra'] = $this->Land_model->get_es_old();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/es_land_info', $data);
	}

	public function es_customer_info($id) {
		$this->sess_legal();

		if(empty($id)) {
			redirect('Legal_f/Registry/extrajudicial');
		}
		$code = substr($id, 0, 3);
		$li = $this->Land_model->getli_byid($id);
		$es = $this->Aspayment_model->getesupload_result($id);
		$form = $this->Registry_model->getforms_byid($es['reference_id']);
		if($this->session->userdata('user_id') !== $form['user_id']) {
			redirect('Legal_f/Registry/extrajudicial');
		} elseif(!$es['reference_id'] || $li['status'] !== "Processing") {
			redirect('Legal_f/Registry/extrajudicial');
		} elseif($code !== "ESO") {
			redirect('Legal_f/Registry/extrajudicial');
		}

		$data['es_no'] = $id;
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/es_customer_info', $data);
	}

	public function update_owner_info($id) { //oi id

		$this->sess_legal();

		$oa = $this->Land_model->getoa_byid($id);
		$oi = $this->Land_model->getoi_id($id);
		$li = $this->Land_model->getli_byid($oi['is_no']);

		if(empty($li['status']) || $li['status'] !== 'Approved') {
			$data['error'] = "Invalid request!";
		}

		$this->form_validation->set_rules('firstname', 'Firstname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]');
		$this->form_validation->set_rules('middlename', 'Middlename', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]');
		$this->form_validation->set_rules('lastname', 'Lastname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[30]');
		$this->form_validation->set_rules('gender', 'Gender', 'required|in_list[Male,Female]');
		$this->form_validation->set_rules('vital', 'Vital Status', 'required|in_list[Alive,Deceased]');
		$this->form_validation->set_rules('street', 'Street', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[50]');
		// $this->form_validation->set_rules('baranggay', 'Baranggay', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[50]');
		// $this->form_validation->set_rules('town', 'Municipality', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[50]');
		// $this->form_validation->set_rules('province', 'Province', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[50]');

		if($this->form_validation->run() === TRUE) {
			if(empty($oa)) {
				$this->Registry_model->add_owner_address($id);
			} else {
				$this->Registry_model->update_owner_address($id);
			}
			$this->Registry_model->add_owner_information($oi['is_no']);
			$data['success'] = "successfully updated";
		} else {
			$data['error'] = validation_errors();
		}

		echo json_encode($data);
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function getregion() {
		$result = $this->Registry_model->get_tesdaregion();
		$output = [];
		$i = 0;
		foreach($result as $value) {
			$output[$i]['regDesc'] = $value->regDesc;
			$output[$i]['regCode'] = $value->regCode;
			$i++;
		}
		echo json_encode($output);
	}

	public function getprovince() {
		$regCode = $_POST['regCode'];
		$result = $this->Registry_model->get_tesdaprovince($regCode);
		$output = [];
		$i = 0;
		foreach($result as $value) {
			$output[$i]['provDesc'] = $value->provDesc;
			$output[$i]['provCode'] = $value->provCode;
			$i++;
		}
		echo json_encode($output);
	}
	public function getallprovince() {

		$result = $this->Registry_model->get_all_aprovince();
		$output = [];
		$i = 0;
		foreach($result as $value) {
			$output[$i]['provDesc'] = $value->provDesc;
			$output[$i]['provCode'] = $value->provCode;
			$i++;
		}
		echo json_encode($output);
	}

	public function getcitymun() {
		$provCode = $_POST['provCode'];
		$result = $this->Registry_model->get_tesdacitymun($provCode);
		$output = [];
		$i = 0;

		foreach($result as $value) {
			$output[$i]['citymunDesc'] = $value->citymunDesc;
			$output[$i]['citymunCode'] = $value->citymunCode;
			$output[$i]['zipcode'] = $value->zipcode;
			$i++;
		}
		echo json_encode($output);
	}

	public function getbrgy() {
		$citymunCode = $_POST['citymunCode'];
		$result = $this->Registry_model->get_tesdabrgy($citymunCode);
		$output = [];
		$i = 0;
		// var_dump('result',$result);
		foreach($result as $value) {
			$output[$i]['brgyDesc'] = $value->brgyDesc;
			$output[$i]['brgyCode'] = $value->brgyCode;
			$i++;
		}
		echo json_encode($output);
	}


	public function province() {
		$regCode = $_POST['regCode'];
		$result = $this->Registry_model->get_province($regCode);
		$output = [];
		$i = 0;
		foreach($result as $value) {
			$output[$i]['provDesc'] = $value->provDesc;
			$output[$i]['provCode'] = $value->provCode;
			$i++;
		}
		echo json_encode($output);
	}

	public function citymun() {
		$provCode = $_POST['provCode'];
		$result = $this->Registry_model->get_citymun($provCode);
		$output = [];
		$i = 0;
		foreach($result as $value) {
			$output[$i]['citymunDesc'] = $value->citymunDesc;
			$output[$i]['citymunCode'] = $value->citymunCode;
			$i++;
		}
		echo json_encode($output);
	}

	public function brgy() {
		$citymunCode = $_POST['citymunCode'];
		$result = $this->Registry_model->get_brgy($citymunCode);
		$output = [];
		$i = 0;
		foreach($result as $value) {
			$output[$i]['brgyDesc'] = $value->brgyDesc;
			$output[$i]['brgyCode'] = $value->brgyCode;
			$i++;
		}
		echo json_encode($output);
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function getregion1() {
		$result = $this->Registry_model->get_tesdaregion();
		$output = [];
		$i = 0;
		foreach($result as $value) {
			$output[$i]['regDesc'] = $value->regDesc;
			$output[$i]['regCode'] = $value->regCode;
			$i++;
		}
		echo json_encode($output);
	}

	public function getprovince1() {
		$regCode = $_POST['regCode'];
		$result = $this->Registry_model->get_tesdaprovince($regCode);
		$output = [];
		$i = 0;
		foreach($result as $value) {
			$output[$i]['provDesc'] = $value->provDesc;
			$output[$i]['provCode'] = $value->provCode;
			$i++;
		}
		echo json_encode($output);
	}

	public function getcitymun1() {
		$provCode = $_POST['provCode'];
		$result = $this->Registry_model->get_tesdacitymun($provCode);
		$output = [];
		$i = 0;
		foreach($result as $value) {
			$output[$i]['citymunDesc'] = $value->citymunDesc;
			$output[$i]['citymunCode'] = $value->citymunCode;
			$i++;
		}
		echo json_encode($output);
	}

	public function getbrgy1() {
		$citymunCode = $_POST['citymunCode'];
		$result = $this->Registry_model->get_tesdabrgy($citymunCode);
		$output = [];
		$i = 0;
		foreach($result as $value) {
			$output[$i]['brgyDesc'] = $value->brgyDesc;
			$output[$i]['brgyCode'] = $value->brgyCode;
			$i++;
		}
		echo json_encode($output);
	}


	public function province1() {
		$regCode = $_POST['regCode'];
		$result = $this->Registry_model->get_province($regCode);
		$output = [];
		$i = 0;
		foreach($result as $value) {
			$output[$i]['provDesc'] = $value->provDesc;
			$output[$i]['provCode'] = $value->provCode;
			$i++;
		}
		echo json_encode($output);
	}

	public function citymun1() {
		$provCode = $_POST['provCode'];
		$result = $this->Registry_model->get_citymun($provCode);
		$output = [];
		$i = 0;
		foreach($result as $value) {
			$output[$i]['citymunDesc'] = $value->citymunDesc;
			$output[$i]['citymunCode'] = $value->citymunCode;
			$i++;
		}
		echo json_encode($output);
	}

	public function brgy1() {
		$citymunCode = $_POST['citymunCode'];
		$result = $this->Registry_model->get_brgy($citymunCode);
		$output = [];
		$i = 0;
		foreach($result as $value) {
			$output[$i]['brgyDesc'] = $value->brgyDesc;
			$output[$i]['brgyCode'] = $value->brgyCode;
			$i++;
		}
		echo json_encode($output);
	}







}