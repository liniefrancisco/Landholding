<?php
Class Gm_notification_model extends CI_model{
	//==================================================
	//ACQUISITION TABPANE NOTIFICATION
	//==================================================
	public function get_acquisition_pending(){
		$query = $this->db->query("
			SELECT ld.*, ud.*
			FROM land_info ld
			JOIN uploaded_documents ud ON ld.is_no = ud.is_no
			WHERE ld.tag = 'New' AND ld.status = 'Pending' AND ud.status = 'Checked Documents'
		");

		return $query->num_rows();
	}
	
	public function get_acquisition_approved(){
		$query = $this->db->query("
			SELECT ld.*, ud.*
			FROM land_info ld
			JOIN uploaded_documents ud ON ld.is_no = ud.is_no
			WHERE ld.tag = 'New' AND ld.status = 'Approved' AND ud.status = 'Checked Documents'
		");

		return $query->num_rows();
	}
	public function get_acquisition_return(){
		$query = $this->db->query("
			SELECT ld.*, ud.*
			FROM land_info ld
			JOIN uploaded_documents ud ON ld.is_no = ud.is_no
			WHERE ld.tag = 'New' AND ld.status = 'Return' AND ud.status = 'Checked Documents'
		");

		return $query->num_rows();
	}
	public function get_acquisition_disapproved(){
		$query = $this->db->query("
			SELECT ld.*, ud.*
			FROM land_info ld
			JOIN uploaded_documents ud ON ld.is_no = ud.is_no
			WHERE ld.tag = 'New' AND ld.status = 'Disapproved' AND ud.status = 'Checked Documents'
			OR ld.tag = 'New' AND ld.status = 'Pending' AND ud.status = 'Disapproved Documents'
		");

		return $query->num_rows();
	}
	//==================================================
	//END AQUISITION TABPANE NOTIFICATION
	//==================================================

	//==================================================
	//PAYMENT REQUEST TABPANE NOTIFICATION
	//==================================================
	public function get_payment_pending(){
		$query = $this->db->query("
			SELECT ld.*, pr.*
			FROM land_info ld
			JOIN payment_requests pr ON ld.is_no = pr.is_no
			WHERE ld.tag = 'New' AND ld.status = 'Approved' AND pr.status = 'Pending'
			OR ld.tag = 'New LAPF-ES' AND ld.status = 'Pending' AND pr.status = 'Pending'
		");

		return $query->num_rows();
	}
	public function get_payment_approved(){
		$query = $this->db->query("
			SELECT ld.*, pr.*
			FROM land_info ld
			JOIN payment_requests pr ON ld.is_no = pr.is_no
			WHERE ld.tag = 'New' AND ld.status = 'Approved' AND pr.status = 'Approved'
			OR ld.tag = 'New LAPF-ES' AND ld.status = 'Approved' AND pr.status = 'Pending'
		");

		return $query->num_rows();
	}
	public function get_payment_disapproved(){
		$query = $this->db->query("
			SELECT ld.*, pr.*
			FROM land_info ld
			JOIN payment_requests pr ON ld.is_no = pr.is_no
			WHERE ld.tag = 'New' AND ld.status = 'Approved' AND pr.status = 'Disapproved'
			OR ld.tag = 'New LAPF-ES' AND ld.status = 'Disapproved' AND pr.status = 'Pending'

		");

		return $query->num_rows();
	}
	public function get_payment_paid(){
		$query = $this->db->query("
			SELECT ld.*, pr.*
			FROM land_info ld
			JOIN payment_requests pr ON ld.is_no = pr.is_no
			WHERE ld.tag = 'New' AND ld.status = 'Approved' AND pr.status = 'Paid'
			OR ld.tag = 'New LAPF-ES' AND ld.status = 'Approved' AND pr.status = 'Paid'
		");

		return $query->num_rows();
	}
	//==================================================
	//END PAYMENT REQUEST TABPANE NOTIFICATION
	//==================================================

	//==================================================
	//ACQUISITION SIDEBAR NOTIFICATION
	//==================================================
	public function get_acquisition_count() {
	    $this->db->select('ld.*, ud.*');
	    $this->db->from('land_info ld');
	    $this->db->join('uploaded_documents ud', 'ld.is_no = ud.is_no');

	    $this->db->group_start()
	             ->where('ld.tag', 'New')
	             ->where('ld.status', 'Pending')
	             ->where('ud.status', 'Checked Documents')
	             ->group_end();

	    $query = $this->db->get(); // Execute the query
	    return $query->num_rows();
	}
	//==================================================
	//END ACQUISITION SIDEBAR NOTIFICATION
	//==================================================

	//==================================================
	//PAYMENT REQUEST SIDEBAR NOTIFICATION
	//==================================================
	public function get_payment_request_count() {
	    $this->db->select('ld.*, pr.*');
	    $this->db->from('land_info ld');
	    $this->db->join('payment_requests pr', 'ld.is_no = pr.is_no');

	    $this->db
	         ->group_start()
	            ->where('ld.tag', 'New')
	            ->where('ld.status', 'Approved')
	            ->where('pr.status', 'Pending')
	         ->group_end()
	         ->or_group_start()
	            ->where('ld.tag', 'New LAPF-ES')
	            ->where('ld.status', 'Pending')
	            ->where('pr.status', 'Pending')
	         ->group_end();

	    $query = $this->db->get(); // Execute the query
	    return $query->num_rows();
	}
	//==================================================
	//END PAYMENT REQUEST SIDEBAR NOTIFICATION
	//==================================================

	//==================================================
	//QUERY
	//==================================================
	public function get_all_pending(){
        $query = $this->db->query("SELECT * FROM land_info WHERE status='Pending' ");
        return $query->result_array();
    }
	public function get_all_approved(){
        $query = $this->db->query("SELECT * FROM land_info WHERE status='Approved' ");
        return $query->result_array();
    }
    //==================================================
	//END QUERY
	//==================================================
}