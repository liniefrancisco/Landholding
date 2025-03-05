<?php
class Acquisition_model extends CI_Model{
	//==================================================
	#CRUD QUERY
	//==================================================
	public function add_land_info($lot_area, $price_per, $total_p, $tag){
		$data = array(
			'is_no' 		=> $this->input->post('is_no'),
			'date_acquired' => date('Y-m-d'),
			'lot' 			=> $this->input->post('lot_no', TRUE),
			'cad' 			=> $this->input->post('cad_no', TRUE),
			'lot_type' 		=> $this->input->post('lot_type', TRUE),
			'lot_sold' 		=> $this->input->post('lot_sold', TRUE),
			'purchase_type' => $this->input->post('purchase_type', TRUE),
			'lot_size' 		=> $lot_area,
			'price_per_sqm' => $price_per,
			'total_price' 	=> $total_p,
			'tag' 			=> $tag,
		);
		$this->db->insert('land_info',$data);                                
	}
	public function add_lot_location(){
		$data = array(
			'is_no' 		=> $this->input->post('is_no'),
			'region' 		=> ucwords($this->input->post('selectedRegion', TRUE)),
			'street' 		=> ucwords($this->input->post('street', TRUE)),
			'baranggay' 	=> ucwords($this->input->post('selectedBaranggay', TRUE)),
			'municipality' 	=> ucwords($this->input->post('selectedCity', TRUE)),
			'province' 		=> ucwords($this->input->post('selectedProvince', TRUE)),
			'country' 		=>'Philippines', 
			'zip_code' 		=> $this->input->post('zipcode', TRUE),
		);
		$this->db->insert('lot_location',$data);     
	}
	public function add_restriction(){
		$data = array(
			'liens' 		=> $this->input->post('liens', TRUE),
			'easement' 		=> $this->input->post('easement', TRUE),
			'encumbrances' 	=> $this->input->post('encumbrances', TRUE),
			'is_no' 		=> $this->input->post('is_no'),
		);
		$this->db->insert('restrictions_to_land_title',$data);
	}
	public function add_owner_id(){
		$data = array(
		 	'is_no' => $this->input->post('is_no'),
		);
		$this->db->insert('owner_info',$data);
	}
	public function add_owner_info($id){
		$data =  array(
		 	'firstname' 	=> ucwords($this->input->post('firstname', TRUE)),
		 	'middlename' 	=> ucwords($this->input->post('middlename', TRUE)),
		 	'lastname' 		=> ucwords($this->input->post('lastname', TRUE)),
		 	'gender' 		=> $this->input->post('gender', TRUE),
		 	'vital_status' 	=> $this->input->post('vital_status', TRUE),  
		);
		$this->db->where('is_no', $id);
		$this->db->update('owner_info', $data);
	}
	public function add_owner_address($id){
		$data = array(
			'owner_id' 		=> $id,
			'is_no' 		=> $this->input->post('is_no', TRUE), 
			'region' 		=> ucwords($this->input->post('selectedRegion', TRUE)),
			'street' 		=> ucwords($this->input->post('street', TRUE)), 
			'baranggay' 	=> ucwords($this->input->post('selectedBaranggay', TRUE)),
			'municipality' 	=> ucwords($this->input->post('selectedCity', TRUE)),
			'province' 		=> ucwords($this->input->post('selectedProvince', TRUE)),
			'country' 		=>'Philippines', 
			'zip_code' 		=> $this->input->post('zipcode', TRUE),
		);
		$this->db->insert('owner_address',$data);    
	}
	public function add_broker_info($id){
		if($this->input->post('broker_first') != null){
			$data = array(
				'owner_id' 		=> $id,
				'is_no' 		=> $this->input->post('is_no'),
				'firstname' 	=> ucwords($this->input->post('broker_first', TRUE)),
				'middlename' 	=> ucwords($this->input->post('broker_middle', TRUE)),
				'lastname' 		=> ucwords($this->input->post('broker_last', TRUE)),
			);
			$this->db->insert('broker_info',$data);
		}
	}
	public function add_contact_info($id){
		if($this->input->post('fullname') != null){
			$data = array(
				'owner_id' 	=> $id,
				'is_no' 	=> $this->input->post('is_no'),
				'name' 		=> ucwords($this->input->post('fullname', TRUE)),
				'address' 	=> ucwords($this->input->post('address', TRUE)),
				'tel_no' 	=> $this->input->post('tel_no', TRUE),
				'phone_no' 	=> $this->input->post('phone_no', TRUE),
				'email_ad' 	=> $this->input->post('email', TRUE),
			);
			$this->db->insert('contact_person',$data);
		}
	}
	public function add_upload_id($id){
		$data = array(
			'is_no' => $id,
		);
		$this->db->insert('uploaded_documents',$data);
	}
	public function add_docu_status_id($id){
		$data = array(
			'is_no' => $id,
		);
		$this->db->insert('document_status',$data);
	}
	public function delete_forms($id){
		$this->db->delete('forms', array('form_no' => $id));
	}
	public function delete_land_info($id){
		$this->db->delete('land_info', array('is_no' => $id));
	}
	public function delete_lot_location($id){
		$this->db->delete('lot_location', array('is_no' => $id));
	}
	public function delete_restriction($id){
		$this->db->delete('restrictions_to_land_title', array('is_no' => $id));
	}
	public function delete_owner_info($id){
		$data =  array(
		 	'firstname' 	=> '', 
		 	'middlename' 	=> '', 
		 	'lastname' 		=> '', 
		 	'gender' 		=> '', 
		 	'vital_status' 	=> '',  
		);
		$this->db->where('is_no', $id);
		$this->db->update('owner_info', $data);
	}
	public function delete_owner_address($id){
		$this->db->delete('owner_address', array('is_no' => $id));
	}
	public function delete_broker_info($id){
		$this->db->delete('broker_info', array('is_no' => $id));
	}
	public function delete_contact_person($id){
		$this->db->delete('contact_person', array('is_no' => $id));
	}
	public function delete_upload_docs($id){
		$this->db->delete('uploaded_documents', array('is_no' => $id));
	}
	public function delete_document_status($id){
		$this->db->delete('document_status', array('is_no' => $id));
	}
	public function update_lt($is_no){//UPDATE LAND TITLE
		$lt_file 	= $this->input->post('lt_file');
		$lt 		= "Land Title";

		if ($_FILES and $_FILES["lt_file"]['name']):

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $lt)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $lt);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $lt . '/' . $lt_file)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $lt . '/' . $lt_file);
			endif;

			$targetPaths 	= getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $lt . '/' . $lt_file;
			$img 			= $this->upload_images($targetPaths, "lt_file");

			// Save
			$data = array(
				'land_title' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close             
		endif;
	}
	public function update_tct($is_no){//UPDATE TCT
		$img = $this->input->post('tct_file');
		$tct = "TCT";

		if ($_FILES and $_FILES["tct_file"]['name']):
			if (!file_exists('./assets/img/uploaded_documents/' . $is_no)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $tct)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $tct);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $tct . '/' . $img)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $tct . '/' . $img);
			endif;

			$targetPaths 	= getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $tct . '/' . $img;
			$img 			= $this->upload_images($targetPaths, "tct_file");

			// Save
			$data = array(
				'tct' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close    
		endif;
	}
	public function update_dos($is_no){//UPDATE DEED OF SALE
		$dos_file 	= $this->input->post('dos_file');
		$dos 		= "Previous Deed Of Sale";

		if ($_FILES and $_FILES["dos_file"]['name']):
			if (!file_exists('./assets/img/uploaded_documents/' . $is_no)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $dos)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $dos);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $dos . '/' . $dos_file)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $dos . '/' . $dos_file);
			endif;

			$targetPaths 	= getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $dos . '/' . $dos_file;
			$img 			= $this->upload_images($targetPaths, "dos_file");

			// Save
			$data = array(
				'previous_deed_of_sale' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close               
		endif;
	}
	public function update_ecar($is_no){//UPDATE E-CAR
		$ecar_file 	= $this->input->post('ecar_file');
		$ecar 		= "eCAR";

		if ($_FILES and $_FILES["ecar_file"]['name']):
			if (!file_exists('./assets/img/uploaded_documents/' . $is_no)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $ecar)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $ecar);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $ecar . '/' . $ecar_file)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $ecar . '/' . $ecar_file);
			endif;

			$targetPaths 	= getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $ecar . '/' . $ecar_file;
			$img 			= $this->upload_images($targetPaths, "ecar_file");

			// Save
			$data = array(
				'e_car' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close     
		endif;
	}
	public function update_tax_declaration($is_no){//UPDATE TAX DECLARATION
		$td_file 	= $this->input->post('td_file');
		$tax 		= "Tax Declaration";

		if ($_FILES and $_FILES["td_file"]['name']):
			if (!file_exists('./assets/img/uploaded_documents/' . $is_no)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $tax)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $tax);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $tax . '/' . $td_file)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $tax . '/' . $td_file);
			endif;

			$targetPaths 	= getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $tax . '/' . $td_file;
			$img 			= $this->upload_images($targetPaths, "td_file");

			// Save
			$data = array(
				'latest_tax_dec' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close              
		endif;
	}
	public function update_tax_clearance($is_no){//UPDATE TAX CLEARANCE
		$tc_file 	= $this->input->post('tc_file');
		$tc 		= "Tax Clearance";

		if ($_FILES and $_FILES["tc_file"]['name']):
			if (!file_exists('./assets/img/uploaded_documents/' . $is_no)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $tc)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $tc);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $tc . '/' . $tc_file)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $tc . '/' . $tc_file);
			endif;

			$targetPaths 	= getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $tc . '/' . $tc_file;
			$img 			= $this->upload_images($targetPaths, "tc_file");

			// Save
			$data = array(
				'tax_clearance' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close               
		endif;
	}
	public function update_land_sketch($is_no){//UPDATE LAND SKETCH
		$img 	= $this->input->post('land_sketch_file');
		$sketch = "Land Sketch";

		if ($_FILES and $_FILES["land_sketch_file"]['name']):
			if (!file_exists('./assets/img/uploaded_documents/' . $is_no)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $sketch)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $sketch);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $sketch . '/' . $img)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $sketch . '/' . $img);
			endif;

			$targetPaths 	= getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $sketch . '/' . $img;
			$img 			= $this->upload_images($targetPaths, "land_sketch_file");

			// Save
			$data = array(
				'land_sketch' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close    
		endif;
	}
	public function update_vicinity_map($is_no){//UPDATE VICINITY MAP
		$vm_file 	= $this->input->post('vm_file');
		$vm 		= "Vicinity Map";

		if ($_FILES and $_FILES["vm_file"]['name']):
			if (!file_exists('./assets/img/uploaded_documents/' . $is_no)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $vm)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $vm);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $vm . '/' . $vm_file)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $vm . '/' . $vm_file);
			endif;

			$targetPaths 	= getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $vm . '/' . $vm_file;
			$img 			= $this->upload_images($targetPaths, "vm_file");

			// Save
			$data = array(
				'vicinity_map' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close             
		endif;
	}
	public function update_certificate($is_no){//UPDATE CERTIFICATE OF NO IMPROVEMENT
		$cni_file 	= $this->input->post('cni_file');
		$cni 		= "Certificate of No Improvement";

		if ($_FILES and $_FILES["cni_file"]['name']):
			if (!file_exists('./assets/img/uploaded_documents/' . $is_no)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $cni)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $cni);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $cni . '/' . $cni_file)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $cni . '/' . $cni_file);
			endif;

			$targetPaths 	= getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $cni . '/' . $cni_file;
			$img 			= $this->upload_images($targetPaths, "cni_file");

			// Save
			$data = array(
				'cert_no_improvement' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close            
		endif;
	}
	public function update_real_estate_tax($is_no){//UPDATE REAL ESTATE TAX
		$ret_file 	= $this->input->post('ret_file');
		$ret 		= "Real Estate Tax";

		if ($_FILES and $_FILES["ret_file"]['name']):
			if (!file_exists('./assets/img/uploaded_documents/' . $is_no)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $ret)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $ret);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $ret . '/' . $ret_file)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $ret . '/' . $ret_file);
			endif;

			$targetPaths 	= getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $ret . '/' . $ret_file;
			$img 			= $this->upload_images($targetPaths, "ret_file");

			// Save
			$data = array(
				'real_estate_tax' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close     
		endif;
	}
	public function update_marriage_contract($is_no){//MARRIAGE CONTRACT
		$mc_file 	= $this->input->post('mc_file');
		$mc 		= "Marriage Contract";

		if ($_FILES and $_FILES["mc_file"]['name']):
			if (!file_exists('./assets/img/uploaded_documents/' . $is_no)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $mc)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $mc);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $mc . '/' . $mc_file)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $mc . '/' . $mc_file);
			endif;

			$targetPaths 	= getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $mc . '/' . $mc_file;
			$img 			= $this->upload_images($targetPaths, "mc_file");

			// Save
			$data = array(
				'marriage_contract' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close  
		endif;
	}
	public function update_birth_certificate($is_no){//UPDATE BIRTH CERTIFICATE
		$bc_file 	= $this->input->post('bc_file');
		$bc 		= "Birth Certificate";

		if ($_FILES and $_FILES["bc_file"]['name']):
			if (!file_exists('./assets/img/uploaded_documents/' . $is_no)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $bc)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $bc);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $bc . '/' . $bc_file)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $bc . '/' . $bc_file);
			endif;

			$targetPaths 	= getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $bc . '/' . $bc_file;
			$img 			= $this->upload_images($targetPaths, "bc_file");

			// Save
			$data = array(
				'birth_certificate' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close               
		endif;
	}
	public function update_valid_id($is_no){//UPDATE VALID ID
		$vi_file 	= $this->input->post('vi_file');
		$vi 		= "Valid ID";

		if ($_FILES and $_FILES["vi_file"]['name']):
			if (!file_exists('./assets/img/uploaded_documents/' . $is_no)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $vi)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $vi);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $vi . '/' . $vi_file)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $vi . '/' . $vi_file);
			endif;

			$targetPaths 	= getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $vi . '/' . $vi_file;
			$img 			= $this->upload_images($targetPaths, "vi_file");

			// Save
			$data = array(
				'valid_id' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close
		endif;
	}
	public function update_subdivision_plan($is_no){//UPDATE SUBDIVISION PLAN
		$sp_file 	= $this->input->post('sp_file');
		$sp 		= "Subdivision Plan";

		if ($_FILES and $_FILES["sp_file"]['name']):
			if (!file_exists('./assets/img/uploaded_documents/' . $is_no)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $sp)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $sp);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $sp . '/' . $sp_file)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $sp . '/' . $sp_file);
			endif;

			$targetPaths 	= getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $sp . '/' . $sp_file;
			$img 			= $this->upload_images($targetPaths, "sp_file");

			// Save
			$data = array(
				'subdivision_plan' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close      
		endif;
	}
	public function update_spa($is_no){//UPDATE SPA
		$spa_file 	= $this->input->post('spa_file');
		$spa 		= "SPA";

		if ($_FILES and $_FILES["spa_file"]['name']):
			if (!file_exists('./assets/img/uploaded_documents/' . $is_no)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $spa)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $spa);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $spa . '/' . $spa_file)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $spa . '/' . $spa_file);
			endif;

			$targetPaths 	= getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $spa . '/' . $spa_file;
			$img 			= $this->upload_images($targetPaths, "spa_file");

			// Save
			$data = array(
				'spa' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close                
		endif;
	}
	public function update_denr($is_no){//UPDATE DENR/DAR
		$denr_file 	= $this->input->post('denr_file');
		$denr 		= "DENR or DAR";

		if ($_FILES and $_FILES["denr_file"]['name']):
			if (!file_exists('./assets/img/uploaded_documents/' . $is_no)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no);
			endif;
			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $denr)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $denr);
			endif;

			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $denr . '/' . $denr_file)):
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $denr . '/' . $denr_file);
			endif;

			$targetPaths 	= getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $denr . '/' . $denr_file;
			$img 			= $this->upload_images($targetPaths, "denr_file");

			// Save
			$data = array(
				'denr_dar' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close               
		endif;
	}
	public function insert_other($is_no){//INSERT OTHER
		$other_file 	= $_FILES["other_file"]["name"];
		$new_filename 	= $this->input->post('other_document');
		$other 			= "OTHER";

		if ($_FILES and $other_file) {
				// Get the file extension
				$file_extension = pathinfo($_FILES["other_file"]["name"], PATHINFO_EXTENSION);

				// Rename the file to the new filename with the original extension
				$renamed_file = $new_filename . '.' . $file_extension;

				// Define the path to the 'OTHER' folder
				$other_folder_path = './assets/img/uploaded_documents/' . $is_no . '/' . $other;

				// Check if the 'OTHER' folder exists, if not, create it
				if (!is_dir($other_folder_path)) {
						mkdir($other_folder_path, 0777, true);
				}

				// Move the uploaded file to the renamed location
				$renamed_file_path = $other_folder_path . '/' . $renamed_file;
				if (!move_uploaded_file($_FILES["other_file"]["tmp_name"], $renamed_file_path)) {
						// Handle the case where file moving fails
						// You can log an error or take appropriate action
						error_log("Failed to move uploaded file");
				}

				// Get the existing 'other' column data
				$existing_other = $this->db->get_where('uploaded_documents', array('is_no' => $is_no))->row()->other;

				// Concatenate the new file information with the existing 'other' data
				$new_other = $existing_other ? $existing_other . ',' : ''; // Add a comma if there's existing data
				$new_other .= $renamed_file;

				// Update 'other' column with the updated value
				$data = array(
						'other' => $new_other,
				);
				$this->db->where('is_no', $is_no);
				$this->db->update('uploaded_documents', $data);
		}
	}
	public function insert_title_number($id){
		$data = array(
			'land_title_no' => $this->input->post('title_no'),
		);
		$this->db->where('is_no',$id);
		$this->db->update('land_info',$data); 
	}
	public function insert_tax_number($id){
		$data = array(
			'tax_dec_no' => $this->input->post('tax_no'),
		);
		$this->db->where('is_no',$id);
		$this->db->update('land_info',$data); 
	}
	public function update_ud_other($is_no, $updatedOther){
		$this->db->where('is_no', $is_no);
		$this->db->update('uploaded_documents', ['other' => $updatedOther]);
	}
	public function add_document_status($id, $name){
		$data = array(
			'status' 			=> "Pending", 
			'prepared_by' 		=> $name,
			'submission_date' 	=> date("Y-m-d")
		);
		$this->db->where('is_no', $id);
		$this->db->update('document_status', $data);
	}
	public function add_forms($fno, $ftype, $uid){
		$data= array(
			'form_no' 	=> $fno,
			'form_type' => $ftype,
			'user_id' 	=> $uid,
		);
		$this->db->insert('forms',$data);
	}
	public function getds_reason($status ){
	    $this->db->select('li.*, ds.*');
	    $this->db->from('land_info li');
	    $this->db->join('document_status ds', 'li.is_no = ds.is_no');
	    $this->db->where_in('ds.status', $status);
	    $this->db->where('li.tag', 'New');
	    $query 	= $this->db->get();
    	$result = $query->result_array();
    	return $result;
	}
	public function update_restriction($id){
		$data = array(
			'liens' 		=> $this->input->post('liens', TRUE),
			'easement' 		=> $this->input->post('easement', TRUE),
			'encumbrances' 	=> $this->input->post('encumbrances', TRUE),
		);
		$this->db->where('is_no',$id);
		$this->db->update('restrictions_to_land_title',$data);
	}
	public function update_land_info($id, $lot_area, $price_per, $total_p){
		$data = array(
			'lot' 			=> $this->input->post('lot_no', TRUE),
			'cad' 			=> $this->input->post('cad_no', TRUE),
			'lot_type' 		=> $this->input->post('lot_type', TRUE),
			'lot_sold' 		=> $this->input->post('lot_sold', TRUE),
			'purchase_type' => $this->input->post('purchase_type', TRUE) ,
			'lot_size' 		=> $lot_area,
			'price_per_sqm' => $price_per,
			'total_price' 	=> $total_p,
		);
		$this->db->where('is_no',$id);
		$this->db->update('land_info',$data);                               
	}
	public function update_lot_location($id){
		$data = array(
			'street' 		=> ucwords($this->input->post('street', TRUE)),
			'baranggay' 	=> ucwords($this->input->post('baranggay', TRUE)),
			'municipality' 	=> ucwords($this->input->post('town', TRUE)),
			'zip_code' 		=> $this->input->post('zip_code', TRUE),
			'province' 		=> ucwords($this->input->post('province', TRUE)),
			'country' 		=> ucwords($this->input->post('country', TRUE)),
		);
		$this->db->where('is_no',$id);
		$this->db->update('lot_location',$data);     
	}
	public function update_owner_address($id){
		$data = array(
			'street' 		=> ucwords($this->input->post('street', TRUE)),
			'baranggay' 	=> ucwords($this->input->post('baranggay', TRUE)),
			'municipality' 	=> ucwords($this->input->post('town', TRUE)),
			'province' 		=> ucwords($this->input->post('province', TRUE)),
			'zip_code' 		=> ucwords($this->input->post('zip_code', TRUE)),
			'country' 		=> ucwords($this->input->post('country', TRUE)),
		);
		$this->db->where('owner_id',$id);
		$this->db->update('owner_address',$data);    
	}
	public function update_contact_info($id){
		if($this->input->post('fullname') != null){
			$data = array(
				'name' 		=> ucwords($this->input->post('fullname', TRUE)),
				'address' 	=> ucwords($this->input->post('address', TRUE)),
				'tel_no' 	=> $this->input->post('tel_no', TRUE),
				'phone_no' 	=> $this->input->post('phone_no', TRUE),
				'is_no' 	=> $this->input->post('is_no'),
				'email_ad' 	=> $this->input->post('email', TRUE),
			);
			$this->db->where('owner_id',$id);
			$this->db->update('contact_person',$data);
		}
	}
	public function delete_data_broker_info($id){
		$this->db->delete('broker_info', array('owner_id' => $id));
	}
	public function update_broker_info($id){
		$data = array(
			'firstname' 	=> ucwords($this->input->post('broker_first', TRUE)),
			'middlename' 	=> ucwords($this->input->post('broker_middle', TRUE)),
			'lastname' 		=> ucwords($this->input->post('broker_last', TRUE)),
		);
		$this->db->where('owner_id',$id);
		$this->db->update('broker_info',$data);
	}
	public function insert_broker_info($id,$is_no){
		if($this->input->post('broker_first') != null){
			$data = array(
				'firstname' 	=> ucwords($this->input->post('broker_first', TRUE)),
				'middlename' 	=> ucwords($this->input->post('broker_middle', TRUE)),
				'lastname' 		=> ucwords($this->input->post('broker_last', TRUE)),
				'owner_id' 		=> $id,
				'is_no' 		=> $is_no,
			);
			$this->db->insert('broker_info',$data);
		}
	}
	public function update_docu_status_reviewed($id, $name){
		$data = array(
		  	'status' 		=> "Reviewed",
		  	'reviewed_date' => date("Y-m-d"),
		  	'reviewed_by' 	=> $name,
		);
		$this->db->where('is_no', $id);
		$this->db->update('document_status', $data);
	}
	public function update_docu_status_returned($id,$name,$message){
		$data = array(
			'status' 		=> "Returned",
			'return_reason' => $message,
			'returned_date' => date("Y-m-d"),
			'returned_by' 	=> $name,
		);
		$this->db->where('is_no', $id);
		$this->db->update('document_status', $data);
	}
	public function resubmit($id,$name){
		$data = array(
			'status' 			=> "Pending",
			'resubmitted_date' 	=> date("Y-m-d"),
			'resubmitted_by' 	=> $name
		);
		$this->db->where('is_no', $id);
		$this->db->update('document_status', $data);
	}
	public function update_docu_status_disapproved($id,$name,$message){
		$data = array(
			'status' 				=> "Disapproved",
			'disapproval_reason' 	=> $message,
			'disapproval_date' 		=> date("Y-m-d"),
			'disapproved_by' 		=> $name,
		);
		$this->db->where('is_no', $id);
		$this->db->update('document_status', $data);
	}
	public function update_docu_status_approved($id, $name){
		$data = array(
		  	'status' 		=> "Approved",
		  	'approval_date' => date("Y-m-d"),
		  	'approved_by' 	=> $name,
		);
		$this->db->where('is_no', $id);
		$this->db->update('document_status', $data);
	}
	//==================================================
	#QUERY
	//==================================================
	public function get_tesdaregion(){
		$result = $this->db->select("regDesc, regCode")
		->get("refregion");
		return $result->result();
	}
	public function get_tesdaprovince($regCode){
		$result = $this->db->where(array('regCode' => $regCode))
		->select("provDesc, provCode")
		->get("refprovince");
		return $result->result();
	}
	public function get_tesdacitymun($provCode){
		$result = $this->db->where(array('provCode' => $provCode))
		->select("citymunDesc, citymunCode, zipcode")
		->get("refcitymun");
		return $result->result();
	}
	public function get_tesdabrgy($citymunCode){
		$result = $this->db->where(array('citymunCode' => $citymunCode))
			->select("brgyDesc, brgyCode")
			->get("refbrgy");
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
		->select("citymunDesc, citymunCode")
		->get("refcitymun");
		return $result->result();
	}
	public function get_brgy($citymunCode){
		$result = $this->db->where(array('citymunCode' => $citymunCode))
		->select("brgyDesc, brgyCode")
		->get("refbrgy");
		return $result->result();
	}
	public function getland_old(){
        $query = $this->db->query("SELECT * FROM land_info WHERE tag='Old' ");
        return $query->result_array();
    }
	public function getland_new(){
		$query = $this->db->query("SELECT * FROM land_info WHERE tag='New' ");
		return $query->result_array();
	}
	public function geli_rows(){
		$query = $this->db->query("SELECT * FROM land_info ");
		return $query->num_rows();
	}
	public function getli_byid($id){
		$query = $this->db->get_where('land_info', array('is_no' => $id));
		return $query->row_array();
	}
	public function getoi_byid($id){
		$query = $this->db->get_where('owner_info', array('is_no' => $id));
		return $query->row_array();
	}
	public function getll_byid($id){
		$query = $this->db->get_where('lot_location', array('is_no' => $id));
		return $query->row_array();
	}
	public function getcp_byid($id){
		$query = $this->db->get_where('contact_person', array('owner_id' => $id));
		return $query->row_array();
	}
	public function getrstr_byid($id){
		$query = $this->db->get_where('restrictions_to_land_title', array('is_no' => $id));
		return $query->row_array();
	}
	public function getbi_byid($id){
		$query = $this->db->get_where('broker_info', array('is_no' => $id));
		return $query->row_array();
	}
	public function getoa_byid($id){
		$query = $this->db->get_where('owner_address', array('owner_id' => $id));
		return $query->row_array();
	}
	public function getud_byid($id){
		$query = $this->db->get_where('uploaded_documents', array('is_no' => $id));
		return $query->row_array();
	}
	public function getds_byid($id){
		$query = $this->db->get_where('document_status', array('is_no' => $id));
		return $query->row_array();
	}
	public function getforms_byid($id){
		$query = $this->db->get_where('forms', array('form_no' => $id));
		return $query->row_array();
	}
	public function getud_other_byid($is_no){
		$this->db->select('other');
		$this->db->where('is_no', $is_no);
		$query 	= $this->db->get('uploaded_documents');
		$row 	= $query->row();
		return $row ? $row->other : '';
	}
	public function getrestriction_rows($id){
		$sql = "SELECT * FROM restrictions_to_land_title WHERE is_no = ? ";
		$query = $this->db->query($sql, array($id));
		return $query->num_rows();
	}
	public function get_broker_info($owner_id) {
		$this->db->where('owner_id', $owner_id);
		$query = $this->db->get('broker_info');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return null;
		}
	}
	public function getremaining_balance($id){
		$sql = "SELECT * FROM payment_transaction WHERE is_no = ? ORDER BY transaction_date DESC LIMIT 1";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
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