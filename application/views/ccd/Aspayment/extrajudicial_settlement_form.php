<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissible fade in" role="alert" style="position: fixed; bottom: 10px; right: 10px; z-index: 99; cursor: pointer;" id="saved">
		<?php echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'. validation_errors('<i class="fa fa-remove"></i> ');?>
	</div>
<?php } ?>
<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!--====================FLASH DATA====================-->
			<?php if($this->session->flashdata('notif')){?>
				<div class="alert alert-success alert-dismissible fade in" role="alert" id="saved">
					<i class="glyphicon glyphicon-ok"></i> <?php echo $this->session->flashdata('notif'); ?>
				</div>
			<?php } ?>
			<?php if($this->session->flashdata('error')){?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert" id="saved">
					<i class="fa fa-warning"></i> <?php echo $this->session->flashdata('error'); ?>
				</div>
			<?php } ?>
			<!--====================END FLASH DATA====================-->
			
			<!--====================START CONTENT====================-->
			<div class="x_panel animate  fadeInLeft" style="box-shadow: 5px 8px 16px #888888">
				<div class="x_title">
                    <h2 class="fa fa-bank" style="font-size:15px;"> <b>Settlement</b></h2>
                    <div style="float:right;color: #2a3f54;">
                        <a type="a" href="<?= base_url() ?>" class="btn btn-custom-warning btn-hover btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <div class="clearfix"></div>
                </div>

				<?php 
					$es_id= 0;
					if(empty($es_no)){
						$es_no = "ES-0001";
					}
					foreach ($extra as $key => $value) {
						$es_id = substr($value['is_no'],4)+1; 
						if(strlen($es_id) == 1){
							$es_no = "ES-000".$es_id;
						}elseif(strlen($es_id) == 2){
							$es_no = "ES-00".$es_id;
						}elseif(strlen($es_id) == 3){
							$es_no = "ES-0".$es_id;
						}else{
							$es_no = "ES-".$es_id;
						}      
					} 
				?>

				<?php echo form_open_multipart('Ccd/aspayment/extrajudicial', array('id' => 'add_lot'));?>
					<input type="hidden" value="OCT" name="oct_folder">
					<input type="hidden" value="TCT" name="tct_folder">

					<div class="x_panel" style="border-radius:10px;">
						<center class="space">
							<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
							<h4><b>LAND AS PAYMENT FORM - EXTRAJUDICIAL SETTLEMENT (LAPF-ES)</b></h4>
						</center>

						<div class="col-md-12 col-sm-12 col-xs-12 space">
							<div class="col-md-4 col-sm-4 col-xs-4 form-inline">
								<label>LAPF-ES #:</label>
								<input class="form-control input_border" type="text" name="es_no" value="<?php echo $es_no; ?>" readonly>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-4 form-inline pull-right">
								<label>Date:</label>
								<input type="text" class="form-control input_border" id="date" name="date" readonly>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 space" style="border-top:1px solid #ff6600; border-bottom:1px solid #ff6600;">
							<center><h5 style="letter-spacing: 10px;"><b>LAND INFORMATION</b></h5></center>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 space">
                            <div class="col-md-4 col-xs-4 col-sm-4 form-inline">
                                <label>Lot :</label>
                                <input class="form-control input_border" type="text" name="lot" value="<?php if (isset($_POST['lot'])) { echo $_POST['lot'];} ?>" required>
                            </div>
                            <div class="col-md-4 col-sm-4  col-xs-4 form-inline pull-right">
                                <label>Cad :</label>
                                <input class="form-control input_border" type="text" name="cad" value="<?php if (isset($_POST['cad'])) { echo $_POST['cad'];} ?>" required>
                            </div>
                        </div>

						<div class="col-md-12 col-sm-12 col-xs-12 space">
							<div class="col-md-3 col-sm-3 col-xs-3 lot_type" style="height: 29px;"><label>Lot Type:</label></div>
							<div class="col-md-3 col-sm-3 col-xs-3 lot_type">
								<label class="r-contain">
									<input type="radio" name="lot_type" value="Agricultural" <?php if(@$_POST['lot_type'] == "Agricultural"){ echo "checked"; } ?> required>Agricultural 
									<span class="checkmark"></span>
								</label>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3 lot_type">
								<label class="r-contain">
									<input type="radio" name="lot_type" value="Commercial" <?php if(@$_POST['lot_type'] == "Commercial"){ echo "checked"; } ?> required> Commercial 
									<span class="checkmark"></span>
								</label>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3 lot_type">
								<label class="r-contain">
									<input type="radio" name="lot_type" value="Residential" <?php if(@$_POST['lot_type'] == "Residential"){ echo "checked"; } ?> required> Residential 
									<span class="checkmark"></span>
								</label>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 space">
							<div class="col-md-3 col-sm-3 col-xs-3"><label>Lot Owner:</div>
							<div class="col-md-3 col-sm-3 col-xs-3">
								<input type="text" name="lot_fname" value="<?php if(isset($_POST['lot_fname'])){ echo $_POST['lot_fname']; } ?>" class="form-control input_border name_center" required>
								<h6 class="name_center"><i>Firstname</i></h6>
							</div>

							<div class="col-md-3 col-sm-3 col-xs-3">
								<input type="text" name="lot_mname" value="<?php if(isset($_POST['lot_mname'])){ echo $_POST['lot_mname']; } ?>" class="form-control input_border name_center" required>
								<h6 class="name_center"><i>Middlename</i></h6>
							</div>

							<div class="col-md-3 col-sm-3 col-xs-3">
								<input type="text" name="lot_lname" value="<?php if(isset($_POST['lot_lname'])){ echo $_POST['lot_lname']; } ?>" class="form-control input_border name_center" required>
								<h6 class="name_center"><i>Lastname</i></h6>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 space">
                            <div class="col-md-4 col-sm-4 col-xs-4"><label>Gender:</label></div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <label>
                                    <input type="radio" name="gender" value="Male" required <?php if(@$_POST['gender'] == "Male"){ echo "checked"; } ?>>
                                    <label class="control-label">Male</label>
                                </label>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <label>
                                    <input type="radio" name="gender" value="Female" required <?php if(@$_POST['gender'] == "Female"){ echo "checked"; } ?>>
                                    <label class="control-label">Female</label>
                                </label>
                            </div>
                        </div>

						<div class="col-md-12 col-sm-12 col-xs-12 space">
							<div class="col-md-4 col-sm-4 col-xs-4"><label>Vital Status:</label></div>
							<div class="col-md-4 col-sm-4 col-xs-4">
								<label class="r-contain">
									<input type="radio" name="vital_status" value="Alive" <?php if(@$_POST['vital_status'] == "Alive"){ echo "checked"; } ?> required> Alive 
									<span class="checkmark"></span>
								</label>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-4">
								<label class="r-contain">
									<input type="radio" name="vital_status" value="Deceased" <?php if(@$_POST['vital_status'] == "Deceased"){ echo "checked"; } ?> required> Deceased 
									<span class="checkmark"></span>
								</label>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 space">
							<div class="col-md-3 col-sm-3 col-xs-3"><label>Lot Location:</div>
								<div class="col-md-3 col-sm-3 col-xs-3">
									<select class="form-control input_border txt_cent" id="lot_region" name="lot_region" onchange="loadProvince()" required>
										<option value="">Select Region</option>
									</select>
									<input type="hidden" id="selected_lot_region" name="selected_lot_region" readonly>
									<h6 class="name_center"><i>Region</i></h6>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-3">
									<select class="form-control input_border txt_cent" id="lot_province" name="lot_province"  onchange="loadCity()" required>
										<option value="">Select Province</option>
									</select>
									<input type="hidden" id="selected_lot_province" name="selected_lot_province" readonly>
									<h6 class="name_center"><i>Province</i></h6>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-3">
									<select class="form-control input_border txt_cent" id="lot_town" name="lot_town" onchange="loadBrgy()" required>
										<option value="">Select City</option>
									</select>
									<input type="hidden" id="selected_lot_town" name="selected_lot_town" readonly>
									<h6 class="name_center"><i>City/Municipality</i></h6>
								</div>

								<div class="col-md-3 col-sm-3 col-xs-3"></div>

								<div class="ccol-md-3 col-sm-3 col-xs-3">
									<select class="form-control input_border txt_cent" id="lot_barangay" name="lot_barangay" required>
										<option value="">Select Barangay</option>
									</select>
									<input type="hidden" id="selected_lot_barangay" name="selected_lot_barangay" readonly>
									<h6 class="name_center"><i>Barangay</i></h6>
								</div>

								<div class="ccol-md-3 col-sm-3 col-xs-3">
									<input type="text" class="form-control input_border txt_cent" name="lot_street" id="lot_street" value="<?php echo set_value('lot_street') ?>" required>
									<h6 class="name_center"><i>Street</i></h6>
								</div>

								<div class="ccol-md-3 col-sm-3 col-xs-3">
									<input type="text" class="form-control input_border txt_cent" name="lot_zip_code" id="lot_zip_code" value="<?php echo set_value('lot_zip_code') ?>" required>
									<h6 class="name_center"><i>Zipcode</i></h6>
								</div>
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 space">
								<div class="col-md-4 col-sm-4 col-xs-4"><label>Lot for payment:</label></div>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<label class="r-contain">
										<input type="radio" name="lot_s" value="Portion" <?php if(@$_POST['lot_s'] == "Portion"){ echo "checked"; } ?> required> Portion 
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<label class="r-contain">
										<input type="radio" name="lot_s" value="Whole" <?php if(@$_POST['lot_s'] == "Whole"){ echo "checked"; } ?> required> Whole 
										<span class="checkmark"></span>
									</label>
								</div>
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 space">
	                            <div class="col-md-3 col-sm-3 col-xs-3 form-inline"><label>Lot Size:</label> </div>
	                            <div class="col-md-4 col-sm-4 col-xs-4 form-inline">
	                                <input type="text" value="<?php if(isset($_POST['lot_size'])){ echo $_POST['lot_size']; } ?>" name="lot_size" class="form-control input_border" id="lotsize" required>
									<label>sq/m</label>
	                            </div>
	                        </div>

							<div class="col-md-12 col-sm-12 col-xs-12 space">
								<div class="col-md-4 col-sm-4 col-xs-4">
									<label>Available Proof of Title/Ownership:</label>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<label class="r-contain">
										<input type="radio" name="proof_title" value="oct" class="proof" required> Original Certificate of Title (OCT) 
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<label class="r-contain">
										<input type="radio" name="proof_title" value="tct" class="proof" required> Transfer Certificate of Title (TCT) 
										<span class="checkmark"></span>
									</label>
								</div>
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 space">
								<div class="col-md-4 col-sm-4 col-xs-4"></div>
								<div class="col-md-4 col-sm-4 col-xs-4" id="oct">
									<span class='label label-info file-name-label-oct' id="upload-oct"></span>
									<label class="btn btn-default" for="oct_file" id="oct_button"
										<?php if(@$_POST['available_proof'] == "oct"){ echo ''; }else{ echo 'style="display: none;"'; } ?>>
										<input type="file" name="oct" class="form-control" id="oct_file" onchange="ValidateSingleInput(this);$('#upload-oct').html(this.files[0].name)" style="display: none;">
										<span class="fa fa-file-image-o"></span> Select File
									</label>
									<i style="color: red; display: none;" id="rmsg-oct">*required</i>
								</div>

								<div class="col-md-4 col-sm-4 col-xs-4" id="tct">
									<span class='label label-info file-name-label-tct' id="upload-tct"></span>
									<label class="btn btn-default" for="tct_file" id="tct_button"
										<?php if(@$_POST['available_proof'] == "tct"){ echo ''; }else{ echo 'style="display: none;"'; } ?>>
										<input type="file" name="tct" class="form-control" id="tct_file" onchange="ValidateSingleInput(this);$('#upload-tct').html(this.files[0].name)" style="display: none;">
										<span class="fa fa-file-image-o"></span> Select File
									</label>
									<i style="color: red; display: none;" id="rmsg-tct">*required</i>
								</div>
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 space">
								<label>Land Value:</label>
								<center>
									<table class="table">
										<tr>
											<th>BASIS</th>
											<th>AMOUNT</th>
										</tr>
										<tr>
											<td>MV from Latest Tax Declaration</td>
											<td class="form-inline">₱ 
												<input type="text" name="mv_tax" value="<?php if(isset($_POST['mv_tax'])){ echo $_POST['mv_tax']; } ?>" class="form-control" id="mv_ltd" required>
											</td>
										</tr>
										<tr>
											<td>Neighboring Inquiry</td>
											<td class="form-inline">₱ 
												<input type="text" name="neighbor_inq" value="<?php if(isset($_POST['neighbor_inq'])){ echo $_POST['neighbor_inq']; } ?>" class="form-control" id="neigh_inq" required>
											</td>
										</tr>
										<tr>
											<td>Assessor</td>
											<td class="form-inline">₱ 
												<input type="text" name="assessor" value="<?php if(isset($_POST['assessor'])){ echo $_POST['assessor']; } ?>" class="form-control" id="assessor" required>
											</td>
										</tr>
										<tr>
											<td>Banks</td>
											<td class="form-inline">₱ 
												<input type="text" name="banks" value="<?php if(isset($_POST['banks'])){ echo $_POST['banks']; } ?>" class="form-control" id="banks" required>
											</td>
										</tr>
										<tr>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>Final Land Value</td>
											<td class="form-inline">₱ 
												<input type="text" name="final_value" value="<?php if(isset($_POST['final_value'])){ echo $_POST['final_value']; } ?>" class="form-control" id="final_val" required>
											</td>
										</tr>
									</table>
								</center>
							</div>
						</div>
						<div style="float: right">
							<a href="<?php echo base_url('') ?>" class="btn btn-default">Cancel</a>
							<input type="submit" name="" class="btn btn-custom-primary send" value="Proceed">
						</div>
					</div>
				</form>
			</div>
			<!--====================END START CONTENT====================-->
		</div>
	</div>
