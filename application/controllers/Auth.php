<?php 


class Auth extends App_Controller{
		
	public function __construct(){
        parent::__construct();
        // Load the model
        $this->load->model('Account_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('encryption');
    }


    public function login(){

    	$this->logged_in();	
        $this->load->view('login/login_page');


         /*echo '
            <form action="http://localhost/landholding/Auth/login" method="POST">
                <input type="text" name="password" value="" >
                <input type="submit" value="submit" name="submit">
            </form>
        ';

        echo $this->encryption->decrypt(@$_POST['password']);*/

	}

    public function decrypt_password()
    {
         echo '
            <form action="http://localhost/landholding/Auth/decrypt_password" method="POST">
                <input type="text" name="password" value="" >
                <input type="submit" value="submit" name="submit">
            </form>
        ';

        echo $this->encryption->decrypt(@$_POST['password']);
    }


    public function validate_credentials(){

    		$this->logged_in();
        
            $this->form_validation->set_rules('username', 'username', 'required');
            $this->form_validation->set_rules('password', 'password', 'required');
            $data['notif'] = '';
            $data['error'] = '';
            if($this->form_validation->run() === TRUE){
                $user = $this->Account_model->validate();

                if(!empty($user)){

                    //  if($user['logged'] == "true"){ //not finished

                    //     $start_date = new DateTime(date('M-d-Y H:i:s'));
                    //     $since_start = $start_date->diff(new DateTime($user['time_active']));


                    //     if($since_start->i > 15 || $since_start->h > 0 || $since_start->d > 0 || $since_start->m > 0 || $since_start->y > 0 ){
                    //          $this->session->set_userdata($user);
                    //          $this->Account_model->update_userlog();
                    //          $data['notif'] = 'Access Granted!';
                    //      }else{
                    //          $data['error'] = 'You do not have permission!';
                    //      }

                    //  }else{
                            $this->session->set_userdata($user);
                            $this->Account_model->update_userlog();
                            $data['notif'] = 'Access Granted';
                    //  }       
                }else{
                    $data['error'] = 'Invalid username or password';                       
                }
            }else{
                $data['error'] = validation_errors();
            }

            echo json_encode($data);
    }






}