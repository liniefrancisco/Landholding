<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissible fade in" role="alert" style="position: fixed; bottom: 10px; right: 10px; z-index: 99; cursor: pointer;" id="saved">
		<?php echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'. validation_errors('<i class="fa fa-remove"></i> '); ?>
	</div>
<?php } ?>

<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!--====================FLASH DATA====================-->
			<?php if(($this->session->flashdata('notif')=='Cheque Request Form has been created successfully!')){?>
				<div class="alert alert-success alert-dismissible fade in" role="alert" id="saved">
					<i class="glyphicon glyphicon-ok"></i>  <?php echo $this->session->flashdata('notif'); ?>
				</div>
			<?php } ?>
			<?php if(($this->session->flashdata('notif')=='Invalid request.')){ ?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert" id="saved">
					<i class="glyphicon glyphicon-remove"></i>  <?php echo $this->session->flashdata('notif'); ?>
				</div>
			<?php } ?>
			<!--====================END FLASH DATA====================-->

			<!--====================BODY====================-->
			<div class="x_panel animate slideInDown" style="border:1px; !important;box-shadow: 7px 6px 16px #888888;">
				<div class="x_title">
					<h2 class="fa fa-money"> Payment Request</h2> 
					<div style="float:right">
						<a href="#" onclick="window.history.back()" class="btn btn-sm btn-warning"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="tab">
					<button id="button1" class="tablinks active" onclick="openTab(event, 'pending')"><i class="fa fa-ellipsis-h"></i> <b>PENDING</b> 
						<sup>
							<?php if ($approved_payment > 0): ?>
							    <span class="badge_custom bg-red"><?php echo $approved_payment; ?></span>
							<?php endif; ?>
						</sup>
					</button>

					<button class="tablinks" onclick="openTab(event, 'created')"><i class="fa fa-refresh"></i> <b>HISTORY</b> 
						<sup>
							<?php if ($paid_payment > 0): ?>
							    <span class="badge_custom bg-red"><?php echo $paid_payment; ?></span>
							<?php endif; ?>
						</sup>
					</button>
				</div>

				<div class="col-md-12 " style="border: 2px ridge ; border-radius: 5px;">
					<!--====================APPROVED====================-->
					<div id="pending" class="tabcontent">
						<table id="pending_crf_datatable" class="table table-striped table-bordered" style="border-bottom:2px solid gray;width:100%">
							<thead>
								<tr>
									<th>Is No.</th>
									<th>Lot Owner</th>
									<th>Lot Type</th>
									<th>Lot Location</th>
									<th>Type of Request</th>
									<th>Date Requested</th>
									<th>Approval Date</th>
									<th><center>Action</center></th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
					<!--====================END APPROVED====================-->

					<!--====================CREATED====================-->
					<div id="created" class="tabcontent">
						<table id="history_crf_datatable" class="table table-striped table-bordered table-hover" style="border-bottom:2px solid gray;width:100%">
							<thead>
								<tr>
									<th>CRF#</th>
									<th>Is No.</th>
									<th>Lot Owner</th>
									<th>Lot Type</th>
									<th>Lot Location</th>
									<th>Type of Request</th>
									<th>Date Requested</th>
									<th>Submission Date</th>
									<th><center>Action</center></th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
					<!--====================END PAID====================-->
				</div>
			</div>  
			<!--====================END BODY====================-->
		</div>
	</div>
	<?php include 'create_crf_modal.php'; ?>
	<?php include 'view_crf_modal.php'; ?>
	<?php include 'view_rca_modal.php'; ?>
</div>
<!--====================END PAGE CONTENT====================-->

<script>
	$(document).ready(function() {
		var confirmationResult = ''; // Initialize outside the function to capture the result

		function displayConfirmationModal(isNo) {
			console.log('Opening confirmation modal for isNo:', isNo);

			// Set up a Bootstrap confirmation modal
			$('#confirmationModal').modal('show');

			// Set up event listener for "Yes" and "No" buttons
			$('#confirmationModal [data-confirmation]').on('click', function() {
				confirmationResult = $(this).data('confirmation');
				$('#confirmationModal').modal('hide'); // Close the confirmation modal
			});
		}

		// Set up event listener for when the confirmation modal is completely hidden
		$('#confirmationModal').on('hidden.bs.modal', function () {
			console.log('Confirmation result:', confirmationResult);

			var isNo = $('.btn-confirm').data('is-no');

			if (confirmationResult === 'yes') {
				// Show the crf_fp modal
				console.log('Showing crf_fp modal for isNo:', isNo);
				$('.crf_fp_' + isNo).modal('show');
			} else {
				// Show the crf_ca modal or handle the "No" case as needed
				console.log('Showing crf_ca modal for isNo:', isNo);
				$('.no_crf_fp_' + isNo).modal('show');
			}
		});

		// Attach click event using jQuery
		$('.btn-confirm').on('click', function() {
			var isNo = $(this).data('is-no');
			displayConfirmationModal(isNo);
		});
	});
</script>

<script>
	// Set the first button as active on page load
	document.getElementById('button1').classList.add('active');
	document.getElementById('pending').style.display = 'block';

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

<script>
	function convertNumberToWords(number) {
		if (number < 0 || number > 999999999) {
			throw new Error("Number is out of range");
		}
		
		const Gn = Math.floor(number / 1000000);
		number -= Gn * 1000000;
		const kn = Math.floor(number / 1000);
		number -= kn * 1000;
		const Hn = Math.floor(number / 100);
		number -= Hn * 100;
		const Dn = Math.floor(number / 10);
		const n = number % 10;
		
		let res = "";
		
		if (Gn) {
			res += convertNumberToWords(Gn) + " Million";
		}
		
		if (kn) {
			res += (res === "" ? "" : " ") + convertNumberToWords(kn) + " Thousand";
		}
		
		if (Hn) {
			res += (res === "" ? "" : " ") + convertNumberToWords(Hn) + " Hundred";
		}
		
		const ones = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];
		
		const tens = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];
		
		if (Dn || n) {
			if (res !== "") {
				res += " and ";
			}
			if (Dn < 2) {
				res += ones[Dn * 10 + n];
			} else {
				res += tens[Dn];
				if (n) {
					res += "-" + ones[n];
				}
			}
		}
		
		if (res === "") {
			res = "zero";
		}
		
		return res;
	}
	
	document.getElementById('amountInput').addEventListener('input', function () {
		var amountInFigures = this.value;
		var amountInWords = convertNumberToWords(parseFloat(amountInFigures));
		document.getElementById('amountWords').value = amountInWords + " Pesos";
	});
</script>

<style type="text/css">
	.inb{
		font-style: italic;
		box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.075);
		border: none;
		border-bottom: 1px solid #cccccc;
	}
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
		font-size: 11px;
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
	.title{
		word-spacing: 4px; letter-spacing: 1px; font-weight: bold; font-size: 14px;color: #2a3f54;
	}
	.request{
		font-family: verdana; text-align: center;font-size: 16px;color:#2a3f54;font-weight:bold
	}
</style>