</div>
<!--====================END PAGE CONTENT====================-->


<script>
    $(function() {
        $("#date").datepicker({
            dateFormat: 'mm/dd/yy',
        });

        // Set current date
        var d = new Date();
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var output = (month < 10 ? '0' : '') + month + '/' + (day < 10 ? '0' : '') + day + '/' + d.getFullYear();
        $("#date").val(output);
    });
</script>

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(event) {
		$('#ozipcode').on('keydown', function(event) {
			if ($(this).val().length >= 4 && event.key !== 'Backspace') {
				event.preventDefault();
			}
			if (/^[a-zA-Z]$/.test(event.key)) {
				event.preventDefault();
			}
			if (/^[!@#$%^&*()\-_=+[\]{};':."\\|,<>/?`~]$/.test(event.key)) {
				event.preventDefault();
			}
			if (/\s/.test(event.key)) {
				event.preventDefault();
			}
		});

		//AVAILABLE PROOF OF TITLE/OWNERSHIP JQUERY
		$(".proof").click(function() {
			var a = $(this).attr("value");
			var oct_in = $("#oct_file").val();
			var tct_in = $("#tct_file").val();

			if (a == "oct") {
				$("#oct_button").show();
				$("#tct_button").hide();
				$("#rmsg-tct").hide();
				$(".file-name-label-tct").hide();
				if (oct_in) {
					$("#rmsg-oct").hide();
				} else {
					$("#rmsg-oct").show();
				}

				$("#oct_file").prop('required', true);
				$("#tct_file").prop('required', false);

				$('#tct_file').val('');
			} else {
				$("#tct_button").show();
				$("#oct_button").hide();
				$("#rmsg-oct").hide();
				$(".file-name-label-oct").hide();
				if (tct_in) {
					$("#rmsg-tct").hide();
				} else {
					$("#rmsg-tct").show();
				}

				$("#tct_file").prop('required', true);
				$("#oct_file").prop('required', false);

				$('#oct_file').val('');
			}
		});
		//AVAILABLE PROOF OF TITLE/OWNERSHIP JQUERY

		document.querySelector('.send').addEventListener("click", function() {
			window.btn_clicked = true;
		});

		var $form = $('#add_lot'),
		origForm = $form.serialize();

		$('#add_lot :input').on('change input', function() {
			if ($form.serialize() !== origForm) {
				window.onbeforeunload = function() {
					if (!window.btn_clicked) { //was not clicked
						return 'Changes you made not be saved!';
					}
				};
			}
		});

		$('#otown').on('change', function() {
			const selected_op = $('#otown').find('option:selected');
			$('#ozipcode').val(selected_op.data('zipcode'));
		});
	});

	var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];

	function ValidateSingleInput(oInput) {
		var sFileName = oInput.files[0].name;
		var oct_in = $("#oct_file").val();
		var tct_in = $("#tct_file").val();
		if (oInput.type == "file") {
			if (sFileName.length > 0) {
				var blnValid = false;
				for (var j = 0; j < _validFileExtensions.length; j++) {
					var sCurExtension = _validFileExtensions[j];
					if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
						if (oct_in) {
							$(".file-name-label-oct").show();
							$("#rmsg-oct").hide();
						} else {
							$("#rmsg-tct").hide();
							$(".file-name-label-tct").show();
						}
						blnValid = true;
						break;
					}
				}

				if (!blnValid) {
					alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
					oInput.value = "";
					if (oct_in) {
						$("#rmsg-oct").show();
						$(".file-name-label-oct").hide();
					} else {
						$("#rmsg-tct").show();
						$(".file-name-label-tct").hide();
					}
					return false;
				}
			}
		}
		return true;
	}
