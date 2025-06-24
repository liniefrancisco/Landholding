<?php
class Datatable_model extends CI_Model{

	protected $column_search = ['land_info.is_no', 'owner_info.firstname', 'owner_info.lastname', 'lot_location.municipality'];
    protected $column_order  = ['land_info.is_no', 'owner_info.firstname', 'land_info.lot_type', 'lot_location.municipality', 'land_info.tax_dec_no', 'land_info.lot']; 
    protected $order         = ['land_info.is_no' => 'asc'];

	function __construct() {
		// Set table name
		$this->table = "land_info";
		// Set orderable column fields
		if($this->uri->segment(2) == 'acquisition_datatable' || $this->uri->segment(2) == 'Aspayment_datatable'){
			$this->column_order = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)",'submission_date','approval_date');
		}else if($this->uri->segment(2) == 'inprogress_datatable'){
			$this->column_order = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'approval_date');
		}else if($this->uri->segment(2) == 'payment_datatable'){
			$this->column_order = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'date_requested');	
		}else if($this->uri->segment(2) == 'crf_datatable'){
			$this->column_order = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)");
		}else if($this->uri->segment(2) == 'inprogress1_datatable'){
			$this->column_order = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'date_requested', 'date_approved', 'date_payed');
		}else if($this->uri->segment(2) == 'Rpt_datatable' || $this->uri->segment(2) == 'LandProfile_datatable'){
			$this->column_order = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'tax_dec_no','lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)");
		}else if($this->uri->segment(2) == 'owned_land'){
			$this->column_order = array('land_info.is_no','street', 'baranggay', 'municipality', 'province',"concat(street,', ',baranggay,', ',municipality,', ',province)", 'lot_type', 'lot_size', 'date_acquired', 'tag');
		}elseif ($this->uri->segment(2) == 'get_all_report_Lists' || $this->uri->segment(2) == 'get_all_tct_status') {
	  		$this->column_order = array(null,'lot_type', 'tag', 'tax_dec_no', 'land_title_no','municipality', 'lot_size');
		}

		// Set searchable column fields
		if($this->uri->segment(2) == 'acquisition_datatable' || $this->uri->segment(2) == 'Aspayment_datatable'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)",'submission_date','approval_date');

		}else if($this->uri->segment(2) == 'inprogress_datatable'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'approval_date');

		}else if($this->uri->segment(2) == 'payment_datatable'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'document_status.approval_date');

		}else if($this->uri->segment(2) == 'crf_datatable'){
			$this->column_search = array('crf_no','land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)");

		}else if($this->uri->segment(2) == 'inprogress1_datatable'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)", 'date_requested', 'date_approved', 'date_payed');

		}else if($this->uri->segment(2) == 'Rpt_datatable' || $this->uri->segment(2) == 'LandProfile_datatable'){
			$this->column_search = array('land_info.is_no','firstname','middlename','lastname',"concat(firstname,' ',middlename,' ',lastname)",'tax_dec_no','lot_type','street', 'baranggay', 'municipality', 'province',"concat(street,'-',baranggay,', ',municipality,', ',province)");
			
		}else if($this->uri->segment(2) == 'owned_land'){
			$this->column_search = array('land_info.is_no', 'street', 'baranggay', 'municipality', 'province', "concat(street,', ',baranggay,', ',municipality,', ',province)", 'lot_type', 'lot_size', 'date_acquired', 'tag');
		}else{
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
		//$this->db->from($this->table);
		$this->db->from('land_info');
    	$this->db->join('real_property_tax', 'real_property_tax.is_no = land_info.is_no', 'left');

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
	public function fetchDataByMunicipality($region, $province, $town) {
    	$this->db
        	->select('
            	land_info.is_no,
            	CONCAT(owner_info.firstname, " ", owner_info.middlename, " ", owner_info.lastname) AS lot_owner,
            	land_info.lot_type,
            	CONCAT(lot_location.street, ", ", lot_location.baranggay, ", ", lot_location.municipality) AS lot_location,
            	land_info.tax_dec_no AS tax_declaration_no,
            	land_info.lot AS lot_no
        	')
        	->from('land_info')
        	->join('real_property_tax', 'real_property_tax.is_no = land_info.is_no', 'left')
        	->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
        	->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
			->group_start()
				->where('real_property_tax.status', 'Pending')
        		->or_where('real_property_tax.status IS NULL')
			->group_end();

    	if (!empty($region)) {
        	$this->db->where('lot_location.region', $region);
    	}
    	if (!empty($province)) {
        	$this->db->where('lot_location.province', $province);
    	}
    	if (!empty($town)) {
    		// Strip ZIP code from town value, e.g. "Alicia (6314)" -> "Alicia"
    		$cleanTown = preg_replace('/\s*\(\d+\)/', '', $town);

    		// Log original and cleaned values for verification
    		log_message('debug', 'Original town: ' . $town);
    		log_message('debug', 'Cleaned town: ' . $cleanTown);

    		$this->db->where('lot_location.municipality', $cleanTown);
		}

			$query = $this->db->get();

			// Log final SQL query
			log_message('debug', 'SQL: ' . $this->db->last_query());

			return $query->result();

	}


	/*
	 * Perform the SQL queries needed for an server-side processing requested
	 * @param $_POST filter data based on the posted parameters
	 */
	private function _get_datatables_query($postData){
		if($this->uri->segment(2) == 'acquisition_datatable'){
			$status = $this->input->post('status');
			$this->db
					 ->from('land_info')
					 ->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
					 ->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
					 ->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
					 ->join('document_status','document_status.is_no = land_info.is_no', 'left')
					 ->where('document_status.status', $status)
					 ->where('land_info.tag', 'New')
					 ->group_by('land_info.is_no'); 
		}else if ($this->uri->segment(2) == 'inprogress_datatable') {
			$this->db
					 ->from('land_info')
					 ->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
					 ->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
					 ->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
					 ->join('document_status','document_status.is_no = land_info.is_no', 'left')
					 ->where('document_status.status', 'Approved')
					 ->where('land_info.tag', 'New')
					 ->group_by('land_info.is_no'); 
		}else if ($this->uri->segment(2) == 'payment_datatable') {
			$status = $this->input->post('status');
			$this->db
					 ->from('land_info')
					 ->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
					 ->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
					 ->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
					 ->join('document_status','document_status.is_no = land_info.is_no', 'left')
					 ->join('payment_requests','payment_requests.is_no = land_info.is_no', 'left')
					 ->where('land_info.tag', 'New') 
					 ->where('document_status.status', 'Approved')
					 ->where('payment_requests.status', $status)
					 ->group_by('land_info.is_no');
		}else if ($this->uri->segment(2) == 'crf_datatable') {
			$status = $this->input->post('status');
			$this->db
					 ->select('land_info.*,lot_location.*,owner_info.*,payment_requests.*,land_info.is_no as isno,check_request_form.crf_no')
					 ->from('land_info')
					 ->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
					 ->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
					 ->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
					 ->join('document_status', 'document_status.is_no = land_info.is_no', 'left')
					 ->join('payment_requests', 'payment_requests.is_no = land_info.is_no', 'left')
					 ->join('check_request_form','check_request_form.pr_id = payment_requests.id', 'left')
					 ->where_in('land_info.tag', ['New', 'New LAPF-ES', 'New LAPF-JS'])
					 ->where('document_status.status', 'Approved')
					 ->where('payment_requests.status', $status)
					 ->group_by('payment_requests.control_no');
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
		}else if ($this->uri->segment(2) == 'Aspayment_datatable') {
			$status = $this->input->post('status');
			$this->db
					 ->from('land_info')
					 ->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
					 ->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
					 ->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
					 ->join('document_status','document_status.is_no = land_info.is_no', 'left')
					 ->join('payment_requests', 'payment_requests.is_no = land_info.is_no', 'left')
					 ->where('document_status.status', $status)
					 ->where('payment_requests.status', $status)
					 ->where_in('land_info.tag', ['New LAPF-JS', 'New LAPF-ES']);
		}else if ($this->uri->segment(2) == 'Rpt_datatable') {
		    $region   = $this->input->post('region');
		    $province = $this->input->post('province');
		    $town     = $this->input->post('town');
		    $year     = (int) $this->input->post('year') ? (int) $this->input->post('year'): date('Y');
		    $tableId  = $this->input->post('tableId');
		    $status   = $this->input->post('status');

		    $this->db
		        ->select('
		            land_info.is_no,
		            land_info.tax_dec_no,
		            land_info.lot,
		            land_info.lot_type,
		            owner_info.firstname,
		            owner_info.middlename,
		            owner_info.lastname,
		            lot_location.*,
		            document_status.status,
		            assessments.Assessment_Level,
		            assessments.Effective_year,
		            real_property_tax.posted_date,
		            real_property_tax.status
		        ')
		        ->from('land_info')
		        ->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
		        ->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
		        ->join('document_status', 'document_status.is_no = land_info.is_no', 'left')
		        ->join('assessments', 'assessments.is_no = land_info.is_no', 'left')
		        ->join('real_property_tax', 'real_property_tax.is_no = land_info.is_no', 'left')
		        ->where('document_status.status', 'Approved')
		        ->where_in('land_info.tag', ['New', 'New LAPF-JS', 'New LAPF-ES'])
		        ->order_by('real_property_tax.posted_date DESC, real_property_tax.is_no DESC');

			    if ($tableId === 'rpt_datatable') {// ✅ Proper exclusion of already posted for selected year
				    $this->db->where("NOT EXISTS (
				        SELECT 1 FROM real_property_tax rpt 
				        WHERE rpt.is_no = land_info.is_no 
					    AND YEAR(rpt.posted_date) = $year
				    )", null, false);
				}

			    if ($tableId !== 'rpt_datatable') {// ✅ For Pending and Paid
			        $this->db->where('real_property_tax.status', $status);
			    }

			    // ✅ Optional filters
			    if (!empty($region))   $this->db->where('lot_location.region', $region);
			    if (!empty($province)) $this->db->where('lot_location.province', $province);
			    if (!empty($town))     $this->db->where('lot_location.municipality', $town);

		}else if ($this->uri->segment(2) == 'LandProfile_datatable') {
			$this->db
					 ->from('land_info')
					 ->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
					 ->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
					 ->join('document_status','document_status.is_no = land_info.is_no', 'left')
					 ->where('document_status.status', 'Approved')
					 ->where_in('land_info.tag', ['New', 'New LAPF-JS', 'New LAPF-ES']);
		}else if ($this->uri->segment(2) == 'owned_land') {
			$this->db
					 ->from('land_info')
					 ->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
					 ->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
					 ->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
					 ->join('document_status','document_status.is_no = land_info.is_no', 'left')
					 ->where('document_status.status', 'Approved')
					 ->where('land_info.tag', 'New')
					 ->group_by('land_info.is_no'); 
		}else{
			$this->db
			   ->from('land_info')
			   ->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
			   ->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
			   ->join('document_status','document_status.is_no = land_info.is_no', 'left')
			   ->where('document_status.status', 'Approved');
		}

		$i = 0;
		// $search_value = $postData['search']['value'] ?? '';
		$search_value = isset($postData['search']['value']) ? $postData['search']['value'] : '';
		foreach ($this->column_search as $item) {
			if ($search_value) {
				if ($i === 0) {
					$this->db->group_start();
				}
				if ($item === 'submission_date' 
					|| $item === 'approval_date') { // Fix condition
					$search_value = str_replace(", ", ",", $search_value); // Normalize input
					$this->db->or_where("DATE_FORMAT($item, '%M %d,%Y') LIKE", "%".$search_value."%");
				} else {
					$this->db->or_like($item, $search_value);
				}
				if (count($this->column_search) - 1 == $i) {
					$this->db->group_end();
				}
				if (!empty($town)) {
					
					$this->db->where('lot_location.municipality', $town);
				}
				
				$this->db->group_by('land_info.is_no');
				

			} else {
				// Default case only if no matching in segment(2)
				log_message('error', 'No matching case for segment(2): ' . $this->uri->segment(2));
				$this->db->from('land_info'); // Safe default
			}
		
		$i = 0;
		// $search_value = $postData['search']['value'] ?? '';
		$search_value = isset($postData['search']['value']) ? $postData['search']['value'] : '';
		foreach ($this->column_search as $item) {
		    if ($search_value) {
		        if ($i === 0) {
		            $this->db->group_start();
		        }
		        if ($item === 'submission_date' 
		        	|| $item === 'approval_date') { // Fix condition
		            $search_value = str_replace(", ", ",", $search_value); // Normalize input
		            $this->db->or_where("DATE_FORMAT($item, '%M %d,%Y') LIKE", "%".$search_value."%");
		        } else {
		            $this->db->or_like($item, $search_value);
		        }
		        if (count($this->column_search) - 1 == $i) {
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