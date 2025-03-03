<?php
Class Execute_model extends CI_model{
	//==================================================
	//DATA-TABLES
	//==================================================
	function __construct() {
		// Set table name
		$this->table = "land_info";
		// Set orderable column fields
		if($this->uri->segment(3) == 'data_ccd_execute_pending_table'){
			$this->column_order = array('firstname','middlename','lastname','lot_type','street','baranggay','municipality','province','date_acquired');
		}else if($this->uri->segment(3) == 'data_ccd_execute_approved_table'){
			$this->column_order = array('firstname','middlename','lastname','lot_type','street','baranggay','municipality','province','date_acquired');
		}else if($this->uri->segment(3) == 'data_ccd_execute_disapproved_table'){
			$this->column_order = array('firstname','middlename','lastname','lot_type','street','baranggay','municipality','province','date_acquired');
		}

		// Set searchable column fields
		if($this->uri->segment(3) == 'data_ccd_execute_pending_table'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'date_acquired');
		}else if($this->uri->segment(3) == 'data_ccd_execute_approved_table'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'date_acquired');
		}else if($this->uri->segment(3) == 'data_ccd_execute_disapproved_table'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'date_acquired');
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
		if($this->uri->segment(3) == 'data_ccd_execute_pending_table'){
			$this->db
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join( 'owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->where('land_info.status', 'Pending')
		        ->group_start()
		            ->where('land_info.tag', 'New LAPF-JS')
		            ->or_where('land_info.tag', 'New LAPF-ES')
		        ->group_end()
		        ->where('uploaded_documents.status', 'Pending Documents'); 
		}else if($this->uri->segment(3) == 'data_ccd_execute_approved_table'){
			$this->db
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join( 'owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->where('land_info.status', 'Approved')
				->group_start()
		            ->where('land_info.tag', 'New LAPF-JS')
		            ->or_where('land_info.tag', 'New LAPF-ES')
		        ->group_end()
				->where('uploaded_documents.status', 'Checked Documents');
		}else if ($this->uri->segment(3) == 'data_ccd_execute_disapproved_table') {
		    $this->db
		        ->select('land_info.*, 
		                  uploaded_documents.*, 
		                  owner_info.firstname, 
		                  owner_info.middlename, 
		                  owner_info.lastname, 
		                  lot_location.street, 
		                  lot_location.baranggay, 
		                  lot_location.municipality, 
		                  lot_location.province, 
		                  land_info.date_disapproved as land_info_date_disapproved,
		                  land_info.disapproved_by as land_info_disapproved_by,
		                  land_info.reason_disapproved as land_info_reason_disapproved,
		                  uploaded_documents.date_disapproved as uploaded_documents_date_disapproved,
		                  uploaded_documents.disapproved_by as uploaded_documents_disapproved_by,
		                  uploaded_documents.reason_disapproved as uploaded_documents_reason_disapproved,
		                  uploaded_documents.status as uploaded_documents_status')
		        ->from('land_info')
		        ->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
		        ->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
		        ->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
		        ->group_start()
		            ->where('land_info.status', 'Disapproved')
		            ->where('uploaded_documents.status', 'Checked Documents')
		        ->group_end()
		        ->or_group_start()
		            ->where('land_info.status', 'Pending')
		            ->where('uploaded_documents.status', 'Disapproved Documents')
		        ->group_end();
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
	//END DATATABLE
	//==================================================

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
	public function getll_byid($id){
		$query = $this->db->get_where('lot_location', array('is_no' => $id));
		return $query->row_array();
	}
	public function getud_byid($id){
		$query = $this->db->get_where('uploaded_documents', array('is_no' => $id));
		return $query->row_array();
	}
	public function getci_byid($id){
        $query = $this->db->get_where('customer_info', array('reference_id' => $id));
        return $query->row_array();
    }
	public function getcbi_byid($id){
        $query = $this->db->get_where('customer_bal_info', array('reference_id' => $id));
        return $query->row_array();
    }
    public function getca_byid($id){
        $query = $this->db->get_where('customer_address', array('customer_id' => $id));
        return $query->row_array();
    }
    public function getbidding_byid($id){
        $query = $this->db->get_where('bidding_details', array('reference_id' => $id));
        return $query->row_array();
    }
    public function getab_byid($id){
        $query = $this->db->get_where('amount_basis', array('reference_id' => $id));
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