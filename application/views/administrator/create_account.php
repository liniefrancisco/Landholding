<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!--====================FLASH DATA====================-->
			<?php if(($this->session->flashdata('error')=='Username already exists, it must be unique.')){?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert" id="saved">
					<i class="fa fa-info"></i>  <?php echo $this->session->flashdata('error'); ?>
				</div>
			<?php } ?>
			<!--====================START CONTENT====================-->
			<div class="x_panel animate zoomIn" style="box-shadow: 5px 8px 16px #888888">
				<div class="x_title">
					<h6 class="fa fa-user"> <b>Create User Account</b></h6>
					<a href="#" onclick="window.history.back()" class="btn btn-xs btn-warning pull-right"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
					<div class="clearfix"></div>
				</div>

				<div class="col-md-12">
					<form class="form-horizontal form-label-left" action="<?= base_url('Admin/add_user') ?>" method="POST">
						<div class="col-md-2"></div>
						<div class="col-md-9">   
							<div class="form-group">
								<label class="col-sm-3 control-label">Firstname:</label>
								<div class="col-md-4">
									<div class="input-group">
										<span class="input-group-btn">
											<button type="button" class="btn btn-primary" style="width: 40px;"><i class="fa fa-user"></i></button>
										</span>
										<input type="text" name="fname" value="<?php if(isset($_POST['fname'])){ echo $_POST['fname']; } ?>" class="form-control" required>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Lastname:</label>
								<div class="col-md-4">
									<div class="input-group">
										<span class="input-group-btn">
											<button type="button" class="btn btn-primary" style="width: 40px;"><i class="fa fa-user"></i></button>
										</span>
										<input type="text" name="lname" value="<?php if(isset($_POST['lname'])){ echo $_POST['lname']; } ?>" class="form-control" required>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Position:</label>
								<div class="col-md-4">
									<div class="input-group">
										<span class="input-group-btn">
											<button type="button" class="btn btn-primary" style="width: 40px;"><i class="fa fa-briefcase"></i></button>
										</span>
										<input type="text" name="position" value="<?php if(isset($_POST['position'])){ echo $_POST['position']; } ?>" class="form-control" required>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Username:</label>
								<div class="col-md-4">
									<div class="input-group">
										<span class="input-group-btn">
											<button type="button" class="btn btn-primary" style="width: 40px;"><i class="fa fa-key"></i></button>
										</span>
										<input type="text" name="username" value="<?php if(isset($_POST['username'])){ echo $_POST['username']; } ?>" class="form-control" required>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Password:</label>
								<div class="col-sm-4">
									<div class="input-group">
										<span class="input-group-btn">
											<button type="button" class="btn btn-primary" style="width: 40px;"><i class="fa fa-lock"></i></button>
										</span>
										<input type="text" name="password" value="<?php if(isset($_POST['password'])){ echo $_POST['password']; } ?>" class="form-control" required>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">User Type:</label>
								<div class="col-sm-4">
									<div class="input-group">
										<span class="input-group-btn">
											<button type="button" class="btn btn-primary" style="width: 40px;"><i class="fa fa-info"></i></button>
										</span>
										<select name="user_type" class="form-control" required>
											<option value="">Select</option>
											<option value="Administrator" <?php if(@$_POST['user_type'] == "Administrator"){ echo "selected";} ?>>Administrator</option>
											<option value="CCD" <?php if(@$_POST['user_type'] == "CCD"){ echo "selected";} ?>>CCD</option>
											<option value="Secretary" <?php if(@$_POST['user_type'] == "Secretary"){ echo "selected";} ?>>Secretary</option>
											<option value="GM" <?php if(@$_POST['user_type'] == "GM"){ echo "selected";} ?>>General Manager</option>
											<option value="Legal" <?php if(@$_POST['user_type'] == "Legal"){ echo "selected";} ?>>Legal</option>
											<option value="Accounting" <?php if(@$_POST['user_type'] == "Accounting"){ echo "selected";} ?>>Accounting</option>
										</select>
									</div>
								</div>
							</div>

							<div class="col-sm-4"></div>
							<button name="create_user" class="btn btn-primary">Create</button>
							<a href="<?= base_url() ?>" class="btn btn-danger">Cancel</a>
						</div>
					</form>                      
				</div>        
			</div>  
			<!--====================END CONTENT====================-->
		</div>        
	</div>
</div>
<!--====================END PAGE CONTENT====================-->