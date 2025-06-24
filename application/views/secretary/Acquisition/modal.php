<?php foreach($reason as $reasons){?>
	<!--====================Reason Return====================-->
	<div class="modal animate bounceInUp return_reason_<?php echo $reasons['is_no'];?>" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
					<p class="modal-title" id="myModalLabel"><span class="fa fa-info"></span> Reason</p>
				</div>
				<div class="modal-body">
					<h6><?php echo $reasons['return_reason'];?></h6>                                        
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!--====================Reason Disapproved====================-->
	<div class="modal animate bounceInUp reason_disapproved_<?php echo $reasons['is_no'];?>" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
					<p class="modal-title" id="myModalLabel"><span class="fa fa-info"></span> Reason</p>
				</div>
				<div class="modal-body">
					<span><?php echo $reasons['disapproval_reason'];?></span>                                        
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<?php }?>