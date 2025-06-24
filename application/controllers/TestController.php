<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Datatable_model');
        
        // Trick to simulate URI segment (2nd segment)
        $this->router->method = 'Rptax_datatable';
    }

    public function test_rptax_query() {
        // Simulate POST values (optional)
        $_POST['region'] = 'Region VII';             // Substitute actual values
        $_POST['province'] = 'Misamis Oriental';
        $_POST['town'] = 'Cagayan de Oro City';
        $_POST['status'] = 'Pending';

        // Simulate DataTables POST request
        $postData = [
            'search' => ['value' => ''],
            'length' => 10,
            'start'  => 0,
            'order'  => [
                ['column' => 0, 'dir' => 'asc']
            ]
        ];

        // Run model method
        $result = $this->Datatable_model->get_row($postData);

        echo "<pre>";
        print_r($result);
        echo "</pre>";
    }
}
