<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissible fade in" role="alert" style="position: fixed; bottom: 10px; right: 10px; z-index: 99; cursor: pointer;" id="saved">
		<?php echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'. validation_errors('<i class="fa fa-remove"></i> '); ?>
	</div>
<?php } ?>

<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container">
		<!--====================BUTTON====================-->
		<button onclick="topFunction()" id="mvTop" title="Go to top"><i class="fa fa-arrow-up"></i>Top</button>
		<?php if ($ds['status'] == 'Returned') { ?>
			<div class="col-md-12 space">
				<div class="col-md-6"></div>
				<div class="col-md-6" style="position: fixed;width: 250px;bottom: 15px;right: 10px;z-index: 99;cursor: pointer;">
					<button style="float: right;border-radius: 10px" class="btn btn-xs btn-custom-danger" data-dismiss="modal" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target=".resubmit_<?php echo $li['is_no']; ?>" title="Mark as Resubmit"><span class="fa fa-check-square-o"></span> Resubmit</button>
				</div>
			</div>
		<?php } ?>
		<!--====================END BUTTON====================-->
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!--====================FLASH DATA====================-->
			<?php if($this->session->flashdata('success')){?>
				<div class="alert alert-success alert-dismissible fade in" role="alert" id="saved">
					<i class="glyphicon glyphicon-ok"></i>  <?php echo $this->session->flashdata('success'); ?>
				</div>
			<?php } ?>

			<?php if($this->session->flashdata('error')){?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert" id="saved">
					<i class="glyphicon glyphicon-remove"></i>  <?php echo $this->session->flashdata('error'); ?>
				</div>
			<?php } ?>
			<!--====================END FLASH DATA====================-->

			<div class="x_panel animate slideInDown" style="border:1px; !important;box-shadow: 7px 6px 16px #888888;">
				<div class="x_title">
					<h2><span class="fa fa-pencil-square" style="color: #000000"></span> Edit Interview Sheet</h2>
					<a href="#" onclick="window.history.back()" class="btn btn-sm btn-warning" style="float: right;"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
					<div class="clearfix"></div>
				</div>

				<center style="margin-top: 50px;"><h3 class="h3">Select what to Edit</h3></center>
				<div class="container" style="margin-top: 50px; padding-bottom: 120px; ">
					<div class="col-md-4">
						<center><button class="button" data-toggle="modal" data-target=".edit_land_info"><h4><span class="fa fa-pencil"></span> Land Information</h4></button></center>
					</div>
					<div class="col-md-4">
						<center><button class="button" data-toggle="modal" data-target=".edit_owner_info" ><h4><span class="fa fa-pencil"></span> Owner Information</h4></button></center>
					</div>
					<div class="col-md-4">
						<center><button class="button" data-toggle="modal" data-target=".edit_proof_title"><h4><span class="fa fa-pencil"></span>  Proof of Title</h4></button></center>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>
<!--====================END PAGE CONTENT====================-->

<!--====================EDIT LAND INFORMATION MODAL HERE====================-->
<div class="modal fade edit_land_info" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);">
			<div class="modal-header" style="background-color: #ff9900; color: white;">
				<button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel">Land Information</h4>
			</div>
			<div class="modal-body">                                     
				<?php echo form_open('Secretary/Execute/edit_interview_sheet/'.$li['is_no'],array('id' => "edit_acq_land_info")); ?>
					<center><div class="change-message">*You have unsaved changes.</div></center>
	
					<div class="col-md-12 " style="border:1px solid #E6E9ED;">
						<div class="col-md-3" style="border-right: 3px solid #E6E9ED;">
							<label>Lot Type:</label>                  
						</div>
						<div class="col-md-3" style="border-right: 3px solid #E6E9ED;">
							<input type="radio" name="lot_type" value="Agricultural" <?php if($li['lot_type'] == 'Agricultural'){ echo 'checked'; } ?>><b>Agricultural</b>
						</div>
						<div class="col-md-3">
							<input type="radio" name="lot_type" value="Commercial" <?php if($li['lot_type'] == 'Commercial'){ echo 'checked'; } ?>><b>Commercial</b>
						</div>
						<div class="col-md-3" style="border-left: 3px solid #E6E9ED;">
							<input type="radio" name="lot_type" value="Residential" <?php if($li['lot_type'] == 'Residential'){ echo 'checked'; } ?>><b>Residential</b>
						</div>
					</div>

					<div class="row">
						<div class="x_panel2">
							<div class="form-inline col-md-6">
								<div class="col-md-1"></div>
								<div class="form-group">
									<label class="col-md-3 control-label">Lot<span class="required text-danger">*</span></label>
									<div class="col-md-4">
										<input type="text" min="0" name="lot_no" class="form-control"  value="<?php  echo $li['lot'] ?>" >
									</div>
								</div>
							</div>

							<div class="form-inline col-md-6">
								<div class="col-md-1"></div>
								<div class="form-group">
									<label class="col-md-3 control-label">Cad<span class="required text-danger">*</span></label>
									<div class="col-md-4">
										<input type="text" min="0"  name="cad_no" class="form-control" value="<?php  echo $li['cad'] ?>" >
									</div>
								</div>
							</div>
						</div>  
					</div>                                    

					<div class="row">
						<div class="x_panel2">
							<div class="x_title">
								<h2>Lot Location</h2>
								<div class="clearfix"></div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="form-horizontal">
										<div class="form-group">
											<label class="col-md-3 control-label">Street<span class="required text-danger">*</span></label>
											<div class="col-md-7">
												<input type="text" name="street" class="form-control" value="<?php echo $ll['street'] ?>" >
											</div>
										</div>
									</div>

									<div class="form-horizontal">
										<div class="form-group">
											<label class="col-md-3 control-label">Baranggay<span class="required text-danger">*</span></label>
											<div class="col-md-7">
												<input type="text" name="baranggay" class="form-control" value="<?php echo $ll['baranggay'] ?>" id="barangay" >
											</div>
										</div>
									</div>

									<div class="form-horizontal">
										<div class="form-group">
											<label class="col-md-3 control-label">Town<span class="required text-danger">*</span></label>
											<div class="col-md-7">
												<input type="text" name="town" class="form-control" value="<?php echo $ll['municipality'] ?>" id="town" >
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="form-horizontal">
										<div class="form-group">
											<label class="col-md-3 control-label">Province<span class="required text-danger">*</span></label>
											<div class="col-md-7">
												<input type="text" class="form-control" name="province" value="<?php echo $ll['province'] ?>" id="province" >
											</div>
										</div>
									</div>

									<div class="form-horizontal">
										<div class="form-group">
											<label class="col-md-3 control-label">Country<span class="required text-danger">*</span></label>
											<div class="col-md-7">
												<input type="text" class="form-control" name="country" value="<?php echo $ll['country'] ?>" id="country">
											</div>
										</div>
									</div>

									<div class="form-horizontal">
										<div class="form-group">
											<label class="col-md-3 control-label">Zip Code<span class="required text-danger">*</span></label>
											<div class="col-md-7">
												<input type="text" class="form-control" name="zip_code" value="<?php echo $ll['zip_code'] ?>" id="zipcode" >
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
	
							
					<div class="x_panel4">
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-md-3 control-label">Lot Sold<span class="required text-danger">*</span></label>
										<div class="col-md-7">
											<select class="form-control" name="lot_sold" id="sold" style="border: 1px solid #1abb9c8a;" >
												<option value="" >Select Type</option>
												<option value="Portion" <?php if($li['lot_sold'] == 'Portion'){ echo 'selected'; } ?> >Portion</option>
												<option value="Whole" <?php if($li['lot_sold'] == 'Whole'){ echo 'selected'; } ?> >Whole</option>
											</select>
										</div>
									</div>
								</div>

								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-md-3 control-label">Purchase Type<span class="required text-danger">*</span></label>
										<div class="col-md-7">
											<select class="form-control" id="purchase_type" style="border: 1px solid #1abb9c8a;" name="purchase_type">
												<option value="" >Select Type</option>
												<option value="package" class="select_op" <?php if($li['purchase_type'] == 'package'){ echo 'selected'; } ?>>Package</option>
												<option value="per/sq.m." class="select_op" <?php if($li['purchase_type'] == 'per/sq.m.'){ echo 'selected'; } ?>>Per/sq.m.</option>
											</select>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="control-group">
									<div class="controls">
										<label class="control-label col-md-3" for="first-name">Lot Area<span class="required text-danger">*</span></label>
										<div class="input-group col-md-7 xdisplay_inputx form-group has-feedback">
											<input id="la_form" name="lot_area" type="text"  class="form-control" value="<?php echo $li['lot_size']; ?>" />
											<div class="input-group-addon">m<sup>2</sup></div>
										</div>
									</div>
								</div> 

								<div class="control-group"  id="Square" <?php if($li['purchase_type'] == 'package'){ echo 'style="display: none;"'; } ?>>
									<div class="controls">
										<label class="control-label col-md-3" for="first-name">Selling Price/m2<span class="required text-danger">*</span></label>
										<div class="input-group col-md-7 xdisplay_inputx form-group has-feedback">
											<div class="input-group-addon">₱</div>
											<input id="sp_form" name="selling_price" type="text"  class="form-control" value="<?php echo $li['price_per_sqm'] ?>" />
										</div>
									</div>
								</div> 

								<div class="control-group">
									<div class="controls">
										<label class="control-label col-md-3" for="first-name">Total Purchase Price<span class="required text-danger">*</span></label>
										<div class="input-group col-md-7 xdisplay_inputx form-group has-feedback">
											<div class="input-group-addon">₱</div>
											<input id="total_form" name="total_price" type="text" class="form-control" value="<?php echo $li['total_price'] ?>" <?php if($li['purchase_type'] == 'per/sq.m.'){ echo 'readonly'; } ?> />
										 </div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="x_panel4">
							<div class="x_title">
								<h2>Restriction/s to Land Title</h2>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<label>Liens</label>
								</div>
								<div class="col-md-9">
									<textarea style="width: 100%; border: 1px solid #1abb9c8a;" name="liens" value="" id="liens" class="form-control"><?php echo isset($rstr) && isset($rstr['liens']) ? $rstr['liens'] : ''; ?></textarea>
								</div>
								<div class="col-md-3">
									<label>Easement</label>
								</div>
								<div class="col-md-9">
									<textarea style="width: 100%; border: 1px solid #1abb9c8a;" name="easement" value="" id="ease" class="form-control"><?php echo isset($rstr) && isset($rstr['easement']) ? $rstr['easement'] : ''; ?></textarea>
								</div>
								<div class="col-md-3">
									<label>Encumbrances</label>
								</div>
								<div class="col-md-9">
									<textarea style="width: 100%; border: 1px solid #1abb9c8a;" name="encumbrances" value="" id="encum" class="form-control"><?php echo isset($rstr) && isset($rstr['encumbrances']) ? $rstr['encumbrances'] : ''; ?></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						<input type="submit" name="li_update" class="btn btn-custom-primary" id="li_edit_btn" style="color:#ff9900; border: 2px solid" value="Save Changes" disabled>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--====================END MODAL====================-->

