<!-- page content -->
<div class="right_col" role="main">
    <div class="row row_container">
         
         <button onclick="topFunction()" id="mvTop" title="Go to top"><i class="fa fa-arrow-up"></i>Top</button>
         <div class="col-md-12 col-sm-12 col-xs-12">
<!-- start content ======================================================================================================================================= -->
                  <div class="x_panel animate zoomIn" style="box-shadow: 5px 8px 16px #888888">
                       <div class="x_title">
                            <h2 style="word-spacing: 4px; letter-spacing: 1px; font-weight: bold; font-size: 14px;color: #2a3f54; "><i class="fa fa-legal"></i> Extrajudicial</h2>
                                 <div style="float:right;color: #2a3f54;"><b>
                <p style="font-size: 13px;font-family: sans-serif;padding-bottom: 3px;letter-spacing: 1px;" id="da"></p>
                <p style="font-size: 13px;font-family: sans-serif;margin-top: -19px;letter-spacing: 1px;" id="ti"></p>
               </b></div>
                            <div class="clearfix"></div>
                          </div>      <?php if($li['status'] == 'Approved'){ ?>
                                          <a href="<?= base_url('Progress') ?>" class="btn btn-warning" style="float: right;"><span class="fa fa-arrow-left"></span> Back</a>
                                      <?php }elseif($li['status'] == 'Pending'){ ?>
                                          <a href="<?= base_url('Ccd/Requests/pending_aspayment') ?>" class="btn btn-warning" style="float: right;"><span class="fa fa-arrow-left"></span> Back</a>
                                      <?php }else{ ?>
                                          <a href="<?= base_url('Ccd/Requests/disapproved_aspayment') ?>" class="btn btn-warning" style="float: right;"><span class="fa fa-arrow-left"></span> Back</a>
                                      <?php } ?>

                                  <div class="col-md-12 col-sm-12 col-xs-12 form_border">
                                          <center class="space">
                                                <img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
                                                                    <h4>LAND AS PAYMENT FORM - EXTRAJUDICIAL SETTLEMENT (LAPF-ES)</h4>
                                          </center>
                                          <div class="col-md-12 col-sm-12 col-xs-12 space">
                                                <div class="col-md-4 col-sm-4 col-xs-4 form-inline">
                                                      <label>LAPF-ES #:</label><input class="form-control input_border" type="text" name="es_no" value="<?php echo $li['is_no'] ?>"  readonly>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-4"></div>
                                                <div class="col-md-4 col-sm-4 col-xs-4 form-inline" style="margin-left: -10px;">
                                                      <?php $date_acq = date_create($li['date_acquired']); ?> 
                                                      <label>Date:</label><input class="form-control input_border" type="text" value="<?php echo date_format($date_acq,"F d, Y"); ?>" name="date"  readonly>
                                                </div>
                                          </div>
                                          <div class="col-md-12 col-sm-12 col-xs-12 space" style="border-top: 2px solid #ff6600; border-bottom: 1px solid #ff6600;">
                                                <center><h5><b style="letter-spacing: 20px;">LAND INFORMATION</b></h5></center>
                                          </div>
                                          <div class="col-md-12 col-sm-12 col-xs-12 space">
                                              <div class="col-md-3 col-sm-3 col-xs-3 lot_type" style="height: 29px;"><label>Lot Type:</label></div>
                                              <div class="col-md-3 col-sm-3 col-xs-3 lot_type"><input type="checkbox" name="lot_type" value="" <?php if($li['lot_type'] == 'Agricultural'){ echo "checked";} ?>><label> Agricultural</label></div>
                                              <div class="col-md-3 col-sm-3 col-xs-3 lot_type"><input type="checkbox" name="lot_type" value="" <?php if($li['lot_type'] == 'Commercial'){ echo "checked";} ?>><label> Commercial</label></div>
                                              <div class="col-md-3 col-sm-3 col-xs-3 lot_type"><input type="checkbox" name="lot_type" value="" <?php if($li['lot_type'] == 'Residential'){ echo "checked";} ?>><label> Residential</label></div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                                              <div class="col-md-3 col-sm-3 col-xs-3 form-inline"><label>Lot.</label><input type="text" name="" value="<?php echo $li['lot'] ?>" class="form-control input_border " readonly></div>
                                              <div class="col-md-3 col-sm-3 col-xs-3 form-inline"><label>Cad.</label><input type="text" name="" value="<?php echo $li['cad'] ?>" class="form-control input_border" readonly></div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 space"> 
                                              <div class="col-md-3 col-sm-3 col-xs-3"><label>Lot Owner:</div>
                                              <div class="col-md-3 col-sm-3 col-xs-3">
                                                      <input type="text" name="" value="<?php echo $oi['firstname'] ?>" class="form-control input_border name_center" readonly>
                                                      <h6 class="name_center"><i>Firstname</i></h6>
                                              </div>
                                              <div class="col-md-3 col-sm-3 col-xs-3">
                                                      <input type="text" name="" value="<?php echo $oi['middlename'] ?>" class="form-control input_border name_center" readonly>
                                                      <h6 class="name_center"><i>Middlename</i></h6>
                                              </div>
                                              <div class="col-md-3 col-sm-3 col-xs-3">
                                                      <input type="text" name="" value="<?php echo $oi['lastname'] ?>" class="form-control input_border name_center" readonly>
                                                      <h6 class="name_center"><i>Lastname</i></h6>
                                              </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                                              <div class="col-md-4 col-sm-4 col-xs-4"><label>Owner Information:</label></div>
                                              <div class="col-md-4 col-sm-4 col-xs-4"><input type="checkbox" name="" value="<?php ?>" <?php if($oi['vital_status'] == 'Alive'){ echo "checked"; } ?>><label> Alive</label></div>
                                              <div class="col-md-4 col-sm-4 col-xs-4"><input type="checkbox" name="" value="<?php ?>" <?php if($oi['vital_status'] == 'Deceased'){ echo "checked"; } ?>><label> Deceased</label></div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 space"> 
                                              <div class="col-md-3 col-sm-3 col-xs-3"><label>Lot Location:</div>
                                              <div class="col-md-3 col-sm-3 col-xs-3">
                                                      <input type="text" name="" value="<?php echo $ll['street'] ?>" class="form-control input_border name_center" readonly>
                                                      <h6 class="name_center"><i>Street</i></h6>
                                              </div>
                                              <div class="col-md-3 col-sm-3 col-xs-3">
                                                      <input type="text" name="" value="<?php echo $ll['baranggay'] ?>" class="form-control input_border name_center" readonly>
                                                      <h6 class="name_center"><i>Baranggay</i></h6>
                                              </div>
                                              <div class="col-md-3 col-sm-3 col-xs-3">
                                                      <input type="text" name="" value="<?php echo $ll['municipality'] ?>" class="form-control input_border name_center" readonly>
                                                      <h6 class="name_center"><i>Municipality</i></h6>
                                              </div>
                                              <div class="col-md-3 col-sm-3 col-xs-3"><label></div>
                                              <div class="col-md-3 col-sm-3 col-xs-3">
                                                      <input type="text" name="" value="<?php echo $ll['province'] ?>" class="form-control input_border name_center" readonly>
                                                      <h6 class="name_center"><i>Province</i></h6>
                                              </div>
                                              <div class="col-md-3 col-sm-3 col-xs-3">
                                                      <input type="text" name="" value="<?php echo $ll['country'] ?>" class="form-control input_border name_center" readonly>
                                                      <h6 class="name_center"><i>Country</i></h6>
                                              </div>
                                              <div class="col-md-3 col-sm-3 col-xs-3">
                                                      <input type="text" name="" value="<?php echo $ll['zip_code'] ?>" class="form-control input_border name_center" readonly>
                                                      <h6 class="name_center"><i>Zipcode</i></h6>
                                              </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                                              <div class="col-md-4 col-sm-4 col-xs-4"><label>Lot for payment:</label></div>
                                              <div class="col-md-4 col-sm-4 col-xs-4"><input type="checkbox" name="" value="<?php ?>" <?php if($li['lot_sold'] == "Portion"){ echo "checked"; } ?>><label> Portion</label></div>
                                              <div class="col-md-4 col-sm-4 col-xs-4"><input type="checkbox" name="" value="<?php ?>" <?php if($li['lot_sold'] == "Whole"){ echo "checked"; } ?>><label> Whole</label></div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                                              <div class="col-md-4 col-sm-4 col-xs-4 form-inline">
                                                      <label>Lot Size:</label> <input type="text" value="<?php echo number_format($li['lot_size'],2) ?>" name="" class="form-control input_border" readonly><label>sq/m</label>
                                              </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                                              <div class="col-md-4 col-sm-4 col-xs-4">
                                                      <label>Available Proof of Title/Ownership:</label>
                                              </div>
                                              <div class="col-md-4 col-sm-4 col-xs-4">
                                                      <label><input type="checkbox" name="" value="<?php ?>" <?php if(!$ud['oct'] == null){ echo "checked"; } ?>><label> Original Certificate of Title (OCT)</label></label>
                                              </div>
                                              <div class="col-md-4 col-sm-4 col-xs-4">
                                                      <label><input type="checkbox" name="" value="<?php ?>" <?php if(!$ud['tct'] == null){ echo "checked"; } ?>><label> Transfer Certificate of Title (TCT)</label></label>
                                              </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4" id="oct">
                                                <?php if(!$ud['oct'] == null){  ?>
                                                    <button style='margin-left: 50px;' class='btn btn-info' data-target='.oct_<?php echo $ud['id'] ?>' data-toggle='modal'>View OCT</button>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4"  id="tct">
                                               <?php if(!$ud['tct'] == null){ ?>
                                                    <button style='margin-left: 50px;' class='btn btn-info' data-target='.tct_<?php echo $ud['id'] ?>' data-toggle='modal'>View TCT</button> 
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                                        <label>Land Value:</label>
                                              <center>
                                                      <table class="table">
                                                            <tr>  
                                                              <th>BASIS</th>
                                                              <th>AMOUNT</th>
                                                            </tr>
                                                            <tr>
                                                                <td>MV from Latest Tax Declaration</td>
                                                                <td class="form-inline">₱ <input type="text" name="" value="<?php echo number_format($ab['mv_latest_tax_dec'],2)  ?>" class="form-control input_border" readonly></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Neighboring Inquiry</td>
                                                                <td class="form-inline">₱ <input type="text" name="" value="<?php echo number_format($ab['neighboring_inq'],2) ?>" class="form-control input_border" readonly></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Assessor</td>
                                                                <td class="form-inline">₱ <input type="text" name="" value="<?php echo number_format($ab['assesor'],2)  ?>" class="form-control input_border" readonly></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Banks</td>
                                                                <td class="form-inline">₱ <input type="text" name="" value="<?php echo number_format($ab['banks'],2) ?>" class="form-control input_border" readonly></td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Final Land Value</td>
                                                                <td class="form-inline">₱ <input type="text" name="" value="<?php echo number_format($ab['final_value'],2) ?>" class="form-control input_border" readonly></td>
                                                            </tr>
                                                      </table>
                                              </center>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 space" style="border-top: 2px solid #ff6600; border-bottom: 2px solid #ff6600;">
                                                <center><h5>CUSTOMER BALANCE INFORMATION</h5></center>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                                              <div class="col-md-4 col-sm-4 col-xs-4"><label>Type:</label></div>
                                              <div class="col-md-4 col-sm-4 col-xs-4"><input type="checkbox" value="" name="" <?php if($cbal['balance_type'] == "Bounced Check"){ echo "checked"; } ?>><label>Bounced Check</label></div>
                                              <div class="col-md-4 col-sm-4 col-xs-4"><input type="checkbox" value="" name="" <?php if($cbal['balance_type'] == "Bad Account"){ echo "checked"; } ?>><label>Bad Account</label></div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                                              <div class="col-md-3 col-sm-3 col-xs-3"><label>Business Unit:</label></div>
                                              <div class="col-md-4 col-sm-4 col-xs-4"><input type="text" name="" value="<?php echo $cbal['business_unit'] ?>" class="form-control input_border" readonly></div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 space"> 
                                              <div class="col-md-3 col-sm-3 col-xs-3"><label>Customer Name:</div>
                                              <div class="col-md-3 col-sm-3 col-xs-3">
                                                      <input type="text" name="" value="<?php echo $ci['firstname'] ?>" class="form-control input_border name_center" readonly>
                                                      <h6 class="name_center"><i>Firstname</i></h6>
                                              </div>
                                              <div class="col-md-3 col-sm-3 col-xs-3">
                                                      <input type="text" name="" value="<?php echo $ci['middlename'] ?>" class="form-control input_border name_center" readonly>
                                                      <h6 class="name_center"><i>Middlename</i></h6>
                                              </div>
                                              <div class="col-md-3 col-sm-3 col-xs-3">
                                                      <input type="text" name="" value="<?php echo $ci['lastname'] ?>" class="form-control input_border name_center" readonly>
                                                      <h6 class="name_center"><i>Lastname</i></h6>
                                              </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 space"> 
                                              <div class="col-md-3 col-sm-3 col-xs-3"><label>Customer Address:</label></div>
                                              <div class="col-md-3 col-sm-3 col-xs-3">
                                                      <input type="text" name="cstreet" value="<?php echo $cadd['street'] ?>" class="form-control input_border name_center" readonly>
                                                      <h6 class="name_center"><i>Street</i></h6>
                                              </div>
                                              <div class="col-md-3 col-sm-3 col-xs-3">
                                                      <input type="text" name="cbarangay" value="<?php echo $cadd['barangay'] ?>" class="form-control input_border name_center" readonly>
                                                      <h6 class="name_center"><i>Baranggay</i></h6>
                                              </div>
                                              <div class="col-md-3 col-sm-3 col-xs-3">
                                                      <input type="text" name="ctown" value="<?php echo $cadd['town'] ?>" class="form-control input_border name_center" readonly>
                                                      <h6 class="name_center"><i>Town</i></h6>
                                              </div>
                                              <div class="col-md-3 col-sm-3 col-xs-3"></div>
                                              <div class="col-md-3 col-sm-3 col-xs-3">
                                                      <input type="text" name="cprovince" value="<?php echo $cadd['province'] ?>" class="form-control input_border name_center" readonly>
                                                      <h6 class="name_center"><i>Province</i></h6>
                                              </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 space" style="border-top: 1px solid #ff6600;">
                                              <div class="col-md-6"><label>Documents</label></div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                                              <div class="col-md-4 col-sm-4 col-xs-4"><center><label>Turnover of Doubtful Account Form Folder</label><button  class='btn btn-custom-primary' data-target='.doubt_<?php echo $eu['reference_id'] ?>' data-toggle='modal'>View <span class="glyphicon glyphicon-folder-open"></span></button></center></div>
                                              <div class="col-md-4 col-sm-4 col-xs-4"><center><label>Latest SOA Folder</label><br><button  class='btn btn-custom-primary' data-target='.soa_<?php echo $eu['reference_id'] ?>' data-toggle='modal'>View <span class="glyphicon glyphicon-folder-open"></span></button></center></div>
                                              <div class="col-md-4 col-sm-4 col-xs-4"><center><label>Supporting Documents Folder</label><br><button class='btn btn-custom-primary' data-target='.supp_<?php echo $eu['reference_id'] ?>' data-toggle='modal'>View <span class="glyphicon glyphicon-folder-open"></span></button></center></div>
                                        </div>


                                  </div>

                          
                         
                  </div>  
<!-- end content  ======================================================================================================================================= -->
            </div>

        	
    </div>
    <br />
</div>
<!-- /page content -->


<!-- OCT and TCT modal file =================================================================================================================================== -->
                <div class="modal fade oct_<?php echo $ud['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Original Certificate of Title (OCT)</h4>
                        </div>
                        <div class="modal-body" >
                              <center>
                                <div style="overflow-x:auto;">
                                    <img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/OCT/'.$ud['oct'].'') ?>" class="img-responsive" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);">   
                                </div>
                              </center>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="modal fade tct_<?php echo $ud['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Transfer Certificate of Title (TCT)</h4>
                        </div>
                        <div class="modal-body">

                              <center>
                                <div style="overflow-x:auto;">
                                    <img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/TCT/'.$ud['tct'].'') ?> " class="img-responsive" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);" >   
                                </div>
                              </center>
                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>

                      </div>
                    </div>
                  </div>
<!-- end OCT and TCT modal file ============================================================================================================================= -->

                <div class="modal fade doubt_<?php echo $eu['reference_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Turnover of Doubtful Account Form</h4>
                        </div>
                        <div class="modal-body">

                              <center>
                                <div style="overflow-x:auto;">
                                    <img src="<?= base_url('assets/img/es_uploads/'.$eu['reference_id'].'/doubtful_account/'.$eu['doubtful_account'].'') ?> " class="img-responsive" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);" >   
                                </div>
                              </center>
                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>

                      </div>
                    </div>
                  </div>


                  <div class="modal fade soa_<?php echo $eu['reference_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Latest SOA</h4>
                        </div>
                        <div class="modal-body">

                              <center>
                                <div style="overflow-x:auto;">
                                    <img src="<?= base_url('assets/img/es_uploads/'.$eu['reference_id'].'/latest_soa/'.$eu['latest_soa'].'') ?> " class="img-responsive" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);">   
                                </div>
                              </center>
                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="modal fade supp_<?php echo $eu['reference_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Supporting Documents</h4>
                        </div>
                        <div class="modal-body">

                              <center>
                                <div style="overflow-x:auto;">
                                    <img src="<?= base_url('assets/img/es_uploads/'.$eu['reference_id'].'/supporting_docs/'.$eu['supporting_docs'].'') ?>" class="img-responsive" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);" >   
                                </div>
                              </center>
                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>

                      </div>
                    </div>
                  </div>






<style type="text/css">

table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid #cccccc;
}
th{
  text-align: center;
}
#mvTop {
  display: none;
  position: fixed;
  bottom: 45px;
  right: 23px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: #0066ff;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 4px;
}

#mvTop:hover {
  background-color: #555;
}
</style>


<script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        document.getElementById("mvTop").style.display = "block";
    } else {
        document.getElementById("mvTop").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script>
