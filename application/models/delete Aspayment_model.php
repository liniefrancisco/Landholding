<?php
class Aspayment_model extends CI_Model
{

    // NUM ROWS ==========================================================================================================
    public function get_pending_es_aspayment()
    {
        $query = $this->db->query("SELECT status FROM land_info WHERE status='Pending' AND tag='New LAPF-ES' ");
        return $query->num_rows();
    }

    public function get_pending_js_aspayment()
    {
        $query = $this->db->query("SELECT status FROM land_info WHERE status='Pending' AND tag='New LAPF-JS' ");
        return $query->num_rows();
    }

    public function get_disapproved_es_aspayment()
    {
        $query = $this->db->query("SELECT status FROM land_info WHERE status='Disapproved' AND tag='New LAPF-ES' ");
        return $query->num_rows();
    }

    public function get_disapproved_js_aspayment()
    {
        $query = $this->db->query("SELECT status FROM land_info WHERE status='Disapproved' AND tag='New LAPF-JS' ");
        return $query->num_rows();
    }

    public function get_approved_js_aspayment()
    {
        $query = $this->db->query("SELECT status FROM land_info WHERE status='Approved' AND tag='New LAPF-JS' ");
        return $query->num_rows();
    }

    public function get_approved_es_aspayment()
    {
        $query = $this->db->query("SELECT status FROM land_info WHERE status='Approved' AND tag='New LAPF-ES' ");
        return $query->num_rows();
    }
    // END NUMROWS ========================================================================================================

    public function get_approved()
    {
        $query = $this->db->query("SELECT * from land_info where status='Approved' ");
        return $query->result_array();
    }

    public function get_pending_aspayment()
    {
        $query = $this->db->query("SELECT * from land_info where tag = 'LAPF-JS' OR tag = 'LAPF-ES'  AND status='Pending' ORDER BY date_acquired ASC ");
        return $query->result_array();
    }

    public function get_es_pending()
    {
        $query = $this->db->query("SELECT * from land_info where  tag = 'New LAPF-ES' AND status='Pending' ORDER BY date_acquired ASC ");
        return $query->result_array();
    }

    public function get_js_pending()
    {
        $query = $this->db->query("SELECT * from land_info where tag = 'New LAPF-JS'  AND status='Pending' ORDER BY date_acquired ASC ");
        return $query->result_array();
    }


    public function get_es_disapproved()
    {
        $query = $this->db->query("SELECT * from land_info where status='Disapproved' AND tag = 'LAPF-ES' ORDER BY date_approved ASC ");
        return $query->result_array();
    }

    public function get_js_disapproved()
    {
        $query = $this->db->query("SELECT * from land_info where status='Disapproved' AND tag = 'LAPF-JS'  ORDER BY date_approved ASC ");
        return $query->result_array();
    }


    public function getcustomer_byid($id)
    {
        $query = $this->db->get_where('customer_info', array('reference_id' => $id));
        return $query->row_array();
    }

    public function getcusaddr_byid($id)
    {
        $query = $this->db->get_where('customer_address', array('customer_id' => $id));
        return $query->row_array();
    }

    public function getcusbalinf_byid($id)
    {
        $query = $this->db->get_where('customer_bal_info', array('reference_id' => $id));
        return $query->row_array();
    }

    public function getbidding_byid($id)
    {
        $query = $this->db->get_where('bidding_details', array('reference_id' => $id));
        return $query->row_array();
    }

    public function getesupload_byid($id)
    {
        $query = $this->db->get_where('es_uploads', array('reference_id' => $id));
        return $query->row_array();
    }

    public function getesupload_result($id)
    {
        $query = $this->db->get_where('es_uploads', array('reference_id' => $id));
        return $query->row_array();
    }

    public function getamount_basis_byid($id)
    {
        $query = $this->db->get_where('amount_basis', array('reference_id' => $id));
        return $query->row_array();
    }

    public function get_customer_info()
    {
        $query = $this->db->get('customer_info');
        return $query->result_array();
    }
    public function get_customer_address()
    {
        $query = $this->db->get('customer_address');
        return $query->result_array();
    }
    public function get_customer_balance_info()
    {
        $query = $this->db->get('customer_bal_info');
        return $query->result_array();
    }

