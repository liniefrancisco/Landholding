<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class m_pdf {
    
    function __construct()
    {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }
 
    // function load($param=NULL)
    // {
    //     include_once APPPATH.'/third_party/mpdf/mpdf.php';
         
    //     if ($params == NULL)
    //     {
    //         $param = '"en-GB-x","A4","","",10,10,10,10,6,3';              
    //     }
         
    //     //return new mPDF($param);
    //     return new mPDF();
    // }
    function load($param = NULL, $pageSize = 'A4') {
        include_once APPPATH . '/third_party/mpdf/mpdf.php'; // Include the mPDF library file
    
        if ($param == NULL) {
            $param = '"en-GB-x","A4","","",10,10,10,10,6,3'; // Default parameters for the Mpdf constructor
        }
    
        // Convert page size string to array
        $pageSizeArray = $this->convertPageSize($pageSize);
    
        $mpdf = new mPDF($param, $pageSizeArray); // Create a new Mpdf object with the specified parameters and page size
    
        return $mpdf;
    }
    
    function convertPageSize($pageSize) {
        switch ($pageSize) {
            case 'A4':
                return array(210, 297); // A4 portrait orientation
            case 'A5':
                return array(148, 210); // A5 portrait orientation
            case 'Letter':
                return array(215.9, 279.4); // Letter portrait orientation
            case 'Legal':
                return array(215.9, 355.6); // Legal portrait orientation
            default:
                // Custom page size
                $pageSizeArray = explode(',', $pageSize);
                return array($pageSizeArray[0], $pageSizeArray[1]);
        }
    }
    
}



// <?php
//         class m_pdf {
            
//             function m_pdf() {
//                 $CI = & get_instance();
//                 log_message('Debug', 'mPDF class is loaded.');
//             }
//             function load($param = NULL) {
//                 require_once APPPATH .'third_party/mpdf/mpdf.php';
//                 if ($param == NULL) {
//                     $param = '"en-GB-x","A4","","",10,10,10,10,6,3';
//                 }
//                 return new mPDF();
//             }
//             function getPageCount() {
//                 return count($this->pages);
//             }
//         }


