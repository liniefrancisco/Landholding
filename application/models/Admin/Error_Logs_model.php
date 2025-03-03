<?php
class Error_Logs_model extends CI_Model{
	//==================================================
	//ERROR LOGS NOTIFICATION
	//==================================================
    public function get_error_logs_count() {
        // Define the path to the logs directory
        $logsDirectory = APPPATH . 'logs/';

        // Get a list of log files in the logs directory
        $logFiles = scandir($logsDirectory);

        // Initialize a counter for error logs
        $errorCount = 0;

        // Loop through each log file
        foreach ($logFiles as $file) {
            // Check if the file is a regular file and ends with ".php"
            if (is_file($logsDirectory . $file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                // Read the contents of the log file
                $logContents = file_get_contents($logsDirectory . $file);
                
                // Count occurrences of error messages in the log file
                $errorCount += substr_count($logContents, 'ERROR');
            }
        }

        return $errorCount;
    }
	//==================================================
	//END ERROR LOGS NOTIFICATION
	//==================================================
}