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
			<!--====================END FLASH DATA====================-->
			<div class="x_panel animate slideInDown" style="border:1px; !important;box-shadow: 7px 6px 16px #888888;">
				<div class="x_title">
					<div class="title_left">
						<h2 style="word-spacing: 4px; letter-spacing: 1px; font-weight: bold; font-size:14px;color: #2a3f54;"><i class="fa fa-upload"></i> Upload Documents</h2>
					</div>
					<div class="pull-right">
						<form action="<?= base_url('Old_Acquisition/cancel_acq_owner_info/'.$id) ?>" method="POST" onsubmit="return confirm('Are you sure to cancel all the informations you have inputed?');">
							<button type="submitt" name="cancel_acq_upload" class="btn btn-warning" style="background-color: #e65c00;"><i class="glyphicon glyphicon-floppy-remove"></i> Cancel</button>
						</form>
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="x_panel" style="border-radius:9px; ">
					<div class="row">

						<div class="col-md-12 col-sm-12 col-xs-12" style="border-top: 1px solid #ff6600; border-bottom: 1px solid #ff6600;" >
							<center><h3 style="letter-spacing: 10px; color: black;font-size:16px"><b>UPLOAD PROOF OF TITLE</b></h3></center>
						</div>

						<!--====================Dropdown====================-->
						<div class="col-md-12"><br/>
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
								<?php echo form_open_multipart('Old_Acquisition/upload_owner_documents/'.$li['is_no'], array('onsubmit' => 'return validate_lt()'));?>
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
								<?php echo form_open_multipart('Old_Acquisition/upload_owner_documents/'.$li['is_no'], array('onsubmit' => 'return validate_tct()'));?>
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
								<?php echo form_open_multipart('Old_Acquisition/upload_owner_documents/'.$li['is_no'], array('onsubmit' => 'return validate_dos()'));?>
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
								<?php echo form_open_multipart('Old_Acquisition/upload_owner_documents/'.$li['is_no'], array('onsubmit' => 'return validate_ecar()'));?>
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
								<?php echo form_open_multipart('Old_Acquisition/upload_owner_documents/'.$li['is_no'], array('onsubmit' => 'return validate_td()'));?>
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
								<?php echo form_open_multipart('Old_Acquisition/upload_owner_documents/'.$li['is_no'], array('onsubmit' => 'return validate_tc()'));?>
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
								<?php echo form_open_multipart('Old_Acquisition/upload_owner_documents/'.$li['is_no'], array('onsubmit' => 'return validate_ls()'));?>
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
								<?php echo form_open_multipart('Old_Acquisition/upload_owner_documents/'.$li['is_no'], array('onsubmit' => 'return validate_vm()'));?>
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
								<?php echo form_open_multipart('Old_Acquisition/upload_owner_documents/'.$li['is_no'], array('onsubmit' => 'return validate_cni()'));?>
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
								<?php echo form_open_multipart('Old_Acquisition/upload_owner_documents/'.$li['is_no'], array('onsubmit' => 'return validate_ret()'));?>
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
								<?php echo form_open_multipart('Old_Acquisition/upload_owner_documents/'.$li['is_no'], array('onsubmit' => 'return validate_mc()'));?>
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
								<?php echo form_open_multipart('Old_Acquisition/upload_owner_documents/'.$li['is_no'], array('onsubmit' => 'return validate_bc()'));?>
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
								<?php echo form_open_multipart('Old_Acquisition/upload_owner_documents/'.$li['is_no'], array('onsubmit' => 'return validate_vi()'));?>
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
								<?php echo form_open_multipart('Old_Acquisition/upload_owner_documents/'.$li['is_no'], array('onsubmit' => 'return validate_sp()'));?>
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
								<?php echo form_open_multipart('Old_Acquisition/upload_owner_documents/'.$li['is_no'], array('onsubmit' => 'return validate_spa()'));?>
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
								<?php echo form_open_multipart('Old_Acquisition/upload_owner_documents/'.$li['is_no'], array('onsubmit' => 'return validate_denr()'));?>
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
								<?php echo form_open_multipart('Old_Acquisition/upload_owner_documents/'.$li['is_no'], array('onsubmit' => 'return validate_other()'));?>
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
														<form action="<?= base_url('Old_Acquisition/upload_owner_documents/' . $ud['is_no']) ?>" method="post" class="delete-form">
															<input type="hidden" name="file_name" value="<?= trim($fileName) ?>">
															<div class="col-md-8"style="margin-top:-50px">
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
				<div class="pull-right">
					<input class="btn btn-custom-primary send"  type="submit" name="submit" id="<?php echo $li['is_no']?>" value="Submit">
				</div>
			</div>
			
		</div>
	</div>           
</div>

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

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(event) {
		// SUBMIT JQUERY
		$(".send").click(function(){
			var id = $(this).attr("id");
			$.ajax({
				url: "<?php echo base_url('Old_Acquisition/send_documents/'); ?>" + id,
				type: "post",
				data: {
					'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				dataType: 'json',
				success: function (response) {
					console.log('Response:', response);
					if (response.success) {
						window.location.replace("<?php echo base_url('Acquisition/pop_up_upload/'); ?>" + id);
					} else {
						alert("Error: " + response.message);
					}
				},
				error: function (xhr, status, error) {
					alert("Error: Something went wrong.");
				}
			});
		});
		// SUBMIT JQUERY
	});
</script>


<style type="text/css">

	label.small {
		font-variant: small-caps;
		font-size: 0.900em;
		letter-spacing: 2px;
		color: #595959;
	}
	i.small {
		font-variant: small-caps;
		font-size: 0.900em;
		letter-spacing: 3px;
		color: #006bb3;
	}
	.inb{
		font-style: italic;
		box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.075);
		border: none;
		border-bottom: 1px solid #cccccc;
	}

	.table .purpose-data {
		overflow: hidden;
		white-space: nowrap;
		text-overflow: ellipsis;
		max-width: 335px;
	}

	.purpose-hover:hover  {
		background-color: #298aea; /*#5bc0de;*/
		color: #5bc0de;
		cursor: pointer;
	}


	.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
		background-color: white;
		opacity: 1;
	}

	#mvTop {
		display: none;
		position: fixed;
		bottom: 10px;
		right: 10px;
		z-index: 99;
		font-size: 18px;
		border: none;
		outline: none;
		background-color: #0066ff;
		color: white;
		cursor: pointer;
		padding: 15px;
		border-radius: 4px;
	}

	#mvTop:hover {
		background-color: #555;
	}

	.container2 {
		position: relative;
		margin-top: 50px;
		width: 500px;
		height: 300px;
	}

	.container3 {
		position: relative;
		margin-top: 50px;
		width: 500px;
		height: 300px;
		background-color:#ddd
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

	p.normal {
		font-variant: normal;
	}

	label.small {
		font-variant: small-caps;
		font-size: 0.900em;
		letter-spacing: 2px;
		color: #595959;
	}
	i.small {
		font-variant: small-caps;
		font-size: 0.900em;
		letter-spacing: 3px;
		color: #006bb3;
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
		background: #FFF;
		color: black;
	}
</style>