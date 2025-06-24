<?php
class Report extends App_Controller{
	public function __construct(){
		parent::__construct();
		$this->not_logged_in();
		// Load the model
		$this->load->model('Report_model');
		$this->load->model('Datatable_model');
		$this->load->model('Notification_model');
		$this->load->model('Notification_bar_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
	}
	public function Notification(){
		$data = array();
		#Tab Notification
		$data['pending_acq'] = $this->Notification_bar_model->getds_status_pending();
		#Message Notification
		$recepient =  $this->session->userdata('user_id');
		$data['all_notifications'] = $this->Notification_model->get_notif_per_user($recepient);
		$data['all_notification_no'] = $this->Notification_model->get_all_notification_no($recepient);
		return $data;
	}
	public function index(){
		$this->sess_legal();
		$data['title'] = "Reports";
		$data = $this->Notification();
		$data['lot_location'] = $this->Report_model->getlot_location();
		$data['smallest'] 		= $this->Report_model->getlot_smallest();
		$data['largest'] 			= $this->Report_model->getlot_largest();
		$this->render_template('legal/Report/report', $data);
	}
	function get_all_report_Lists(){
		$data 		= array();
		$all_info = $this->Datatable_model->get_row($_POST);
		$i 				= $_POST['start'];
		foreach($all_info as $ai){
			$i++;
			if($ai->tag == "Old"){
				$tag = "Old Land";
			}elseif ($ai->tag == "New"){
				$tag = "New Land";
			}elseif($ai->tag == "Old LAPF-JS" || $ai->tag == "Old LAPF-ES" || $ai->tag == "New LAPF-ES" || $ai->tag == "New LAPF-JS"){
				$tag = "Aspayment";
			}
			$lot_area = '<td>'.number_format($ai->lot_size, 2).'</td>';

			$data[] = array($i, $ai->lot_type, $tag, $ai->tax_dec_no, $ai->land_title_no, ucfirst($ai->municipality), $lot_area);
		}

		$output = array(
			"draw" 						=> $_POST['draw'],
			"recordsTotal" 		=> $this->Datatable_model->countAll(),
			"recordsFiltered" => $this->Datatable_model->countFiltered($_POST),
			"data" 						=> $data,
		);
		echo json_encode($output);
	}
	function get_all_tct_status(){
		$data 		= array();
		$all_info = $this->Datatable_model->get_row($_POST);
		$i 				= $_POST['start'];
		$m 				= null;
		foreach ($all_info as $ai) {
			$i++;
			$ud 					= $this->Report_model->select_empty($ai->is_no);
			$m 						= ucfirst($ai->middlename);
			$middleInitial = !empty($m) ? $m[0] . "." : "";  // Only set the initial if the middle name is not empty
			$owner = ucfirst($ai->firstname) . " " . $middleInitial . " " . ucfirst($ai->lastname);
			$lot_location = ucfirst($ai->street) . ', ' . ucfirst($ai->baranggay) . ', ' . ucfirst($ai->municipality) . ', ' . ucfirst($ai->province);

			if($ud['tct'] == null){
				$status = "<b><code>W/O TCT</code></b>";
			}else{
				$status = "<b><code>W/ TCT</code></b>";
			}

			$data[] = array($i, $ai->is_no, $owner, $lot_location, $status);
		}

		$output = array(
			"draw" 						=> $_POST['draw'],
			"recordsTotal" 		=> $this->Datatable_model->countAll(),
			"recordsFiltered" => $this->Datatable_model->countFiltered($_POST),
			"data" 						=> $data,
		);
		echo json_encode($output);
	}
}