</script>

<!--====================LOT LOCATION====================-->
<script>
    function loadRegion() {
        $.ajax({
            url: "<?php echo site_url("Ccd/Aspayment/getregion") ?>",
            method: "POST",
            success: function(data) {
                var jObj = JSON.parse(data);
                for (var c = 0; c < jObj.length; c++) {
                    $('#lot_region').append('<option value="' + jObj[c].regCode + '|' + jObj[c].regDesc + '">' + jObj[c].regDesc + '</option>');
                }
            }
        });
    }
    loadRegion();

    function loadProvince() {
        // Clear the province, city, barangay fields when changing the region
        $("#lot_province").html(""); // Clear the province dropdown
        $("#lot_town").html("");
        $("#lot_barangay").html("");
        $("#selected_lot_region").val(""); // Clear the hidden input field

        var reg = $("#lot_region").val();
        var r = reg.split("|");
        var regCode = r[0];
        var regDesc = r[1];

        // Save only the region description in the hidden input field
        $("#selected_lot_region").val(regDesc);

        // Append the "Select Province" option to the province dropdown
        $('#lot_province').append('<option value="">Select Province</option>');

        $.ajax({
            url: "<?php echo site_url("Ccd/Aspayment/getprovince") ?>",
            method: "POST",
            dataType: 'json',
            data: {
                regCode: regCode
            },
            success: function (data) {
                $.each(data, function (i, data) {
                    $('#lot_province').append('<option value="' + data.provCode + '|' + data.provDesc + '">' + data.provDesc + '</option>');
                });
            }
        });
    }

    function loadCity() {
        $("#lot_town").html("");
        $("#lot_town").append('<option value="">Select City/Municipality</option>');
        $("#selected_lot_town").val(""); // Clear the hidden input field

        var prov = $("#lot_province").val();
        var p = prov.split("|");
        var provCode = p[0];
        var provDesc = p[1];

        // Save only the province description in the hidden input field
        $("#selected_lot_province").val(provDesc);

        $.ajax({
            url: "<?php echo site_url("Ccd/Aspayment/getcitymun") ?>",
            method: "POST",
            dataType: 'json',
            data: {
                provCode: provCode
            },
            success: function(data) {
                $.each(data, function(i, data) {
                    var cityName = data.citymunDesc.split(' ')[0];
                    $('#lot_town').append('<option value="' + data.citymunCode + '|' + cityName + '|' + data.zipcode + '">' + cityName + '</option>');
                });
            }
        });

        // Additional code to handle city selection
        $("#lot_town").on("change", function() {
            var selectedOption = $(this).val();
            if (selectedOption) {
                var parts = selectedOption.split('|');
                var cityName = parts[1];
                var zipcode = parts[2];
                $("#lot_zip_code").val(zipcode);
                // Save only the city description in the hidden input field
                $("#selected_lot_town").val(cityName);
            }else{
                $("#lot_zip_code").val('');
            }
        });
    }

    function loadBrgy() {
        $("#lot_barangay").html("");
        $("#lot_barangay").append('<option value="">Select Barangay</option>');
        $("#selected_lot_barangay").val(""); // Clear the hidden input field

        var prov = $("#lot_province").val();
        var p = prov.split("|");
        var provDesc = p[1];

        var citymun = $("#lot_town").val();
        var c = citymun.split("|");
        var citymunCode = c[0];
        var citymunDesc = c[1];

        // Save only the city description in the hidden input field
        $("#selected_lot_town").val(citymunDesc);

        var dist = "";
        // Rest of your code to load barangays and handle district selection

        $.ajax({
            url: "<?php echo site_url("Ccd/Aspayment/getbrgy") ?>",
            method: "POST",
            dataType: 'json',
            data: {
                 citymunCode: citymunCode
            },
            success: function(data) {
                $.each(data, function(i, data) {
                    $('#lot_barangay').append('<option value="' + data.brgyCode + '|' + data.brgyDesc + '">' + data.brgyDesc + '</option>');
                });
            }
        });

        $('#lot_barangay').on('change', function() {
            var selectedOption = $(this).find(':selected');
            var selectedBarangay = selectedOption.text();

            // Save the selected barangay in the hidden input field
            $("#selected_lot_barangay").val(selectedBarangay);
        });
    }
</script>
<!--====================END LOT LOCATION====================-->


<style type="text/css">
	table {
		border-collapse: collapse;
	}
	table,td,th {
		border: 1px solid gray;
	}
	th {
		text-align: center;
	}
	.autocomplete-items {
		margin-top: -30px;
	}
	.file-name-label-oct {
		overflow: hidden;
		text-overflow: ellipsis;
		width: 128px;
		height: 14px;
		margin-top: 10px;
		display: block;
		float: left;
	}
	.file-name-label-tct {
		overflow: hidden;
		text-overflow: ellipsis;
		width: 128px;
		height: 14px;
		margin-top: 10px;
		display: block;
		float: left;
	}
</style>