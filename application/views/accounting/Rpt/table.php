<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container">  
		<div class="col-md-12 col-sm-12 col-xs-12">
			<?php if($this->session->flashdata('notif')){?>
				<div class="alert alert-info alert-dismissible fade in" role="alert" id="saved">
					<i class="glyphicon glyphicon-ok"></i>  <?php echo $this->session->flashdata('notif'); ?>
				</div>
			<?php }?>
			<!--====================BODY====================-->
			<div class="x_panel animate fadeIn" style="box-shadow: 5px 8px 16px #888888"> 
				<center><h5 class="modal-title1">STATEMENT OF ACCOUNT</h5></center>
				<center><h5 class="title_municipality" id="municipality"></h5></center>

				<div class="col-md-12 col-sm-12 col-xs-12">
					<div style="float:left">
						<div class="dropdown">
							<select class="btn btn-primary dropdown-toggle" id="town" name="town" onchange="loadData()" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<option value="">Select Municipality</option>
								<?php 
									$unique_municipalities = array();
									foreach ($municipality as $municipality_item):
										$municipality_name = $municipality_item['municipality'];
										if (!in_array($municipality_name, $unique_municipalities)) {
											$unique_municipalities[] = $municipality_name;
								?>
											<option value="<?php echo $municipality_name; ?>"><?php echo $municipality_name; ?></option>
								<?php } endforeach; ?>
							</select>
						</div>
					</div>

					<div style="float:right">
						<button class="btn btn-primary" data-toggle="modal" data-target=".crf" id="addCrfButton" disabled>ADD CRF</button>
					</div>
				</div>

				<div class="col-md-12">
					<table id="data-table" class="table table-striped table-bordered dt-responsive nowrap table-hover" cellspacing="0" width="100%">
						<thead style="background-color:#225282; color:#FFF">
							<tr>
								<th class="th_ca">PERIOD</th>
								<th class="th_ca">TAX DEC #</th>
								<th class="th_ca">PROPERTY OWNER</th>
								<th class="th_ca">LOCATION</th>
								<th class="th_ca">LOT CLASS</th>
								<th class="th_ca">NET</th>
								<th class="th_ca">ACTION</th>
							</tr>
						</thead>
						<tbody style="text-align:center">
						</tbody>
					</table>
				</div>
			</div> 
			<!--====================END BODY====================-->
		</div>
	</div>
</div>
<!--====================END PAGE CONTENT====================-->

<!--====================CHEQUE REQUEST FORM CASH ADVANCE MODAL====================-->
<div class="modal fade crf modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" id="dclose" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span></button>
				<h5><i class="fa fa-edit"></i> Fill in the Form</h5>
			</div>
			<!--==========BODY==========-->
			<div class="modal-body" style="border-radius: 5px;" > 
				<center><img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
					<h5 style="font-family:Times New Roman">ALTURAS SUPERMARKET CORPORATION</h5>
					<h5 style="margin-top:-8px;font-family:Times New Roman">B. Inting Street, Tagbilaran City</h5>
					<h4 style="margin-top:-8px;font-family:Times New Roman;font-weight:bold;letter-spacing:3px">CHEQUE REQUEST FORM</h4>
				</center>

				<?php 
					$crf_no = "CRF-0001"; // Default value

					if (!empty($crf_id)) {
						$max_id = 0;

						foreach ($crf_id as $ci) {
							$id = (int) substr($ci['crf_no'], 4);
							if ($id > $max_id) {
								$max_id = $id;
							}
						}

						$new_id = $max_id + 1;

						if ($new_id < 10) {
							$crf_no = "CRF-000" . $new_id;
						} elseif ($new_id < 100) {
							$crf_no = "CRF-00" . $new_id;
						} elseif ($new_id < 1000) {
							$crf_no = "CRF-0" . $new_id;
						} else {
							$crf_no = "CRF-" . $new_id;
						}
					}
				?>

				<div class="row">
					<?php echo form_open('Accounting/Rpt/submit_crf_rpt/'); ?>

						<input type="hidden" class="form-control inb" name="townn" id="townn" readonly>

						<div class="col-md-12 col-xs-12 col-sm-12" style="padding-top:15px;">
							<div class="col-md-2 col-xs-2 col-sm-2 " >
								<label>CRF #:</label>
							</div>
							<div class="col-md-5 col-xs-5 col-sm-5 form-inline">
								<input type="text" class="form-control inb" name="crf_no" value="<?php echo $crf_no; ?>" readonly>
							</div>

							<div class="col-md-1 col-xs-1 col-sm-1"></div>

							<div class="col-md-1 col-xs-1 col-sm-1">
								<label>Date:</label>
							</div>
							<div class="col-md-3 col-xs-3 col-sm-3 form-inline">
								<input type="text" class="form-control inb" value="<?php echo date("F d, Y") ?>" name="date_requested" readonly>
							</div>
						</div> 

						<div class=" col-md-12 col-xs-12 col-sm-12">
							<div class="col-md-2 col-xs-2 col-sm-2 " >
								<label>Pay to:</label>
							</div>
							<div class="col-md-10 col-xs-10 col-sm-10" >
								<input  type="text" class="form-control inb" name="pay_to" required>
							</div>
						</div> 

						<div class=" col-md-12 col-xs-12 col-sm-12">
							<div class="col-md-2 col-xs-2 col-sm-2 " >
								<label class="control-label">Amount in Figure:</label> 
							</div>
							<div class="col-md-10 col-xs-10 col-sm-10" >
								<input type="text" class="form-control inb" name="amount" id="amount" required>
							</div>
						</div>

						<div class="div4 col-md-12 col-xs-12 col-sm-12">
							<div class="col-md-2 col-xs-2 col-sm-2 " >
								<label class="control-label">Amount in Words :</label> 
							</div>
							<div class="col-md-10 col-xs-10 col-sm-10" >
								<span class="form-control input_border" name="amount_words" id="amount_words" style="color:#ff6600;font-size:12px"></span>
							</div>
						</div>
									
						<div class="col-md-12 col-xs-12 col-sm-12" style="text-align:center;padding-top:10px">
							<div class="col-md-2 col-sm-2 col-xs-2"></div>
							<div class="col-md-4 col-sm-4 col-xs-4">
								<input type="text" class="form-control inb"  name="bank" style="text-align:center" required>
								<label>Bank</label> 
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3">
								<input type="text" class="form-control inb" name="cheque_no" style="text-align:center" required>
								<label>Cheque No.</label> 
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3">
								<input type="date" class="form-control inb" value="<?php echo date("F d, Y"); ?>" name="cheque_date" style="text-align:center" required>
								<label class="control-label">Cheque Date</label> 
							</div>
						</div>

						<div class="div6 col-md-12 col-xs-12 col-sm-12" style="padding-top:20px">
							<div class="col-md-2 col-xs-2 col-sm-2 " >
								<label>Particulars:</label> 
							</div>
							<div class="col-md-10 col-xs-10 col-sm-10" >
								<textarea type="text" class="form-control" id="autoresizing" name="particular"  style="max-width:100%;height:150px;text-align:justify"></textarea>
							</div>
						</div>
						
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
					<button type="submit" name="submit_crf" class="btn btn-sm btn-primary"> Submit</button>
				</div>         
			</form>
			<!--==========BODY==========-->
		</div>
	</div>
