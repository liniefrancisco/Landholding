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

		<!--====================BODY====================-->
		<div class="x_panel animate slideInDown" style="border:1px; !important;box-shadow: 7px 6px 16px #888888;">
			<div class="x_title">
				<h2 style="word-spacing:3px;font-weight: bold; font-size: 14px;color: #2a3f54; "><i class="fa fa-file-text"></i> New Acquisition</h2>
				<div style="float:right">
					<a href="#" onclick="window.history.back()" class="btn btn-sm btn-warning"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="tab">
				<?php if ($this->session->userdata('user_type') !== 'GM') { ?>
					<button id="button1" class="tablinks active" onclick="openTab(event, 'pending')"><i class="fa fa-ellipsis-h"></i> <b>PENDING</b> 
						<sup>
							<?php if ($pending_acq > 0): ?>
							    <span class="badge_custom bg-red"><?php echo $pending_acq; ?></span>
							<?php endif; ?>
						</sup>
					</button>
				<?php } ?>
				<button class="tablinks <?php echo ($this->session->userdata('user_type') == 'GM') ? 'active' : ''; ?>" 
        			onclick="openTab(event, '<?php echo ($this->session->userdata('user_type') == 'GM') ? 'pending' : 'reviewed'; ?>')">
    				<i class="fa fa-check"></i> 
    				<b><?php echo ($this->session->userdata('user_type') == 'GM') ? 'PENDING' : 'REVIEWED'; ?></b>
				    <sup>
				        <?php if ($reviewed_acq > 0): ?>
				            <span class="badge_custom bg-red"><?php echo $reviewed_acq; ?></span>
				        <?php endif; ?>
				    </sup>
				</button>
				<?php if ($this->session->userdata('user_type') !== 'Legal') { ?>
					<button class="tablinks" onclick="openTab(event, 'approved')"><i class="fa fa-thumbs-up"></i> <b>APPROVED</b> 
						<sup>
							<?php if ($approved_acq > 0): ?>
							    <span class="badge_custom bg-red"><?php echo $approved_acq; ?></span>
							<?php endif; ?>
						</sup>
					</button>
				<?php } ?>
				<button class="tablinks" onclick="openTab(event, 'returned')"><i class="fa fa-refresh"></i> <b>RETURNED</b> 
					<sup>
						<?php if ($returned_acq > 0): ?>
						    <span class="badge_custom bg-red"><?php echo $returned_acq; ?></span>
						<?php endif; ?>
					</sup>
				</button>
				<button class="tablinks" onclick="openTab(event, 'disapproved')"><i class="fa fa-thumbs-down"></i> <b>DISAPPROVED</b> 
					<sup>
						<?php if ($disapproved_acq > 0): ?>
						    <span class="badge_custom bg-red"><?php echo $disapproved_acq; ?></span>
						<?php endif; ?>
					</sup>
				</button>
			</div>


			<div class="col-md-12 " style="border: 2px ridge ; border-radius: 5px;">
				<!--====================PENDING TABLE====================-->
				<div id="pending" class="tabcontent" >
					<h4 class="request">Pending Acquisition</h4>
					<table id="pending_new_acquisition_datatable" class="table table-striped table-bordered table-hover" style="width:100%">
						<thead>
							<tr>
								<th>I.S No</th>
								<th>Lot Owner</th>
								<th>Lot Type</th>
								<th>Lot Location</th>
								<th>Submission Date</th>
								<th><center>Action</center></th>
							</tr>
						</thead>
						<tbody>
						</tbody> 
					</table>
				</div>
				<!--====================REVIEWED TABLE====================-->
				<div id="reviewed" class="tabcontent" >
					<h4 class="request">Reviewed Acquisition</h4>
					<table id="reviewed_new_acquisition_datatable" class="table table-striped table-bordered table-hover" style="width:100%">
						<thead>
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
						<tbody>
						</tbody> 
					</table>
				</div>
				<!--====================APPROVED TABLE====================-->
				<div id="approved" class="tabcontent">
					<h4 class="request">Approved Acquisition</h4>
					<table id="approved_new_acquisition_datatable" class="table table-striped table-bordered table-hover" style="width:100%">
						<thead>
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
						<tbody>
						</tbody>
					</table>
				</div>
				<!--====================RETURNED TABLE====================-->
				<div id="returned" class="tabcontent" >
					<h4 class="request">Returned Acquisition</h4>
					<table id="returned_new_acquisition_datatable" class="table table-striped table-bordered table-hover" style="width:100%">
						<thead>
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
						<tbody>
						</tbody> 
					</table>
				</div>
				<!--====================DISAPPROVED TABLE====================-->
				<div id="disapproved" class="tabcontent">
					<h4 class="request">Disapproved Acquisition</h4>
					<table id="disapproved_new_acquisition_datatable" class="table table-striped table-bordered table-hover" style="width:100%">
						<thead>
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
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div><br/>	
		<!--====================END BODY====================-->   
		</div>
	</div><br />
