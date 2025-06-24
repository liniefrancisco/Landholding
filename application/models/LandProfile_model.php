<?php
class LandProfile_model extends CI_Model{
	//==================================================
	#CRUD QUERY
	//==================================================
	public function insert_land_title($is_no){
		$filename  = $this->input->post('file');
		$folder    = "Land Title";

		if($_FILES AND $_FILES["file"]['name']):
			if(!file_exists('./assets/img/titling_uploads/'.$is_no)):
				@mkdir('./assets/img/titling_uploads/'.$is_no);
			endif;

			if(!file_exists('./assets/img/titling_uploads/'.$is_no.'/'.$folder)):
				@mkdir('./assets/img/titling_uploads/'.$is_no.'/'.$folder);
			endif;

			if(!file_exists('./assets/img/titling_uploads/'.$is_no.'/'.$folder.'/'.$filename)):
				@mkdir('./assets/img/titling_uploads/'.$is_no.'/'.$folder.'/'.$filename);
			endif;

			$targetPaths = getcwd().'/assets/img/titling_uploads/'.$is_no.'/'.$folder.'/'.$filename;
			$img 				 = $this->upload_images($targetPaths,"file");

			$data = array('is_no' => $is_no, 'land_title' => $img);
			$this->db->insert('titling', $data);	 
		endif;
	}
	public function update_land_title($is_no){
		$filename  = $this->input->post('file');
		$folder    = "Land Title";

		if($_FILES AND $_FILES["file"]['name']):
			if(!file_exists('./assets/img/titling_uploads/'.$is_no)):
				@mkdir('./assets/img/titling_uploads/'.$is_no);
			endif;

			if(!file_exists('./assets/img/titling_uploads/'.$is_no.'/'.$folder)):
				@mkdir('./assets/img/titling_uploads/'.$is_no.'/'.$folder);
			endif;

			if(!file_exists('./assets/img/titling_uploads/'.$is_no.'/'.$folder.'/'.$filename)):
				@mkdir('./assets/img/titling_uploads/'.$is_no.'/'.$folder.'/'.$filename);
			endif;

			$targetPaths = getcwd().'/assets/img/titling_uploads/'.$is_no.'/'.$folder.'/'.$filename;
			$img 				 = $this->upload_images($targetPaths,"file");

			$data = array('land_title' => $img);
			$this->db->where('is_no', $is_no);
			$this->db->update('titling', $data);
		endif;
	}
	public function insert_tax_declaration($is_no){
		$filename  = $this->input->post('file');
		$folder    = "Tax Declaration";

		if($_FILES AND $_FILES["file"]['name']):
			if(!file_exists('./assets/img/titling_uploads/'.$is_no)):
				@mkdir('./assets/img/titling_uploads/'.$is_no);
			endif;

			if(!file_exists('./assets/img/titling_uploads/'.$is_no.'/'.$folder)):
				@mkdir('./assets/img/titling_uploads/'.$is_no.'/'.$folder);
			endif;

			if(!file_exists('./assets/img/titling_uploads/'.$is_no.'/'.$folder.'/'.$filename)):
				@mkdir('./assets/img/titling_uploads/'.$is_no.'/'.$folder.'/'.$filename);
			endif;

			$targetPaths = getcwd().'/assets/img/titling_uploads/'.$is_no.'/'.$folder.'/'.$filename;
			$img 				 = $this->upload_images($targetPaths,"file");

			$data = array('is_no' => $is_no, 'latest_tax_dec' => $img);
			$this->db->insert('titling', $data);	 
		endif;
	}
	public function update_tax_declaration($is_no){
		$filename  = $this->input->post('file');
		$folder    = "Tax Declaration";

		if($_FILES AND $_FILES["file"]['name']):
			if(!file_exists('./assets/img/titling_uploads/'.$is_no)):
				@mkdir('./assets/img/titling_uploads/'.$is_no);
			endif;

			if(!file_exists('./assets/img/titling_uploads/'.$is_no.'/'.$folder)):
				@mkdir('./assets/img/titling_uploads/'.$is_no.'/'.$folder);
			endif;

			if(!file_exists('./assets/img/titling_uploads/'.$is_no.'/'.$folder.'/'.$filename)):
				@mkdir('./assets/img/titling_uploads/'.$is_no.'/'.$folder.'/'.$filename);
			endif;

			$targetPaths = getcwd().'/assets/img/titling_uploads/'.$is_no.'/'.$folder.'/'.$filename;
			$img 				 = $this->upload_images($targetPaths,"file");

			$data = array('latest_tax_dec' => $img);
			$this->db->where('is_no', $is_no);
			$this->db->update('titling', $data); 
		endif;
	}
	public function insert_tct($is_no){
		$filename  = $this->input->post('file');
		$folder    = "TCT";

		if($_FILES AND $_FILES["file"]['name']):
			if(!file_exists('./assets/img/titling_uploads/'.$is_no)):
				@mkdir('./assets/img/titling_uploads/'.$is_no);
			endif;

			if(!file_exists('./assets/img/titling_uploads/'.$is_no.'/'.$folder)):
				@mkdir('./assets/img/titling_uploads/'.$is_no.'/'.$folder);
			endif;

			if(!file_exists('./assets/img/titling_uploads/'.$is_no.'/'.$folder.'/'.$filename)):
				@mkdir('./assets/img/titling_uploads/'.$is_no.'/'.$folder.'/'.$filename);
			endif;

			$targetPaths = getcwd().'/assets/img/titling_uploads/'.$is_no.'/'.$folder.'/'.$filename;
			$img 				 = $this->upload_images($targetPaths,"file");

			$data = array('is_no' => $is_no, 'tct' => $img);
			$this->db->insert('titling', $data);	 
		endif;
	}
	public function update_tct($is_no){
		$filename  = $this->input->post('file');
		$folder    = "TCT";

		if($_FILES AND $_FILES["file"]['name']):
			if(!file_exists('./assets/img/titling_uploads/'.$is_no)):
				@mkdir('./assets/img/titling_uploads/'.$is_no);
			endif;

			if(!file_exists('./assets/img/titling_uploads/'.$is_no.'/'.$folder)):
				@mkdir('./assets/img/titling_uploads/'.$is_no.'/'.$folder);
			endif;

			if(!file_exists('./assets/img/titling_uploads/'.$is_no.'/'.$folder.'/'.$filename)):
				@mkdir('./assets/img/titling_uploads/'.$is_no.'/'.$folder.'/'.$filename);
			endif;

			$targetPaths = getcwd().'/assets/img/titling_uploads/'.$is_no.'/'.$folder.'/'.$filename;
			$img 				 = $this->upload_images($targetPaths,"file");

			$data = array('tct' => $img);
			$this->db->where('is_no', $is_no);
			$this->db->update('titling', $data); 
		endif;
	}
	//==================================================
	#QUERY
	//==================================================
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
	public function gettitling($is_no){
		return $this->db->get_where('titling', ['is_no' => $is_no])->row_array();
	}
}