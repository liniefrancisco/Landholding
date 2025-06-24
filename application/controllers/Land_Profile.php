<?php 
class Land_Profile extends App_Controller{
	public function __construct(){
		parent::__construct();
		$this->not_logged_in();
		$this->load->model('Rpt_model');
		$this->load->model('Acquisition_model');
		$this->load->model('Payment_model');
		$this->load->model('LandProfile_model');
		$this->load->model('Datatable_model');
		$this->load->model('Notification_bar_model');
		$this->load->model('Notification_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
	}
	public function Notification(){
		$data = array();
		#Tab Notification
		$data['pending_acq'] = $this->Notification_bar_model->getds_status_pending();
		#Message Notification
		$recepient =  $this->session->userdata('user_id');
		$data['all_notifications']		= $this->Notification_model->get_notif_per_user($recepient);
		$data['all_notification_no']	= $this->Notification_model->get_all_notification_no($recepient);
		return $data;
	}
	public function index(){
		$this->sess_legal();
		$data['title'] = "Land Profile";
		$data = $this->Notification();
		$this->render_template('legal/LandProfile/table',$data);
	}
	public function LandProfile_datatable(){
		$data 		= array();
		$all_info = $this->Datatable_model->get_row($_POST);

		foreach ($all_info as $ai) {
			$owner_info = $ai->firstname." ".substr(($ai->middlename),0,1).". ".$ai->lastname;
			$address		= '<address>
											<a data-toggle="tooltip" title="click to view map" data-placement="right" href="http://maps.google.com/maps?q='.$ai->street." ".$ai->baranggay." ".$ai->municipality." ".$ai->province.' " target="_blank">'.ucfirst($ai->street)."- ".ucfirst($ai->baranggay).", ".ucfirst($ai->municipality).", ".ucfirst($ai->province).'</a>
										</address>';
			$lot_area 	= number_format($ai->lot_size, 2) . " <code>sq/m</code>";
			$action 		= '<center>
											<a href=" '.base_url('Land_Profile/view_profile/'.$ai->is_no).' " class="btn btn-xs btn-primary" ><i class="fa fa-folder-open"></i> View</a>
										</center>';

			$data[] 		=	array($ai->is_no, $ai->lot, $owner_info, $address, $ai->lot_type, $lot_area, $ai->tag, $action);
		}

		$output = array(
			"draw" 							=> $_POST['draw'],
			"recordsTotal" 			=> $this->Datatable_model->countAll(),
			"recordsFiltered" 	=> $this->Datatable_model->countFiltered($_POST),
			"data" 							=> $data,
		);
		echo json_encode($output);
	}
	public function view_profile($is_no){
		$this->sess_legal();
		$data['title'] 	= "Land Profile";
		$data = $this->Notification();
		$ds 	= $this->Acquisition_model->getds_byid($is_no);
		if($ds['status'] !== "Approved" || empty($is_no)){
			redirect('Land_Profile');
		}
		$data['li'] = $this->Acquisition_model->getli_byid($is_no);
		$data['oi'] = $this->Acquisition_model->getoi_byid($is_no);
		$data['ll'] = $this->Acquisition_model->getll_byid($is_no);
		$data['ud'] = $this->Acquisition_model->getud_byid($is_no);

		$this->render_template('legal/LandProfile/view_profile',$data);
	}
	public function view_document($is_no){
		$this->sess_legal();
		$ds = $this->Acquisition_model->getds_byid($is_no);
		if($ds['status'] !== "Approved" || empty($is_no)){
			redirect('Land_Profile');
		}
		$data['is_no'] = $is_no;
		$data['li'] 	 = $this->Acquisition_model->getli_byid($is_no);
		$li 					 = $this->Acquisition_model->getli_byid($is_no);
		$data['oi'] 	 = $this->Acquisition_model->getoi_byid($is_no);
		$oi 					 = $this->Acquisition_model->getoi_byid($is_no);
		$data['ll'] 	 = $this->Acquisition_model->getll_byid($is_no);
		$data['cp'] 	 = $this->Acquisition_model->getcp_byid($oi['id']);
		$data['ud'] 	 = $this->Acquisition_model->getud_byid($is_no);
		$data['aslvl'] = $this->Rpt_model->select_assessments_row($is_no);
		$data['rpt_yearpaid'] = $this->Rpt_model->select_rpt_yearpaid_asc_result($is_no);
		$data['oa']		 = $this->Acquisition_model->getoa_byid($oi['id']);
		$data['titling']= $this->Acquisition_model->gettitling_byid($is_no); 
		#Summary of Payment
		$data['getpt_byid_result'] = $this->Payment_model->getpt_byid_result($is_no);
		$data['getpr_byid_result'] = $this->Payment_model->getpr_byid_result($is_no);
		 
		if($this->input->post('view') == "IS" || $this->input->post('view') == "LAPF-JS" || $this->input->post('view') == "LAPF-ES"){
			if($li['tag'] == "Old" || $li['tag'] == "New"){
				$this->load->view('legal/LandProfile/view_interview_sheet',$data);
			}elseif($li['tag'] == "Old LAPF-ES" || $li['tag'] == "New LAPF-ES"){
				$this->load->view('legal/LandProfile/view_extra_settlement',$data);
			}elseif($li['tag'] == "Old LAPF-JS" || $li['tag'] == "New LAPF-JS"){
				$this->load->view('legal/LandProfile/view_judicial_settlement',$data);
			}
		}elseif ($this->input->post('view') == "OI"){
			$this->load->view('legal/LandProfile/view_owner_info',$data);
		}elseif ($this->input->post('view') == "OD"){
			$this->load->view('legal/LandProfile/view_owner_docs',$data);	
		}elseif ($this->input->post('view') == "SOP"){
			$this->load->view('legal/LandProfile/view_sop',$data);
		}elseif ($this->input->post('view') == "RPT"){
			$this->load->view('legal/LandProfile/view_rpt',$data);
		}elseif ($this->input->post('view') == "Titling"){
			$this->load->view('legal/LandProfile/view_titling',$data);
		}
	}
	public function upload_titling($is_no){
		$this->sess_legal();
		$data = $this->Notification();
		$data['li']= $this->Acquisition_model->getli_byid($is_no);
		$data['oi']= $this->Acquisition_model->getoi_byid($is_no);
		$data['ll']= $this->Acquisition_model->getll_byid($is_no);
		$data['ud']= $this->Acquisition_model->getud_byid($is_no);  	

		if(isset($_POST['land_title_btn'])){//Land Title
			$this->form_validation->set_rules('file', 'Land Title', 'callback_check_file');
		}elseif(isset($_POST['tax_declaration_btn'])){//Tax Declaration
			$this->form_validation->set_rules('file', 'Tax Declaration', 'callback_check_file');
		}elseif(isset($_POST['tct_btn'])){//Transfer Certificate of Title
			$this->form_validation->set_rules('file', 'Transfer Certificate of Title', 'callback_check_file');
		}

		if ($this->form_validation->run() == FALSE){
			$this->render_template('legal/LandProfile/view_profile',$data);
		}else{
			$titling = $this->db->get_where('titling', ['is_no' => $is_no])->row_array();
			if(isset($_POST['land_title_btn'])){
				if(empty($titling)){
					$this->LandProfile_model->insert_land_title($is_no);
				}else{
					$this->LandProfile_model->update_land_title($is_no);
				}
			}elseif(isset($_POST['tax_declaration_btn'])){
				if(empty($titling)){
					$this->LandProfile_model->insert_tax_declaration($is_no);
				}else{
					$this->LandProfile_model->update_tax_declaration($is_no);
				}
			}elseif(isset($_POST['tct_btn'])){
				if(empty($titling)){
					$this->LandProfile_model->insert_tct($is_no);
				}else{
					$this->LandProfile_model->update_tct($is_no);
				}
			}
			$this->session->set_flashdata('success','Successfully uploaded!');
			redirect('Land_Profile/view_profile/'.$is_no);
		}
	}
	function check_file(){
	  $allowed 	=  array('gif','png' ,'jpg', 'jpeg');
	  $filename = $_FILES['file']['name'];
	  $ext 			= pathinfo($filename, PATHINFO_EXTENSION);
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