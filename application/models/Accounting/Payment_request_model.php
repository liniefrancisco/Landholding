<?php
class Payment_request_model extends CI_Model{
	//==================================================
	//DATATABLE
	//==================================================
	function __construct() {
		// Set table name
		$this->table = "land_info";
		// Set orderable column fields
		if($this->uri->segment(3) == 'datatable_pending_payment_request'){
			$this->column_order = array('firstname','middlename','lastname','lot_type','street','baranggay','municipality','province','submission_date');
		}else if($this->uri->segment(3) == 'datatable_created_payment_request1'){
			$this->column_order = array('firstname','middlename','lastname','lot_type','street','baranggay','municipality','province','submission_date');
		}

		// Set searchable column fields
		if($this->uri->segment(3) == 'datatable_pending_payment_request'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)",'submission_date');
		}else if($this->uri->segment(3) == 'datatable_created_payment_request1'){
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
		//var_dump($this->db->last_query());
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
	// private function _get_datatables_query($postData){
	// 	if($this->uri->segment(3) == 'datatable_pending_payment_request'){
	// 		$this->db
	// 			->from('land_info')
	// 			->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
	// 			->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
	// 			->join( 'owner_info', 'owner_info.is_no = land_info.is_no', 'left')
	// 			->join('payment_requests', 'payment_requests.is_no = land_info.is_no', 'left')
	// 			// ->where('land_info.status', 'Approved')
	// 			// ->where('land_info.tag', 'New')
	// 			// ->where('payment_requests.status', 'Approved');

	// 			->group_start()
	// 	            ->where('land_info.status', 'Approved')
	// 	            ->where('land_info.tag', 'New')
	// 	            ->where('payment_requests.status', 'Approved')
	// 	        ->group_end()
	// 	        ->or_group_start()
	// 	            ->where('land_info.status', 'Pending')
	// 	            ->where('land_info.tag', 'New LAPF-ES')
	// 	        ->group_end();
	// 	}else if($this->uri->segment(3) == 'datatable_created_payment_request1'){
	// 		$this->db
	// 			->from('land_info')
	// 			->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
	// 			->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
	// 			->join( 'owner_info', 'owner_info.is_no = land_info.is_no', 'left')
	// 			->join( 'payment_requests', 'payment_requests.is_no = land_info.is_no', 'left')
	// 			->join('check_request_form', 'check_request_form.is_no = land_info.is_no', 'left')
	// 			->where('land_info.status', 'Approved')
	// 			->where('land_info.tag', 'New')
	// 			->where('check_request_form.status', 'Pending');
	// 	}

 
	// 	$i = 0;
	// 	// loop searchable columns 
	// 	foreach($this->column_search as $item){
	// 		// if datatable send POST for search
	// 		if($postData['search']['value']){
	// 			// first loop
	// 			if($i===0){
	// 				// open bracket
	// 				$this->db->group_start();
	// 				$this->db->like($item, $postData['search']['value']);
	// 			}else{
	// 				$this->db->or_like($item, $postData['search']['value']);
	// 			}
						 
	// 			// last loop
	// 			if(count($this->column_search) - 1 == $i){
	// 				// close bracket
	// 				$this->db->group_end();
	// 			}
	// 		}
	// 		$i++;
	// 	}
				 
	// 	if(isset($postData['order'])){
	// 		$this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
	// 	}else if(isset($this->order)){
	// 		$order = $this->order;
	// 		$this->db->order_by(key($order), $order[key($order)]);
	// 	}
	// }

	private function _get_datatables_query($postData){
        if($this->uri->segment(3) == 'datatable_pending_payment_request'){
            $this->db
                ->select('land_info.is_no, owner_info.firstname, owner_info.middlename, owner_info.lastname, 
                          lot_location.street, lot_location.baranggay, lot_location.municipality, lot_location.province, 
                          land_info.submission_date, land_info.lot_type, payment_requests.type, land_info.tag, 
                          payment_requests.ca_control_no, payment_requests.fp_control_no')
                ->from('land_info')
                ->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
                ->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
                ->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
                ->join('payment_requests', 'payment_requests.is_no = land_info.is_no', 'left')
                ->group_start()
                    ->where('land_info.status', 'Approved')
                    ->where('land_info.tag', 'New')
                    ->where('payment_requests.status', 'Approved')
                ->group_end()
                ->or_group_start()
                    ->where('land_info.status', 'Approved')
                    ->where('land_info.tag', 'New LAPF-ES')
                ->group_end();
        } else if($this->uri->segment(3) == 'datatable_created_payment_request1'){
            $this->db
                ->select('land_info.is_no, owner_info.firstname, owner_info.middlename, owner_info.lastname, 
                          lot_location.street, lot_location.baranggay, lot_location.municipality, lot_location.province, 
                          land_info.submission_date, land_info.lot_type, payment_requests.type, land_info.tag, 
                          payment_requests.ca_control_no, payment_requests.fp_control_no')
                ->from('land_info')
                ->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
                ->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
                ->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
                ->join('payment_requests', 'payment_requests.is_no = land_info.is_no', 'left')
                ->join('check_request_form', 'check_request_form.is_no = land_info.is_no', 'left')
                ->where('land_info.status', 'Approved')
                ->where('land_info.tag', 'New')
                ->where('check_request_form.status', 'Pending');
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
                } else {
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
        } else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
	//==================================================
	//END DATATABLE
	//==================================================

	//==================================================
	//INSERT,UPDATE
	//==================================================
	public function insert_crf_ca($id, $amount, $rbal, $tprice, $ca_control_no, $name){
		$query = $this->db->get_where('payment_transaction', array('is_no' => $id));
		$count = $query->num_rows(); // Counting the results from the query

		$total_price = $tprice; //Get the Total Price
		$previous_balance = $rbal; // Get the previous remaining balance

		if($count === 0){
			$remaining_balance = $total_price - $amount;
		}else{
			$remaining_balance = $previous_balance - $amount;
		}

		$data = array(
			'is_no' => $this->input->post('is_no'),
			'ca_control_no' => $ca_control_no,
			'type' => 'Cash Advance',
			'crf_no' => $this->input->post('crf_no'),
			'amount' => $amount,
			'remaining_balance' => $remaining_balance,
			'date_requested' => $this->input->post('date_requested'),
			'date_payed' => date("Y-m-d"),
			'payed_by' => $name,
		);
		$this->db->insert('payment_transaction', $data);

		$data1 = array(
			'is_no' => $this->input->post('is_no'),
			'crf_no' => $this->input->post('crf_no'),
			'type' => 'Cash Advance',
			'pay_to' => $this->input->post('pay_to'),
			'amount'=> $amount,
			'remaining_balance' => $remaining_balance,
			'payed_by' => $name,
			'date_created' => date("Y-m-d"),
			'bank' => $this->input->post('bank'),
			'cheque_no' => $this->input->post('cheque_no'),
			'cheque_date' => $this->input->post('cheque_date'),
			'particular' => $this->input->post('particular'),
			'ca_control_no' => $ca_control_no,
			'status' => 'Pending',
		);
		$this->db->insert('check_request_form', $data1);

		$data2 = array(
			'status' => 'Paid',
		);
		$this->db->where('is_no',$id);
		$this->db->where('ca_control_no',$ca_control_no);
		$this->db->where('status','Approved');
		$this->db->update('payment_requests', $data2);
	}

	public function insert_crf_fp($id,$amount,$rbal, $tprice,$fp_control_no,$name){
		$query = $this->db->get_where('payment_transaction', array('is_no' => $id));
		$count = $query->num_rows(); // Counting the results from the query

		$total_price = $tprice; //Get the Total Price
		$previous_balance = $rbal; // Get the previous remaining balance

		if($count === 0){
			$remaining_balance = $total_price - $amount;
		}else{
			$remaining_balance = $previous_balance - $amount;
		}

		$data = array(
			'is_no' => $this->input->post('is_no'),
			'fp_control_no' => $fp_control_no,
			'crf_no' => $this->input->post('crf_no'),
			'type' => 'Full Payment',
			'amount' => $amount,
			'remaining_balance' => $remaining_balance,
			'date_requested' => $this->input->post('date_requested'),
			'date_payed' => date("Y-m-d"),
			'payed_by' => $name,
		);
		$this->db->insert('payment_transaction', $data);

		$data1 = array(
			'is_no' => $this->input->post('is_no'),
			'crf_no' => $this->input->post('crf_no'),
			'type' => 'Full Payment',
			'pay_to' => $this->input->post('pay_to'),
			'amount' => $amount,
			'remaining_balance' => $remaining_balance,
			'payed_by' => $name,
			'date_created' => $this->input->post('date_requested'),
			'bank' => $this->input->post('bank'),
			'cheque_no' => $this->input->post('cheque_no'),
			'cheque_date' => $this->input->post('cheque_date'),
			'particular' => $this->input->post('particular'),
			'fp_control_no' => $fp_control_no,
			'status' => 'Pending',
		);
		$this->db->insert('check_request_form', $data1);

		$data2 = array(
			'status' => 'Paid',
		);
		$this->db->where('is_no',$id);
		$this->db->where('status','Approved');
		$this->db->update('payment_requests', $data2);
	}
	//==================================================
	//END INSERT,UPDATE
	//==================================================

	//==================================================
	//QUERY
	//==================================================
	// public function get_payment_request_approved() {
	//     $this->db->select('*')
	//              ->from('land_info li')
	//              ->join('owner_info oi', 'li.is_no = oi.is_no', 'left')
	//              ->join('lot_location ll', 'li.is_no = ll.is_no', 'left')
	//              ->join('payment_requests pr', 'li.is_no = pr.is_no', 'left')
	//              ->group_start()
	//                  ->where('li.status', 'Approved')
	//                  ->where('li.tag', 'New')
	//                  ->group_start()
	//                      ->where('pr.status', 'Approved')
	//                      ->or_where('pr.status', 'Paid')
	//                  ->group_end()
	//              ->group_end();

	//     $query = $this->db->get();
	//     return $query->result_array();
	// }

	public function get_payment_request_approved() {
	    $this->db->select('*')
	             ->from('land_info li')
	             ->join('owner_info oi', 'li.is_no = oi.is_no', 'left')
	             ->join('lot_location ll', 'li.is_no = ll.is_no', 'left')
	             ->join('payment_requests pr', 'li.is_no = pr.is_no', 'left')
	             ->join('document_status ds', 'li.is_no = ds.is_no', 'left')
	             ->group_start()
	                 ->where('ds.status', 'Approved')
	                 ->where('li.tag', 'New')
	                 ->group_start()
	                     ->where('pr.status', 'Approved')
	                     ->or_where('pr.status', 'Paid')
	                 ->group_end()
	             ->group_end()
	             ->or_group_start()
	                 ->where('ds.status', 'Approved')
	                 ->where('li.tag', 'New LAPF-ES')
	                 ->group_start()
	                     ->where('pr.status', 'Approved')
	                     ->or_where('pr.status', 'Paid')
	                 ->group_end()
	             ->group_end();

	    $query = $this->db->get();
	    return $query->result_array();
	}


	public function get_payment_request_processing() {
	    $this->db->select('*')
	             ->from('land_info li')
	             ->join('owner_info oi', 'li.is_no = oi.is_no', 'left')
	             ->join('lot_location ll', 'li.is_no = ll.is_no', 'left')
	             ->join('payment_requests pr', 'li.is_no = pr.is_no', 'left')
	             ->join('check_request_form crf', 'li.is_no = crf.is_no', 'left')
	             ->join('document_status ds', 'li.is_no = ds.is_no', 'left')
	             ->group_start()
	                 ->where('ds.status', 'Approved')
	                 ->where('li.tag', 'New')
	                 ->group_start()
	                     ->where('pr.status', 'Paid')
	                 ->group_end()
	             ->group_end();

	    $query = $this->db->get();
	    return $query->result_array();
	}
	public function getpr($id){
		$sql = "SELECT * from payment_requests where  ca_control_no = ? ";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}
	public function getli_byid($id){
		$query = $this->db->get_where('land_info', array('is_no'=> $id));
		return $query->row_array();
	}
	public function getapproved_payment_request($id){
		$sql = "SELECT * from payment_requests where ca_control_no = ? AND  status = 'Approved' ";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}
	public function getapproved_payment_request1($id){
		$sql = "SELECT * from payment_requests where is_no = ? AND  status = 'Approved' ";
		$query = $this->db->query($sql, array($id));
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
	public function getcrf_byid($id){
		$query = $this->db->get_where('check_request_form', array('ca_control_no' => $id)); 
		return $query->row_array();
	}
	public function get_latest_crf_no() {
        $this->db->select('crf_no');
        $this->db->from('check_request_form');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row()->crf_no;
        } else {
            return null; // No record found
        }
    }
	//==================================================
	//END QUERY
	//==================================================

	//==================================================
	//TABPANE NOTIFICATION
	//==================================================
	public function get_payment_requests_approved(){
		$query= $this->db->query("SELECT * from payment_requests where status = 'Approved'");
		return $query->num_rows();    
	}
	public function get_crf_pending(){
		$query= $this->db->query("SELECT * from check_request_form where status = 'Pending'");
		return $query->num_rows();    
	}
	//==================================================
	//END TABPANE NOTIFICATION
	//==================================================
}