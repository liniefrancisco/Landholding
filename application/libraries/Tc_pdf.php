<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

class Tc_pdf extends TCPDF {

    public function __construct() {
        parent::__construct();
    }

    // Add any custom methods you need for generating PDFs
}
