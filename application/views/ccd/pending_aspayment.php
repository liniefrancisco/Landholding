<!-- page content -->
<div class="right_col" role="main">
    <div class="row row_container">

           <div class="col-md-12 col-sm-12 col-xs-12">
<!-- FLASH DATAS =========================================================================================================================================== -->
              <!--  <?php if(($this->session->flashdata('notif')=='Request has been sent and waiting for its Approval')){?>
                      <div class="alert alert-success alert-dismissible fade in" role="alert" id="saved">
                          <i class="glyphicon glyphicon-ok"></i>  <?php echo $this->session->flashdata('notif'); ?>
                      </div>
               <?php } ?> -->
<!-- END FLASH DATAS =========================================================================================================================================== -->
<!-- start content ======================================================================================================================================= -->
                  <div class="x_panel" style="box-shadow: 5px 8px 16px #888888">
                       <div class="x_title">
                            <h2 style="word-spacing: 4px; letter-spacing: 1px; font-weight: bold; font-size: 14px;color: #2a3f54; "><i class="fa fa-retweet"></i> Pending Requests</h2>
                                <div style="float:right;color: #2a3f54;"><b>
                <p style="font-size: 13px;font-family: sans-serif;padding-bottom: 3px;letter-spacing: 1px;" id="da"></p>
                <p style="font-size: 13px;font-family: sans-serif;margin-top: -19px;letter-spacing: 1px;" id="ti"></p>
               </b></div>
                            <div class="clearfix"></div>
                          </div>

                          <table id="datatable-fixed-header" class="table table-striped table-bordered" style="border-bottom: 2px solid #ff6600;">
                                      <thead>
                                          <tr>
                                            <th><center>Ref. No.</center></th>
                                            <th><center>Date Acquired</center></th>
                                            <th><center>Lot Type</center></th>
                                            <th><center>Form</center></th>
                                            <th><center>Action</center></th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                            foreach($pending_aspayment as $data){
                                              if($data['tag'] == "New LAPF-ES" || $data['tag'] == "New LAPF-JS"){
                                         ?>
                                            <tr>
                                              <td><?php echo $data['is_no'] ?></td>
                                              <td><center><?php  $date = date_create($data['date_acquired']); echo date_format($date, "M-d-Y"); ?></center></td>
                                              <td><center><?php echo $data['lot_type'] ?></center></td>
                                              <td><center><?php if($data['tag'] == "New LAPF-ES"){ echo "LAPF-ES"; }else{ echo "LAPF-JS"; } ?></center></td>
                                              <td>
                                                  <center>
                                                    <?php if($data['tag'] == 'New LAPF-ES'){ ?>
                                                      <a href="<?= base_url('Ccd/Aspayment/view_es/'.$data['is_no']) ?>" class="btn btn-custom-primary" ><i class="glyphicon glyphicon-folder-open"></i> Select</a>
                                                    <?php }else{ ?>
                                                      <a href="<?= base_url('Ccd/Aspayment/view_js/'.$data['is_no']) ?>" class="btn btn-custom-primary" ><i class="glyphicon glyphicon-folder-open"></i> Select</a>
                                                    <?php } ?>
                                                  </center>
                                              </td>
                                            </tr>
                                        <?php }} ?>
                                      </tbody>
                           </table>


                  
                  </div>  
<!-- end content  ======================================================================================================================================= -->
            </div>
        
          
    </div>
    <br />
</div>
<!-- /page content -->


<style type="text/css">
    /*TABLE STYLE =============================================================================================================*/


table {
  font-family: 'Arial';
  margin: 25px auto;
  border-collapse: collapse; 
  border: 1px solid #eee;
  border-bottom: 2px solid #00cccc;
  box-shadow: 0px 0px 20px rgba(0,0,0,0.10),
     0px 10px 20px rgba(0,0,0,0.05),
     0px 20px 20px rgba(0,0,0,0.05),
     0px 30px 20px rgba(0,0,0,0.05);
}
  tr {
     &:hover {
      background: #f4f4f4;
      
      td {
        color: #555;
      }
    }
  }
  th, td {
    color: #595959;
    border: 1px solid #eee;
    padding: 12px 35px;
    border-collapse: collapse;
  }
  td{
    height: 20px;
  }
  th {
    background: #ff6600;
    color: #fff;
    text-transform: uppercase;
    font-size: 12px;
    &.last {
      border-right: none;
    }
  }


/*END TABLE STYLE =============================================================================================================*/
</style>