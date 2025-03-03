<!--====================MODAL LAND TITLE====================-->  
<?php if (isset($li['is_no'])): ?>     
<div class="modal animate bounceInUp land_title_<?php echo $li['is_no'];?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-orange">
                <button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><span class="fa fa-file-text-o"></span> Land Title</h4>
            </div>
            <div class="modal-body">
                <div style="overflow-x:auto;">
                    <img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Land Title/'.$ud['land_title'].'') ?> " class="img-responsive">   
                </div>                                         
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!--====================MODAL TAX DECLERATION====================-->  
<div class="modal animate bounceInUp latest_tax_dec_<?php echo $li['is_no'];?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-orange">
                <button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><span class="fa fa-file-text-o"></span> Latest Tax Declaration</h4>
            </div>
            <div class="modal-body">
                <div style="overflow-x:auto;">
                    <img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Tax Declaration/'.$ud['latest_tax_dec'].'') ?> " class="img-responsive">   
                </div>                                        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--====================MODAL LAND SKETCH====================-->                 
<div class="modal animate bounceInUp land_sketch_<?php echo $li['is_no'];?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-orange">
                <button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><span class="fa fa-file-text-o"></span> Land Sketch</h4>
            </div>
            <div class="modal-body">
                <div style="overflow-x:auto;">
                    <img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Land Sketch/'.$ud['land_sketch'].'') ?> " class="img-responsive">   
                </div>               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<!--====================REASON DISAPPROVAL MODAL CA/FP/COLLATERAL====================-->
<?php foreach($getpr_reason as $dr):?>
    <div class="modal fade reason_disapproved_<?php echo $dr['control_no']; ?>" tabindex="-1" role="dialog" aria-hidden="true" style="margin-top:100px;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-red">
                    <button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title" id="myModalLabel"><span class="fa fa-file-text-o"></span> Reason Disapproved</h5>
                </div>
                <div class="modal-body">
                    <span><?php echo $dr['reason_disapproved'] ?></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!--====================PAYMENT APPROVAL MODAL====================-->
<?php if (isset($pr['control_no'])): ?>   
<div class="modal fade approved_<?php echo $pr['control_no']?>"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" style="margin-top: 100px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-ok"></i>Approve</h4>
            </div>
            <div class="modal-body" style="overflow-y: auto;">
                <center><h6><span style="font-family:verdana; font-size:15px">Are you sure, you want to approve this request?</span></h6></center>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn  btn-success approved" id="<?php echo $pr['control_no']?>">Yes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<!--====================PAYMENT DISAPPROVAL MODAL====================-->
<div class="modal fade disapproved_<?php echo $pr['control_no']?>"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" style="margin-top: 100px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-ok"></span> Write a message</h4>
            </div>
            <div class="modal-body">
                <label>Reason for Disapproval</label>
                <textarea class="form-control disapproved_message" name="disapproved_message" id="disapproved_message" style="max-width:100%;width:100%;height:100px"></textarea>          
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn  btn-success disapproved" id="<?php echo $pr['control_no']?>">Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<!--====================END MODAL====================--> 