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
			<?php if ($this->session->flashdata('notif')) { ?>
				<div class="alert alert-success alert-dismissible fade in" role="alert" id="saved">
					<i class="glyphicon glyphicon-ok"></i> <?php echo $this->session->flashdata('notif'); ?>
				</div>
			<?php } ?>
			<!--====================FLASH DATA====================-->
			<div class="x_panel animate slideInDown" style="border:1px; !important;box-shadow: 7px 6px 16px #888888;">
				<div class="x_title">
					<div class="title_left">
						<h2 style="word-spacing: 4px; letter-spacing: 1px; font-weight: bold; font-size: 14px;color: #2a3f54;"><i class="fa fa-edit" style="font-size:16px;"></i> Add Land</h2>
						<div style="float:right">
							<a type="a" href="<?= base_url() ?>" class="btn btn-custom-warning btn-hover btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>

				<?php $is_id=0;
					if(empty($is_no)){
						$is_no = "NA-0001";
					}
					foreach ($land_id as $li) {
						$is_id = substr($li['is_no'],3)+1;
						if(strlen($is_id) == 1){
							$is_no = "NA-000".$is_id;
						}elseif(strlen($is_id) == 2){
							$is_no = "NA-00".$is_id;
						}elseif(strlen($is_id) == 3){
							$is_no = "NA-0".$is_id;
						}else{
							$is_no = "NA-".$is_id;
						}
					}  
				?>

				<?php echo form_open('Acquisition', array('id' => 'add_acq'));?>
					<!--====================BODY====================-->
					<div class="x_panel" style="border-radius:9px;">
						<div class="row">        
							<div class="col-md-6 col-sm-6 col-xs-6" style="padding-bottom: 8px;">          
								<div class="form-group">
									<label class="control-label col-md-3" for="first-name">I.S No.</label>
									<div class="col-md-7">
										<input type="text"  name="is_no" value="<?php echo $is_no; ?>" class="form-control" onkeydown="return false" readonly/>
									</div>
								</div> 
							</div>

							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<label class="control-label col-md-3" for="first-name">Date Acquired</label>
									<div class="col-md-7 ">
										<input type="text" class="form-control has-feedback-left" id="date_acquired" readonly name="date_acquired">
										<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
										<span id="inputSuccess2Status2" class="sr-only">(success)</span>
									</div>
								</div>                            
							</div>
					
							<div class="col-md-12 col-xs-12 col-sm-12" style="border-top: 1px solid #ff6600; border-bottom: 1px solid #ff6600">
								<center><h5 style="letter-spacing: 10px;"><b>LAND INFORMATION</b></h5></center>
							</div>

							<input type="hidden"  name="p_by" value="<?php echo ucfirst($this->session->userdata('firstname')).' '.ucfirst($this->session->userdata('lastname'))?>" class="form-control" onkeydown="return false" readonly/>


							<div class="col-md-6 col-sm-6 col-xs-6 form-inline" style="margin-top:10px">
								<label class="control-label col-md-3">Lot No.<span class="required">*</span></label> 
								<div class="col-md-7">
									<input type="text" min="0" name="lot_no" class="form-control" value="<?php echo set_value('lot_no') ?>" required>
								</div>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-6 form-inline" style="margin-top:10px">
								<label class="control-label col-md-3">Cad.<span class="required">*</span></label> 
								<div class="col-md-7">
									<input type="text" min="0"  name="cad_no" class="form-control" value="<?php echo set_value('cad_no') ?>" >
								</div>
							</div>
										
							<div class="col-md-12 col-xs-12 col-sm-12 " style="border:1px solid #E6E9ED; display: inline;margin-top:15px">
								<div class="col-md-3 col-sm-3 col-xs-3" style="border-right: 3px solid #E6E9ED;">
									<h2 style="color:#1a1a1a;font-size:15px"><b>Lot Type:</b></h2>                 
								</div>

								<div class="col-md-3 col-sm-3 col-xs-3" style="border-right: 3px solid #E6E9ED;">
									<label class="r-contain"><input type="radio" name="lot_type" value="Agricultural" <?php if(@$_POST['lot_type'] == "Agricultural"){ echo "checked";} ?> required>Agricultural<span class="checkmark"></span></label>
								</div>

								<div class="col-md-3 col-sm-3 col-xs-3">
									<label class="r-contain"><input type="radio" name="lot_type" value="Commercial" <?php if(@$_POST['lot_type'] == "Commercial"){ echo "checked";} ?> required>Commercial<span class="checkmark"></span></label>
								</div>

								<div class="col-md-3 col-sm-3 col-xs-3" style="border-left: 3px solid #E6E9ED;">
									<label class="r-contain"><input type="radio" name="lot_type" value="Residential" <?php if(@$_POST['lot_type'] == "Residential"){ echo "checked";} ?> required>Residential<span class="checkmark"></span></label>
								</div>
							</div>  

							<div class="row">
								<div class="x_panel2">
									<div class="x_title">
										<h2 style="color:#1a1a1a;font-size:15px"><b>Lot Location:</b></h2>                 
										<div class="clearfix"></div>
									</div>

									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-6">
											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-3 control-label">Region<span class="required">*</span></label>
													<div class="col-md-7">
														<select class="form-control" id="region" name="region" onchange="loadProvince()" value="<?php echo set_value('region'); ?>" required>
															<option value="">Select Region</option>
														</select>
														<input type="hidden" id="selectedRegion" name="selectedRegion" readonly>
													</div>
												</div>
											</div>

											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-3 control-label">Province<span class="required">*</span></label>
													<div class="col-md-7">
														<select class="form-control" id="province" name="province" onchange="loadCity()" value="<?php echo set_value('province'); ?>"  required>
															<option value="">Select Province</option>
														</select>
														<input type="hidden" id="selectedProvince" name="selectedProvince" readonly>
													</div>
												</div>
											</div>

											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-3 control-label">Municipality<span class="required">*</span></label>
													<div class="col-md-7">
														<select class="form-control" id="town" name="town" onchange="loadBrgy()" value="<?php echo set_value('town'); ?>"  required>
															<option value="">Select City</option>
														</select>
														<input type="hidden" id="selectedCity" name="selectedCity" readonly>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-6 col-sm-6 col-xs-6">
											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-3 control-label">Baranggay<span class="required">*</span></label>
													<div class="col-md-7">
														<select class="form-control" id="barangay" name="barangay" value="<?php echo set_value('baranggay') ?>" required>
															<option value="">Select Barangay</option>
														</select>
														<input type="hidden" id="selectedBaranggay" name="selectedBaranggay" readonly>
													</div>
												</div>
											</div>
															 
											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-3 control-label">Street<span class="required">*</span></label>
													<div class="col-md-7">
														<input type="text" class="form-control" name="street" id="street" value="<?php echo set_value('street') ?>"  required>
													</div>
												</div>
											</div>
																 
											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-3 control-label">Zip Code<span class="required">*</span></label>
													<div class="col-md-7">
														<input type="text" class="form-control" id="zipcode" name="zipcode" value="<?php echo set_value('zipcode') ?>"  readonly required>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>  
			
							<div class="row">   
								<div class="x_panel2">
									<div class="x_title">
										<h2 style="color:#1a1a1a;font-size:15px"><b>Lot Details:</b></h2>                 
										<div class="clearfix"></div>
									</div>

									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-6">
											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-3 control-label">Lot Sold<span class="required">*</span></label>
													<div class="col-md-7">
														<select class="form-control" name="lot_sold" id="sold" required>
															<option value="">Select</option>
															<option value="Portion"<?php if(@$_POST['lot_sold'] == "Portion"){ echo 'selected'; } ?> >Portion</option>
															<option value="Whole"<?php if(@$_POST['lot_sold'] == "Whole"){ echo 'selected'; } ?> >Whole</option>
														</select>
													</div>
												</div>
											</div>

											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-3 control-label">Purchase Type<span class="required">*</span></label>
													<div class="col-md-7">
														<select class="form-control" id="purchase_type" name="purchase_type" required>
															<option value="" >Select</option>
															<option value="package" <?php if(@$_POST['purchase_type'] == "package"){ echo 'selected'; } ?> class="select_op">Package</option>
															<option value="per/sq.m." <?php if(@$_POST['purchase_type'] == "per/sq.m."){ echo 'selected'; } ?> class="select_op">Per/sq.m.</option>
														</select>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-6 col-sm-6 col-xs-6">
											<div class="control-group">
												<div class="controls">
													<label class="control-label col-md-3" for="first-name">Lot Area<span class="required">*</span></label>
													<div class="input-group col-md-7 xdisplay_inputx form-group has-feedback">
														<input id="la_form" name="lot_area" type="text" value="<?php echo set_value('lot_area') ?>"  class="form-control formca" required />
														<div class="input-group-addon">m<sup>2</sup></div>
													</div>
												</div>
											</div> 
											<div class="control-group"  id="Square" <?php if(isset($_POST['selling_price']) && @$_POST['purchase_type'] == "per/sq.m."){ echo 'style="display: block;"'; }else{ echo 'style="display: none;"';} ?>>
												<div class="controls">
													<label class="control-label col-md-3" for="first-name">Selling Price/m2<span class="required">*</span></label>
													<div class="input-group col-md-7 xdisplay_inputx form-group has-feedback">
														<div class="input-group-addon">₱</div>
														<input id="sp_form" name="selling_price" type="text" value="<?php echo set_value('selling_price') ?>"  class="form-control"/>
													</div>
												</div>
											</div> 
											<div class="control-group">
												<div class="controls">
													<label class="control-label col-md-3" for="first-name">Total Purchase Price<span class="required">*</span></label>
													<div class="input-group col-md-7 xdisplay_inputx form-group has-feedback">
														<div class="input-group-addon">₱</div>
														<input id="total_form" name="total_price" type="text" value="<?php echo set_value('total_price') ?>" class="form-control"  />
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row"> 
								<div class="x_panel2">
									<div class="x_title">
										<h2 style="color:#1a1a1a;font-size:15px"><b>Restriction/s to Land Title</b></h2>                 
										<div class="clearfix"></div>
									</div>

									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-2" style="border:3px solid #E6E9ED;">
												<label>Liens</label>
											</div>
											<div class="col-md-9 col-xs-12 col-sm-9" style="border:3px solid #E6E9ED;">
												<textarea style="width: 100%" name="liens" id="liens" class="form-control"><?php echo set_value('liens'); ?></textarea>
											</div>

											<div class="col-md-2" style="border:3px solid #E6E9ED;">
												<label>Easement</label>
											</div>
											<div class="col-md-9 col-xs-12 col-sm-9" style="border:3px solid #E6E9ED;">
												<textarea style="width: 100%" name="easement"  id="ease" class="form-control"><?php echo set_value('easement') ?></textarea>
											</div>

											<div class="col-md-2" style="border:3px solid #E6E9ED;">
												<label>Encumbrances</label>
											</div>
											<div class="col-md-9 col-xs-12 col-sm-9" style="border:3px solid #E6E9ED;">
												<textarea style="width: 100%" name="encumbrances" id="encum" class="form-control"><?php echo set_value('encumbrances') ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--====================END BODY====================-->
					<div class="col-md-12">
						<input class="btn btn-custom-primary send btn-sm pull-right" type="submit" name="submit" value="Proceed">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--====================END PAGE CONTENT====================-->

