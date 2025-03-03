<?php
class Tax_payment extends App_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
		// Load the model
		$this->load->model('Land_model');
		$this->load->model('Legal_model');
		$this->load->model('Upload_model');
		$this->load->model('Tax_payment_model');
		$this->load->model('DataTables');
		$this->load->model('Rpt_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function index()
	{
		$this->sess_legal();

		$data['title'] = "Real Property Tax";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/tax_computation/old_aquisition', $data);
	}
	public function new_acquisition()
	{
		$this->sess_legal();

		$data['title'] = "Real Property Tax";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/tax_computation/new_aquisition', $data);
	}
	public function new_judicial()
	{
		$this->sess_legal();

		$data['title'] = "Real Property Tax";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/tax_computation/new_judicial', $data);
	}
	public function old_judicial()
	{
		$this->sess_legal();

		$data['title'] = "Real Property Tax";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/tax_computation/old_judicial', $data);
	}
	public function new_extrajudicial()
	{
		$this->sess_legal();

		$data['title'] = "Real Property Tax";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/tax_computation/new_extrajudicial', $data);
	}
	public function old_extrajudicial()
	{
		$this->sess_legal();

		$data['title'] = "Real Property Tax";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/tax_computation/old_extrajudicial', $data);
	}

	function get_rpt_Lists()
	{
		$data = array();

		// Fetch titling's records
		$all_info = $this->DataTables->getRows($_POST);

		foreach ($all_info as $ai) {

			$address = ucfirst($ai->street) . ', ' . substr(ucfirst($ai->baranggay), 10) . ', ' . substr(ucfirst($ai->municipality), 7) . ', ' . substr(ucfirst($ai->province), 5);
			$action = '<center>
		                            	<a href=" ' . base_url('rpt/upload_rpt/' . $ai->is_no) . ' " class="btn btn-primary"><i class="glyphicon glyphicon-folder-open"></i> Select</a>
		                           </center>';
			$data[] = array($ai->is_no, $ai->tax_dec_no, $ai->lot_type, $address, $action);
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->DataTables->countAll(),
			"recordsFiltered" => $this->DataTables->countFiltered($_POST),
			"data" => $data,
		);

		// Output to JSON format
		echo json_encode($output);
	}

	public function upload_rpt($is_no)
	{
		$this->sess_legal();

		$li = $this->Land_model->getli_byid($is_no);
		if (empty($li['status']) || $li['status'] !== "Approved" || empty($is_no)) {
			redirect('Legal_f/rpt');
		}
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['li'] = $this->Land_model->getli_byid($is_no);
		$data['ll'] = $this->Land_model->getll_byid($is_no);
		$data['ud'] = $this->Land_model->getud_byid($is_no);
		$data['aslvl'] = $this->Rpt_model->get_assessment($is_no);
		$aslvl = $this->Rpt_model->get_assessment($is_no);
		$data['asc_rpt'] = $this->Rpt_model->get_asc_paid_rpt($is_no);
		$data['paid_rpt_number'] = $this->Rpt_model->get_paid_num_rpt($is_no);
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		if (isset($_POST['add_asmnt_btn']) || isset($_POST['edit_asmnt_btn'])) {
			$this->form_validation->set_rules('ass_lvl', 'percentage.', 'required|callback_check_assmnt_lvl');
		} else {

			$this->form_validation->set_rules('rpt', 'Amount', 'required|callback_check_rpt_amount');
			$this->form_validation->set_rules('year_paid', 'Year Paid', 'required|callback_checkDateFormat');
			$this->form_validation->set_rules('file', 'RPT', 'callback_check_file');
		}

		if ($this->form_validation->run() == FALSE) {

			$this->render_template('legal/upload_rpt', $data);

		} else { //success posts
			if (isset($_POST['add_asmnt_btn'])) { // add assessment
				$this->Rpt_model->add_assessment($is_no);
				$this->session->set_flashdata('notif', 'Assessment Level set up successfully! you can now upload the RPT file.');
				redirect('Legal_f/rpt/upload_rpt/' . $is_no);
			} elseif (isset($_POST['edit_asmnt_btn'])) {
				$this->Rpt_model->edit_assessment_level($is_no);
				$this->session->set_flashdata('notif', 'Assessment Level set up successfully! you can now upload the RPT file.');
				redirect('Legal_f/rpt/upload_rpt/' . $is_no);
			} else {
				$li = $this->Land_model->getli_byid($is_no);
				$date_acq = new DateTime($li['date_acquired']);

				if ($date_acq->format('Y-m-d') > $this->input->post('year_paid')) { //check if year paid is lesser than the year acquistion
					$this->session->set_flashdata('notif', 'Date selected is invalid!');
					redirect('Legal_f/rpt/upload_rpt/' . $is_no);
				}

				$paid_rpt = $this->Rpt_model->get_paid_rpt($is_no);
				foreach ($paid_rpt as $paid) {

					$db_date = new DateTime($paid['year_paid']);
					$dates_db[] = $db_date->format('Y');
				}

				$datesss = implode(" ", $dates_db);
				$final = explode(" ", $datesss);

				$input_dates = new DateTime($this->input->post('year_paid'));
				$date_input = $input_dates->format('Y');

				if (in_array($date_input, $final)) {
					$this->session->set_flashdata('notif', 'The year you have selected has been already paid!');
					redirect('rpt/upload_rpt/' . $is_no);
				} else {
					$post_amount = $this->input->post('rpt');
					$amount = str_replace(',', '', $post_amount);

					$this->Rpt_model->upload_payed_rpt($is_no, $amount, $aslvl['percentage']);
					$this->session->set_flashdata('notif', 'RPT file uploaded successfully!');
					redirect('rpt/upload_rpt/' . $is_no);
				}
			}
		}

	}

	public function view_history()
	{
		$is_no = $this->input->post('is_no');
		$year_paid = $this->input->post('year');
		$rpt_result = $this->Rpt_model->get_rpt_info($is_no, $year_paid);
		$land_result = $this->Legal_model->getli_byid($is_no);
		$data = [];

		if (isset($rpt_result) && isset($land_result)) {
			$data = [
				'status' => 'success',
				'is_no' => $rpt_result['is_no'],
				'year_paid' => $rpt_result['year_paid'],
				'date_acquired' => $land_result['date_acquired'],
				'rpt_file' => $rpt_result['rpt_file'],
				'aslvl' => $rpt_result['aslvl'],
				'amount' => $rpt_result['amount']
			];
		} else {
			$data = ['status' => 'error'];
		}
		echo json_encode($data);
	}


	function check_assmnt_lvl($str)
	{
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

	function date_valid($str)
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

	function checkDateFormat($date)
	{

		if (!$this->date_valid($date)) {
			$this->form_validation->set_message('checkDateFormat', '' . $date . '' . ' is not a valid date.');
			return FALSE;
		} else {
			//   	$dt = date_create($date);
			// $conv_date = date_format($d,"Y-m-d");
			$current_date = date('Y-m-d');
			if ($date >$current_date) {
				$this->form_validation->set_message('checkDateFormat', '' . $date . ' is not a valid date.');
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}


	function check_rpt_amount($inp)
	{

		$amount = str_replace(',', '', $inp);

		if (!preg_match('/^\d+(\.\d{2})?$/', $amount)) {
			$this->form_validation->set_message('check_rpt_amount', '{field} is invalid.');
			return FALSE;
		} else {

			if ($amount == 0.00) {
				$this->form_validation->set_message('check_rpt_amount', '{field} cannot be zero value.');
				return FALSE;
			} else {
				return TRUE;
			}
		}

	}

	function check_file()
	{

		$allowed = array('gif', 'png', 'jpg', 'jpeg');
		$filename = $_FILES['file']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);

		if (empty($filename)) {
			$this->form_validation->set_message('check_file', 'The %s file is required!');
			return FALSE;
		} else {

			if (strlen($filename) > 200) {
				$this->form_validation->set_message('check_file', 'rename your %s file, it exceeds the maximum no. of string which is 200');
				return FALSE;
			} elseif (!in_array(strtolower($ext), $allowed)) { //not in array
				$this->form_validation->set_message('check_file', 'your %s  is not a valid file format');
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}

	function fetch_acquisition_info($type)
	{
		$this->security->get_csrf_hash();
		$post = $this->input->post();
		$tag = $this->input->post('tag');
		// var_dump('search', $_POST['search']['value']);
		$list = $this->Tax_payment_model->get_datatables($post, $type, $tag);
		$filtered = $this->Tax_payment_model->count_filtered($post, $type, $tag);
		$count = $this->Tax_payment_model->count_all($type, $tag);
		$data = [];
		// var_dump($list);
		foreach ($list as $lot) {
			$row = [];

			$owner_fullname = ucfirst($lot['firstname']) . " " . ucfirst($lot['middlename']) . " " . ucfirst($lot['lastname']);
			$lot_address = $lot['region'] . ", " . $lot['province'] . ", " . $lot['municipality'] . ", " . $lot['baranggay'] . ", " . $lot['street'];
			$tax_computation = $this->Legal_model->get_all_tax_computation($lot['land_is_no']);
			if(empty($tax_computation)){
				$action = '<a href="' . base_url('Legal_f/Tax_payment/upload_tax_payment/' . $lot['land_is_no']) . '" class="btn btn-custom-primary" style="background-color: #0d2e56; border: 1px solid #0d2e56; border-radius: 8px; font-size: 12px;"><i class="fa fa-hand-o-right"></i> Select</a>';
			}else{
				$action = '<a href="' . base_url('Legal_f/Tax_payment/upload_tax_payment/' . $lot['land_is_no']) . '" class="btn btn-custom-primary" style="background-color: #0d2e56; border: 1px solid #0d2e56; border-radius: 8px; font-size: 12px;"><i class="fa fa-hand-o-right"></i> Select</a>';
				$action .= '<a href="' . base_url('Legal_f/Tax_payment/view_tax_computation/' . $lot['land_is_no']) . '" class="btn btn-custom-primary" style="background-color: #0d2e56; border: 1px solid #0d2e56; border-radius: 8px; font-size: 12px;"><i class="fa fa-eye"></i> View</a>';
			}

			$row[] = $lot['land_is_no'];
			$row[] = $owner_fullname;
			$row[] = $lot['tax_dec_no'];
			$row[] = $lot['lot_type'];
			$row[] = $lot_address;
			$row[] = $action;
			$data[] = $row;
		}

		$response = array(
			"draw" => $post['draw'],
			"recordsTotal" => $count,
			// Total records in your table
			"recordsFiltered" => $filtered,
			// Filtered records
			"data" => $data,
		);

		echo json_encode($response);
	}

	public function view_tax_computation($is_no){
		$this->sess_legal();
		$data['li'] = $this->Land_model->getli_byid($is_no);
		$data['ll'] = $this->Land_model->getll_byid($is_no);
		$data['ud'] = $this->Land_model->getud_byid($is_no);
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$tax_computation_history = $this->Legal_model->get_all_tax_computation($is_no);
		$data['tax_computation_history'] = $tax_computation_history;
		$data['is_no'] = $is_no;
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		// $file_name = !empty($tax_computation_history['computation_doc'])?$tax_computation_history['computation_doc']:'';
		$path = base_url()."assets/img/rpt/".$is_no."/tax_computation/";
		$data['file_path'] = $path;
		$this->render_template('legal/view_tax_payment', $data);
	}

	public function upload_tax_payment($is_no)
	{
		$this->sess_legal();
		$data['li'] = $this->Land_model->getli_byid($is_no);
		$data['ll'] = $this->Land_model->getll_byid($is_no);
		$data['ud'] = $this->Land_model->getud_byid($is_no);
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$due_date = $this->input->post('due_date');

		$this->form_validation->set_rules('due_date', 'Year Paid', 'required|callback_checkDateFormat');
		$this->form_validation->set_rules('file', 'RPT', 'callback_check_file');

		if ($this->form_validation->run() == FALSE) {
			$this->render_template('legal/upload_tax_payment', $data);

		} else { //success posts
			$tax_computation_history = $this->Legal_model->get_tax_computation($is_no);
			$dueYear = date('Y', strtotime($tax_computation_history['due_date']));

			if(!empty($tax_computation_history) && $dueYear ===  date('Y', strtotime($due_date))){
				$this->session->set_flashdata('tax_computation_error','You are already uploaded for this year.');
				redirect('Tax_payment/upload_tax_payment/'.$is_no);
			}else{
			
			$file = $this->input->post('file');
			if ($_FILES and $_FILES["file"]['name']):

					if (!file_exists('./assets/img/rpt/' . $is_no)):
						@mkdir('./assets/img/rpt/' . $is_no);
					endif;
		
					if (!file_exists('./assets/img/rpt/' . $is_no . '/tax_computation' )):
						@mkdir('./assets/img/rpt/' . $is_no . '/tax_computation' );
					endif;
		
					if (!file_exists('./assets/img/rpt/' . $is_no . '/tax_computation/'. $due_date)):
						@mkdir('./assets/img/rpt/' . $is_no . '/tax_computation/'. $due_date);
					endif;

					if (!file_exists('./assets/img/rpt/' . $is_no . '/tax_computation/'. $due_date.'/'. $file)):
						@mkdir('./assets/img/rpt/' . $is_no . '/tax_computation/'. $due_date.'/'. $file);
					endif;
		
					$targetPaths = getcwd() . '/assets/img/rpt/' . $is_no . '/tax_computation/'. $due_date.'/'. $file;
					$img = $this->upload_images($targetPaths, "file");
		
					if ($img === '') {
						$this->session->set_flashdata('tax_computation_error', 'Tax computation document file uploaded unsuccessful!');
						redirect('Legal_f/Tax_payment/upload_tax_payment/'.$is_no);
						// redirect('Tax_payment');
					}else {

						$tax_data = array(
							'is_no' => $is_no,
							'due_date' => $due_date,
							'computation_doc' => $img,
							'date_added' => date('Y-m-d'),
							'added_by' => $this->session->userdata('user_type'),
							'status' => "Not Paid",
						);

						$is_inserted = $this->Legal_model->insert_tax_computation($tax_data);

						if ($is_inserted) {
							$this->session->set_flashdata('tax_computation_success', 'Tax computation was successfully uploaded!');
							redirect('Legal_f/Tax_payment/upload_tax_payment/'.$is_no);
						} 
						// Close
					}
		

			endif;
			}

		}
		

	}

	public function upload_images($targetPaths, $image_name)
	{
		// $date = new DateTime();
		// $timeStamp = $date->getTimestamp();
		$filename = '';
	   
		$tmpFilePaths = $_FILES[$image_name]['tmp_name'];
			//Make sure we have a filepath
		if ($tmpFilePaths != "")
		{
			//Setup our new file path
			$filename =  $_FILES[$image_name]['name'];
			$newFilePath = $targetPaths . $filename;
			//Upload the file into the temp dir
			move_uploaded_file($tmpFilePaths, $newFilePath);
		}

		return $filename;
	}

}