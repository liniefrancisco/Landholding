<!DOCTYPE html>
<html>
  <head>
    <title>Summary of Payment</title>
    <link href="<?php echo base_url();?>/assets/import/vendors/bootstrap/dist/css/bootstrap.min.css" rel="text/stylesheet">
  </head>
  <body style="font-size:11px;">
    <?php
      $get_remaining_balance = $this->Pdf_model->getremaining_balance($is_no);
      $a_paid = $this->Pdf_model->getpaid_ca($is_no);
    ?>
    <div style="border-bottom:2px solid black; ">
      <img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="170px" height="45px"> 
      <h4 style="margin-left: 250px; margin-top: -40px; font-weight: bold;"><b class="serif">Land Holding Management System </b></h4> 
      <h5 style="margin-left: 265px; padding-top: -10px"><b class="serif">Summary of Payment as of <?php echo date('F-d-Y') ?></b></h5>
    </div>

    <table class="table table-striped table-bordered dt-responsive table-hover" width="100%" style="margin-top:20px">
      <thead>
        <tr>
          <th style="background-color:#3B444B;color:#fff;text-align:center">PAYEE</th>
          <th style="background-color:#3B444B;color:#fff;text-align:center">TOTAL AMOUNT PAYABLE</th>
          <th style="background-color:#3B444B;color:#fff;text-align:center">TRANSACTION DATE</th>
          <th style="background-color:#3B444B;color:#fff;text-align:center">CONTROL NO.</th>
          <th style="background-color:#3B444B;color:#fff;text-align:center">TYPE OF REQUEST</th>
          <th style="background-color:#3B444B;color:#fff;text-align:center">AMOUNT</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="text-align:center"><?php echo $oi['firstname'] ?>  <?php if($oi['middlename']){  $m = $oi['middlename']; echo $m[0].'. '; }else{ echo " "; }  ?><?php echo $oi['lastname'] ?></td>
          <td style="text-align:center">₱ <?php echo number_format($li['total_price'],2) ?></td>

          <?php 
            $counter = 0; 
            foreach($pt_details as $pt){
              $counter++;
              foreach($pr_details as $pr){
                if($pt['control_no'] == $pr['control_no']){
                  $data = $this->Pdf_model->getca_transaction($pr['control_no']);
          ?>

            <td style="text-align:center"><?php $date= date_create($data['transaction_date']); echo date_format($date,"M-d-Y"); ?></td>
            <td style="text-align:center"><?php echo $pr['control_no'] ?></td>
            <td style="text-align:center"><?php echo $pr['type'] ?></td>
            <td style="text-align:center"><?php echo number_format($pt['amount'],2); ?></td>
          </tr>

            <?php if($counter < count($pt_details)):?>
              <tr>   
                <td></td>
                <td></td>
            <?php endif; ?>
            <?php }}} ?>

            <?php if($a_paid == 0){ 
              echo '<td colspan="4" class="pdf-text-right"><code><center> No Payment History </center></code></td>';
            }else{ ?>
              </tr>
              <tr>
                <td colspan="4"></td>
                <td class="pdf-text-right text-danger"> Balance :</td>
                <td class="pdf-text-left text-danger">₱<?php echo number_format($get_remaining_balance['remaining_balance'],2) ?></td>
              </tr>
            <?php } ?>        
      </tbody>
    </table>
  </body>
</html>     

     
<style type="text/css">
  b.serif {
    font-family: "Times New Roman", Times, serif;
  }
  .sansserif {
    font-family: Arial, Helvetica, sans-serif;
  }
  .header{
    background-color: black; color: white;
  }
  th, td {
    border: 1px solid black;
    padding:7px;
  }
</style>