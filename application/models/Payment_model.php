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
		$ar = "Acknowledgement Receipt";

		if (!empty($content)) {
			// Construct the path where the file will be saved
			$targetDir = './assets/img/uploaded_documents/' . $is_no . '/' . $ar . '/';
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
		$ar = "Acknowledgement Receipt";
		
		if (!empty($content)) {
			// Construct the path where the file will be saved
			$targetDir = './assets/img/uploaded_documents/' . $is_no . '/' . $ar . '/';
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
	public function add_CRF($id, $is_no, $amount, $type) {
	    $file 	= $this->input->post('attachments');
	    $crf 	= "CRF";

	    // Detect folder based on is_no prefix
	    $prefix = substr($is_no, 0, 2); // First two letters
	    if ($prefix === "NA") {
	        $baseFolder = './assets/img/uploaded_documents/';
	    } elseif ($prefix === "ES") {
	        $baseFolder = './assets/img/es_uploads/';
	    } elseif ($prefix === "JS") {
	        $baseFolder = './assets/img/js_uploads/';
	    } else {
	        // Fallback folder if needed
	        $baseFolder = './assets/img/other_uploads/';
	    }

	    if ($_FILES and $_FILES["attachments"]['name']):
	        // Create directories if they don't exist
	        if (!file_exists($baseFolder . $is_no)) {
	            @mkdir($baseFolder . $is_no, 0777, true);
	        }
	        if (!file_exists($baseFolder . $is_no . '/' . $crf)) {
	            @mkdir($baseFolder . $is_no . '/' . $crf, 0777, true);
	        }
	        if (!file_exists($baseFolder . $is_no . '/' . $crf . '/' . $file)) {
	            @mkdir($baseFolder . $is_no . '/' . $crf . '/' . $file, 0777, true);
	        }

	        $targetPaths = getcwd() . '/' . $baseFolder . $is_no . '/' . $crf . '/' . $file;
	        $img = $this->upload_images($targetPaths, "attachments");

	        $data = array(	'pr_id' 			=> $id,
							'crf_no' 			=> $this->input->post('crf_no'),
							'is_no' 			=> $is_no,
							'type' 				=> $type,
							'pay_to' 			=> $this->input->post('pay_to'),
							'amount'			=> $amount,
							'bank' 				=> $this->input->post('bank'),
							'cheque_no' 		=> $this->input->post('cheque_no'),
							'cheque_date' 		=> $this->input->post('cheque_date'),
							'filename' 			=> $img,
							'prepared_by' 		=> $this->session->userdata('firstname').' '.$this->session->userdata('lastname'),
							'submission_date' 	=> date("Y-m-d"),
	        			);
			$this->db->insert('check_request_form', $data);
	    endif;
	}
	public function add_payment_transaction($id, $is_no, $amount, $rbal, $type) {
		$data = array(  'pr_id' 			=> $id,
						'is_no' 			=> $is_no,
						'type' 				=> $type,
						'amount' 			=> $amount,
						'remaining_balance' => $rbal,
						'transaction_date' 	=> date("Y-m-d g:i:s"),
					);
		$this->db->insert('payment_transaction', $data);
	}
	public function update_payment_requests($id, $is_no) {
		$data = array(
						'status' 		=> 'Paid',
						'date_payed' 	=> date("Y-m-d g:i:s"),
						'payed_by' 		=> $this->session->userdata('firstname').' '.$this->session->userdata('lastname'),
					);
		$this->db->where('is_no',$is_no);
		$this->db->where('id',$id);
		$this->db->where('status','Approved');
		$this->db->update('payment_requests', $data);
	}
	public function upload_images($targetPaths, $image_name){
		$filename = '';
		$tmpFilePaths = $_FILES[$image_name]['tmp_name'];
		//Make sure we have a filepath
		if ($tmpFilePaths != ""){
			//Setup our new file path
			$filename =  $_FILES[$image_name]['name'];
			$newFilePath = $targetPaths . $filename;
			//Upload the file into the temp dir
			move_uploaded_file($tmpFilePaths, $newFilePath);
		}
		return $filename;
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
	        return isset($query->row()->total_paid) ? $query->row()->total_paid : 0;
	    }
	    return 0;
	}
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
  		$this->db->select('li.*, oi.*, ll.*, ds.*,
  							pr.amount AS pr_amount, 
  							pr.is_no AS pr_is_no,
  							pr.type AS pr_type,
  							pr.control_no,
  							pr.purpose,
  							pr.other_purpose,
  						')
	             ->from('land_info li')
	             ->join('owner_info oi', 'li.is_no = oi.is_no', 'left')
	             ->join('lot_location ll', 'li.is_no = ll.is_no', 'left')
	             ->join('document_status ds', 'li.is_no = ds.is_no', 'left')
	             ->join('payment_requests pr', 'li.is_no = pr.is_no', 'left')
	             ->where('ds.status', 'Approved')
	             ->where('pr.status', 'Approved')
	             ->where_in('li.tag', ['New', 'New LAPF-ES', 'New LAPF-JS']);

	    $query = $this->db->get();
	    return $query->result_array();
	}
	public function getdata_crf() {
  		$this->db->select('li.*, oi.*, ll.*, ds.*, crf.*,
  							pr.amount AS pr_amount, 
  							pr.is_no AS pr_is_no,
  							pr.type AS pr_type,
  							pr.control_no,
  							pr.purpose,
  							pr.other_purpose,
							pr.submission_date AS pr_submission_date,
  						')
	             ->from('land_info li')
	             ->join('owner_info oi', 'li.is_no = oi.is_no', 'left')
	             ->join('lot_location ll', 'li.is_no = ll.is_no', 'left')
	             ->join('document_status ds', 'li.is_no = ds.is_no', 'left')
	             ->join('payment_requests pr', 'li.is_no = pr.is_no', 'left')
	             ->join('check_request_form crf', 'pr.id = crf.pr_id', 'left')
	             ->where('ds.status', 'Approved')
	             ->where('pr.status', 'Approved')
	             ->where_in('li.tag', ['New', 'New LAPF-ES', 'New LAPF-JS']);

	    $query = $this->db->get();
	    return $query->result_array();
	}
	public function getdata_crf1() {
  		$this->db->select('li.*, oi.*, ll.*, ds.*, crf.*,
  							pr.amount AS pr_amount, 
  							pr.is_no AS pr_is_no,
  							pr.type AS pr_type,
  							pr.control_no,
  							pr.purpose,
  							pr.other_purpose,
							pr.submission_date AS pr_submission_date,
  						')
	             ->from('land_info li')
	             ->join('owner_info oi', 'li.is_no = oi.is_no', 'left')
	             ->join('lot_location ll', 'li.is_no = ll.is_no', 'left')
	             ->join('document_status ds', 'li.is_no = ds.is_no', 'left')
	             ->join('payment_requests pr', 'li.is_no = pr.is_no', 'left')
	             ->join('check_request_form crf', 'pr.id = crf.pr_id', 'left')
	             ->where('ds.status', 'Approved')
	             ->where('pr.status', 'Paid')
	             ->where_in('li.tag', ['New', 'New LAPF-ES', 'New LAPF-JS']);

	    $query = $this->db->get();
	    return $query->result_array();
	}
	public function getdata_rca() {
  		$this->db->select('li.*, oi.*, ll.*, ds.*, crf.*,
  							pr.amount AS pr_amount, 
  							pr.is_no AS pr_is_no,
  							pr.type AS pr_type,
  							pr.control_no,
  							pr.purpose,
  							pr.other_purpose,
							pr.submission_date AS pr_submission_date,
  						')
	             ->from('land_info li')
	             ->join('owner_info oi', 'li.is_no = oi.is_no', 'left')
	             ->join('lot_location ll', 'li.is_no = ll.is_no', 'left')
	             ->join('document_status ds', 'li.is_no = ds.is_no', 'left')
	             ->join('payment_requests pr', 'li.is_no = pr.is_no', 'left')
	             ->join('check_request_form crf', 'pr.id = crf.pr_id', 'left')
	             ->where('ds.status', 'Approved')
				 ->where_in('pr.status', ['Approved', 'Paid'])
	             ->where_in('li.tag', ['New']);

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

	// Latest model for CRF
	public function get_all_payment_requests() {
        return $this->db->get('payment_requests')->result_array();
    }
	public function get_payment_request($id) {
        return $this->db->get_where('payment_requests', ['id' => $id])->row_array();
    }
	public function exists($id) {
        return $this->db->where('id', $id)->count_all_results('payment_requests') > 0;
    }


	//==================================================
	//END
	//==================================================
}