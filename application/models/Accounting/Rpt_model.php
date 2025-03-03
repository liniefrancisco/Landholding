<?php
class Rpt_model extends CI_Model{
  //==================================================
  //INSERT,UPDATE
  //==================================================
  public function checkStatusPending($selectedMunicipality){
    $query = $this->db
        ->select('COUNT(*) as num_rows')
        ->from('real_property_tax rpt')
        ->join('lot_location ll', 'rpt.is_no = ll.is_no', 'left')
        ->where('ll.municipality', $selectedMunicipality)
        ->where('rpt.status', 'Pending')
        ->get();

    $result = $query->row_array();
    return $result['num_rows'] > 0;
  }

  public function updateStatusForMunicipality($selectedMunicipality,$name){
    $data = array(
      'crf_no' => $this->input->post('crf_no'),
      'type' => 'Real Property Tax',
      'pay_to' => $this->input->post('pay_to'),
      'amount'=> $this->input->post('amount'),
      'payed_by' => $name,
      'date_requested' => $this->input->post('date_requested'),
      'bank' => $this->input->post('bank'),
      'cheque_no' => $this->input->post('cheque_no'),
      'cheque_date' => $this->input->post('cheque_date'),
      'particular' => $this->input->post('particular'),
    );
    $this->db->insert('check_request_form', $data);

    $this->db
        ->set('status', 'Processing')
        ->where('real_property_tax.is_no IN (SELECT is_no FROM lot_location WHERE municipality = ' . $this->db->escape($selectedMunicipality) . ')', null, false)
        ->where('real_property_tax.status', 'Pending')
        ->update('real_property_tax');
  }
  //==================================================
  //END INSERT,UPDATE
  //==================================================

	//==================================================
	//QUERY
	//==================================================
  public function getcrf(){
    $query = $this->db->query("SELECT * FROM check_request_form");
    return $query->result_array();
  }
  public function getland_information(){
    $query = $this->db->get('land_info');
    return $query->result_array();
  }
  public function getowner_info(){
    $query = $this->db->get('owner_info');
    return $query->result_array();
  }
  public function getlot_location(){
    $query = $this->db->get('lot_location');
    return $query->result_array();
  }
  public function getmunicipality() {
    $query = $this->db
        ->select('lot_location.municipality, lot_location.province AS province')
        ->from('real_property_tax')
        ->join('lot_location', 'lot_location.is_no = real_property_tax.is_no', 'left')
        ->where('real_property_tax.status', 'Pending')
        ->get();
    return $query->result_array();
	}
  public function getDataForMunicipality($selectedMunicipality) {
    $query = $this->db
      ->select('real_property_tax.is_no,start_date,end_date,tax_dec_no,firstname,middlename,lastname,baranggay,lot_type,amount,rpt_file')
      ->from('real_property_tax')
      ->join('lot_location', 'lot_location.is_no = real_property_tax.is_no', 'left')
      ->join('land_info', 'land_info.is_no = real_property_tax.is_no', 'left')
      ->join('owner_info', 'owner_info.is_no = real_property_tax.is_no', 'left')
      ->where('lot_location.municipality', $selectedMunicipality)
      ->where('real_property_tax.status', 'Pending')
      ->get();

    return $query->result_array();
  }
	//==================================================
	//END QUERY
	//==================================================
}