<!--====================EDIT OWNER INFORMATION MODAL HERE====================-->
<div class="modal fade edit_owner_info" tabindex="-1" role="dialog" aria-hidden="true"  data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);">
			<div class="modal-header" style="background-color: #ff9900; color: white;">
				<button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel">Owner Information</h4>
			</div>

			<div class="modal-body">     
				<?php
					// Check if data exists for a broker
					if (!empty($bi)) {
						// Data for a broker exists in $bi
						$count_bi = 1; // You can set this to any non-zero value
						$presentor = 'Broker';
					}else{
						// No data for a broker, assume it's an owner/seller
						$count_bi = 0;
						$presentor = 'Owner/Seller';
					}
				?>

				<?php echo form_open('Secretary/Execute/edit_interview_sheet/'.$li['is_no'],array('id' => "edit_acq_owner_info")); ?>
					<center><div class="change-message">*You have unsaved changes.</div></center>

					<div class="x_panel3" style="width:100%;position:relative; border-radius:9px;padding-bottom: 12px; padding-top: 12px;border:1px solid #E6E9ED;">
						<div class="col-md-4"></div>
						<h2 style="font-family:serif;font-size: 19px;display:inline;">Presentor :</h2>
						<label style="padding-left:10px"><input type="radio" id="" name="presentor" class="appearance" value="Owner/Seller" <?php if($count_bi === 0){ echo 'checked'; } ?> >Owner/Seller</label>
						<label style="padding-left:15px"><input type="radio" id="" name="presentor" class="appearance" value="Broker" <?php if($count_bi === 1){ echo 'checked'; } ?>>Broker</label>
						<div class="clearfix"></div>
					</div>

					<div class="row"  id="broker"<?php if($count_bi === 0){ echo 'style="border-radius:9px; display:none;"'; }else{ echo 'style="border-radius:9px; display:block;"'; } ?>>
						<div class="x_panel2">
							<div class="x_title">
								<h2>Broker's Name</h2>
								<div class="clearfix"></div>
							</div>
																	
							<div class="col-md-4 form-inline">
								<label class="control-label">Firstname<span class="required text-danger">*</span></label>
								<input type="text" name="broker_first" class="form-control" id="fname_b" value="<?php echo isset($bi['firstname']) ? $bi['firstname'] : '' ?>">
							</div>

							<div class="col-md-4 form-inline">
								<label class="control-label">Middlename<span class="required text-danger">*</span></label>
								<input type="text" name="broker_middle" class="form-control" id="mname_b" value="<?php echo isset($bi['middlename']) ? $bi['middlename'] : '' ?>" >
							</div>

							<div class="col-md-4 form-inline">
								<label class="control-label">Lastname<span class="required text-danger">*</span></label>
								<input type="text" name="broker_last" class="form-control" id="lname_b"  value="<?php echo isset($bi['lastname']) ? $bi['lastname'] : '' ?>" >
							</div>
						</div>                         
					</div>

					<div class="row">
						<div class="x_panel2">
							<div class="x_title">
								<h2>Owner's Name</h2>
								<div class="clearfix"></div>
							</div>

							<div class="form-horizontal">
								<div class="form-group">                                         
									<div class="col-md-4 form-inline">
										<label class="control-label">Firstname<span class="required text-danger">*</span></label>
										<input type="text" name="firstname" class="form-control" value="<?php  echo $oi['firstname'] ?>" required>
									</div>  

									<div class="col-md-4 form-inline">
										<label class="control-label">Middlename<span class="required text-danger">*</span></label>
										<input type="text" name="middlename" id="mid" class="form-control" value="<?php  echo $oi['middlename'] ?>" required>
									</div>

									<div class="col-md-4 form-inline">
										<label class="control-label">Lastname<span class="required text-danger">*</span></label>
										<input type="text" name="lastname" class="form-control" value="<?php  echo $oi['lastname'] ?>" required>
									</div>                                         
								</div>                                     
							</div>
						</div>
					</div>
									 
					<div class="row">
						<div class="x_panel2">
							<div class="x_title">
								<h2>Owner's Address</h2>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="form-horizontal">
										<div class="form-group">
											<label class="col-md-3 control-label">Street<span class="required text-danger">*</span></label>
											<div class="col-md-7">
												<input type="text" name="street" class="form-control" value="<?php echo $oa['street'] ?>" required>
											</div>
										</div>
									</div>

									<div class="form-horizontal">
										<div class="form-group">
											<label class="col-md-3 control-label">Baranggay<span class="required text-danger">*</span></label>
											<div class="col-md-7">
												<input type="text" name="baranggay" class="form-control" value="<?php echo $oa['baranggay'] ?>"  id="barangay" required>
											</div>
										</div>
									</div> 

									<div class="form-horizontal">
										<div class="form-group">
											<label class="col-md-3 control-label">Town<span class="required text-danger">*</span></label>
											<div class="col-md-7">
												<input type="text" name="town" id="town" class="form-control" value="<?php echo $oa['municipality'] ?>" required>
											</div>
										</div>
									</div>      
								</div>

								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="form-horizontal">
										<div class="form-group">
											<label class="col-md-3 control-label">Province<span class="required text-danger">*</span></label>
											<div class="col-md-7">
												<input type="text" class="form-control" name="province" value="<?php echo $oa['province'] ?>" id="province" required>
											</div>
										</div>
									</div>

									<div class="form-horizontal">
										<div class="form-group">
											<label class="col-md-3 control-label">Country<span class="required text-danger">*</span></label>
											<div class="col-md-7">
												<input type="text" class="form-control" name="country" value="<?php echo $oa['country'] ?>" id="country" required>
											</div>
										</div>
									</div>

									<div class="form-horizontal">
										<div class="form-group">
											<label class="col-md-3 control-label">ZipCode<span class="required text-danger">*</span></label>
											<div class="col-md-7">
												<input type="text" class="form-control" name="zip_code" value="<?php echo $oa['zip_code'] ?>" id="zip_code" required>
											</div>
										</div>
									</div>
								</div>
							</div>          
						</div>
					</div>

					<div class="col-md-12 form-inline">
						<h2>Gender</h2>
						<div class="clearfix"></div>
						<div class="col-md-2"></div>
						<div class="col-md-2">                                  
							<input type="radio" name="gender" value="Male" <?php if($oi['gender'] == 'Male'){ echo 'checked'; } ?> required><label class="control-label">Male<span class="required text-danger">*</span></label>
						</div>

						<div class="col-md-2">                                            
							<input type="radio" name="gender" value="Female" <?php if($oi['gender'] == 'Female'){ echo 'checked'; } ?> required><label class="control-label">Female<span class="required text-danger">*</span></label>
						</div>
					</div>

					<div class="col-md-12 form-inline">
						<h2>Vital Status</h2>
						<div class="clearfix"></div>
						<div class="col-md-2"></div>
						<div class="col-md-2">                                  
							<input type="radio" name="vital_status" value="Alive" <?php if($oi['vital_status'] == 'Alive'){ echo 'checked'; } ?> required><label class="control-label">Alive<span class="required text-danger">*</span></label>
						</div> 

						<div class="col-md-2">                                            
							<input type="radio" name="vital_status" value="Deceased" <?php if($oi['vital_status'] == 'Deceased'){ echo 'checked'; } ?> required><label class="control-label">Deceased<span class="required text-danger">*</span></label>
						</div>
					</div> 

					<div class="x_panel4" style="padding-bottom: 30px;padding-top: 10px; margin-top: 20px;">
						<div class="x_title">
							<h2>Main Contact Person</h2>
							<div class="clearfix"></div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class=" form-inline">
									<label class="col-md-3">Fullname<span class="required text-danger">*</span></label>
									<input type="text" name="fullname" id="f_name" class="form-control" value="<?php echo $cp['name']?>" required>
								</div>
								<div class="form-inline" style="margin-top: 5px;">
									<label class="col-md-3">Address<span class="required text-danger">*</span></label>
									<input type="text" name="address" class="form-control" value="<?php echo $cp['address'] ?>" required>
								</div>
							</div>
										 
							<div class="col-md-6">
								<div class=" form-inline">
									<label class="col-md-4">Telephone No.<span class="required text-danger">*</span></label>
									<input type="text" name="tel_no" class="form-control" value="<?php echo $cp['tel_no'] ?>">
								</div>
								<div class=" form-inline" style="margin-top: 5px; ">
									<label class="col-md-4">Phone No.<span class="required text-danger">*</span></label>
									<input type="text"  name="phone_no"   class="form-control" value="<?php echo $cp['phone_no'] ?>" pattern="[0-9]{11}" required>
								</div>
								<div class=" form-inline" style="margin-top: 5px;">
									<label class="col-md-4">Email-address<span class="required text-danger">*</span></label>
									<input type="email" name="email" data-parsley-trigger="change" class="form-control" value="<?php echo $cp['email_ad'] ?>" >
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<input type="submit" name="oi_update" class="btn btn-custom-primary" style="color: #ff9900; border: 2px solid;" id="oi_edit_btn" value="Save Changes" disabled>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- ===================================== END MODAL ========================================================= -->

