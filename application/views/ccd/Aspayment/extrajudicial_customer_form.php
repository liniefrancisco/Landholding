<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!--====================FLASH DATA====================-->
			<?php if($this->session->flashdata('notif')){?>
		        <div class="alert alert-success alert-dismissible fade in" role="alert" id="saved">
		          <i class="glyphicon glyphicon-ok"></i>  <?php echo $this->session->flashdata('notif'); ?>
		        </div>
		    <?php } ?>
			<!--====================END FLASH DATA====================-->

			<!--====================START CONTENT====================-->
			<div class="x_panel animate fadeIn" style="box-shadow: 5px 8px 16px #888888">
				<div class="x_title">
					<h2 class="fa fa-bank"> <b>Aspayment</b></h2>
					<div class="pull-right">
						<form action="<?= base_url('Aspayment/cancel_es_entry/' . $es_no); ?>" onsubmit="return confirm('Are you sure to cancel this Entry?');" method="POST">
							<button type="submit" class="btn btn-warning escus_cancel" name="es_cancel" style="background-color: #e65c00;"><i class="glyphicon glyphicon-floppy-remove"></i> Cancel</button>
						</form>
					</div>
					<div class="clearfix"></div>
				</div>

				<?php echo form_open_multipart('Aspayment/extrajudicial_customer_info/' . $es_no, array('id' => 'add_custom')); ?>
					<div class="x_panel" style="border-radius:10px;">
						<div class="row text-center space" style="border-top:1px solid #ff6600; border-bottom:1px solid #ff6600;">
	                        <h5 style="letter-spacing:5px;">CUSTOMER BALANCE INFORMATION</h5>
	                    </div>

						<div class="col-md-12 col-sm-12 col-xs-12 space">
							<div class="col-md-3"><label>Type:</label></div>
							<div class="col-md-4 col-sm-4 col-xs-4">
								<label class="r-contain">
									<input type="radio" value="Bounced Check" name="balance_type" <?php if (@$_POST['balance_type'] == "Bounced Check") { echo "checked";
										} ?> required>Bounced Check 
									<span class="checkmark"></span>
								</label>
							</div>
							<div class="col-md-5 col-sm-5 col-xs-5">
								<label class="r-contain">
									<input type="radio" value="Bad Account" name="balance_type" <?php if (@$_POST['balance_type'] == "Bad Account") { echo "checked"; } ?> required>Bad Account 
									<span class="checkmark"></span>
								</label>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 space">
							<div class="col-md-3"><label>Business Unit:</label></div>
							<div class="col-md-9 col-sm-9 col-xs-9">
								<input class="form-control" type="text" name="business_unit" value="<?php if (isset($_POST['business_unit'])) { echo $_POST['business_unit']; } ?>" required>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 space">
							<div class="col-md-3"><label>Customer Name:</label></div>
							<div class="col-md-3 col-sm-3 col-xs-3">
								<input class="form-control text-center" type="text" name="customer_fname" value="<?php if (isset($_POST['customer_fname'])) { echo $_POST['customer_fname']; } ?>" required>
								<h6 class="text-center"><i>Firstname</i></h6>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3">
								<input class="form-control text-center" type="text" name="customer_mname" value="<?php if (isset($_POST['customer_mname'])) { echo $_POST['customer_mname']; } ?>" required>
								<h6 class="text-center"><i>Middlename</i></h6>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3">
								<input class="form-control text-center" type="text" name="customer_lname" value="<?php if (isset($_POST['customer_lname'])) { echo $_POST['customer_lname']; } ?>" required>
								<h6 class="text-center"><i>Lastname</i></h6>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 space">
							<div class="col-md-3"><label>Customer Address:</label></div>
							<div class="col-md-3 col-sm-3 col-xs-3">
								<select class="form-control text-center" id="region" name="customer_region" onchange="loadProvince()" required>
									<option value="">Select Region</option>
								</select>
								<h6 class="text-center"><i>Region</i></h6>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3">
								<select class="form-control text-center" id="province" name="customer_province" onchange="loadCity()" required>
									<option value="">Select Province</option>
								</select>
								<h6 class="text-center"><i>Province</i></h6>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3">
								<select class="form-control text-center" id="municipality" name="customer_municipality" onchange="loadBrgy()" required>
									<option value="">Select City</option>
								</select>
								<h6 class="text-center"><i>City/Municipality</i></h6>
							</div>

							<div class="col-md-3 col-sm-3 col-xs-3"></div>

							<div class="ccol-md-3 col-sm-3 col-xs-3">
								<select class="form-control text-center" id="barangay" name="customer_barangay" required>
									<option value="">Select Barangay</option>
								</select>
								<h6 class="text-center"><i>Barangay</i></h6>
							</div>
							<div class="ccol-md-3 col-sm-3 col-xs-3">
								<input type="text" class="form-control text-center" name="customer_street" value="<?php echo set_value('street') ?>" required>
								<h6 class="text-center"><i>Street</i></h6>
							</div>
							<div class="ccol-md-3 col-sm-3 col-xs-3">
								<input type="text" class="form-control text-center" name="customer_zip_code" id="zip_code" value="<?php echo set_value('zip_code') ?>" required readonly>
								<h6 class="text-center"><i>Zip Code</i></h6>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 space">
							<div class="col-md-3"><label>Please upload the following documents:</label></div>
							<div class="col-md-3">
								<label>Turnover of doubtful account form folder</label>
								<span class='label label-info file-name-label-da' id="file-name-da"></span>
								<label class="btn btn-default">
									<input type="file" class="form-control" name="doubtful_account" onchange="ValidateDoubtfulAccount(this);$('#file-name-da').html(this.files[0].name)" style="display: none;">
									<span class="fa fa-file-image-o"></span> Select File
								</label>
								<code id="rmsg-da">*required</code>
							</div>

							<div class="col-md-3">
								<label>Latest SOA Folder</label><br>
								<span class='label label-info file-name-label-ls' id="file-name-ls"></span>
								<label class="btn btn-default">
									<input type="file" class="form-control" name="latest_soa" onchange="ValidateLatestSoa(this);$('#file-name-ls').html(this.files[0].name)" style="display: none;">
									<span class="fa fa-file-image-o"></span> Select File
								</label>
								<code id="rmsg-ls">*required</code>
							</div>

							<div class="col-md-2">
								<label>Supporting Documents Folder</label>
								<span class='label label-info file-name-label-sd' id="file-name-sd"></span>
								<label class="btn btn-default">
									<input type="file" class="form-control" name="supporting_docs" onchange="ValidateSupportingDocuments(this);$('#file-name-sd').html(this.files[0].name)" style="display: none;">
									<span class="fa fa-file-image-o"></span> Select File
								</label>
								<code id="rmsg-sd">*required</code>
							</div>
						</div>
					</div>
					<div class="row pull-right">
						<input type="submit" name="submit" class="btn btn-custom-primary submit" value="Submit">
					</div>
				</form>
			</div>
			<!--====================END CONTENT====================-->
		</div>
	</div>
