<?php
class Datatable_model extends CI_Model{
	function __construct() {
		// Set table name
		$this->table = "land_info";
		// Set orderable column fields
		if($this->uri->segment(2) == 'pending_new_acquisition_datatable'){
			$this->column_order = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'submission_date');
		}else if($this->uri->segment(2) == 'reviewed_new_acquisition_datatable'){
			$this->column_order = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'submission_date', 'reviewed_date', 'reviewed_by');
		}else if($this->uri->segment(2) == 'approved_new_acquisition_datatable'){
			$this->column_order = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'submission_date', 'approval_date', 'approved_by');
		}else if($this->uri->segment(2) == 'returned_new_acquisition_datatable'){
			$this->column_order = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'submission_date', 'returned_date', 'returned_by');
		}else if($this->uri->segment(2) == 'disapproved_new_acquisition_datatable'){
			$this->column_order = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'submission_date', 'disapproval_date', 'disapproved_by');
		}else if($this->uri->segment(2) == 'payment_datatable'){
			$this->column_order = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'approval_date');
		}else if($this->uri->segment(2) == 'pending_payment_datatable'){
			$this->column_order = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'date_requested');	
		}else if($this->uri->segment(2) == 'approved_payment_datatable'){
			$this->column_order = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'date_requested', 'date_approved');
		}else if($this->uri->segment(2) == 'pending_crf_datatable'){
			$this->column_order = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'date_requested', 'date_approved');
		}else if($this->uri->segment(2) == 'history_crf_datatable'){
			$this->column_order = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'date_requested', 'date_approved');
		}else if($this->uri->segment(2) == 'disapproved_payment_datatable'){
			$this->column_order = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'date_requested', 'date_disapproved');	
		}else if($this->uri->segment(2) == 'paid_payment_datatable'){
			$this->column_order = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'date_requested', 'date_approved', 'date_payed');
		}else if($this->uri->segment(2) == 'inprogress1_datatable'){
			$this->column_order = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'date_requested', 'date_approved', 'date_payed');
		}else if($this->uri->segment(2) == 'owned_land'){
			$this->column_order = array('land_info.is_no','street', 'baranggay', 'municipality', 'province',"concat(street,', ',baranggay,', ',municipality,', ',province)", 'lot_type', 'lot_size', 'date_acquired', 'tag');
		}

		// Set searchable column fields
		if($this->uri->segment(2) == 'pending_new_acquisition_datatable'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'submission_date');
		}else if($this->uri->segment(2) == 'reviewed_new_acquisition_datatable'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'submission_date', 'reviewed_date', 'reviewed_by');
		}else if($this->uri->segment(2) == 'approved_new_acquisition_datatable'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'submission_date', 'approval_date', 'approved_by');
		}else if($this->uri->segment(2) == 'returned_new_acquisition_datatable'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'submission_date', 'returned_date', 'returned_by');
		}else if($this->uri->segment(2) == 'disapproved_new_acquisition_datatable'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'submission_date', 'disapproval_date', 'disapproved_by');
		}else if($this->uri->segment(2) == 'payment_datatable'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'approval_date');
		}else if($this->uri->segment(2) == 'pending_payment_datatable'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'approval_date');
		}else if($this->uri->segment(2) == 'approved_payment_datatable'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'date_requested', 'date_approved');
		}else if($this->uri->segment(2) == 'pending_crf_datatable'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'date_requested', 'date_approved');
		}else if($this->uri->segment(2) == 'history_crf_datatable'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'date_requested', 'date_approved');
		}else if($this->uri->segment(2) == 'disapproved_payment_datatable'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'date_requested', 'date_disapproved');
		}else if($this->uri->segment(2) == 'paid_payment_datatable'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'date_requested', 'date_approved', 'date_payed');
		}else if($this->uri->segment(2) == 'inprogress1_datatable'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'date_requested', 'date_approved', 'date_payed');
		}else if($this->uri->segment(2) == 'owned_land'){
			$this->column_search = array('land_info.is_no', 'street', 'baranggay', 'municipality', 'province', "concat(street,', ',baranggay,', ',municipality,', ',province)", 'lot_type', 'lot_size', 'date_acquired', 'tag');
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
		if($this->uri->segment(2) == 'pending_new_acquisition_datatable'){
			$this->db
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->join('document_status','document_status.is_no = land_info.is_no', 'left')
				->where('document_status.status', 'Pending')
				->where('land_info.tag', 'New'); 
		}else if($this->uri->segment(2) == 'reviewed_new_acquisition_datatable'){
			$this->db
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->join('document_status','document_status.is_no = land_info.is_no', 'left')
				->where('document_status.status', 'Reviewed')
				->where('land_info.tag', 'New'); 
		}else if($this->uri->segment(2) == 'approved_new_acquisition_datatable'){
			$this->db
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->join('document_status','document_status.is_no = land_info.is_no', 'left')
				->where('document_status.status', 'Approved')
				->where('land_info.tag', 'New');
		}else if($this->uri->segment(2) == 'returned_new_acquisition_datatable'){
			$this->db
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->join('document_status','document_status.is_no = land_info.is_no', 'left')
				->where('document_status.status', 'Returned')
				->where('land_info.tag', 'New'); 
		}else if ($this->uri->segment(2) == 'disapproved_new_acquisition_datatable') {
		    $this->db
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->join('document_status','document_status.is_no = land_info.is_no', 'left')
				->where('document_status.status', 'Disapproved')
				->where('land_info.tag', 'New'); 
		}else if ($this->uri->segment(2) == 'payment_datatable') {
		    $this->db
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->join('document_status','document_status.is_no = land_info.is_no', 'left')
				->where('document_status.status', 'Approved')
				->where('land_info.tag', 'New'); 
		}else if ($this->uri->segment(2) == 'pending_payment_datatable') {
		    $this->db
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->join('document_status','document_status.is_no = land_info.is_no', 'left')
				->join('payment_requests','payment_requests.is_no = land_info.is_no', 'left')
				->where('land_info.tag', 'New') 
				->where('document_status.status', 'Approved')
				->where('payment_requests.status', 'Pending');
		}else if ($this->uri->segment(2) == 'approved_payment_datatable') {
		    $this->db
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->join('document_status','document_status.is_no = land_info.is_no', 'left')
				->join('payment_requests','payment_requests.is_no = land_info.is_no', 'left')
				->where('land_info.tag', 'New') 
				->where('document_status.status', 'Approved')
				->where('payment_requests.status', 'Approved');
		}else if ($this->uri->segment(2) == 'pending_crf_datatable') {
		    $this->db
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->join('document_status','document_status.is_no = land_info.is_no', 'left')
				->join('payment_requests','payment_requests.is_no = land_info.is_no', 'left')
				->where('land_info.tag', 'New') 
				->where('document_status.status', 'Approved')
				->where('payment_requests.status', 'Approved');
		}else if ($this->uri->segment(2) == 'history_crf_datatable') {
		    $this->db
        		->select('land_info.*,lot_location.*,uploaded_documents.*,owner_info.*,document_status.*,payment_requests.*,check_request_form.*,
        			payment_requests.submission_date AS pr_submission_date,
        			payment_requests.type AS pr_type,
        			check_request_form.submission_date AS crf_submission_date')
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->join('document_status','document_status.is_no = land_info.is_no', 'left')
				->join('payment_requests','payment_requests.is_no = land_info.is_no', 'left')
				->join('check_request_form','check_request_form.pr_id = payment_requests.id', 'left',)
				->where('land_info.tag', 'New') 
				->where('document_status.status', 'Approved')
				->where('payment_requests.status', 'Paid');
		}else if ($this->uri->segment(2) == 'disapproved_payment_datatable') {
		    $this->db
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->join('document_status','document_status.is_no = land_info.is_no', 'left')
				->join('payment_requests','payment_requests.is_no = land_info.is_no', 'left')
				->where('land_info.tag', 'New') 
				->where('document_status.status', 'Approved')
				->where('payment_requests.status', 'Disapproved');
		}else if ($this->uri->segment(2) == 'paid_payment_datatable') {
		    $this->db
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->join('document_status','document_status.is_no = land_info.is_no', 'left')
				->join('payment_requests','payment_requests.is_no = land_info.is_no', 'left')
				->where('land_info.tag', 'New') 
				->where('document_status.status', 'Approved')
				->where('payment_requests.status', 'Paid');
		}else if ($this->uri->segment(2) == 'inprogress1_datatable') {
		    $this->db
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->join('document_status','document_status.is_no = land_info.is_no', 'left')
				->join('payment_requests','payment_requests.is_no = land_info.is_no', 'left')
				->where('land_info.tag', 'New') 
				->where('document_status.status', 'Approved')
				->where_in('payment_requests.status', ['Approved','Paid'])
				->group_by('payment_requests.is_no');
		}else if ($this->uri->segment(2) == 'owned_land') {
		    $this->db
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->join('document_status','document_status.is_no = land_info.is_no', 'left')
				->where('document_status.status', 'Approved')
				->where('land_info.tag', 'New'); 
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
}