<!-- page content -->
<div class="right_col" role="main">
    <div class="row row_container">
          
          <div class="col-md-12 col-sm-12 col-xs-12">
<!-- LIST OF LAND OWNED ======================================================================================================================================= -->
                  <div class="x_panel" style="box-shadow: 5px 8px 16px #888888">
                       <div class="x_title">
                            <h2 style="word-spacing: 4px; letter-spacing: 1px; font-weight: bold; font-size: 14px;color: #2a3f54; "><i class="fa fa-empire"></i> Lists of Lot Owned</h2>
                            <div style="float:right;color: #2a3f54;"><b>
                <p style="font-size: 13px;font-family: sans-serif;padding-bottom: 3px;letter-spacing: 1px;" id="da"></p>
                <p style="font-size: 13px;font-family: sans-serif;margin-top: -19px;letter-spacing: 1px;" id="ti"></p>
               </b></div>
                            <div class="clearfix"></div>
                          </div>
                       <table id="ccd_owned_view" class="table table-striped table-bordered" style="border-bottom: 2px solid #262626;">
                              <thead>
                                  <tr>
                                    <th>Lot No.</th>
                                    <th>Location</th>
                                    <th>Class</th>
                                    <th>Area</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <!-- <?php foreach($land_info as $li){ 
                                          if($li['tag'] == "New LAPF-ES" || $li['tag'] == "New LAPF-JS"){
                                              foreach($lot_location as $ll){
                                                if($li['is_no'] == $ll['is_no']){
                                     ?>

                                                <tr>
                                                          <td><?php echo $li['lot'] ?></td>
                                                          <td><?php echo $ll['street'] ?>,<?php echo $ll['baranggay'] ?>,<?php echo $ll['municipality'] ?>,<?php echo $ll['province'] ?></td>
                                            <td><?php echo $li['lot_type'] ?></td>
                                            <td style="text-align: right;"><center><?php echo number_format($li['lot_size'],2) ?> <code>sq/m</code></center></td>

                                      </tr>
                                  <?php }}}} ?> -->
  
                              </tbody>
                        </table>
                  </div>  
<!--END LIST OF LAND OWNED ======================================================================================================================================= -->

        <br/>
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

  th {
    background: #262626;
    color: #fff;
    text-transform: uppercase;
    font-size: 12px;
    &.last {
      border-right: none;
    }
  }

/*END TABLE STYLE =============================================================================================================*/
</style>
<script>
  $(document).ready(function(){
    $('#ccd_owned_view').DataTable( {
              fixedHeader: false,
              "processing": true,
              "serverSide": true,
              "order": [],
              "ajax": {
                  "url": "<?php echo base_url('Ccd/Owned/get_ccd_owned_Lists/'); ?>",
                  "type": "POST"
              },
              "columnDefs": [{ 
                  "targets": [0],
                  "orderable": true
              }]
        } );
  });
    
</script>

            