<script>
	$(function() {
	    $("#date_acquired").datepicker({
	        dateFormat: 'mm/dd/yy',
	    });
	    // Set current date
	    var d 		= new Date();
	    var month 	= d.getMonth() + 1;
	    var day 	= d.getDate();
	    var output 	= (month < 10 ? '0' : '') + month + '/' + (day < 10 ? '0' : '') + day + '/' + d.getFullYear();
	    $("#date_acquired").val(output);
	});
</script>

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(event) {
		$(function() {
			$('#purchase_type').change(function(){
				if($(this).val() == 'package'){
					$('#package').show();
					$('#Square').hide();
					$("#total_form").prop('readonly',false);
					$('#sp_form').val('');
					$('#total_form').val('');
				}else{
					$('#Square').show();
					$("#total_form").prop('readonly',true);
				} 
				$('#package').hide();
				$('#' + $(this).val()).show();
			});
		}); 

		document.querySelector('.send').addEventListener("click", function(){
			window.btn_clicked = true;
		});

		var $form 	= $('#add_acq'),
		origForm 	= $form.serialize();
		$('#add_acq :input').on('change input', function() {
			if($form.serialize() !== origForm){
				window.onbeforeunload = function(){
					if(!window.btn_clicked){ //was not clicked
						return 'Changes you made not be saved!';
					}
				};
			}
		});                                                     
	});               