</div>
<!--====================END CHEQUE REQUEST FORM CASH ADVANCE MODAL====================-->

<script>
	function loadData() {
		var selectedMunicipality = document.getElementById("town").value;

		if (selectedMunicipality) {
			$("#addCrfButton").prop("disabled", false);
		}else{
			$("#addCrfButton").prop("disabled", true);
		}

		// Check if "Select Municipality" is chosen
		if (!selectedMunicipality) {
			updateTable([]);
			updateMunicipalityHeader("");
		} else {
			$.ajax({
				type: "GET",
				url: "<?php echo base_url('Accounting/Rpt/getDataForMunicipality'); ?>" + "/" + selectedMunicipality,
				dataType: 'json',
				success: function (data) {
					updateTable(data);
					updateMunicipalityHeader(selectedMunicipality);
				},
				error: function (xhr, status, error) {
				}
			});
		}
	}

	//Display Data in table
	function updateTable(data) {
		$("#data-table tbody").empty();

		if (data.length > 0) {
			for (var i = 0; i < data.length; i++) {
				var start_year = new Date(data[i].start_date).getFullYear();
				var end_year = new Date(data[i].end_date).getFullYear();
				var yearDisplay = start_year === end_year ? start_year : start_year + "-" + end_year;

				var row = "<tr>" +
										"<td>" + yearDisplay + "</td>" +
										"<td>" + data[i].tax_dec_no + "</td>" +
										"<td>" + data[i].firstname + " " + data[i].middlename + " " + data[i].lastname + "</td>" +
										"<td>" + data[i].baranggay + "</td>" +
										"<td>" + data[i].lot_type + "</td>" +
										"<td>" + data[i].amount + "</td>" +
										"<td><button onclick='viewImage(\"" + data[i].is_no + "\", \"" + data[i].rpt_file + "\", \"" + data[i].start_date + "\", \"" + data[i].end_date + "\")'><i class='fa fa-eye' style='color: #225282;'></i> View</button></td>" +
									"</tr>";
				$("#data-table tbody").append(row);
			}
		} else {
			var noDataRow = "<tr><td colspan='7'><center><code>No Data!</code></center></td></tr>";
			$("#data-table tbody").append(noDataRow);
		}
	}
	//End Display Data in table

	//Change Municipality Header depend on selection
	function updateMunicipalityHeader(selectedMunicipality) {
		if (!selectedMunicipality) {
			$('#municipality').text("");
		} else {
			$('#municipality').text(selectedMunicipality + ', <?php echo $municipality[0]['province']; ?>');
			$('#townn').val(selectedMunicipality);
		}
	}
	//End Change Municipality Header depend on selection

	//View modal with the image
	const viewImage = (is_no, rpt_file, start_date, end_date) => {
		var encodedStartDate = encodeURIComponent(start_date);
		var encodedEndDate = encodeURIComponent(end_date);

		var base_url = "<?php echo base_url(); ?>";
		var imagePath = base_url + "assets/img/rpt/" + is_no + "/tax_computation/" + encodedStartDate + "%20to%20" + encodedEndDate + "/" + rpt_file;

		$.ajax({
			url: imagePath,
			type: 'HEAD',
			error: function () {
				alert("Image not found");
			},
			success: function () {
				let item = [{
					src: imagePath,
					title: 'View Real Property Tax Billing'
				}];
				let options = {
					index: 0
				};
				let photoviewer = new PhotoViewer(item, options);
			}
		});
	};
	//End View modal with the image
</script>

<!--Convert Amount to words-->
<script>
	$(document).ready(function () {
		$('#amount').on('input', function () {
			var amount = $('#amount').val();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url("Accounting/Rpt/convert_number"); ?>',
				data: { amount: amount },
				success: function (result) {
					$('#amount_words').html(result);
				}
			});
		});
	});
</script>
<!--End Convert Amount to words-->