<?php
class Error_Logs extends App_Controller{
	public function __construct(){
		parent::__construct();
		$this->not_logged_in();
		// Load the model
        $this->load->model('Admin/Error_Logs_model');
        $this->load->model('Secretary/Secretary_notification_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('encryption');
	}
	//==================================================
	//ERROR LOGS
	//==================================================
	public function error_logs(){
        $data['title'] = "Error Logs";
        //Sidebar Notification
        $data['secretary_execute'] = $this->Secretary_notification_model->getli_status_pending();
        $data['secretary_inprogress'] = $this->Secretary_notification_model->getli_status_approved();
        $data['secretary_owned'] = $this->Secretary_notification_model->getli_status_approved();
        $data['admin_logs'] = $this->Error_Logs_model->get_error_logs_count();
        //End

        //Message Notification
        $recepient = $this->session->userdata('user_id');
        $data['all_notifications'] = $this->Secretary_notification_model->get_notif_per_user($recepient);
        $data['all_notification_no'] = $this->Secretary_notification_model->get_all_notification_no($recepient);
        //End

		$this->render_template('administrator/error_logs', $data);
	}
	public function get_error_logs() {
        // Path to the log files
        $log_path = APPPATH . 'logs/';
        
        // Get all log files in the directory
        $log_files = glob($log_path . '*.php');
        
        $logs = [];
        
        foreach ($log_files as $file) {
            // Read the file content
            $content = file_get_contents($file);
            
            // Remove the PHP tags
            $content = str_replace('<?php defined(\'BASEPATH\') OR exit(\'No direct script access allowed\'); ?>', '', $content);
            
            // Split content into lines
            $lines = explode("\n", $content);
            
            foreach ($lines as $line) {
                if (trim($line)) {
                    // Basic parsing of the log line
                    preg_match('/^(.+?) - (.+?) --> (.+)$/', $line, $matches);
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

    public function delete_log_file() {
        $filename = $this->input->post('filename');
        $log_path = APPPATH . 'logs/' . $filename;

        if (file_exists($log_path)) {
            unlink($log_path);
            echo json_encode(['status' => 'success', 'message' => 'Log file deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Log file not found']);
        }
    }
	//==================================================
	//END ERROR LOGS
	//==================================================
}