</script>

<script type="text/javascript"> 
	function loadRegion() {
		$.ajax({
			url: "<?php echo site_url("Acquisition/getregion") ?>",
			method: "POST",
			success: function(data) {
				var jObj = JSON.parse(data);
				console.log('test:',jObj);
				for (var c = 0; c < jObj.length; c++) {
					$('#region').append('<option value="' + jObj[c].regCode + '|' + jObj[c].regDesc + '">' + jObj[c].regDesc + '</option>');
				}
			}
		});
	}
	loadRegion();

	function loadProvince() {
		// Clear the province, city, barangay fields when changing the region
		$("#province").html(""); // Clear the province dropdown
		$("#town").html("");
		$("#barangay").html("");
		$("#selectedRegion").val(""); // Clear the hidden input field

		var reg = $("#region").val();
		var r = reg.split("|");
		var regCode = r[0];
		var regDesc = r[1];

		// Save only the region description in the hidden input field
		$("#selectedRegion").val(regDesc);

		// Append the "Select Province" option to the province dropdown
		$('#province').append('<option value="">Select Province</option>');

		$.ajax({
			url: "<?php echo site_url("Acquisition/getprovince") ?>",
			method: "POST",
			dataType: 'json',
			data: {
				regCode: regCode
			},
			success: function (data) {
				$.each(data, function (i, data) {
					$('#province').append('<option value="' + data.provCode + '|' + data.provDesc + '">' + data.provDesc + '</option>');
				});
			}
		});
	}

	function loadCity() {
		$("#town").html("");
		$("#town").append('<option value="">Select City/Municipality</option>');
		$("#selectedCity").val(""); // Clear the hidden input field

		var prov = $("#province").val();
		var p = prov.split("|");
		var provCode = p[0];
		var provDesc = p[1];

		// Save only the province description in the hidden input field
		$("#selectedProvince").val(provDesc);

		$.ajax({
			url: "<?php echo site_url("Acquisition/getcitymun") ?>",
			method: "POST",
			dataType: 'json',
			data: {
				 provCode: provCode
			},
			success: function(data) {
				$.each(data, function(i, data) {
					var cityName = data.citymunDesc.split(' ')[0];
					$('#town').append('<option value="' + data.citymunCode + '|' + cityName + '|' + data.zipcode + '">' + cityName + '</option>');
				});
			}
		});

		// Additional code to handle city selection
		$("#town").on("change", function() {
			var selectedOption = $(this).val();
			if (selectedOption) {
				var parts = selectedOption.split('|');
				var cityName = parts[1];
				var zipcode = parts[2];
				$("#zipcode").val(zipcode);
				// Save only the city description in the hidden input field
				$("#selectedCity").val(cityName);
			}else{
				$("#zipcode").val('');
			}
		});
	}

	function loadBrgy() {
		$("#barangay").html("");
		$("#barangay").append('<option value="">Select Barangay</option>');
		$("#selectedBarangay").val(""); // Clear the hidden input field

		var prov = $("#province").val();
		var p = prov.split("|");
		var provDesc = p[1];

		var citymun = $("#town").val();
		var c = citymun.split("|");
		var citymunCode = c[0];
		var citymunDesc = c[1];

		// Save only the city description in the hidden input field
		$("#selectedCity").val(citymunDesc);

		var dist = "";
		// Rest of your code to load barangays and handle district selection

		$.ajax({
			url: "<?php echo site_url("Acquisition/getbrgy") ?>",
			method: "POST",
			dataType: 'json',
			data: {
				 citymunCode: citymunCode
			},
			success: function(data) {
				$.each(data, function(i, data) {
					$('#barangay').append('<option value="' + data.brgyCode + '|' + data.brgyDesc + '">' + data.brgyDesc + '</option>');
				});
			}
		});

		$('#barangay').on('change', function() {
			var selectedOption = $(this).find(':selected');
			var selectedBarangay = selectedOption.text();

			// Save the selected barangay in the hidden input field
			$("#selectedBaranggay").val(selectedBarangay);
		});
	}
