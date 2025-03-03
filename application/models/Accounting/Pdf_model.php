<?php
class Pdf_model extends CI_Model{
	//==================================================
  //QUERY
  //==================================================
	public function getli_byid($id){
    $query = $this->db->get_where('land_info', array('is_no' => $id));
    return $query->row_array();
  }
  public function getoi_byid($id){
    $query = $this->db->get_where('owner_info', array('is_no' => $id));
    return $query->row_array();
  }
  public function getpt_details($id){
    $sql = "SELECT * from payment_transaction where is_no = ? ORDER BY transaction_date ASC ";
    $query = $this->db->query($sql, array($id));
    return $query->result_array();
  }
  public function getpr_details($id){
    $sql= "SELECT * from payment_requests where is_no = ?";
    $query = $this->db->query($sql, array($id));
    return $query->result_array();
  }
  public function getremaining_balance($id){
    $sql = "SELECT * FROM payment_transaction WHERE is_no = ? ORDER BY transaction_date DESC LIMIT 1";
    $query = $this->db->query($sql, array($id));
    return $query->row_array();
  }
  public function getpaid_ca($id){
    $query = $this->db->get_where('payment_transaction', array('is_no'=>$id));
    $ca = 0;
    foreach ($query->result_array() as $caa){
      $ca = $ca + $caa['amount'];
    }
    return $ca;
  }
  public function getca_transaction($id){
    $sql = "SELECT * from payment_transaction where ca_control_no = ? ORDER BY transaction_date DESC";
    $query = $this->db->query($sql, array($id));
    return $query->row_array();
  }
  //==================================================
  //END
  //==================================================
}