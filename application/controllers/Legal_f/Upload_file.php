<?php
	class Upload_file extends CI_Controller{

	    public function __construct(){
        parent::__construct();
        // Load the model
        $this->load->model('Account_model');
        $this->load->model('Land_model');
        $this->load->model('Upload_model');
        $this->load->model('Payment_model');
        $this->load->helper('form');
        $this->load->library('Pro');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
    	}

    // 	public function upload_instrument($is_no){
    // 		if($this->session->userdata('user_type')){

	   // 						$this->Upload_model->update_instrument($is_no);
	   // 						$this->session->set_flashdata('notif','File Uploaded Succesfully!');

   	// 			 	redirect('Land/for_titling/'.$is_no);			
				// }else{
    //            		 redirect();
    //         	}

    // 	}

    // 	public function upload_titling($is_no){
    // 		if($this->session->userdata('user_type')){


			 //   						$this->Upload_model->update_land_title($is_no);
			 //   						$this->Upload_model->update_tax_declaration($is_no);
			 //   						$this->Upload_model->update_land_sketch($is_no);
			 //   						$this->Upload_model->update_brgy_res($is_no);
			 //   						$this->session->set_flashdata('notif','File Uploaded Succesfully!');

    // 				redirect('Land/for_titling/'.$is_no);

				// }else{
    //            		 redirect();
    //         	}
    // 	}

    // 	public function upload_tct($is_no){
    // 		if($this->session->userdata('user_type')){


	   // 						$this->Upload_model->update_tct($is_no);
	   // 						$this->session->set_flashdata('notif','File Uploaded Succesfully!');
 			
	   // 				redirect('Land/for_titling/'.$is_no);
				
				// }else{
    //            		 redirect();
    //         	}

    // 	}




	}