</script>


<!--====================STYLE====================-->
<style type="text/css">
	.l_info{         
		width: 100%;
		padding: 10px 17px;
		display: inline-block;
		background: #fff;
		border: 1px solid #E6E9ED;
		-webkit-column-break-inside: avoid;
		-moz-column-break-inside: avoid;
		column-break-inside: avoid;
		opacity: 1;
		transition: all .2s ease;
	}

	.x_panel2{
		margin-top: 20px;
		margin-left: 9px;
		width: 98%;
		padding: 10px 17px;
		display: inline-block;
		background: #fff;
		border: 1px solid #E6E9ED;
		-webkit-column-break-inside: avoid;
		-moz-column-break-inside: avoid;
		column-break-inside: avoid;
		opacity: 1;
		transition: all .2s ease;
	}

	.x_panel3{
			margin-left: 1px;
			width: 35%;
			padding: 10px 17px;
			display: inline-block;
			background: #fff;
			border: 1px solid #E6E9ED;
			-webkit-column-break-inside: avoid;
			-moz-column-break-inside: avoid;
			column-break-inside: avoid;
			opacity: 1;
			transition: all .2s ease;
	}

	.x_panel4{
			margin-top: 8px;
			margin-left: 1px;
			width: 100%;
			padding: 10px 17px;
			display: inline-block;
			background: #fff;
			border: 1px solid #E6E9ED;
			-webkit-column-break-inside: avoid;
			-moz-column-break-inside: avoid;
			column-break-inside: avoid;
			opacity: 1;
			transition: all .2s ease;
	}

	.title{
			border-bottom: 2px solid #E6E9ED;
			padding: 1px 485px 6px;
			margin-bottom: 10px;
	}

	.title2{
			border-bottom: 2px solid #E6E9ED;
			padding: 1px 462px 6px;
			margin-bottom: 10px;
	}

	.title3{
			border-bottom: 2px solid #E6E9ED;
			/*padding: 1px 462px 6px;*/
			margin-bottom: 10px;
	}
	input[type="text"]:hover {
			border: 1px solid #3399ff;
			color: #000000;
	}
	input[type="number"]:hover {
			border: 1px solid #3399ff;
			color: #000000;
	}
	input[type="date"]:hover {
			border: 1px solid #3399ff;
			color: #000000;
	}
	input[type="email"]:hover {
			border: 1px solid #3399ff;
			color: #000000;
	}
	textarea:hover {
			border: 1px solid #3399ff;
			color: #000000;
	}
	button[type="submit"]{
		 font-size: 18px;
		 padding: 15px;
		 border: 2px solid #FFF;
		 color: #FFF;
		 display: block;
		 margin: 50px auto;
		 background: transparent;
		 transition: .2s ease-in-out 0s;
	}

	input[type="submit"]:hover{
		cursor: pointer;
		transform: scale(1.10);
		/*background: #FFF;
		color: black;*/
	}

	button[type="a"]{
		 font-size: 18px;
		 padding: 15px;
		 border: 2px solid #FFF;
		 color: #FFF;
		 display: block;
		 margin: 50px auto;
		 background: transparent;
		 transition: .2s ease-in-out 0s;
	}

	a[type="a"]:hover{
		cursor: pointer;
		transform: scale(1.10);
	 /* background: #FFF;
		color: black;*/
	}
	.input-group-addon {
		font-size: 15px; /* Adjust the size as needed */
		border:#fff;
		color:#2A3F54;
		background-color: #fff;
		padding-left:0px
	}
</style>
<!--====================STYLE====================-->