<!-- ===================================== EDIT PROOF OF TITLE MODAL HERE ========================================================= -->
<div class="modal fade edit_proof_title" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);">
			<div class="modal-header" style="background-color: #ff9900; color: white;">
				<button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel">Proof of Title</h4>
				<input type="text" name="isno" value="<?php echo $li['is_no']?>" hidden>
			</div>

			<div class="modal-body"> 
				<div class="row">
					<!--====================Dropdown====================-->
					<div class="col-md-12">
						<center><code><h5>Select what you want to upload here<br> <i class="glyphicon glyphicon-arrow-down"></i></h5></code></center>
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<select class="form-control" id="upload_doc" required>
								<option value="">Select</option>
								<option value="LT" <?php if (!empty($ud['land_title'])) { echo 'style="color:black;"'; } else { echo 'style="color:red;"'; } ?>>Land Title</option>
								<option value="TCT" <?php if (!empty($ud['tct'])) { echo 'style="color:black;"'; } else { echo 'style="color:red;"'; } ?>>TCT</option>
								<option value="DOS" <?php if (!empty($ud['previous_deed_of_sale'])) { echo 'style="color:black;"'; } else { echo 'style="color:red;"'; } ?>>Previous Deed of Sale</option>
								<option value="eCar" <?php if (!empty($ud['e_car'])) { echo 'style="color:black;"'; } else { echo 'style="color:red;"'; } ?>>eCAR</option>
								<option value="TD" <?php if (!empty($ud['latest_tax_dec'])) { echo 'style="color:black;"'; } else { echo 'style="color:red;"'; } ?>>Tax Declaration</option>
								<option value="TC" <?php if (!empty($ud['tax_clearance'])) { echo 'style="color:black;"'; } else { echo 'style="color:red;"'; } ?>>Tax Clearance</option>
								<option value="LS" <?php if (!empty($ud['land_sketch'])) { echo 'style="color:black;"'; } else { echo 'style="color:red;"'; } ?>>Sketch Plan</option>
								<option value="VM" <?php if (!empty($ud['vicinity_map'])) { echo 'style="color:black;"'; } else { echo 'style="color:red;"'; } ?>>Vicinity Map</option>
								<option value="CNI" <?php if (!empty($ud['cert_no_improvement'])) { echo 'style="color:black;"'; } else { echo 'style="color:red;"'; } ?>>Certification of No Improvement </option>
								<option value="RET" <?php if (!empty($ud['real_estate_tax'])) { echo 'style="color:black;"'; } else { echo 'style="color:red;"'; } ?>>Official Receipts of Real Estate Property Taxes</option>
								<option value="MC" <?php if (!empty($ud['marriage_contract'])) { echo 'style="color:black;"'; } else { echo 'style="color:red;"'; } ?>>Marriage Contract (if married)</option>
								<option value="BC" <?php if (!empty($ud['birth_certificate'])) { echo 'style="color:black;"'; } else { echo 'style="color:red;"'; } ?>>Birth Certificate</option>
								<option value="VI" <?php if (!empty($ud['valid_id'])) { echo 'style="color:black;"'; } else { echo 'style="color:red;"'; } ?>>Valid ID</option>
								<option value="SP" <?php if (!empty($ud['subdivision_plan'])) { echo 'style="color:black;"'; } else { echo 'style="color:red;"'; } ?>>Subdivision Plan </option>
								<option value="SPA" <?php if (!empty($ud['spa'])) { echo 'style="color:black;"'; } else { echo 'style="color:red;"'; } ?>>SPA of Lot Owner to Lot Owner </option>
								<option value="DENR" <?php if (!empty($ud['denr_dar'])) { echo 'style="color:black;"'; } else { echo 'style="color:red;"'; } ?>>Supporting Documents from DENR/DAR</option>
								<option value="OTHER" <?php if (!empty($ud['other'])) { echo 'style="color:black;"'; } else { echo 'style="color:red;"'; } ?>>Other</option>
							</select>                             
						</div>
						<div class="col-md-4"></div>
					</div>
					<!--====================End Dropdown====================-->

					<div class="col-md-12">
						<!--====================LAND TITLE====================-->
						<center id="LT" class="titling" style="display: none;">
							<?php echo form_open_multipart('Secretary/Execute/edit_interview_sheet/'.$li['is_no'], array('onsubmit' => 'return validate_lt()'));?>
								<div class="container2 col-md-offset-2">
									<?php if(!$ud['land_title'] == null){ ?>      
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img id="existing-land-title-image" class="image-responsive" src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Land Title/'.$ud['land_title'].'') ?>" width="120%" style="margin-left: -165px;"/>
										</div>

										<div class="col-md-8">
											<input class="form-control" type="text" name="title_no" id="title_no" value="<?php echo $li['land_title_no'];?>" placeholder="Type here Title No..." style="margin-bottom:10px;margin-top:10px;text-align:center" readonly>
											<label class="btn btn-custom-primary" id="edit_land_title" style="background-color: green;" onclick="showUpdateLandTitle();"><i class="fa fa-edit"></i> Edit Land Title</label>
										</div>

										<div id="file-input-section-land-title" style="display: none;">
											<img id="display-img1" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="67%" height="90%" style="margin-left: -165px;"/>
											<input type="file" style="display:none;" id="lt_file_upload" name="lt_file" onchange="readURL(this, 'selected-file-image'); ValidateSingleInput(this);"/>
											<div class="overlay2"></div>
											<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('lt_file_upload').click();"><a href="#"> Select File </a></div>
											<div class="col-md-8">
												<input class="form-control" type="text" name="title_no" value="<?php echo $li['land_title_no'];?>" placeholder="Type here Title No..." style="margin-bottom:10px;margin-top:10px;text-align:center">
												<button class="btn btn-custom-primary" name="up_lt_btn" style="background-color: green" onclick="return uploadLandTitle();"><i class="fa fa-upload"></i> Update Land Title</button>
											</div>
										</div>

									<?php }else{ ?>
										<img id="display-img1" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="67%" height="90%" style="margin-left: -165px;" /> 
										<input type="file" style="display:none;" id="lt_file_upload" name="lt_file" onchange="readURL(this); ValidateSingleInput(this);"/>
										<div class="overlay2"></div>
										<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('lt_file_upload').click();"><a href="#"> Select File </a></div>
									</div>
									<div class="col-md-offset-4">
										<div class="col-md-6">
											<input class="form-control" type="text" name="title_no" placeholder="Type here Title No..." style="margin-bottom:10px;text-align:center">
											<button class="btn btn-custom-primary" name="up_lt_btn" style="background-color: green" onclick="return IsEmpty();" <?php if(!empty($ud['land_title'])){ echo "disabled";} ?>><i class="fa fa-upload"></i> Upload Land Title</button>
										</div>
									</div>
								<?php } ?> 
							</form>
						</center> 
						<!--====================END LAND TITLE====================--> 

						<!--====================TCT====================--> 
						<center id="TCT" class="titling" style="display: none;">
							<?php echo form_open_multipart('Secretary/Execute/edit_interview_sheet/'.$li['is_no'], array('onsubmit' => 'return validate_tct()'));?>
								<div class="container2 col-md-offset-2">
									<?php if(!$ud['tct'] == null){ ?>      
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img id="existing-tct-image" class="image-responsive" src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/TCT/'.$ud['tct'].'') ?>" width="120%" style="margin-left: -165px;"/>
										</div>

										<div class="col-md-8">
											<label class="btn btn-custom-primary" id="edit_tct" style="background-color: green;" onclick="showUpdateTCT();"><i class="fa fa-edit"></i> Edit TCT</label>
										</div>

										<div id="file-input-section-tct" style="display: none;">
											<img id="display-img2" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="67%" height="90%" style="margin-left: -165px;" /> 
											<input type="file" style="display:none;" id="tct_file_upload" name="tct_file" onchange="readURL(this, 'selected-file-image'); ValidateSingleInput(this);"/>
											<div class="overlay2"></div>
											<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('tct_file_upload').click();"><a href="#"> Select File </a></div>
											<div class="col-md-8">
												<button class="btn btn-custom-primary" name="up_tct_btn" style="background-color: green"><i class="fa fa-upload"></i> Update TCT</button>
											</div>
										</div>

									<?php }else{ ?>
										<img id="display-img2" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="68%" height="90%" style="margin-left: -165px;" /> 
										<input type="file" style="display:none;" id="tct_file_upload" name="tct_file" onchange="readURL(this); ValidateSingleInput(this);"/>
										<div class="overlay2"></div>
										<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('tct_file_upload').click();"><a href="#"> Select File </a></div>
									</div>
									<button class="btn btn-custom-primary" name="up_tct_btn" style="background-color: green" onclick="return IsEmpty();" <?php if(!empty($ud['tct'])){ echo "disabled";} ?>><i class="fa fa-upload"></i> Upload TCT</button> 
									<?php } ?> 
							</form>
						</center> 
						<!--====================END TCT====================-->

						<!--====================DEED OF SALE====================-->
						<center id="DOS" class="titling" style="display: none;">
							<?php echo form_open_multipart('Secretary/Execute/edit_interview_sheet/'.$li['is_no'], array('onsubmit' => 'return validate_dos()'));?>
								<div class="container2 col-md-offset-2">
									<?php if(!$ud['previous_deed_of_sale'] == null){ ?>      
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img id="existing-dos-image" class="image-responsive" src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Previous Deed Of Sale/'.$ud['previous_deed_of_sale'].'') ?>" width="120%" style="margin-left: -165px;"/>
										</div>

										<div class="col-md-8">
											<label class="btn btn-custom-primary" id="edit_dos" style="background-color: green;" onclick="showUpdateDOS();"><i class="fa fa-edit"></i> Edit Deed of Sale</label>
										</div>

										<div id="file-input-section-dos" style="display: none;">
											<img id="display-img3" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="67%" height="90%" style="margin-left: -165px;" /> 
											<input type="file" style="display:none;" id="dos_file_upload" name="dos_file" onchange="readURL(this, 'selected-file-image'); ValidateSingleInput(this);"/>
											<div class="overlay2"></div>
											<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('dos_file_upload').click();"><a href="#"> Select File </a></div>
											<div class="col-md-8">
												<button class="btn btn-custom-primary" name="up_dos_btn" style="background-color: green"><i class="fa fa-upload"></i> Update Deed of Sale</button>
											</div>
										</div>

									<?php }else{ ?>
										<img id="display-img3" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="68%" height="90%" style="margin-left: -165px;" /> 
										<input type="file" style="display:none;" id="dos_file_upload" name="dos_file" onchange="readURL(this); ValidateSingleInput(this);"/>
										<div class="overlay2"></div>
										<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('dos_file_upload').click();"><a href="#"> Select File </a></div>
										</div>
										<button class="btn btn-custom-primary" name="up_dos_btn" style="background-color: green" onclick="return IsEmpty();" <?php if(!empty($ud['previous_deed_of_sale'])){ echo "disabled";} ?>><i class="fa fa-upload"></i> Upload Deed of Sale</button> 
									<?php } ?>
							</form>
						</center>  
						<!--====================END DEED OF SALE====================-->

						<!--====================E-CAR====================-->
						<center id="eCar" class="titling" style="display: none;">
							<?php echo form_open_multipart('Secretary/Execute/edit_interview_sheet/'.$li['is_no'], array('onsubmit' => 'return validate_ecar()'));?>
								<div class="container2 col-md-offset-2">
									<?php if(!$ud['e_car'] == null){ ?>      
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img id="existing-ecar-image" class="image-responsive" src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/eCAR/'.$ud['e_car'].'') ?>" width="120%" style="margin-left: -165px;"/>
										</div>

										<div class="col-md-8">
											<label class="btn btn-custom-primary" id="edit_ecar" style="background-color: green;" onclick="showUpdateecar();"><i class="fa fa-edit"></i> Edit e-CAR</label>
										</div>

										<div id="file-input-section-ecar" style="display: none;">
											<img id="display-img4" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="67%" height="90%" style="margin-left: -165px;" /> 
											<input type="file" style="display:none;" id="ecar_file_upload" name="ecar_file" onchange="readURL(this, 'selected-file-image'); ValidateSingleInput(this);"/>
											<div class="overlay2"></div>
											<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('ecar_file_upload').click();"><a href="#"> Select File </a></div>
											<div class="col-md-8">
												<button class="btn btn-custom-primary" name="up_ecar_btn" style="background-color: green"><i class="fa fa-upload"></i> Update e-CAR</button>
											</div>
										</div>

									<?php }else{ ?>
										<img id="display-img4" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="68%" height="90%" style="margin-left: -165px;" /> 
										<input type="file" style="display:none;" id="ecar_file_upload" name="ecar_file" onchange="readURL(this); ValidateSingleInput(this);"/>
										<div class="overlay2"></div>
										<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('ecar_file_upload').click();"><a href="#"> Select File </a></div>
										</div>
										<button class="btn btn-custom-primary" name="up_ecar_btn" style="background-color: green" onclick="return IsEmpty();" <?php if(!empty($ud['e_car'])){ echo "disabled";} ?>><i class="fa fa-upload"></i> Upload e-CAR</button> 
									<?php } ?>
							</form>
						</center> 
						<!--====================END E-CAR====================-->

						<!--====================TAX DECLARATION====================-->
						<center id="TD" class="titling" style="display: none;">
							<?php echo form_open_multipart('Secretary/Execute/edit_interview_sheet/'.$li['is_no'], array('onsubmit' => 'return validate_td()'));?>
								<div class="container2 col-md-offset-2">
									<?php if(!$ud['latest_tax_dec'] == null){ ?>      
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img id="existing-tax-dec-image" class="image-responsive" src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Tax Declaration/'.$ud['latest_tax_dec'].'') ?>" width="120%" style="margin-left: -165px;"/>
										</div>

										<div class="col-md-8">
											<input class="form-control" type="text" name="tax_no" id="tax_no" value="<?php echo $li['tax_dec_no'];?>" placeholder="Type here Tax Declaration No..." style="margin-bottom:10px;margin-top:10px;text-align:center" readonly>
											<label class="btn btn-custom-primary" id="edit_tax_dec" style="background-color: green;" onclick="showUpdateTaxDec();"><i class="fa fa-edit"></i> Edit Tax Declaration</label>
										</div>

										<div id="file-input-section-tax-dec" style="display: none;">
											<img id="display-img5" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="67%" height="90%" style="margin-left: -165px;" /> 
											<input type="file" style="display:none;" id="td_file_upload" name="td_file" onchange="readURL(this, 'selected-file-image'); ValidateSingleInput(this);"/>
											<div class="overlay2"></div>
											<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('td_file_upload').click();"><a href="#"> Select File </a></div>
											<div class="col-md-8">
												<input class="form-control" type="text" name="tax_no" id="tax_no" value="<?php echo $li['tax_dec_no'];?>" placeholder="Type here Tax Declaration No..." style="margin-bottom:10px;margin-top:10px;text-align:center">
												<button class="btn btn-custom-primary" name="up_td_btn" style="background-color: green"><i class="fa fa-upload"></i> Update Tax Declaration</button>
											</div>
										</div>

									<?php }else{ ?>
										<img id="display-img5" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="68%" height="90%" style="margin-left: -165px;" /> 
										<input type="file" style="display:none;" id="td_file_upload" name="td_file" onchange="readURL(this); ValidateSingleInput(this);"/>
										<div class="overlay2"></div>
										<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('td_file_upload').click();"><a href="#"> Select File </a></div>
									</div>
									<div class="col-md-offset-4">
										<div class="col-md-6">
											<input class="form-control" type="text" name="tax_no" id="tax_no" value="<?php echo $li['tax_dec_no'];?>" placeholder="Type here Tax Declaration No..." style="margin-bottom:10px;margin-top:10px;text-align:center">
											<button class="btn btn-custom-primary" name="up_td_btn" style="background-color: green" onclick="return IsEmpty();" <?php if(!empty($ud['latest_tax_dec'])){ echo "disabled";} ?>><i class="fa fa-upload"></i> Upload Tax Declaration</button>
										</div>
									</div>
								<?php } ?>
							</form>
						</center>  
						<!--====================END TAX DECLARATION====================-->

						<!--====================TAX CLEARANCE====================-->
						<center id="TC" class="titling" style="display: none;">
							<?php echo form_open_multipart('Secretary/Execute/edit_interview_sheet/'.$li['is_no'], array('onsubmit' => 'return validate_tc()'));?>
								<div class="container2 col-md-offset-2">
									<?php if(!$ud['tax_clearance'] == null){ ?>      
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img id="existing-tax-clearance-image" class="image-responsive" src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Tax Clearance/'.$ud['tax_clearance'].'') ?>" width="120%" style="margin-left: -165px;"/>
										</div>

										<div class="col-md-8">
											<label class="btn btn-custom-primary" id="edit_tax_clearance" style="background-color: green;" onclick="showUpdateTaxClearance();"><i class="fa fa-edit"></i> Edit Tax Clearance</label>
										</div>

										<div id="file-input-section-tax-clearance" style="display: none;">
											<img id="display-img6" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="67%" height="90%" style="margin-left: -165px;" /> 
											<input type="file" style="display:none;" id="tc_file_upload" name="tc_file" onchange="readURL(this, 'selected-file-image'); ValidateSingleInput(this);"/>
											<div class="overlay2"></div>
											<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('tc_file_upload').click();"><a href="#"> Select File </a></div>
											<div class="col-md-8">
												<button class="btn btn-custom-primary" name="up_tc_btn" style="background-color: green"><i class="fa fa-upload"></i> Update Tax Clearance</button>
											</div>
										</div>

									<?php }else{ ?>
										<img id="display-img6" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="68%" height="90%" style="margin-left: -165px;" /> 
										<input type="file" style="display:none;" id="tc_file_upload" name="tc_file" onchange="readURL(this); ValidateSingleInput(this);"/>
										<div class="overlay2"></div>
										<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('tc_file_upload').click();"><a href="#"> Select File </a></div>
										</div>
										<button class="btn btn-custom-primary" name="up_tc_btn" style="background-color: green" onclick="return IsEmpty();" <?php if(!empty($ud['tax_clearance'])){ echo "disabled";} ?>><i class="fa fa-upload"></i> Upload Tax Clearance</button> 
									<?php } ?>
							</form>
						</center>  
						<!--====================END TAX CLEARANCE====================-->

						<!--====================SKETCH PLAN====================-->
						<center id="LS" class="titling" style="display: none;">
							<?php echo form_open_multipart('Secretary/Execute/edit_interview_sheet/'.$li['is_no'], array('onsubmit' => 'return validate_ls()'));?>
								<div class="container2 col-md-offset-2">
									<?php if(!$ud['land_sketch'] == null){ ?>      
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img id="existing-sketch-plan-image" class="image-responsive" src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Land Sketch/'.$ud['land_sketch'].'') ?>" width="120%" style="margin-left: -165px;"/>
										</div>

										<div class="col-md-8">
											<label class="btn btn-custom-primary" id="edit_sketch_plan" style="background-color: green;" onclick="showUpdateSketchPlan();"><i class="fa fa-edit"></i> Edit Sketch Plan</label>
										</div>

										<div id="file-input-section-sketch-plan" style="display: none;">
											<img id="display-img7" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="67%" height="90%" style="margin-left: -165px;" /> 
											<input type="file" style="display:none;" id="ls_file_upload" name="land_sketch_file" onchange="readURL(this, 'selected-file-image'); ValidateSingleInput(this);"/>
											<div class="overlay2"></div>
											<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('ls_file_upload').click();"><a href="#"> Select File </a></div>
											<div class="col-md-8">
												<button class="btn btn-custom-primary" name="up_ls_btn" style="background-color: green"><i class="fa fa-upload"></i> Update Sketch Plan</button>
											</div>
										</div>

									<?php }else{ ?>
										<img id="display-img7" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="68%" height="90%" style="margin-left: -165px;" /> 
										<input type="file" style="display:none;" id="ls_file_upload" name="land_sketch_file" onchange="readURL(this); ValidateSingleInput(this);"/>
										<div class="overlay2"></div>
										<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('ls_file_upload').click();"><a href="#"> Select File </a></div>
										</div>
										<button class="btn btn-custom-primary" name="up_ls_btn" style="background-color: green" onclick="return IsEmpty();" <?php if(!empty($ud['land_sketch'])){ echo "disabled";} ?>><i class="fa fa-upload"></i>Upload Sketch Plan</button> 
									<?php } ?> 
							</form>
						</center>  
						<!--====================END SKETCH PLAN====================-->

						<!--====================VICINITY MAP====================-->
						<center id="VM" class="titling" style="display: none;">
							<?php echo form_open_multipart('Secretary/Execute/edit_interview_sheet/'.$li['is_no'], array('onsubmit' => 'return validate_vm()'));?>
								<div class="container2 col-md-offset-2">
									<?php if(!$ud['vicinity_map'] == null){ ?>      
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img id="existing-vicinity-map-image" class="image-responsive" src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Vicinity Map/'.$ud['vicinity_map'].'') ?>" width="120%" style="margin-left: -165px;"/>
										</div>

										<div class="col-md-8">
											<label class="btn btn-custom-primary" id="edit_vicinity_map" style="background-color: green;" onclick="showUpdateVicinityMap();"><i class="fa fa-edit"></i> Edit Vicinity Map</label>
										</div>

										<div id="file-input-section-vicinity-map" style="display: none;">
											<img id="display-img8" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="67%" height="90%" style="margin-left: -165px;" /> 
											<input type="file" style="display:none;" id="vm_file_upload" name="vm_file" onchange="readURL(this, 'selected-file-image'); ValidateSingleInput(this);"/>
											<div class="overlay2"></div>
											<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('vm_file_upload').click();"><a href="#"> Select File </a></div>
											<div class="col-md-8">
												<button class="btn btn-custom-primary" name="up_vm_btn" style="background-color: green"><i class="fa fa-upload"></i> Update Vicinity Map</button>
											</div>
										</div>

									<?php }else{ ?>
										<img id="display-img8" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="68%" height="90%" style="margin-left: -165px;" /> 
										<input type="file" style="display:none;" id="vm_file_upload" name="vm_file" onchange="readURL(this); ValidateSingleInput(this);"/>
										<div class="overlay2"></div>
										<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('vm_file_upload').click();"><a href="#"> Select File </a></div>
										</div>
										<button class="btn btn-custom-primary" name="up_vm_btn" style="background-color: green" onclick="return IsEmpty();" <?php if(!empty($ud['vicinity_map'])){ echo "disabled";} ?>><i class="fa fa-upload"></i> Upload Vicinity Map</button> 
									<?php } ?> 
							</form>
						</center>  
						<!--====================END VICINITY MAP====================-->

						<!--====================CERTIFICATE OF NO IMPROVEMENT====================-->
						<center id="CNI" class="titling" style="display: none;">
							<?php echo form_open_multipart('Secretary/Execute/edit_interview_sheet/'.$li['is_no'], array('onsubmit' => 'return validate_cni()'));?>
								<div class="container2 col-md-offset-2">
									<?php if(!$ud['cert_no_improvement'] == null){ ?>      
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img id="existing-coni-image" class="image-responsive" src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Certificate of No Improvement/'.$ud['cert_no_improvement'].'') ?>" width="120%" style="margin-left: -165px;"/>
										</div>

										<div class="col-md-8">
											<label class="btn btn-custom-primary" id="edit_coni" style="background-color: green;" onclick="showUpdateCONI();"><i class="fa fa-edit"></i> Edit Certification of No Improvement</label>
										</div>

										<div id="file-input-section-coni" style="display: none;">
											<img id="display-img9" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="67%" height="90%" style="margin-left: -165px;" /> 
											<input type="file" style="display:none;" id="cni_file_upload" name="cni_file" onchange="readURL(this, 'selected-file-image'); ValidateSingleInput(this);"/>
											<div class="overlay2"></div>
											<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('cni_file_upload').click();"><a href="#"> Select File </a></div>
											<div class="col-md-8">
												<button class="btn btn-custom-primary" name="up_cni_btn" style="background-color: green"><i class="fa fa-upload"></i> Update Certification of No Improvement</button>
											</div>
										</div>

									<?php }else{ ?>
										<img id="display-img9" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="68%" height="90%" style="margin-left: -165px;" /> 
										<input type="file" style="display:none;" id="cni_file_upload" name="cni_file" onchange="readURL(this); ValidateSingleInput(this);"/>
										<div class="overlay2"></div>
										<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('cni_file_upload').click();"><a href="#"> Select File </a></div>
										</div>
										<button class="btn btn-custom-primary" name="up_cni_btn" style="background-color: green" onclick="return IsEmpty();" <?php if(!empty($ud['cert_no_improvement'])){ echo "disabled";} ?>><i class="fa fa-upload"></i> Upload Certification of No Improvement</button> 
									<?php } ?> 
							</form>
						</center>  
						<!--====================END CERTIFICATE OF NO IMPROVEMENT====================-->

						<!--====================REAL ESTATE TAX====================-->
						<center id="RET" class="titling" style="display: none;">
							<?php echo form_open_multipart('Secretary/Execute/edit_interview_sheet/'.$li['is_no'], array('onsubmit' => 'return validate_ret()'));?>
								<div class="container2 col-md-offset-2">
									<?php if(!$ud['real_estate_tax'] == null){ ?>      
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img id="existing-ret-image" class="image-responsive" src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Real Estate Tax/'.$ud['real_estate_tax'].'') ?>" width="120%" style="margin-left: -165px;"/>
										</div>

										<div class="col-md-8">
											<label class="btn btn-custom-primary" id="edit_ret" style="background-color: green;" onclick="showUpdateRET();"><i class="fa fa-edit"></i> Edit Real Estate Tax</label>
										</div>

										<div id="file-input-section-ret" style="display: none;">
											<img id="display-img10" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="67%" height="90%" style="margin-left: -165px;" /> 
											<input type="file" style="display:none;" id="ret_file_upload" name="ret_file" onchange="readURL(this, 'selected-file-image'); ValidateSingleInput(this);"/>
											<div class="overlay2"></div>
											<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('ret_file_upload').click();"><a href="#"> Select File </a></div>
											<div class="col-md-8">
												<button class="btn btn-custom-primary" name="up_ret_btn" style="background-color: green"><i class="fa fa-upload"></i> Update Real Estate Tax</button>
											</div>
										</div>

									<?php }else{ ?>
										<img id="display-img10" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="68%" height="90%" style="margin-left: -165px;" /> 
										<input type="file" style="display:none;" id="ret_file_upload" name="ret_file" onchange="readURL(this); ValidateSingleInput(this);"/>
										<div class="overlay2"></div>
										<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('ret_file_upload').click();"><a href="#"> Select File </a></div>
										</div>
										<button class="btn btn-custom-primary" name="up_ret_btn" style="background-color: green" onclick="return IsEmpty();" <?php if(!empty($ud['real_estate_tax'])){ echo "disabled";} ?>><i class="fa fa-upload"></i> Upload Real Estate Tax</button> 
									<?php } ?> 
							</form>
						</center>  
						<!--====================END REAL ESTATE TAX====================-->

						<!--====================MARRIAGE CONTRACT====================-->
						<center id="MC" class="titling" style="display: none;">
							<?php echo form_open_multipart('Secretary/Execute/edit_interview_sheet/'.$li['is_no'], array('onsubmit' => 'return validate_mc()'));?>
								<div class="container2 col-md-offset-2">
									<?php if(!$ud['marriage_contract'] == null){ ?>      
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img id="existing-mc-image" class="image-responsive" src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Marriage Contract/'.$ud['marriage_contract'].'') ?>" width="120%" style="margin-left: -165px;"/>
										</div>

										<div class="col-md-8">
											<label class="btn btn-custom-primary" id="edit_mc" style="background-color: green;" onclick="showUpdateMC();"><i class="fa fa-edit"></i> Edit Marriage Contract</label>
										</div>

										<div id="file-input-section-mc" style="display: none;">
											<img id="display-img11" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="67%" height="90%" style="margin-left: -165px;" /> 
											<input type="file" style="display:none;" id="mc_file_upload" name="mc_file" onchange="readURL(this, 'selected-file-image'); ValidateSingleInput(this);"/>
											<div class="overlay2"></div>
											<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('mc_file_upload').click();"><a href="#"> Select File </a></div>
											<div class="col-md-8">
												<button class="btn btn-custom-primary" name="up_mc_btn" style="background-color: green"><i class="fa fa-upload"></i> Update Marriage Contract</button>
											</div>
										</div>

									<?php }else{ ?>
										<img id="display-img11" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="67%" height="90%" style="margin-left: -165px;" /> 
										<input type="file" style="display:none;" id="mc_file_upload" name="mc_file" onchange="readURL(this); ValidateSingleInput(this);"/>
										<div class="overlay2"></div>
										<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('mc_file_upload').click();"><a href="#"> Select File </a></div>
										</div>
										<button class="btn btn-custom-primary" name="up_mc_btn" style="background-color: green" onclick="return IsEmpty();" <?php if(!empty($ud['marriage_contract'])){ echo "disabled";} ?>><i class="fa fa-upload"></i> Upload Marriage Contract</button> 
									<?php } ?> 
							</form>
						</center>  
						<!--====================END MARRIAGE CONTRACT====================-->

						<!--====================BIRTH CERTIFICATE====================-->
						<center id="BC" class="titling" style="display: none;">
							<?php echo form_open_multipart('Secretary/Execute/edit_interview_sheet/'.$li['is_no'], array('onsubmit' => 'return validate_bc()'));?>
								<div class="container2 col-md-offset-2">
									<?php if(!$ud['birth_certificate'] == null){ ?>      
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img id="existing-bc-image" class="image-responsive" src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Birth Certificate/'.$ud['birth_certificate'].'') ?>" width="120%" style="margin-left: -165px;"/>
										</div>

										<div class="col-md-8">
											<label class="btn btn-custom-primary" id="edit_bc" style="background-color: green;" onclick="showUpdateBC();"><i class="fa fa-edit"></i> Edit Birth Certificate</label>
										</div>

										<div id="file-input-section-bc" style="display: none;">
											<img id="display-img12" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="67%" height="90%" style="margin-left: -165px;" /> 
											<input type="file" style="display:none;" id="bc_file_upload" name="bc_file" onchange="readURL(this, 'selected-file-image'); ValidateSingleInput(this);"/>
											<div class="overlay2"></div>
											<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('bc_file_upload').click();"><a href="#"> Select File </a></div>
											<div class="col-md-8">
												<button class="btn btn-custom-primary" name="up_bc_btn" style="background-color: green"><i class="fa fa-upload"></i> Update Birth Certificate</button>
											</div>
										</div>

									<?php }else{ ?>
										<img id="display-img12" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="68%" height="90%" style="margin-left: -165px;" /> 
										<input type="file" style="display:none;" id="bc_file_upload" name="bc_file" onchange="readURL(this); ValidateSingleInput(this);"/>
										<div class="overlay2"></div>
										<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('bc_file_upload').click();"><a href="#"> Select File </a></div>
										</div>
										<button class="btn btn-custom-primary" name="up_bc_btn" style="background-color: green" onclick="return IsEmpty();" <?php if(!empty($ud['birth_certificate'])){ echo "disabled";} ?>><i class="fa fa-upload"></i> Upload Birth Certificate</button> 
									<?php } ?>
							</form>
						</center>  
						<!--====================END BIRTH CERTIFICATE====================-->

						<!--====================VALID ID====================-->
						<center id="VI" class="titling" style="display: none;">
							<?php echo form_open_multipart('Secretary/Execute/edit_interview_sheet/'.$li['is_no'], array('onsubmit' => 'return validate_vi()'));?>
								<div class="container2 col-md-offset-2">
									<?php if(!$ud['valid_id'] == null){ ?>      
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img id="existing-valid-id-image" class="image-responsive" src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Valid ID/'.$ud['valid_id'].'') ?>" width="120%" style="margin-left: -165px;"/>
										</div>

										<div class="col-md-8">
											<label class="btn btn-custom-primary" id="edit_id" style="background-color: green;" onclick="showUpdateID();"><i class="fa fa-edit"></i> Edit Valid ID</label>
										</div>

										<div id="file-input-section-id" style="display: none;">
											<img id="display-img13" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="67%" height="90%" style="margin-left: -165px;" /> 
											<input type="file" style="display:none;" id="vi_file_upload" name="vi_file" onchange="readURL(this, 'selected-file-image'); ValidateSingleInput(this);"/>
											<div class="overlay2"></div>
											<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('vi_file_upload').click();"><a href="#"> Select File </a></div>
											<div class="col-md-8">
												<button class="btn btn-custom-primary" name="up_vi_btn" style="background-color: green"><i class="fa fa-upload"></i> Update Valid ID</button>
											</div>
										</div>

									<?php }else{ ?>
										<img id="display-img13" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="68%" height="90%" style="margin-left: -165px;" /> 
										<input type="file" style="display:none;" id="vi_file_upload" name="vi_file" onchange="readURL(this); ValidateSingleInput(this);"/>
										<div class="overlay2"></div>
										<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('vi_file_upload').click();"><a href="#"> Select File </a></div>
										</div>
										<button class="btn btn-custom-primary" name="up_vi_btn" style="background-color: green" onclick="return IsEmpty();" <?php if(!empty($ud['valid_id'])){ echo "disabled";} ?>><i class="fa fa-upload"></i> Upload Valid ID</button> 
									<?php } ?>
							</form>
						</center>  
						<!--====================END VALID ID====================-->

						<!--====================SUBDIVISION PLAN====================-->
						<center id="SP" class="titling" style="display: none;">
							<?php echo form_open_multipart('Secretary/Execute/edit_interview_sheet/'.$li['is_no'], array('onsubmit' => 'return validate_sp()'));?>
								<div class="container2 col-md-offset-2">
									<?php if(!$ud['subdivision_plan'] == null){ ?>      
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img id="existing-sp-image" class="image-responsive" src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Subdivision Plan/'.$ud['subdivision_plan'].'') ?>" width="120%" style="margin-left: -165px;"/>
										</div>

										<div class="col-md-8">
											<label class="btn btn-custom-primary" id="edit_sp" style="background-color: green;" onclick="showUpdateSP();"><i class="fa fa-edit"></i> Edit Subdivision Plan</label>
										</div>

										<div id="file-input-section-sp" style="display: none;">
											<img id="display-img14" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="67%" height="90%" style="margin-left: -165px;" /> 
											<input type="file" style="display:none;" id="sp_file_upload" name="sp_file" onchange="readURL(this, 'selected-file-image'); ValidateSingleInput(this);"/>
											<div class="overlay2"></div>
											<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('sp_file_upload').click();"><a href="#"> Select File </a></div>
											<div class="col-md-8">
												<button class="btn btn-custom-primary" name="up_sp_btn" style="background-color: green"><i class="fa fa-upload"></i> Update Subdivision Plan</button>
											</div>
										</div>

									<?php }else{ ?>
										<img id="display-img14" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="68%" height="90%" style="margin-left: -165px;" /> 
										<input type="file" style="display:none;" id="sp_file_upload" name="sp_file" onchange="readURL(this); ValidateSingleInput(this);"/>
										<div class="overlay2"></div>
										<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('sp_file_upload').click();"><a href="#"> Select File </a></div>
										</div>
										<button class="btn btn-custom-primary" name="up_sp_btn" style="background-color: green" onclick="return IsEmpty();" <?php if(!empty($ud['subdivision_plan'])){ echo "disabled";} ?>><i class="fa fa-upload"></i> Upload Subdivision Plan</button> 
									<?php } ?>
							</form>
						</center>  
						<!--====================END SUBDIVISION PLAN====================-->

						<!--====================SPA====================-->
						<center id="SPA" class="titling" style="display: none;">
							<?php echo form_open_multipart('Secretary/Execute/edit_interview_sheet/'.$li['is_no'], array('onsubmit' => 'return validate_spa()'));?>
								<div class="container2 col-md-offset-2">
									<?php if(!$ud['spa'] == null){ ?>      
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img id="existing-spa-image" class="image-responsive" src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/SPA/'.$ud['spa'].'') ?>" width="120%" style="margin-left: -165px;"/>
										</div>

										<div class="col-md-8">
											<label class="btn btn-custom-primary" id="edit_spa" style="background-color: green;" onclick="showUpdateSPA();"><i class="fa fa-edit"></i> Edit SPA</label>
										</div>

										<div id="file-input-section-spa" style="display: none;">
											<img id="display-img15" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="67%" height="90%" style="margin-left: -165px;" /> 
											<input type="file" style="display:none;" id="spa_file_upload" name="spa_file" onchange="readURL(this, 'selected-file-image'); ValidateSingleInput(this);"/>
											<div class="overlay2"></div>
											<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('spa_file_upload').click();"><a href="#"> Select File </a></div>
											<div class="col-md-8">
												<button class="btn btn-custom-primary" name="up_spa_btn" style="background-color: green"><i class="fa fa-upload"></i> Update SPA</button>
											</div>
										</div>

									<?php }else{ ?>
										<img id="display-img15" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="68%" height="90%" style="margin-left: -165px;" /> 
										<input type="file" style="display:none;" id="spa_file_upload" name="spa_file" onchange="readURL(this); ValidateSingleInput(this);"/>
										<div class="overlay2"></div>
										<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('spa_file_upload').click();"><a href="#"> Select File </a></div>
										</div>
										<button class="btn btn-custom-primary" name="up_spa_btn" style="background-color: green" onclick="return IsEmpty();" <?php if(!empty($ud['spa'])){ echo "disabled";} ?>><i class="fa fa-upload"></i> Upload SPA</button> 
									<?php } ?>
							</form>
						</center>  
						<!--====================SPA====================-->

						<!--====================DENR/DAR====================-->
						<center id="DENR" class="titling" style="display: none;">
							<?php echo form_open_multipart('Secretary/Execute/edit_interview_sheet/'.$li['is_no'], array('onsubmit' => 'return validate_denr()'));?>
								<div class="container2 col-md-offset-2">
									<?php if(!$ud['denr_dar'] == null){ ?>      
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img id="existing-denr-dar-image" class="image-responsive" src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/DENR or DAR/'.$ud['denr_dar'].'') ?>" width="120%" style="margin-left: -165px;"/>
										</div>

										<div class="col-md-8">
											<label class="btn btn-custom-primary" id="edit_denr" style="background-color: green;" onclick="showUpdateDENR();"><i class="fa fa-edit"></i> Edit DENR/DAR</label>
										</div>

										<div id="file-input-section-denr" style="display: none;">
											<img id="display-img16" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="67%" height="90%" style="margin-left: -165px;" /> 
											<input type="file" style="display:none;" id="denr_file_upload" name="denr_file" onchange="readURL(this, 'selected-file-image'); ValidateSingleInput(this);"/>
											<div class="overlay2"></div>
											<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('denr_file_upload').click();"><a href="#"> Select File </a></div>
											<div class="col-md-8">
												<button class="btn btn-custom-primary" name="up_denr_btn" style="background-color: green"><i class="fa fa-upload"></i> Update DENR/DAR</button>
											</div>
										</div>

									<?php }else{ ?>
										<img id="display-img16" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="68%" height="90%" style="margin-left: -165px;" /> 
										<input type="file" style="display:none;" id="denr_file_upload" name="denr_file" onchange="readURL(this); ValidateSingleInput(this);"/>
										<div class="overlay2"></div>
										<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('denr_file_upload').click();"><a href="#"> Select File </a></div>
										</div>
										<button class="btn btn-custom-primary" name="up_denr_btn" style="background-color: green" onclick="return IsEmpty();" <?php if(!empty($ud['denr_dar'])){ echo "disabled";} ?>><i class="fa fa-upload"></i> Upload DENR/DAR</button>
									<?php } ?>
							</form>
						</center>  
						<!--====================END DENR/DAR====================-->

						<!--====================OTHER====================-->
						<center id="OTHER" class="titling" style="display: none;">
							<?php echo form_open_multipart('Secretary/Execute/edit_interview_sheet/'.$li['is_no'], array('onsubmit' => 'return validate_other()'));?>
								<div class="container2 col-md-offset-2">
									<?php if(!$ud['other'] == null){ ?>      
										<div class="col-md-12 col-sm-12 col-xs-12">
											<?php
												$fileNames = explode(',', $ud['other']);
												foreach ($fileNames as $fileName) {
													// Extract the actual file name and its extension
													list($actualFileName, $fileExtension) = explode('.', trim($fileName));

													$filePath = base_url('assets/img/uploaded_documents/' . $ud['is_no'] . '/OTHER/' . trim($fileName));
											?>
												<div class="image-container">
													<img class="image-responsive existing-other-image" src="<?= $filePath ?>" width="120%" style="margin-left: -165px;">
													<div class="col-md-8 file-name">
														<h4 id="new_filename"><?= $actualFileName ?></h4>
													</div>
													<form action="<?= base_url('Secretary/Execute/edit_interview_sheet/' . $ud['is_no']) ?>" method="post" class="delete-form">
														<input type="hidden" name="file_name" value="<?= trim($fileName) ?>">
														<div class="col-md-8"style="margin-top:-2px">
															<button type="submit" name="delete_other" class="delete-button" style="color:#000"><i class="fa fa-trash-o text-danger"></i> Delete</button>
														</div>
													</form>
												</div>
											<?php } ?>
										</div>

										<div class="col-md-8">
											<label class="btn btn-custom-primary" id="edit_other" style="background-color:green;" onclick="showUpdateOTHER();"><i class="fa fa-edit"></i> Upload Another File</label>
										</div>

										<div id="file-input-section-other" style="display: none;">
											<img id="display-img17" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="67%" height="90%" style="margin-left: -165px;" /> 
											<input type="file" style="display:none;" id="other_file_upload" name="other_file" onchange="readURL(this, 'selected-file-image'); ValidateSingleInput(this);"/>
											<div class="overlay2"></div>
											<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('other_file_upload').click();"><a href="#"> Select File </a></div>
											<div class="col-md-8">
												<input class="form-control" type="text" name="other_document" id="other_document1" placeholder="Type here File Name..." style="text-align:center">
												<button class="btn btn-custom-primary" name="up_other_btn" style="background-color: green"><i class="fa fa-upload"></i> Upload</button>
											</div>
										</div>
									<?php }else{ ?>
										<img id="display-img17" class="image-responsive" src="<?=base_url()?>assets/logo/upload here.png"  width="68%" height="90%" style="margin-left: -165px;" /> 
										<input type="file" style="display:none;" id="other_file_upload" name="other_file" onchange="readURL(this); ValidateSingleInput(this);"/>
										<div class="overlay2"></div>
										<div class="upload_btn" id="loadFileXml" onclick="document.getElementById('other_file_upload').click();"><a href="#"> Select File </a></div>
									</div>
									<div class="col-md-offset-4">
										<div class="col-md-6">
											<input class="form-control" type="text" name="other_document" id="other_document" placeholder="Type here File Name..." style="margin-bottom:10px;text-align:center">
											<button class="btn btn-custom-primary" name="up_other_btn" style="background-color: green" onclick="return IsEmpty();" <?php if(!empty($ud['other'])){ echo "disable";} ?>><i class="fa fa-upload"></i> Upload</button>
										</div>
									</div>
								<?php } ?>
							</form>
						</center> 
						<!--====================END OTHER====================-->
					</div>
				</div>         
			</div>

			<div class="modal-footer" style="margin-top:10%">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<!-- <input type="submit" class="btn btn-custom-primary" value="Submit" style="color: #ff9900; border: 2px solid;"> -->
			</div>
		</div>
	</div>
