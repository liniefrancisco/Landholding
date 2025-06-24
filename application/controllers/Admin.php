<?php
class Admin extends App_Controller{
	public function __construct(){
		parent::__construct();
		$this->not_logged_in();
		// Load the model
		$this->load->model('Admin_model');
		$this->load->model('Notification_bar_model');
        $this->load->model('Notification_bar_model');
        $this->load->model('Notification_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('encryption');
	}
	public function Notification(){
		$data = array();
	    $data['error_logs'] 	= $this->Notification_bar_model->get_unread_error_logs_count();
		return $data;
	}
	public function create_account(){
		$data 	= $this->Notification();
		$this->render_template('administrator/create_account',$data);
	}
	public function add_user(){
		if(isset($_POST['create_user'])){
			$un 	= $this->input->post('username');
			$user 	= $this->Admin_model->check_username($un);
			if(!empty($user)){
				$this->session->set_flashdata('error','Username already exists, it must be unique.'); 
				redirect('Admin/create_account');
			}else{
				$this->Admin_model->create_account();
				$this->session->set_flashdata('success','User Added Successfully!');
				redirect('Admin/ListAccount_tbl');
			}
		}
	}
	public function ListAccount_tbl(){
		$data 				= $this->Notification();
		$data['user_lists'] = $this->Admin_model->getuser_lists();
		$this->render_template('administrator/list_account_table',$data);
	}
	public function delete_user($id){
		$this->Admin_model->remove_user($id);
		$this->session->set_flashdata('success','User Deleted Successfully!');
		redirect('Admin/ListAccount_tbl');
	}
	public function ErrorLogs_tbl(){
        $data['title'] 			= "Error Logs";
        $data['error_logs'] 	= $this->Notification_bar_model->get_unread_error_logs_count();
		$this->render_template('administrator/error_logs_table', $data);
	}
	public function get_error_logs() {
        $log_path 	= APPPATH . 'logs/';// Path to the log files
        $log_files 	= glob($log_path . '*.php');// Get all log files in the directory
        $logs 		= [];

        foreach ($log_files as $file) {
            $content 	= file_get_contents($file);// Read the file content
            $content 	= str_replace('<?php defined(\'BASEPATH\') OR exit(\'No direct script access allowed\'); ?>', '', $content);// Remove the PHP tags
            $lines 		= explode("\n", $content);// Split content into lines
            
            foreach ($lines as $line) {
                if (trim($line)) {
                    preg_match('/^(.+?) - (.+?) --> (.+)$/', $line, $matches);// Basic parsing of the log line
                    if (count($matches) === 4) {
                        $logs[] = [
                            'timestamp' => $matches[1],
                            'type'      => $matches[2],
                            'message'   => $matches[3],
                            'file'      => basename($file) // Add file name for reference
                        ];
                    }
                }
            }
        }
        echo json_encode($logs);
    }
    public function delete_log_file(){
	    $log_path = APPPATH . 'logs/';
	    if (is_dir($log_path)) {
	        $files = glob($log_path . '*'); // Get all files in the logs directory
	        foreach ($files as $file) {
	            if (is_file($file)) {
	                unlink($file); // Delete file
	            }
	        }
	        echo json_encode(['status' => 'success', 'message' => 'All log files deleted successfully']);
	    } else {
	        echo json_encode(['status' => 'error', 'message' => 'Logs directory not found']);
	    }
	}
}