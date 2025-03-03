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

				<?php echo form_open('Registry/owners_info/'.$li['is_no'], array('id' => 'add_own'));?>
					<!--====================BODY====================-->
					<div class="x_panel" style="border-radius:9px; ">
						<div class="col-md-12 col-sm-12 col-xs-12 form_border">   
							<div class="col-md-12 col-sm-12 col-xs-12 space">
								<div class="col-md-3 col-sm-3 col-xs-3 form-inline">
									<label>Presentor: </label>
									<label class="r-contain">
										<input type="radio" name="presentor" value="Owner" <?php if (@$_POST['presentor'] == "Owner"){ echo "checked"; } ?> class="pres" required> Owner <span class="checkmark"></span>
									</label>
									<label class="r-contain">
										<input type="radio" name="presentor" value="Broker" <?php if (@$_POST['presentor'] == "Broker"){ echo "checked"; } ?> class="pres" required> Broker <span class="checkmark"></span>
									</label>
								</div>

								<div class="col-md-9 col-sm-9 col-xs-9 form-inline" id="broker" <?php if(@$_POST['presentor'] == "Broker"){ echo 'style="display: block;"';}else{ echo 'style="display: none;"'; } ?>>
									<div class="col-md-3 col-sm-3 col-xs-3">
										<input type="text" name="broker_first" value="<?php if(isset($_POST['broker_first'])){ echo $_POST['broker_first']; } ?>" class="form-control input_border txt_cent" placeholder="Broker's Firstname" id="fname">
										<h6 class="name_center"><i>Firstname</i></h6>
									</div>
									<div class="col-md-3 col-sm-3 col-xs-3">
										<input type="text" name="broker_middle" value="<?php if(isset($_POST['broker_middle'])){ echo $_POST['broker_middle']; } ?>" class="form-control input_border txt_cent" placeholder="Broker's Middlename" id="mname">
										<h6 class="name_center"><i>Middlename</i></h6>
									</div>
									<div class="col-md-3 col-sm-3 col-xs-3">
										<input type="text" name="broker_last" value="<?php if(isset($_POST['broker_last'])){ echo $_POST['broker_last']; } ?>" class="form-control input_border txt_cent" placeholder="Broker's Lastname" id="lname">
										<h6 class="name_center"><i>Lastname</i></h6>
									</div>
								</div>                                       
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 space" style="border-top: 2px solid #ff6600; border-bottom: 2px solid #ff6600;">
								<center><h5 style="letter-spacing: 10px">OWNER'S INFORMATION</h5></center>
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 space"> 
								<div class="col-md-3 col-sm-3 col-xs-3"><label>Lot Owner:</label></div>
								<div class="col-md-3 col-sm-3 col-xs-3">
									<input type="text" name="firstname" value="<?php if(isset($_POST['firstname'])){ echo $_POST['firstname']; } ?>" class="form-control input_border txt_cent" id="owfname" required>
									<h6 class="name_center"><i>Firstname</i></h6>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-3">
									<input type="text" name="middlename" value="<?php if(isset($_POST['middlename'])){ echo $_POST['middlename']; } ?>" class="form-control input_border txt_cent" id="owmname" required>
									<h6 class="name_center"><i>Middlename</i></h6>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-3">
									<input type="text" name="lastname" value="<?php if(isset($_POST['lastname'])){ echo $_POST['lastname']; } ?>" class="form-control input_border txt_cent" id="owlname" required>
									<h6 class="name_center"><i>Lastname</i></h6>
								</div>
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 space">
								<div class="col-md-4 col-sm-4 col-xs-4"><label>Gender</label></div>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<label class="r-contain">
										<input type="radio" name="gender" value="Male" <?php if(@$_POST['gender'] == "Male"){ echo 'checked'; } ?> required> Male <span class="checkmark"></span>
									</label>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<label class="r-contain">
										<input type="radio" name="gender" value="Female" <?php if(@$_POST['gender'] == "Female"){ echo 'checked'; } ?> required> Female <span class="checkmark"></span>
									</label>
								</div>
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 space">
								<div class="col-md-4 col-sm-4 col-xs-4"><label>Vital Status</label></div>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<label class="r-contain">
										<input type="radio" name="vital" <?php if(@$_POST['vital'] == "Alive"){ echo 'checked'; } ?> value="Alive" required> Alive <span class="checkmark"></span>
									</label>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<label class="r-contain">
										<input type="radio" name="vital" <?php if(@$_POST['vital'] == "Deceased"){ echo 'checked'; } ?> value="Deceased" required> Deceased <span class="checkmark"></span>
									</label>
								</div>
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 space"> 
								<div class="col-md-3 col-sm-3 col-xs-3"><label>Address</div>
								<div class="col-md-3 col-sm-3 col-xs-3">
									<select class="form-control input_border" id="region" name="region" style="text-align: center;" onchange="loadProvince()" value="<?php echo set_value('region'); ?>" required>
										<option value="">Select Region</option>
									</select>
									<h6 class="name_center"><i>Region</i></h6>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-3">
									<select class="form-control input_border" id="province" name="province" style="text-align: center;" onchange="loadCity()" value="<?php echo set_value('province'); ?>"  required>
										<option value="">Select Province</option>
									</select>
									<h6 class="name_center"><i>Province</i></h6>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-3">
								 	<select class="form-control input_border" id="town" name="town" style="text-align: center;" onchange="loadBrgy()" value="<?php echo set_value('town'); ?>"  required>
										<option value="">Select City/ Municipality</option>
									</select>
									<h6 class="name_center"><i>City/Municipality</i></h6>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-3"><label></div>
									<div class="col-md-3 col-sm-3 col-xs-3">
										<select class="form-control input_border" id="barangay" name="barangay" style="text-align: center;" value="<?php echo set_value('baranggay') ?>" required>
											<option value="">Select Barangay</option>
										</select>
										<h6 class="name_center"><i>Barangay</i></h6>
									</div>
									<div class="col-md-3 col-sm-3 col-xs-3">
										<input type="text" class="form-control input_border" name="street" id="street" style="text-align: center;" value="<?php echo set_value('street') ?>"  required>
										<h6 class="name_center"><i>Street</i></h6>
									</div>
									<div class="col-md-3 col-sm-3 col-xs-3">
										<input type="text" class="form-control input_border" name="zipcode" id="zipcode" style="text-align: center;" value="<?php echo set_value('zipcode') ?>"  required>
										<h6 class="name_center"><i>Zipcode</i></h6>
									</div>
						 		</div>

								<div class="col-md-12 col-sm-12 col-xs-12"><b><i>Main Contact Person:</i></b></div>
								<div class="col-md-12 col-sm-12 col-xs-12 space" style="border-top: 1px solid #ff6600; border-bottom: 2px solid #ff6600; padding-bottom: 10px; padding-top: 10px;">     
									<div class="col-md-6 col-sm-6 col-xs-6 form-inline">
										<label class="col-md-3">Name:</label>
										<input type="text" name="fullname" value="<?php if(isset($_POST['fullname'])){ echo $_POST['fullname']; } ?>" id="cp_name" class="form-control input_border">
									</div>
									<div class="col-md-6 col-sm-6 col-xs-6 form-inline">
										<label class="col-md-3">Address</label>
										<input type="text" name="address" value="<?php if(isset($_POST['address'])){ echo $_POST['address']; } ?>" id="cp_address" class="form-control input_border">
									</div>
									<div class="col-md-6 col-sm-6 col-xs-6 form-inline">
										<label class="col-md-3">Telephone No:</label>
										<input type="text" name="tel_no" value="<?php if(isset($_POST['tel_no'])){ echo $_POST['tel_no']; } ?>" id="cp_telno" class="form-control input_border">
									</div>
									<div class="col-md-6 col-sm-6 col-xs-6 form-inline">
										<label class="col-md-3">Phone No:</label>
										<input type="text"  min="11" id="cp_phone" name="phone_no" value="<?php if(isset($_POST['phone_no'])){ echo $_POST['phone_no']; } ?>" class="form-control input_border" pattern="[0-9]{11}">
									</div>
									<div class="col-md-6 col-sm-6 col-xs-6 form-inline">
										<label class="col-md-3">Email Address:</label>
										<input type="email" name="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>" id="cp_email" class="form-control input_border">
									</div>
								</div>   
							</div>
						</div>
					</div>    
					<div style="float: right;">
						<a href="<?= base_url() ?>" class="btn btn-default">Previous</a><input type="submit" name="submit" class="btn btn-custom-primary send" value="Submit">
					</div>                             
				</form>
			</div>
		</div>
	</div>
