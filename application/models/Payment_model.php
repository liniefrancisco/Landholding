<?php
class Payment_model extends CI_Model{
	//==================================================
	//CRUD QUERY
	//==================================================
	public function insert_ca($amount,$ref_no, $name){
		$p 		= $this->input->post('purpose');
		$pp 	= "";
		foreach($p as $cc){
			$pp .= $cc . ", ";
		} 
		$data = array(
			'is_no' 			=>$this->input->post('is_no'),
			'control_no' 		=> $ref_no,
			'type' 				=> 'Cash Advance',
			'amount' 			=> $amount,
			'purpose' 			=> $pp,
			'other_purpose' 	=> $this->input->post('other_purp'),
			'status' 			=> "Pending",
			'prepared_by' 		=> $name,
			'submission_date' 	=> date('Y-m-d'),
		);
		$this->db->insert('payment_requests', $data);
	}
	public function insert_form($fno, $ftype, $uid){
		$data = array(
			'form_no' 	=> $fno,
			'form_type' => $ftype,
			'user_id' 	=> $uid,
		);
		$this->db->insert('forms',$data);
	}
	public function insert_lpf($is_no,$control_no,$amount,$purpose){
		$data = array(
			'is_no' 				=> $is_no,
			'control_no' 			=> $control_no,
			'type' 					=> 'Full Payment',
			'amount' 				=> $amount,
			'purpose_use' 			=> $purpose,
			'lpf_submission_date' 	=> date('Y-m-d'),
			'status' 				=> 'Pending',
			'prepared_by' 			=> $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname'),
			'submission_date' 		=> date('Y-m-d'),
		);
		$this->db->insert('payment_requests',$data);
	}
	public function update_lpf($is_no,$purpose){
		$data= array(
			'purpose_use' 			=> $purpose,
			'lpf_submission_date' 	=> date('Y-m-d'),
		);
		$this->db->where('is_no', $is_no);
		$this->db->where('type','Full Payment');
		$this->db->update('payment_requests', $data);
	}
	public function insert_cop($is_no,$control_no,$amount){
		$data = array(
			'is_no' 					=> $is_no,
			'control_no' 				=> $control_no,
			'type' 						=> 'Full Payment',
			'amount' 					=> $amount,
			'note' 						=> $this->input->post('note'),
			'cop_submission_date' 		=> date('Y-m-d'),
			'status' 					=> 'Pending',
			'prepared_by' 				=> $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname'),
			'submission_date' 			=> date('Y-m-d'),
		);
		$this->db->insert('payment_requests', $data);
	}
	public function update_cop($is_no){
		$data= array(
			'note' 						=> $this->input->post('note'),
			'cop_submission_date' 		=> date('Y-m-d'),
		);
		$this->db->where('is_no', $is_no);
		$this->db->where('type','Full Payment');
		$this->db->update('payment_requests', $data);
	}
	public function insert_nf($is_no,$control_no,$notarial_fee,$amount){
		$data = array(
			'is_no' 				=> $is_no,
			'control_no' 			=> $control_no,
			'type' 					=> 'Full Payment',
			'amount' 				=> $amount,
			'notarial_fee' 			=> $notarial_fee,
			'nf_submission_date' 	=> date('Y-m-d'),
			'status' 				=> 'Pending',
			'prepared_by' 			=> $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname'),
			'submission_date' 		=> date('Y-m-d'),
		);
		$this->db->insert('payment_requests',$data);
	}
	public function update_nf($is_no,$notarial_fee){
		$data = array(
			'notarial_fee' 		=> $notarial_fee,
			'nf_submission_date' => date('Y-m-d'),
		);
		$this->db->where('is_no', $is_no);
		$this->db->where('type','Full Payment');
		$this->db->update('payment_requests', $data);
	}
	public function insert_ac($is_no,$control_no,$commission_fee,$amount){
		$data = array(
			'is_no' 			=> $is_no,
			'control_no' 		=> $control_no,
			'type' 				=> 'Full Payment',
			'amount' 			=> $amount,
			'commission_fee' 	=> $commission_fee,
			'ac_submission_date' => date('Y-m-d'),
			'status' 			=> 'Pending',
			'prepared_by' 		=> $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname'),
			'submission_date' 	=> date('Y-m-d'),
		);
		$this->db->insert('payment_requests',$data);
	}
	public function update_ac($is_no,$commission_fee){
		$data = array(
			'commission_fee' 	=> $commission_fee,
			'ac_submission_date' => date('Y-m-d'),
		);
		$this->db->where('is_no', $is_no);
		$this->db->where('type','Full Payment');
		$this->db->update('payment_requests', $data);
	}
	public function insert_ar($is_no,$control_no,$amount){
		$content = $this->input->post('receipt_file');

		if (!empty($content)) {
			// Construct the path where the file will be saved
			$targetDir = './assets/img/acknowledgement_receipt/' . $is_no . '/';
			if (!file_exists($targetDir)) {
				@mkdir($targetDir, 0777, true);
			}

			// Save the content to the "acknowledgement_receipt.txt" file
			$targetPath = $targetDir . 'acknowledgement_receipt.txt';
			file_put_contents($targetPath, $content);

			// Save just the filename in the database
			$data = array(
				'is_no' 					=> $is_no,
				'control_no' 				=> $control_no,
				'type' 						=> 'Full Payment',
				'amount' 					=> $amount,
				'acknowledgement_receipt' 	=> 'acknowledgement_receipt.txt', // Save the filename only
				'ar_submission_date' 		=> date('Y-m-d'),
				'status' 					=> 'Pending',
				'prepared_by' 				=> $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname'),
				'submission_date' 			=> date('Y-m-d'),
			);
			$this->db->insert('payment_requests', $data);
		}
	} 
	public function update_ar($is_no) {
		$content = $this->input->post('receipt_file');
		
		if (!empty($content)) {
			// Construct the path where the file will be saved
			$targetDir = './assets/img/acknowledgement_receipt/' . $is_no . '/';
			if (!file_exists($targetDir)) {
				@mkdir($targetDir, 0777, true);
			}

			// Save the content to the "acknowledgement_receipt.txt" file
			$targetPath = $targetDir . 'acknowledgement_receipt.txt';
			file_put_contents($targetPath, $content);

			// Update the database record
			$data = array(
				'acknowledgement_receipt' 	=> 'acknowledgement_receipt.txt',
				'ar_submission_date' 		=> date('Y-m-d'),
			);

			$this->db->where('is_no', $is_no);
			$this->db->where('type','Full Payment');
			$this->db->update('payment_requests', $data);
		}
	}
	public function approve_cash_advance($control_no,$name,$action){
	    $data = array(
	      	'status' 		=> $action,
	      	'approval_date' => date("Y-m-d g:i:s"),
	      	'approved_by' 	=> $name,
	    );
	    $this->db->where('control_no', $control_no);
	    $this->db->update('payment_requests', $data);
  	}
  	public function disapprove_cash_advance($control_no,$name,$action,$reason){
	    $data = array(
	      	'status' 				=> $action,
	      	'reason_disapproved' 	=> $reason,
	      	'disapproval_date' 		=> date("Y-m-d g:i:s"),
	      	'disapproved_by' 		=> $name
	    );
	    $this->db->where('control_no',$control_no);
	    $this->db->update('payment_requests', $data);
	}
  	public function notify_user($form_type,$control_no,$action,$recipient){
	    $data = array(
	      	'form_type' 	=> $form_type,
	      	'reference_id' 	=> $control_no,
	      	'action' 		=> $action,
	      	'recipient'	 	=> $recipient,
	      	'status' 		=> "unread",
	      	'date' 			=> date('Y-m-d g:i:s'),
	    );
	    $this->db->insert('notification', $data);
  	}
  	public function insert_crf($id, $is_no, $amount, $rbal, $tprice, $name, $type){
		$query 	= $this->db->get_where('payment_transaction', array('is_no' => $is_no));
		$count 	= $query->num_rows(); // Counting the results from the query

		if($count === 0){
			$remaining_balance = $tprice - $amount;
		}else{
			$remaining_balance = $rbal - $amount;
		}

		$data = array(
			'pr_id' 			=> $id,
			'crf_no' 			=> $this->input->post('crf_no'),
			'is_no' 			=> $this->input->post('is_no'),
			'type' 				=> $type,
			'pay_to' 			=> $this->input->post('pay_to'),
			'amount'			=> $amount,
			'bank' 				=> $this->input->post('bank'),
			'cheque_no' 		=> $this->input->post('cheque_no'),
			'cheque_date' 		=> $this->input->post('cheque_date'),
			'prepared_by' 		=> $name,
			'submission_date' 	=> date("Y-m-d"),
		);
		$this->db->insert('check_request_form', $data);

		$data1 = array(
			'pr_id' 			=> $id,
			'is_no' 			=> $this->input->post('is_no'),
			'type' 				=> $type,
			'amount' 			=> $amount,
			'remaining_balance' => $remaining_balance,
			'transaction_date' 	=> date("Y-m-d g:i:s"),
		);
		$this->db->insert('payment_transaction', $data1);

		$data2 = array(
			'status' 			=> 'Paid',
			'date_payed' 		=> date("Y-m-d g:i:s"),
			'payed_by' 			=> $name,
		);
		$this->db->where('is_no',$is_no);
		$this->db->where('id',$id);
		$this->db->where('status','Approved');
		$this->db->update('payment_requests', $data2);
	}
	//==================================================
	//QUERY
	//==================================================
	public function getpt_byid_result($id){
		$sql 	= "SELECT * from payment_transaction where is_no = ? ORDER BY transaction_date ASC ";
		$query 	= $this->db->query($sql, array($id));
		return $query->result_array();
	}
	public function getLatestRemainingBalance($id){
		$sql 	= "SELECT remaining_balance,amount FROM payment_transaction WHERE is_no = ? ORDER BY transaction_date DESC LIMIT 1";
		$query 	= $this->db->query($sql, array($id));
		return $query->row_array();
	}
	public function getpaid_ca($id){
		$query 	= $this->db->get_where('payment_transaction', array('is_no'=> $id));
		$ca 	= 0;
		foreach ($query->result_array() as $caa){
			$ca = $ca + $caa['amount'];
		}
		return $ca;
	}
	public function getpr_byid_result($id){
		$sql	= "SELECT * from payment_requests where is_no = ?";
		$query 	= $this->db->query($sql, array($id));
		return $query->result_array();
	}
	public function getpr_byid_byca_result($id){
		$sql	= "SELECT * from payment_requests where is_no = ? and type = 'Cash Advance'";
		$query 	= $this->db->query($sql, array($id));
		return $query->result_array();
	}
	public function getpr_byid_byfp_row($id){
		$sql	= "SELECT * from payment_requests where is_no = ? and type = 'Full Payment'";
		$query 	= $this->db->query($sql, array($id));
		return $query->row_array();
	}
	public function getpr_byid_byfp_result($id){
		$sql	= "SELECT * from payment_requests where is_no = ? and type = 'Full Payment'";
		$query 	= $this->db->query($sql, array($id));
		return $query->result_array();
	}
	public function getpt_info($id){
		$sql 	= "SELECT * FROM payment_transaction WHERE is_no = ? ORDER BY transaction_date DESC LIMIT 1";
		$query 	= $this->db->query($sql, array($id));
		return $query->row_array();
	}
	public function check_acknowledgement_receipt($is_no) {
    	$this->db->where('is_no', $is_no);
	    $this->db->where('type', 'Full Payment');
	    $query 	= $this->db->get('payment_requests');
	    $row 	= $query->row_array();
	    
	    if ($row) {
	        return $row['acknowledgement_receipt'];
	    } else {
	        return null; // Or you can return an empty string
	    }
	}
	public function getpr_bycntrl($control_no){
	    $query = $this->db->get_where('payment_requests', array('control_no' => $control_no)); 
	    return $query->row_array();
  	}
  	public function getpr_reason(){
	    $this->db->select('pr.*');
	    $this->db->from('payment_requests pr');
	    $this->db->where('pr.status', 'Disapproved');
	    $query 	= $this->db->get();
    	$result = $query->result_array();
    	return $result;
	}
	public function getpt_TotalPaidAmount($is_no) {
	    $this->db->select('SUM(amount) as total_paid');
	    $this->db->from('payment_transaction'); // Make sure 'payments' is the correct table name
	    $this->db->where('is_no', $is_no);
	    $query = $this->db->get();
	    
	    if ($query->num_rows() > 0) {
	        return $query->row()->total_paid ?? 0;
	    }
	    return 0;
	}










