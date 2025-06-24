<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="box-shadow: 5px 8px 16px #888888">
        <div class="x_title">
          <h2><i class="fa fa-print"></i> Report</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>

        <ul class="nav nav-tabs" style="margin-bottom: 10px;">
          <li role="presentation" class="active">
            <a onclick="showList('defaultList');" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">All List</a>
          </li>
          <li role="presentation" class="">
            <a id="max" onclick="showList('largest');" href="#largest" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">10 Largest Lot </a>
          </li>
          <li role="presentation" class="">
            <a onclick="showList('smallest');" href="#smallest" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">10 Smallest Lot </a>
          </li>
          <li role="presentation" class="">
            <a onclick="showList('tct');" href="#tct" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">TCT status</a>
          </li>
        </ul>

        <div id="defaultList">
          <table class="table table-bordered table-hover" id="all_lot" >
            <thead>
              <tr>
                <th>#</th>
                <th>Lot Type</th>  
                <th>Category</th>  
                <th>Tax Dec. No</th>  
                <th>Title No.</th> 
                <th>Municipality</th> 
                <th>Per/Sq.m</th> 
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>

        <div id="largest" style="display:none">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Lot Type</th>  
                <th>Category</th>  
                <th>Tax Dec. No</th>  
                <th>Title No.</th> 
                <th>Municipality</th> 
                <th>Per/Sq.m</th> 
              </tr>
            </thead>
            <tbody>
              <?php 
                foreach($largest as $lar){
                  foreach($lot_location as $ll){
                    if($lar['is_no'] == $ll['is_no']){
              ?>
                <tr>
                  <td><?php echo $lar['lot_type'] ?></td>
                  <?php if($lar['tag'] == 'Old'){ ?>
                    <td><?php echo "Old Land"; ?></td>
                  <?php }elseif($lar['tag'] == 'New'){ ?>
                    <td><?php echo "New Land"; ?></td>
                  <?php }elseif($lar['tag'] == 'LAPF-ES' || $lar['tag'] == 'LAPF-JS' || $lar['tag'] == 'Old LAPF-JS' || $lar['tag'] == 'Old LAPF-ES'){ ?>
                    <td><?php echo "As Payment"; ?></td>
                  <?php }else{ ?>
                    <td><?php echo "Reclamation"; ?></td>
                  <?php } ?>
                  <td><?php echo $lar['tax_dec_no'] ?></td>
                  <td><?php echo $lar['lot'] ?></td>
                  <td><?php echo ucfirst($ll['municipality']) ?></td>
                  <td><?php echo number_format($lar['lot_size'],2) ?></td>
                </tr>
              <?php }}} ?>
            </tbody>
          </table>
          <a href="<?php echo base_url('Excel_gen/largest_lot');?>" class="btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i> Export to Excel</a> 
        </div>

        <div id="smallest" style="display:none">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Lot Type</th>  
                <th>Category</th>  
                <th>Tax Dec. No</th>  
                <th>Title No.</th> 
                <th>Municipality</th> 
                <th>Per/Sq.m</th> 
              </tr>
            </thead>
            <tbody>
              <?php 
                foreach($smallest as $sm){
                  foreach($lot_location as $ll){
                    if($sm['is_no'] == $ll['is_no']){
              ?>
                <tr>
                  <td><?php echo $sm['lot_type'] ?></td>
                  <?php if($sm['tag'] == 'Old'){ ?>
                    <td><?php echo "Old Land"; ?></td>
                  <?php }elseif($sm['tag'] == 'New'){ ?>
                    <td><?php echo "New Land"; ?></td>
                  <?php }elseif($sm['tag'] == 'LAPF-ES' || $sm['tag'] == 'LAPF-JS' || $sm['tag'] == 'Old LAPF-JS' || $sm['tag'] == 'Old LAPF-ES'){ ?>
                    <td><?php echo "As Payment"; ?></td>
                  <?php }else{ ?>
                    <td><?php echo "Reclamation"; ?></td>
                  <?php } ?>
                  <td><?php echo $sm['tax_dec_no'] ?></td>
                  <td><?php echo $sm['lot'] ?></td>
                  <td><?php echo ucfirst($ll['municipality']) ?></td>
                  <td><?php echo number_format($sm['lot_size'],2) ?></td>
                </tr>
              <?php }}} ?>
            </tbody>
          </table>
          <a href="<?php echo base_url('Excel_gen/smallest_lot');?>" class="btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i> Export to Excel</a>
        </div>

        <div id="tct" style="display:none">
          <table class="table table-bordered table-hover" id="report_tct" style="width: 100%">
            <thead>
              <tr>
                <th>#</th>
                <th>IS No.</th>
                <th>Owner</th>
                <th>Location</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>           
      </div>  
    </div>    
  </div><br/>
</div>

<script type="text/javascript">
  function showList(elementListId) { 
    document.getElementById("defaultList").style.display = "none";
    document.getElementById("largest").style.display = "none";
    document.getElementById("smallest").style.display = "none";
    document.getElementById("tct").style.display = "none";
    document.getElementById(elementListId).style.display = "block";
  }
</script>