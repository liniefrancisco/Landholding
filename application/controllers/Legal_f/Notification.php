<?php 
	class Notification extends App_Controller{
		public function __construct(){
      parent::__construct();
      $this->not_logged_in();
      // Load the model
      $this->load->model('Secretary/Secretary_notification_model');
      $this->load->model('Land_model');
      $this->load->model('Payment_model');
			$this->load->model('Legal_model');
      $this->load->model('Notification_model');
      $this->load->model('Aspayment_model');
      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->load->library('session');
      $this->load->helper('url');
  	}

		public function index(){
			//Secretary
	    $data['secretary_execute'] = $this->Secretary_notification_model->getli_status_pending();
	    $data['secretary_inprogress'] = $this->Secretary_notification_model->getli_status_approved();
	    $data['secretary_owned'] = $this->Secretary_notification_model->getli_status_approved();
	    //End
					$data['li_approved'] = $this->Land_model->getli_status_approved();
			        $data['land_info'] = $this->Land_model->getregistry_land();

			        $data['li_disapproved'] = $this->Land_model->getli_status_disapproved();
			        $data['li_pending'] = $this->Land_model->getli_status_pending();

			        $data['disapproved_payments']= $this->Payment_model->getnum_payment_disapproved();
			        $data['pending_payment_requests']= $this->Payment_model->getnum_pending_payment_requests();
			        $data['approved_payment_requests']= $this->Payment_model->getnum_payment_approved();
			        $data['pending_rcp']= $this->Payment_model->getpending_rcp_numrows();
			        $data['ud_pending'] = $this->Land_model->getud_status_pending();
	           	    $data['ud_uploaded'] = $this->Land_model->getud_status_uploaded();
	           	    $data['ud_checked'] = $this->Land_model->getud_status_checked();
	           	    $data['ud_incomplete'] = $this->Land_model->getud_status_incomplete();
	           	    $data['ud_resubmit'] = $this->Land_model->getud_status_resubmit();

			        //  start CCD numrows
			        $data['pending_es']= $this->Aspayment_model->get_pending_es_aspayment();
			        $data['pending_js']= $this->Aspayment_model->get_pending_js_aspayment();
			        $data['disap_es']= $this->Aspayment_model->get_disapproved_es_aspayment();
			        $data['disap_js']= $this->Aspayment_model->get_disapproved_js_aspayment();
			        $data['app_es']= $this->Aspayment_model->get_approved_es_aspayment();
        			$data['app_js']= $this->Aspayment_model->get_approved_js_aspayment();
			        // end CCD numrows


				$data['user_n'] = $this->session->userdata('user_type');
				$recepient =  $this->session->userdata('user_id'); //get the user type 
               	$data['all_notifications']= $this->Notification_model->get_notif_per_user($recepient);
               	$data['all_notification_no']= $this->Notification_model->get_all_notification_no($recepient);
               	$data['read_notifications']= $this->Notification_model->getnumrows_read_notification($recepient);
               	     
	            $this->render_template('notification/notification_page',$data);
		}


		public function single_page($id){
				$data['li_approved'] = $this->Land_model->getli_status_approved();
		        $data['land_info'] = $this->Land_model->getregistry_land();

		        $data['li_disapproved'] = $this->Land_model->getli_status_disapproved();
		        $data['li_pending'] = $this->Land_model->getli_status_pending();

		        $data['disapproved_payments']= $this->Payment_model->getnum_payment_disapproved();
		        $data['pending_payment_requests']= $this->Payment_model->getnum_pending_payment_requests();
		        $data['approved_payment_requests']= $this->Payment_model->getnum_payment_approved();
		        $data['pending_rcp']= $this->Payment_model->getpending_rcp_numrows();

		        $data['no_of_notifications']= $this->Notification_model->getnumrows_unread_notification();
		        $data['all_notifications']= $this->Notification_model->get_all_notifications();
				$data['pending_js'] = $this->Aspayment_model->get_pending_js_aspayment();

            $this->render_template('notification/notification_single',$data);

		}

		public function read_notification($id){
			
				$this->Notification_model->read_notification($id);			

		}

		public function get_notification_number(){
				$recepient =  $this->session->userdata('user_id');
				$data['notif_tab'] = $this->Notification_model->getnumrows_unread_notification($recepient);
				$data['notif_header'] = $this->Notification_model->getnumrows_unread_notification($recepient);
				$data['count_pending_docs'] = $this->Legal_model->uploaded_documents_count();
				echo json_encode($data);
		}


		public function read_all_notif(){ 
			$user_n =  $this->session->userdata('user_id');
			$this->Notification_model->read_all_notification($user_n);
			$data['notif_tab'] = $this->Notification_model->getnumrows_unread_notification($user_n);
			echo json_encode($data);
		}

		public function clear_all_notif(){
			$user_n =  $this->session->userdata('user_id');
			$this->Notification_model->delete_all_notification($user_n);
		}

		public function fetch_notification(){
				$recepient =  $this->session->userdata('user_id');

				$data['no_of_notifications']= $this->Notification_model->getnumrows_unread_notification($recepient);
			    $data['read_notifications']= $this->Notification_model->getnumrows_read_notification($recepient);
			    $data['all_notifications']= $this->Notification_model->get_notif_per_user($recepient);
			    $data['all_notification_no']= $this->Notification_model->get_all_notification_no($recepient);
			    
				$this->load->view('notification/ajax_notification_page',$data);
		}

		public function fetch_notification_bar(){
				$data['all_notifications']= $this->Notification_model->get_all_notifications();
				$this->load->view('notification/notification_bar', $data);
		}


}