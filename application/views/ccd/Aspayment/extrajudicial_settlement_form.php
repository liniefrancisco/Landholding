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
                    <h2 class="fa fa-bank"> <b>Settlement</b></h2>
                    <a href="#" onclick="window.history.back()" class="btn btn-sm btn-warning pull-right"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
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

				<?php echo form_open_multipart('Aspayment/extrajudicial', array('id' => 'add_lot'));?>
					<div class="x_panel" style="border-radius:10px;">
						<div class="row text-center space">
							<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
							<h5><b>LAND AS PAYMENT FORM - EXTRAJUDICIAL SETTLEMENT (LAPF-ES)</b></h5>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 space">
							<div class="col-md-6 col-sm-6 col-xs-6 form-inline">
								<label>LAPF-ES #:</label>
								<input type="text" class="form-control" name="es_no" value="<?php echo $es_no; ?>" readonly>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6 form-inline">
                                <div class="form-group pull-right">
                                    <label class="col-md-2">Date:</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control has-feedback-left" name="date" id="date" readonly>
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>                            
                            </div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 text-center space" style="border-top:1px solid #ff6600; border-bottom:1px solid #ff6600;">
							<h6 style="letter-spacing:5px;">LAND INFORMATION</h6>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 space">
                            <div class="col-md-6 col-xs-6 col-sm-6 form-inline">
                                <label>Lot :</label>
                                <input type="text" class="form-control" name="lot" value="<?php if (isset($_POST['lot'])) { echo $_POST['lot'];} ?>" required>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 form-inline">
                                <div class="form-group pull-right">
                                    <label>Cad :</label>
                                    <input type="text" class="form-control" name="cad" value="<?php if (isset($_POST['cad'])) { echo $_POST['cad'];} ?>" required>
                                </div>
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
								<input type="text" class="form-control text-center" name="lot_fname" value="<?php if(isset($_POST['lot_fname'])){ echo $_POST['lot_fname'];} ?>" required>
								<h6 class="text-center"><i>Firstname</i></h6>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3">
								<input type="text" class="form-control text-center" name="lot_mname" value="<?php if(isset($_POST['lot_mname'])){ echo $_POST['lot_mname']; } ?>" required>
								<h6 class="text-center"><i>Middlename</i></h6>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3">
								<input type="text" class="form-control text-center" name="lot_lname" value="<?php if(isset($_POST['lot_lname'])){ echo $_POST['lot_lname']; } ?>"  required>
								<h6 class="text-center"><i>Lastname</i></h6>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 space">
                            <div class="col-md-3 col-sm-3 col-xs-3"><label>Gender:</label></div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <label class="r-contain">
                                    <input type="radio" name="gender" value="Male" <?php if(@$_POST['gender'] == "Male"){ echo "checked"; } ?> required>Male
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-5">
                                <label class="r-contain">
                                    <input type="radio" name="gender" value="Female" <?php if(@$_POST['gender'] == "Female"){ echo "checked"; } ?> required>Female
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

						<div class="col-md-12 col-sm-12 col-xs-12 space">
							<div class="col-md-3 col-sm-3 col-xs-3"><label>Vital Status:</label></div>
							<div class="col-md-4 col-sm-4 col-xs-4">
								<label class="r-contain">
									<input type="radio" name="vital_status" value="Alive" <?php if(@$_POST['vital_status'] == "Alive"){ echo "checked"; } ?> required> Alive 
									<span class="checkmark"></span>
								</label>
							</div>
							<div class="col-md-5 col-sm-5 col-xs-5">
								<label class="r-contain">
									<input type="radio" name="vital_status" value="Deceased" <?php if(@$_POST['vital_status'] == "Deceased"){ echo "checked"; } ?> required> Deceased 
									<span class="checkmark"></span>
								</label>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 space">
							<div class="col-md-3 col-sm-3 col-xs-3"><label>Lot Location:</label></div>
								<div class="col-md-3 col-sm-3 col-xs-3">
									<select class="form-control text-center" id="region" name="lot_region" onchange="loadProvince()" required>
										<option value="">Select Region</option>
									</select>
									<h6 class="text-center"><i>Region</i></h6>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-3">
									<select class="form-control text-center" id="province" name="lot_province" onchange="loadCity()" required>
										<option value="">Select Province</option>
									</select>
									<h6 class="text-center"><i>Province</i></h6>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-3">
									<select class="form-control text-center" id="municipality" name="lot_town" onchange="loadBrgy()" required>
										<option value="">Select City</option>
									</select>
									<h6 class="text-center"><i>City/Municipality</i></h6>
								</div>

								<div class="col-md-3 col-sm-3 col-xs-3"></div>

								<div class="ccol-md-3 col-sm-3 col-xs-3">
									<select class="form-control text-center" id="barangay" name="lot_barangay" required>
										<option value="">Select Barangay</option>
									</select>
									<h6 class="text-center"><i>Barangay</i></h6>
								</div>
								<div class="ccol-md-3 col-sm-3 col-xs-3">
									<input type="text" class="form-control text-center" name="lot_street" value="<?php echo set_value('lot_street') ?>" required>
									<h6 class="text-center"><i>Street</i></h6>
								</div>

								<div class="ccol-md-3 col-sm-3 col-xs-3">
									<input type="text" class="form-control text-center" name="lot_zip_code" id="zip_code" value="<?php echo set_value('lot_zip_code') ?>" required readonly>
									<h6 class="text-center"><i>Zipcode</i></h6>
								</div>
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 space">
								<div class="col-md-3 col-sm-3 col-xs-3"><label>Lot for payment:</label></div>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<label class="r-contain">
										<input type="radio" name="lot_sold" value="Portion" <?php if(@$_POST['lot_sold'] == "Portion"){ echo "checked"; } ?> required> Portion 
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="col-md-5 col-sm-5 col-xs-5">
									<label class="r-contain">
										<input type="radio" name="lot_sold" value="Whole" <?php if(@$_POST['lot_sold'] == "Whole"){ echo "checked"; } ?> required> Whole 
										<span class="checkmark"></span>
									</label>
								</div>
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 space">
	                            <div class="col-md-3 col-sm-3 col-xs-3 form-inline"><label>Lot Size:</label> </div>
	                            <div class="col-md-9 col-sm-9 col-xs-9 form-inline">
	                                <input type="text" value="<?php if(isset($_POST['lot_size'])){ echo $_POST['lot_size']; } ?>" name="lot_size" class="form-control input_border" id="lotsize" required>
									<label>sq/m</label>
	                            </div>
	                        </div>

							<div class="col-md-12 col-sm-12 col-xs-12 space">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<label>Available Proof of Title/Ownership:</label>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<label class="r-contain">
										<input type="radio" name="proof_title" value="oct" class="proof" required> Original Certificate of Title (OCT) 
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="col-md-5 col-sm-5 col-xs-5">
									<label class="r-contain">
										<input type="radio" name="proof_title" value="tct" class="proof" required> Transfer Certificate of Title (TCT) 
										<span class="checkmark"></span>
									</label>
								</div>
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 space">
								<div class="col-md-3 col-sm-3 col-xs-3"></div>
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
												<input type="text" class="form-control" name="mv_tax" value="<?php if(isset($_POST['mv_tax'])){ echo $_POST['mv_tax']; } ?>"  id="mv_ltd" required>
											</td>
										</tr>
										<tr>
											<td>Neighboring Inquiry</td>
											<td class="form-inline">₱ 
												<input type="text" class="form-control" name="neighbor_inq" value="<?php if(isset($_POST['neighbor_inq'])){ echo $_POST['neighbor_inq']; } ?>"  id="neigh_inq" required>
											</td>
										</tr>
										<tr>
											<td>Assessor</td>
											<td class="form-inline">₱ 
												<input type="text" class="form-control" name="assessor" value="<?php if(isset($_POST['assessor'])){ echo $_POST['assessor']; } ?>"  id="assessor" required>
											</td>
										</tr>
										<tr>
											<td>Banks</td>
											<td class="form-inline">₱ 
												<input type="text" class="form-control" name="banks" value="<?php if(isset($_POST['banks'])){ echo $_POST['banks']; } ?>"  id="banks" required>
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
						<div class="row pull-right">
							<input type="submit" name="" class="btn btn-custom-primary proceed" value="Proceed">
						</div>
					</div>
				</form>
			</div>
			<!--====================END START CONTENT====================-->
		</div>
	</div>
