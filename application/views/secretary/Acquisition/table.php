<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container">  
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!--====================FLASH DATAS====================-->
			<?php if($this->session->flashdata('success')){?>
				<div class="alert alert-success alert-dismissible fade in" role="alert" id="saved">
					<i class="glyphicon glyphicon-ok"></i>  <?php echo $this->session->flashdata('success'); ?>
				</div>
			<?php } ?>
			<!--====================END FLASH DATAS====================-->
			<div class="x_panel animate slideInDown" style="box-shadow: 7px 6px 16px #888888;">
				<div class="x_title">
					<h6 class="fa fa-tasks"> <b>New Acquisition</b></h6> 
					<a href="#" onclick="window.history.back()" class="btn btn-xs btn-warning pull-right"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
					<div class="clearfix"></div>
				</div>
				<!--====================TAB NAVIGATION====================-->
				<ul class="nav nav-tabs">
					<?php if ($this->session->userdata('user_type') !== 'GM') { ?>
					    <li class="active"><a href="javascript:void(0);" onclick="openTab(event, 'pending', this)">
					    	<i class="fa fa-ellipsis-h"></i><small> <b>Pending</b></small>
					    	<sup>
		                        <?php if ($pending_acq > 0): ?>
		                            <small class="badge_custom bg-red"><?php echo $pending_acq; ?></small>
		                        <?php endif; ?>
		                    </sup>
					    </a></li>
					<?php } ?>

					<?php 
					    $user_type = $this->session->userdata('user_type');
					    $active_class = ($user_type === 'GM') ? 'active' : ''; 
					?>
					<li class="<?php echo $active_class; ?>">
					    <a href="javascript:void(0);" onclick="openTab(event, 'reviewed', this)" id="reviewedTab">
					        <i class="fa fa-check"></i><small> <b>Reviewed</b></small>
					        <sup>
					            <?php if ($reviewed_acq > 0): ?>
					                <small class="badge_custom bg-red"><?php echo $reviewed_acq; ?></small>
					            <?php endif; ?>
					        </sup>
					    </a>
					</li>

	                <?php if ($this->session->userdata('user_type') !== 'Legal') { ?>
	                	<li><a href="javascript:void(0);" onclick="openTab(event, 'approved', this)">
	                		<i class="fa fa-thumbs-up"></i><small> <b>Approved</b></small>
					    	<sup>
		                        <?php if ($approved_acq > 0): ?>
		                            <small class="badge_custom bg-red"><?php echo $approved_acq; ?></small>
		                        <?php endif; ?>
		                    </sup>
				    	</a></li>
				    <?php } ?>
				    <li><a href="javascript:void(0);" onclick="openTab(event, 'returned', this)">
				    	<i class="fa fa-undo"></i><small> <b>Returned</b></small>
				    	<sup>
	                        <?php if ($returned_acq > 0): ?>
	                            <small class="badge_custom bg-red"><?php echo $returned_acq; ?></small>
	                        <?php endif; ?>
	                    </sup>
				    </a></li>
				    <li><a href="javascript:void(0);" onclick="openTab(event, 'disapproved', this)">
				    	<i class="fa fa-thumbs-down"></i><small> <b>Disapproved</b></small>
				    	<sup>
	                        <?php if ($disapproved_acq > 0): ?>
	                            <small class="badge_custom bg-red"><?php echo $disapproved_acq; ?></small>
	                        <?php endif; ?>
	                    </sup>
				    </a></li>
				</ul>

				<div class="col-md-12">
					<!--====================PENDING TABLE====================-->
					<div id="pending" class="tabcontent space" >
						<table id="pending_acquisition_datatable" class="table table-bordered table-hover small" style="border-bottom:2px solid gray;width:100%">
							<thead class="bg-primary">
								<tr>
									<th>I.S No</th>
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
					<!--====================REVIEWED TABLE====================-->
					<div id="reviewed" class="tabcontent space" style="display: none;">
						<table id="reviewed_acquisition_datatable" class="table table-bordered table-hover small" style="border-bottom:2px solid gray;width:100%">
							<thead class="bg-primary">
								<tr>
									<th>I.S No</th>
									<th>Lot Owner</th>
									<th>Lot Type</th>
									<th>Lot Location</th>
									<th>Submission Date</th>
									<th>Reviewed Date</th>
									<th>Reviewed By</th>
									<th><center>Action</center></th>
								</tr>
							</thead>
							<tbody></tbody> 
						</table>
					</div>
					<!--====================APPROVED TABLE====================-->
					<div id="approved" class="tabcontent space" style="display: none;">
						<table id="approved_acquisition_datatable" class="table table-bordered table-hover small" style="border-bottom:2px solid gray;width:100%">
							<thead class="bg-primary">
								<tr>
									<th>I.S No</th>
									<th>Lot Owner</th>
									<th>Lot Type</th>
									<th>Lot Location</th>
									<th>Submission Date</th>
									<th>Reviewed Date</th>
									<th>Reviewed By</th>
									<th>Approval Date</th>
									<th>Approved By</th>
									<th><center>Action</center></th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
					<!--====================RETURNED TABLE====================-->
					<div id="returned" class="tabcontent space" style="display: none;">
						<table id="returned_acquisition_datatable" class="table table-bordered table-hover small" style="border-bottom:2px solid gray;width:100%">
							<thead class="bg-primary">
								<tr>
									<th>I.S No.</th>
									<th>Lot Owner</th>
									<th>Lot Type</th>
									<th>Lot Location</th>
									<th>Submission Date</th>
									<th>Returned Date</th>
									<th>Returned By</th>
									<th>Return Reason</th>
									<th><center>Action</center></th>
								</tr>
							</thead>
							<tbody></tbody> 
						</table>
					</div>
					<!--====================DISAPPROVED TABLE====================-->
					<div id="disapproved" class="tabcontent space" style="display: none;">
						<table id="disapproved_acquisition_datatable" class="table table-bordered table-hover small" style="border-bottom:2px solid gray;width:100%">
							<thead class="bg-primary">
								<tr>
									<th>I.S No.</th>
									<th>Lot Owner</th>
									<th>Lot Type</th>
									<th>Lot Location</th>
									<th>Submission Date</th>
									<th>Disapproval Date</th>
									<th>Disapproved By</th>
									<th>Disapproval Reason</th>
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

<script>
	document.addEventListener("DOMContentLoaded", function() {
	    var userType = "<?php echo $this->session->userdata('user_type'); ?>";

	    if (userType.trim() === "GM") { // Ensure there's no whitespace issue
	        var reviewedTab = document.querySelector("a[onclick*='reviewed']");

	        if (reviewedTab) {
	            setTimeout(() => { reviewedTab.click(); }, 500); // Delay for UI rendering
	        }
	    }
	});
</script>
