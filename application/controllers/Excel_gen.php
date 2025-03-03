<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require 'vendor/autoload.php';

// // Import PhpSpreadsheet classes
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel_gen extends App_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
        // Load the model
        $this->load->model('Payment_model');
        $this->load->model('Land_model');
        $this->load->model('Legal_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('Excel');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {

    }



    public function summary_of_payment($is_no)
    {
        $this->sess_legal();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->setActiveSheetIndex(0);
        $sheet->setTitle('Summary of Payment');
    
        //set cell A1 content with some text
        $sheet->setCellValue('A1', 'Land Holding Management System');
        $sheet->setCellValue('A2', 'Summary of Payment');

        $sheet->setCellValue('A4', 'I.S No.');
        $sheet->setCellValue('B4', 'Owner');
        $sheet->setCellValue('C4', 'Total Amount Payable');
        $sheet->setCellValue('D4', 'Check No.');
        $sheet->setCellValue('E4', 'Purpose');
        $sheet->setCellValue('F4', 'Amount');

        $sheet->getStyle('A4')->getFont()->setBold(true);
        $sheet->getStyle('B4')->getFont()->setBold(true);
        $sheet->getStyle('C4')->getFont()->setBold(true);
        $sheet->getStyle('D4')->getFont()->setBold(true);
        $sheet->getStyle('E4')->getFont()->setBold(true);
        $sheet->getStyle('F4')->getFont()->setBold(true);
        //merge cell A1 until C1
        $sheet->mergeCells('A1:F1');
        $sheet->mergeCells('A3:F3');
        $sheet->mergeCells('A2:F2');
        //set aligment to center for that merged cell (A1 to C1)
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //make the font become bold
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(16);
        $sheet->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

        $sheet->getStyle('A2')->getFont()->setBold(true);
        $sheet->getStyle('A2')->getFont()->setSize(14);
        $sheet->getStyle('A2')->getFill()->getStartColor()->setARGB('#333');
        for ($col = ord('A'); $col <= ord('E'); $col++) {
            //set column dimension $sheet->getColumnDimension(chr($col))->setAutoSize(true);
            //change the font size
            $sheet->getStyle(chr($col))->getFont()->setSize(12);
            $sheet->getStyle(chr(ord('E')))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $sheet->getStyle(chr(ord('D')))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        }
        //retrive contries table data
        $rcp = $this->Payment_model->getrcp_reqbyid($is_no);
        $get = null;
        $get = $this->Payment_model->getremaining_balance($rcp['rcp_no']);
        $a_paid = $this->Payment_model->getpaid_ca($rcp['rcp_no']);
        $li = $this->Land_model->getli_byid($is_no);
        $oi = $this->Land_model->getoi_byid($is_no);
        $ca_details = $this->Payment_model->getca_details($rcp['rcp_no']);
        $ca_purpose = $this->Payment_model->getca_purpose($rcp['rcp_no']);

        //Fill data
        //LotNumber 
        $sheet->setCellValue('A5', $is_no);

        //LotOwner
        $sheet->setCellValue('B5', $oi['firstname'] . " " . $oi['middlename'] . " " . $oi['lastname']);

        //Total Amount Payable
        $sheet->setCellValue('C5', "₱" . number_format($li['total_price'], 2));

        //Amount Paid

        $x = 5;
        //Mode of Payment
        foreach ($ca_details as $cad) {
            foreach ($ca_purpose as $cap) {
                if ($cad['ca_no'] == $cap['reference_no']) {
                    $purposes = $cap['purpose'] . $cap['other_purpose'];

                    $sheet->setCellValue("D$x", $cad['reference_no']);
                    $sheet->setCellValue("E$x", $purposes);
                    $sheet->setCellValue("F$x", "₱" . number_format($cad['amount'], 2));

                    $x++;
                }
            }
        }


        //Balance
        $z = $x;
        if ($a_paid == 0) { //check if amount paid is equal to zero
            $styleArray = array(
                'font' => array(
                    'bold' => false,
                    'italic' => true,
                    'color' => array('rgb' => 'FF0000'),
                    'size' => 8,
                    'name' => 'Verdana'
                )
            );
            $sheet->setCellValue('D5', 'no payment history');
            $sheet->getStyle('D5')->applyFromArray($styleArray);
            $sheet->mergeCells('D5:F5');
        } else {
            $sheet->getStyle("E$z")->getFont()->setBold(true);
            $sheet->getStyle("E$z")->getFont()->setSize(13);
            $sheet->setCellValue("E$z", "Balance :");
            $sheet->getStyle("F$z")->getFont()->setBold(true);
            $sheet->getStyle("F$z")->getFont()->setSize(13);
            $sheet->setCellValue("F$z", "₱" . number_format($get['remaining_balance'], 2));
        }

         //border
         $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '#000000'],
                ],
            ],
        ];
        $sheet->getStyle('A1:D10')->applyFromArray($styleArray);



        // Save the Excel file
        $filename = 'SummaryPayment.xlsx'; // Adjust the filename and extension
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $writer->save('php://output');
    }


    // SMALLEST LOT EXCEL REPORT ======================================================================================================================================
    public function smallest_lot()
    {
        $this->sess_legal();

        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('10SmallestLot');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Land Holding Management System');
        $this->excel->getActiveSheet()->setCellValue('A2', '10 Smallest Lot');

        $this->excel->getActiveSheet()->setCellValue('A4', 'Lot Location');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Category');
        $this->excel->getActiveSheet()->setCellValue('C4', 'Lot Class');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Lot Area');

        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->mergeCells('A1:D1');
        $this->excel->getActiveSheet()->mergeCells('A3:D3');
        $this->excel->getActiveSheet()->mergeCells('A2:D2');

        //table column bold
        $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('D4')->getFont()->setBold(true);

         //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
        $this->excel->getActiveSheet()->getStyle('A2')->getFill()->getStartColor()->setARGB('#333');

        for($col = ord('A'); $col <= ord('D'); $col++)
        { 
        //set column dimension $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
        //change the font size
        $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
        }
        $lot_location= $this->Land_model->getlot_location();
        $smallest = $this->Land_model->getlot_smallest();
            $x=5;
          foreach($smallest as $sm){
          foreach($lot_location as $ll){
            if($sm['is_no'] == $ll['is_no']){
                    $this->excel->getActiveSheet()->setCellValue("A$x", ucfirst($ll['baranggay']).", ".ucfirst($ll['municipality']).", ".ucfirst($ll['province']));
                    if($sm['tag'] == 'Old'){ 
                        $this->excel->getActiveSheet()->setCellValue("B$x", ucfirst('Old Land'));                       
                       }elseif($sm['tag'] == 'New'){ 
                        $this->excel->getActiveSheet()->setCellValue("B$x", ucfirst('New Land'));
                       }elseif($sm['tag'] == 'LAPF-ES' || $sm['tag'] == 'LAPF-JS' || $sm['tag'] == 'Old LAPF-JS' || $sm['tag'] == 'Old LAPF-ES'){ 
                        $this->excel->getActiveSheet()->setCellValue("B$x", ucfirst('As Payment'));
                       }else{ 
                        $this->excel->getActiveSheet()->setCellValue("B$x", ucfirst('Reclamation'));
                    } 
                    $this->excel->getActiveSheet()->setCellValue("C$x", ucfirst($sm['lot_type']));
                    $this->excel->getActiveSheet()->setCellValue("D$x", number_format($sm['lot_size'],2));
                    $x++;

                    $z = $x-1;
            }}}
        //border
         $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => '#000000'),
                ),
            ),
        );
        $this->excel->getActiveSheet()->getStyle("A1:D$z")->applyFromArray($styleArray);



        $filename='10 Smallest Lot.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
