<?php
Class Ccd_notification_model extends CI_model{
	//==================================================
	//QUERY
	//==================================================
	public function get_all_approved(){
        $query = $this->db->query("SELECT * FROM land_info WHERE status='Approved' ");
        return $query->result_array();
    }
    //==================================================
	//END QUERY
	//==================================================

	//==================================================
	//EXECUTE TABPANE NOTIFICATION
	//==================================================
	public function get_aspayment_pending(){
		$query = $this->db->query("
			SELECT ld.*, pr.*
			FROM land_info ld
			JOIN payment_requests pr ON ld.is_no = pr.is_no
			WHERE ld.tag = 'New LAPF-ES' AND ld.status = 'Pending' AND pr.status = 'Pending'
		");

		return $query->num_rows();
	}
	public function get_aspayment_approved(){
		$query = $this->db->query("
			SELECT ld.*, pr.*
			FROM land_info ld
			JOIN payment_requests pr ON ld.is_no = pr.is_no
			WHERE ld.tag = 'New LAPF-ES' AND ld.status = 'Approved' AND pr.status = 'Pending'
		");

		return $query->num_rows();
	}
	public function get_aspayment_disapproved(){
		$query = $this->db->query("
			SELECT ld.*, pr.*
			FROM land_info ld
			JOIN payment_requests pr ON ld.is_no = pr.is_no
			WHERE ld.tag = 'New LAPF-ES' AND ld.status = 'Disapproved' AND pr.status = 'Pending'
		");

		return $query->num_rows();
	}
	//==================================================
	//END EXECUTE TABPANE NOTIFICATION
	//==================================================
}