	// public function getrcp_byid($id){
 //  		$sql 	= "SELECT * from request_check_payment where  is_no = ? ";
 //  		$query 	= $this->db->query($sql, array($id));
 //  		return $query->row_array();		
	// }
	public function getca_id() {
		$query = $this->db->query("SELECT * FROM payment_requests WHERE type = 'Cash Advance' ORDER BY id DESC LIMIT 1;");
		return $query->row_array();
	}
	public function getfp_id() {
		$query = $this->db->query("SELECT * FROM payment_requests WHERE type = 'Full Payment' ORDER BY id DESC LIMIT 1;");
		return $query->row_array();
	}
	public function check_pr_status($id){
		$sql	= "SELECT * from payment_requests where is_no = ? and type = 'Cash Advance'";
		$query 	= $this->db->query($sql, array($id));
		return $query->result_array();
	}
	public function get_acknowledgement_receipt_content($is_no) {
	    $targetPath = './assets/img/acknowledgement_receipt/' . $is_no . '/acknowledgement_receipt.txt';
	    
	    if (file_exists($targetPath)) {
	        return file_get_contents($targetPath);
	    } else {
	        return ''; // Return empty string if file does not exist
	    }
	}
	
	
	public function getpr_checkfp($is_no){
		$this->db->where('is_no', $is_no);
		$this->db->where('type', 'Full Payment');
		$query = $this->db->get('payment_requests');
		return $query->row_array();
	}
	public function countPaymentTransactions($id){
		$sql 	= "SELECT * FROM payment_transaction WHERE is_no = ? ";
		$query 	= $this->db->query($sql, array($id));
		return $query->num_rows();
	}
	
