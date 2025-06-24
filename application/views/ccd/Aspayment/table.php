<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container">  
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!--====================FLASH DATAS====================-->
			<?php if($this->session->flashdata('notif')){?>
		        <div class="alert alert-success alert-dismissible fade in" role="alert" id="saved">
		          <i class="glyphicon glyphicon-ok"></i>  <?php echo $this->session->flashdata('notif'); ?>
		        </div>
		    <?php } ?>
			<!--====================END FLASH DATAS====================-->
			<div class="x_panel animate slideInDown" style="border:1px; !important;box-shadow: 7px 6px 16px #888888">
				<div class="x_title">
					<h6 class="fa fa-tasks"> <b>Land AsPayment</b></h6> 
					<a href="#" onclick="window.history.back()" class="btn btn-xs btn-warning pull-right"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
					<div class="clearfix"></div>
				</div>
				<!--====================TAB NAVIGATION====================-->
				<ul class="nav nav-tabs">
				    <li class="active"><a href="javascript:void(0);" onclick="openTab(event, 'pending', this)">
				    	<i class="fa fa-ellipsis-h"></i><small> <b>Pending</b></small>
				    	<sup>
                            <?php if ($pending_aspayment > 0): ?>
                                <small class="badge_custom bg-red"><?php echo $pending_aspayment; ?></small>
                            <?php endif; ?>
                        </sup>
				    </a></li>
				    <li><a href="javascript:void(0);" onclick="openTab(event, 'approved', this)">
				    	<i class="fa fa-thumbs-up"></i><small> <b>Approved</b></small>
					    <sup>
	                        <?php if ($approved_aspayment > 0): ?>
	                            <small class="badge_custom bg-red"><?php echo $approved_aspayment; ?></small>
	                        <?php endif; ?>
	                    </sup>
                    </a></li>
				    <li><a href="javascript:void(0);" onclick="openTab(event, 'disapproved', this)">
				    	<i class="fa fa-thumbs-down"></i><small> <b>Disapproved</b></small>
				    	<sup>
	                        <?php if ($disapproved_aspayment > 0): ?>
	                            <small class="badge_custom bg-red"><?php echo $disapproved_aspayment; ?></small>
	                        <?php endif; ?>
	                    </sup>
				    </a></li>
				    <li><a href="javascript:void(0);" onclick="openTab(event, 'paid', this)">
				    	<i class="fa fa-refresh"></i><small> <b>Paid</b></small>
					    <sup>
	                        <?php if ($paid_aspayment > 0): ?>
	                            <small class="badge_custom bg-red"><?php echo $paid_aspayment; ?></small>
	                        <?php endif; ?>
	                    </sup>
                    </a></li>
				</ul>
				<div class="col-md-12">
				    <!--====================PENDING====================-->
				    <div id="pending" class="tabcontent space">
				        <table id="pending_aspayment_datatable" class="table table-bordered table-hover small" style="border-bottom:2px solid gray;width:100%">
				            <thead class="bg-primary">
				                <tr>
				                    <th>I.S No.</th>
				                    <th>Lot Owner</th>
				                    <th>Lot Type</th>
				                    <th>Lot Location</th>
				                    <th>Submission Date</th>
				                    <th><center>Action</center></th>
				                </tr>
				            </thead>
				            <tbody></tbody> 
				        </table>
				    </div>
				    <!--====================APPROVED====================-->
				    <div id="approved" class="tabcontent space" style="display: none;">
				        <table id="approved_aspayment_datatable" class="table table-bordered table-hover small" style="border-bottom:2px solid gray;width:100%">
				            <thead class="bg-primary">
				                <tr>
				                    <th>I.S No.</th>
				                    <th>Lot Owner</th>
				                    <th>Lot Type</th>
				                    <th>Lot Location</th>
				                    <th>Submission Date</th>
				                    <th>Approval Date</th> 	 
				                    <th>Approved By</th> 	
				                    <th><center>Action</center></th>
				                </tr>
				            </thead>
				            <tbody></tbody> 
				        </table>
				    </div>
				    <!--====================DISAPPROVED====================-->
				    <div id="disapproved" class="tabcontent space" style="display: none;">
				        <table id="disapproved_aspayment_datatable" class="table table-bordered table-hover small" style="border-bottom:2px solid gray;width:100%">
				            <thead class="bg-primary">
				                <tr>
				                    <th>I.S No.</th>
				                    <th>Lot Owner</th>
				                    <th>Lot Type</th>
				                    <th>Lot Location</th>
				                    <th>Submission Date</th>
				                    <th>Disapproval Date</th> 	 
				                    <th>Disapproved By</th> 	
				                    <th>Disapproved Reason</th> 
				                    <th><center>Action</center></th>
				                </tr>
				            </thead>
				            <tbody></tbody> 
				        </table>
				    </div>
				    <!--====================APPROVED====================-->
				    <div id="paid" class="tabcontent space" style="display: none;">
				        <table id="paid_aspayment_datatable" class="table table-bordered table-hover small" style="border-bottom:2px solid gray;width:100%">
				            <thead class="bg-primary">
				                <tr>
				                    <th>I.S No.</th>
				                    <th>Lot Owner</th>
				                    <th>Lot Type</th>
				                    <th>Lot Location</th>
				                    <th>Submission Date</th>
				                    <th>Approval Date</th> 	 
				                    <th>Approved By</th> 	
				                    <th><center>Action</center></th>
				                </tr>
				            </thead>
				            <tbody></tbody> 
				        </table>
				    </div>
				</div>
				<!--====================END TAB NAVIGATION====================-->
			</div>  
		</div>
	</div><br/>
	<?php include 'modal.php'; ?>
</div>
<!--====================END PAGE CONTENT====================--> 