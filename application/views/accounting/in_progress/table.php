	<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container">  
		<div class="col-md-12 col-sm-12 col-xs-12">
			<?php if($this->session->flashdata('notif')){?>
				<div class="alert alert-info alert-dismissible fade in" role="alert" id="saved">
					<i class="glyphicon glyphicon-ok"></i>  <?php echo $this->session->flashdata('notif'); ?>
				</div>
			<?php } ?>
			<!--====================BODY====================-->
			<div class="x_panel" style="box-shadow: 5px 8px 16px #888888">
				<div class="x_title">
					<h6 class="fa fa-line-chart"> <b>In Progress</b></h6> 
					<a href="#" onclick="window.history.back()" class="btn btn-xs btn-warning pull-right"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
					<div class="clearfix"></div>
				</div>
				<!--====================INPROGRESS TABLE====================-->
				<table id="inprogress1_datatable" class="table table-bordered table-hover small" style="border-bottom:2px solid gray">
					<thead class="bg-primary">
						<tr>
							<th>IS No.</th>
							<th>Lot Owner</th>
							<th>Lot Location</th>
							<th>Approval Date</th>
							<th>Payment Status</th>
							<th><center>Action</center></th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
				<!--====================END TABLE====================-->
			</div>  
			<!--====================END BODY====================-->
		</div>
	</div>
</div>
<!--====================END PAGE CONTENT====================-->	 