</div>
<!--====================END PAGE CONTENT====================-->


<script>//Date
    $(function() {
        $("#date").datepicker({
            dateFormat: 'mm/dd/yy',
        });
        // Set current date
        var d 		= new Date();
        var month 	= d.getMonth() + 1;
        var day 	= d.getDate();
        var output 	= (month < 10 ? '0' : '') + month + '/' + (day < 10 ? '0' : '') + day + '/' + d.getFullYear();
        $("#date").val(output);
    });
</script>
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
	document.addEventListener("DOMContentLoaded", function(event) {
		//AVAILABLE PROOF OF TITLE/OWNERSHIP JQUERY
		$(".proof").click(function() {
			var a 		= $(this).attr("value");
			var oct_in 	= $("#oct_file").val();
			var tct_in 	= $("#tct_file").val();
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
		//End

		document.querySelector('.proceed').addEventListener("click", function() {
			window.btn_clicked = true;
		});

		var $form 	= $('#add_lot'),
		origForm 	= $form.serialize();
		$('#add_lot :input').on('change input', function() {
			if ($form.serialize() !== origForm) {
				window.onbeforeunload = function() {
					if (!window.btn_clicked) { //was not clicked
						return 'Changes you made not be saved!';
					}
				};
			}
		});
	});

	var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];
	function ValidateSingleInput(oInput) {
		var sFileName 	= oInput.files[0].name;
		var oct_in 		= $("#oct_file").val();
		var tct_in 		= $("#tct_file").val();
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