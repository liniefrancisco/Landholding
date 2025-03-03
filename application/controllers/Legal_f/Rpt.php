<?php
class Rpt extends App_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
		// Load the model
		$this->load->model('Land_model');
		$this->load->model('Legal_model');
		$this->load->model('Upload_model');
		$this->load->model('DataTables');
		$this->load->model('Rpt_model');
		$this->load->model('Aspayment_model');
		$this->load->model('Tax_payment_model');
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
		$this->render_template('legal/rpt', $data);
	}
	public function rpt_acq_new()
	{
		$this->sess_legal();

		$data['title'] = "Real Property Tax";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/rpt/rpt_acq_new', $data);
	}
	public function rpt_extra_old()
	{
		$this->sess_legal();

		$data['title'] = "Real Property Tax";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/rpt/rpt_extra_old', $data);
	}
	public function rpt_extra_new()
	{
		$this->sess_legal();

		$data['title'] = "Real Property Tax";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/rpt/rpt_extra_new', $data);
	}
	public function rpt_judicial_old()
	{
		$this->sess_legal();

		$data['title'] = "Real Property Tax";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/rpt/rpt_judicial_old', $data);
	}
	public function rpt_judicial_new()
	{
		$this->sess_legal();

		$data['title'] = "Real Property Tax";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/rpt/rpt_judicial_new', $data);
	}

	public function fetch_rpt_datatable()
	{
		$this->security->get_csrf_hash();
		$post = $this->input->post();
		
		$list = $this->Tax_payment_model->get_rpt_datatables($post);
		$filtered = $this->Tax_payment_model->count_rpt_filtered($post);
		$count = $this->Tax_payment_model->count_all_rpt();
		
		$data = [];
		
		foreach ($list as $lot) {
			$row = [];

			$owner_fullname = ucfirst($lot['firstname']) . " " . ucfirst($lot['middlename']) . " " . ucfirst($lot['lastname']);
			$lot_address = $lot['region'] . ", " . $lot['province'] . ", " . $lot['municipality'] . ", " . $lot['baranggay'] . ", " . $lot['street'];
			$action = '<button class="btn btn-custom-primary" onclick="rpt_form(\'' . $lot['land_is_no'] . '\')" style="background-color: #0d2e56; border: 1px solid #0d2e56; border-radius: 8px; font-size: 12px;"><i class="fa fa-hand-o-right"></i> Select</button>';
			// $action = '<a href="' . base_url('Rpt/upload_rpt/' . $lot['land_is_no']) . '" class="btn btn-custom-primary" style="background-color: #0d2e56; border: 1px solid #0d2e56; border-radius: 8px; font-size: 12px;"><i class="fa fa-hand-o-right"></i> Select</a>';

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

	public function get_rpt_list(){
		$is_no = $this->input->post('is_no');
		$data = $this->Rpt_model->get_asc_paid_rpt($is_no);
		echo json_encode($data);
	}

	public function upload_rpt()
	{
		$this->sess_legal();
		$is_no = $this->input->post('is_no');
		$li = $this->Land_model->getli_byid($is_no);
		// if (empty($li['status']) || $li['status'] !== "Approved" || empty($is_no)) {
		// 	redirect('rpt');
		// }
		
		$data['li'] = $this->Land_model->getli_byid($is_no);
		$data['ll'] = $this->Land_model->getll_byid($is_no);
		$data['ud'] = $this->Land_model->getud_byid($is_no);
		$data['aslvl'] = $this->Rpt_model->get_assessment($is_no);
		// $aslvl = $this->Rpt_model->get_assessment($is_no);
		$data['asc_rpt'] = $this->Rpt_model->get_asc_paid_rpt($is_no);
		$data['paid_rpt_number'] = $this->Rpt_model->get_paid_num_rpt($is_no);
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$inputed_start_date = $this->input->post('start_date');
		$inputed_end_date = $this->input->post('end_date');
		$rpt_list = $this->Rpt_model->get_paid_rpt($is_no);
		$is_valid_strt_date = true;
		$is_valid_end_date = true;
		$strt_date = strtotime($inputed_start_date);
		$end_date = strtotime($inputed_end_date);
		$data =[];
		foreach ($rpt_list as $rpt_) {
			if($strt_date >=  strtotime($rpt_['start_date']) && $strt_date <= strtotime($rpt_['end_date'])){
				$is_valid_strt_date = false;
			}
			if($end_date >=  strtotime($rpt_['start_date']) && $end_date <= strtotime($rpt_['end_date'])){
				$is_valid_end_date = false;
			}
			if(($strt_date <=  strtotime($rpt_['start_date']) && $end_date >= strtotime($rpt_['start_date'])) || ($strt_date <=  strtotime($rpt_['end_date']) && $end_date >= strtotime($rpt_['end_date']))){
				$is_valid_strt_date = false;
				$is_valid_end_date = false;
			}
		}
		// var_dump('$data', $rpt_list);
		if (isset($_POST['add_asmnt_btn']) || isset($_POST['edit_asmnt_btn'])) {
			$this->form_validation->set_rules('ass_lvl', 'percentage.', 'required|callback_check_assmnt_lvl');
		} else {
			$this->form_validation->set_rules('rpt', 'Amount', 'required|callback_check_rpt_amount');
			$this->form_validation->set_rules('start_date', 'Year Paid Start', 'required|callback_checkDateFormatstart');
			$this->form_validation->set_rules('end_date', 'Year Paid End', 'required|callback_checkDateFormatend');
			$this->form_validation->set_rules('file', 'RPT', 'callback_check_file');
		}

		if ($this->form_validation->run() == FALSE) {

			$data['error'] = form_error('rpt').form_error('start_date').form_error('end_date').form_error('file') ;

		} else { //success posts
			if (isset($_POST['add_asmnt_btn'])) { // add assessment
				$this->Rpt_model->add_assessment($is_no);
				$this->session->set_flashdata('notif', 'Assessment Level set up successfully! you can now upload the RPT file.');
				
			} elseif (isset($_POST['edit_asmnt_btn'])) {
				$this->Rpt_model->edit_assessment_level($is_no);
				$this->session->set_flashdata('notif', 'Assessment Level set up successfully! you can now upload the RPT file.');
				
			} else {
				$li = $this->Land_model->getli_byid($is_no);
				$date_acq = new DateTime($li['date_acquired']);
				// var_dump('inputed date',$inputed_end_date);
				if ($date_acq->format('Y-m-d') > $inputed_start_date || $date_acq->format('Y-m-d') > $inputed_end_date) { //check if year paid is lesser than the year acquistion
					$data['error'] = '<span class="error-message">The date should be greater than date acquired!</span>';
				} else {
					$get_y_start = date('Y',$strt_date);
					$get_y_end = date('Y',$end_date);
					if (!$is_valid_strt_date || !$is_valid_end_date ) {
						$data['error'] = '<span class="error-message">The year you have selected has been already uploaded!</span>';
					}
					else if($get_y_start !== $get_y_end){
						$data['error'] = '<span class="error-message">You can only upload per year!</span>';
					}
					else if($strt_date > $end_date){
						$data['error'] = '<span class="error-message">Start date should be lesser than End date!</span>';
					}
					 else {
						$post_amount = $this->input->post('rpt');
						$amount = str_replace(',', '', $post_amount);

						$this->Rpt_model->upload_payed_rpt($is_no, $amount);
						$data['success'] = '<span class="success-message">RPT file uploaded successfully!</span>';
					}
				}

			}
		}
		echo json_encode($data);
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
				'start_year' => $rpt_result['start_date'],
				'end_year' => $rpt_result['end_date'],
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
	function checkDateFormatstart($date_input)
	{
		if (!$this->date_valid($date_input)) {
			$this->form_validation->set_message('checkDateFormatstart', '<span class="error-message">' . $date_input . ' is not a valid date.</span>');

			return FALSE;
		}
		return true;
	}
	
	function checkDateFormatend($date_input)
	{
		if (!$this->date_valid($date_input)) {
			$this->form_validation->set_message('checkDateFormatend', '<span class="error-message">' . $date_input . ' is not a valid date.</span>');

			return FALSE;
		}
		return true;
	}
	
	


	function check_rpt_amount($inp)
	{

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

	function check_file()
	{

		$allowed = array('gif', 'png', 'jpg', 'jpeg');
		$filename = $_FILES['file']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);

		if (empty($filename)) {
			$this->form_validation->set_message('check_file', '<span class="error-message">The %s file is required!</span>');
			return FALSE;
		} else {

			if (strlen($filename) > 200) {
				$this->form_validation->set_message('check_file', '<span class="error-message">rename your %s file, it exceeds the maximum no. of string which is 200</span>');
				return FALSE;
			} elseif (!in_array(strtolower($ext), $allowed)) { //not in array
				$this->form_validation->set_message('check_file', '<span class="error-message">your %s  is not a valid file format</span>	');
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}



}