</div>
<!--====================END PAGE CONTENT====================--> 

<!--====================DISPLAY REASON MODAL====================-->
<?php foreach($return_acquisition as $return){?>
	<div class="modal animate bounceInUp return_reason_<?php echo $return['is_no'];?>" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
					<p class="modal-title" id="myModalLabel"><span class="fa fa-file-text-o"></span> Reason Return</p>
				</div>
				<div class="modal-body">
					<span><?php echo $return['return_reason'];?></span>                                        
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal animate bounceInUp reason_disapproved_<?php echo $return['is_no'];?>" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
					<p class="modal-title" id="myModalLabel"><span class="fa fa-file-text-o"></span> Reason Return</p>
				</div>
				<div class="modal-body">
					<span><?php echo $return['disapproval_reason'];?></span>                                        
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<?php }?> 
<!--====================END MODAL====================-->

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var userType = "<?php echo $this->session->userdata('user_type'); ?>";

        if (userType === "GM") {
            document.getElementById('reviewed').style.display = 'block';
            document.querySelector('.tablinks[onclick*="reviewed"]').classList.add('active');
        } else {
            document.getElementById('pending').style.display = 'block';
            document.getElementById('button1').classList.add('active');
        }
    });

    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;

        // Hide all tab content
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Remove the "active" class from all tab links
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }

        // Show the selected tab content and mark the button as active
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.classList.add("active");
    }
</script>

<style type="text/css">
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
		font-size: 12px;
	}
	th {
		background:linear-gradient(to top, rgb(9, 32, 63) 0%, rgb(83, 120, 149) 100%);
		color: #fff;
		text-transform: uppercase;
		font-size: 12px;
		&.last {
			border-right: none;
		}
	}
	.tab {
		overflow: visible;
		background-color: #f1f1f1;
	}
	.tab button {
		background-color: inherit;
		float: left;
		border: none;
		outline: none;
		cursor: pointer;
		padding: 5px 10px;
		transition: 0.3s;
		font-size: 13px;
		border: 1px solid #ccc;
		border-radius: 10px;
		border-right: none;
		background-color: #e9e9e9;
		color: #28282B;
		border-top: 1px solid gray;
		border-left: 1px solid gray;
		border-right: 2px solid #181818;
		border-bottom: 3px solid #181818;
	}

	.tab button:hover {
		background-color: #002347;
		color: white;
	}

	.tab button.active {
		background-color:  #002347;
		color: white;
	}


	.tabcontent {
		display: none;
		padding: 6px 12px;
		transition: opacity 0.3s ease;
	}

	.fade-in {
		opacity: 1;
	}

	button[type="submit"]{
		 font-size: 18px;
		 padding: 15px;
		 border: 2px solid #FFF;
		 color: #FFF;
		 display: block;
		 margin: 50px auto;
		 background: transparent;
		 transition: .2s ease-in-out 0s;
	}

	input[type="submit"]:hover{
		cursor: pointer;
		transform: scale(1.10);
		background: #FFF;
		color: white;
	}

	button[type="a"]{
		 font-size: 18px;
		 padding: 15px;
		 border: 2px solid #FFF;
		 color: #FFF;
		 display: block;
		 margin: 50px auto;
		 background: transparent;
		 transition: .2s ease-in-out 0s;
	}

	a[type="a"]:hover{
		cursor: pointer;
		transform: scale(1.10);
		background: #FFF;
		color: white;
	}
	.request{
		font-family: verdana; text-align: center;font-size: 16px;color:#2a3f54;font-weight:bold
	}
</style>