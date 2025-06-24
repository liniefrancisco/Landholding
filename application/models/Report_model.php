<?php
class Report_model extends CI_Model{
	public function getlot_largest(){
    $query = $this->db->query("
      SELECT *
      FROM land_info li
      JOIN document_status ds ON li.is_no = ds.is_no
      WHERE ds.status = 'Approved'
      ORDER BY li.lot_size DESC
      LIMIT 10
    ");
    return $query->result_array();
	}
	public function getlot_smallest(){
    $query = $this->db->query("
      SELECT *
      FROM land_info li
      JOIN document_status ds ON li.is_no = ds.is_no
      WHERE ds.status = 'Approved'
      ORDER BY li.lot_size ASC
      LIMIT 10
    ");
    return $query->result_array();
  }
	public function getlot_location(){
    $query = $this->db->get('lot_location');
    return $query->result_array();
 	}
 	public function select_empty($is_no){
		$sql 		= "SELECT * FROM uploaded_documents WHERE is_no = ? ";
    $query 	= $this->db->query($sql, array($is_no));
		return $query->row_array();
	}
}