<?php
class Aspayment_model extends CI_Model{
	//==================================================
	#CRUD QUERY
	//==================================================
	public function add_customer_bal($is_no){
        $data = array(
        	'reference_id' 	=> $is_no,
            'case_type' 	=> $this->input->post('case_type'),
            'business_unit' => ucwords($this->input->post('business_unit')), 
        );
        $this->db->insert('customer_bal_info', $data);
    }
    public function add_customer_info($is_no){
        $data = array(
        	'reference_id' 	=> $is_no,
            'firstname' 	=> ucwords($this->input->post('customer_fname')),
            'middlename' 	=> ucwords($this->input->post('customer_mname')),
            'lastname' 		=> ucwords($this->input->post('customer_lname')),
        );
        $this->db->insert('customer_info', $data);
    }
    public function add_customer_add($is_no){
        $region             = $this->db->query("SELECT regDesc FROM refregion WHERE regCode = ?", [$this->input->post('customer_region')])->row()->regDesc ?? '';
        $province           = $this->db->query("SELECT provDesc FROM refprovince WHERE provCode = ?", [$this->input->post('customer_province')])->row()->provDesc ?? '';
        $municipality       = ucwords(explode('|', $this->input->post('customer_municipality'))[1] ?? '');
        $barangay           = $this->db->query("SELECT brgyDesc FROM refbrgy WHERE brgyCode = ?", [$this->input->post('customer_barangay')])->row()->brgyDesc ?? '';

        $data = array(
        	'customer_id' 	=> $is_no,
        	'region' 		=> $region ,
            'street' 		=> ucwords($this->input->post('customer_street')),
            'barangay' 		=> $barangay,
            'municipality' 	=> $municipality,
            'province' 		=> $province,
            'country' 		=> 'Philippines',
            'zip_code'      => $this->input->post('customer_zip_code'),
        );
        $this->db->insert('customer_address', $data);
    }
    public function add_land_info($is_no,$lot_area,$tag){
        $data = array(
            'is_no' 			=> $is_no,
            'date_acquired' 	=> date('Y-m-d'),
            'lot' 				=> $this->input->post('lot'),
            'cad' 				=> $this->input->post('cad'),
            'lot_type' 			=> $this->input->post('lot_type'),
            'lot_sold' 			=> $this->input->post('lot_sold'),
            'lot_size' 			=> $lot_area,
            'tag' 				=> $tag,    
        );
        $this->db->insert('land_info', $data);
    }
    public function add_owner_info($is_no){
        $data = array(
        	'is_no' 		=> $is_no,
            'firstname' 	=> ucwords($this->input->post('lot_fname')),
            'middlename' 	=> ucwords($this->input->post('lot_mname')),
            'lastname' 		=> ucwords($this->input->post('lot_lname')),
            'gender' 		=> $this->input->post('gender'),
            'vital_status' 	=> $this->input->post('vital_status'),
        );
        $this->db->insert('owner_info', $data);
    }
    public function add_lot_location($is_no) {
        $region             = $this->db->query("SELECT regDesc FROM refregion WHERE regCode = ?", [$this->input->post('lot_region')])->row()->regDesc ?? '';
        $province           = $this->db->query("SELECT provDesc FROM refprovince WHERE provCode = ?", [$this->input->post('lot_province')])->row()->provDesc ?? '';
        $municipality       = ucwords(explode('|', $this->input->post('lot_town'))[1] ?? '');
        $barangay           = $this->db->query("SELECT brgyDesc FROM refbrgy WHERE brgyCode = ?", [$this->input->post('lot_barangay')])->row()->brgyDesc ?? '';

        $data = array(
            'is_no'         => $is_no,
            'region'        => $region,
            'street'        => ucwords($this->input->post('lot_street')),
            'baranggay'     => $barangay,
            'municipality'  => $municipality, 
            'province'      => $province,
            'country'       => 'Philippines',
            'zip_code'      => $this->input->post('lot_zip_code'),
        );
        $this->db->insert('lot_location', $data);
    }
    public function add_bidding_details($bid_price,$is_no){
        $data = array(
            'reference_id'      => $is_no,
            'bid_price'         => $bid_price,
            'highest_bidder'    => ucwords($this->input->post('status')),            
        );
        $this->db->insert('bidding_details', $data);
    }
    public function add_tct_oct_js(){
        $oct_file   = $this->input->post('oct');
        $oct_folder = "OCT";
        $is_no        = $this->input->post('js_no') . $this->input->post('es_no');
        // UPDATING BARANGGAY RESOLUTION
        if ($_FILES and $_FILES["oct"]['name']):
            if (!file_exists('./assets/img/js_uploads/' . $is_no)):
                @mkdir('./assets/img/js_uploads/' . $is_no);
            endif;
            if (!file_exists('./assets/img/js_uploads/' . $is_no . '/' . $oct_folder)):
                @mkdir('./assets/img/js_uploads/' . $is_no . '/' . $oct_folder);
            endif;
            if (!file_exists('./assets/img/js_uploads/' . $is_no . '/' . $oct_folder . '/' . $oct_file)):
                @mkdir('./assets/img/js_uploads/' . $is_no . '/' . $oct_folder . '/' . $oct_file);
            endif;

            $targetPaths    = getcwd() . '/assets/img/js_uploads/' . $is_no . '/' . $oct_folder . '/' . $oct_file;
            $img            = $this->upload_images($targetPaths, "oct");

            // Save
            $data = array(
                'is_no' => $is_no,
                'oct'   => $img, 
            );
            $this->db->insert('uploaded_documents', $data);
            // Close
        endif;

        $tct_file       = $this->input->post('tct');
        $tct_folder     = "TCT";
        $is_no          = $this->input->post('js_no') . $this->input->post('es_no');
        // UPDATING BARANGGAY RESOLUTION
        if ($_FILES and $_FILES["tct"]['name']):
            if (!file_exists('./assets/img/js_uploads/' . $is_no)):
                @mkdir('./assets/img/js_uploads/' . $is_no);
            endif;
            if (!file_exists('./assets/img/js_uploads/' . $is_no . '/' . $tct_folder)):
                @mkdir('./assets/img/js_uploads/' . $is_no . '/' . $tct_folder);
            endif;
            if (!file_exists('./assets/img/js_uploads/' . $is_no . '/' . $tct_folder . '/' . $tct_file)):
                @mkdir('./assets/img/js_uploads/' . $is_no . '/' . $tct_folder . '/' . $tct_file);
            endif;

            $targetPaths    = getcwd() . '/assets/img/js_uploads/' . $is_no . '/' . $tct_folder . '/' . $tct_file;
            $img            = $this->upload_images($targetPaths, "tct");

            // Save
            $data = array(
                'is_no' => $is_no,
                'tct'   => $img,
            );
            $this->db->insert('uploaded_documents', $data);
            // Close
        endif;
    }
    public function add_tct_oct_es(){
        $oct_file   = $this->input->post('oct');
        $oct_folder = "OCT";
        $is_no        = $this->input->post('js_no') . $this->input->post('es_no');
        // UPDATING BARANGGAY RESOLUTION
        if ($_FILES and $_FILES["oct"]['name']):
            if (!file_exists('./assets/img/es_uploads/' . $is_no)):
                @mkdir('./assets/img/es_uploads/' . $is_no);
            endif;
            if (!file_exists('./assets/img/es_uploads/' . $is_no . '/' . $oct_folder)):
                @mkdir('./assets/img/es_uploads/' . $is_no . '/' . $oct_folder);
            endif;
            if (!file_exists('./assets/img/es_uploads/' . $is_no . '/' . $oct_folder . '/' . $oct_file)):
                @mkdir('./assets/img/es_uploads/' . $is_no . '/' . $oct_folder . '/' . $oct_file);
            endif;

            $targetPaths    = getcwd() . '/assets/img/es_uploads/' . $is_no . '/' . $oct_folder . '/' . $oct_file;
            $img            = $this->upload_images($targetPaths, "oct");

            // Save
            $data = array(
                'is_no' => $is_no,
                'oct'   => $img, 
            );
            $this->db->insert('uploaded_documents', $data);
            // Close
        endif;

        $tct_file       = $this->input->post('tct');
        $tct_folder     = "TCT";
        $is_no          = $this->input->post('js_no') . $this->input->post('es_no');
        // UPDATING BARANGGAY RESOLUTION
        if ($_FILES and $_FILES["tct"]['name']):
            if (!file_exists('./assets/img/es_uploads/' . $is_no)):
                @mkdir('./assets/img/es_uploads/' . $is_no);
            endif;
            if (!file_exists('./assets/img/es_uploads/' . $is_no . '/' . $tct_folder)):
                @mkdir('./assets/img/es_uploads/' . $is_no . '/' . $tct_folder);
            endif;
            if (!file_exists('./assets/img/es_uploads/' . $is_no . '/' . $tct_folder . '/' . $tct_file)):
                @mkdir('./assets/img/es_uploads/' . $is_no . '/' . $tct_folder . '/' . $tct_file);
            endif;

            $targetPaths    = getcwd() . '/assets/img/es_uploads/' . $is_no . '/' . $tct_folder . '/' . $tct_file;
            $img            = $this->upload_images($targetPaths, "tct");

            // Save
            $data = array(
                'is_no' => $is_no,
                'tct'   => $img,
            );
            $this->db->insert('uploaded_documents', $data);
            // Close
        endif;
    }
    public function add_forms($is_no, $form_type, $user_id){
        $data = array(
            'form_no'   => $is_no,
            'form_type' => $form_type,
            'user_id'   => $user_id,
        );
        $this->db->insert('forms', $data);
    }
    public function add_document_status($is_no,$user_name){
        $data = array(
            'is_no'             => $is_no,
            'status'            => 'Pending',
            'prepared_by'       => $user_name, 
            'submission_date'   => date("Y-m-d")
        );
        $this->db->insert('document_status', $data);
    }
    public function add_amount_basis($is_no, $mv_tax, $neighbor_inq, $assessor, $banks, $final_value){
        $data = array(
            'reference_id'      => $is_no,
            'mv_latest_tax_dec' => $mv_tax,
            'neighboring_inq'   => $neighbor_inq,
            'assesor'           => $assessor,
            'banks'             => $banks,
            'final_value'       => $final_value,  
        );
        $this->db->insert('amount_basis', $data);
    }  
    public function add_es_uploads($is_no){
        $data = array(
            'reference_id' => $is_no,
        );
        $this->db->insert('es_uploads', $data);
    }
    public function add_customer_bal1($is_no){
        $data = array(
            'reference_id'  => $is_no,
            'balance_type'  => $this->input->post('balance_type'),
            'business_unit' => ucwords($this->input->post('business_unit')),
        );
        $this->db->insert('customer_bal_info', $data);
    }
    public function update_es_uploads($is_no){
        $da_file    = $this->input->post('doubtful_account');
        $ls_file    = $this->input->post('latest_soa');
        $sd_file    = $this->input->post('supporting_docs');

        $da_folder  = "Doubtful Account";
        $ls_folder  = "Latest Soa";
        $sd_folder  = "Supporting Docs";
        $es_no      = $is_no;


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

            $targetPaths    = getcwd() . '/assets/img/es_uploads/' . $es_no . '/' . $da_folder . '/' . $da_file;
            $img            = $this->upload_images($targetPaths, "doubtful_account");
            $data           = array('doubtful_account' => $img);

            $this->db->where('reference_id', $es_no);
            $this->db->update('es_uploads', $data);                   
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

            $targetPaths    = getcwd() . '/assets/img/es_uploads/' . $es_no . '/' . $ls_folder . '/' . $ls_file;
            $img            = $this->upload_images($targetPaths, "latest_soa");
            $data           = array('latest_soa' => $img);
            
            $this->db->where('reference_id', $es_no);
            $this->db->update('es_uploads', $data);                   
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

            $targetPaths    = getcwd() . '/assets/img/es_uploads/' . $es_no . '/' . $sd_folder . '/' . $sd_file;
            $img            = $this->upload_images($targetPaths, "supporting_docs");
            $data           = array('supporting_docs' => $img);

            $this->db->where('reference_id', $es_no);
            $this->db->update('es_uploads', $data);                    
        endif;
    }
    public function update_ds_approved($is_no,$status){
        $data = array(
            'status'        => $status,
            'approval_date' => date("Y-m-d"),
            'approved_by'   => $this->session->userdata('firstname').' '.$this->session->userdata('lastname'),
        );
        $this->db->where('is_no', $is_no);
        $this->db->where('status', 'Pending');
        $this->db->update('document_status', $data);
    }
    public function update_pr_approved($is_no,$status){
        $data = array(
            'status'        => $status,
            'approval_date' => date("Y-m-d"),
            'approved_by'   => $this->session->userdata('firstname').' '.$this->session->userdata('lastname'),
        );
        $this->db->where('is_no', $is_no);
        $this->db->where('status', 'Pending');
        $this->db->update('payment_requests', $data);
    }
    public function update_ds_disapproved($status,$message,$is_no){
        $data = array(
            'status'                => $status,
            'disapproval_reason'    => $message,
            'disapproval_date'      => date("Y-m-d"),
            'disapproved_by'        => $this->session->userdata('firstname').' '.$this->session->userdata('lastname'),
        );
        $this->db->where('is_no', $is_no);
        $this->db->where('status', 'Pending');
        $this->db->update('document_status', $data);
    }
    public function update_pr_disapproved($status,$is_no){
        $data = array(
            'status'            => $status,
            'disapproval_date'  => date("Y-m-d"),
            'disapproved_by'    => $this->session->userdata('firstname').' '.$this->session->userdata('lastname'),
        );
        $this->db->where('is_no', $is_no);
        $this->db->where('status', 'Pending');
        $this->db->update('payment_requests', $data);
    }
    public function add_payment_request($is_no,$cl_id,$price,$user_name){
        $data = array(
            'is_no'             => $is_no,
            'control_no'        => $cl_id,
            'type'              => 'Collateral',
            'amount'            => $price,
            'status'            => "Pending",
            'prepared_by'       => $user_name,
            'submission_date'   => date('Y-m-d'),
        );
        $this->db->insert('payment_requests', $data);
    }
	//==================================================
	#QUERY
	//==================================================
    public function getcl_id() {
        $query = $this->db->query("SELECT * FROM payment_requests WHERE type = 'Collateral' ORDER BY id DESC LIMIT 1;");
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
    public function get_municipality($provCode){
        $result = $this->db->where(array('provCode' => $provCode))
        ->select("citymunDesc, citymunCode, zipcode")
        ->get("refcitymun");
        return $result->result();
    }
    public function get_barangay($citymunCode){
        $result = $this->db->where(array('citymunCode' => $citymunCode))
            ->select("brgyDesc, brgyCode")
            ->get("refbrgy");
        return $result->result();
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
}