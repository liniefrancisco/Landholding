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
			<?php if($this->session->flashdata('error')){?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert" id="saved">
					<i class="fa fa-warning"></i>  <?php echo $this->session->flashdata('error'); ?>
				</div>
			<?php } ?>
			<!--====================END FLASH DATA====================-->

			<div class="x_panel animate slideInDown" style="border:1px; !important;box-shadow: 7px 6px 16px #888888;">
				<div class="x_title">
	          		<div class="title_left">
	            		<h2 style="word-spacing: 4px; letter-spacing: 1px; font-weight: bold; font-size: 14px;color: #2a3f54;"><i class="fa fa-edit" style="font-size:16px;"></i> Add Land</h2>
			            <div style="float:right;color: #2a3f54;">
			              	<a type="a" href="<?= base_url() ?>" class="btn btn-custom-warning btn-hover btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
			            </div>
	          		</div>
	          		<div class="clearfix"></div>
	        	</div>

	        	<!--CUSTOMIZE ID-->
				<?php $is_id=0;
					if(empty($is_no)){
						$is_no = "OA-0001";
					}
					foreach ($land_id as $li) {
						$is_id = substr($li['is_no'],3)+1;
						if(strlen($is_id) == 1){
						  	$is_no = "OA-000".$is_id;
						}elseif(strlen($is_id) == 2){
						  	$is_no = "OA-00".$is_id;
						}elseif(strlen($is_id) == 3){
						  	$is_no = "OA-0".$is_id;
						}else{
						  	$is_no = "OA-".$is_id;
						}
					}  
				?>
				<!--END CUSTOMIZE ID-->
                            
				<?php echo form_open('Legal/registry/add_land', array('id' => 'add_acq'));?>
					<!--====================BODY====================-->
					<!-- <div class="x_panel" style="border-radius:9px;">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12 space">
								<div class="col-md-4 col-sm-4 col-xs-4 form-inline">
									<label>IS No:</label>
									<input class="form-control input_border" type="text" name="is_no" value="<?php echo $is_no; ?>"  readonly>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-4"></div>
								<div class="col-md-4 col-sm-4 col-xs-4 form-inline pull-right">
									<label>Date Acquired:</label>
									<input class="form-control input_border" type="date" value="<?php echo date('Y-m-d');?>" name="date_acquired" id="acq" readonly>
								</div>
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 space" style="border-top: 2px solid #ff6600; border-bottom: 2px solid #ff6600;">
								<center><h5 style="letter-spacing: 10px;"><b>LAND INFORMATION</b></h5></center>
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 space">
								<div class="col-md-3 col-sm-3 col-xs-3">
										<input type="text" name="lot" id="lot_no" value="<?php if(isset($_POST['lot'])){ echo $_POST['lot']; } ?>" class="form-control input_border txt_cent" required>
										<center><label>Lot No.</label></center>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-3">
										<input type="text" name="cad" id="cad_no" value="<?php if(isset($_POST['cad'])){ echo $_POST['cad']; } ?>" class="form-control input_border txt_cent"required>
										<center><label>Cad.</label></center>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-3">
										<input type="text" name="title_no" id="lt_no" value="<?php if(isset($_POST['title_no'])){ echo $_POST['title_no']; } ?>" class="form-control input_border txt_cent" required>
										<center><label>Land Title No.</label></center>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-3">
										<input type="text" name="tax_no" id="td_no" value="<?php if(isset($_POST['tax_no'])){ echo $_POST['tax_no']; } ?>" class="form-control input_border txt_cent" required>
										<center><label>Latest Tax Declaration No.</label></center>
								</div>
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 space">
								<div class="col-md-3 col-sm-3 col-xs-3 lot_type" style="height:30px;"><label>Lot Type:</label></div>
								<div class="col-md-3 col-sm-3 col-xs-3 lot_type">
									<label class="r-contain">
										<input type="radio" name="lot_type" value="Agricultural" <?php if(@$_POST['lot_type'] == "Agricultural"){ echo "checked";} ?> required> Agricultural <span class="checkmark"></span>
									</label>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-3 lot_type">
									<label class="r-contain">
										<input type="radio" name="lot_type" value="Commercial" <?php if(@$_POST['lot_type'] == "Commercial"){ echo "checked";} ?> required> Commercial <span class="checkmark"></span>
									</label>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-3 lot_type">
									<label class="r-contain">
										<input type="radio" name="lot_type" value="Residential" <?php if(@$_POST['lot_type'] == "Residential"){ echo "checked";} ?> required> Residential <span class="checkmark"></span>
									</label>
								</div>
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 space"> 
								<div class="col-md-3 col-sm-3 col-xs-3"><label>Lot Location:</label></div>

								<div class="col-md-3 col-sm-3 col-xs-3">
									<select class="form-control input_border txt_cent" id="region" name="region" onchange="loadProvince()"value="<?php if(isset($_POST['region'])){ echo $_POST['region']; } ?>"required>
									   	<option value="">Select Region</option>
									</select>
									<h6 class="name_center"><i>Region</i></h6>
								</div>

								<div class="col-md-3 col-sm-3 col-xs-3 autocomplete">
									<select class="form-control input_border txt_cent" id="province" name="province" onchange="loadCity()" value="<?php echo set_value('province'); ?>"  required>
									  	<option value="">Select Province</option>
								  	</select>
									<h6 class="name_center"><i>Province</i></h6>
								</div>

								<div class="col-md-3 col-sm-3 col-xs-3">
									<select class="form-control input_border txt_cent" id="town" name="town" onchange="loadBrgy()" value="<?php echo set_value('town'); ?>"  required>
									  	<option value="">Select City</option>
								  	</select>
									<h6 class="name_center"><i>City/Municipality</i></h6>
								</div>

								<div class="col-md-3 col-sm-3 col-xs-3"></div>

								<div class="col-md-3 col-sm-3 col-xs-3">
									<select class="form-control input_border txt_cent" id="barangay" name="barangay" value="<?php echo set_value('baranggay') ?>" required>
									  	<option value="">Select Barangay</option>
								  	</select>
									<h6 class="name_center"><i>Barangay</i></h6>
								</div>

								<div class="col-md-3 col-sm-3 col-xs-3">
									<input type="text" class="form-control input_border txt_cent" name="street" id="street" value="<?php echo set_value('street') ?>" required>
									<h6 class="name_center"><i>Street</i></h6>
								</div>

								<div class="col-md-3 col-sm-3 col-xs-3">
									<input type="text" class="form-control input_border txt_cent" name="zipcode" id="zipcode" value="<?php echo set_value('zipcode') ?>" required readonly>
									<h6 class="name_center"><i>Zipcode</i></h6>
								</div>
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 space">
								<div class="col-md-4 col-sm-4 col-xs-4">
									<label>Lot Sold:</label>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<label class="r-contain">
										<input type="radio" name="lot_sold" value="Portion" <?php if(@$_POST['lot_sold'] == 'Portion'){ echo 'checked'; } ?> required> Portion <span class="checkmark"></span>
									</label>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<label class="r-contain">
										<input type="radio" name="lot_sold" value="Whole" <?php if(@$_POST['lot_sold'] == 'Whole'){ echo 'checked'; } ?> required> Whole <span class="checkmark"></span>
									</label>
								</div>
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 space">
								<div class="col-md-4 col-sm-4 col-xs-4">
									<label>Purchase Type:</label>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<label class="r-contain">
										<input type="radio" name="purchase_type" value="package" <?php if(@$_POST['purchase_type'] == 'package'){ echo 'checked'; } ?> class="purchase_t" required> package <span class="checkmark"></span>
									</label>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-4">
									<label class="r-contain">
										<input type="radio" name="purchase_type" value="per/sq.m." <?php if(@$_POST['purchase_type'] == 'per/sq.m.'){ echo 'checked'; } ?> class="purchase_t" required> per sq.m <span class="checkmark"></span>
									</label>
								</div>
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 space">
								<div class="col-md-4 col-xs-4 col-sm-4 form-inline">
									<label>Lot Size:</label> 
									<input type="text" min="0" value="<?php if(isset($_POST['lot_area'])){ echo $_POST['lot_area']; } ?>" name="lot_area" id="la_form" class="form-control input_border" required><label>sq.m</label>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6 form-inline" id="s_price" <?php if(@$_POST['purchase_type'] == 'per/sq.m.'){ echo 'style="display: block;"';  }else{ echo 'style="display: none;"'; } ?>>
									<label>Selling Price per sq.m: ₱</label> 
									<input type="text" min="0" name="selling_price" id="sp_form" value="<?php if(isset($_POST['selling_price'])){ echo $_POST['selling_price']; } ?>" class="form-control input_border" >
								</div>
							</div>
							<div class="col-md-12 form-inline space">
								<label>Total Selling Price: ₱</label>
								<input type="text" value="<?php if(isset($_POST['total_price'])){ echo $_POST['total_price']; } ?>" name="total_price" id="total_form" class="form-control input_border" >
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12 space">
								<label>Restriction/s to Land Title:</label>
							</div>
							<div class="col-md-12">
								<div class="col-md-3 col-sm-3 col-xs-3" style="border: 1px solid #cccccc">
									<label>Liens</label>
								</div>
								<div class="col-md-9 col-sm-9 col-xs-9" style="border: 1px solid #cccccc">
									<textarea name="liens" value="" id="liens" class="form-control"><?php if(isset($_POST['liens'])){ echo $_POST['liens']; } ?></textarea>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-3" style="border: 1px solid #cccccc">
									<label>Easement</label>
								</div>
								<div class="col-md-9 col-sm-9 col-xs-9" style="border: 1px solid #cccccc">
									<textarea name="easement" id="ease" value="" class="form-control"><?php if(isset($_POST['easement'])){ echo $_POST['easement']; } ?></textarea>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-3" style="border: 1px solid #cccccc">
									<label>Encumbrances</label>
								</div>
								<div class="col-md-9 col-sm-9 col-xs-9" style="border: 1px solid #cccccc">
									<textarea name="encumbrances" id="encum" value="" class="form-control"><?php if(isset($_POST['encumbrances'])){ echo $_POST['encumbrances']; } ?></textarea>
								</div>
							</div>
						</div>
					</div>   -->

					<div class="x_panel" style="border-radius:9px;">
						<div class="row">   
							<div class="col-md-12 col-sm-12 col-xs-12 space">       
								<div class="col-md-6 col-sm-6 col-xs-6">          
									<div class="form-group">
										<label class="control-label col-md-3" for="first-name">I.S No.</label>
										<div class="col-md-7">
											<input type="text" id="is_no" name="is_no" value="<?php echo $is_no; ?>" class="form-control" onkeydown="return false" readonly/>
										</div>
									</div> 
								</div>

								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="form-group">
										<label class="control-label col-md-3" for="first-name">Date Acquire</label>
										<div class="col-md-7 ">
											<input class="form-control has-feedback-left" type="date" value="<?php echo date('Y-m-d');?>" name="date_acquired" id="acq" readonly>
											<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
											<span id="inputSuccess2Status2" class="sr-only">(success)</span>
										</div>
									</div>                            
								</div>
							</div>
					
							<div class="col-md-12 col-xs-12 col-sm-12 space" style="border-top: 1px solid #ff6600; border-bottom: 1px solid #ff6600">
								<center><h5 style="letter-spacing: 10px"><b>LAND  INFORMATION</b></h5></center>
							</div><br/><br/><br/>

							<input type="hidden"  name="p_by" value="<?php echo ucfirst($this->session->userdata('firstname')).' '.ucfirst($this->session->userdata('lastname'))?>" class="form-control" onkeydown="return false" readonly/>

							<div class="col-md-12 col-sm-12 col-xs-12 space">  
								<div class="col-md-6 col-sm-6 col-xs-6">
									<label class="control-label col-md-3">Lot No.<span class="required">*</span></label> 
									<div class="col-md-7">
										<input type="text" min="0" id="lot" name="lot" class="form-control" value="<?php echo set_value('lot_no') ?>" required>
									</div>
								</div>

								<div class="col-md-6 col-sm-6 col-xs-6">
									<label class="control-label col-md-3">Cad.<span class="required">*</span></label> 
									<div class="col-md-7">
										<input type="text" min="0" id="cad" name="cad" class="form-control" value="<?php echo set_value('cad_no') ?>" >
									</div>
								</div>
							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 space">  
								<div class="col-md-6 col-sm-6 col-xs-6">
									<label class="control-label col-md-3">Title No.<span class="required">*</span></label> 
									<div class="col-md-7">
										<input type="text" min="0" id="title_no" name="title_no" class="form-control" value="<?php if(isset($_POST['title_no'])){ echo $_POST['title_no']; } ?>" required>
									</div>
								</div>

								<div class="col-md-6 col-sm-6 col-xs-6">
									<label class="control-label col-md-3">Tax Dec. No.<span class="required">*</span></label> 
									<div class="col-md-7">
										<input type="text" min="0" id="tax_no" name="tax_no" class="form-control" value="<?php if(isset($_POST['tax_no'])){ echo $_POST['tax_no']; } ?>" required>
									</div>
								</div>
							</div>
								
							<div class="col-md-12 col-xs-12 col-sm-12 space" style="border:1px solid #E6E9ED; display: inline">
								<div class="col-md-3 col-sm-3 col-xs-3" style="border-right:2px solid #E6E9ED;">
									<label style="color:#1a1a1a;font-size:15px"><b>Lot Type:</b></label>                 
								</div>

								<div class="col-md-3 col-sm-3 col-xs-3" style="border-right:2px solid #E6E9ED;">
									<label class="r-contain">
										<input type="radio" name="lot_type" value="Agricultural" <?php if(@$_POST['lot_type'] == "Agricultural"){ echo "checked";} ?> required>Agricultural<span class="checkmark"></span>
									</label>
								</div>

								<div class="col-md-3 col-sm-3 col-xs-3">
									<label class="r-contain">
										<input type="radio" name="lot_type" value="Commercial" <?php if(@$_POST['lot_type'] == "Commercial"){ echo "checked";} ?> required>Commercial<span class="checkmark"></span>
									</label>
								</div>

								<div class="col-md-3 col-sm-3 col-xs-3" style="border-left:2px solid #E6E9ED;">
									<label class="r-contain">
										<input type="radio" name="lot_type" value="Residential" <?php if(@$_POST['lot_type'] == "Residential"){ echo "checked";} ?> required>Residential<span class="checkmark"></span>
									</label>
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
										<h2 style="color:#1a1a1a;font-size:15px"><b>Restriction/s to Land Title:</b></h2>                 
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
					<div style="float: right;">
						<a href="<?= base_url() ?>" class="btn btn-default">Cancel</a>
						<input type="submit" name="submit_land_reg" class="btn btn-custom-primary send" value="Proceed">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--====================END PAGE CONTENT====================-->

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(event) {
		$(".purchase_t").click(function(){
			var a = $(this).attr("value");
			if(a == "package"){
				$("#s_price").hide();
				$("#total_form").prop('required',true);
				$("#total_form").prop('readonly',false);
				$('#sp_form').val('');
				$('#total_form').val('');
			}else{
				$("#s_price").show();
				$("#sp_form").prop('required',true);
				$("#total_form").prop('readonly',true);
			}
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
	function myDateValidation(uInput){
		var startDate = new Date($('#acq').val());
		var endDate = new Date($('#app').val());
		var d = new Date();

		if(d < startDate || d < endDate){
			alert('Please input a valid date!');
			uInput.value = "";
			return false;
		}

		if (startDate > endDate){
			alert('Please input a valid date!');
			uInput.value = "";
			return false;
		}
	}
</script>

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(event) {
		//JQUERY OF DATE ACQUIRED
		var d = new Date();
		var month = d.getMonth()+1;
		var day = d.getDate();
		var output = (month<10 ? '0' : '') + month + '/' + (day<10 ? '0' : '') + day + '/' + d.getFullYear();
		$("#date").val(output);

		$('#acq').flatpickr({
		  	dateFormat: "Y-m-d"
		});
		$('#app').flatpickr({
		  	dateFormat: "Y-m-d"
		});
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

		$('#town').on('change',function(){
			var selected_op = $('#town').find('option:selected');
			var zipcode = selected_op.data('zipcode');
			console.log('zipcode',zipcode);
			$('#zipcode').val(zipcode);
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
			url: "<?php echo site_url("Legal/Registry/getprovince") ?>",
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
			url: "<?php echo site_url("Legal/Registry/getcitymun") ?>",
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

		$.ajax({
			url: "<?php echo site_url("Legal/Registry/getbrgy") ?>",
			method: "POST",
			dataType: 'json',
			data: {
				citymunCode: citymunCode
			},
			success: function(data) {
				$.each(data, function(i, data) {

					$('#barangay').append('<option value="' + data
						.brgyDesc + '" data-code="'+data.brgyCode+'">' + data.brgyDesc + '</option>');
				});
			}
		});
	}
</script>


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