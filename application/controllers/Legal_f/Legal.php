<?php
class Legal extends App_Controller{
  public function __construct(){
    parent::__construct();
    $this->not_logged_in();
    // Load the model
    $this->load->model('Legal_model');
    $this->load->model('DataTables');
    $this->load->model('Land_model');
    $this->load->model('Payment_model');
    $this->load->model('Aspayment_model');
    $this->load->model('Notification_model');
    $this->load->model('Rpt_model');
    $this->load->model('Upload_model');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->helper('string');
    $this->load->library('session');
    $this->load->helper('url');
    $this->load->helper('security');
  }
  // ==================================================
  // DOCUMENTS
  // ==================================================
  public function document_request(){
    $this->sess_legal();

    $data['title'] = "Documents";
    //display data for table
    $data['land_info']= $this->Legal_model->get_all_li();
    $data['owner_info']= $this->Legal_model->getowner_info();
    $data['lot_location']= $this->Legal_model->getlot_location();
    $data['upload_documents']= $this->Legal_model->getupload_info();
    $data['li_pending'] = $this->Legal_model->getli_status_pending();
    $data['ud_pending'] = $this->Legal_model->getud_status_pending();
    $data['ud_uploaded'] = $this->Legal_model->getud_status_uploaded();
    $data['ud_checked'] = $this->Legal_model->getud_status_checked();
    $data['ud_incomplete'] = $this->Legal_model->getud_status_incomplete();
    $data['ud_resubmit'] = $this->Legal_model->getud_status_resubmit();
    $data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
    $data['count_approved_docs'] = $this->Legal_model->getud_status_approved();
    $data['count_disapproved_docs'] = $this->Legal_model->getud_status_disapproved();
    $data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
    //display data for bar land information record
    //end
    $this->render_template('legal/Documents_table',$data);

  }


  public function Pending_Documents($is_no){
    $this->sess_legal();
    $data['title']= "Land Information";

    //display form
    $data['li']= $this->Land_model->getli_byid($is_no);
    $data['oi']= $this->Land_model->getoi_byid($is_no);
    $oi = $this->Land_model->getoi_byid($is_no);
    $data['ll']= $this->Land_model->getll_byid($is_no);
    $data['cp']= $this->Land_model->getcp_byid($oi['id']);
    $data['ud']= $this->Land_model->getud_info($is_no);
    $data['rstr'] = $this->Land_model->getrstr_byid($is_no);
    $data['li_pending'] = $this->Legal_model->getli_status_pending();
    $data['ud_pending'] = $this->Legal_model->getud_status_pending();
    $data['ud_uploaded'] = $this->Legal_model->getud_status_uploaded();
    $data['ud_checked'] = $this->Legal_model->getud_status_checked();
    $data['ud_incomplete'] = $this->Legal_model->getud_status_incomplete();
    $data['ud_resubmit'] = $this->Legal_model->getud_status_resubmit();
    $data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
    $data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
    $this->render_template('legal/Documents_pending',$data);
  }
  public function view_document_request($is_no){
    $this->sess_legal();
    $data['title']= "Land Information";

    //display form
    $data['li']= $this->Land_model->getli_byid($is_no);
    $data['oi']= $this->Land_model->getoi_byid($is_no);
    $oi = $this->Land_model->getoi_byid($is_no);
    $data['ll']= $this->Land_model->getll_byid($is_no);
    $data['cp']= $this->Land_model->getcp_byid($oi['id']);
    $data['ud']= $this->Land_model->getud_info($is_no);
    $data['rstr'] = $this->Land_model->getrstr_byid($is_no);
    $data['li_pending'] = $this->Legal_model->getli_status_pending();
    $data['ud_pending'] = $this->Legal_model->getud_status_pending();
    $data['ud_uploaded'] = $this->Legal_model->getud_status_uploaded();
    $data['ud_checked'] = $this->Legal_model->getud_status_checked();
    $data['ud_incomplete'] = $this->Legal_model->getud_status_incomplete();
    $data['ud_resubmit'] = $this->Legal_model->getud_status_resubmit();
    $data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
    $data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();
    $this->render_template('legal/Documents_pending',$data);
  }

  public function checked_docu($is_no){
    $this->sess_legal();
    $name =  $this->session->userdata('firstname').' '.$this->session->userdata('lastname');
    $this->Legal_model->checked_docu($is_no, $name);      
  }

  public function pop_up_checked($id){
    $this->session->set_flashdata('notif','The Documents has been Checked!');
    redirect('Legal_f/legal/document_request');
  }

  public function incomplete_docu($is_no){
    $this->sess_legal();
    $name =  $this->session->userdata('firstname').' '.$this->session->userdata('lastname');
    $message = $this->input->post('message');
    $this->Legal_model->incomplete_docu($is_no, $name,$message);           
  }

  public function pop_up_incomplete($id){
    $this->session->set_flashdata('notif','The Documents are Incomplete!');
    redirect('Legal_f/legal/document_request');
  }

  // ==================================================
  // END DOCUMENTS
  // ==================================================
}