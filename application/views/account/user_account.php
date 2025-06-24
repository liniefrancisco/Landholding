<?php if (validation_errors()) { ?>
  	<div class="alert alert-danger alert-dismissible fade in" role="alert" style="position: fixed; bottom: 10px; right: 10px; z-index: 99; cursor: pointer;" id="saved">
		<?php echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' . validation_errors('<i class="fa fa-remove"></i> '); ?>
  	</div>
<?php } ?>
<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
  	<div class="row row_container">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!--====================FLASH DATA====================-->
		  	<?php if (($this->session->flashdata('update_user') == 'Profile Saved Successfully')) { ?>
				<div class="alert alert-success alert-dismissible fade in" role="alert" id="saved">
				  	<i class="glyphicon glyphicon-ok"></i>
				  	<?php echo $this->session->flashdata('update_user'); ?>
				</div>
		  	<?php } ?>

			<?php if (($this->session->flashdata('update_user') == 'Your Credentials Updated Successfully!')) { ?>
				<div class="alert alert-success alert-dismissible fade in" role="alert" id="saved">
				  	<i class="fa fa-info"></i>
				  	<?php echo $this->session->flashdata('update_user'); ?>
				</div>
			<?php } ?>

		  	<?php if (($this->session->flashdata('update_user') == 'Please Upload a valid Picture!')) { ?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert" id="saved">
				  	<i class="fa fa-close"></i>
				  	<?php echo $this->session->flashdata('update_user'); ?>
				</div>
		  	<?php } ?>

		  	<?php if (($this->session->flashdata('update_user') == ': No changes has been made!')) { ?>
				<div class="alert alert-info alert-dismissible fade in" role="alert" id="saved">
				  	<i class="fa fa-info"></i>
				  	<?php echo $this->session->flashdata('update_user'); ?>
				</div>
		  	<?php } ?>

	  		<?php if (($this->session->flashdata('update_user') == 'Username already exists, it must be unique.')) { ?>
				<div class="alert alert-info alert-dismissible fade in" role="alert" id="saved">
				  	<i class="fa fa-info"></i>
				  	<?php echo $this->session->flashdata('update_user'); ?>
				</div>
	  		<?php } ?>
	  		<!--====================END FLASH DATA====================-->

	  		<div class="x_panel animate slideInDown" style="box-shadow: 7px 6px 16px #888888;">
				<div class="x_title">
				  	<h2 class="fa fa-user"> <b>User Profile</b></h2>
				  	<div class="clearfix"></div>
				</div>
				<?php $id = $this->session->userdata('user_id'); ?>

				<div class="x_panel">
					<?php echo form_open_multipart('account'); ?>
						<div class="row">
							<!--====================IMAGE====================-->
		 					<div class="col-md-5" style="box-shadow: 7px 6px 16px #888888;">
		 						<div class="profile_picture text-center">
									<div class="form-group">
									  	<div class="col-md-12">
											<?php if ($this->session->userdata('image') == ''){ ?>
										  		<img class="col-md-12" id="display-img" src="<?= base_url() ?>assets/logo/default.png" alt="Profile Image">
											<?php }else{ ?>
										  		<img class="col-md-12" id="display-img" src="<?= base_url('assets/img/users/' . $this->session->userdata('user_type') . '/' . $this->session->userdata('image')) ?>" alt="Profile Image">
											<?php } ?>
									  	</div>
										<div class="col-md-12">
											<h4>Profile Image</h4>
										</div>
									</div>
								</div>
		  					</div>
		  					<div class="col-md-1"></div>
		  					<!--====================USER ACCOUNT====================-->
		  					<div class="col-md-6" style="box-shadow: -3px 0px 16px #888888;">
								<div class="registration-form">
			  						<p class="text-center"><b>USER ACCOUNT</b></p><hr>
			  						<div class="form-group">
										<label>Username:</label>
										<div class="input-group">
										  	<div class="input-group-addon"><i class="glyphicon glyphicon-user"></i></div>
										  	<input type="hidden" name="old_username" value="<?= $this->session->userdata('username') ?>">
										  	<input type="text" name="username" value="<?= $this->session->userdata('username') ?>"
											placeholder="Username" class="form-control" required>
										</div>
			  						</div>

			  						<div class="form-group">
										<label for="password">Password:</label>
										<div class="input-group">
				  							<div class="input-group-addon"><i class="glyphicon glyphicon-eye-close" id="change"></i></div>
				  							<input type="hidden" name="old_password" value="<?= $this->encryption->decrypt($this->session->userdata('password')) ?>">
				  							<input type="password" class="form-control" id="pword" name="password" value="<?= $this->encryption->decrypt($this->session->userdata('password')) ?>" placeholder="Password" required>
										</div>

										<div class="form-group">
										  	<label for="profileImage">Profile Image:</label>
										  	<input type="file" class="form-control" id="file" name="file" accept="image/*" multiple="false">
										</div><br/>
										<center><button  type="submit" class="btn btn-custom-primary" style="color:#ff9900; border: 2px solid">Save Changes</button></center>
			  						</div>
								</div>
		  					</div>
		  					<!--====================END USER ACCOUNT====================-->
						</div>
					<?php echo form_close(); ?>
				</div>
	  		</div>
		</div>
  	</div><br />
</div>
<!--====================END PAGE CONTENT====================-->

<script type="text/javascript">
	function readURL(input){
		if(input.files && input.files[0]){
			var reader = new FileReader();
			reader.onload = function (e){
				$('#display-img')
				.attr('src', e.target.result)
				.width(340)
				.height(270);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
	document.addEventListener("DOMContentLoaded", function (event){
		$("#change").click(function (){
			var p = $("#pword").attr("type");
			if(p == "text"){
				$("#pword").attr("type", "password");
				$("#change").attr("class", "glyphicon glyphicon-eye-close");
			}else{
				$("#pword").attr("type", "text");
				$("#change").attr("class", "glyphicon glyphicon-eye-open");
			}
		});
	});
</script>
<script type="text/javascript">
	var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];
	function ValidateSingleInput(oInput) {
		var sFileName = oInput.value;
		if (oInput.type == "file") {
			if (sFileName.length > 0) {
				var blnValid = false;
				for (var j = 0; j < _validFileExtensions.length; j++) {
					var sCurExtension = _validFileExtensions[j];
					if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
						blnValid = true;
						break;
					}
				}

				if (!blnValid) {
					alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
					oInput.value = "";
					return false;
				}
			}
		}
		return true;
	}
</script>

<style type="text/css">
	.registration-form {
		max-width:400px;
		margin:50px auto;
		background-color:#fff;
		padding:20px;
		border-radius:5px;
		box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
	}
	.profile_picture {
		display: flex;
		align-items: center;
		max-width:400px;
		margin:50px auto;
		background-color:#fff;
		padding:20px;
		border-radius:5px;
		box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
	}
</style>