    public function get_aspayment_js()
    {
        $query = $this->db->get('as_payment_js');
        return $query->result_array();
    }

    public function get_aspayment_es()
    {
        $query = $this->db->get('as_payment_es');
        return $query->result_array();
    }

    public function get_es_upload()
    {
        $query = $this->db->get('es_uploads');
        return $query->result_array();
    }


    public function update_custbal_id($old_id, $new_id)
    {
        $data = array(
            'reference_id' => $new_id,
        );
        $this->db->where('reference_id', $old_id);
        $this->db->update('customer_bal_info', $data);
    }

    public function update_custadd_id($old_id, $new_id)
    {
        $data = array(
            'customer_id' => $new_id,
        );
        $this->db->where('customer_id', $old_id);
        $this->db->update('customer_address', $data);
    }




    public function add_customer_balance($bal_type, $cas_type, $es_no)
    {

        $data = array(
            'balance_type' => $bal_type,
            'case_type' => $cas_type,
            'business_unit' => ucwords($this->input->post('business_unit')),
            'reference_id' => $this->input->post('js_no') . $es_no,
        );
        $this->db->insert('customer_bal_info', $data);
    }

    public function add_customer_info($es_no)
    {
        $data = array(
            'firstname' => ucwords($this->input->post('cfname')),
            'middlename' => ucwords($this->input->post('cmname')),
            'lastname' => ucwords($this->input->post('clname')),
            'reference_id' => $this->input->post('js_no') . $es_no,
        );
        $this->db->insert('customer_info', $data);
    }

    public function add_customer_address($es_no)
    {
        $barangay =  $this->input->post('cbarangay');
        $municipality =  $this->input->post('ctown');
        $province =  $this->input->post('cprovince');
       
        $data = array(
            'street' => ucwords($this->input->post('cstreet')),
            'barangay' => ucwords($barangay),
            'town' => ucwords($municipality),
            'province' => ucwords($province),
            'customer_id' => $this->input->post('js_no') . $es_no,
        );
        $this->db->insert('customer_address', $data);
    }

    public function add_owner_info()
    {
        $data = array(
            'firstname' => ucwords($this->input->post('ofname')),
            'middlename' => ucwords($this->input->post('omname')),
            'lastname' => ucwords($this->input->post('olname')),
            'vital_status' => $this->input->post('vital_status'),
            'is_no' => $this->input->post('js_no') . $this->input->post('es_no'),
        );
        $this->db->insert('owner_info', $data);
    }

    public function add_lot_location()
    {
        $barangay =  $this->input->post('obarangay');
        $municipality =  $this->input->post('otown');
        $province =  $this->input->post('oprovince');
        $region =  $this->input->post('oregion');
        $zipcode = $this->input->post('ozipcode');
        $street = $this->input->post('ostreet');

        $data = array(
            'street' => ucwords($street),
            'baranggay' => ucwords($barangay),
            'municipality' => ucwords($municipality),
            'zip_code' => $zipcode,
            'province' => ucwords($province),
            'region' => ucwords($region),
            'country' => 'Philippines',
            'is_no' => $this->input->post('js_no') . $this->input->post('es_no'),
        );
        $this->db->insert('lot_location', $data);
    }

    public function add_es_land_info($lot_area, $stat, $date_acq, $tag)
    {
        $firstname = $this->session->userdata('firstname'); 
        $lastname = $this->session->userdata('lastname'); 
        $data = array(
            'is_no' => $this->input->post('es_no'),
            'lot' => $this->input->post('lot'),
            'cad' => $this->input->post('cad'),
            'lot_type' => $this->input->post('lot_type'),
            'lot_sold' => $this->input->post('lot_s'),
            'lot_size' => $lot_area,
            'status' => $stat,
            'prepared_by' => ucfirst($firstname).' '.ucfirst($lastname),
            'date_acquired' => $date_acq,
            'tag' => $tag,
        );
        $this->db->insert('land_info', $data);

    }