</div>
<!-- ===================================== END MODAL ========================================================= -->

<!-- ===================================== ALERT MODAL ========================================================= -->
<div class="modal fade" id="alert_modal" tabindex="-1" role="dialog" aria-hidden="true" style="margin-top: 100px;" >
	<div class="modal-dialog modal-sm">
		<div class="modal-content" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);">

			<div class="modal-header" style="background-color:#ff9900;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel2"><span class="fa fa-warning"></span> Alert</h4>
			</div>

			<div class="modal-body">
				<label>Are you sure to save the changes you've made?</label>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-custom-primary">Ok</button>
			</div>

		</div>
	</div>
</div>
<!-- ===================================== END MODAL ========================================================= -->

<!-- ===================================== LAND TITLE MODAL ========================================================= -->
<div class="modal animate bounceInUp land_title_<?php echo $li['is_no'];?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #00c851; color: white;">
				<button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-text-o"></span> Land Title (Photocopy)</h4>
			</div>
			<div class="modal-body">
				<center>
					<div style="overflow-x:auto">
						<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Land Title/'.$ud['land_title'].'') ?> " class="img-responsive">   
					</div>  
				</center>                                         
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" style="color: #00c851; border: 1px solid;">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- ===================================== LAND SKETCH MODAL ========================================================= -->
<div class="modal animate bounceInUp land_sketch_<?php echo $li['is_no'];?>" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #00c851; color: white;">
				<button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-text-o"></span> Land Sketch</h4>
			</div>
			<div class="modal-body">
				<center>
					<div style="overflow-x:auto;">
						<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Land Sketch/'.$ud['land_sketch'].'') ?> " class="img-responsive">   
					</div>   
				</center>                                  
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" style="color: #00c851; border: 1px solid;">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- ===================================== TAX DECLARATION MODAL ========================================================= -->
<div class="modal animate bounceInUp latest_tax_dec_<?php echo $li['is_no'];?>" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #00c851; color: white;">
				<button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-text-o"></span> Latest Tax Declaration (Photocopy)</h4>
			</div>
			<div class="modal-body">
				<center> 
					<div style="overflow-x:auto;">
						<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Tax Declaration/'.$ud['latest_tax_dec'].'') ?> " class="img-responsive">   
					</div> 
				</center>                                           
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" style="color: #00c851; border: 1px solid;">Close</button>
			</div>
		</div>
	</div>
