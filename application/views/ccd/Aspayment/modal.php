<!--====================APPROVAL MODAL====================-->
<?php if (isset($ds['is_no'])): ?>   
    <div class="modal fade approved_<?php echo $ds['is_no']?>"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" style="margin-top: 100px;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-ok"></i>Approve</h5>
                </div>
                <div class="modal-body text-center" style="overflow-y: auto;">
                    <h6>Are you sure, you want to approve this request?</h6>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm approved" id="<?php echo $ds['is_no']?>">Yes</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    <!--====================DISAPPROVAL MODAL====================-->
    <div class="modal fade disapproved_<?php echo $ds['is_no']?>"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" style="margin-top: 100px;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-ok"></span> Write a message</h5>
                </div>
                <div class="modal-body">
                    <label>Reason for Disapproval</label>
                    <textarea class="form-control disapproved_message" name="disapproved_message" id="disapproved_message" style="max-width:100%;width:100%;height:100px"></textarea>          
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm disapproved" id="<?php echo $ds['is_no']?>">Submit</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<!--====================REASON DISAPPROVED====================-->
<?php foreach($reason as $ds):?>
    <div class="modal fade reason_disapproved_<?php echo $ds['is_no']; ?>" tabindex="-1" role="dialog" aria-hidden="true" style="margin-top:100px;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title" id="myModalLabel"><span class="fa fa-info"></span> Reason Disapproved</h5>
                </div>
                <div class="modal-body">
                    <h6><?php echo $ds['disapproval_reason'] ?></h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>