</div>
<!--====================END PAGE CONTENT====================-->

<script type="text/javascript">//Load Lot Location
    function loadRegion() {//Load Region
        $.ajax({
            url: "<?php echo site_url("Aspayment/getregion") ?>",
            method: "POST",
            dataType: "json",
            success: function (data) {
                $('#region').empty().append('<option value="">Select Region</option>');
                data.forEach(region => {
                    $('#region').append(`<option value="${region.regCode}">${region.regDesc}</option>`);
                });
            },
            error: function (xhr, status, error) {
                console.error("Error loading regions:", xhr.responseText);
            }
        });
    }
    loadRegion();
    function loadProvince() {//Load Province
        let regCode = $("#region").val();
        if (!regCode) {
            $("#province").html('<option value="">Select Province</option>');
            return;
        }

        $.ajax({
            url: "<?php echo site_url("Aspayment/getprovince") ?>",
            method: "POST",
            dataType: "json",
            data: { regCode: regCode },
            success: function (data) {
                $('#province').empty().append('<option value="">Select Province</option>');
                data.forEach(province => {
                    $('#province').append(`<option value="${province.provCode}">${province.provDesc}</option>`);
                });
            },
            error: function (xhr, status, error) {
                console.error("Error loading provinces:", xhr.responseText);
            }
        });
    }
    function loadCity() {//Load Municipality
        let provCode = $("#province").val();

        if (!provCode) {
            $("#municipality").html('<option value="">Select City/Municipality</option>');
            $("#zip_code").val("");
            return;
        }

        $.ajax({
            url: "<?php echo site_url("Aspayment/getcitymun") ?>",
            method: "POST",
            dataType: "json",
            data: { provCode: provCode },
            success: function (data) {
                $('#municipality').empty().append('<option value="">Select City/Municipality</option>');
                $.each(data, function(i, data) {
                    var cityName = data.citymunDesc.split(' ')[0];
                    $('#municipality').append('<option value="' + data.citymunCode + '|' + cityName + '|' + data.zipcode + '">' + cityName + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error("Error loading cities:", xhr.responseText);
            }
        });
        $("#municipality").on("change", function() {
            let selectedOption = $(this).val();
            if (selectedOption) {
                let parts       = selectedOption.split('|');
                let cityName    = parts[1];
                let zipcode     = parts[2];

                $("#zip_code").val(zipcode);
            } else {
                $("#zip_code").val('');
            }
        });
    }
    function loadBrgy() {//Load Barangay
        let selectedOption = $("#municipality").val();
        if (!selectedOption) {
            $("#barangay").html('<option value="">Select Barangay</option>');
            return;
        }
        let citymunCode = selectedOption.split('|')[0]; // Extract only the citymunCode

        $.ajax({
            url: "<?php echo site_url("Aspayment/getbrgy") ?>",
            method: "POST",
            dataType: "json",
            data: { citymunCode: citymunCode },
            success: function (data) {
                $('#barangay').empty().append('<option value="">Select Barangay</option>');
                data.forEach(brgy => {
                    $('#barangay').append(`<option value="${brgy.brgyCode}">${brgy.brgyDesc}</option>`);
                });
            },
            error: function (xhr, status, error) {
                console.error("Error loading barangays:", xhr.responseText);
            }
        });
    }
</script>

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function (event) {
		document.querySelector('.submit').addEventListener("click", function () {
			window.btn_clicked = true;
		});

		var $form 	= $('#add_custom'),
		origForm 	= $form.serialize();
		$('#add_custom :input').on('change input', function () {
			if ($form.serialize() !== origForm) {
				window.onbeforeunload = function () {
					if (!window.btn_clicked) { //was not clicked
						return 'Changes you made not be saved!';
					}
				};
			}
		});
	});


	var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];
	function ValidateDoubtfulAccount(oInput) {
		var sFileName = oInput.files[0].name;
		if (oInput.type == "file") {
			if (sFileName.length > 0) {
				var blnValid = false;
				for (var j = 0; j < _validFileExtensions.length; j++) {
					var sCurExtension = _validFileExtensions[j];
					if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
						$('.file-name-label-da').css('display', 'block');
						$("#rmsg-da").hide();
						blnValid = true;
						break;
					}
				}
				if (!blnValid) {
					alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
					oInput.value = "";
					$("#file-name-da").hide();
					$("#rmsg-da").show();
					return false;
				}
			}
		}
		return true;
	}

	function ValidateLatestSoa(oInput) {
		var sFileName = oInput.files[0].name;
		if (oInput.type == "file") {
			if (sFileName.length > 0) {
				var blnValid = false;
				for (var j = 0; j < _validFileExtensions.length; j++) {
					var sCurExtension = _validFileExtensions[j];
					if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
						$('.file-name-label-ls').css('display', 'block');
						$("#rmsg-ls").hide();
						blnValid = true;
						break;
					}
				}
				if (!blnValid) {
					alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
					oInput.value = "";
					$("#file-name-ls").hide();
					$("#rmsg-ls").show();
					return false;
				}
			}
		}
		return true;
	}

	function ValidateSupportingDocuments(oInput) {
		var sFileName = oInput.files[0].name;
		if (oInput.type == "file") {
			if (sFileName.length > 0) {
				var blnValid = false;
				for (var j = 0; j < _validFileExtensions.length; j++) {
					var sCurExtension = _validFileExtensions[j];
					if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
						$('.file-name-label-sd').css('display', 'block');
						$("#rmsg-sd").hide();
						blnValid = true;
						break;
					}
				}
				if (!blnValid) {
					alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
					oInput.value = "";
					$("#file-name-sd").hide();
					$("#rmsg-sd").show();
					return false;
				}
			}
		}
		return true;
	}
</script>

<style type="text/css">
	table{
		border-collapse: collapse;
	}
	table,td,th{
		border: 1px solid black;
	}
	th{
		text-align: center;
	}
	.autocomplete-items {
		margin-top: -30px;
	}
	.file-name-label-da {
		overflow: hidden;
		text-overflow: ellipsis;
		width: 150px;
		height: 14px;
		margin-bottom: 10px;
		display: block;
	}
	.file-name-label-ls {
		overflow: hidden;
		text-overflow: ellipsis;
		width: 150px;
		height: 14px;
		margin-bottom: 10px;
		display: block;

	}
	.file-name-label-sd {
		overflow: hidden;
		text-overflow: ellipsis;
		width: 150px;
		height: 14px;
		margin-bottom: 10px;
		display: block;

	}
</style>