</div>
<!--=========================================================RESUBMIT MODAL=========================================================-->
<div class="modal fade resubmit_<?php echo $li['is_no'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" style="margin-top: 100px;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background:#6b8e23;">
				<button type="button" class="close" id="dclose" data-dismiss="modal" aria-hidden="true"><span style="color:white;">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-check-square-o" style="color:white;"></i> <span style="color:#E7E7E7;">Checked</span></h4>
			</div>
			<div class="modal-body" style="overflow-y: auto;">
				<center><h6><span style="font-family:verdana; font-size:15px">Are you sure you want to resubmit these documents?</span></h6></center>
			</div>
			<div class="modal-footer">
				<button style="background-color: #6b8e23;border:#6b8e23" type="submit" class="btn  btn-info resubmit" id="<?php echo $li['is_no'] ?>">Yes</button>
				<button style="background-color: maroon;border:maroon" type="button" class="btn btn-warning" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>
<!-- ===================================== END MODAL ========================================================= -->

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(event) {
		//JQUERY FOR PURCHASE TYPE
		$(function() {
			$('#purchase_type').change(function(){
				if($(this).val() == 'package'){
					$('#package').show();
					$('#Square').hide();
					$("#total_form").prop('readonly',false);
				}else{
					$('#Square').show();
					$("#total_form").prop('readonly',true);
				} 
			});
		});
		//END JQUERY FOR PURCHASE TYPE   

		//OWNER/SELLER JQUERY
		$(".appearance").click(function(){
			var a = $(this).attr("value");
			if(a == "Owner/Seller"){
				$("#owner").show();
				$("#broker").hide();
				$("#fname_b").prop('required',false);
				$("#mname_b").prop('required',false);
				$("#lname_b").prop('required',false);
			}else{
				$("#broker").show();
				$("#owner").hide();
				$("#fname_b").prop('required',true);
				$("#mname_b").prop('required',true);
				$("#lname_b").prop('required',true);
			}
		});
		//END OWNER/SELLER JQUERY 

		var $form = $('#edit_acq_land_info'),
		origForm = $form.serialize(),
		$form2 = $('#edit_acq_owner_info'),
		origForm2 = $form2.serialize(),
		$form3 = $('#edit_uploaded_docs'),
		origForm3 = $form3.serialize();
		//li  =========================
		$("#li_edit_btn").click(function() {
			if($form.serialize() == origForm){
				alert('No changes has been made!');
				return false;
			}
		});
		$('#edit_acq_land_info :input').on('change input', function() {
			$('.change-message').toggle($form.serialize() !== origForm);
			if($form.serialize() !== origForm){
				$('#li_edit_btn').prop('disabled',false);
			}else{
				$('#li_edit_btn').prop('disabled',true);
			}
		});
		// oi =========================
		$("#oi_edit_btn").click(function() {
			if($form2.serialize() == origForm2){
				alert('No changes has been made!');
				return false;
			}
		});
		$('#edit_acq_owner_info :input').on('change input', function() {
			$('.change-message').toggle($form2.serialize() !== origForm2);
			if($form2.serialize() !== origForm2){
				$('#oi_edit_btn').prop('disabled',false);
			}else{
				$('#oi_edit_btn').prop('disabled',true);
			}
		});
		//resubmit JQUERY
		$(".resubmit").click(function () {
			var id = $(this).attr("id");
			$.ajax({
				url: "<?php echo base_url('Acquisition/resubmit/"+id+"') ?>",
				type: "post",
				data: { '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>' },
				success: function () {
					// alert("The Request has been Approved");
					window.location.replace("<?php echo base_url('Acquisition/pop_up_resubmit') ?>/" + id + "");
				}
			});
		});                                                                  
	});      
