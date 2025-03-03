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
			<div class="x_panel " style="box-shadow: 5px 8px 16px #888888">
				<div class="x_title">
					<h2 class="fa fa-line-chart" style="font-size:15px"> In Progress</h2>
					<div style="float:right">
						<a href="#" onclick="goBack()" class="btn btn-sm btn-warning"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
					</div>
					<div class="clearfix"></div>
				</div>
				<!--====================INPROGRESS TABLE====================-->
				<table id="inprogress1_datatable" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>IS No.</th>
							<th>Lot Owner</th>
							<th>Lot Location</th>
							<th>Approval Date</th>
							<th>Payment Status</th>
							<th>Action</th>
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


<script>
	const goBack = () => {
		window.history.back();
	};
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
	td{
		height: 20px;
	}
	th {
		background:linear-gradient(to top, rgb(9, 32, 63) 0%, rgb(83, 120, 149) 100%);
		color: #fff;
		text-transform: uppercase;
		font-size: 11px;
		&.last {
			border-right: none;
		}
	}
</style>
		 