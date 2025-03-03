<?php
class Report extends App_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
		// Load the model
		$this->load->model('Upload_model');
		$this->load->model('Land_model');
		$this->load->model('Legal_model');
		$this->load->model('DataTables');
		$this->load->model('Aspayment_model');
		$this->load->model('Payment_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function index()
	{

		$this->sess_legal();

		$data['title'] = "Reports";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['smallest'] = $this->Land_model->getlot_smallest();
		$data['largest'] = $this->Land_model->getlot_largest();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$this->render_template('legal/report', $data);
	}

}