    public function update_land_info_status($id, $stat)
    {
        $data = array(
            'status' => $stat,
        );
        $this->db->where('is_no', $id);
        $this->db->update('land_info', $data);
    }

    public function add_js_land_info($lot_area, $stat, $date_acq, $tag)
    {
        $firstname = $this->session->userdata('firstname'); 
        $lastname = $this->session->userdata('lastname'); 
        $data = array(

            'is_no' => $this->input->post('js_no'),
            'lot' => $this->input->post('lot'),
            'cad' => $this->input->post('cad'),
            'lot_type' => $this->input->post('lot_type'),
            'lot_sold' => $this->input->post('lot_s'),
            'lot_size' => $lot_area,
            'status' => $stat,
            'prepared_by' => ucfirst($firstname).' '.ucfirst($lastname),
            'date_acquired' => $date_acq,
            'tag' => $tag,

        );
        $this->db->insert('land_info', $data);

    }


    public function add_bidding_details($bid_price)
    {
        $data = array(
            'bid_price' => $bid_price,
            'highest_bidder' => ucwords($this->input->post('status')),
            'reference_id' => $this->input->post('js_no'),
        );
        $this->db->insert('bidding_details', $data);
    }

    public function add_amount_basis($mv_tax, $neighbor_inq, $assessor, $banks, $final_value)
    {
        $data = array(
            'mv_latest_tax_dec' => $mv_tax,
            'neighboring_inq' => $neighbor_inq,
            'assesor' => $assessor,
            'banks' => $banks,
            'final_value' => $final_value,
            'reference_id' => $this->input->post('es_no'),
        );
        $this->db->insert('amount_basis', $data);
    }

    public function insert_esupload_id()
    {
        $data = array(
            'reference_id' => $this->input->post('es_no'),
        );
        $this->db->insert('es_uploads', $data);
    }

    public function insert_form_request($fno, $ftype, $uid)
    {
        $data = array(
            'form_no' => $fno,
            'form_type' => $ftype,
            'user_id' => $uid,
        );
        $this->db->insert('forms', $data);
    }

    public function getform_req_byid($id)
    {
        $query = $this->db->get_where('forms', array('form_no' => $id));
        return $query->row_array();
    }


    public function add_oct()
    {
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
                'status' => 'Checked Documents' 
            );
            $this->db->insert('uploaded_documents', $data);
            // Close

        endif;
    }

    public function add_tct()
    {
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
                'status' => 'Checked Documents'
            );
            $this->db->insert('uploaded_documents', $data);
            // Close

        endif;
    }


    public function add_es_uploads($id)
    {
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


    public function approve_aspayment($id,$name)
    {

        $data = array(
            'status' => "Approved",
            'date_approved' => date("Y-m-d"),
            'approved_by' => $name
        );
        $this->db->where('is_no', $id);
        return $this->db->update('land_info', $data);
    }

    public function disapprove_aspayment($id,$name)
    {
        $data = array(
            'status' => "Disapproved",
            'date_disapproved' => date("Y-m-d"),
            'disapproved_by' => $name
        );
        $this->db->where('is_no', $id);
        return $this->db->update('land_info', $data);
    }


    public function delete_land_info($id)
    {
        $this->db->delete('land_info', array('is_no' => $id));
    }

    public function delete_lot_location($id)
    {
        $this->db->delete('lot_location', array('is_no' => $id));
    }

    public function delete_owner_info($id)
    {
        $this->db->delete('owner_info', array('is_no' => $id));
    }

    public function delete_upload_docs($id)
    {

        $this->db->delete('uploaded_documents', array('is_no' => $id));
    }

    public function delete_es_upload($id)
    {
        $this->db->delete('es_uploads', array('reference_id' => $id));
    }


    public function delete_amount_basis($id)
    {
        $this->db->delete('amount_basis', array('reference_id' => $id));
    }

    public function delete_form($id)
    {
        $this->db->delete('forms', array('form_no' => $id));
    }












    // FOR UPLOADING IMAGES =========================================================================================================================
    public function upload_images($targetPaths, $image_name)
    {
        // $date = new DateTime();
        // $timeStamp = $date->getTimestamp();
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
    // ================================================================================================================================================================ 



}