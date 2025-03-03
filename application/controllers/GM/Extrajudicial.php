<?php 
class Extrajudicial extends App_Controller{
    public function __construct(){
        parent::__construct();
        $this->not_logged_in();
        $this->load->model('GM/Payment_request_model');
        $this->load->model('GM/Gm_notification_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('Pro');
        $this->load->helper('url');
        $this->load->helper('security');
    }

public function pending_extra_judicial()
  {
    $this->sess_gm();

    $data['title'] = "Land as payment";
    $data['li_approved'] = $this->Land_model->getli_status_approved();
    $data['li_disapproved'] = $this->Land_model->getli_status_disapproved();
    $data['li_pending'] = $this->Land_model->getli_status_pending();
    // $data['pending_payment_requests']= $this->Payment_model->getnum_pending_payment_requests();
    $data['pending_rcp'] = $this->Payment_model->getpending_rcp_numrows();
    $data['pending_es'] = $this->Aspayment_model->get_pending_es_aspayment();
    $data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
    $data['disap_es'] = $this->Aspayment_model->get_disapproved_es_aspayment();
    $data['disap_js'] = $this->Aspayment_model->get_disapproved_js_aspayment();
    $data['pending_payment_requests'] = $this->GM_model->getnum_pending_payment_requests();
    $data['approved_payment_requests'] = $this->GM_model->getnum_payment_approved();
    $data['disapproved_payment_requests'] = $this->GM_model->getnum_payment_disapproved();
    $data['payed_payment_requests'] = $this->GM_model->getnum_payment_payed();
    $data['es_aspayment'] = $this->Aspayment_model->get_es_pending();
    $data['ud_pending'] = $this->GM_model->getud_status_pending();
    $data['ud_disapproved'] = $this->GM_model->getud_status_disapproved();
    $data['ud_approved'] = $this->GM_model->getud_status_approved();
    $data['app_es'] = $this->Aspayment_model->get_approved_es_aspayment();
  
    $this->render_template('3A/pending_extrajudicial', $data);
  }