</div>
<!--====================END PAGE CONTENT====================-->

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(event) {
		$(".pres").click(function(){
			var a = $(this).attr("value");

			if(a == "Owner"){
				$("#broker").hide();
				$("#fname").prop('required',false);
				$("#mname").prop('required',false);
				$("#lname").prop('required',false);

				$('#fname').val('');
				$('#mname').val('');
				$('#lname').val('');
			}else{
				$("#broker").show();
				$("#fname").prop('required',true);
				$("#mname").prop('required',true);
				$("#lname").prop('required',true);
			}
		});


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

		$('#town').on('change',function(){
			var selected_op = $('#town').find('option:selected');
			var zipcode = selected_op.data('zipcode');
			console.log('zipcode',zipcode);
			$('#zipcode').val(zipcode);
		});
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
			url: "<?php echo site_url("Registry/getregion") ?>",
			method: "POST",
			success: function(data) {
				var jObj = JSON.parse(data);
				for (var c = 0; c < jObj.length; c++) {
					$('#region').append('<option value="' + jObj[c].regDesc + '" data-code="'+jObj[c].regCode+'">' + jObj[c].regDesc + '</option>');
				}
			}
		});
	}
	loadRegion();

	function loadProvince() {
		$("#province").html("");
		$("#province").append('<option value="">Select Province</option>');
		var seleted_op = $('#region').find('option:selected');
		var regCode = seleted_op.data('code');
	 
		$.ajax({
			url: "<?php echo site_url("Registry/getprovince") ?>",
			method: "POST",
			dataType: 'json',
			data: {
				regCode: regCode
			},
			success: function(data) {
				$.each(data, function(i, data) {
					$('#province').append('<option value="' + data.provDesc + '" data-code="'+data.provCode+'">' + data.provDesc + '</option>');
				});
			}
		});
	}

 	function loadCity() {
		$("#town").html("");
		$("#town").append('<option value="">Select City/Municipality</option>');
		var selected_op = $('#province').find('option:selected');
		var provCode = selected_op.data('code');
		$.ajax({
			url: "<?php echo site_url("Registry/getcitymun") ?>",
			method: "POST",
			dataType: 'json',
			data: {
				provCode: provCode
			},
			success: function(data) {
				$.each(data, function(i, data) {
					$('#town').append('<option value="' + data.citymunDesc + '" data-zipcode="'+data.zipcode+'" data-code="'+data.citymunCode+'">' + data.citymunDesc + '</option>');
				});
			}
		});
	}

 	function loadBrgy() {
		$("#barangay").html("");
		$("#barangay").append('<option value="">Select Barangay</option>');

		var provDesc = $("#province").val();
		var selected_op = $('#town').find('option:selected');

		var citymunCode = selected_op.data('code');
		var citymunDesc = selected_op.val();
	 
		var dist = "";
		var dist1 = [
			"ALBURQUERQUE",
			"ANTEQUERA",
			"BACLAYON",
			"BALILIHAN",
			"CALAPE",
			"CATIGBIAN",
			"CORELLA",
			"CORTES",
			"DAUIS",
			"LOON",
			"MARIBOJOC",
			"PANGLAO",
			"SIKATUNA",
			"TAGBILARAN CITY",
			"TUBIGON"
		];

		var dist2 = [
			"BIEN UNIDO",
			"BUENAVISTA",
			"CLARIN",
			"DAGOHOY",
			"DANAO",
			"GETAFE",
			"INABANGA",
			"PRES. CARLOS P. GARCIA",
			"SAGBAYAN",
			"SAN ISIDRO",
			"SAN MIGUEL",
			"TALIBON",
			"TRINIDAD",
			"UBAY"
		];

		var dist3 = [
			"ALICIA",
			"ANDA",
			"BATUAN",
			"BILAR",
			"CANDIJAY",
			"CARMEN",
			"DIMIAO",
			"DUERO",
			"GARCIA HERNANDEZ",
			"GUINDULMAN",
			"JAGNA",
			"LILA",
			"LOAY",
			"LOBOC",
			"MABINI",
			"PILAR",
			"SEVILLA",
			"SIERRA BULLONES",
			"VALENCIA"
		];

		if (provDesc == 'BOHOL') {
			if (dist1.includes(citymunDesc)) {
				$("#district").val("District 1");
			} else if (dist2.includes(citymunDesc)) {
				$("#district").val("District 2");
			} else if (dist3.includes(citymunDesc)) {
				$("#district").val("District 3");
			}
		}

		$.ajax({
			url: "<?php echo site_url("Registry/getbrgy") ?>",
			method: "POST",
			dataType: 'json',
			data: {
				citymunCode: citymunCode
			},
			success: function(data) {
				$.each(data, function(i, data) {
					$('#barangay').append('<option value="' + data.brgyDesc + '" data-code="'+data.brgyCode+'">' + data.brgyDesc + '</option>');
				});
			}
		});
	}
</script>
