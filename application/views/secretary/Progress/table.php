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
					<h2 style="word-spacing:3px;font-weight: bold; font-size: 14px;color: #2a3f54; "><i class="fa fa-line-chart"></i> In Progress</h2>
					<div style="float:right">
						<a href="#" onclick="window.history.back()" class="btn btn-sm btn-warning"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="col-md-12">
					<!--====================INPROGRESS TABLE====================-->
					<table id="payment_datatable" class="table table-striped table-bordered table-hover">
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
			</div>	
			<!--====================END BODY====================-->
		</div>
	</div><br />
</div>
<!--====================END PAGE CONTENT====================-->

<script>
	// Set the first button as active on page load
	document.getElementById('button1').classList.add('active');
	document.getElementById('inprogress').style.display = 'block';

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