</script>

<script>
	//LAND TITLE
	function showUpdateLandTitle() {
		document.getElementById('existing-land-title-image').style.display = 'none';
		document.getElementById('edit_land_title').style.display = 'none';
		document.getElementById('title_no').style.display = 'none';
		document.getElementById('file-input-section-land-title').style.display = 'block';
	}
	//TCT
	function showUpdateTCT() {
		document.getElementById('existing-tct-image').style.display = 'none';
		document.getElementById('edit_tct').style.display = 'none';
		document.getElementById('file-input-section-tct').style.display = 'block';
	}
	//Deed of Sale
	function showUpdateDOS() {
		document.getElementById('existing-dos-image').style.display = 'none';
		document.getElementById('edit_dos').style.display = 'none';
		document.getElementById('file-input-section-dos').style.display = 'block';
	}
	//E-CAR
	function showUpdateecar() {
		document.getElementById('existing-ecar-image').style.display = 'none';
		document.getElementById('edit_ecar').style.display = 'none';
		document.getElementById('file-input-section-ecar').style.display = 'block';
	}
	//TAX DECLARATION
	function showUpdateTaxDec() {
		document.getElementById('existing-tax-dec-image').style.display = 'none';
		document.getElementById('edit_tax_dec').style.display = 'none';
		document.getElementById('tax_no').style.display = 'none';
		document.getElementById('file-input-section-tax-dec').style.display = 'block';
	}
	//TAX CLEARANCE
	function showUpdateTaxClearance() {
		document.getElementById('existing-tax-clearance-image').style.display = 'none';
		document.getElementById('edit_tax_clearance').style.display = 'none';
		document.getElementById('file-input-section-tax-clearance').style.display = 'block';
	}
	//SKETCH PLAN
	function showUpdateSketchPlan() {
		document.getElementById('existing-sketch-plan-image').style.display = 'none';
		document.getElementById('edit_sketch_plan').style.display = 'none';
		document.getElementById('file-input-section-sketch-plan').style.display = 'block';
	}
	//VICINITY MAP
	function showUpdateVicinityMap() {
		document.getElementById('existing-vicinity-map-image').style.display = 'none';
		document.getElementById('edit_vicinity_map').style.display = 'none';
		document.getElementById('file-input-section-vicinity-map').style.display = 'block';
	}
	//CERTIFICATE OF NO IMPROVEMENT
	function showUpdateCONI() {
		document.getElementById('existing-coni-image').style.display = 'none';
		document.getElementById('edit_coni').style.display = 'none';
		document.getElementById('file-input-section-coni').style.display = 'block';
	}
	//REAL ESTATE TAX
	function showUpdateRET() {
		document.getElementById('existing-ret-image').style.display = 'none';
		document.getElementById('edit_ret').style.display = 'none';
		document.getElementById('file-input-section-ret').style.display = 'block';
	}
	//MARRIAGE CONTRACT
	function showUpdateMC() {
		document.getElementById('existing-mc-image').style.display = 'none';
		document.getElementById('edit_mc').style.display = 'none';
		document.getElementById('file-input-section-mc').style.display = 'block';
	}
	//BIRTH CERTIFICATE
	function showUpdateBC() {
		document.getElementById('existing-bc-image').style.display = 'none';
		document.getElementById('edit_bc').style.display = 'none';
		document.getElementById('file-input-section-bc').style.display = 'block';
	}
	//VALID ID
	function showUpdateID() {
		document.getElementById('existing-valid-id-image').style.display = 'none';
		document.getElementById('edit_id').style.display = 'none';
		document.getElementById('file-input-section-id').style.display = 'block';
	}
	//SUBDIVISION PLAN
	function showUpdateSP() {
		document.getElementById('existing-sp-image').style.display = 'none';
		document.getElementById('edit_sp').style.display = 'none';
		document.getElementById('file-input-section-sp').style.display = 'block';
	}
	//SPA
	function showUpdateSPA() {
		document.getElementById('existing-spa-image').style.display = 'none';
		document.getElementById('edit_spa').style.display = 'none';
		document.getElementById('file-input-section-spa').style.display = 'block';
	}
	//DENR/DAR
	function showUpdateDENR() {
		document.getElementById('existing-denr-dar-image').style.display = 'none';
		document.getElementById('edit_denr').style.display = 'none';
		document.getElementById('file-input-section-denr').style.display = 'block';
	}

	function showUpdateOTHER() {
		// Hide existing images
		var existingImages = document.querySelectorAll('.existing-other-image');
		for (var i = 0; i < existingImages.length; i++) {
			existingImages[i].style.display = 'none';
		}

		// Hide the "Upload Another File" button
		document.getElementById('edit_other').style.display = 'none';

		// Hide the delete buttons
		var deleteButtons = document.querySelectorAll('.delete-button');
		for (var i = 0; i < deleteButtons.length; i++) {
			deleteButtons[i].style.display = 'none';
			document.getElementById('new_filename').style.display = 'none';
		}

		// Show the file input section
		document.getElementById('file-input-section-other').style.display = 'block';
		document.getElementById('other_document').style.display = 'none';
	}
