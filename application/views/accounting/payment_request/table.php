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
			<div class="x_panel animate slideInDown" style="box-shadow: 5px 8px 16px #888888">
				<div class="x_title">
					<h6 class="fa fa-credit-card"> <b>Payment Request</b></h6> 
					<a href="#" onclick="window.history.back()" class="btn btn-xs btn-warning pull-right"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
					<div class="clearfix"></div>
				</div>
				<!--====================TAB NAVIGATION====================-->
				<ul class="nav nav-tabs">
				    <li class="active"><a href="javascript:void(0);" onclick="openTab(event, 'pending', this)">
				    	<i class="fa fa-ellipsis-h"></i><small> <b>Pending</b></small>
				    	<sup>
                            <?php if ($approved_payment1 > 0): ?>
                                <small class="badge_custom bg-red"><?php echo $approved_payment1; ?></small>
                            <?php endif; ?>
                        </sup>
				    </a></li>
				    <li><a href="javascript:void(0);" onclick="openTab(event, 'history', this)">
				    	<i class="fa fa-history"></i><small> <b>History</b></small>
					    <sup>
	                        <?php if ($paid_payment > 0): ?>
	                            <small class="badge_custom bg-red"><?php echo $paid_payment; ?></small>
	                        <?php endif; ?>
	                    </sup>
                    </a></li>
				</ul>

				<div class="col-md-12">
					<!--====================APPROVED====================-->
					<div id="pending" class="tabcontent space">
						<table id="pending_crf_datatable" class="table table-bordered table-hover small" style="border-bottom:2px solid gray;width:100%">
							<thead class="bg-primary">
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
					<!--====================CREATED====================-->
					<div id="history" class="tabcontent space" style="display: none;">
						<table id="history_crf_datatable" class="table table-bordered table-hover small" style="border-bottom:2px solid gray;width:100%">
							<thead class="bg-primary">
								<tr>
									<th>Control #</th>
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
	<?php include 'view_rca_modal.php'; ?>
	<?php include 'view_crf_modal.php'; ?>
</div>
<!--====================END PAGE CONTENT====================-->

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