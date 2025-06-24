<?php
class Old_Aspayment extends App_Controller{
	public function __construct() {
		parent::__construct();
		$this->not_logged_in();
		// Load the model
		$this->load->model('Aspayment_model');
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
	public function judicial() {
		$this->sess_legal();

		$data['judicial'] = $this->Aspayment_model->get_js_old();
		// $data['ud_pending'] = $this->Legal_model->getud_status_pending();
		// $data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		// $data['pending_acq'] = $this->Acquisition_model->get_pending_acq()
		$data['pending_acq'] = $this->Notification_bar_model->getds_status_pending();
		$this->render_template('legal/Aspayment/js_land_info', $data);

	}
	public function extrajudicial() {
		$this->sess_legal();

		// $old_aspayment = $this->Land_model->getaspayment_es_old();
		// $sess_id = $this->session->userdata('user_id');

		// foreach($old_aspayment as $key => $value) {
		// 	$es = $this->Aspayment_model->getesupload_result($value['is_no']);
		// 	$form = $this->Registry_model->getforms_byid($es['reference_id']);
		// 	if($sess_id == $form['user_id']) {
		// 		redirect('Legal_f/Registry/es_customer_info/'.$es['reference_id']);
		// 	}
		// }
		// $data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['extra'] = $this->Aspayment_model->get_es_old();
		$data['pending_acq'] = $this->Notification_bar_model->getds_status_pending();
		$this->render_template('legal/Aspayment/es_land_info', $data);
	}
}