</script>

<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#display-img1')
					.attr('src', e.target.result)
					.width(340)
					.height(270);
				$('#display-img2')
					.attr('src', e.target.result)
					.width(340)
					.height(270);
				$('#display-img3')
					.attr('src', e.target.result)
					.width(340)
					.height(270);
				$('#display-img4')
					.attr('src', e.target.result)
					.width(340)
					.height(270);
				$('#display-img5')
					.attr('src', e.target.result)
					.width(340)
					.height(270);
				$('#display-img6')
					.attr('src', e.target.result)
					.width(340)
					.height(270);
				$('#display-img7')
					.attr('src', e.target.result)
					.width(340)
					.height(270);
				$('#display-img8')
					.attr('src', e.target.result)
					.width(340)
					.height(270);
				$('#display-img9')
					.attr('src', e.target.result)
					.width(340)
					.height(270);
				$('#display-img10')
					.attr('src', e.target.result)
					.width(340)
					.height(270);
				$('#display-img11')
					.attr('src', e.target.result)
					.width(340)
					.height(270);
				$('#display-img12')
					.attr('src', e.target.result)
					.width(340)
					.height(270);
				$('#display-img13')
					.attr('src', e.target.result)
					.width(340)
					.height(270);
				$('#display-img14')
					.attr('src', e.target.result)
					.width(340)
					.height(270);
				$('#display-img15')
					.attr('src', e.target.result)
					.width(340)
					.height(270);
				$('#display-img16')
					.attr('src', e.target.result)
					.width(340)
					.height(270);
				$('#display-img17')
					.attr('src', e.target.result)
					.width(340)
					.height(270);
				};
				reader.readAsDataURL(input.files[0]);
			}
		}

		document.addEventListener("DOMContentLoaded", function(event) {
			$(function() {
			$('#upload_doc').change(function(){
				$('.titling').hide();
				$('#' + $(this).val()).show();
			});
		});
	});    
