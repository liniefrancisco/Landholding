<?php
class Rpt extends App_Controller{
	public function __construct(){
		parent::__construct();
		$this->not_logged_in();
		// Load the model
		$this->load->model('Rpt_model');
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
	    $tableId 	= $this->input->post('tableId');
	    $data 		= array();
	    $all_info 	= $this->Datatable_model->get_row($_POST);

	    foreach ($all_info as $ai){
	    	$row = [];
	    	if($tableId === 'rpt_datatable'){
			    $checked = ($ai->Assessment_Level && $ai->Effective_year) ? 'checked' : '';
			    $row[] = '<input type="checkbox" class="row-check" value="' . $ai->is_no . '" ' . $checked . '>';
			}else{
				$row[] = $ai->posted_date;
			}

	        $lot_owner = $ai->firstname . " " . substr(($ai->middlename), 0, 1) . ". " . $ai->lastname;
	        $lot_location = '<address>
	                            <a data-toggle="tooltip" title="click to view map" data-placement="right" href="http://maps.google.com/maps?q=' . $ai->street . " " . $ai->baranggay . " " . $ai->municipality . " " . $ai->province . ' " target="_blank">
	                                ' . ucfirst($ai->street) . "- " . ucfirst($ai->baranggay) . ", " . ucfirst($ai->municipality) . ", " . ucfirst($ai->province) . '
	                            </a>
	                        </address>';

            $action = '<center>
	                        <div class="btn-group btn-group-xs">
	                            <button type="button" class="btn btn-danger btn-xs">Action</button>
	                            <button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown">
	                                <span class="caret"></span>
	                                <span class="sr-only">Toggle Dropdown</span>
	                            </button>
	                            <ul class="dropdown-menu" role="menu">
	                                <li class="bg-white">
	                                    <a href="' . base_url('Rpt/Real_Property_Tax/' . $ai->is_no) . '" title="Add Payment">
	                                        <span class="fa fa-edit"></span> Tax Payment Schedule
	                                    </a>
	                                </li>
	                            </ul>
	                        </div>
	                    </center>';

	        $row[]  = $ai->is_no;
		    $row[]  = $ai->tax_dec_no;
		    $row[]  = $lot_owner;
		    $row[]  = $ai->municipality;
		    $row[]  = $ai->lot;
		    $row[]  = $ai->lot_type;
		    $row[]  = $ai->Assessment_Level ?: '<code>Not set</code>';
		    $row[]  = $ai->Effective_year ?: '<code>Not set</code>';
		    $row[]  = $action;
		    $data[] = $row;
	    }

	    $output = array(
	        "draw" => $_POST['draw'],
	        "recordsTotal" => $this->Datatable_model->countAll(),
	        "recordsFiltered" => $this->Datatable_model->countFiltered($_POST),
	        "data" => $data,
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
	    $is_nos = $this->input->post('is_no'); // this is an array

	    if (!empty($is_nos)) {
	        foreach ($is_nos as $is_no) {
	            $data = array(
	                'posted_date' => date('Y-m-d'),
	                'is_no'       => $is_no,
	                'status'      => 'Pending'
	            );
	            $this->db->insert('real_property_tax', $data);
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
}