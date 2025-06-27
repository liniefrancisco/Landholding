<?php
class Datatable_model extends CI_Model{

	protected $column_order = [];
	protected $column_search = [];
	protected $order = ['land_info.is_no' => 'asc'];

	function __construct() {
		parent::__construct();
		// Set table name
		$this->table = "land_info";
		$seg = $this->uri->segment(2); // shortcut for route segment

		// Set orderable column fields
		if ($seg === 'acquisition_datatable' || $seg === 'Aspayment_datatable') {
			$this->column_order = [
				'land_info.is_no',
				'owner_info.firstname',
				'owner_info.middlename',
				'owner_info.lastname',
				"CONCAT(owner_info.firstname, ' ', owner_info.middlename, ' ', owner_info.lastname)",
				'land_info.lot_type',
				'lot_location.street',
				'lot_location.baranggay',
				'lot_location.municipality',
				'lot_location.province',
				"CONCAT(lot_location.street, '-', lot_location.baranggay, ', ', lot_location.municipality, ', ', lot_location.province)",
				'payment_requests.submission_date',
				'payment_requests.approval_date',
			];

		} else if ($seg === 'inprogress_datatable') {
			$this->column_order = [
				'land_info.is_no',
				'owner_info.firstname',
				'owner_info.middlename',
				'owner_info.lastname',
				"CONCAT(owner_info.firstname, ' ', owner_info.middlename, ' ', owner_info.lastname)",
				'land_info.lot_type',
				'lot_location.street',
				'lot_location.baranggay',
				'lot_location.municipality',
				'lot_location.province',
				"CONCAT(lot_location.street, '-', lot_location.baranggay, ', ', lot_location.municipality, ', ', lot_location.province)",
				'payment_requests.approval_date',
			];

		} else if ($seg === 'payment_datatable') {
			$this->column_order = [
				'land_info.is_no',
				'owner_info.firstname',
				'owner_info.middlename',
				'owner_info.lastname',
				"CONCAT(owner_info.firstname, ' ', owner_info.middlename, ' ', owner_info.lastname)",
				'land_info.lot_type',
				'lot_location.street',
				'lot_location.baranggay',
				'lot_location.municipality',
				'lot_location.province',
				"CONCAT(lot_location.street, '-', lot_location.baranggay, ', ', lot_location.municipality, ', ', lot_location.province)",
				'payment_requests.date_requested',
			];

		} else if ($seg === 'crf_datatable') {
			$this->column_order = [
				'check_request_form.crf_no',
				'land_info.is_no',
				'owner_info.firstname',
				'owner_info.middlename',
				'owner_info.lastname',
				"CONCAT(owner_info.firstname, ' ', owner_info.middlename, ' ', owner_info.lastname)",
				'land_info.lot_type',
				'lot_location.street',
				'lot_location.baranggay',
				'lot_location.municipality',
				'lot_location.province',
				"CONCAT(lot_location.street, '-', lot_location.baranggay, ', ', lot_location.municipality, ', ', lot_location.province)",
			];

		} else if ($seg === 'inprogress1_datatable') {
			$this->column_order = [
				'land_info.is_no',
				'owner_info.firstname',
				'owner_info.middlename',
				'owner_info.lastname',
				"CONCAT(owner_info.firstname, ' ', owner_info.middlename, ' ', owner_info.lastname)",
				'land_info.lot_type',
				'lot_location.street',
				'lot_location.baranggay',
				'lot_location.municipality',
				'lot_location.province',
				"CONCAT(lot_location.street, '-', lot_location.baranggay, ', ', lot_location.municipality, ', ', lot_location.province)",
				'payment_requests.date_requested',
				'payment_requests.date_approved',
				'payment_requests.date_payed',
			];

		} else if ($seg === 'Rpt_datatable') {
			$this->column_order = [
				'land_info.is_no',
				'owner_info.firstname',
				'owner_info.middlename',
				'owner_info.lastname',
				"CONCAT(owner_info.firstname, ' ', owner_info.middlename, ' ', owner_info.lastname)",
				'land_info.tax_dec_no',
				'land_info.lot_type',
				'lot_location.street',
				'lot_location.baranggay',
				'lot_location.municipality',
				'lot_location.province',
				"CONCAT(lot_location.street, '-', lot_location.baranggay, ', ', lot_location.municipality, ', ', lot_location.province)",
			];

		} else if ($seg === 'owned_land') {
			$this->column_order = [
				'land_info.is_no',
				'lot_location.street',
				'lot_location.baranggay',
				'lot_location.municipality',
				'lot_location.province',
				"CONCAT(lot_location.street, ', ', lot_location.baranggay, ', ', lot_location.municipality, ', ', lot_location.province)",
				'land_info.lot_type',
				'land_info.lot_size',
				'land_info.date_acquired',
				'land_info.tag',
			];

		} else if ($seg === 'Rptax_datatable') {
			$this->column_order = [
				'land_info.is_no',
				'owner_info.firstname',
				'owner_info.middlename',
				'owner_info.lastname',
				"CONCAT(owner_info.firstname, ' ', owner_info.middlename, ' ', owner_info.lastname)",
				'land_info.lot_type',
				'lot_location.street',
				'lot_location.baranggay',
				'lot_location.municipality',
				'lot_location.province',
				'land_info.tax_dec_no',
				'land_info.lot',
			];
		}

		// Set searchable column fields
		switch ($seg) {
			case 'acquisition_datatable':
			case 'Aspayment_datatable':
				$this->column_search = [
					'land_info.is_no',
					'owner_info.firstname',
					'owner_info.middlename',
					'owner_info.lastname',
					'land_info.lot_type',
					'lot_location.street',
					'lot_location.baranggay',
					'lot_location.municipality',
					'lot_location.province',
					'payment_requests.submission_date',
					'payment_requests.approval_date',
				];
				break;

			case 'inprogress_datatable':
				$this->column_search = [
					'land_info.is_no',
					'owner_info.firstname',
					'owner_info.middlename',
					'owner_info.lastname',
					'land_info.lot_type',
					'lot_location.street',
					'lot_location.baranggay',
					'lot_location.municipality',
					'lot_location.province',
					'payment_requests.approval_date',
				];
				break;

			case 'payment_datatable':
			case 'inprogress1_datatable':
				$this->column_search = [
					'land_info.is_no',
					'owner_info.firstname',
					'owner_info.middlename',
					'owner_info.lastname',
					'land_info.lot_type',
					'lot_location.street',
					'lot_location.baranggay',
					'lot_location.municipality',
					'lot_location.province',
					'payment_requests.submission_date',
					'payment_requests.approval_date',
				];
				break;

			case 'crf_datatable':
				$this->column_search = [
					'check_request_form.crf_no',
					'land_info.is_no',
					'owner_info.firstname',
					'owner_info.middlename',
					'owner_info.lastname',
					'land_info.lot_type',
					'lot_location.street',
					'lot_location.baranggay',
					'lot_location.municipality',
					'lot_location.province',
				];
				break;

			case 'Rpt_datatable':
				$this->column_search = [
					'land_info.is_no',
					'owner_info.firstname',
					'owner_info.middlename',
					'owner_info.lastname',
					'land_info.tax_dec_no',
					'land_info.lot_type',
					'lot_location.street',
					'lot_location.baranggay',
					'lot_location.municipality',
					'lot_location.province',
				];
				break;

			case 'owned_land':
				$this->column_search = [
					'land_info.is_no',
					'lot_location.street',
					'lot_location.baranggay',
					'lot_location.municipality',
					'lot_location.province',
					'land_info.lot_type',
					'land_info.lot_size',
					'land_info.date_acquired',
					'land_info.tag',
				];
				break;

			case 'Rptax_datatable':
				$this->column_search = [
					'land_info.is_no',
					'owner_info.firstname',
					'owner_info.middlename',
					'owner_info.lastname',
					'land_info.lot_type',
					'lot_location.street',
					'lot_location.baranggay',
					'lot_location.municipality',
					'lot_location.province',
					'land_info.tax_dec_no',
					'land_info.lot',
				];
				break;
		}
		
		$this->order = ['land_info.is_no' => 'asc'];
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
				->where('land_info.tag', 'New'); 
		}else if ($this->uri->segment(2) == 'inprogress_datatable') {
		    $this->db
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->join('document_status','document_status.is_no = land_info.is_no', 'left')
				->where('document_status.status', 'Approved')
				->where('land_info.tag', 'New'); 
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
				->where('payment_requests.status', $status);
		}else if ($this->uri->segment(2) == 'crf_datatable') {
			$status = $this->input->post('status');
			$this->db
				->select('land_info.*,lot_location.*,owner_info.*,payment_requests.*,
							land_info.is_no as isno,check_request_form.crf_no
						')
		        ->from('land_info')
		        ->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
		        ->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
		        ->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
		        ->join('document_status', 'document_status.is_no = land_info.is_no', 'left')
		        ->join('payment_requests', 'payment_requests.is_no = land_info.is_no', 'left')
		        ->join('check_request_form','check_request_form.pr_id = payment_requests.id', 'left')
		        ->where_in('land_info.tag', ['New', 'New LAPF-ES', 'New LAPF-JS'])
		        ->where('document_status.status', 'Approved')
		        ->where('payment_requests.status', $status);
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
			$region 	= $this->input->post('region');
			$province 	= $this->input->post('province');
			$town 		= $this->input->post('town');
		    $this->db
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->join('document_status','document_status.is_no = land_info.is_no', 'left')
				->join('payment_requests', 'payment_requests.is_no = land_info.is_no', 'left')
				->where('document_status.status', 'Approved')
				->where('payment_requests.status', 'Paid')
				->where_in('land_info.tag', ['New', 'New LAPF-JS', 'New LAPF-ES'])
				->group_by('payment_requests.is_no');;

				!empty($region) ? $this->db->where('lot_location.region', $region) : null;
				!empty($province) ? $this->db->where('lot_location.province', $province) : null;
				!empty($town) ? $this->db->where('lot_location.municipality', $town) : null;
		}else if ($this->uri->segment(2) == 'owned_land') {
		    $this->db
				->from('land_info')
				->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left')
				->join('uploaded_documents', 'uploaded_documents.is_no = land_info.is_no', 'left')
				->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left')
				->join('document_status','document_status.is_no = land_info.is_no', 'left')
				->where('document_status.status', 'Approved')
				->where('land_info.tag', 'New'); 
		}else if ($this->uri->segment(2) == 'Rptax_datatable') {
    			$region  = $this->input->post('region');
    			$province = $this->input->post('province');
    			$town    = $this->input->post('town');

				if (!empty($town)) {
					$townParts = explode('|', $town);
					if (count($townParts) > 1) {
						$town = $townParts[1];
					}					
					$town = preg_replace('/\s*\(\d+\)/', '', $town);
				}

				$this->db->select('
					land_info.*,
					lot_location.*,
					owner_info.*,
					real_property_tax.*,
					payment_requests.id AS pr_id,
					payment_requests.is_no AS payment_is_no,
					payment_requests.type AS pr_type,
					payment_requests.submission_date,
					payment_requests.approval_date
				');

				$this->db->from('land_info');
				$this->db->join('real_property_tax', 'real_property_tax.is_no = land_info.is_no', 'left');
				$this->db->join('owner_info', 'owner_info.is_no = land_info.is_no', 'left');
				$this->db->join('lot_location', 'lot_location.is_no = land_info.is_no', 'left');
				$this->db->join('document_status', 'document_status.is_no = land_info.is_no', 'left');
				$this->db->join('payment_requests', 'payment_requests.is_no = land_info.is_no', 'left');
				$this->db->join('check_request_form', 'check_request_form.pr_id = payment_requests.id', 'left');
				//$this->db->where('real_property_tax.status', 'Pending');

				if (!empty($region)) {
					$this->db->where('lot_location.region', $region);
				}
				if (!empty($province)) {
					$this->db->where('lot_location.province', $province);
				}
				if (!empty($town)) {
					$this->db->where('lot_location.municipality', $town);
				}
				
				$this->db->group_by('land_info.is_no');
			}


			// $search_value = $postData['search']['value'] ?? '';
			$search_value = isset($postData['search']['value']) ? $postData['search']['value'] : '';
			$i = 0;
			foreach ($this->column_search as $item) {
				if ($search_value) {
					if ($i === 0) {
						$this->db->group_start(); // Mo-open ug group kung first item
					}
					if ($item === 'payment_requests.submission_date' || $item === 'payment_requests.approval_date') { // Fix condition
						$search_value = str_replace(", ", ",", $search_value); // Normalize input
						$this->db->or_where("DATE_FORMAT($item, '%M %d,%Y') LIKE", "%".$search_value."%");
					} else {
						$this->db->or_like($item, $search_value);
					}
					if (count($this->column_search) - 1 == $i) {
						$this->db->group_end(); // Mo-close group kung last item
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