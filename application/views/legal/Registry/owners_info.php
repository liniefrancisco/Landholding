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
			<?php if($this->session->flashdata('notif')){?>
				<div class="alert alert-info alert-dismissible fade in" role="alert" id="saved">
					<i class="glyphicon glyphicon-ok"></i>  <?php echo $this->session->flashdata('notif'); ?>
				</div>
			<?php } ?>
			<!--====================END FLASH DATA====================-->

			<!--====================BODY====================-->
			<div class="x_panel animate slideInDown" style="border:1px; !important;box-shadow: 7px 6px 16px #888888;">
				<div class="x_title">
					<div class="title_left">
						<h2 class="fa fa-edit" style="font-size:15px"> <b>Owner Information</b></h2>
					</div>
					<div class="pull-right">
						<form action="<?= base_url('Registry/cancel_acq_owner_intf/'.$li['is_no']); ?>" onsubmit="return confirm('Are you sure to cancel what you have done?');" method="POST">
							<button type="submit" name="cancel_acq" class="btn btn-warning" style="background-color: #e65c00;"><i class="glyphicon glyphicon-floppy-remove"></i> Cancel</button>
						</form>
					</div>
					<div class="clearfix"></div>
				</div>

				<?php echo form_open('Legal/Registry/owners_info/'.$li['is_no'], array('id' => 'add_own'));?>
					<!--====================BODY====================-->
					<div class="x_panel" style="border-radius:9px; ">
						<div class="row">
							<input type="hidden" name="is_no" value="<?=$li['is_no']; ?>" class="form-control inb" readonly>

							<div class="col-md-12 col-sm-12 col-xs-12 form-inline">
								<h2 style="display:inline"><b>Presentor:</b></h2>
								<label style="padding-left:50px">
									<input type="radio" id="" name="presentor" class="appearance" value="Owner/Seller" <?php if (@$_POST['presentor'] == "Owner/Seller"){ echo "checked"; } ?> required>Owner/Seller
								</label>
								<label style="padding-left:50px">
									<input type="radio" id="" name="presentor" class="appearance" value="Broker" <?php if (@$_POST['presentor'] == "Broker"){ echo "checked"; } ?> required>Broker
								</label>
							</div><br/>          

							<div class="row"  id="broker" <?php if(@$_POST['presentor'] == "Broker") { echo 'style="border-radius:9px; margin-top: 20px; display:block;"'; }else{ echo 'style="border-radius:9px; margin-top: 20px; display:none;"'; } ?>>
								<div class="x_panel2">
									<div class="x_title">
										<h2 style="color:#1a1a1a;font-size:15px"><b>Broker's Name</b></h2>
										<div class="clearfix"></div>
									</div> 

									<div class="col-md-4 col-sm-4 col-xs-4 form-inline">
										<label class="control-label">Firstname<span>*</span></label>
										<input type="text" name="broker_first" value="<?php if(isset($_POST['broker_first'])){ echo $_POST['broker_first']; } ?>" class="form-control" id="fname_b">
									</div>
									<div class="col-md-4 col-sm-4 col-xs-4 form-inline">
										<label class="control-label">Middlename<span>*</span></label>
										<input type="text" name="broker_middle" value="<?php if(isset($_POST['broker_middle'])){ echo $_POST['broker_middle']; } ?>" class="form-control" id="mname_b" >
									</div>
									<div class="col-md-4 col-sm-4 col-xs-4 form-inline">
										<label class="control-label">Lastname<span>*</span></label>
										<input type="text" name="broker_last" value="<?php if(isset($_POST['broker_last'])){ echo $_POST['broker_last']; } ?>" class="form-control" id="lname_b">
									</div>
								</div>                               
							</div><br/>

							<div class="col-md-12 col-sm-12 col-xs-12" style="border-top: 1px solid #ff6600; border-bottom: 1px solid #ff6600">
								<center><h5 style="letter-spacing: 10px;"><b>OWNER  INFORMATION</b></h5></center>
							</div><br/><br/><br/>

							<div class="row">
								<div class="x_panel2">
									<div class="x_title">
										<h2 style="color:#1a1a1a;font-size:15px"><b>Owner's Name:</b></h2>
										<div class="clearfix"></div>
									</div>
									<div class="form-horizontal">
										<div class="form-group">                                         
											<div class="col-md-4 col-sm-4 col-xs-4 form-inline">
												<label class="control-label">Firstname<span class="required">*</span></label>
												<input type="text" name="firstname" value="<?php if(isset($_POST['firstname'])){ echo $_POST['firstname']; } ?>" class="form-control" required>
											</div>  
											<div class="col-md-4 col-sm-4 col-xs-4 form-inline">
												<label class="control-label">Middlename<span class="required">*</span></label>
												<input type="text" name="middlename" value="<?php if(isset($_POST['middlename'])){ echo $_POST['middlename']; } ?>" id="mid" class="form-control" >
											</div>
											<div class="col-md-4 col-sm-4 col-xs-4 form-inline">
												<label class="control-label">Lastname<span class="required">*</span></label>
												<input type="text" name="lastname" value="<?php if(isset($_POST['lastname'])){ echo $_POST['lastname']; } ?>" class="form-control" required>
											</div>                                         
										</div>                                     
									</div>
								</div>
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 form-inline space">
								<h2 style="color:#1a1a1a;font-size:15px;display:inline;padding-left: 10px;"><b>Gender:</b></h2>
								<label style="padding-left:50px;">
									<input type="radio" name="gender" value="Male" required <?php if(@$_POST['gender'] == "Male"){ echo "checked"; } ?>>
									<label class="control-label">Male</label>
								</label>
								<label style="padding-left:50px;">
									<input type="radio" name="gender" value="Female" required <?php if(@$_POST['gender'] == "Female"){ echo "checked"; } ?>>
									<label class="control-label">Female</label>
								</label>
							</div>
											 
							<div class="row">
								<div class="x_panel2">
									<div class="x_title">
										<h2 style="color:#1a1a1a;font-size:15px"><b>Owner's Address:</b></h2>                 
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
															<input type="hidden" id="selectedRegion" name="selectedRegion" readonly>
														</select>
													</div>
												</div>
											</div>
											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-3 control-label">Province<span class="required">*</span></label>
													<div class="col-md-7">
														<select class="form-control" id="province" name="province" onchange="loadCity()" value="<?php echo set_value('province'); ?>"  required>
															<option value="">Select Province</option>
															<input type="hidden" id="selectedProvince" name="selectedProvince" readonly>
														</select>
													</div>
												</div>
											</div>
											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-3 control-label">Municipality<span class="required">*</span></label>
													<div class="col-md-7">
														<select class="form-control" id="town" name="town" onchange="loadBrgy()" value="<?php echo set_value('town'); ?>"  required>
															<option value="">Select City</option>
															<input type="hidden" id="selectedCity" name="selectedCity" readonly>
														</select>
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
															<input type="hidden" id="selectedBaranggay" name="selectedBaranggay" readonly>
														</select>
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

							<div class="col-md-12 col-sm-12 col-xs-12 form-inline" style="padding-top: 15px;padding-bottom: 15px;">
								<h2 style="color:#1a1a1a;font-size:15px;display:inline;padding-left: 10px;"><b>Vital Status:</b></h2>
								<label>
									<span style="padding-left: 85px;"><input type="radio" name="vital_status" value="Alive" required <?php if(@$_POST['vital_status'] == "Alive"){ echo 'checked'; } ?> required><label class="control-label"> Alive</label>
								</label>
								<label>
									<span style="padding-left: 110px;"><input type="radio" name="vital_status" value="Deceased" required <?php if(@$_POST['vital_status'] == "Deceased"){ echo 'checked'; } ?> required><label class="control-label"> Deceased</label>
								</label>
							</div>          
								
							<div class="row">
								<div class="x_panel2">
									<div class="x_title">
										<h2 style="color:#1a1a1a;font-size:15px"><b>Main Contact Person:</b></h2>
										<div class="clearfix"></div>
									</div>

									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-6">
											<div class="form-inline">
												<label class="col-md-3 col-xs-3 col-sm-3">Fullname<span class="required">*</span></label>
												<input type="text" name="fullname" id="f_name" value="<?php if(isset($_POST['fullname'])){ echo $_POST['fullname']; } ?>" class="form-control" required>
											</div>
											<div class="form-inline" style="margin-top: 5px;">
												<label class="col-md-3 col-xs-3 col-sm-3">Address<span class="required">*</span></label>
												<input type="text" name="address" value="<?php if(isset($_POST['address'])){ echo $_POST['address']; } ?>" class="form-control" required>
											</div>
											<div class="form-inline" style="margin-top: 5px;">
												<label class="col-md-3 col-xs-3 col-sm-3">Telephone No.<span class="required">*</span></label>
												<input type="text" name="tel_no" value="<?php if(isset($_POST['tel_no'])){ echo $_POST['tel_no']; } ?>" class="form-control">
											</div>
										</div>

										<div class="col-md-6 col-xs-6 col-sm-6">
											<div class="form-inline">
												<label class="col-md-3 col-xs-3 col-sm-3">Phone No.<span class="required">*</span></label>
												<input type="text"  name="phone_no" value="<?php if(isset($_POST['phone_no'])){ echo $_POST['phone_no']; } ?>"  class="form-control" pattern="[0-9]{11}" required>
											</div>
											<div class="form-inline" style="margin-top:10px;">
												<label class="col-md-3 col-xs-3 col-sm-3">Email<span class="required">*</span></label>
												<input type="email" name="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>" data-parsley-trigger="change" class="form-control">
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

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(event) {
		//OWNER/SELLER JQUERY
		$(".appearance").click(function(){
			var a = $(this).attr("value");
			if(a == "Owner/Seller"){
				$("#owner").show();
				$("#broker").hide();
				$("#fname_b").prop('required',false);
				$("#lname_b").prop('required',false);
				$('#fname_b').val('');
				$('#mname_b').val('');
				$('#lname_b').val('');
			}else{
				$("#broker").show();
				$("#owner").hide();
				$("#fname_b").prop('required',true);
				$("#lname_b").prop('required',true);
			}
		});
		//OWNER/SELLER JQUERY
		
		document.querySelector('.send').addEventListener("click", function(){
			window.btn_clicked = true;
		});

		var $form = $('#add_own'),
		origForm = $form.serialize();

		$('#add_own :input').on('change input', function() {
			if($form.serialize() !== origForm){
				window.onbeforeunload = function(){
					if(!window.btn_clicked){ //was not clicked
						return 'Changes you made not be saved!';
					}
				};
			}
		});  

		// $('#town').on('change',function(){
		// 	var selected_op = $('#town').find('option:selected');
		// 	var zipcode = selected_op.data('zipcode');
		// 	console.log('zipcode',zipcode);
		// 	$('#zipcode').val(zipcode);
		// });
	});
</script>

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(event) {
		//JQUERY OF DATE ACQUIRED
		var d = new Date();
		var month = d.getMonth()+1;
		var day = d.getDate();
		var output = (month<10 ? '0' : '') + month + '/' + (day<10 ? '0' : '') + day + '/' + d.getFullYear();
		$("#date").val(output);
		//END JQUERY OF DATE ACQUIRED

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
			});
		}); 

		document.querySelector('.send').addEventListener("click", function(){
			window.btn_clicked = true;
		});

		var $form = $('#add_acq'),
		origForm = $form.serialize();

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
			url: "<?php echo site_url("Legal/Registry/getregion") ?>",
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
			url: "<?php echo site_url("Legal/Registry/getprovince") ?>",
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
			url: "<?php echo site_url("Legal/Registry/getcitymun") ?>",
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
			url: "<?php echo site_url("Legal/Registry/getbrgy") ?>",
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


<style>
	.x_panel2{
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
</style>