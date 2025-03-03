<?php
class Land_model extends CI_Model
{

        // getting the number of rows //////////////////////////////////////////////////////////////////////////////
        public function getli_status_approved()
        {
                $query = $this->db->query("SELECT status FROM land_info WHERE status='Approved' and tag = 'New'");
                return $query->num_rows();
        }

        public function getli_status_pending()
        {
                $query = $this->db->query("SELECT * FROM land_info WHERE tag='New'  AND status='Pending' AND tag= 'New'");
                return $query->num_rows();
        }

        public function getli_status_disapproved()
        {
                $query = $this->db->query("SELECT status FROM land_info WHERE status='Disapproved' AND tag = 'New'");
                return $query->num_rows();
        }
        public function geli_rows()
        {
                $query = $this->db->query("SELECT * FROM land_info ");
                return $query->num_rows();
        }

        public function getrestriction_rows($id)
        {
                $sql = "SELECT * FROM restrictions_to_land_title WHERE is_no = ? ";
                $query = $this->db->query($sql, array($id));
                return $query->num_rows();
        }

        public function getform_rows($id)
        {
                $sql = "SELECT * FROM forms WHERE form_no = ? ";
                $query = $this->db->query($sql, array($id));
                return $query->num_rows();
        }
        // end getting of num rows ////////////////////////////////////////////////////////////////////////////////

        public function getforms_byid($id)
        {
                $query = $this->db->get_where('forms', array('form_no' => $id));
                return $query->row_array();
        }

        public function getland_info()
        {
                $query = $this->db->query("SELECT * FROM land_info WHERE tag='New'  AND status='Pending'");
                return $query->result_array();
        }

        public function getli_disapproved()
        {
                $query = $this->db->query("SELECT * FROM land_info WHERE status='Disapproved'");
                return $query->result_array();
        }

        public function getli_approved()
        {
                $query = $this->db->query("SELECT * FROM land_info WHERE status='Approved' AND tag='New'");
                return $query->result_array();
        }

        public function getregistry_land()
        {
                $query = $this->db->query("SELECT * FROM land_info WHERE status='Approved' ");
                return $query->result_array();
        }

        public function getlot_largest()
        {
                $query = $this->db->query("SELECT * FROM land_info WHERE status='Approved' ORDER BY lot_size DESC  LIMIT 10");
                return $query->result_array();
        }
        public function getlot_smallest()
        {
                $query = $this->db->query("SELECT * FROM land_info WHERE status='Approved' ORDER BY lot_size ASC  LIMIT 10");
                return $query->result_array();
        }

        public function getland_information()
        {
                $query = $this->db->get('land_info');
                return $query->result_array();
        }

        public function getowner_info()
        {
                $query = $this->db->get('owner_info');
                return $query->result_array();
        }
        public function getowner_address()
        {
                $query = $this->db->get('owner_address');
                return $query->result_array();
        }

        public function getlot_location()
        {
                $query = $this->db->get('lot_location');
                return $query->result_array();
        }

        public function getcontact_person()
        {
                $query = $this->db->get('contact_person');
                return $query->result_array();
        }

        public function getavailble_proof()
        {
                $query = $this->db->get('available_proof');
                return $query->result_array();
        }

        public function getuploaded_documents()
        {
                $query = $this->db->get('uploaded_documents');
                return $query->result_array();
        }

        public function getli_byid($id)
        {
                $query = $this->db->get_where('land_info', array('is_no' => $id));
                return $query->row_array();
        }

        public function getoi_byid($id)
        {
                $query = $this->db->get_where('owner_info', array('is_no' => $id));
                return $query->row_array();
        }

        public function getoi_id($id)
        { //recently added
                $query = $this->db->get_where('owner_info', array('id' => $id));
                return $query->row_array();
        }

        public function getowners_byid($id)
        {
                $query = $this->db->get_where('owner_info', array('is_no' => $id));
                return $query->row_array();
        }

        public function getoa_byid($id)
        {
                $query = $this->db->get_where('owner_address', array('owner_id' => $id));
                return $query->row_array();
        }

