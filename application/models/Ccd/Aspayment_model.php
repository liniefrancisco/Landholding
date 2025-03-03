<?php
Class Aspayment_model extends CI_model{
	//==================================================
	//INSERT, UPDATE, DELETE
	//==================================================
	public function insert_form_request($fno, $ftype, $uid){
        $data = array(
            'form_no' => $fno,
            'form_type' => $ftype,
            'user_id' => $uid,
        );
        $this->db->insert('forms', $data);
    }

	public function insert_judicial_land_info($lot_area,){
        $data = array(
            'is_no' => $this->input->post('js_no'),
            'date_acquired' => date('Y-m-d'),
            'lot' => $this->input->post('lot'),
            'cad' => $this->input->post('cad'),
            'lot_type' => $this->input->post('lot_type'),
            'lot_sold' => $this->input->post('lot_s'),
            'lot_size' => $lot_area,
            'tag' =>'New LAPF-JS',
            'prepared_by' => $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname'),
            'status' => 'Pending',
            'submission_date' => date('Y-m-d'),      
        );
        $this->db->insert('land_info', $data);
    }

    public function insert_judicial_customer_balance(){
        $data = array(
        	'reference_id' => $this->input->post('js_no'),
            'balance_type' => '',
            'case_type' => $this->input->post('case_type'),
            'business_unit' => ucwords($this->input->post('business_unit')), 
        );
        $this->db->insert('customer_bal_info', $data);
    }

    public function insert_judicial_customer_info(){
        $data = array(
        	'reference_id' => $this->input->post('js_no'),
            'firstname' => ucwords($this->input->post('customer_fname')),
            'middlename' => ucwords($this->input->post('customer_mname')),
            'lastname' => ucwords($this->input->post('customer_lname')),
        );
        $this->db->insert('customer_info', $data);
    }

    public function insert_judicial_customer_address(){
        $data = array(
        	'customer_id' => $this->input->post('js_no'),
            'street' => ucwords($this->input->post('customer_street')),
            'barangay' => ucwords($this->input->post('selected_customer_barangay')),
            'town' => ucwords($this->input->post('selected_customer_town')),
            'province' => ucwords($this->input->post('selected_customer_province')),
            'zip_code' => $this->input->post('customer_zip_code'),
            'country' => 'Philippines',
        );
        $this->db->insert('customer_address', $data);
    }

    public function insert_judicial_owner_info(){
        $data = array(
        	'is_no' => $this->input->post('js_no'),
            'firstname' => ucwords($this->input->post('lot_fname')),
            'middlename' => ucwords($this->input->post('lot_mname')),
            'lastname' => ucwords($this->input->post('lot_lname')),
            'gender' => $this->input->post('gender'),
            'vital_status' => $this->input->post('vital_status'),
        );
        $this->db->insert('owner_info', $data);
    }

    public function insert_judicial_lot_location(){
        $data = array(
        	'is_no' => $this->input->post('js_no'),
            'street' => ucwords($this->input->post('lot_street')),
            'baranggay' => ucwords($this->input->post('selected_lot_barangay')),
            'municipality' => ucwords($this->input->post('selected_lot_town')),
            'zip_code' => $this->input->post('lot_zip_code'),
            'province' => ucwords($this->input->post('selected_lot_province')),
            'region' => ucwords($this->input->post('selected_lot_region')),
            'country' => 'Philippines',
        );
        $this->db->insert('lot_location', $data);
    }

    public function insert_tct(){
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

    public function insert_oct(){
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

    public function insert_judicial_bidding_details($bid_price){
        $data = array(
        	'reference_id' => $this->input->post('js_no'),
            'bid_price' => $bid_price,
            'highest_bidder' => ucwords($this->input->post('status')),            
        );
        $this->db->insert('bidding_details', $data);
    }

    public function upload_images($targetPaths, $image_name){
        $filename = '';
        $tmpFilePaths = $_FILES[$image_name]['tmp_name'];
        //Make sure we have a filepath
        if ($tmpFilePaths != "") {
            //Setup our new file path
            $filename = $_FILES[$image_name]['name'];
            $newFilePath = $targetPaths . $filename;
            //Upload the file into the temp dir
            move_uploaded_file($tmpFilePaths, $newFilePath);
        }
        return $filename;
    }

    public function insert_es_land_info($lot_area){
        $data = array(
            'is_no' => $this->input->post('es_no'),
            'date_acquired' => date('Y-m-d'),
            'lot' => $this->input->post('lot'),
            'cad' => $this->input->post('cad'),
            'lot_type' => $this->input->post('lot_type'),
            'lot_sold' => $this->input->post('lot_s'),
            'lot_size' => $lot_area,
            'tag' => 'New LAPF-ES',
            'prepared_by' => $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname'),
            'status' => 'Pending',
            'submission_date' => date('Y-m-d'), 
        );
        $this->db->insert('land_info', $data);
    }

    public function insert_es_owner_info(){
        $data = array(
            'is_no' => $this->input->post('es_no'),
            'firstname' => ucwords($this->input->post('lot_fname')),
            'middlename' => ucwords($this->input->post('lot_mname')),
            'lastname' => ucwords($this->input->post('lot_lname')),
            'gender' => $this->input->post('gender'),
            'vital_status' => $this->input->post('vital_status'),
        );
        $this->db->insert('owner_info', $data);
    }

    public function insert_es_lot_location(){
        $data = array(
            'is_no' => $this->input->post('es_no'),
            'street' => ucwords($this->input->post('lot_street')),
            'baranggay' => ucwords($this->input->post('selected_lot_barangay')),
            'municipality' => ucwords($this->input->post('selected_lot_town')),
            'zip_code' => $this->input->post('lot_zip_code'),
            'province' => ucwords($this->input->post('selected_lot_province')),
            'region' => ucwords($this->input->post('selected_lot_region')),
            'country' => 'Philippines',
        );
        $this->db->insert('lot_location', $data);
    } 

    public function insert_es_amount_basis($mv_tax, $neighbor_inq, $assessor, $banks, $final_value){
        $data = array(
            'reference_id' => $this->input->post('es_no'),
            'mv_latest_tax_dec' => $mv_tax,
            'neighboring_inq' => $neighbor_inq,
            'assesor' => $assessor,
            'banks' => $banks,
            'final_value' => $final_value,  
        );
        $this->db->insert('amount_basis', $data);
    }  

    public function insert_es_uploads(){
        $data = array(
            'reference_id' => $this->input->post('es_no'),
        );
        $this->db->insert('es_uploads', $data);
    }

    public function insert_es_customer_balance(){
        $data = array(
            'reference_id' => $this->input->post('es_no'),
            'balance_type' => $this->input->post('balance_type'),
            'case_type' => '',
            'business_unit' => ucwords($this->input->post('business_unit')),
        );
        $this->db->insert('customer_bal_info', $data);
    }

    public function insert_es_customer_info(){
        $data = array(
            'reference_id' => $this->input->post('es_no'),
            'firstname' => ucwords($this->input->post('fname')),
            'middlename' => ucwords($this->input->post('mname')),
            'lastname' => ucwords($this->input->post('lname')),
        );
        $this->db->insert('customer_info', $data);
    }

    public function insert_es_customer_address(){
        $data = array(
            'customer_id' => $this->input->post('es_no'),
            'street' => ucwords($this->input->post('street')),
            'barangay' => ucwords($this->input->post('selected_barangay')),
            'town' => ucwords($this->input->post('selected_town')),
            'province' => ucwords($this->input->post('selected_province')),
            'zip_code' => $this->input->post('zip_code'),
            'country' => 'Philippines',
        );
        $this->db->insert('customer_address', $data);
    }

    public function insert_es_payment_requests(){
        $data = array(
            'is_no' => $this->input->post('es_no'),
            'type' => 'Collateral',
            'prepared_by' => $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname'),
            'date_requested' => date('Y-m-d'), 
            'status' => 'Pending',
        );
        $this->db->insert('payment_requests', $data);
    }

    public function update_es_uploads($id){
        $da_file = $this->input->post('doubtful_account');
        $ls_file = $this->input->post('latest_soa');
        $sd_file = $this->input->post('supporting_docs');

        $da_folder = "doubtful_account";
        $ls_folder = "latest_soa";
        $sd_folder = "supporting_docs";
        $es_no = $id;


        if ($_FILES and $_FILES["doubtful_account"]['name']):

            if (!file_exists('./assets/img/es_uploads/' . $es_no)):
                @mkdir('./assets/img/es_uploads/' . $es_no);
            endif;

            if (!file_exists('./assets/img/es_uploads/' . $es_no . '/' . $da_folder)):
                @mkdir('./assets/img/es_uploads/' . $es_no . '/' . $da_folder);
            endif;

            if (!file_exists('./assets/img/es_uploads/' . $es_no . '/' . $da_folder . '/' . $da_file)):
                @mkdir('./assets/img/es_uploads/' . $es_no . '/' . $da_folder . '/' . $da_file);
            endif;

            $targetPaths = getcwd() . '/assets/img/es_uploads/' . $es_no . '/' . $da_folder . '/' . $da_file;
            $img = $this->upload_images($targetPaths, "doubtful_account");

            // Save
            $data = array(
                'doubtful_account' => $img,
            );
            $this->db->where('reference_id', $es_no);
            $this->db->update('es_uploads', $data);
            // Close                     
        endif;

        if ($_FILES and $_FILES["latest_soa"]['name']):

            if (!file_exists('./assets/img/es_uploads/' . $es_no)):
                @mkdir('./assets/img/es_uploads/' . $es_no);
            endif;

            if (!file_exists('./assets/img/es_uploads/' . $es_no . '/' . $ls_folder)):
                @mkdir('./assets/img/es_uploads/' . $es_no . '/' . $ls_folder);
            endif;

            if (!file_exists('./assets/img/es_uploads/' . $es_no . '/' . $ls_folder . '/' . $ls_file)):
                @mkdir('./assets/img/es_uploads/' . $es_no . '/' . $ls_folder . '/' . $ls_file);
            endif;

            $targetPaths = getcwd() . '/assets/img/es_uploads/' . $es_no . '/' . $ls_folder . '/' . $ls_file;
            $img = $this->upload_images($targetPaths, "latest_soa");

            // Save
            $data = array(
                'latest_soa' => $img,
            );
            
            $this->db->where('reference_id', $es_no);
            $this->db->update('es_uploads', $data);
            // Close                     
        endif;

        if ($_FILES and $_FILES["supporting_docs"]['name']):

            if (!file_exists('./assets/img/es_uploads/' . $es_no)):
                @mkdir('./assets/img/es_uploads/' . $es_no);
            endif;

            if (!file_exists('./assets/img/es_uploads/' . $es_no . '/' . $sd_folder)):
                @mkdir('./assets/img/es_uploads/' . $es_no . '/' . $sd_folder);
            endif;

            if (!file_exists('./assets/img/es_uploads/' . $es_no . '/' . $sd_folder . '/' . $sd_file)):
                @mkdir('./assets/img/es_uploads/' . $es_no . '/' . $sd_folder . '/' . $sd_file);
            endif;

            $targetPaths = getcwd() . '/assets/img/es_uploads/' . $es_no . '/' . $sd_folder . '/' . $sd_file;
            $img = $this->upload_images($targetPaths, "supporting_docs");

            // Save
            $data = array(
                'supporting_docs' => $img,
            );
            $this->db->where('reference_id', $es_no);
            $this->db->update('es_uploads', $data);
            // Close                     
        endif;
    }
    //==================================================
	//END INSERT, UPDATE, DELETE
	//==================================================

	//==================================================
	//QUERY
	//==================================================
	public function get_js_new(){
        $query = $this->db->query("SELECT * FROM land_info WHERE tag='New LAPF-JS' ");
        return $query->result_array();
    }
    public function get_es_new(){
        $query = $this->db->query("SELECT * FROM land_info WHERE tag='New LAPF-ES' ");
        return $query->result_array();
    }
    public function getforms_byid($id){
        $query = $this->db->get_where('forms', array('form_no' => $id));
        return $query->row_array();
    }
    //==================================================
    //END QUERY
    //==================================================

    //==================================================
    //LOCATION
    //==================================================
	public function get_region(){
		$result = $this->db->select("regDesc, regCode")
		->get("refregion");
		return $result->result();
	}
	public function get_province($regCode){
		$result = $this->db->where(array('regCode' => $regCode))
			->select("provDesc, provCode")
			->get("refprovince");
		return $result->result();
	}
	public function get_citymun($provCode){
		$result = $this->db->where(array('provCode' => $provCode))
		->select("citymunDesc, citymunCode, zipcode")
		->get("refcitymun");
		return $result->result();
	}
	public function get_brgy($citymunCode){
		$result = $this->db->where(array('citymunCode' => $citymunCode))
		->select("brgyDesc, brgyCode")
		->get("refbrgy");
		return $result->result();
	}
    //==================================================
	//END LOCATION
	//==================================================
}