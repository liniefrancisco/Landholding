<?php
class Land extends App_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
		// Load the model
		$this->load->model('Land_model');
		$this->load->model('Legal_model');
		$this->load->model('GM_model');
		$this->load->model('Tax_payment_model');
		$this->load->model('Legal_datatable');
		$this->load->model('Payment_model');
		$this->load->model('Aspayment_model');
		$this->load->model('Rpt_model');
		$this->load->model('Upload_model');
		$this->load->model('DataTables');
		$this->load->helper('form');
		$this->load->library('Pro');
		$this->load->library('form_validation');
	}

	public function titling()
	{
		$this->sess_legal();

		$data['title'] = "Titling";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		//$data['available_proof']= $this->Land_model->getavailble_proof();

		$this->render_template('legal/titling', $data);
	}

	public function titling_old()
	{
		$this->sess_legal();

		$data['title'] = "Titling";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		//$data['available_proof']= $this->Land_model->getavailble_proof();

		$this->render_template('legal/titling_old', $data);
	}
	public function titling_new()
	{
		$this->sess_legal();

		$data['title'] = "Titling";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		//$data['available_proof']= $this->Land_model->getavailble_proof();

		$this->render_template('legal/titling_new', $data);
	}

	public function fetch_titling($type)
	{
		$this->sess_legal();
		$this->security->get_csrf_hash();
		$post = $this->input->post();
		$tag = $this->input->post('tag');
		// var_dump($type,$tag);
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

			// if(empty($lot['computation_doc'])){
			// 	$action = '<a href="' . base_url('Tax_payment/upload_tax_payment/' . $lot['land_is_no']) . '" class="btn btn-custom-primary" style="background-color: #0d2e56; border: 1px solid #0d2e56; border-radius: 8px; font-size: 12px;"><i class="fa fa-hand-o-right"></i> Select</a>';
			// }else{
			$action = '<a href="' . base_url('Legal_f/Land/for_titling/' . $lot['land_is_no']) . '" class="btn btn-custom-primary" style="background-color: #0d2e56; border: 1px solid #0d2e56; border-radius: 8px; font-size: 12px;"><i class="fa fa-hand-o-right"></i> Select</a>';
			// $action .= '<a href="' . base_url('Tax_payment/view_tax_computation/' . $lot['land_is_no']) . '" class="btn btn-custom-primary" style="background-color: #0d2e56; border: 1px solid #0d2e56; border-radius: 8px; font-size: 12px;"><i class="fa fa-eye"></i> View</a>';
			// }

			$row[] = $lot['land_is_no'];
			$row[] = $owner_fullname;
			$row[] = $lot['lot'];
			$row[] = $lot['tax_dec_no'];
			$row[] = $lot['lot_type'];
			$row[] = $lot['lot_size'];
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
	public function fetch_js_es_land($type)
	{
		$this->security->get_csrf_hash();
		$post = $this->input->post();
		$tag = $this->input->post('tag');
		$list = $this->Tax_payment_model->get_datatables($post, $type, $tag);
		$filtered = $this->Tax_payment_model->count_filtered($post, $type, $tag);
		$count = $this->Tax_payment_model->count_all($type, $tag);
		$user = $this->session->userdata('user_type');

		$data = [];
		
		foreach ($list as $lot) {
			$row = [];

			$owner_fullname = ucfirst($lot['firstname']) . " " . ucfirst($lot['middlename']) . " " . ucfirst($lot['lastname']);
			$lot_address = $lot['region'] . ", " . $lot['province'] . ", " . $lot['municipality'] . ", " . $lot['baranggay'] . ", " . $lot['street'];
			if($tag == 'Pending' && $user == 'GM'){
				$action = '<a href="' . base_url('Legal_f/Aspayment/view_es/' . $lot['land_is_no']) .'/'.$tag. '" class="btn btn-custom-primary" style="background-color: #0d2e56; border: 1px solid #0d2e56; border-radius: 8px; font-size: 12px;"><i class="fa fa-hand-o-right"></i> Select</a>';
			}else if(($tag == 'Approved' || $tag == 'Disapproved') && $user == 'GM'){
				$action = '<a href="' . base_url('Legal_f/Aspayment/view_es/' . $lot['land_is_no']) .'/'.$tag.'" class="btn btn-custom-primary" style="background-color: #0d2e56; border: 1px solid #0d2e56; border-radius: 8px; font-size: 12px;"><i class="fa fa-eye"></i>View</a>';
			}
			else{
				$action = '<a href="' . base_url('Legal_f/Land/for_titling/' . $lot['land_is_no']) . '" class="btn btn-custom-primary" style="background-color: #0d2e56; border: 1px solid #0d2e56; border-radius: 8px; font-size: 12px;"><i class="fa fa-hand-o-right"></i> Select</a>';
			}

			$row[] = $lot['land_is_no'];
			$row[] = $owner_fullname;
			$row[] = $lot['lot_type'];
			$row[] = $lot_address;
			$row[] = $lot['prepared_by_info'];
			$row[] = $lot['date_acquired'];

			if($tag == 'Approved'){
				$row[] = $lot['li_app'];
				$row[] = $lot['ap_date'];
			}
			if($tag == 'Disapproved'){
				$row[] = $lot['li_disapp'];
				$row[] = $lot['dis_ap_date'];
			}
			
			$row[] = $action;
			$data[] = $row;
		}

		$response = array(
			"draw" => $post['draw'],
			"recordsTotal" => $count,
			"recordsFiltered" => $filtered,
			"data" => $data,
		);

		echo json_encode($response);
	}

	public function extrajudicial()
	{
		$this->sess_legal();

		$data['title'] = "Extrajudicial";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		//$data['available_proof']= $this->Land_model->getavailble_proof();
		$this->render_template('legal/titling_extrajudicial', $data);
	}
	public function extrajudicial_new()
	{
		$this->sess_legal();

		$data['title'] = "Extrajudicial";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		//$data['available_proof']= $this->Land_model->getavailble_proof();
		$this->render_template('legal/titling_extrajudicial_new', $data);
	}
	public function judicial()
	{
		$this->sess_legal();

		$data['title'] = "Judicial";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		//$data['available_proof']= $this->Land_model->getavailble_proof();
		$this->render_template('legal/titling_judicial', $data);

	}
	public function judicial_new()
	{
		$this->sess_legal();

		$data['title'] = "Judicial";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		//$data['available_proof']= $this->Land_model->getavailble_proof();
		$this->render_template('legal/titling_judicial_new', $data);

	}

	function get_titling_Lists()
	{
		$data = array();

		// Fetch titling's records
		$all_info = $this->DataTables->getRows($_POST);

		foreach ($all_info as $ai) {
			// $ll= $this->Land_model->getll_byid($titling->is_no);
			// $address = $ll['street'].", ".$ll['baranggay'].", ".$ll['municipality'];
			$action = '<center>
		                            	<a href=" ' . base_url('Legal_f/land/for_titling/' . $ai->is_no) . ' " class="btn btn-success" ><i class="fa fa-hand-o-right"></i> Select</a>
		                           </center>';
			$data[] = array($ai->lot, $ai->tax_dec_no, $ai->lot_type, number_format($ai->lot_size, 2), ucfirst($ai->street) . ', ' . ucfirst($ai->baranggay) . ', ' . ucfirst($ai->municipality) . ', ' . ucfirst($ai->province), $action);
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

	public function for_titling($is_no)
	{
		$this->sess_legal();

		$li = $this->Land_model->getli_byid($is_no);
		
		$data['pending_es'] = $this->Aspayment_model->get_pending_es_aspayment();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$data['disap_es'] = $this->Aspayment_model->get_disapproved_es_aspayment();
		$data['disap_js'] = $this->Aspayment_model->get_disapproved_js_aspayment();
		$data['app_es'] = $this->Aspayment_model->get_approved_es_aspayment();
		$data['app_js'] = $this->Aspayment_model->get_approved_js_aspayment();
		//end
		$data['li'] = $this->Land_model->getli_byid($is_no);
		$data['oi'] = $this->Land_model->getoi_byid($is_no);
		$data['ll'] = $this->Land_model->getll_byid($is_no);
		$data['cp'] = $this->Land_model->getcp_byid($is_no);
		$data['ud'] = $this->Upload_model->getud_byid($is_no);
		$data['li_approved'] = $this->Land_model->getli_status_approved();
		$data['ud_resubmit'] = $this->Land_model->getud_status_resubmit();
		$data['ud_pending'] = $this->Land_model->getud_status_pending();
		$data['li_pending'] = $this->Land_model->getli_status_pending();
		$ud = $this->Upload_model->getud_byid($is_no);
		$others_arr = ($ud['other'] !== '') ? explode(",", $ud['other']) : [];
		$data['others'] = $others_arr;
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		//$data['ud'] = $this->Upload_model->select_empty($is_no);

		//validations ===============
		if (isset($_POST['up_tct_btn'])) { //instrument
			if (empty($ud['tct'])) {
				$this->Upload_model->update_tct($is_no);
				$this->session->set_flashdata('notif', 'TCT file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}
		} elseif (isset($_POST['up_oct_btn'])) { //instrument
			if (empty($ud['oct'])) {
				$this->Upload_model->update_oct($is_no);
				$this->session->set_flashdata('notif', 'OCT file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}
		} elseif (isset($_POST['up_lt_btn'])) { //tct
			if (empty($ud['land_title'])) {
				$this->Upload_model->update_lt($is_no);
				$this->session->set_flashdata('notif', 'Land Title file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}

		} elseif (isset($_POST['up_dos_btn'])) { //tct
			if (empty($ud['previous_deed_of_sale'])) {
				$this->Upload_model->update_dos($is_no);
				$this->session->set_flashdata('notif', 'Deed of Sale file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}

		} elseif (isset($_POST['up_ecar_btn'])) { //tct
			if (empty($ud['e_car'])) {
				$this->Upload_model->update_ecar($is_no);
				$this->session->set_flashdata('notif', 'e-CAR file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}

		} elseif (isset($_POST['up_td_btn'])) { //tct
			if (empty($ud['latest_tax_dec'])) {
				$this->Upload_model->update_tax_declaration($is_no);
				$this->session->set_flashdata('notif', 'Tax Declaration file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}

		} elseif (isset($_POST['up_tc_btn'])) { //tct
			if (empty($ud['tax_clearance'])) {
				$this->Upload_model->update_tax_clearance($is_no);
				$this->session->set_flashdata('notif', 'Tax Clearance file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}

		} elseif (isset($_POST['up_ls_btn'])) { //tct
			if (empty($ud['land_sketch'])) {
				$this->Upload_model->update_land_sketch($is_no);
				$this->session->set_flashdata('notif', 'Land Sketch file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}

		} elseif (isset($_POST['up_vm_btn'])) { //tct
			if (empty($ud['vicinity_map'])) {
				$this->Upload_model->update_vicinity_map($is_no);
				$this->session->set_flashdata('notif', 'Vicinity Map file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}

		} elseif (isset($_POST['up_cni_btn'])) { //tct
			if (empty($ud['cert_no_improvement'])) {
				$this->Upload_model->update_certificate($is_no);
				$this->session->set_flashdata('notif', 'Certification of No Improvement file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}

		} elseif (isset($_POST['up_ret_btn'])) { //tct
			if (empty($ud['real_astate_tax'])) {
				$this->Upload_model->update_real_estate_tax($is_no);
				$this->session->set_flashdata('notif', 'Real Estate Tax file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}

		} elseif (isset($_POST['up_mc_btn'])) { //tct
			if (empty($ud['marriage_contract'])) {
				$this->Upload_model->update_marriage_contract($is_no);
				$this->session->set_flashdata('notif', 'Marriage Contract file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}

		} elseif (isset($_POST['up_bc_btn'])) { //tct
			if (empty($ud['birth_certificate'])) {
				$this->Upload_model->update_birth_certificate($is_no);
				$this->session->set_flashdata('notif', 'Birth Certificate file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}

		} elseif (isset($_POST['up_vi_btn'])) { //tct
			if (empty($ud['valid_id'])) {
				$this->Upload_model->update_valid_id($is_no);
				$this->session->set_flashdata('notif', 'Valid ID file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}

		} elseif (isset($_POST['up_sp_btn'])) { //tct
			if (empty($ud['subdivision_plan'])) {
				$this->Upload_model->update_subdivision_plan($is_no);
				$this->session->set_flashdata('notif', 'Subdivision Plan file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}

		} elseif (isset($_POST['up_spa_btn'])) { //tct
			if (empty($ud['spa'])) {
				$this->Upload_model->update_spa($is_no);
				$this->session->set_flashdata('notif', 'SPA file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}

		} elseif (isset($_POST['up_denr_btn'])) { //tct
			if (empty($ud['denr_dar'])) {
				$this->Upload_model->update_denr($is_no);
				$this->session->set_flashdata('notif', 'DENR/DAR file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}

		} elseif (isset($_POST['up_ds_btn'])) { ///////////////////////////////////////////////////////////////////
			if (empty($ud['DOS'])) {
				$this->Upload_model->update_ds($is_no);
				$this->session->set_flashdata('notif', 'Deed of Sale either DOAS/ DOEJS/ AOSHWSS/ DOC file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}

		} elseif (isset($_POST['up_aru_btn'])) {
			if (empty($ud['acknowledement_receipt_undervalued'])) {
				$this->Upload_model->update_aru($is_no);
				$this->session->set_flashdata('notif', 'Acknowledgement Receipt(Undervalued) file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}

		} elseif (isset($_POST['up_ara_btn'])) {
			if (empty($ud['acknowledement_receipt_actual'])) {
				$this->Upload_model->update_ara($is_no);
				$this->session->set_flashdata('notif', 'Acknowledgement Receipt(Actual) file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}

		} elseif (isset($_POST['up_br_btn'])) {
			if (empty($ud['brgy_resolution'])) {
				$this->Upload_model->update_br($is_no);
				$this->session->set_flashdata('notif', 'Baranggay Resolution file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}

		} elseif (isset($_POST['up_spoa_btn'])) {
			if (empty($ud['special_power_of_attorney'])) {
				$this->Upload_model->update_spoa($is_no);
				$this->session->set_flashdata('notif', 'Special Power of Attorney file successfully uploaded!');
				redirect('Legal_f/Land/for_titling/' . $is_no);
			} else {
				$this->session->set_flashdata('error', 'The file you requested already exists.');
			}

		} elseif (isset($_POST['update_type'])) {
			$this->form_validation->set_rules('other_folder_name', 'Folder name', 'required');
			if($this->form_validation->run() === TRUE){
				$update_type = $this->input->post('update_type');
				if ($this->Upload_model->update_other($is_no, $others_arr)) {
					if($update_type == 'update'){
						$this->session->set_flashdata('notif', 'file successfully updated!');
					}else if($update_type == 'delete'){
						$this->session->set_flashdata('notif', 'file successfully deleted!');
					}else{
						$this->session->set_flashdata('notif', 'file successfully uploaded!');
					}
					
				}
			}else{
				$this->session->set_flashdata('error',validation_errors());
			}

			redirect('Legal_f/Land/for_titling/' . $is_no);
		}


		if ($this->form_validation->run() == FALSE) {

			$this->render_template('legal/for_titling', $data);

		}
	}

	function check_tct_file()
	{

		if (empty($_FILES["file"]['name'])) {
			$this->form_validation->set_message('check_tct_file', 'The %s file is required!');
			return FALSE;
		} else {

			$allowed = array('gif', 'png', 'jpg', 'jpeg');
			$filename = $_FILES['file']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);

			if (strlen($filename) > 200) {
				$this->form_validation->set_message('check_tct_file', 'Rename your %s file, it exceeds the maximum no. of string which is 200');
				return FALSE;
			} elseif (!in_array(strtolower($ext), $allowed)) { //not in array
				$this->form_validation->set_message('check_tct_file', 'your %s file is not a valid file format');
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}


	function check_brgy()
	{

		$file = $_FILES['brgy_res']['name'];

		if (empty($file)) {
			$this->form_validation->set_message('check_brgy', 'The %s file is required!');
			return FALSE;
		} else {

			$allowed = array('gif', 'png', 'jpg', 'jpeg');
			$filename = $file;
			$ext = pathinfo($filename, PATHINFO_EXTENSION);

			if (strlen($filename) > 200) {
				$this->form_validation->set_message('check_brgy', 'Rename your %s file, it exceeds the maximum no. of string which is 200');
				return FALSE;
			} elseif (!in_array(strtolower($ext), $allowed)) { //not in array
				$this->form_validation->set_message('check_brgy', 'your %s file is not a valid file format');
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}

	function check_title()
	{

		$file = $_FILES["land_file"]['name'];

		if (empty($file)) {
			$this->form_validation->set_message('check_title', 'The %s file is required!');
			return FALSE;
		} else {

			$allowed = array('gif', 'png', 'jpg', 'jpeg');
			$filename = $file;
			$ext = pathinfo($filename, PATHINFO_EXTENSION);

			if (strlen($filename) > 200) {
				$this->form_validation->set_message('check_title', 'Rename your %s file, it exceeds the maximum no. of string which is 200');
				return FALSE;
			} elseif (!in_array(strtolower($ext), $allowed)) { //not in array
				$this->form_validation->set_message('check_title', 'your %s file is not a valid file format');
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}

	function check_tax()
	{

		$file = $_FILES["tax_file"]['name'];

		if (empty($file)) {
			$this->form_validation->set_message('check_tax', 'The %s file is required!');
			return FALSE;
		} else {

			$allowed = array('gif', 'png', 'jpg', 'jpeg');
			$filename = $file;
			$ext = pathinfo($filename, PATHINFO_EXTENSION);

			if (strlen($filename) > 200) {
				$this->form_validation->set_message('check_tax', 'Rename your %s file, it exceeds the maximum no. of string which is 200');
				return FALSE;
			} elseif (!in_array(strtolower($ext), $allowed)) { //not in array
				$this->form_validation->set_message('check_tax', 'your %s file is not a valid file format');
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}

	function check_sketch()
	{

		$file = $_FILES["land_sketch_file"]['name'];

		if (empty($file)) {
			$this->form_validation->set_message('check_sketch', 'The %s file is required!');
			return FALSE;
		} else {

			$allowed = array('gif', 'png', 'jpg', 'jpeg');
			$filename = $file;
			$ext = pathinfo($filename, PATHINFO_EXTENSION);

			if (strlen($filename) > 200) {
				$this->form_validation->set_message('check_sketch', 'Rename your %s file, it exceeds the maximum no. of string which is 200');
				return FALSE;
			} elseif (!in_array(strtolower($ext), $allowed)) { //not in array
				$this->form_validation->set_message('check_sketch', 'your %s file is not a valid file format');
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}





	public function incomplete_titling()
	{
		$this->sess_legal();

		$data['uploaded_documents'] = $this->Land_model->getuploaded_documents();

		$this->render_template('legal/incomplete_titling', $data);

	}

	public function lists()
	{
		$this->sess_legal();

		$data['title'] = "Land Profile";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/land_profile', $data);
	}

	public function land_acq_old()
	{
		$this->sess_legal();

		$data['title'] = "Real Property Tax";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/land_profile/land_acq_old', $data);
	}
	public function land_acq_new()
	{
		$this->sess_legal();

		$data['title'] = "Real Property Tax";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/land_profile/land_acq_new', $data);
	}
	public function land_extra_old()
	{
		$this->sess_legal();

		$data['title'] = "Real Property Tax";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/land_profile/land_extra_old', $data);
	}
	public function land_extra_new()
	{
		$this->sess_legal();

		$data['title'] = "Real Property Tax";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/land_profile/land_extra_new', $data);
	}
	public function land_judicial_old()
	{
		$this->sess_legal();

		$data['title'] = "Real Property Tax";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/land_profile/land_judicial_old', $data);
	}
	public function land_judicial_new()
	{
		$this->sess_legal();

		$data['title'] = "Real Property Tax";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/land_profile/land_judicial_new', $data);
	}

	public function fetch_land_datatable($type)
	{
		$this->sess_legal();
		$this->security->get_csrf_hash();
		$post = $this->input->post();
		$tag = $this->input->post('tag');
		
		$list = $this->Tax_payment_model->get_datatables($post, $type, $tag);
		$filtered = $this->Tax_payment_model->count_filtered($post, $type, $tag);
		$count = $this->Tax_payment_model->count_all($type, $tag);
		$data = [];
		
		foreach ($list as $lot) {
			$row = [];

			$owner_fullname = ucfirst($lot['firstname']) . " " . ucfirst($lot['middlename']) . " " . ucfirst($lot['lastname']);
			$lot_address = $lot['region'] . ", " . $lot['province'] . ", " . $lot['municipality'] . ", " . $lot['baranggay'] . ", " . $lot['street'];
			$action = '<a href="' . base_url('Legal_f/Land/profile/' . $lot['land_is_no']) . '" class="btn btn-custom-primary" style="background-color: #0d2e56; border: 1px solid #0d2e56; border-radius: 8px; font-size: 12px;"><i class="fa fa-hand-o-right"></i> Select</a>';			

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
	public function fetch_land_reports_datatable()
	{
		$this->sess_legal();
		$this->security->get_csrf_hash();
		$post = $this->input->post();
		$tag = $this->input->post('tag');

		// var_dump('search', $_POST['search']['value']);
		$list = $this->Legal_datatable->get_datatables($post);
		$total_rec = $this->Legal_datatable->count_all($post);
		$filtered = $this->Legal_datatable->count_filtered($post);
		// var_dump('filtered', $filtered);
		$data = [];
		// var_dump($list);
		foreach ($list as $lot) {
			$row = [];
			$category = "";
			// $owner_fullname = ucfirst($lot['firstname']) . " " . ucfirst($lot['middlename']) . " " . ucfirst($lot['lastname']);
			$lot_address = $lot['region'] . ", " . $lot['province'] . ", " . $lot['municipality'] . ", " . $lot['baranggay'] . ", " . $lot['street'];
			if ($lot['tag'] == 'New' || $lot['tag'] == 'New LAPF-JS' || $lot['tag'] == 'New LAPF-ES') {
				$category = "New";
			} else if ($lot['tag'] == 'Old' || $lot['tag'] == 'Old LAPF-JS' || $lot['tag'] == 'Old LAPF-ES') {
				$category = "Old";
			}
			$count = $this->Legal_model->get_count_rpt($lot['land_is_no']);

			$date1 = new DateTime($lot['date_acquired']);
			$date2 = new DateTime(date('Y-m-d'));
			$interval = $date1->diff($date2);
			$year = "";
			if ($interval->y == 0) {
				if ($count >= 1) {
					$year = 'Paid';
				} else {
					$year = 'Unpaid';
				}
			} else {
				$tot_years1 = $interval->y - $count; //subtract to get the no. of years unpaid
				if ($tot_years1 !== 0) {
					$year = $tot_years1 . ' Years Unpaid';
				} else {
					$year = 'Unpaid';
				}
			}
			
			if ($tag === 'rpt') {
				$row[] = $lot['land_is_no'];
				$row[] = $lot['lot'];
				$row[] = $lot['tax_dec_no'];
				$row[] = intval($lot['lot_size']);
				$row[] = number_format($lot['total_price'], 2);
				$row[] = $year;
			} else {
				$row[] = $lot['land_is_no'];
				$row[] = $lot_address;
				$row[] = $category;
				$row[] = $lot['lot_type'];
				$row[] = intval($lot['lot_size']);
				
			}

			$data[] = $row;
		}

		$response = array(
			"draw" => $post['draw'],
			"recordsTotal" => $total_rec,
			// Total records in your table
			"recordsFiltered" => $filtered,
			// Filtered records
			"data" => $data,
		);

		echo json_encode($response);
	}


	public function profile($is_no)
	{
		$this->sess_legal();
		$li = $this->Land_model->getli_byid($is_no);
		
		$data['li'] = $this->Land_model->getli_byid($is_no);
		$data['oi'] = $this->Land_model->getoi_byid($is_no);
		$oi = $this->Land_model->getoi_byid($is_no);
		$data['ll'] = $this->Land_model->getll_byid($is_no);
		$data['cp'] = $this->Land_model->getcp_byid($oi['id']);
		$data['ud'] = $this->Land_model->getud_info($is_no);
		$data['paid_rpt'] = $this->Rpt_model->get_paid_rpt($is_no);
		$data['eu'] = $this->Aspayment_model->getesupload_byid($is_no);

		$rcp = $this->Payment_model->getrcp_reqbyid($is_no);

		$data['rcp'] = $this->Payment_model->getrcp_reqbyid($is_no);
		$data['ca_purpose'] = (!empty($rcp)) ? $this->Payment_model->getca_purpose($rcp['rcp_no']) : [];
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
	
		$data['ud_checked'] = $this->Land_model->getud_status_checked();
		$data['ud_incomplete'] = $this->Land_model->getud_status_incomplete();
		$data['ud_resubmit'] = $this->Land_model->getud_status_resubmit();
		$data['pending_payment_requests'] = $this->GM_model->getnum_pending_payment_requests();
		$data['approved_payment_requests'] = $this->GM_model->getnum_payment_approved();
		$data['disapproved_payment_requests'] = $this->GM_model->getnum_payment_disapproved();
		$data['payed_payment_requests'] = $this->GM_model->getnum_payment_payed();

		
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$this->render_template('legal/view_profile', $data);

	}


	public function view_document($is_no)
	{
		$this->sess_legal();
		$li = $this->Land_model->getli_byid($is_no);

		$data['is_no'] = $is_no;
		$li = $this->Land_model->getli_byid($is_no);
		$data['li'] = $this->Land_model->getli_byid($is_no);
		$data['oi'] = $this->Land_model->getoi_byid($is_no);
		$oi = $this->Land_model->getoi_byid($is_no);
		$data['ll'] = $this->Land_model->getll_byid($is_no);
		$data['cp'] = $this->Land_model->getcp_byid($oi['id']);
		$data['ud'] = $this->Land_model->getud_info($is_no);
		$data['rstr'] = $this->Land_model->getrstr_byid($is_no);

		$data['ab'] = $this->Aspayment_model->getamount_basis_byid($is_no); //es
		$data['eu'] = $this->Aspayment_model->getesupload_byid($is_no);

		$data['bd'] = $this->Aspayment_model->getbidding_byid($is_no); //js
		$data['ci'] = $this->Aspayment_model->getcustomer_byid($is_no);
		$ci = $this->Aspayment_model->getcustomer_byid($is_no);
		$data['cbal'] = !empty($ci) ? $this->Aspayment_model->getcusbalinf_byid($ci['id']) : [];
		$data['cadd'] = !empty($ci) ? $this->Aspayment_model->getcusaddr_byid($ci['id']) : [];
		// ledger
		$rcp = $this->Payment_model->getrcp_reqbyid($is_no);
		$data['rcp'] = $this->Payment_model->getrcp_reqbyid($is_no);
		$data['ca_details'] = !empty($rcp) ? $this->Payment_model->getca_details($rcp['rcp_no']) : [];
		$data['ca_purpose'] = !empty($rcp) ? $this->Payment_model->getca_purpose($rcp['rcp_no']) : [];
		//rpt
		$data['aslvl'] = $this->Rpt_model->get_assessment($is_no);
		$data['paid_rpt'] = $this->Rpt_model->get_paid_rpt($is_no);
		//owner's file
		$data['oa'] = $this->Land_model->getoa_byid($oi['id']);


		if ($this->input->post('view') == "Interview Sheet and Uploaded Documents" || $this->input->post('view') == "LAPF-JS" || $this->input->post('view') == "LAPF-ES") {
			if ($li['tag'] == "Old" || $li['tag'] == "New") {
				$this->load->view('legal/interview_sheet', $data);
			} elseif ($li['tag'] == "Old LAPF-ES" || $li['tag'] == "New LAPF-ES") {
				$this->load->view('legal/extrajudicial', $data);
			} elseif ($li['tag'] == "Old LAPF-JS" || $li['tag'] == "New LAPF-JS") {
				$this->load->view('legal/judicial', $data);
			}

		} elseif ($this->input->post('view') == "Ledger") {
			$this->load->view('legal/ledger', $data);
		} elseif ($this->input->post('view') == "Summary of Payment") {
			$this->load->view('legal/summary_of_payment', $data);
		} elseif ($this->input->post('view') == "DOAS") {
			$this->load->view('legal/view_doas', $data);
		} elseif ($this->input->post('view') == "Land Titling Docs") {
			$this->load->view('legal/land_titling_docs', $data);
		} elseif ($this->input->post('view') == "TCT") {
			$this->load->view('legal/view_tct', $data);
		} elseif ($this->input->post('view') == "RPT") {
			$this->load->view('legal/view_rpt', $data);
		} elseif ($this->input->post('view') == "Owner's file") {
			$this->load->view('legal/owner_files', $data);
		}
	}



}