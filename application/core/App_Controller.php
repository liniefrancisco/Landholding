<?php
	
	class App_Controller extends CI_Controller{

		public function __construct(){
			parent:: __construct();
			// $this->load->model('Payment_model');
		}


		public function logged_in(){

			if($this->session->userdata('user_type')){
				redirect('welcome');
			}
			
		}

		public function not_logged_in(){
			
			if(!$this->session->userdata('user_type')){
				redirect('login');
			}

		}

		public function sess_secretary(){

			if($this->session->userdata('user_type') !== "Secretary"){
				redirect();
			}

		}

		public function sess_gm(){

			if($this->session->userdata('user_type') !== "GM"){
				redirect();
			}

		}

		public function sess_admin(){

			if($this->session->userdata('user_type') !== "Administrator"){
				redirect();
			}

		}

		public function sess_legal(){

			if($this->session->userdata('user_type') !== "Legal"){
				redirect();
			}
			
		}

		public function sess_leggm(){
			if($this->session->userdata('user_type') !== "Legal" && $this->session->userdata('user_type') !== "GM"){
				redirect();
			}
		}
		public function sess_ccleg(){
			// var_dump('user type',$this->session->userdata('user_type'));
			if($this->session->userdata('user_type') !== "Legal" && $this->session->userdata('user_type') !== "CCD"){
				redirect();
			}
		}

		public function sess_ccd(){

			if($this->session->userdata('user_type') !== "CCD"){
				redirect();
			}

		}

		public function sess_acctng(){

			if($this->session->userdata('user_type') !== "Accounting"){
				redirect();
			}

		}

		public function sess_cado(){

			if($this->session->userdata('user_type') !== "CADO"){
				redirect();
			}

		}


		public function render_template($page = null, $data = array()){
			
			$this->load->view('templates/header', $data);  
   			$this->load->view('templates/bar', $data);       
            $this->load->view($page,$data);
            $this->load->view('templates/footer');

		}


	}