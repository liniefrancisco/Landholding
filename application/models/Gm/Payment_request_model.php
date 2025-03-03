<?php
class Payment_request_model extends CI_Model{
	//==================================================
	//DATA-TABLES
	//==================================================
	function __construct() {
		// Set table name
		$this->table = "land_info";
		// Set orderable column fields
		if($this->uri->segment(3) == 'pending_payment_request'){
			$this->column_order = array('firstname','middlename','lastname','lot_type','street','baranggay','municipality','province','submission_date');
		}else if($this->uri->segment(3) == 'datatable_approved_payment_request'){
			$this->column_order = array('firstname','middlename','lastname','lot_type','street','baranggay','municipality','province','submission_date');
		}else if($this->uri->segment(3) == 'datatable_disapproved_payment_request'){
			$this->column_order = array('firstname','middlename','lastname','lot_type','street','baranggay','municipality','province','submission_date');
		}else if($this->uri->segment(3) == 'datatable_paid_payment_request'){
			$this->column_order = array('firstname','middlename','lastname','lot_type','street','baranggay','municipality','province','submission_date');
		}

		// Set searchable column fields
		if($this->uri->segment(3) == 'pending_payment_request'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)",'submission_date');
		}else if($this->uri->segment(3) == 'datatable_approved_payment_request'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)",'submission_date');
		}else if($this->uri->segment(3) == 'datatable_disapproved_payment_request'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)",'submission_date');
		}else if($this->uri->segment(3) == 'datatable_paid_payment_request'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)",'submission_date');
		}
		// Set default order
		$this->order = array('land_info.is_no' => 'asc');
	}
		
	/*
	 * Fetch members data from the database
	 * @param $_POST filter data based on the posted parameters
	*/
	public function get_row($postData){
		$this->_get_datatables_query($postData);
		if($postData['length'] != -1){
			$this->db->limit($postData['length'], $postData['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}

	/*
	 * Count all records
	*/
	public function countAll(){
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
		
	/*
	 * Count records based on the filter params
	 * @param $_POST filter data based on the posted parameters
	*/
	public function countFiltered($postData){
		$this->_get_datatables_query($postData);
		$query = $this->db->get();
		return $query->num_rows();
	}

	/*
	 * Perform the SQL queries needed for an server-side processing requested
	 * @param $_POST filter data based on the posted parameters
	 */
	private function _get_datatables_query($postData){
		if($this->uri->segment(3) == 'pending_payment_request'){
			$this->db
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join( 'owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join( 'document_status', 'document_status.is_no = land_info.is_no', 'left')
				->join('payment_requests', 'payment_requests.is_no = land_info.is_no', 'left')
				->group_start()
					->where('land_info.tag', 'New')
                    ->where('document_status.status', 'Approved')
                    ->where('payment_requests.status', 'Pending')
                ->group_end();
                // ->or_group_start()
                //     ->where('land_info.status', 'Pending')
                //     ->where('land_info.tag', 'New LAPF-ES')
                //     ->where('payment_requests.status', 'Pending')
                // ->group_end();
		}else if($this->uri->segment(3) == 'datatable_approved_payment_request'){
			$this->db
				->select('land_info.*, 
		                  lot_location.*, 
		                  uploaded_documents.*, 
		                  owner_info.*, 
		                  payment_requests.*, 
		                  land_info.date_approved as li_date_approved,
		                  payment_requests.date_approved as pr_date_approved,
		                  IF(payment_requests.date_approved IS NOT NULL, payment_requests.date_approved, land_info.date_approved) as date_approved')
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join( 'owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->join('payment_requests', 'payment_requests.is_no = land_info.is_no', 'left')
				->group_start()
                    ->where('land_info.status', 'Approved')
                    ->where('land_info.tag', 'New')
                    ->where('payment_requests.status', 'Approved')
                ->group_end()
                ->or_group_start()
                    ->where('land_info.status', 'Approved')
                    ->where('land_info.tag', 'New LAPF-ES')
                    ->where('payment_requests.status', 'Pending')
                ->group_end();
		}else if($this->uri->segment(3) == 'datatable_disapproved_payment_request'){
			$this->db
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join( 'owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->join('payment_requests', 'payment_requests.is_no = land_info.is_no', 'left')
				->group_start()
                    ->where('land_info.status', 'Approved')
                    ->where('land_info.tag', 'New')
                    ->where('payment_requests.status', 'Disapproved')
                ->group_end()
                ->or_group_start()
                    ->where('land_info.status', 'Disapproved')
                    ->where('land_info.tag', 'New LAPF-ES')
                    ->where('payment_requests.status', 'Pending')
                ->group_end();
		}else if($this->uri->segment(3) == 'datatable_paid_payment_request'){
			$this->db
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join( 'owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->join('payment_requests', 'payment_requests.is_no = land_info.is_no', 'left')
				->where('land_info.status', 'Approved')
				->where('land_info.tag', 'New')
				->where('payment_requests.status', 'Paid');
		}

 
		$i = 0;
		// loop searchable columns 
		foreach($this->column_search as $item){
			// if datatable send POST for search
			if($postData['search']['value']){
				// first loop
				if($i===0){
					// open bracket
					$this->db->group_start();
					$this->db->like($item, $postData['search']['value']);
				}else{
					$this->db->or_like($item, $postData['search']['value']);
				}
						 
				// last loop
				if(count($this->column_search) - 1 == $i){
					// close bracket
					$this->db->group_end();
				}
			}
			$i++;
		}
				 
		if(isset($postData['order'])){
			$this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
		}else if(isset($this->order)){
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	//==================================================
	//END
	//==================================================

	//==================================================
	//INSERT/UPDATE/DELETE
	//==================================================
	public function approve_full_payment($fp_control_no,$name,$action){
	    $data = array(
	      'status' => $action,
	      'date_approved' => date("Y-m-d"),
	      'approved_by' => $name,
	    );
	    $this->db->where('fp_control_no', $fp_control_no);
	    $this->db->update('payment_requests', $data);
  	}
  	public function notify_user($form_type,$action,$is_no,$recipient){
	    $data = array(
	      	'form_type' => $form_type,
	      	'reference_id' => $is_no,
	      	'action' => $action,
	      	'recipient' => $recipient,
	      	'status' => "unread",
	      	'date' => date('Y-m-d g:i:s'),
	    );
	    $this->db->insert('notification', $data);
  	}
  	public function disapprove_full_payment($is_no,$name,$reason){
	    $data = array(
	      	'status' => "Disapproved",
	      	'reason_disapproved' => $reason,
	      	'date_disapproved' => date("Y-m-d"),
	      	'disapproved_by' => $name
	    );
	    $this->db->where('is_no',$is_no);
	    $this->db->update('payment_requests', $data);
  	}
  	public function approve_cash_advance($id,$name,$action){
	    $data = array(
	      	'status' => $action,
	      	'date_approved' => date("Y-m-d"),
	      	'approved_by' => $name,
	    );
	    $this->db->where('ca_control_no', $id);
	    $this->db->update('payment_requests', $data);
  	}
  	public function disapprove_cash_advance($id,$name,$action,$reason){
	    $data = array(
	      	'status' => $action,
	      	'reason_disapproved' => $reason,
	      	'date_disapproved' => date("Y-m-d"),
	      	'disapproved_by' => $name
	    );
	    $this->db->where('ca_control_no',$id);
	    $this->db->update('payment_requests', $data);
	}

  	public function approve_li_es($is_no,$name,$action){
	    $data = array(
	      'status' => $action,
	      'date_approved' => date("Y-m-d"),
	      'approved_by' => $name,
	    );
	    $this->db->where('is_no', $is_no);
	    $this->db->update('land_info', $data);
  	}
  	public function approve_ud_es($is_no,$name){
	    $data = array(
	      'status' => 'Checked Documents',
	      'date_checked' => date("Y-m-d"),
	      'checked_by' => $name,
	    );
	    $this->db->where('is_no', $is_no);
	    $this->db->update('uploaded_documents', $data);
  	}
  	public function disapprove_li_es($is_no,$name,$action,$reason){
	    $data = array(
	      	'status' => $action,
	      	'reason_disapproved' => $reason,
	      	'date_disapproved' => date("Y-m-d"),
	      	'disapproved_by' => $name
	    );
	    $this->db->where('is_no',$is_no);
	    $this->db->update('land_info', $data);
  	}
  	public function disapprove_ud_es($is_no,$name,$reason){
	    $data = array(
	      'status' => 'Disapproved Documents',
	      'reason_disapproved' => $reason,
	      'date_disapproved' => date("Y-m-d"),
	      'disapproved_by' => $name
	    );
	    $this->db->where('is_no', $is_no);
	    $this->db->update('uploaded_documents', $data);
  	}
  	//==================================================
	//END INSERT/UPDATE/DELETE
	//==================================================

	//==================================================
	//QUERY
	//==================================================
	public function getpr_disapproved() {
	    // $this->db->select('payment_requests.*, land_info.*'); // Select columns from both tables
	    // $this->db->from('payment_requests');
	    // $this->db->join('land_info', 'payment_requests.is_no = land_info.is_no'); // Join condition

	    // $this->db->group_start();
	    // $this->db->where('payment_requests.status', 'Disapproved'); // Add table name prefix to avoid ambiguity
	    // $this->db->group_start();
	    // $this->db->where('payment_requests.type', 'Cash Advance'); // Add table name prefix to avoid ambiguity
	    // $this->db->or_where('payment_requests.type', 'Full Payment');
	    // $this->db->group_end();
	    // $this->db->group_end();

	    // $this->db->or_group_start();
	    // $this->db->where('land_info.status', 'Disapproved');
	    // $this->db->where('payment_requests.type', 'Collateral');
	    // $this->db->group_end();

	    // $query = $this->db->get();
	    // return $query->result_array();
	}

	public function get_land_info(){
		$query = $this->db->get('land_info');
		return $query->result_array();
	}
	public function get_owner_info(){
		$query = $this->db->get('owner_info');
		return $query->result_array();
	}
	public function get_lot_location(){
		$query = $this->db->get('lot_location');
		return $query->result_array();
	}
	public function get_uploaded_documents(){
		$query = $this->db->get('uploaded_documents');
		return $query->result_array();
	}
	public function get_uploaded_documents_by_id($is_no){
		$query = $this->db->get_where('uploaded_documents',['is_no' => $is_no]);
		return $query->row_array();
	}
	public function get_land_info_by_id($id){
		$query = $this->db->get_where('land_info', array('is_no' => $id));
		return $query->row_array();
	}
	public function get_owner_info_by_id($id){
		$query = $this->db->get_where('owner_info', array('is_no' => $id));
		return $query->row_array();
	}
	public function get_lot_location_by_id($id){
		$query = $this->db->get_where('lot_location', array('is_no' => $id));
		return $query->row_array();
	}
	public function get_contact_person_by_id($id){
		$query = $this->db->get_where('contact_person', array('owner_id' => $id));
		return $query->row_array();
	}
	public function get_restrictions_to_land_title_by_id($id){
		$query = $this->db->get_where('restrictions_to_land_title', array('is_no' => $id));
		return $query->row_array();
	}
	public function get_payment_requests_by_fp($fp_control_no){
    	$query = $this->db->get_where('payment_requests', array('fp_control_no' => $fp_control_no)); 
    	return $query->row_array();
  	}
  	// public function get_payment_requests_by_es($is_no){
   //  	$query = $this->db->get_where('payment_requests', array('is_no' => $is_no)); 
   //  	return $query->row_array();
  	// }
  	public function get_payment_requests_by_es($is_no){
	    $this->db->select('payment_requests.*, land_info.*');
	    $this->db->from('payment_requests');
	    $this->db->join('land_info', 'payment_requests.is_no = land_info.is_no'); // Adjust the join condition based on your table structure
	    $this->db->where('payment_requests.is_no', $is_no);
	    $query = $this->db->get();
	    return $query->row_array();
	}
  	public function get_broker_info_by_id($id){
		$query = $this->db->get_where('broker_info', array('is_no'=> $id));
		return $query->row_array();
	}
	public function getform_req_byid($id){
	    $query = $this->db->get_where('forms', array('form_no'=> $id));
	    return $query->row_array();
  	}
  	public function get_acknowledgement_receipt_content($is_no) {
	    $targetPath = './assets/img/acknowledgement_receipt/' . $is_no . '/acknowledgement_receipt.txt';
	    
	    if (file_exists($targetPath)) {
	        return file_get_contents($targetPath);
	    } else {
	        return ''; // Return empty string if file does not exist
	    }
	}
	public function get_payment_requests_by_ca($ca_control_no){
	    $query = $this->db->get_where('payment_requests', array('ca_control_no' => $ca_control_no)); 
	    return $query->row_array();
  	}
  	public function getab_byid($id){
        $query = $this->db->get_where('amount_basis', array('reference_id' => $id));
        return $query->row_array();
    }
    public function getcbi_byid($id){
        $query = $this->db->get_where('customer_bal_info', array('reference_id' => $id));
        return $query->row_array();
    }
    public function getci_byid($id){
        $query = $this->db->get_where('customer_info', array('reference_id' => $id));
        return $query->row_array();
    }
    public function getca_byid($id){
        $query = $this->db->get_where('customer_address', array('customer_id' => $id));
        return $query->row_array();
    }
    public function getesupload_byid($id){
        $query = $this->db->get_where('es_uploads', array('reference_id' => $id));
        return $query->row_array();
    }
	//==================================================
	//END QUERY
	//==================================================
}