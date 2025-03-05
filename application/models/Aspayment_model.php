<?php
class Aspayment_model extends CI_Model{
	//==================================================
	#CRUD QUERY
	//==================================================
	public function add_customer_bal(){
        $data = array(
        	'reference_id' 	=> $this->input->post('js_no'),
            'balance_type' 	=> '',
            'case_type' 	=> $this->input->post('case_type'),
            'business_unit' => ucwords($this->input->post('business_unit')), 
        );
        $this->db->insert('customer_bal_info', $data);
    }
    public function add_customer_info(){
        $data = array(
        	'reference_id' 	=> $this->input->post('js_no'),
            'firstname' 	=> ucwords($this->input->post('customer_fname')),
            'middlename' 	=> ucwords($this->input->post('customer_mname')),
            'lastname' 		=> ucwords($this->input->post('customer_lname')),
        );
        $this->db->insert('customer_info', $data);
    }
    public function add_customer_add(){
        $data = array(
        	'customer_id' 	=> $this->input->post('js_no'),
        	'region' 		=> ucwords($this->input->post('customer_region')),
            'street' 		=> ucwords($this->input->post('customer_street')),
            'barangay' 		=> ucwords($this->input->post('selected_customer_barangay')),
            'municipality' 	=> ucwords($this->input->post('selected_customer_town')),
            'province' 		=> ucwords($this->input->post('selected_customer_province')),
            'zip_code' 		=> $this->input->post('customer_zip_code'),
            'country' 		=> 'Philippines',
        );
        $this->db->insert('customer_address', $data);
    }
    public function add_land_info($lot_area,){
        $data = array(
            'is_no' 			=> $this->input->post('js_no'),
            'date_acquired' 	=> date('Y-m-d'),
            'lot' 				=> $this->input->post('lot'),
            'cad' 				=> $this->input->post('cad'),
            'lot_type' 			=> $this->input->post('lot_type'),
            'lot_sold' 			=> $this->input->post('lot_s'),
            'lot_size' 			=> $lot_area,
            'tag' 				=>'New LAPF-JS',    
        );
        $this->db->insert('land_info', $data);
    }
    public function add_owner_info(){
        $data = array(
        	'is_no' 		=> $this->input->post('js_no'),
            'firstname' 	=> ucwords($this->input->post('lot_fname')),
            'middlename' 	=> ucwords($this->input->post('lot_mname')),
            'lastname' 		=> ucwords($this->input->post('lot_lname')),
            'gender' 		=> $this->input->post('gender'),
            'vital_status' 	=> $this->input->post('vital_status'),
        );
        $this->db->insert('owner_info', $data);
    }
    public function add_lot_location(){
        $data = array(
        	'is_no' 		=> $this->input->post('js_no'),
            'street' 		=> ucwords($this->input->post('lot_street')),
            'baranggay' 	=> ucwords($this->input->post('selected_lot_barangay')),
            'municipality' 	=> ucwords($this->input->post('selected_lot_town')),
            'zip_code' 		=> $this->input->post('lot_zip_code'),
            'province' 		=> ucwords($this->input->post('selected_lot_province')),
            'region' 		=> ucwords($this->input->post('selected_lot_region')),
            'country' 		=> 'Philippines',
        );
        $this->db->insert('lot_location', $data);
    }
    public function add_tct(){
        $tct_file = $this->input->post('tct');
        $tct_folder = "TCT";
        $js_no = $this->input->post('js_no') . $this->input->post('es_no');
        $firstname = $this->session->userdata('firstname');
        $lastname = $this->session->userdata('lastname');
        // UPDATING BARANGGAY RESOLUTION
        if ($_FILES and $_FILES["tct"]['name']):

            if (!file_exists('./assets/img/uploaded_documents/' . $js_no)):
                @mkdir('./assets/img/uploaded_documents/' . $js_no);
            endif;

            if (!file_exists('./assets/img/uploaded_documents/' . $js_no . '/' . $tct_folder)):
                @mkdir('./assets/img/uploaded_documents/' . $js_no . '/' . $tct_folder);
            endif;

            if (!file_exists('./assets/img/uploaded_documents/' . $js_no . '/' . $tct_folder . '/' . $tct_file)):
                @mkdir('./assets/img/uploaded_documents/' . $js_no . '/' . $tct_folder . '/' . $tct_file);
            endif;

            $targetPaths = getcwd() . '/assets/img/uploaded_documents/' . $js_no . '/' . $tct_folder . '/' . $tct_file;
            $img = $this->upload_images($targetPaths, "tct");

            // Save
            $data = array(
                'is_no' => $js_no,
                'tct' => $img,
                'prepared_by'=> ucfirst($firstname)." ".ucfirst($lastname),
                'date_sent' => date('Y-m-d'), 
                'status' => 'Pending Documents'
            );
            $this->db->insert('uploaded_documents', $data);
            // Close
        endif;
    }
    public function add_oct(){
        $oct_file = $this->input->post('oct');
        $oct_folder = "OCT";
        $js_no = $this->input->post('js_no') . $this->input->post('es_no');
        $firstname = $this->session->userdata('firstname');
        $lastname = $this->session->userdata('lastname');
        // UPDATING BARANGGAY RESOLUTION
        if ($_FILES and $_FILES["oct"]['name']):

            if (!file_exists('./assets/img/uploaded_documents/' . $js_no)):
                @mkdir('./assets/img/uploaded_documents/' . $js_no);
            endif;

            if (!file_exists('./assets/img/uploaded_documents/' . $js_no . '/' . $oct_folder)):
                @mkdir('./assets/img/uploaded_documents/' . $js_no . '/' . $oct_folder);
            endif;

            if (!file_exists('./assets/img/uploaded_documents/' . $js_no . '/' . $oct_folder . '/' . $oct_file)):
                @mkdir('./assets/img/uploaded_documents/' . $js_no . '/' . $oct_folder . '/' . $oct_file);
            endif;

            $targetPaths = getcwd() . '/assets/img/uploaded_documents/' . $js_no . '/' . $oct_folder . '/' . $oct_file;
            $img = $this->upload_images($targetPaths, "oct");

            // Save
            $data = array(
                'is_no' => $js_no,
                'oct' => $img,
                'prepared_by'=> ucfirst($firstname)." ".ucfirst($lastname),
                'date_sent' => date('Y-m-d'), 
                'status' => 'Pending Documents' 
            );
            $this->db->insert('uploaded_documents', $data);
            // Close

        endif;
    }
    public function add_bidding_details($bid_price){
        $data = array(
        	'reference_id' 		=> $this->input->post('js_no'),
            'bid_price' 		=> $bid_price,
            'highest_bidder' 	=> ucwords($this->input->post('status')),            
        );
        $this->db->insert('bidding_details', $data);
    }
    public function add_forms($fno, $ftype, $uid){
        $data = array(
            'form_no' 	=> $fno,
            'form_type' => $ftype,
            'user_id' 	=> $uid,
        );
        $this->db->insert('forms', $data);
    }
	//==================================================
	#QUERY
	//==================================================
	public function getforms_byid($id){
        $query = $this->db->get_where('forms', array('form_no' => $id));
        return $query->row_array();
    }
	public function get_js_new(){
        $query = $this->db->query("SELECT * FROM land_info WHERE tag='New LAPF-JS' ");
        return $query->result_array();
    }
    public function get_es_new(){
        $query = $this->db->query("SELECT * FROM land_info WHERE tag='New LAPF-ES' ");
        return $query->result_array();
    }
	public function get_js_old(){
        $query = $this->db->query("SELECT * FROM land_info WHERE tag='Old LAPF-JS' ");
        return $query->result_array();
    }
    public function get_es_old(){
        $query = $this->db->query("SELECT * FROM land_info WHERE tag='Old LAPF-ES' ");
        return $query->result_array();
    }
}