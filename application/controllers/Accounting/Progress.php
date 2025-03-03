<?php 
class Progress extends App_Controller{
  public function __construct(){
    parent::__construct();
    $this->not_logged_in();
    $this->load->model('Accounting/Progress_model');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->library('Pro');
    $this->load->helper('url');
    $this->load->helper('security');
  }
  public function index(){
    $this->sess_acctng();
    $data['title'] = "In Progress";
    //Data for Table
    $data['payment_approved']= $this->Progress_model->getpayment_status_approved();
    $data['land_info']= $this->Progress_model->getland_information();
    $data['owner_info']= $this->Progress_model->getowner_info();
    $data['lot_location']= $this->Progress_model->getlot_location();
    //End

    $this->render_template('accounting/in_progress/table',$data);
  }

  //==================================================
  //VIEW INPROGRESS
  //==================================================
  public function view_inprogress($is_no){
    $this->sess_acctng();
    $data['title'] = "In Progress";

    //Sidebar Notification
    $data['accounting_payment_request'] = $this->Accounting_notification_model->payment_request_notification();
    //end

    $data['is_no'] = $is_no;
    $data['li']= $this->Progress_model->getli_byid($is_no);
    $data['oi']= $this->Progress_model->getoi_byid($is_no);
    $oi= $this->Progress_model->getoi_byid($is_no);
    $data['ll']= $this->Progress_model->getll_byid($is_no);
    $data['cp']= $this->Progress_model->getcp_byid($oi['id']);
    $data['ud']= $this->Progress_model->getud_byid($is_no);
    $data['bi']= $this->Progress_model->getbi_byid($is_no);
    $data['rstr']= $this->Progress_model->getrstr_byid($is_no);
    $data['pr']= $this->Progress_model->getpr_byid($is_no);
    $pr= $this->Progress_model->getpr_byid($is_no);
    $data['pr_ca_data'] = $this->Progress_model->getpr_data($is_no);
    $data['crf_ca_data'] = $this->Progress_model->getcrf_data($is_no);
    $data['crf']= $this->Progress_model->getcrf_byid($is_no);
    $data['pt_details'] = $this->Progress_model->getpt_details($is_no);
    $data['pr_details'] = $this->Progress_model->getpr_details($is_no);
    $data['ca_info'] = $this->Progress_model->getpr_info($is_no);
    $data['fp_info'] = $this->Progress_model->getfp_info($is_no);
    $data['last_pt'] = $this->Progress_model->getpt_info($is_no);
    $data['pr1'] = $this->Progress_model->getpr_byid1($is_no);

    $this->render_template('accounting/in_progress/view_inprogress',$data);
  }
  //==================================================
  //END VIEW INPROGRESS
  //==================================================
}