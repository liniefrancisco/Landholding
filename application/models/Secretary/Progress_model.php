<?php
class Progress_model extends CI_Model{
	//==================================================
	//CRUD QUERY
	//==================================================
	public function insert_ca($amount,$ref_no, $name){
		$p 		= $this->input->post('purpose');
		$pp 	= "";
		foreach($p as $cc){
			$pp .= $cc . ", ";
		} 
		$data = array(
			'is_no' 			=>$this->input->post('is_no'),
			'type' 				=> 'Cash Advance',
			'ca_control_no' 	=> $ref_no,
			'amount' 			=> $amount,
			'purpose' 			=> $pp,
			'other_purpose' 	=> $this->input->post('other_purp'),
			'date_requested' 	=> date('Y-m-d'),
			'prepared_by' 		=> $name,
			'status' 			=> "Pending",
			);
		$this->db->insert('payment_requests', $data);
	}
	public function insert_form($fno, $ftype, $uid){
		$data = array(
			'form_no' 	=> $fno,
			'form_type' => $ftype,
			'user_id' 	=> $uid,
		);
		$this->db->insert('forms',$data);
	}
	public function insert_acknowledgement_receipt($is_no,$control_no,$amount){
		$content = $this->input->post('receipt_file');

		if (!empty($content)) {
			// Construct the path where the file will be saved
			$targetDir = './assets/img/acknowledgement_receipt/' . $is_no . '/';
			if (!file_exists($targetDir)) {
				@mkdir($targetDir, 0777, true);
			}

			// Save the content to the "acknowledgement_receipt.txt" file
			$targetPath = $targetDir . 'acknowledgement_receipt.txt';
			file_put_contents($targetPath, $content);

			// Save just the filename in the database
			$data = array(
				'is_no' 					=> $is_no,
				'fp_control_no' 			=> $control_no,
				'type' 						=> 'Full Payment',
				'amount' 					=> $amount,
				'acknowledgement_receipt' 	=> 'acknowledgement_receipt.txt', // Save the filename only
				'ar_date_requested' 		=> date('Y-m-d'),
				'date_requested' 			=> date('Y-m-d'),
				'prepared_by' 				=> $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname'),
				'status' 					=> 'Pending',
			);
			$this->db->insert('payment_requests', $data);
		}
	} 
	public function update_acknowledgement_receipt($is_no) {
		$content = $this->input->post('receipt_file');
		
		if (!empty($content)) {
			// Construct the path where the file will be saved
			$targetDir = './assets/img/acknowledgement_receipt/' . $is_no . '/';
			if (!file_exists($targetDir)) {
				@mkdir($targetDir, 0777, true);
			}

			// Save the content to the "acknowledgement_receipt.txt" file
			$targetPath = $targetDir . 'acknowledgement_receipt.txt';
			file_put_contents($targetPath, $content);

			// Update the database record
			$data = array(
				'acknowledgement_receipt' 	=> 'acknowledgement_receipt.txt',
				'ar_date_requested' 		=> date('Y-m-d'),
			);

			$this->db->where('is_no', $is_no);
			$this->db->where('type','Full Payment');
			$this->db->update('payment_requests', $data);
		}
	}
	public function insert_computation_of_payment($is_no,$control_no,$amount){
		$data = array(
				'is_no' 					=> $is_no,
				'fp_control_no' 			=> $control_no,
				'type' 						=> 'Full Payment',
				'amount' 					=> $amount,
				'computation_of_payment' 	=> 'Sent',
				'note' 						=> $this->input->post('note'),
				'cop_date_requested' 		=> date('Y-m-d'),
				'prepared_by' 				=> $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname'),
				'date_requested' 			=> date('Y-m-d'),
				'status' 					=> 'Pending',
		);
		$this->db->insert('payment_requests', $data);
	}
	public function update_computation_of_payment($is_no){
		$data= array(
			'computation_of_payment' 	=> 'Sent',
			'note' 						=> $this->input->post('note'),
			'cop_date_requested' 		=> date('Y-m-d'),
		);
		$this->db->where('is_no', $is_no);
		$this->db->where('type','Full Payment');
		$this->db->update('payment_requests', $data);
	}
	public function insert_notarial_fee($is_no,$control_no,$notarial_fee,$amount){
		$data = array(
			'is_no' 			=> $is_no,
			'fp_control_no' 	=> $control_no,
			'type' 				=> 'Full Payment',
			'amount' 			=> $amount,
			'notarial_fee' 		=> $notarial_fee,
			'nf_date_requested' => date('Y-m-d'),
			'date_requested' 	=> date('Y-m-d'),
			'prepared_by' 		=> $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname'),
			'status' 			=> 'Pending',
		);
		$this->db->insert('payment_requests',$data);
	}
	public function update_notarial_fee($is_no,$notarial_fee){
		$data = array(
			'notarial_fee' 		=> $notarial_fee,
			'nf_date_requested' => date('Y-m-d'),
		);
		$this->db->where('is_no', $is_no);
		$this->db->where('type','Full Payment');
		$this->db->update('payment_requests', $data);
	}
	public function insert_agent_commission($is_no,$control_no,$commission_fee,$amount){
		$data = array(
			'is_no' 			=> $is_no,
			'fp_control_no' 	=> $control_no,
			'type' 				=> 'Full Payment',
			'amount' 			=> $amount,
			'agent_commission' 	=> 'Sent',
			'commission_fee' 	=> $commission_fee,
			'ac_date_requested' => date('Y-m-d'),
			'date_requested' 	=> date('Y-m-d'),
			'prepared_by' 		=> $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname'),
			'status' 			=> 'Pending',
		);
		$this->db->insert('payment_requests',$data);
	}
	public function update_agent_commission($is_no,$commission_fee){
		$data = array(
			'agent_commission' 	=> 'Sent',
			'commission_fee' 	=> $commission_fee,
			'ac_date_requested' => date('Y-m-d'),
		);
		$this->db->where('is_no', $is_no);
		$this->db->where('type','Full Payment');
		$this->db->update('payment_requests', $data);
	}
	public function insert_lot_purchase_form($is_no,$control_no,$amount,$purpose){
		$data= array(
			'is_no' 				=> $is_no,
			'fp_control_no' 		=> $control_no,
			'type' 					=> 'Full Payment',
			'amount' 				=> $amount,
			'lot_purchase_form' 	=> 'Sent',
			'purpose_use' 			=> $purpose,
			'lpf_date_requested' 	=> date('Y-m-d'),
			'date_requested' 		=> date('Y-m-d'),
			'status' 				=> 'Pending',
			'prepared_by' 			=> $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname'),
		);
		$this->db->insert('payment_requests',$data);
	}
	public function update_lot_purchase_form($is_no,$purpose){
		$data= array(
			'lot_purchase_form' 	=> 'Sent',
			'purpose_use' 			=> $purpose,
			'lpf_date_requested' 	=> date('Y-m-d'),
		);
		$this->db->where('is_no', $is_no);
		$this->db->where('type','Full Payment');
		$this->db->update('payment_requests', $data);
	}
	public function update_lt($is_no){
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

			$targetPaths = getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $lt . '/' . $lt_file;
			$img = $this->upload_images($targetPaths, "lt_file");

			// Save
			$data = array(
				'land_title' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close             
		endif;
	}
	public function update_tct($is_no){
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

			$targetPaths = getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $tct . '/' . $img;
			$img = $this->upload_images($targetPaths, "tct_file");

			// Save
			$data = array(
				'tct' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close    
		endif;
	}
	public function update_dos($is_no){
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

			$targetPaths = getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $dos . '/' . $dos_file;
			$img = $this->upload_images($targetPaths, "dos_file");

			// Save
			$data = array(
				'previous_deed_of_sale' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close               
		endif;
	}
	public function update_ecar($is_no){
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

			$targetPaths = getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $ecar . '/' . $ecar_file;
			$img = $this->upload_images($targetPaths, "ecar_file");

			// Save
			$data = array(
				'e_car' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close     
		endif;
	}
	public function update_tax_declaration($is_no){
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

			$targetPaths = getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $tax . '/' . $td_file;
			$img = $this->upload_images($targetPaths, "td_file");

			// Save
			$data = array(
				'latest_tax_dec' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close              
		endif;
	}
	public function update_tax_clearance($is_no){
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

			$targetPaths = getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $tc . '/' . $tc_file;
			$img = $this->upload_images($targetPaths, "tc_file");

			// Save
			$data = array(
				'tax_clearance' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close               
		endif;
	}
	public function update_land_sketch($is_no){
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

			$targetPaths = getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $sketch . '/' . $img;
			$img = $this->upload_images($targetPaths, "land_sketch_file");

			// Save
			$data = array(
				'land_sketch' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close    
		endif;
	}
	public function update_vicinity_map($is_no){
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

			$targetPaths = getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $vm . '/' . $vm_file;
			$img = $this->upload_images($targetPaths, "vm_file");

			// Save
			$data = array(
				'vicinity_map' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close             
		endif;
	}
	public function update_certificate($is_no){
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

			$targetPaths = getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $cni . '/' . $cni_file;
			$img = $this->upload_images($targetPaths, "cni_file");

			// Save
			$data = array(
				'cert_no_improvement' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close            
		endif;
	}
	public function update_real_estate_tax($is_no){
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

			$targetPaths = getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $ret . '/' . $ret_file;
			$img = $this->upload_images($targetPaths, "ret_file");

			// Save
			$data = array(
				'real_estate_tax' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close     
		endif;
	}
	public function update_marriage_contract($is_no){
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

			$targetPaths = getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $mc . '/' . $mc_file;
			$img = $this->upload_images($targetPaths, "mc_file");

			// Save
			$data = array(
				'marriage_contract' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close  
		endif;
	}
	public function update_birth_certificate($is_no){
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

			$targetPaths = getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $bc . '/' . $bc_file;
			$img = $this->upload_images($targetPaths, "bc_file");

			// Save
			$data = array(
				'birth_certificate' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close               
		endif;
	}
	public function update_valid_id($is_no){
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

			$targetPaths = getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $vi . '/' . $vi_file;
			$img = $this->upload_images($targetPaths, "vi_file");

			// Save
			$data = array(
				'valid_id' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close
		endif;
	}
	public function update_subdivision_plan($is_no){
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

			$targetPaths = getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $sp . '/' . $sp_file;
			$img = $this->upload_images($targetPaths, "sp_file");

			// Save
			$data = array(
				'subdivision_plan' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close      
		endif;
	}
	public function update_spa($is_no){
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

			$targetPaths = getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $spa . '/' . $spa_file;
			$img = $this->upload_images($targetPaths, "spa_file");

			// Save
			$data = array(
				'spa' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close                
		endif;
	}
	public function update_denr($is_no){
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

			$targetPaths = getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $denr . '/' . $denr_file;
			$img = $this->upload_images($targetPaths, "denr_file");

			// Save
			$data = array(
				'denr_dar' => $img,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
			// Close               
		endif;
	}
	public function insert_other($is_no){
		$other_file = $this->input->post('other_file');
		$other 		= "OTHER";

		if ($_FILES and $_FILES["other_file"]["name"]) {
			if (!file_exists('./assets/img/uploaded_documents/' . $is_no)) {
				@mkdir('./assets/img/uploaded_documents/' . $is_no);
			}
			if (!file_exists('./assets/img/uploaded_documents/' . $is_no . '/' . $other)) {
				@mkdir('./assets/img/uploaded_documents/' . $is_no . '/' . $other);
			}

			$targetPaths = getcwd() . '/assets/img/uploaded_documents/' . $is_no . '/' . $other . '/' . $other_file;
			$img = $this->upload_images($targetPaths, "other_file");

			// Fetch existing 'other' data
			$this->db->select('other');
			$this->db->where('is_no', $is_no);
			$query = $this->db->get('uploaded_documents');
			$row = $query->row();
			$existingOther = $row->other;

			// Append the new file name with a comma
			if (!empty($existingOther)) {
				$existingOther .= ',' . $img;
			} else {
				$existingOther = $img;
			}

			// Update 'other' column with the updated value
			$data = array(
				'other' => $existingOther,
			);
			$this->db->where('is_no', $is_no);
			$this->db->update('uploaded_documents', $data);
		}
	}
	public function update_ud_other($is_no, $updatedOther){
		$this->db->where('is_no', $is_no);
		$this->db->update('uploaded_documents', ['other' => $updatedOther]);
	}
	//==================================================
	//QUERY
	//==================================================
	public function getli_byid($id){
		$query = $this->db->get_where('land_info', array('is_no'=> $id));
		return $query->row_array();
	}
	public function getds_byid($id){
		$query = $this->db->get_where('document_status', array('is_no'=> $id));
		return $query->row_array();
	}
	public function getoi_byid($id){
		$query = $this->db->get_where('owner_info', array('is_no'=> $id));
		return $query->row_array();
	}
	public function getll_byid($id){
		$query = $this->db->get_where('lot_location', array('is_no'=> $id));
		return $query->row_array();
	}
	public function getud_byid($id){
		$query = $this->db->get_where('uploaded_documents', array('is_no'=> $id));
		return $query->row_array();
	}
	public function getcp_byid($id){
		$query = $this->db->get_where('contact_person', array('owner_id'=> $id));
		return $query->row_array();
	}
	public function getbi_byid($id){
		$query = $this->db->get_where('broker_info', array('is_no'=> $id));
		return $query->row_array();
	}
	public function getrstr_byid($id){
		$query = $this->db->get_where('restrictions_to_land_title', array('is_no' => $id));
		return $query->row_array();
	}
	public function getca_id() {
		$query = $this->db->query("SELECT * FROM payment_requests WHERE type = 'Cash Advance' ORDER BY id DESC LIMIT 1;");
		return $query->row_array();
	}
	public function getfp_id() {
		$query = $this->db->query("SELECT * FROM payment_requests WHERE type = 'Full Payment' ORDER BY id DESC LIMIT 1;");
		return $query->row_array();
	}
	public function check_pr_status($id){
		$sql= "SELECT * from payment_requests where is_no = ? and type = 'Cash Advance'";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
	public function getfp_info($id){
		$sql= "SELECT * from payment_requests where is_no = ? and type = 'Full Payment'";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
	public function getpr_fp($id){
		$sql= "SELECT * from payment_requests where is_no = ? and type = 'Full Payment'";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}
	public function getpt_info($id){
		$sql = "SELECT * FROM payment_transaction WHERE is_no = ? ORDER BY transaction_date DESC LIMIT 1";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}
	public function getcashadvance_info($id){
		$sql= "SELECT * from payment_requests where is_no = ? and type = 'Cash Advance'";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
	public function getfullpayment_info1($id){
		$sql= "SELECT * from payment_requests where is_no = ? and type = 'Full Payment'";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}
	public function getfullpayment_info($id){
		$query = $this->db->select('*')
						  ->from('payment_requests')
						  ->where('is_no', $id)
						  ->where('type','Full Payment')
						  ->get();
		return $query->row_array();
	} 
	public function getpr_byid($id){
		$query = $this->db->get_where('payment_requests', array('is_no'=> $id));
		return $query->row_array();
	}
	public function getpt_details($id){
		$sql = "SELECT * from payment_transaction where is_no = ? ORDER BY transaction_date ASC ";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
	public function getpr_details($id){
		$sql= "SELECT * from payment_requests where is_no = ?";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
	public function getremaining_balance($id){
		$sql = "SELECT * FROM payment_transaction WHERE is_no = ? ORDER BY transaction_date DESC LIMIT 1";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}
	public function getpaid_ca($id){
		$query = $this->db->get_where('payment_transaction', array('is_no'=>$id));
		$ca = 0;
		foreach ($query->result_array() as $caa){
			$ca = $ca + $caa['amount'];
		}
		return $ca;
	}
	public function getpt_numrows($id){
		$sql 	= "SELECT * FROM payment_transaction WHERE is_no = ? ";
		$query 	= $this->db->query($sql, array($id));
		return $query->num_rows();
	}
	public function getca_transaction($id){
		$sql = "SELECT * from payment_transaction where ca_control_no = ? ORDER BY transaction_date DESC";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	}
	public function check_fullpayment($is_no){
		$this->db->where('is_no', $is_no);
		$this->db->where('type', 'Full Payment');
		$query = $this->db->get('payment_requests');
		return $query->row_array();
	}
	public function check_acknowledgement_receipts($is_no) {
		$this->db->where('is_no', $is_no);
		$this->db->where('type', 'Full Payment');
		$this->db->where('acknowledgement_receipt IS NOT NULL');
		$query = $this->db->get('payment_requests');
		return $query->row_array();
	}
	public function check_acknowledgement_receipt($is_no) {
    	$this->db->where('is_no', $is_no);
	    $this->db->where('type', 'Full Payment');
	    $query = $this->db->get('payment_requests');
	    $row = $query->row_array();
	    
	    if ($row) {
	        return $row['acknowledgement_receipt'];
	    } else {
	        return null; // Or you can return an empty string
	    }
	}
	public function check_agent_commission($is_no) {
		$this->db->where('is_no', $is_no);
		$this->db->where('type', 'Full Payment');
		$this->db->where('agent_commission IS NOT NULL');
		$query = $this->db->get('payment_requests');
		return $query->row_array();
	}
	public function getud_other_byid($is_no){
		$this->db->select('other');
		$this->db->where('is_no', $is_no);
		$query = $this->db->get('uploaded_documents');
		$row = $query->row();
		return $row ? $row->other : '';
	}
	public function getrcp_reqbyid($id){
  		$sql = "SELECT * from request_check_payment where  is_no = ? ";
  		$query = $this->db->query($sql, array($id));
  		return $query->row_array();		
	}
	public function get_acknowledgement_receipt_content($is_no) {
	    $targetPath = './assets/img/acknowledgement_receipt/' . $is_no . '/acknowledgement_receipt.txt';
	    
	    if (file_exists($targetPath)) {
	        return file_get_contents($targetPath);
	    } else {
	        return ''; // Return empty string if file does not exist
	    }
	}
	//==================================================
	//UPLOADING IMAGES
	//==================================================
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
	//==================================================
	//END UPLOADING IMAGES
	//==================================================
}