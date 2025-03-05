<?php
class Old_Acquisition extends App_Controller{
	public function __construct() {
		parent::__construct();
		$this->not_logged_in();
		// Load the model
		$this->load->model('Acquisition_model');
		$this->load->model('Notification_bar_model');
		$this->load->model('Notification_model');
		$this->load->model('Datatable_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('string');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('security');
	}
	public function Notification(){
		$data = array();
		#TAB NOTIFICATION
	    $data['pending_acq'] 			= $this->Notification_bar_model->getds_status_pending();
		#Message Notification
		$recepient 						=  $this->session->userdata('user_id');
		$data['all_notifications']		= $this->Notification_model->get_notif_per_user($recepient);
		$data['all_notification_no']	= $this->Notification_model->get_all_notification_no($recepient);
		return $data;
	}
	public function index(){
		$this->sess_legal();
		$data['title'] 		= "Old Acquisition";
		$data 				= $this->Notification();
		$data['land_id'] 	= $this->Acquisition_model->getland_old();
		$count 				= $this->Acquisition_model->geli_rows();
		$new 				= $this->Acquisition_model->getland_old();
		$oi 				= null;
		$ud 				= null;
		foreach ($new as $n) {
			$oi = $this->Acquisition_model->getoi_byid($n['is_no']);
			$ud = $this->Acquisition_model->getud_byid($n['is_no']);
		}

		if ($count == 0 || $count != 0) {
			$this->form_validation->set_rules('is_no', 'I.S No.', 'required|callback_check_isno');
			$this->form_validation->set_rules('lot_type', 'lot type', 'required|in_list[Agricultural,Commercial,Residential]');
			$this->form_validation->set_rules('street', 'street', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[30]');
			$this->form_validation->set_rules('lot_sold', 'lot sold', 'required|in_list[Portion,Whole]');
			$this->form_validation->set_rules('purchase_type', 'purchase type', 'required|in_list[package,per/sq.m.]');
			$this->form_validation->set_rules('lot_area', 'lot area', 'required|callback_check_currency');
			if (@$_POST['purchase_type'] == 'per/sq.m.') {
				$this->form_validation->set_rules('selling_price', 'selling price', 'required|callback_check_currency');
			}
			$this->form_validation->set_rules('total_price', 'total price', 'required|callback_check_currency');
			$this->form_validation->set_rules('liens', 'liens', "regex_match[/^[a-zA-Z0-9 .,'-]+$/]|max_length[500]");
			$this->form_validation->set_rules('easement', 'easement', "regex_match[/^[a-zA-Z0-9 .,'-]+$/]|max_length[500]");
			$this->form_validation->set_rules('encumbrances', 'encumbrances', "regex_match[/^[a-zA-Z0-9 .,'-]+$/]|max_length[500]");


			if ($this->form_validation->run() == FALSE) {
				$this->render_template('legal/Acquisition/land_information', $data);
			} else {
				$area 			= $this->input->post('lot_area');
				$price 			= $this->input->post('selling_price');
				$total 			= $this->input->post('total_price');
				$lot_area 		= str_replace(',', '', $area);
				$selling_price 	= str_replace(',', '', $price);
				$total_price 	= str_replace(',', '', $total);
				$tag 			= 'Old';

				$this->Acquisition_model->add_land_info($lot_area, $selling_price, $total_price, $tag);
				$this->Acquisition_model->add_lot_location();
				if (!empty($this->input->post('liens')) || 
				    !empty($this->input->post('easement')) || 
				    !empty($this->input->post('encumbrances'))) {  
				    $this->Acquisition_model->add_restriction();  
				}							
				$this->Acquisition_model->add_owner_id();	 
				$this->session->set_flashdata('notif','Land Information Saved Successfully!');
				$is_no = $this->input->post('is_no');
				redirect('Old_Acquisition/owner_info/'.$is_no);
			}
		}
	}
	public function cancel_acq_land_info($is_no){
		$this->sess_secretary();
		if(isset($_POST['cancel_acq_owner'])){
			if(empty($is_no)){
				redirect('');
			}			
			$li = $this->Acquisition_model->getli_byid($is_no);
			if(substr($is_no, 0, 3) == "NA-" && $li['tag'] == "New"){
				$this->Acquisition_model->delete_land_info($is_no);
				$this->Acquisition_model->delete_lot_location($is_no);
				$this->Acquisition_model->delete_restriction($is_no);
				$this->Acquisition_model->delete_owner_info($is_no);

				$this->session->set_flashdata('notif','Acquisition has been cancelled!');
				redirect('Old_Acquisition');
			}else{
				redirect('');
			}	
		}else{
			redirect('');
		}	
	}
	public function owner_info($id){
		$this->sess_legal();
		$data['title'] 	= "Old Acquisition";
		$data 			= $this->Notification();
		$data['li'] 	= $this->Acquisition_model->getli_byid($id);
		$li 			= $this->Acquisition_model->getli_byid($id);
		$oi 			= $this->Acquisition_model->getoi_byid($id);
		$data['oi'] 	= $this->Acquisition_model->getoi_byid($id);

		$this->form_validation->set_rules('presentor', 'presentor', 'required|in_list[Broker,Owner/Seller]');
		if($this->input->post('presentor') == "Broker"){
			$this->form_validation->set_rules('broker_first', 'firstname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[20]', array('required' => '%s of the broker is required!'));
			$this->form_validation->set_rules('broker_last', 'lastname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[20]', array('required' => '%s of the broker is required!'));
		}
		$this->form_validation->set_rules('firstname', 'first name', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[20]', array('required' => '%s of the owner is required!'));
		$this->form_validation->set_rules('lastname', 'lastname', 'required|regex_match[/^[a-zA-Z ]+$/]|max_length[20]', array('required' => '%s of the owner is required!'));
		$this->form_validation->set_rules('gender', 'gender', 'required|in_list[Male,Female]');
		$this->form_validation->set_rules('street', 'street', 'required|regex_match[/^[a-zA-Z0-9 -]+$/]|max_length[50]');
		$this->form_validation->set_rules('vital_status', 'vital status', 'required|in_list[Alive,Deceased]');
		$this->form_validation->set_rules('fullname', 'fullname', 'required|min_length[4]|regex_match[/^[a-zA-Z ]+$/]|max_length[90]');
		$this->form_validation->set_rules('address', 'address', 'required|min_length[8]|regex_match[/^[a-zA-Z0-9 -,]+$/]|max_length[150]');
		$this->form_validation->set_rules('tel_no', 'telephone no.', 'regex_match[/^[0-9-]+$/]|max_length[30]');
		$this->form_validation->set_rules('phone_no', 'phone no.', 'required|exact_length[11]|numeric');
		$this->form_validation->set_rules('email', 'email', 'valid_email');

		if($this->form_validation->run() == FALSE){
			$this->render_template('legal/Acquisition/owner_information',$data);
		}else{
			$this->Acquisition_model->add_owner_info($id);
			$this->Acquisition_model->add_owner_address($oi['id']);
			$this->Acquisition_model->add_broker_info($oi['id']);
			$this->Acquisition_model->add_contact_info($oi['id']);
			$this->Acquisition_model->add_upload_id($id);
			$this->Acquisition_model->add_docu_status_id($id);
			$this->session->set_flashdata('notif','Owner Information Saved Successfully!');
			redirect('Old_Acquisition/upload_proof/'.$id);
		}
	}
	public function cancel_acq_owner_info($is_no){
		$this->sess_legal();

		if(isset($_POST['cancel_acq_upload'])){
			if(empty($is_no)){
				redirect('');
			}
			$li = $this->Acquisition_model->getli_byid($is_no);
			if(substr($is_no, 0, 3) == "NA-" && $li['tag'] == "New"){
				$this->Acquisition_model->delete_owner_info($is_no);
				$this->Acquisition_model->delete_owner_address($is_no);
				$this->Acquisition_model->delete_broker_info($is_no);
				$this->Acquisition_model->delete_contact_person($is_no);
				$this->Acquisition_model->delete_upload_docs($is_no);
				$this->Acquisition_model->delete_document_status($is_no);

				$this->session->set_flashdata('notif','Acquisition has been cancelled.');
					redirect('Old_Acquisition/owner_info/'.$is_no);
			}else{
				redirect('');
			}
		}else{
			redirect();
		}
	}
	public function upload_proof($is_no){
		$this->sess_legal();
		$data['title'] 	= "New Acquisition";
		$data 			= $this->Notification();
		$data['id'] 	= $is_no;
		$data['li']		= $this->Acquisition_model->getli_byid($is_no);
		$data['ud']		= $this->Acquisition_model->getud_byid($is_no);

		$this->render_template('legal/Acquisition/upload_proof_documents',$data);
	}
	public function upload_owner_documents($is_no){
		$this->sess_legal();
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
			redirect('Old_Acquisition/upload_proof/'. $is_no);
		}elseif(isset($_POST['up_tct_btn'])){ //TCT
			$prev_tct_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/TCT/' . $ud['tct'];
			if (!empty($ud['tct']) && file_exists($prev_tct_path)) {
				$this->delete_prev_file($prev_tct_path);
			}
			$this->Acquisition_model->update_tct($is_no);
			$this->session->set_flashdata('notif','TCT file successfully uploaded!');
			redirect('Old_Acquisition/upload_proof/'. $is_no);
		}elseif(isset($_POST['up_dos_btn'])){ //Deed of Sale
			$prev_dos_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Previous Deed Of Sale/' . $ud['previous_deed_of_sale'];
			if (!empty($ud['previous_deed_of_sale']) && file_exists($prev_dos_path)) {
				$this->delete_prev_file($prev_dos_path);
			}
			$this->Acquisition_model->update_dos($is_no);
			$this->session->set_flashdata('notif','Deed of Sale file successfully uploaded!');
			redirect('Old_Acquisition/upload_proof/'. $is_no);
		}elseif(isset($_POST['up_ecar_btn'])){ //E-CAR
			$prev_ecar_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/eCAR/' . $ud['e_car'];
			if (!empty($ud['e_car']) && file_exists($prev_ecar_path)) {
				$this->delete_prev_file($prev_ecar_path);
			}
			$this->Acquisition_model->update_ecar($is_no);
			$this->session->set_flashdata('notif','E-CAR file successfully uploaded!');
			redirect('Old_Acquisition/upload_proof/'. $is_no);
		}elseif(isset($_POST['up_td_btn'])){ //Tax Declaration
			$prev_tax_dec_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Tax Declaration/' . $ud['latest_tax_dec'];
			if (!empty($ud['latest_tax_dec']) && file_exists($prev_tax_dec_path)) {
				$this->delete_prev_file($prev_tax_dec_path);
			}
			$this->Acquisition_model->update_tax_declaration($is_no);
			$this->Acquisition_model->insert_tax_number($is_no);
			$this->session->set_flashdata('notif','Tax Declaration file successfully uploaded!');
			redirect('Old_Acquisition/upload_proof/'. $is_no);
		}elseif(isset($_POST['up_tc_btn'])){ //Tax Clearance
			$prev_tc_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Tax Clearance/' . $ud['tax_clearance'];
			if (!empty($ud['tax_clearance']) && file_exists($prev_tc_path)) {
				$this->delete_prev_file($prev_tc_path);
			}
			$this->Acquisition_model->update_tax_clearance($is_no);
			$this->session->set_flashdata('notif','Tax Clearance file successfully uploaded!');
			redirect('Old_Acquisition/upload_proof/'. $is_no);
		}elseif(isset($_POST['up_ls_btn'])){ //Sketch Plan
			$prev_sketch_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Land Sketch/' . $ud['land_sketch'];
			if (!empty($ud['land_sketch']) && file_exists($prev_sketch_path)) {
				$this->delete_prev_file($prev_sketch_path);
			}
			$this->Acquisition_model->update_land_sketch($is_no);
			$this->session->set_flashdata('notif','Sketch Plan file successfully uploaded!');
			redirect('Old_Acquisition/upload_proof/'. $is_no);
		}elseif(isset($_POST['up_vm_btn'])){ //vicinity map
			$prev_vicinity_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Vicinity Map/' . $ud['vicinity_map'];
			if (!empty($ud['vicinity_map']) && file_exists($prev_vicinity_path)) {
				$this->delete_prev_file($prev_vicinity_path);
			}
			$this->Acquisition_model->update_vicinity_map($is_no);
			$this->session->set_flashdata('notif','Vicinity Map file successfully uploaded!');
			redirect('Old_Acquisition/upload_proof/'. $is_no);
		}elseif(isset($_POST['up_cni_btn'])){ //Certificate of no improvement
			$prev_coni_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Certificate of No Improvement/' . $ud['cert_no_improvement'];
			if (!empty($ud['cert_no_improvement']) && file_exists($prev_coni_path)) {
				$this->delete_prev_file($prev_coni_path);
			}
			$this->Acquisition_model->update_certificate($is_no);
			$this->session->set_flashdata('notif','Certificate of No Improvement file successfully uploaded!');
			redirect('Old_Acquisition/upload_proof/'. $is_no);
		}elseif(isset($_POST['up_ret_btn'])){ //Real Estate Tax
			$prev_ret_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Real Estate Tax/' . $ud['real_estate_tax'];
			if (!empty($ud['real_estate_tax']) && file_exists($prev_ret_path)) {
				$this->delete_prev_file($prev_ret_path);
			}
			$this->Acquisition_model->update_real_estate_tax($is_no);
			$this->session->set_flashdata('notif','Real Estate Tax file successfully uploaded!');
			redirect('Old_Acquisition/upload_proof/'. $is_no);
		}elseif(isset($_POST['up_mc_btn'])){ //Marriage Contract
			$prev_mc_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Marriage Contract/' . $ud['marriage_contract'];
			if (!empty($ud['marriage_contract']) && file_exists($prev_mc_path)) {
				$this->delete_prev_file($prev_mc_path);
			}
			$this->Acquisition_model->update_marriage_contract($is_no);
			$this->session->set_flashdata('notif','Marriage Contract file successfully uploaded!');
			redirect('Old_Acquisition/upload_proof/'. $is_no);
		}elseif(isset($_POST['up_bc_btn'])){ //Birth Certificate
			$prev_bc_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Birth Certificate/' . $ud['birth_certificate'];
			if (!empty($ud['birth_certificate']) && file_exists($prev_bc_path)) {
				$this->delete_prev_file($prev_bc_path);
			}
			$this->Acquisition_model->update_birth_certificate($is_no);
			$this->session->set_flashdata('notif','Birth Certificate file successfully uploaded!');
			redirect('Old_Acquisition/upload_proof/'. $is_no);
		}elseif(isset($_POST['up_vi_btn'])){ //Valid Id
			$prev_id_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Valid ID/' . $ud['valid_id'];
			if (!empty($ud['valid_id']) && file_exists($prev_id_path)) {
				$this->delete_prev_file($prev_id_path);
			}
			$this->Acquisition_model->update_valid_id($is_no);
			$this->session->set_flashdata('notif','Valid ID successfully uploaded!');
			redirect('Old_Acquisition/upload_proof/'. $is_no);
		}elseif(isset($_POST['up_sp_btn'])){ //Subdivision Plan
			$prev_sp_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/Subdivision Plan/' . $ud['subdivision_plan'];
			if (!empty($ud['subdivision_plan']) && file_exists($prev_sp_path)) {
				$this->delete_prev_file($prev_sp_path);
			}
			$this->Acquisition_model->update_subdivision_plan($is_no);
			$this->session->set_flashdata('notif','Subdivision Plan successfully uploaded!');
			redirect('Old_Acquisition/upload_proof/'. $is_no);
		}elseif(isset($_POST['up_spa_btn'])){ //Spa
			$prev_spa_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/SPA/' . $ud['spa'];
			if (!empty($ud['spa']) && file_exists($prev_spa_path)) {
				$this->delete_prev_file($prev_spa_path);
			}
			$this->Acquisition_model->update_spa($is_no);
			$this->session->set_flashdata('notif','SPA successfully uploaded!');
			redirect('Old_Acquisition/upload_proof/'. $is_no);
		}elseif(isset($_POST['up_denr_btn'])){ //DENR/DAR
			$prev_denr_path = './assets/img/uploaded_documents/' . $ud['is_no'] . '/DENR or DAR/' . $ud['denr_dar'];
			if (!empty($ud['denr_dar']) && file_exists($prev_denr_path)) {
				$this->delete_prev_file($prev_denr_path);
			}
			$this->Acquisition_model->update_denr($is_no);
			$this->session->set_flashdata('notif','DENR/DAR successfully uploaded!');
			redirect('Old_Acquisition/upload_proof/'. $is_no);
		}elseif(isset($_POST['up_other_btn'])){ //OTHER
			$this->Acquisition_model->insert_other($is_no);
			$this->session->set_flashdata('notif','Other Documents successfully uploaded!');
			redirect('Old_Acquisition/upload_proof/'. $is_no);
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
			redirect('Old_Acquisition/upload_proof/' . $is_no);
		} 
		if ($this->form_validation->run() == FALSE){
			$this->render_template('legal/Acquisition/upload_proof_documents/'. $is_no);
		}else{
			$this->render_template('legal/Acquisition/upload_proof_documents/'. $is_no);
		}
	}
	public function send_documents($is_no) {
	    $this->sess_legal();
	    $ud 	= $this->Acquisition_model->getud_byid($is_no);
	    $ftype 	= "IS";
	    $uid 	= $this->session->userdata('user_id');
	    $name 	= $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname');

	    if ($ud['land_sketch'] == NULL) {
	        echo json_encode(array('success' => false, 'message' => 'Please upload Sketch Plan!'));
	    } elseif ($ud['land_title'] == NULL && $ud['latest_tax_dec'] == NULL ) {
	        echo json_encode(array('success' => false, 'message' => 'Please upload either Land Title or Tax Declaration!'));
	    } else {
	        $this->Acquisition_model->add_document_status($is_no, $name);
	        $this->Acquisition_model->add_forms($is_no, $ftype, $uid);
	        echo json_encode(array('success' => true));
	    }
	}
	public function pop_up_upload($id){
		$this->session->set_flashdata('success', 'You are all set and done!. You can edit and update the info here if you missed some data entry.');
		redirect('Old_Acquisition');
	}
	#ADDRESS
	public function getregion(){
		$result = $this->Acquisition_model->get_tesdaregion();
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
		$regCode 	= $_POST['regCode'];
		$result 	= $this->Acquisition_model->get_tesdaprovince($regCode);
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
		$result 	= $this->Acquisition_model->get_tesdacitymun($provCode);
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
		$result 		= $this->Acquisition_model->get_tesdabrgy($citymunCode);
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
		$result 	= $this->Acquisition_model->get_province($regCode);
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
		$result 	= $this->Acquisition_model->get_citymun($provCode);
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
		$result 		= $this->Acquisition_model->get_brgy($citymunCode);
		$output 		= [];
		$i 				= 0;
		foreach ($result as $value) {
			$output[$i]['brgyDesc'] = $value->brgyDesc;
			$output[$i]['brgyCode'] = $value->brgyCode;
			$i++;
		}
		echo json_encode($output);
	}
	#FORM VALIDATION
	public function check_isno($str) {
		$format = substr($str, 0, 3);
		if($format == "OA-") {
			$row = $this->Acquisition_model->getforms_byid($str);
			$land_id = $this->Acquisition_model->getland_old();

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
	function check_zipcode($str){
		if (!ctype_digit($str)){
			$this->form_validation->set_message('check_zipcode', '{field} contains invalid character');
			return FALSE;
		}else{
			return TRUE;
		}
	}
	function check_currency($inp){
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
	function checkDateFormat($date) {
		$dt = date_create($date);
		$conv_date = @date_format($dt,"Y-m-d");
		$day = (int) substr($conv_date, 0, 2);
		$month = (int) substr($conv_date, 3, 2);
		$year = (int) substr($conv_date, 6, 4);
		//return checkdate($month, $day, $year);
		if(checkdate($month, $day, $year) === FALSE){
			$this->form_validation->set_message('checkDateFormat', ''.$date.' is not a valid date format.');
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
	function check_title(){
		$file = $_FILES["lt_file"]['name'];

		if(empty($file)){
 			$this->form_validation->set_message('check_title', 'The %s file is required!');
			return FALSE;
 		}else{
 			$allowed =  array('gif','png' ,'jpg', 'jpeg');
 			$filename = $file;
			$ext = pathinfo($filename, PATHINFO_EXTENSION);

			if(strlen($filename) > 200){
				$this->form_validation->set_message('check_title','Rename your %s file, it exceeds the maximum no. of string which is 200');
				return FALSE;
			}elseif(!in_array(strtolower($ext), $allowed) ) { //not in array
				$this->form_validation->set_message('check_title','your %s file is not a valid file format');
				return FALSE;						
			}else{
				return TRUE;
			}
 		}
	}
	function check_tax(){
		$file = $_FILES["tax_file"]['name'];
		if(empty($file)){
 			$this->form_validation->set_message('check_tax', 'The %s file is required!');
			return FALSE;
 		}else{
 			$allowed =  array('gif','png' ,'jpg', 'jpeg');
 			$filename = $file;
			$ext = pathinfo($filename, PATHINFO_EXTENSION);

			if(strlen($filename) > 200){
				$this->form_validation->set_message('check_tax','Rename your %s file, it exceeds the maximum no. of string which is 200');
				return FALSE;
			}elseif(!in_array(strtolower($ext), $allowed) ) { //not in array
				$this->form_validation->set_message('check_tax','your %s file is not a valid file format');
				return FALSE;						
			}else{
				return TRUE;
			}
 		}
	}
	function check_sketch(){
		$file = $_FILES["land_sketch_file"]['name'];

		if(empty($file)){
 			$this->form_validation->set_message('check_sketch', 'The %s file is required!');
			return FALSE;
 		}else{
 			$allowed =  array('gif','png' ,'jpg', 'jpeg');
 			$filename = $file;
			$ext = pathinfo($filename, PATHINFO_EXTENSION);

			if(strlen($filename) > 200){
				$this->form_validation->set_message('check_sketch','Rename your %s file, it exceeds the maximum no. of string which is 200');
				return FALSE;
			}elseif(!in_array(strtolower($ext), $allowed) ) { //not in array
				$this->form_validation->set_message('check_sketch','your %s file is not a valid file format');
				return FALSE;						
			}else{
				return TRUE;
			}
 		}
	}
	function deleteAll($str) {
		//It it's a file.
		if (is_file($str)) {
			//Attempt to delete it.
			return unlink($str);
		}
		//If it's a directory.
		elseif (is_dir($str)) {
			//Get a list of the files in this directory.
			$scan = glob(rtrim($str,'/').'/*');
			//Loop through the list of files.
			foreach($scan as $index=>$path) {
				//Call our recursive function.
				$this->deleteAll($path);
			}
			//Remove the directory itself.
			return @rmdir($str);
		}
	}
	function delete_prev_file($str){
		if (is_file($str)) {
			//Attempt to delete it.
			return unlink($str);
		}
	}
	#END
}