        public function getud_byid($id)
        {
                $query = $this->db->from('uploaded_documents as ud')
                         ->join('es_uploads','es_uploads.reference_id = ud.is_no','left')
                         ->where('ud.is_no', $id);
                return $query->get()->row_array();
        }

        public function getud_info($is_no){
                $query = $this->db->get_where('uploaded_documents',['is_no' => $is_no]);
                return $query->row_array();
        }

        public function getupload_info()
        {
                $query = $this->db->get('uploaded_documents');
                return $query->result_array();
        }

        public function getll_byid($id)
        {
                $query = $this->db->get_where('lot_location', array('is_no' => $id));
                return $query->row_array();
        }

        public function getcp_byid($id)
        {
                $query = $this->db->get_where('contact_person', array('owner_id' => $id));
                return $query->row_array();
        }

        public function getap_byid($id)
        {
                $query = $this->db->get_where('available_proof', array('is_no' => $id));
                return $query->row_array();
        }


        public function getrstr_byid($id)
        {
                $query = $this->db->get_where('restrictions_to_land_title', array('is_no' => $id));
                return $query->row_array();
        }

        public function getbi_byid($id)
        {
                $query = $this->db->get_where('broker_info', array('is_no' => $id));
                return $query->row_array();
        }


        public function getland_new()
        {
                $query = $this->db->query("SELECT * FROM land_info WHERE tag='New' ");
                return $query->result_array();
        }

        public function getland_old()
        {
                $query = $this->db->query("SELECT * FROM land_info WHERE tag='Old' ");
                return $query->result_array();
        }

        public function get_js_new()
        {
                $query = $this->db->query("SELECT * FROM land_info WHERE tag='New LAPF-JS' ");
                return $query->result_array();
        }

        public function get_js_old()
        {
                $query = $this->db->query("SELECT * FROM land_info WHERE tag='Old LAPF-JS' ");
                return $query->result_array();
        }

        public function get_es_new()
        {
                $query = $this->db->query("SELECT * FROM land_info WHERE tag='New LAPF-ES' ");
                return $query->result_array();
        }
        public function get_es_old()
        {
                $query = $this->db->query("SELECT * FROM land_info WHERE tag='Old LAPF-ES' ");
                return $query->result_array();
        }

        public function getaspayment_es_new()
        {
                $query = $this->db->query("SELECT * FROM land_info WHERE tag='New LAPF-ES' AND status='Processing' ");
                return $query->result_array();
        }

        public function getaspayment_es_old()
        {
                $query = $this->db->query("SELECT * FROM land_info WHERE tag='Old LAPF-ES' AND status='Processing' ");
                return $query->result_array();
        }

        public function get_pending()
        {
                $query = $this->db->query("SELECT * FROM land_info WHERE status='Pending' ");
                return $query->result_array();
        }

        public function get_ll_asc()
        {
                $sql = "SELECT * FROM `lot_location`  \n" . "ORDER BY `lot_location`.`municipality` ASC";
                $query = $this->db->query($sql);
                return $query->result_array();
        }



        public function getud_status_pending()
        {
                $query = $this->db->query("SELECT status FROM uploaded_documents WHERE status='Pending Documents' ");
                return $query->num_rows();
        }

        public function getud_status_uploaded()
        {
                $query = $this->db->query("SELECT status FROM uploaded_documents WHERE status='Uploaded Documents'  ");
                return $query->num_rows();
        }
        public function getud_status_checked()
        {
                $query = $this->db->query("SELECT status FROM uploaded_documents WHERE status='Checked Documents' ");
                return $query->num_rows();
        }
        public function getud_status_incomplete()
        {
                $query = $this->db->query("SELECT status FROM uploaded_documents WHERE status='Incomplete Documents' ");
                return $query->num_rows();
        }
        public function getud_status_resubmit()
        {
                $query = $this->db->query("SELECT status FROM uploaded_documents WHERE status='Resubmit Documents' ");
                return $query->num_rows();
        }

        public function getrcp_byid($id)
        {
                $query = $this->db->get_where('request_check_payment', array('is_no' => $id));
                return $query->row_array();
        }



}