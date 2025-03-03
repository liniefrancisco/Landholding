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
		$this->render_template('legal/report', $data);
	}
	public function gm_report()
	{

		$this->sess_gm();


		$data['title'] = "Reports";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['smallest'] = $this->Land_model->getlot_smallest();
		$data['largest'] = $this->Land_model->getlot_largest();
		$data['li_pending'] = $this->Land_model->getli_status_pending();
		$data['disapproved_payments'] = $this->Payment_model->getnum_payment_disapproved();
		$data['pending_payment_requests'] = $this->Payment_model->getnum_pending_payment_requests();
		$data['pending_rcp'] = $this->Payment_model->getpending_rcp_numrows();
		$data['pending_es'] = $this->Aspayment_model->get_pending_es_aspayment();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
		$data['disap_es'] = $this->Aspayment_model->get_disapproved_es_aspayment();
		$data['disap_js'] = $this->Aspayment_model->get_disapproved_js_aspayment();
		$data['ud_pending'] = $this->GM_model->getud_status_pending();
		$this->render_template('3A/report', $data);
	}

	function get_all_report_Lists()
	{
		$data = array();

		// Fetch titling's records
		$all_info = $this->DataTables->getRows($_POST);
		$i = $_POST['start'];
		foreach ($all_info as $ai) {
			$i++;
			if ($ai->tag == "Old") {
				$tag = "Old Land";
			} elseif ($ai->tag == "New") {
				$tag = "New Land";
			} elseif ($ai->tag == "Old LAPF-JS" || $ai->tag == "Old LAPF-ES" || $ai->tag == "New LAPF-ES" || $ai->tag == "New LAPF-JS") {
				$tag = "Aspayment";
			}
			$lot_area = '<td style="text-align: right;"><center>' . number_format($ai->lot_size, 2) . " </center></td>";

			$data[] = array($i, $ai->lot_type, $tag, $ai->tax_dec_no, $ai->land_title_no, ucfirst($ai->municipality), $lot_area);
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


	function get_all_tct_status()
	{
		$data = array();

		// Fetch titling's records
		$all_info = $this->DataTables->getRows($_POST);
		$i = $_POST['start'];
		$m = null;
		foreach ($all_info as $ai) {
			$i++;
			$ud = $this->Upload_model->select_empty($ai->is_no);
			$m = ucfirst($ai->middlename);
			$owner = ucfirst($ai->firstname) . " " . $m[0] . ". " . ucfirst($ai->lastname);
			$lot_location = ucfirst($ai->street) . ', ' . ucfirst($ai->baranggay) . ', ' . ucfirst($ai->municipality) . ', ' . ucfirst($ai->province);

			if ($ud['tct'] == null) {
				$status = "<b><code>W/O TCT</code></b>";
			} else {
				$status = "<b><code>W/ TCT</code></b>";
			}

			$data[] = array($i, $ai->is_no, $owner, $lot_location, $status);
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









}