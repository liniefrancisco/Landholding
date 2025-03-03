<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends App_Controller{
  public function __construct(){
    parent::__construct();
    $this->not_logged_in();
    // Load the model
    $this->load->model('Secretary/Pdf_model');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->library('m_pdf');
    $this->load->helper('url');
  }

  //==================================================
  //SUMMARY OF PAYMENT
  //==================================================
  public function summary_of_payment($is_no){
    $data['is_no'] = $is_no;
    $data['li']= $this->Pdf_model->getli_byid($is_no);
    $data['oi']= $this->Pdf_model->getoi_byid($is_no);
    $data['pt_details'] = $this->Pdf_model->getpt_details($is_no);
    $data['pr_details'] = $this->Pdf_model->getpr_details($is_no);

    $html = $this->load->view('secretary/Progress/summary_of_payment_pdf', $data, true); 

    $pdfFilePath ="summary of payment".".pdf"; 
    $pdf = $this->m_pdf->load();
    $stylesheet = '<style>'.file_get_contents('assets/import/vendors/bootstrap/dist/css/bootstrap.min.css').'</style>';
    $css = '<style>'.file_get_contents('assets/import/build/css/custom.min.css').'</style>';
    // apply external css
    $pdf->WriteHTML($css);
    $pdf->WriteHTML($stylesheet);
    $pdf->WriteHTML($html);
    $pdf->Output($html, "I");
    exit;
  }
  //==================================================
  //END
  //==================================================
}