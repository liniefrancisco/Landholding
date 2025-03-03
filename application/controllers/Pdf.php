<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pdf extends App_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
        // Load the model
        $this->load->model('Pdf_model');
        $this->load->model('Progress_model');
        $this->load->model('Payment_model');
        $this->load->model('Land_model');
        $this->load->model('Account_model');
        $this->load->model('Rpt_model');
        $this->load->model('Tax_payment_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Legal_model');
        //$this->load->library('fpdf_gen');
        $this->load->library('m_pdf');
        $this->load->library('session');
        $this->load->helper('url');
    }

    //==================================================
    //SUMMARY OF PAYMENT (SECRETARY)
    //==================================================
//   public function summary_of_payment($is_no){
//     $data['is_no'] = $is_no;
//     $data['li']= $this->Land_model->getli_byid($is_no);
//     $data['oi']= $this->Land_model->getoi_byid($is_no);
//     $data['pt_details'] = $this->Progress_model->getpt_details($is_no);
//     $data['pr_details'] = $this->Progress_model->getpr_details($is_no);

    //     $html = $this->load->view('progress/summary_of_payment_pdf', $data, true); 

    //     $pdfFilePath ="summary of payment".".pdf"; 
//     $pdf = $this->m_pdf->load();
//     $stylesheet = '<style>'.file_get_contents('assets/import/vendors/bootstrap/dist/css/bootstrap.min.css').'</style>';
//     $css = '<style>'.file_get_contents('assets/import/build/css/custom.min.css').'</style>';
//     // apply external css
//     $pdf->WriteHTML($css);
//     $pdf->WriteHTML($stylesheet);
//     $pdf->WriteHTML($html);
//     $pdf->Output($html, "I");
//     exit;
//   }
    //==================================================
    //END
    //==================================================

    public function previousnisiya($is_no)
    {
        $pdf = new FPDF();
        $pdf->AddPage();

        //Table
        $pdf->SetFont("Times", "B", 17);
        $pdf->Ln(5);
        $pdf->Cell(0, 0, 'Landholding Management System', 0, 1, 'C');
        $pdf->Ln(10);
        $pdf->SetFont("Arial", "B", 13);
        $pdf->Cell(0, 0, 'Summary of Payment', 0, 1, 'C');
        $pdf->Ln(6);

        //Table Title Heading
        $pdf->SetFont("Arial", "B", 9);
        $pdf->Cell(15, 7, 'Lot No.', 1, 0, 'C');
        $pdf->Cell(35, 7, 'Payee', 1, 0, 'C');
        $pdf->Cell(35, 7, 'Total Amount Payable', 1, 0, 'C');
        $pdf->Cell(90, 7, 'Purposes', 1, 0, 'C');
        $pdf->Cell(23, 7, 'Amount Paid', 1, 0, 'C');
        $pdf->Ln();

        //Query to Model
        $get = null;
        $get = $this->Payment_model->getremaining_balance($is_no);
        $a_paid = $this->Payment_model->getpaid_ca($is_no);
        $li = $this->Land_model->getli_byid($is_no);
        $oi = $this->Land_model->getoi_byid($is_no);
        $ca_details = $this->Payment_model->getca_details($is_no);
        $ca_purpose = $this->Payment_model->getca_purpose($is_no);

        //column Lot No
        $pdf->SetFont("Arial", "", 9);
        $pdf->Cell(15, 7, $is_no, 1, 0, 'C');


        //column Lot Owner

        $pdf->Cell(35, 7, ucfirst($oi['firstname']) . ' ' . ucfirst($oi['middlename']) . ' ' . ucfirst($oi['lastname']), 1, 0, 'C');
        //end column

        //column total amount payable
        $pdf->Cell(35, 7, number_format($li['total_price'], 2), 1, 0, 'R');

        //column amount paid

        foreach ($ca_details as $cad) {
            foreach ($ca_purpose as $cap) {
                if ($cad['ca_no'] == $cap['reference_no']) {
                    $purposes = $cap['purpose'] . $cap['other_purpose'];
                    $pdf->Cell(90, 7, $purposes, 1, 0, 'C');
                    $pdf->Cell(23, 7, number_format($cad['amount'], 2), 1, 0, 'C');
                    $pdf->Ln();
                    $pdf->Cell(15, 7, '', 1, 0, 'C');
                    $pdf->Cell(35, 7, '', 1, 0, 'C');
                    $pdf->Cell(35, 7, '', 1, 0, 'C');
                }
            }
        }

        $pdf->SetFont("Arial", "B", 10);
        $pdf->Cell(90, 7, 'Balance :', 1, 0, 'R');
        $pdf->Cell(23, 7, number_format($get['remaining_balance'], 2), 1, 0, 'R');


        $title = 'Summary of Payment';
        $pdf->SetTitle($title);
        $pdf->Output();

    }

    public function acknowledgement()
    {
        $data['wa'] = "waaahhaha";
        // $this->load->library('m_pdf');
        $html = $this->load->view('progress/acknowledgement', $data, true);

        $pdfFilePath = "was" . ".pdf";

        $pdf = $this->m_pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output($html, "I");

        exit;

    }

    public function cash_advance($is_no)
    {

        $data['li'] = $this->Land_model->getli_byid($is_no);
        $data['ll'] = $this->Land_model->getll_byid($is_no);
        $data['oi'] = $this->Land_model->getoi_byid($is_no);
        $rcp = $this->Payment_model->getrcp_reqbyid($is_no);
        $data['ca_details'] = $this->Payment_model->getca_details($rcp['rcp_no']);
        $data['ca_purpose'] = $this->Payment_model->getca_purpose($rcp['rcp_no']);
        $data['rcp'] = $this->Payment_model->getrcp_reqbyid($is_no);

        // $this->load->library('m_pdf');
        $html = $this->load->view('accounting/cash_advance_pdf', $data, true);

        $pdfFilePath = "summary of payment" . ".pdf";

        $pdf = $this->m_pdf->load();
        $stylesheet = '<style>' . file_get_contents('assets/import/vendors/bootstrap/dist/css/bootstrap.min.css') . '</style>';
        $css = '<style>' . file_get_contents('assets/import/build/css/custom.min.css') . '</style>';
        // apply external css
        $pdf->WriteHTML($css);
        $pdf->WriteHTML($stylesheet);
        $pdf->WriteHTML($html);
        $pdf->Output($html, "I");
        // $pdf->Output($pdfFilePath, "D"); // this code is for download only

        // I: send the file inline to the browser. The PDF viewer is used if available.
        // D: send to the browser and force a file download with the name given by name.
        // F: save to a local file with the name given by name (may include a path).
        // S: return the document as a string.
        exit;

    }

    public function summary_of_payment($is_no)
    {

        $data['li'] = $this->Land_model->getli_byid($is_no);
        $data['oi'] = $this->Land_model->getoi_byid($is_no);
        $rcp = $this->Payment_model->getrcp_reqbyid($is_no);
        $data['ca_details'] = $this->Payment_model->getca_details($rcp['rcp_no']);
        $data['ca_purpose'] = $this->Payment_model->getca_purpose($rcp['rcp_no']);
        $data['rcp'] = $this->Payment_model->getrcp_reqbyid($is_no);

        $this->load->library('m_pdf');
        $html = $this->load->view('progress/summary_of_payment_pdf', $data, true);

        $pdfFilePath = "summary of payment" . ".pdf";

        $pdf = $this->m_pdf->load();
        $stylesheet = '<style>' . file_get_contents('assets/import/vendors/bootstrap/dist/css/bootstrap.min.css') . '</style>';
        $css = '<style>' . file_get_contents('assets/import/build/css/custom.min.css') . '</style>';
        // apply external css
        $pdf->WriteHTML($css);
        $pdf->WriteHTML($stylesheet);
        $pdf->WriteHTML($html);
        $pdf->Output($html, "I");
        // $pdf->Output($pdfFilePath, "D"); // this code is for download only

        // I: send the file inline to the browser. The PDF viewer is used if available.
        // D: send to the browser and force a file download with the name given by name.
        // F: save to a local file with the name given by name (may include a path).
        // S: return the document as a string.
        exit;

    }

    public function generate_due_rpt()
    {
        $data['land_info'] = $this->Land_model->getregistry_land();
        $data['lot_location'] = $this->Land_model->get_ll_asc();

        $this->load->library('m_pdf');
        $html = $this->load->view('legal/due_rpt_pdf', $data, true);

        $pdfFilePath = "due rpt" . ".pdf";

        $pdf = $this->m_pdf->load();

        $pdf->WriteHTML($html);
        $pdf->Output($html, "I");
    }

    public function generate_own_lot()
    {
        $data['owned_lot'] = $this->Legal_model->get_owned_land();
        $this->load->library('m_pdf');
        $html = $this->load->view('legal/own_lot_report', $data, true);

        $mpdf = $this->m_pdf->load();
        // $mpdf = new \Mpdf\Mpdf();

        $mpdf->WriteHTML($html);
        $mpdf->Output('output.pdf', 'I');
    }

    public function generate_processed_rpt($province, $city, $zipcode, $year)
    {
        $data['rpt'] = $this->Rpt_model->generate_processed_rpt(urldecode($province), $city, $zipcode, $year);
        $data['province'] = $province;
        $data['rpt_province'] = strtoupper(urldecode($province));
        $data['rpt_city'] = strtoupper(urldecode($city));
        $data['rpt_zipcode'] = $zipcode;
        $data['rpt_year'] = $year;
    
        $this->load->library('m_pdf');
        $html = $this->load->view('legal/generate_rpt', $data, true);
    
        $pdf = $this->m_pdf->load(null, 'Legal');
        $pdf->WriteHTML($html);
    
        // Add a JavaScript function to open the generated report in a new tab
        $script = "<script>
            window.open('" . $pdf->Output($html, "D") . "', '_blank');
        </script>";
    
        // Add the script to the HTML output
        $html .= $script;
    
        // Output the HTML
        echo $html;
    }
    
    public function samp($is_no)
    {
        $data['li'] = $this->Land_model->getli_byid($is_no);
        $data['oi'] = $this->Land_model->getoi_byid($is_no);
        $data['ca_details'] = $this->Payment_model->getca_details($is_no);
        $data['ca_purpose'] = $this->Payment_model->getca_purpose($is_no);
        $data['li_approved'] = $this->Land_model->getli_status_approved();
        $data['li_disapproved'] = $this->Land_model->getli_status_disapproved();
        $data['li_pending'] = $this->Land_model->getli_status_pending();
        $data['disapproved_payments'] = $this->Payment_model->getnum_payment_disapproved();
        $data['pending_payment_requests'] = $this->Payment_model->getnum_pending_payment_requests();

        $this->load->view('templates/header');
        $this->load->view('templates/bar', $data);
        $this->load->view('progress/summary_of_payment_pdf', $data);
        $this->load->view('templates/footer');
    }

}