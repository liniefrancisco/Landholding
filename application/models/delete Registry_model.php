<?php
	class Registry_model extends CI_Model{
		
		public function add_land_registry($lot_area, $price_per, $total_p){
			$data = array(
				'is_no' => $this->input->post('is_no'),
				'land_title_no' => $this->input->post('title_no', TRUE),
				'tax_dec_no' => $this->input->post('tax_no', TRUE),
				'lot' => $this->input->post('lot', TRUE),
				'cad' => $this->input->post('cad', TRUE),
				'lot_type' => $this->input->post('lot_type', TRUE),
				'lot_sold' => $this->input->post('lot_sold', TRUE),
				'purchase_type' => $this->input->post('purchase_type', TRUE),
				'lot_size' => $lot_area,
                'price_per_sqm' => $price_per,
                'total_price' => $total_p,
				'status' => "Processing",
                // 'prepared_by' => $this->session->userdata('first_name').' '.$this->session->usedata('last_name'),
				'date_acquired' => $this->input->post('date_acquired', TRUE),
				// 'date_approved' => $this->input->post('date_approved', TRUE),
				'tag' => "Old",
				);
			$this->db->insert('land_info',$data);
		}

		public function add_lot_location(){
			$data =  array(
				'zip_code' => $this->input->post('zipcode', TRUE),
				'region' => ucwords($this->input->post('region', TRUE)),
                'province' => ucwords($this->input->post('province', TRUE)),
                'municipality' => ucwords($this->input->post('town', TRUE)),
                'baranggay' => ucwords($this->input->post('barangay', TRUE)),
                'street' => ucwords($this->input->post('street', TRUE)),
                // 'district' => ucwords($this->input->post('district', TRUE)),
				'is_no' => $this->input->post('is_no'),				
				);
			return $this->db->insert('lot_location',$data);
		}

		public function add_lot_restriction(){

			$data =  array(
				'liens' => $this->input->post('liens', TRUE),				
				'easement' => $this->input->post('easement', TRUE),				
				'encumbrances' => $this->input->post('encumbrances', TRUE),				
				'is_no' => $this->input->post('is_no'),				

				);
			$this->db->insert('restrictions_to_land_title',$data);
		}

		public function add_owner_info(){

			$data = array(
				'is_no' => $this->input->post('is_no'),				
				);
			$this->db->insert('owner_info',$data);
		}

		public function add_owner_information($id){
			
			$data = array(

				'firstname' => ucwords($this->input->post('firstname', TRUE)),
				'middlename' => ucwords($this->input->post('middlename', TRUE)),
				'lastname' => ucwords($this->input->post('lastname', TRUE)),
				'gender' => $this->input->post('gender', TRUE),
                'vital_status' => $this->input->post('vital', TRUE),
                'is_no' => $id,

            );
		    $this->db->where('is_no',$id);
            $this->db->update('owner_info',$data);
		}

		public function add_owner_address($oid){

			$data = array(
				'zip_code' => $this->input->post('zipcode', TRUE),
				'region' => ucwords($this->input->post('region', TRUE)),
	            'province' => ucwords($this->input->post('province', TRUE)),
	            'municipality' => ucwords($this->input->post('town', TRUE)),
	            'baranggay' => ucwords($this->input->post('barangay', TRUE)),
	            'street' => ucwords($this->input->post('street', TRUE)),
	            // 'district' => ucwords($this->input->post('district', TRUE)),
                'owner_id' => $oid,
	        );
	        return $this->db->insert('owner_address',$data); 	 
		}

		public function update_owner_address($oid){

			$data = array(
				'region' => ucwords($this->input->post('region', TRUE)),
                'province' => ucwords($this->input->post('province', TRUE)),
                'municipality' => ucwords($this->input->post('town', TRUE)),
                'baranggay' => ucwords($this->input->post('barangay', TRUE)),
                'street' => ucwords($this->input->post('street', TRUE)),
                // 'district' => ucwords($this->input->post('district', TRUE)),
                'owner_id' => $oid,
	        );
			$this->db->where('owner_id',$oid);
	       return $this->db->update('owner_address',$data);	 
		}

		public function add_contact_person($oid){

			 $data = array(
				'name' => ucwords($this->input->post('fullname', TRUE)),
				'address' => ucwords($this->input->post('address', TRUE)),
				'tel_no' => $this->input->post('tel_no', TRUE),
				'phone_no' => $this->input->post('phone_no', TRUE),
				'email_ad' => $this->input->post('email', TRUE),
	            'owner_id' => $oid,
              );
             $this->db->insert('contact_person',$data);
		}

		public function add_broker_info($oid){

	         $data = array(
				'firstname' => ucwords($this->input->post('broker_first', TRUE)),
				'middlename' => ucwords($this->input->post('broker_middle', TRUE)),
				'lastname' => ucwords($this->input->post('broker_last', TRUE)),
                'owner_id' => $oid,
              );
	        $this->db->insert('broker_info',$data);
		}
		
		public function add_uploaded_documents($id,$name){
            $data = array(
                'status' => "Checked Documents",
                'checked_by' => $name,
                'is_no' => $id,	
                'date_checked' => date("Y-m-d")
              );
			$this->db->insert('uploaded_documents',$data);
		}
		// public function add_uploaded_documents($id){
		// 	$data = array(
		// 		'is_no' => $id,				
		// 		);
		// 	$this->db->insert('uploaded_documents',$data);
		// }

		public function update_li_status($id){
			$data = array(
						'status' =>  "Approved",
	           		 );
			$this->db->where('is_no',$id);
	        $this->db->update('land_info',$data); 
		}

		public function insert_form_request($fno, $ftype, $uid){
            $data= array(
                        'form_no' => $fno,
                        'form_type' => $ftype,
                        'user_id' => $uid,
                );
            $this->db->insert('forms',$data);
        }

        public function getforms_byid($id){
              $query = $this->db->get_where('forms', array('form_no'=> $id));
              return $query->row_array();
        }

          public function get_tesdaregion()
    {
        $result = $this->db->select("regDesc, regCode")
            ->get("refregion");
        return $result->result();
    }
    // public function get_tesdaregion()
    // {
    //     $result = $this->db->select("regDesc")
    //         ->get("refregion");
    //     return $result->result();
    // }

    public function get_tesdaprovince($regCode)
    {
        $result = $this->db->where(array('regCode' => $regCode))
            ->select("provDesc, provCode")
            ->get("refprovince");
        return $result->result();
    }
    public function get_all_aprovince()
    {
        $result = $this->db->select("provDesc, provCode")
			->order_by("provDesc","asc")
            ->get("refprovince");
        return $result->result();
    }

    public function get_tesdacitymun($provCode)
    {
        $result = $this->db->where(array('provCode' => $provCode))
            ->select("citymunDesc, citymunCode, zipcode")
            ->get("refcitymun");
        return $result->result();
    }

    public function get_tesdabrgy($citymunCode)
    {
        $result = $this->db->where(array('citymunCode' => $citymunCode))
            ->select("brgyDesc, brgyCode")
            ->get("refbrgy");
        return $result->result();
    }

      public function get_region()
    {
        return $this->db->select("regDesc, regCode")->get("refregion");
    }

    public function get_province($regCode)
    {
        $result = $this->db->where(array('regCode' => $regCode))
            ->select("provDesc, provCode")
            ->get("refprovince");
        return $result->result();
    }

    public function get_citymun($provCode)
    {
        $result = $this->db->where(array('provCode' => $provCode))
            ->select("citymunDesc, citymunCode")
            ->get("refcitymun");
        return $result->result();
    }

    public function get_brgy($citymunCode)
    {
        $result = $this->db->where(array('citymunCode' => $citymunCode))
            ->select("brgyDesc, brgyCode")
            ->get("refbrgy");
        return $result->result();
    }
    
    public function getzip_code(){
        $query = $this->db->query("SELECT * FROM refcitymun");
        return $query->result_array();
}




}