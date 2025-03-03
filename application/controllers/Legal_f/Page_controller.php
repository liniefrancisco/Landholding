<?php
class Page_controller extends App_Controller{
    public function __construct(){
        parent::__construct();
        $this->not_logged_in();
        $this->load->model('Aspayment_model');
		$this->load->model('Land_model');
		$this->load->model('Legal_model');
		$this->load->model('Payment_model');
		$this->load->model('DataTables');
		$this->load->model('Gm/GM_DataTables');
		$this->load->model('Notification_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('GM_model');
    }

    function about_us(){
        $this->sess_legal();

		$data['title'] = "Titling";
		$data['land_info'] = $this->Land_model->getregistry_land();
		$data['lot_location'] = $this->Land_model->getlot_location();
		$data['owner_info'] = $this->Land_model->getowner_info();
		$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
		$data['ud_pending'] = $this->Legal_model->getud_status_pending();
		$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
        $this->render_template('templates/about_us',$data);
    }
}