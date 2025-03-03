<?php
class Execute extends App_Controller{
	public function __construct(){
		parent::__construct();
		$this->not_logged_in();
		if (!$this->session->userdata('user_type') == "CCD") {
			redirect();
		}
		// Load the model
		$this->load->model('Ccd/Execute_model');
		$this->load->model('Ccd/Ccd_notification_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('string');
		$this->load->helper('url');
	}

	public function pending_table(){
		$this->sess_ccd();
		$data['title'] = "Land As Payment";

		//DATA TABPANE NOTIFICATION
		$data['aspayment_pending']= $this->Ccd_notification_model->get_aspayment_pending();
		$data['aspayment_approved']= $this->Ccd_notification_model->get_aspayment_approved();
		$data['aspayment_disapproved']= $this->Ccd_notification_model->get_aspayment_disapproved();
		//END DATA TABPANE NOTIFICATION

		$this->render_template('ccd/Execute/Pending_table',$data);
	}

	function data_ccd_execute_pending_table(){
	    $data = array();
	    $all_info = $this->Execute_model->get_row($_POST);

	    foreach($all_info as $ai){
	        if($ai->tag == "New LAPF-JS" || $ai->tag == "New LAPF-ES"){
	            $lot_owner = $ai->firstname . " " . substr(($ai->middlename), 0, 1) . ". " . $ai->lastname;
	            $lot_location = $ai->street . "- " . $ai->baranggay . ", " . $ai->municipality . ", " . $ai->province;
	            $date_request = $ai->submission_date ? date_format(date_create($ai->submission_date), "F d, Y") : 'N/A';

	            $form_url = '';
	            if ($ai->tag == "New LAPF-JS") {
	                $action ='<center>
								<a type="a" href=" '.base_url('Ccd/Execute/judicial_settlement_form/'.$ai->is_no).' " class="btn btn-primary btn-xs" style="border-radius: 10px; font-size:12px;background-color:#304b73; border-color:#fff;" title="View"><span class="fa fa-eye"></span> View</a>
	 						</center>';
	            } elseif ($ai->tag == "New LAPF-ES") {
	                $action ='<center>
								<a type="a" href=" '.base_url('Ccd/Execute/extrajudicial_settlement_form/'.$ai->is_no).' " class="btn btn-primary btn-xs" style="border-radius: 10px; font-size:12px;background-color:#304b73; border-color:#fff;" title="View"><span class="fa fa-eye"></span> View</a>
	 						</center>';
	            }

	            $data[] = array($ai->is_no, $lot_owner, $ai->lot_type, $lot_location, $date_request, $action);
	        }
	    }

	    $output = array(
	        "draw" => $_POST['draw'],
	        "recordsTotal" => $this->Execute_model->countAll(),
	        "recordsFiltered" => $this->Execute_model->countFiltered($_POST),
	        "data" => $data,
	    );

	    echo json_encode($output);
	}
	function data_ccd_execute_approved_table(){
	    $data = array();
	    $all_info = $this->Execute_model->get_row($_POST);

	    foreach($all_info as $ai){
	        if($ai->tag == "New LAPF-JS" || $ai->tag == "New LAPF-ES"){
	            $lot_owner = $ai->firstname . " " . substr(($ai->middlename), 0, 1) . ". " . $ai->lastname;
	            $lot_location = $ai->street . "- " . $ai->baranggay . ", " . $ai->municipality . ", " . $ai->province;
	            $date_request = $ai->submission_date ? date_format(date_create($ai->submission_date), "F d, Y") : 'N/A';
	            $date_approved = $ai->date_approved ? date_format(date_create($ai->date_approved), "F d, Y") : 'N/A';

	            $form_url = '';
	            if ($ai->tag == "New LAPF-JS") {
	                $action ='<center>
								<a type="a" href=" '.base_url('Ccd/Execute/judicial_settlement_form/'.$ai->is_no).' " class="btn btn-primary btn-xs" style="border-radius: 10px; font-size:12px;background-color:#304b73; border-color:#fff;" title="View"><span class="fa fa-eye"></span> View</a>
	 						</center>';
	            } elseif ($ai->tag == "New LAPF-ES") {
	                $action ='<center>
								<a type="a" href=" '.base_url('Ccd/Execute/extrajudicial_settlement_form/'.$ai->is_no).' " class="btn btn-primary btn-xs" style="border-radius: 10px; font-size:12px;background-color:#304b73; border-color:#fff;" title="View"><span class="fa fa-eye"></span> View</a>
	 						</center>';
	            }

	            $data[] = array($ai->is_no, $lot_owner, $ai->lot_type, $lot_location, $date_request,$date_approved, $action);
	        }
	    }

	    $output = array(
	        "draw" => $_POST['draw'],
	        "recordsTotal" => $this->Execute_model->countAll(),
	        "recordsFiltered" => $this->Execute_model->countFiltered($_POST),
	        "data" => $data,
	    );

	    echo json_encode($output);
	}

	function data_ccd_execute_disapproved_table(){
	    $data = array();
	    $all_info = $this->Execute_model->get_row($_POST);

	    foreach($all_info as $ai){
	        if($ai->tag == "New LAPF-JS" || $ai->tag == "New LAPF-ES"){
	            $lot_owner = $ai->firstname . " " . substr(($ai->middlename), 0, 1) . ". " . $ai->lastname;
	            $lot_location = $ai->street . "- " . $ai->baranggay . ", " . $ai->municipality . ", " . $ai->province;
	            $date_request = $ai->submission_date ? date_format(date_create($ai->submission_date), "F d, Y") : 'N/A';
	            $date_approved = $ai->date_approved ? date_format(date_create($ai->date_approved), "F d, Y") : 'N/A';

	            $form_url = '';
	            if ($ai->tag == "New LAPF-JS") {
	                $action ='<center>
								<a type="a" href=" '.base_url('Ccd/Execute/judicial_settlement_form/'.$ai->is_no).' " class="btn btn-primary btn-xs" style="border-radius: 10px; font-size:12px;background-color:#304b73; border-color:#fff;" title="View"><span class="fa fa-eye"></span> View</a>
	 						</center>';
	            } elseif ($ai->tag == "New LAPF-ES") {
	                $action ='<center>
								<a type="a" href=" '.base_url('Ccd/Execute/extrajudicial_settlement_form/'.$ai->is_no).' " class="btn btn-primary btn-xs" style="border-radius: 10px; font-size:12px;background-color:#304b73; border-color:#fff;" title="View"><span class="fa fa-eye"></span> View</a>
	 						</center>';
	            }

	            $data[] = array($ai->is_no, $lot_owner, $ai->lot_type, $lot_location, $date_request,$date_approved, $action);
	        }
	    }

	    $output = array(
	        "draw" => $_POST['draw'],
	        "recordsTotal" => $this->Execute_model->countAll(),
	        "recordsFiltered" => $this->Execute_model->countFiltered($_POST),
	        "data" => $data,
	    );

	    echo json_encode($output);
	}

	public function judicial_settlement_form($is_no){
		// check if the uri id is valid==========
		$li = $this->Execute_model->getli_byid($is_no);
		if(empty($is_no)){
			redirect('');
		}elseif($is_no[0].$is_no[1].$is_no[2] !== "JS-"){
			redirect('');
		}elseif( $li['tag'] !== "New LAPF-JS"){
			redirect('');
		}
		// check if the uri id is valid==========
					
		$data['title'] = "Judicial Settlement (LAPF-JS)";

		//DATA
		$data['oi']= $this->Execute_model->getoi_byid($is_no);
		$data['li']= $this->Execute_model->getli_byid($is_no);
		$data['ci'] = $this->Execute_model->getci_byid($is_no);
		$ci = $this->Execute_model->getci_byid($is_no);
		$data['cbi'] = $this->Execute_model->getcbi_byid($is_no);
		$data['ca'] = $this->Execute_model->getca_byid($is_no);
		$data['ll']= $this->Execute_model->getll_byid($is_no);
		$data['ud']= $this->Execute_model->getud_byid($is_no);
		$data['bd'] = $this->Execute_model->getbidding_byid($is_no);
		//END DATA

		$this->render_template('ccd/Execute/judicial_settlement_form',$data);        
	}

	public function extrajudicial_settlement_form($is_no){
		// check if the uri id is valid==========
		$li = $this->Execute_model->getli_byid($is_no);
		if(empty($is_no)){
			redirect('');
		}elseif($is_no[0].$is_no[1].$is_no[2] !== "ES-"){
			redirect('');
		}elseif( $li['tag'] !== "New LAPF-ES"){
			redirect('');
		}
		// check if the uri id is valid==========
					
		$data['title'] = "Extra judicial Settlement (LAPF-ES)";

		//DATA
		$data['oi']= $this->Execute_model->getoi_byid($is_no);
		$data['li']= $this->Execute_model->getli_byid($is_no);
		$data['ci'] = $this->Execute_model->getci_byid($is_no);
		$data['cbi'] = $this->Execute_model->getcbi_byid($is_no);
		$data['ca'] = $this->Execute_model->getca_byid($is_no);
		$data['ll']= $this->Execute_model->getll_byid($is_no);
		$data['ud']= $this->Execute_model->getud_byid($is_no);
		$data['ab'] = $this->Execute_model->getab_byid($is_no);
		$data['eu'] = $this->Execute_model->getesupload_byid($is_no);
		//END DATA

		$this->render_template('ccd/Execute/extrajudicial_settlement_form',$data);        
	}

}