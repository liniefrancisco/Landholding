<?php
class Rpt_model extends CI_Model{
	#QUERY ==================================================
	public function select_rpt_yearpaid_asc_result($is_no){
        $sql 	= "SELECT * from real_property_tax  where is_no = ? ORDER BY year_paid ASC ";
        $query 	= $this->db->query($sql, array($is_no));
        return $query->result_array();
    }
    public function select_rpt_num($is_no){
        $sql = "SELECT * FROM real_property_tax WHERE is_no = ? ";
        $query = $this->db->query($sql, array($is_no));
        return $query->num_rows();
    }
    public function select_assessments_row($is_no){
	    $sql = "SELECT * FROM assessments WHERE is_no = ? ";
	    $query = $this->db->query($sql, array($is_no));
	    return $query->row_array();
	}
	public function get_rpt_result($is_no){
        $query = $this->db->get_where('real_property_tax', ['is_no' => $is_no]);
        return $query->result_array();
    }
	#CRUD QUERY ==================================================
	public function add_assessment($is_no){
		$data = array(
                    'Effective_year'    => $this->input->post('effective_year'),
					'Assessment_Level'  => $this->input->post('ass_lvl'),
					'is_no' 	        => $is_no,
				);
		$this->db->insert('assessments', $data);
	}
	public function update_assessment_level($is_no){
        $data = array(
                    'Effective_year'   => $this->input->post('effective_year'),
            		'Assessment_Level' => $this->input->post('ass_lvl'),
        		);
        $this->db->where('is_no', $is_no);
        $this->db->update('assessments', $data);
    }
    public function add_rpt($is_no){
        $yr_pd  = $this->input->post('year_paid');
        $amount = $this->input->post('amount');
        $amnt   = str_replace( ',', '', $amount );

        if($_FILES AND $_FILES["file"]['name']):
            if(!file_exists('./assets/img/rpt_uploads/'.$is_no)):
                @mkdir('./assets/img/rpt_uploads/'.$is_no);
            endif;

            $targetPaths = getcwd().'/assets/img/rpt_uploads/'.$is_no.'/'.$img;
            $img = $this->upload_images($targetPaths,"file");

            $data = array(
                'is_no'      => $is_no,
                'rpt_file'   => $img,
                'amount'     => $amnt,
                'year_paid'  => $yr_pd,
                'status'     => "Paid",
            );
            $this->db->insert('real_property_tax', $data);      
        endif;
    }

    #UPLOAD IMAGES QUERY ==================================================
    public function upload_images($targetPaths, $image_name){
        $filename;
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