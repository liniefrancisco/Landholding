<?php
class Notification_bar_model extends CI_Model{
	public function getds_status_pending(){
		$query = $this->db->query("
			SELECT li.*, ds.*
			FROM land_info li
			JOIN document_status ds ON li.is_no = ds.is_no
			WHERE li.tag = 'New' AND ds.status = 'Pending'
		");
		return $query->num_rows();
	}
	public function getds_status_reviewed(){
		$query = $this->db->query("
			SELECT li.*, ds.*
			FROM land_info li
			JOIN document_status ds ON li.is_no = ds.is_no
			WHERE li.tag = 'New' AND ds.status = 'Reviewed'
		");
		return $query->num_rows();
	}
	public function getds_status_returned(){
		$query = $this->db->query("
			SELECT li.*, ds.*
			FROM land_info li
			JOIN document_status ds ON li.is_no = ds.is_no
			WHERE li.tag = 'New' AND ds.status = 'Returned'
		");
		return $query->num_rows();
	}
	public function getds_status_approved(){
		$query = $this->db->query("
			SELECT li.*, ds.*
			FROM land_info li
			JOIN document_status ds ON li.is_no = ds.is_no
			WHERE li.tag = 'New' AND ds.status = 'Approved'
		");
		return $query->num_rows();
	}
	public function getds_status_approved1(){
		$query = $this->db->query("
			SELECT li.*, ds.*
			FROM land_info li
			JOIN document_status ds ON li.is_no = ds.is_no
			WHERE li.tag = 'New' AND ds.status = 'Approved'
		");
		return $query->result_array();
	}
	public function getds_status_disapproved(){
		$query = $this->db->query("
			SELECT li.*, ds.*
			FROM land_info li
			JOIN document_status ds ON li.is_no = ds.is_no
			WHERE li.tag = 'New' AND ds.status = 'Disapproved'
		");
		return $query->num_rows();
	}
	public function getpr_status_pending(){
		$query = $this->db->query("
			SELECT li.*, ds.*, pr.*
			FROM land_info li
			JOIN document_status ds ON li.is_no = ds.is_no
			JOIN payment_requests pr ON li.is_no = pr.is_no
			WHERE li.tag = 'New' AND ds.status = 'Approved' AND pr.status = 'Pending'
		");
		return $query->num_rows();
	}
	public function getpr_status_approved(){
		$query = $this->db->query("
			SELECT li.*, ds.*, pr.*
			FROM land_info li
			JOIN document_status ds ON li.is_no = ds.is_no
			LEFT JOIN payment_requests pr ON li.is_no = pr.is_no
			WHERE (li.tag = 'New' AND ds.status = 'Approved' AND pr.status = 'Approved')
		");
		return $query->num_rows();
	}
	public function getpr_status_approved1(){
		$query = $this->db->query("
			SELECT li.*, ds.*, pr.*
			FROM land_info li
			JOIN document_status ds ON li.is_no = ds.is_no
			LEFT JOIN payment_requests pr ON li.is_no = pr.is_no
	  		WHERE (li.tag IN('New', 'New LAPF-JS', 'New LAPF-ES') AND ds.status = 'Approved' AND pr.status = 'Approved')
		");
		return $query->num_rows();
	}
	public function getpr_status_paid(){
		$query = $this->db->query("
			SELECT li.*, ds.*, pr.*
			FROM land_info li
			JOIN document_status ds ON li.is_no = ds.is_no
			JOIN payment_requests pr ON li.is_no = pr.is_no
			WHERE (li.tag IN('New', 'New LAPF-JS', 'New LAPF-ES') AND ds.status = 'Approved' AND pr.status = 'Paid')
		");
		return $query->num_rows();
	}
	public function getpr_status_disapproved(){
		$query = $this->db->query("
			SELECT li.*, ds.*, pr.*
			FROM land_info li
			JOIN document_status ds ON li.is_no = ds.is_no
			JOIN payment_requests pr ON li.is_no = pr.is_no
			WHERE li.tag = 'New' AND ds.status = 'Approved' AND pr.status = 'Disapproved'
		");
		return $query->num_rows();
	}
	public function getds_status_pending_js(){
		$query = $this->db->query("
			SELECT li.*, ds.*
			FROM land_info li
			JOIN document_status ds ON li.is_no = ds.is_no
			WHERE li.tag = 'New LAPF-JS' AND ds.status = 'Pending'
		");
		return $query->num_rows();
	}
	public function getds_status_approved_js1(){
		$query = $this->db->query("
			SELECT li.*, ds.*
			FROM land_info li
			JOIN document_status ds ON li.is_no = ds.is_no
			WHERE li.tag = 'New LAPF-JS' AND ds.status = 'Approved'
		");
		return $query->result_array();
	}
	public function getds_status_pending_es(){
		$query = $this->db->query("
			SELECT li.*, ds.*
			FROM land_info li
			JOIN document_status ds ON li.is_no = ds.is_no
			WHERE li.tag = 'New LAPF-ES' AND ds.status = 'Pending'
		");
		return $query->num_rows();
	}
	public function getds_status_pending_js_es() {
	    $query = $this->db->query("
	        SELECT li.*, ds.*
	        FROM land_info li
	        JOIN document_status ds ON li.is_no = ds.is_no
	        JOIN payment_requests pr ON li.is_no = pr.is_no
	        WHERE (li.tag = 'New LAPF-JS' OR li.tag = 'New LAPF-ES')
	        AND ds.status = 'Pending'
	        AND pr.status = 'Pending'
	    ");
	    return $query->num_rows();
	}
	public function getds_status_approved_js_es() {
	    $query = $this->db->query("
	        SELECT li.*, ds.*
	        FROM land_info li
	        JOIN document_status ds ON li.is_no = ds.is_no
	        JOIN payment_requests pr ON li.is_no = pr.is_no
	        WHERE (li.tag = 'New LAPF-JS' OR li.tag = 'New LAPF-ES')
	        AND ds.status = 'Approved'
	        AND pr.status = 'Approved'
	    ");
	    return $query->num_rows();
	}
	public function getds_status_disapproved_js_es() {
	    $query = $this->db->query("
	        SELECT li.*, ds.*
	        FROM land_info li
	        JOIN document_status ds ON li.is_no = ds.is_no
	        JOIN payment_requests pr ON li.is_no = pr.is_no
	        WHERE (li.tag = 'New LAPF-JS' OR li.tag = 'New LAPF-ES')
	        AND ds.status = 'Disapproved'
	        AND pr.status = 'Disapproved'
	    ");
	    return $query->num_rows();
	}
	public function getds_status_paid_js_es() {
	    $query = $this->db->query("
	        SELECT li.*, ds.*
	        FROM land_info li
	        JOIN document_status ds ON li.is_no = ds.is_no
	        JOIN payment_requests pr ON li.is_no = pr.is_no
	        WHERE (li.tag = 'New LAPF-JS' OR li.tag = 'New LAPF-ES')
	        AND ds.status = 'Approved'
	        AND pr.status = 'Paid'
	    ");
	    return $query->num_rows();
	}
	public function get_unread_error_logs_count() {
        $logsDirectory 	= APPPATH . 'logs/'; // Path to logs folder
        $logFiles 		= scandir($logsDirectory); // Scan log files
        $unreadCount 	= 0;
        
        foreach ($logFiles as $file) {
            if (is_file($logsDirectory . $file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                $logContents = file($logsDirectory . $file); // Read file line by line
                
                foreach ($logContents as $line) {
                    if (strpos($line, 'ERROR') !== false && strpos($line, '[READ]') === false) {
                        $unreadCount++; // Count only unread logs
                    }
                }
            }
        }
        return $unreadCount; // Return total unread error logs
    }
}