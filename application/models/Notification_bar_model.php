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
			JOIN payment_requests pr ON li.is_no = pr.is_no
			WHERE li.tag = 'New' AND ds.status = 'Approved' AND pr.status = 'Approved'
		");
		return $query->num_rows();
	}
	public function getpr_status_paid(){
		$query = $this->db->query("
			SELECT li.*, ds.*, pr.*
			FROM land_info li
			JOIN document_status ds ON li.is_no = ds.is_no
			JOIN payment_requests pr ON li.is_no = pr.is_no
			WHERE li.tag = 'New' AND ds.status = 'Approved' AND pr.status = 'Paid'
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
}