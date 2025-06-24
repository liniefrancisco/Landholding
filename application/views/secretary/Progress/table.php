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
					<h6 class="fa fa-line-chart"> <b>In Progress</b></h6> 
					<a href="#" onclick="window.history.back()" class="btn btn-xs btn-warning pull-right"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
					<div class="clearfix"></div>
				</div>

				<div class="col-md-12">
					<!--====================INPROGRESS TABLE====================-->
					<table id="inprogress_datatable" class="table table-bordered table-hover small" style="border-bottom:2px solid gray">
						<thead class="bg-primary">
							<tr>
								<th>IS No.</th>
								<th>Lot Owner</th>
								<th>Lot Location</th>
								<th>Approval Date</th>
								<th>Payment Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody></tbody>
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