</script>

<script type="text/javascript">
	//Land Title
	function validate_lt(){
		valid = true;
		if($("#lt_file_upload").val() == ''){
			alert('Please select a file!');
			valid = false;
		}
		return valid
	}
	//TCT
	function validate_tct(){
		valid = true;
		if($("#tct_file_upload").val() == ''){
			alert('Please select a file!');
			valid = false;
		}
		return valid
	}
	//Deed of Sale
	function validate_dos(){
		valid = true;
		if($("#dos_file_upload").val() == ''){
			alert('Please select a file!');
			valid = false;
		}
		return valid
	}
	//Ecar
	function validate_ecar(){
		valid = true;
		if($("#ecar_file_upload").val() == ''){
			alert('Please select a file!');
			valid = false;
		}
		return valid
	}
	//Tax Declaration
	function validate_td(){
		valid = true;
		if($("#td_file_upload").val() == ''){
			alert('Please select a file!');
			valid = false;
		}
		return valid
	}
	//Tax Clearance
	function validate_tc(){
		valid = true;
		if($("#tc_file_upload").val() == ''){
			alert('Please select a file!');
			valid = false;
		}
		return valid
	}
	//Sketch Plan
	function validate_ls(){
		valid = true;
		if($("#ls_file_upload").val() == ''){
			alert('Please select a file!');
			valid = false;
		}
		return valid
	}
	//Vicinity Map
	function validate_vm(){
		valid = true;
		if($("#vm_file_upload").val() == ''){
			alert('Please select a file!');
			valid = false;
		}
		return valid
	}
	//Certification of no improvement
	function validate_cni(){
		valid = true;
		if($("#cni_file_upload").val() == ''){
			alert('Please select a file!');
			valid = false;
		}
		return valid
	}
	//Real Property Tax
	function validate_ret(){
		valid = true;
		if($("#ret_file_upload").val() == ''){
			alert('Please select a file!');
			valid = false;
		}
		return valid
	}
	//Marriage Contract
	function validate_mc(){
		valid = true;
		if($("#mc_file_upload").val() == ''){
			alert('Please select a file!');
			valid = false;
		}
		return valid
	}
	//Birth Certificate
	function validate_bc(){
		valid = true;
		if($("#bc_file_upload").val() == ''){
			alert('Please select a file!');
			valid = false;
		}
		return valid
	}
	//Vallid ID
	function validate_vi(){
		valid = true;
		if($("#vi_file_upload").val() == ''){
			alert('Please select a file!');
			valid = false;
		}
		return valid
	}
	//Subdivision Plan
	function validate_sp(){
		valid = true;
		if($("#sp_file_upload").val() == ''){
			alert('Please select a file!');
			valid = false;
		}
		return valid
	}
	//SPA
	function validate_spa(){
		valid = true;
		if($("#spa_file_upload").val() == ''){
			alert('Please select a file!');
			valid = false;
		}
		return valid
	}
	//DENR/DAR
	function validate_denr(){
		valid = true;
		if($("#denr_file_upload").val() == ''){
			alert('Please select a file!');
			valid = false;
		}
		return valid
	}
</script>

<style>
	.button {
		display: inline-block;
		padding: 15px 25px;
		font-size: 24px;
		cursor: pointer;
		text-align: center; 
		text-decoration: none;
		outline: none;
		color: #fff;
		background-color: #ff6600;
		border: none;
		border-radius: 15px;
		box-shadow: 0 9px #999;
	}
	.button:hover {
		background-color: #b34700;
	}
	.button:active {
		background-color: #999;
		box-shadow: 0 5px #666;
		transform: translateY(4px);
	}
	.h3 {
		text-align: center;
		text-transform: uppercase;
		color: #008CBA;
		text-decoration: underline;
		font-family: "Times New Roman", Times, serif;
	}
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
		margin-top: 8px;
		margin-left: 9px;
		width: 98%;
		padding: 10px 17px;
		display: inline-block;
		background: #fff;
		border-radius:9px;
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
		border-radius:9px;
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
	input[type="text"] {
		border: 1px solid #1abb9c8a;
	}
	input[type="number"] {
		border: 1px solid #1abb9c8a;
	}
	input[type="date"] {
		border: 1px solid #1abb9c8a;
	}
	input[type="email"] {
		border: 1px solid #1abb9c8a;
	}
	.change-message {
		display: none;
		color: red;
	}
	.file-name-label{
		overflow:hidden;
		text-overflow:ellipsis; 
		width: 128px; 
		height: 14px;
		margin-top: 10px; 
		margin-right: 5px;
		display:block; 
		float: left;
	}
</style>

<style type="text/css">
	.container2 {
		position: relative;
		margin-top: 50px;
		width: 500px;
		height: 300px;
	}
	.overlay2 {
		position: absolute;
		top: 0;
		left: 0;
		width: 67%;
		height: 90%;
		background: rgba(0, 0, 0, 0);
		transition: background 0.5s ease;
	}
	.container2:hover .overlay2 {
		display: block;
		background: rgba(0, 0, 0, .3);
	}
	.title2 {
		position: absolute;
		width: 500px;
		left: 0;
		top: 120px;
		font-weight: 700;
		font-size: 30px;
		text-align: center;
		text-transform: uppercase;
		color: white;
		z-index: 1;
		transition: top .5s ease;
	}
	.container2:hover .title2 {
		top: 90px;
	}
	.upload_btn {
		position: absolute;
		width: 500px;
		left:0;
		top: 180px;
		text-align: center;
		opacity: 0;
		transition: opacity .35s ease;
	}
	.upload_btn a {
		width: 200px;
		padding: 12px 48px;
		text-align: center;
		color: white;
		border: solid 2px white;
		z-index: 1;
		margin-left: -158px;
	}
	.container2:hover .upload_btn {
		opacity: 1;
	}
	.file-name-label{
		overflow:hidden;
		text-overflow:ellipsis; 
		width: 128px; 
		height: 14px;
		margin-top: 10px; 
		display:block; 
		float: left;
	}
</style>