	public function getfp_byid($id){
		$query = $this->db->select('*')
						  ->from('payment_requests')
						  ->where('is_no', $id)
						  ->where('type','Full Payment')
						  ->get();
		return $query->row_array();
	}
	public function getpr_ReasonDisapproved() {
	    $this->db->select('payment_requests.*, land_info.*'); // Select columns from both tables
	    $this->db->from('payment_requests');
	    $this->db->join('land_info', 'payment_requests.is_no = land_info.is_no'); // Join condition

	    $this->db->group_start();
	    	$this->db->where('payment_requests.status', 'Disapproved'); // Add table name prefix to avoid ambiguity
		    $this->db->group_start();
			    $this->db->where('payment_requests.type', 'Cash Advance'); // Add table name prefix to avoid ambiguity
			    $this->db->or_where('payment_requests.type', 'Full Payment');
		    $this->db->group_end();
	    $this->db->group_end();

	    // $this->db->or_group_start();
	    // $this->db->where('land_info.status', 'Disapproved');
	    // $this->db->where('payment_requests.type', 'Collateral');
	    // $this->db->group_end();

	    $query = $this->db->get();
	    return $query->result_array();
	}
	
  	public function getpr_approved($id){
		$sql = "SELECT * from payment_requests where control_no = ? AND  status = 'Approved' ";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}
  	public function getform_byid($id){
	    $query = $this->db->get_where('forms', array('form_no'=> $id));
	    return $query->row_array();
  	}
  	public function getpr_approved1() {
	    $this->db->select('li.*, oi.*, ll.*, pr.*, ds.*, crf.*,
	    					pr.is_no AS pr_is_no,
	    					pr.amount AS pr_amount,
	    					pr.type AS pr_type'
						)
	             ->from('land_info li')
	             ->join('owner_info oi', 'li.is_no = oi.is_no', 'left')
	             ->join('lot_location ll', 'li.is_no = ll.is_no', 'left')
	             ->join('document_status ds', 'li.is_no = ds.is_no', 'left')
	             ->join('payment_requests pr', 'li.is_no = pr.is_no', 'left')
	             ->join('check_request_form crf', 'pr.id = crf.pr_id', 'left')
	             ->group_start()
	                 ->where('ds.status', 'Approved')
	                 ->where('li.tag', 'New')
	                 ->group_start()
	                     ->where('pr.status', 'Approved')
	                     ->or_where('pr.status', 'Paid')
	                 ->group_end()
	             ->group_end();
	             // ->or_group_start()
	             //     ->where('ds.status', 'Approved')
	             //     ->where('li.tag', 'New LAPF-ES')
	             //     ->where('pr.status', 'Approved')
	             // ->group_end();

	    $query = $this->db->get();
	    return $query->result_array();
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
	//END
	//==================================================
}