<?php 
class Progress_model extends CI_Model{
	//==================================================
	//QUERY
	//==================================================
	public function getpayment_status_approved() {
	    $query = $this->db->query("
	        SELECT pr.*
	        FROM payment_requests pr
	        INNER JOIN (
	            SELECT is_no, MAX(id) as max_id
	            FROM payment_requests
	            WHERE status IN ('Approved', 'Processing', 'Paid')
	            GROUP BY is_no
	        ) grouped_pr ON pr.is_no = grouped_pr.is_no AND pr.id = grouped_pr.max_id
	    ");
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
	public function getoi_byid($id){
		$query = $this->db->get_where('owner_info', array('is_no' => $id));
		return $query->row_array();
	}
	public function getll_byid($id){
		$query = $this->db->get_where('lot_location', array('is_no' => $id));
		return $query->row_array();
	}
	public function getli_byid($id){
		$query = $this->db->get_where('land_info', array('is_no' => $id));
		return $query->row_array();
	}
	public function getpr_byid($id){
		$query = $this->db->get_where('payment_requests', array('is_no' => $id));
		return $query->result_array();
	}
	public function getpr_byid1($id){
		$sql= "SELECT * from payment_requests where is_no = ? and type = 'Full Payment' and status = 'Approved'";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}
	public function getcp_byid($id){
		$query = $this->db->get_where('contact_person', array('owner_id'=> $id));
		return $query->row_array();
	}
	public function getud_byid($id){
		$query = $this->db->get_where('uploaded_documents', array('is_no'=> $id));
		return $query->row_array();
	}
	public function getbi_byid($id){
		$query = $this->db->get_where('broker_info', array('is_no'=> $id));
		return $query->row_array();
	}
	// public function getpr_data($id){
	// 	$sql= "SELECT * from payment_requests where is_no = ? and type = 'Cash Advance' and status ='Approved'";
	// 	$query = $this->db->query($sql, array($id));
	// 	return $query->result_array();
	// }
	public function getpr_data($id){
	    $sql = "SELECT * FROM payment_requests WHERE is_no = ? AND type = 'Cash Advance' AND (status = 'Approved' OR status = 'Paid')";
	    $query = $this->db->query($sql, array($id));
	    return $query->result_array();
	}

	public function getcrf_data($id){
		$sql= "SELECT * from check_request_form where is_no = ? and type = 'Cash Advance'";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
	public function getcrf_byid($id){
		$query = $this->db->get_where('check_request_form', array('ca_control_no' => $id)); 
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
	public function getpr_info($id){
		$sql= "SELECT * from payment_requests where is_no = ? and type = 'Cash Advance'";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
	public function getrstr_byid($id){
		$query = $this->db->get_where('restrictions_to_land_title', array('is_no' => $id));
		return $query->row_array();
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
	public function getfp_info($id) {
	    $sql = "SELECT * 
	            FROM payment_requests 
	            WHERE is_no = ? 
	              AND type = 'Full Payment' 
	              AND status IN ('Approved', 'Processing', 'Paid')";
	    $query = $this->db->query($sql, array($id));
	    return $query->result_array();
	}

	public function getpt_info($id){
		$sql = "SELECT * FROM payment_transaction WHERE is_no = ? ORDER BY transaction_date DESC LIMIT 1";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}
	//==================================================
	//END QUERY
	//==================================================
}