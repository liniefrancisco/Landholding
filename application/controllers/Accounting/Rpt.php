<?php
class Rpt extends App_Controller{
	public function __construct(){
		parent::__construct();
		$this->not_logged_in();
		// Load the model
		$this->load->model('Accounting/Rpt_model');
    $this->load->model('Accounting/Accounting_notification_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('security');
	}

	//==================================================
  //REAL PROPERTY TAX FORM
  //==================================================
  public function index(){
  	$this->sess_acctng();
    $data['title'] = "Real Property Tax";

    //Sidebar Notification
    $data['accounting_payment_request'] = $this->Accounting_notification_model->payment_request_notification();
    //End

    //Data Table
    $data['crf_id'] = $this->Rpt_model->getcrf();
    $data['land_info']= $this->Rpt_model->getland_information();
    $data['owner_info']= $this->Rpt_model->getowner_info();
    $data['lot_location']= $this->Rpt_model->getlot_location();
    $data['municipality']= $this->Rpt_model->getmunicipality();
    //End
    $this->render_template('accounting/real_property_tax/rpt_table',$data);
  }

  public function getDataForMunicipality($selectedMunicipality){
    try {
      $dataForMunicipality = $this->Rpt_model->getDataForMunicipality($selectedMunicipality);
      echo json_encode($dataForMunicipality);
    } catch (Exception $e) {
      echo json_encode(array('error' => $e->getMessage()));
    }
  }

  public function submit_crf_rpt() {
    // Sidebar Notification
    $data['accounting_payment_request'] = $this->Accounting_notification_model->payment_request_notification();
    // End 

    $this->form_validation->set_rules('crf_no', 'CRF No.', 'required');
    $this->form_validation->set_rules('pay_to', 'Pay to', 'required');

    if($this->form_validation->run() == FALSE){
      $this->render_template('accounting/real_property_tax/rpt_table', $data);
    }else{
      if (!isset($_POST['submit_crf'])) {
        redirect('');
      }

      $name =  $this->session->userdata('firstname').' '.$this->session->userdata('lastname');
      $selectedMunicipality = $this->input->post('townn');
      $isPending = $this->Rpt_model->checkStatusPending($selectedMunicipality);

      if ($isPending) {
        $this->Rpt_model->updateStatusForMunicipality($selectedMunicipality,$name);
        $this->session->set_flashdata('notif','Cheque Request Form has been created successfully!');
        redirect('Accounting/Rpt');
      }else{
        $this->session->set_flashdata('notif','Failed!');
        redirect('Accounting/Rpt');
      }
    }
  }

  public function convert_number(){
    $amount = $this->input->post('amount');
    
    // Split the amount into whole and decimal parts
    $parts = explode('.', $amount);

    // Check if the decimal part exists
    $whole = isset($parts[0]) ? $parts[0] : '';
    $decimal = isset($parts[1]) ? $parts[1] : '';

    // Convert the whole part
    $result = $this->convert_number_logic($whole) . " Pesos";

    // Add the decimal part if present
    if (!empty($decimal)) {
      $result .= " and " . $this->convert_number_logic($decimal) . " Centavos";
    }

    echo $result;
  }

  private function convert_number_logic($amount) {
    if (($amount < 0) || ($amount > 999999999)) {
      throw new Exception("Number is out of range");
    }

    $Gn = floor($amount / 1000000);
    /* Millions (giga) */
    $amount -= $Gn * 1000000;
    $kn = floor($amount / 1000);
    /* Thousands (kilo) */
    $amount -= $kn * 1000;
    $Hn = floor($amount / 100);
    /* Hundreds (hecto) */
    $amount -= $Hn * 100;
    $Dn = floor($amount / 10);
    /* Tens (deca) */
    $n = $amount % 10;
    /* Ones */
    $res = "";
    if ($Gn) {
      $res .= $this->convert_number_logic($Gn) . " Million";
    }
    if ($kn) {
      $res .= (empty($res) ? "" : " ") . $this->convert_number_logic($kn) . " Thousand";
    }
    if ($Hn) {
      $res .= (empty($res) ? "" : " ") . $this->convert_number_logic($Hn) . " Hundred";
    }
    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
    if ($Dn || $n) {
      if (!empty($res)) {
        $res .= " and ";
      }
      if ($Dn < 2) {
        $res .= $ones[$Dn * 10 + $n];
      } else {
        $res .= $tens[$Dn];
        if ($n) {
          $res .= "-" . $ones[$n];
        }
      }
    }
    if (empty($res)) {
      $res = "zero";
    }

    return $res;
  }
  //==================================================
  //END REAL PROPERTY TAX FORM
  //==================================================
}