// ============================================================================================================================================================================


// Largest LOT EXCEL REPORT ======================================================================================================================================
    public function largest_lot()
    {
        $this->sess_legal();
        
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('10 Largest Lot');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Land Holding Management System');
        $this->excel->getActiveSheet()->setCellValue('A2', '10 Largest Lot');

        $this->excel->getActiveSheet()->setCellValue('A4', 'Lot Location');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Category');
        $this->excel->getActiveSheet()->setCellValue('C4', 'Lot Class');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Lot Area');

        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->mergeCells('A1:D1');
        $this->excel->getActiveSheet()->mergeCells('A3:D3');
        $this->excel->getActiveSheet()->mergeCells('A2:D2');

        //table column bold
        $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('D4')->getFont()->setBold(true);

         //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
        $this->excel->getActiveSheet()->getStyle('A2')->getFill()->getStartColor()->setARGB('#333');

        for($col = ord('A'); $col <= ord('D'); $col++)
        { 
        //set column dimension $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
        //change the font size
        $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
        }
        $lot_location= $this->Land_model->getlot_location();
        $largest = $this->Land_model->getlot_largest();;
            $x=5;
          foreach($largest as $lar){
          foreach($lot_location as $ll){
            if($lar['is_no'] == $ll['is_no']){
                    $this->excel->getActiveSheet()->setCellValue("A$x", ucfirst($ll['baranggay']).", ".ucfirst($ll['municipality']).", ".ucfirst($ll['province']));
                    if($lar['tag'] == 'Old'){ 
                        $this->excel->getActiveSheet()->setCellValue("B$x", ucfirst('Old Land'));                       
                       }elseif($lar['tag'] == 'New'){ 
                        $this->excel->getActiveSheet()->setCellValue("B$x", ucfirst('New Land'));
                       }elseif($lar['tag'] == 'LAPF-ES' || $lar['tag'] == 'LAPF-JS' || $lar['tag'] == 'Old LAPF-JS' || $lar['tag'] == 'Old LAPF-ES'){ 
                        $this->excel->getActiveSheet()->setCellValue("B$x", ucfirst('As Payment'));
                       }else{ 
                        $this->excel->getActiveSheet()->setCellValue("B$x", ucfirst('Reclamation'));
                    } 
                    $this->excel->getActiveSheet()->setCellValue("C$x", ucfirst($lar['lot_type']));
                    $this->excel->getActiveSheet()->setCellValue("D$x", number_format($lar['lot_size'],2));
                    $x++;

                    $z = $x-1;
            }}}
        //border
         $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => '#000000'),
                ),
            ),
        );
        $this->excel->getActiveSheet()->getStyle("A1:D$z")->applyFromArray($styleArray);



        $filename='10 Largest Lot.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
    public function owned_lot($province, $city)
    {
        $this->sess_legal();
        // $province = $this->input->post('province');
        // $city = $this->input->post('city');

        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Owned Lot');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Land Holding Management System');
        $this->excel->getActiveSheet()->setCellValue('A2', 'Owned Lot');

        $this->excel->getActiveSheet()->setCellValue('A4', 'Lot Location');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Category');
        $this->excel->getActiveSheet()->setCellValue('C4', 'Lot Class');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Lot Area');

        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->mergeCells('A1:D1');
        $this->excel->getActiveSheet()->mergeCells('A3:D3');
        $this->excel->getActiveSheet()->mergeCells('A2:D2');

        //table column bold
        $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('D4')->getFont()->setBold(true);

         //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
        $this->excel->getActiveSheet()->getStyle('A2')->getFill()->getStartColor()->setARGB('#333');

        for($col = ord('A'); $col <= ord('D'); $col++)
        { 
        //set column dimension $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
        //change the font size
        // $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
        }
        $lot_location= $this->Land_model->getlot_location();
        $largest = $this->Land_model->getlot_largest();
        $owned_land = $this->Legal_model->get_owned_land($province,$city);
        $x = 5;
        $z = 0;
        foreach ($owned_land as $owned_land) {
           
              
                    $this->excel->getActiveSheet()->setCellValue("A$x", ucfirst($owned_land['baranggay']) . ", " . ucfirst($owned_land['municipality']) . ", " . ucfirst($owned_land['province']));
                    if (stristr($owned_land['tag'],'Old') !== false) {
                        $this->excel->getActiveSheet()->setCellValue("B$x", ucfirst('Old Land'));
                    } elseif (stristr($owned_land['tag'] ,'New') !== false) {
                        $this->excel->getActiveSheet()->setCellValue("B$x", ucfirst('New Land'));
                    } 
                    $this->excel->getActiveSheet()->setCellValue("C$x", ucfirst($owned_land['lot_type']));
                    $this->excel->getActiveSheet()->setCellValue("D$x", number_format($owned_land['lot_size'], 2));
                    $x++;

                    $z = $x - 1;
              
        }
        //border
         $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => '#000000'),
                ),
            ),
        );
        $this->excel->getActiveSheet()->getStyle("A1:D$z")->applyFromArray($styleArray);



        $filename='owned_land.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
    public function rpt($province, $city)
    {
        $this->sess_legal();
        // $province = $this->input->post('province');
        // $city = $this->input->post('city');
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Real property tax');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Land Holding Management System');
        $this->excel->getActiveSheet()->setCellValue('A2', 'Real Property Tax');

        $this->excel->getActiveSheet()->setCellValue('A4', 'Municipality/City');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Lot. No');
        $this->excel->getActiveSheet()->setCellValue('C4', 'Latest Tax Dec. No.');
        // $this->excel->getActiveSheet()->setCellValue('D4', 'Location');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Size(SQ.M)');
        $this->excel->getActiveSheet()->setCellValue('E4', 'Purchase Price');
        $this->excel->getActiveSheet()->setCellValue('F4', 'Unpaid RPT Year(s)');

        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->mergeCells('A1:F1');
        $this->excel->getActiveSheet()->mergeCells('A3:F3');
        $this->excel->getActiveSheet()->mergeCells('A2:F2');

        //table column bold
        $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('D4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('E4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('F4')->getFont()->setBold(true);

         //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
        $this->excel->getActiveSheet()->getStyle('A2')->getFill()->getStartColor()->setARGB('#333');

        for($col = ord('A'); $col <= ord('G'); $col++)
        { 
        //set column dimension $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
        //change the font size
        $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
        // $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
        }
       
        $rpt_land = $this->Legal_model->get_rpt_land($province, $city);

        $x = 5;
        $z = 0;
       
        foreach ($rpt_land as $rpt) {
                   
                    $this->excel->getActiveSheet()->setCellValue("A$x", ucfirst($rpt['baranggay']) . ", " . ucfirst($rpt['municipality']) . ", " . ucfirst($rpt['province']));
                    $this->excel->getActiveSheet()->setCellValue("B$x", ucfirst($rpt['lot']));
                    $this->excel->getActiveSheet()->setCellValue("C$x", ucfirst($rpt['tax_dec_no']));
                    $this->excel->getActiveSheet()->setCellValue("D$x", number_format($rpt['lot_size'], 2));
                    $this->excel->getActiveSheet()->setCellValue("E$x", number_format($rpt['total_price'], 2));

                    $count = $this->Legal_model->get_count_rpt($rpt['iis_no']);
                   
                    $date1 = new DateTime($rpt['date_acquired']);
                    $date2 = new DateTime(date('Y-m-d'));
                    $interval = $date1->diff($date2);

                    if($interval->y == 0){ 
                        if($count == 1){
                            $this->excel->getActiveSheet()->setCellValue("F$x", 'Paid');
                        }else{
                            $this->excel->getActiveSheet()->setCellValue("F$x", ' Unpaid');
                        }
                     }else{
                        $tot_years1 = $interval->y - $count; //subtract to get the no. of years unpaid
                        if($tot_years1 !== 0){
                          $year = $tot_years1.' Years Unpaid';
                        }else{
                          $year = 'Unpaid';
                        }
                        //   echo $tot_years1 . " years "; 
                          $this->excel->getActiveSheet()->setCellValue("F$x", $year);
                     }
                    $x++;

                    $z = $x - 1;
        }
        //border
         $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => '#000000'),
                ),
            ),
        );
        $this->excel->getActiveSheet()->getStyle("A1:F$z")->applyFromArray($styleArray);



        $filename='real property tax.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        
        // $data[] =[
        //     'excel'=>$objWriter,
        //     'status'=>'success',
        // ];
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
        // echo json_encode($data);
    }
    // ============================================================================================================================================================================
    // // Largest LOT EXCEL REPORT ======================================================================================================================================
    // public function owned_lot()
    // {
    //     $this->sess_leggm();
    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();
    //     $spreadsheet->setActiveSheetIndex(0);
    //     $sheet->setTitle('Owned Lot');
    //     //set cell A1 content with some text
    //     $sheet->setCellValue('A1', 'Land Holding Management System');
    //     $sheet->setCellValue('A2', 'Owned Lot');

    //     $sheet->setCellValue('A4', 'Lot Location');
    //     $sheet->setCellValue('B4', 'Category');
    //     $sheet->setCellValue('C4', 'Lot Class');
    //     $sheet->setCellValue('D4', 'Lot Area');

    //     $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    //     $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    //     // $sheet->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    //     $sheet->mergeCells('A1:D1');
    //     $sheet->mergeCells('A3:D3');
    //     $sheet->mergeCells('A2:D2');

    //     //table column bold
    //     $sheet->getStyle('A4')->getFont()->setBold(true);
    //     $sheet->getStyle('B4')->getFont()->setBold(true);
    //     $sheet->getStyle('C4')->getFont()->setBold(true);
    //     $sheet->getStyle('D4')->getFont()->setBold(true);

    //     //make the font become bold
    //     $sheet->getStyle('A1')->getFont()->setBold(true);
    //     $sheet->getStyle('A1')->getFont()->setSize(16);
    //     $sheet->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

    //     $sheet->getStyle('A2')->getFont()->setBold(true);
    //     $sheet->getStyle('A2')->getFont()->setSize(14);
    //     $sheet->getStyle('A2')->getFill()->getStartColor()->setARGB('#333');

    //     for ($col = ord('A'); $col <= ord('D'); $col++) {
    //         //set column dimension $sheet->getColumnDimension(chr($col))->setAutoSize(true);
    //         //change the font size
    //         $sheet->getStyle(chr($col))->getFont()->setSize(12);
    //     }
        
    //     $lot_location = $this->Land_model->getlot_location();
    //     $largest = $this->Land_model->getlot_largest();
    //     $owned_land = $this->Legal_model->get_owned_land();
    //     $x = 5;
    //     foreach ($owned_land as $owned_land) {
           
              
    //                 $sheet->setCellValue("A$x", ucfirst($owned_land['baranggay']) . ", " . ucfirst($owned_land['municipality']) . ", " . ucfirst($owned_land['province']));
    //                 if ($owned_land['tag'] == 'Old') {
    //                     $sheet->setCellValue("B$x", ucfirst('Old Land'));
    //                 } elseif ($owned_land['tag'] == 'New') {
    //                     $sheet->setCellValue("B$x", ucfirst('New Land'));
    //                 } 
    //                 $sheet->setCellValue("C$x", ucfirst($owned_land['lot_type']));
    //                 $sheet->setCellValue("D$x", number_format($owned_land['lot_size'], 2));
    //                 $x++;

    //                 $z = $x - 1;
              
    //     }
    //     //border
    //     $styleArray = [
    //         'borders' => [
    //             'allBorders' => [
    //                 'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
    //                 'color' => ['argb' => '#000000'],
    //             ],
    //         ],
    //     ];
    //     $sheet->getStyle('A1:D10')->applyFromArray($styleArray);


    //     // Save the Excel file
    //     $filename = 'owned_lot.xlsx'; // Adjust the filename and extension
    //     $writer = new Xlsx($spreadsheet);

    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header("Content-Disposition: attachment; filename=\"$filename\"");
    //     $writer->save('php://output');
    // }
    // ============================================================================================================================================================================


}