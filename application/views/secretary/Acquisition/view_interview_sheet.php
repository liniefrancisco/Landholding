<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container">
		<!--====================BUTTON====================-->
		<button onclick="topFunction()" id="mvTop" title="Go to top"><i class="fa fa-arrow-up"></i>Top</button>
		<?php if ($ds['status'] == 'Pending' && $this->session->userdata('user_type') == 'Legal') { ?>
			<div class="col-md-12 space">
				<div class="col-md-4"></div>
				<div class="col-md-8" style="position: fixed;width: 290px;bottom: 15px;right: 10px;z-index: 99;cursor: pointer;">
					<button style="float: right;border-radius: 10px" class="btn btn-xs btn-custom-danger" data-dismiss="modal" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target=".disapprove_<?php echo $li['is_no']; ?>" title="Mark as Disapproved"><span class="fa fa-check-square-o"></span> Disapproved</button>
					<button style="float: right;border-radius: 10px;" class="btn btn-xs btn-warning" data-dismiss="modal" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target=".return_<?php echo $li['is_no']; ?>" title="Mark as Return"><span class="fa fa-close"></span> Return</button>
					<button style="float: right;border-radius: 10px" class="btn btn-xs btn-primary" data-dismiss="modal" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target=".review_<?php echo $li['is_no']; ?>" title="Mark as Review"><span class="fa fa-check-square-o"></span> Review</button>
				</div>
			</div>
		<?php } elseif ($ds['status'] == 'Reviewed' && $this->session->userdata('user_type') == 'GM') { ?>
			<div class="col-md-12 space">
				<div class="col-md-6"></div>
				<div class="col-md-6" style="position: fixed;width:100%;bottom: 15px;right: 10px;z-index: 99;cursor: pointer;">
					<button style="float: right;border-radius: 10px" class="btn btn-xs btn-custom-danger" data-dismiss="modal" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target=".disapprove_<?php echo $li['is_no']; ?>" title="Mark as Disapproved"><span class="fa fa-close"></span> Disapproved</button>
					<button style="float: right;border-radius: 10px;" class="btn btn-xs btn-primary" data-dismiss="modal" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target=".approve_<?php echo $li['is_no']; ?>" title="Mark as Approve"><span class="fa fa-check-square-o"></span> Approved</button>
				</div>
			</div>
		<?php } ?>
		<!--====================END BUTTON====================-->
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!--====================BODY====================-->
			<div class="x_panel animate fadeIn" style="border:1px; !important;box-shadow: 7px 6px 16px #888888;">
				<div class="x_title">
					<h2 class="fa fa-book" style="font-size:15px"> <b>Land Profile <u style="color:#eb5d0c"> <?php if ($oi['is_no']) { echo $oi['is_no']; } ?></u></b></h2>
					<div style="float:right">
						<a href="#" onclick="window.history.back()" class="btn btn-sm btn-warning"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="col-md-12 col-sm-12 col-xs-12 first_panel">
					<?php if(!$ud['land_sketch'] == null){ ?>      
						<div class="col-md-2 col-sm-2 col-xs-2">
							<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Land Sketch/'.$ud['land_sketch'].'') ?>" width="150px" height="120px" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19); border: 2px solid #4CAF50;">                                 
						</div>
					<?php }else{ ?>
						<div class="col-md-2 col-sm-2 col-xs-2">
							<img src="<?= base_url('assets/logo/no_file.png') ?>" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19); border: 2px solid #ff6600; max-width: 150px; max-height: 150px;" class="image-responsive">
						</div>
					<?php } ?>
					<div class="col-md-9 col-sm-9 col-xs-9"><label class="col-md-4 small">Lot. <b style="float: right;">:</b></label>  
						<i class="small"> <?php if($li['lot']){ echo $li['lot']; }else{ echo "None"; } ?></i>
					</div>
					<div class="col-md-9 col-sm-9 col-xs-9"><label class="col-md-4 small">Cad. <b style="float: right;">:</b></label>   
						<i class="small"> <?php if($li['cad']){ echo $li['cad']; }else{ echo "None"; } ?></i>
					</div>
					<div class="col-md-9 col-sm-9 col-xs-9"><label class="col-md-4 small">Land Title No. <b style="float: right;">:</b></label> 
						<i class="small"> <?php if($li['land_title_no']){ echo $li['land_title_no']; }else{ echo "None";} ?></i>
					</div>
					<div class="col-md-9 col-sm-9 col-xs-9"><label class="col-md-4 small">Tax Declaration No. <b style="float: right;">:</b></label> 
						<i class="small"> <?php if($li['tax_dec_no']){ echo $li['tax_dec_no']; }else{ echo "None"; } ?></i>
					</div>
					<div class="col-md-9 col-sm-9 col-xs-9"><label class="col-md-4 small">Lot Owner <b style="float: right;">:</b></label> 
						<i class="small"> <?php echo ucfirst($oi['firstname']) ?> <?php echo ucfirst($oi['lastname']) ?></i>
					</div>

					<div class="col-md-9 col-sm-9 col-xs-9"><label class="col-md-4 small">Lot Location <b style="float: right;">:</b></label>
						<i class="small"> <?php echo ucfirst($ll['street']) ?>- <?php echo ucfirst($ll['baranggay']) ?>, <?php echo ucfirst($ll['municipality']) ?>, <?php echo ucfirst($ll['province']) ?></i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12"> 
						<div class="col-md-2 col-sm-2 col-xs-2"><center><label><b style="color: #ff6600;">LAND SKETCH</b></label></center></div>
					</div>
				</div>

				<div id="exTab3" class="container">
					<!--====================TABPANE====================-->
					<ul class="nav nav-pills flex-column flex-sm-row">
			            <li class="nav-item"><a class="nav-link" href="#1b" data-toggle="tab">INTERVIEW SHEET</a></li>
			            <li class="nav-item"><a class="nav-link" href="#2b" data-toggle="tab">DOCUMENT REQUIREMENTS</a></li>
			        </ul>
					<!--====================END TABPANE====================-->

					<div class="tab-content clearfix">
						<!--====================INTERVIEW SHEET====================-->
						<div class="tab-pane active" id="1b">
							<div class="x_panel animate fadeIn" style="border-radius:10px">
								<div class="col-md-12"><br/>
									<center>
										<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
										<h4 style="letter-spacing: 2px;"><b>INTERVIEW SHEET (IS)</b></h4>
									</center>

									<div class="col-md-12 col-sm-12 col-xs-12 space">
										<div class="col-md-4 col-sm-4 col-xs-4 form-inline">
											<label>IS No:</label> <input class="form-control input_border" type="text" name="js_no" value="<?php echo $li['is_no']; ?>" readonly>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-4 form-inline pull-right">
											<label>Date Acquired:</label> <input class="form-control input_border" type="text" value="<?php echo date('F j, Y', strtotime($li['date_acquired'])); ?>" name="date" readonly>
										</div>
									</div>

									<div class="col-md-12 col-sm-12 col-xs-12 space" style="border-top: 2px solid #ff6600; border-bottom: 2px solid #ff6600;">
										<center>
											<h5 style="letter-spacing: 15px;"><b>LAND INFORMATION</b></h5>
										</center>
									</div>

									<div class="col-md-12 col-sm-12 col-xs-12 space">
										<div class="col-md-4 col-sm-4 col-xs-4 form-inline">
											<label>Lot.</label> <input type="text" name="" value="<?php echo $li['lot'] ?>" class="form-control input_border " readonly>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-4 form-inline pull-right">
											<label>Cad.</label> <input type="text" name="" value="<?php echo $li['cad'] ?>" class="form-control input_border" readonly>
										</div>
									</div>

									<div class="col-md-12 col-sm-12 col-xs-12 space">
										<div class="col-md-3 col-sm-3 col-xs-3 lot_type" style="height: 29px;"><label>Lot Type:</label></div>
										<div class="col-md-3 col-sm-3 col-xs-3 lot_type">
											<input type="checkbox" name="" disabled value="<?php ?>" <?php if($li['lot_type'] == 'Agricultural'){ echo 'checked';}?>><label> Agricultural</label>
										</div>
										<div class="col-md-3 col-sm-3 col-xs-3 lot_type">
											<input type="checkbox" name="" disabled value="<?php ?>" <?php if($li['lot_type'] == 'Commercial'){  echo 'checked';}?>><label> Commercial</label>
										</div>
										<div class="col-md-3 col-sm-3 col-xs-3 lot_type">
											<input type="checkbox" name="" disabled value="<?php ?>" <?php if($li['lot_type'] == 'Residential'){ echo 'checked';}?>><label> Residential</label>
										</div>
									</div>

									<div class="col-md-12 col-sm-12 col-xs-12 space">
										<div class="col-md-3 col-sm-3 col-xs-3"><label>Lot Owner:</div>
										<div class="col-md-3 col-sm-3 col-xs-3">
											<input type="text" name="" value="<?php echo $oi['firstname'] ?>" class="form-control input_border txt_cent" readonly>
											<h6 class="name_center"><i>Firstname</i></h6>
										</div>
										<div class="col-md-3 col-sm-3 col-xs-3">
											<input type="text" name="" value="<?php echo $oi['middlename'] ?>" class="form-control input_border txt_cent" readonly>
											<h6 class="name_center"><i>Middlename</i></h6>
										</div>
										<div class="col-md-3 col-sm-3 col-xs-3">
											<input type="text" name="" value="<?php echo $oi['lastname'] ?>" class="form-control input_border txt_cent" readonly>
											<h6 class="name_center"><i>Lastname</i></h6>
										</div>
									</div>

									<div class="col-md-12 col-sm-12 col-xs-12 space">
										<div class="col-md-4 col-sm-4 col-xs-4"><label>Owner Information:</label></div>
										<div class="col-md-4">
											<input type="checkbox" disabled <?php if ($oi['vital_status'] == 'Alive') { echo 'checked';}?>>
											<label> Alive</label>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-4">
											<input type="checkbox" disabled <?php if ($oi['vital_status'] == 'Deceased') { echo 'checked';}?>>
											<label> Deceased</label>
										</div>
									</div>

									<div class="col-md-12 space">
										<div class="col-md-3"><label>Lot Location:</div>
										<div class="col-md-3 col-sm-3 col-xs-3">
											<input type="text" name="" value="<?php echo $ll['street']; ?>" class="form-control input_border txt_cent" readonly>
											<h6 class="name_center"><i>Street</i></h6>
										</div>
										<div class="col-md-3 col-sm-3 col-xs-3">
											<input type="text" name="" value="<?php echo $ll['baranggay'] ?>" class="form-control input_border txt_cent" readonly>
											<h6 class="name_center"><i>Baranggay</i></h6>
										</div>
										<div class="col-md-3 col-sm-3 col-xs-3">
											<input type="text" name="" value="<?php echo $ll['municipality'] ?>" class="form-control input_border txt_cent" readonly>
											<h6 class="name_center"><i>Municipality</i></h6>
										</div>

										<div class="col-md-3 col-sm-3 col-xs-3"></div>
										<div class="col-md-3 col-sm-3 col-xs-3">
											<input type="text" name="" value="<?php echo $ll['province'] ?>" class="form-control input_border txt_cent" readonly>
											<h6 class="name_center"><i>Province</i></h6>
										</div>
										<div class="col-md-3 col-sm-3 col-xs-3">
											<input type="text" name="" value="<?php echo $ll['region'] ?>" class="form-control input_border txt_cent" readonly>
											<h6 class="name_center"><i>Region</i></h6>
										</div>
										<div class="col-md-3 col-sm-3 col-xs-3">
											<input type="text" name="" value="<?php echo $ll['zip_code'] ?>" class="form-control input_border txt_cent" readonly>
											<h6 class="name_center"><i>Zip Code</i></h6>
										</div>
									</div>

									<div class="col-md-12 col-sm-12 col-xs-12 space">
										<div class="col-md-4 col-sm-4 col-xs-4"><label>Lot Sold:</label></div>
										<div class="col-md-4 col-sm-4 col-xs-4">
											<input type="checkbox" disabled <?php if($li['lot_sold'] == 'Portion'){ echo 'checked';}?>>
											<label> Portion</label>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-4">
											<input type="checkbox" disabled <?php if($li['lot_sold'] == 'Whole'){ echo 'checked';}?>>
											<label> Whole</label>
										</div>
									</div>

									<div class="col-md-12 col-sm-12 col-xs-12 space">
										<div class="col-md-4 col-sm-4 col-xs-4"><label>Purchase Type:</label></div>
										<div class="col-md-4 col-sm-4 col-xs-4">
											<input type="checkbox" disabled <?php if($li['purchase_type'] == 'package'){ echo 'checked';}?>>
											<label> package</label>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-4">
											<input type="checkbox" disabled <?php if($li['purchase_type'] == 'per/sq.m.'){ echo 'checked';}?>>
											<label> per sq.m</label>
										</div>
									</div>

									<div class="col-md-12 space">
										<div class="col-md-3 col-sm-3 col-xs-3"></div>
										<div class="col-md-4 form-inline">
											<label>Lot Size:</label> 
											<input type="text" value="<?php echo number_format($li['lot_size'], 2) ?>" class="form-control input_border" readonly><label>sq.m</label>
										</div>
										<div class="col-md-5 form-inline">
											<label>Selling Price per sq.m: ₱</label>
											<input type="text" value="<?php echo number_format($li['price_per_sqm'], 2) ?>" class="form-control input_border" readonly>
										</div>
									</div>

									<div class="col-md-12 space">
										<div class="col-md-12 col-sm-12 col-xs-12"><label>Total Selling Price:</label></div>
										<div class="col-md-2 col-sm-2 col-xs-2"></div>
										<div class="col-md-9 col-sm-9 col-xs-9 form-inline">
											<label>Amount In Figures: ₱</label>
											<input type="text" value="<?php echo number_format($li['total_price'], 2) ?>" class="form-control input_border" readonly>
										</div>
										<div class="col-md-2 col-sm-2 col-xs-2"></div>
										<div class="col-md-9 col-sm-9 col-xs-9 form-inline">
											<?php $this->load->helper('custom'); ?>
											<label>Amount In Words:</label> 
											<span style="color:#ff6600;text-decoration: underline"><?php echo number_to_words($li['total_price']); ?> Pesos</span>
										</div>
									</div>

									<div class="col-md-12 space">
										<label>Restriction/s to Land Title:</label>
									</div>
									<div class="col-md-12">
										<div class="col-md-3 col-sm-3 col-xs-3 restrict">
											<label>Liens</label>
										</div>
										<div class="col-md-9 col-sm-9 col-xs-9 restrict">
											<textarea class="form-control" readonly><?php echo isset($rstr) && isset($rstr['liens']) ? $rstr['liens'] : ''; ?></textarea>
										</div>

										<div class="col-md-3 col-sm-3 col-xs-3 restrict">
											<label>Easement</label>
										</div>
										<div class="col-md-9 col-sm-9 col-xs-9 restrict">
											<textarea class="form-control" readonly><?php echo isset($rstr) && isset($rstr['easement']) ? $rstr['easement'] : ''; ?></textarea>
										</div>

										<div class="col-md-3 col-sm-3 col-xs-3 restrict">
											<label>Encumbrances</label>
										</div>
										<div class="col-md-9 col-sm-9 col-xs-9 restrict">
											<textarea class="form-control" readonly><?php echo isset($rstr) && isset($rstr['encumbrances']) ? $rstr['encumbrances'] : ''; ?></textarea>
										</div>
									</div>


									<div class="col-md-12 space">
										<div class="col-md-12"><label>Available Proof of Title/Ownership:</label></div>
										<div class="col-md-3"></div>
										<div class="col-md-3">
											<input type="checkbox" disabled <?php if(!empty($ud['land_title'])){ echo 'checked';}?>>
											<label>Land Title</label>
										</div>
										<div class="col-md-3">
											<input type="checkbox" disabled <?php if(!empty($ud['latest_tax_dec'])){ echo 'checked';}?>>
											<label>Tax Declaration</label>
										</div>

										<div class="col-md-3">
											<div class="panel panel-default" style="width: 200px; border: 2px solid #b3cccc;">
												<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
													<div class="panel-heading" role="tab" id="headingTwo">
														<center><h4 class="panel-title">View Documents</h4></center>
													</div>
												</a>
												<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
													<div class="panel-body">
														<center>
															<?php if (!empty($ud['latest_tax_dec'])) { ?>
																<button class="btn btn-success" data-toggle="modal" data-target=".latest_tax_dec_<?php echo $li['is_no']; ?>" data-backdrop="static" data-keyboard="false">Latest Tax Declaration</button>
															<?php } else {
																echo "";
															} ?>
															<?php if (!empty($ud['land_title'])) { ?>
																<button class="btn btn-success" data-toggle="modal" data-target=".land_title_<?php echo $li['is_no']; ?>" data-backdrop="static" data-keyboard="false">Land Title</button>
															<?php } else {
																echo "";
															} ?>
															<?php if (!empty($ud['brgy_resolution'])) { ?>
																<button class="btn btn-success" data-toggle="modal" data-target=".brgy_res_<?php echo $li['is_no']; ?>" data-backdrop="static" data-keyboard="false">Barangay Resolution</button>
															<?php } else {
																echo "";
															} ?>
															<?php if (!empty($ud['land_sketch'])) { ?>
																<button class="btn btn-success" data-toggle="modal" data-target=".land_sketch_<?php echo $li['is_no']; ?>" data-backdrop="static" data-keyboard="false">Land Sketch</button>
															<?php } else {
																echo "";
															} ?>
														</center>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-12 space" style="border-top: 1px solid #ff6600; border-bottom: 1px solid #ff6600; padding-bottom: 10px;padding-top: 10px;margin-bottom:10px">
										<div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center;font-weight:bold;letter-spacing:5px">MAIN CONTACT PERSON</div>
									</div>

									<div class="col-md-6 col-sm-6 col-xs-6 form-inline">
										<label class="col-md-4 col-sm-4 col-xs-4">Name:</label>
										<input type="text" value="<?php echo $cp['name'] ?>" class="form-control input_border" readonly>
									</div>

									<div class="col-md-6 col-sm-6 col-xs-6 form-inline">
										<label class="col-md-4 col-sm-4 col-xs-4">Address:</label>
										<input type="text" value="<?php echo $cp['address'] ?>" class="form-control input_border" readonly>
									</div>

									<div class="col-md-6 col-sm-6 col-xs-6 form-inline">
										<label class="col-md-4 col-sm-4 col-xs-4">Telephone No:</label>
										<input type="text" value="<?php echo $cp['tel_no'] ?>" class="form-control input_border" readonly>
									</div>

									<div class="col-md-6 col-sm-6 col-xs-6 form-inline">
										<label class="col-md-4 col-sm-4 col-xs-4">Phone No:</label>
										<input type="text" value="<?php echo $cp['phone_no'] ?>" class="form-control input_border" readonly>
									</div>

									<div class="col-md-6 col-sm-6 col-xs-6 form-inline">
										<label class="col-md-4 col-sm-4 col-xs-4">Email Address:</label>
										<input type="text" value="<?php echo $cp['email_ad'] ?>" class="form-control input_border" readonly>
									</div>

								</div>
							</div>
						</div>
						<!--====================END INTERVIEW SHEET====================-->

						<!--====================DOCUMENT REQUIREMENTS====================-->
						<div class="tab-pane" id="2b">
							<div class="x_panel animate slideInDown" style="border-radius:10px">
								<div class="tabbable tabs-left">
									<ul class="nav nav-tabs">
										<li><a type="a" href="#LT" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">Land Title</a></li>
										<li><a type="a" href="#TCT" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">TCT</a></li>
										<li><a type="a" href="#DOS" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">Previous Deed of Sale </a></li>
										<li><a type="a" href="#eCAR" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">e-CAR </a></li>
										<li><a type="a" href="#TD" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">Tax Declaration </a></li>
										<li><a type="a" href="#TC" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white"> Tax Clearance</a></li>
										<li><a type="a" href="#LS" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">Sketch Plan </a></li>
										<li><a type="a" href="#VM" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">Vicinity Map </a></li>
										<li><a type="a" href="#CNI" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white"> Certification of No Improvement </a></li>
										<li><a type="a" href="#RET" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white"> Real Estate Property Taxes Receipt</a></li>
										<li><a type="a" href="#MC" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">Marriage Contract (if married)</a></li>
										<li><a type="a" href="#BC" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white"> Birth Certificate  </a></li>
										<li><a type="a" href="#VI" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white"> Valid ID </a></li>
										<li><a type="a" href="#SP" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">Subdivision Plan </a></li>
										<li><a type="a" href="#SPA" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">SPA of Lot Owner to Lot Owner </a></li>
										<li><a type="a" href="#DENR" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white"> DENR/DAR </a></li>
										<li><a href="#OTHERS" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white"> Others</a></li>
									</ul>

									<div class="tab-content">
										<!--====================LAND TITLE====================-->
										<div class="tab-pane active" id="LT">
											<div style="overflow-x:auto;">
												<center>
													<?php if(!empty($ud['land_title'])){ ?>
														<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Land Title</b></h4>
														<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Land Title/'.$ud['land_title'].'') ?>" class="responsive" width="100%" height="760px">   
													<?php }else{ ?>
														<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Land Title</b></h4>
														<div class="container-no-up">
															<center style="padding-top: 70px">
																<img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px">
															</center>  
														</div>
													<?php } ?>
												</center>
											</div>
										</div>
										<!--====================END LAND TITLE====================-->

										<!--====================TCT====================-->
										<div class="tab-pane" id="TCT">
											<div style="overflow-x:auto;">
												<center>
													<?php if(!empty($ud['tct'])){ ?>
														<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Transfer Certificate of Title</b></h4>
														<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/TCT/'.$ud['tct'].'') ?>" class="responsive" width="100%" height="760px" >   
													<?php }else{ ?>
														<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Transfer Certificate of Title</b></h4>
														<div class="container-no-up">
															<center style="padding-top: 70px">
																<img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px">
															</center>  
														</div>
													<?php } ?>
												</center>
											</div>
										</div>
										<!--====================END TCT====================-->

										<!--====================DEED OF SALE====================-->
										<div class="tab-pane" id="DOS">
											<div style="overflow-x:auto;">
												<center>
													<?php if(!empty($ud['previous_deed_of_sale'])){ ?>
														<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Previous Deed of Sale </b></h4>
														<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Previous Deed Of Sale/'.$ud['previous_deed_of_sale'].'') ?>" class="responsive" width="100%" height="760px">   
													<?php }else{  ?>
														<div class="container-no-up">
															<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b> Previous Deed of Sale </b></h4>
															<center style="padding-top: 70px">
																<img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px">
															</center> 
														</div>
													<?php } ?>
												</center>
											</div>
										</div>
										<!--====================END DEED OF SALE====================-->

										<!--====================ECAR====================-->
										<div class="tab-pane" id="eCAR">
											<div style="overflow-x:auto;">
												<center>
													<?php if(!empty($ud['e_car'])){ ?>
														<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b> Electronic Certificate Authorizing Registration</b></h4>
														<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/eCAR/'.$ud['e_car'].'') ?>" class="responsive" width="100%" height="760px">   
													<?php }else{  ?>
														<div class="container-no-up">
															<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Electronic Certificate Authorizing Registration</b></h4>
															<center style="padding-top: 70px">
																<img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px">
															</center> 
														</div>
													<?php } ?>
												</center>
											</div>
										</div>
										<!--====================END ECAR====================-->

										<!--====================TAX DECLARATION====================-->
										<div class="tab-pane" id="TD">
											<div style="overflow-x:auto;">
												<center>
													<?php if(!empty($ud['latest_tax_dec'])){ ?>
														<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b> Tax Declaration</b></h4>
														<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Tax Declaration/'.$ud['latest_tax_dec'].'') ?> " class="responsive" width="100%" height="760px">   
													<?php }else{ ?>
														<div class="container-no-up">
															<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Tax Declaration </b></h4>
															<center style="padding-top: 70px">
																<img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px">
															</center> 
														</div>
													<?php } ?>
												</center>
											</div>
										</div>
										<!--====================END TAX DECLARATION====================-->

										<!--====================TAX CLEARANCE====================-->
										<div class="tab-pane" id="TC">
											<div style="overflow-x:auto;">
												<center>
													<?php if(!empty($ud['tax_clearance'])){ ?>
														<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Tax Clearance </b></h4>
														<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Tax Clearance/'.$ud['tax_clearance'].'') ?>" class="responsive" width="100%" height="760px">   
													<?php }else{  ?>
														<div class="container-no-up">
															<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Tax Clearance </b></h4>
															<center style="padding-top: 70px">
																<img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px">
															</center> 
														</div>
													<?php } ?>
												</center>
											</div>
										</div>
										<!--====================END TAX CLEARANCE====================-->

										<!--====================SKETCH PLAN====================-->
										<div class="tab-pane" id="LS">
											<div style="overflow-x:auto;">
												<center>
													<?php if(!empty($ud['land_sketch'])){ ?>
														<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b> Sketch Plan</b></h4>
														<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Land Sketch/'.$ud['land_sketch'].'') ?> " class="responsive"  width="100%" height="760px">  
													<?php }else{ ?>
														<div class="container-no-up">
															<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b> Sketch Plan</b></h4>
															<center style="padding-top: 70px">
																<img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px">
															</center> 
														</div>
													<?php } ?> 
												</center>
											</div>
										</div> 
										<!--====================END SKETCH PLAN====================-->

										<!--====================VICINITY MAP====================-->
										<div class="tab-pane" id="VM">
											<div style="overflow-x:auto;">
												<center>
													<?php if(!empty($ud['vicinity_map'])){ ?>
														<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b> Vicinity Map</b></h4>
														<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Vicinity Map/'.$ud['vicinity_map'].'') ?> " class="responsive"  width="100%" height="760px">  
													<?php }else{ ?>
														<div class="container-no-up">
															<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Vicinity Map</b></h4>
															<center style="padding-top: 70px">
																<img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px">
															</center> 
														</div>
													<?php } ?> 
												</center>
											</div>
										</div>
										<!--====================END VICINITY MAP====================--> 

										<!--====================CERTIFICATE OF NO IMPROVEMENT====================--> 
										<div class="tab-pane" id="CNI">
											<div style="overflow-x:auto;">
												<center>
													<?php if(!empty($ud['cert_no_improvement'])){ ?>
														<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Certification of No Improvement  </b></h4>
														<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Certificate of No Improvement/'.$ud['cert_no_improvement'].'') ?>" class="responsive" width="100%" height="760px">   
													<?php }else{  ?>
														<div class="container-no-up">
															<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Certification of No Improvement  </b></h4>
															<center style="padding-top: 70px">
																<img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px">
															</center> 
														</div>
													<?php } ?>
												</center>
											</div>
										</div>
										<!--====================END CERTIFICATE OF NO IMPROVEMENT====================--> 

										<!--====================REAL ESTATE TAX====================--> 
										<div class="tab-pane" id="RET">
											<div style="overflow-x:auto;">
												<center>
													<?php if(!empty($ud['real_estate_tax'])){ ?>
														<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b> Real Estate Property Taxes Receipt</b></h4>
														<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Real Estate Tax/'.$ud['real_estate_tax'].'') ?>" class="responsive" width="100%" height="760px">   
													<?php }else{  ?>
														<div class="container-no-up">
															<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Real Estate Property Taxes Receipt </b></h4>
															<center style="padding-top: 70px">
																<img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px">
															</center> 
														</div>
													<?php } ?>
												</center>
											</div>
										</div>
										<!--====================END REAL ESTATE TAX====================-->

										<!--====================MARRIAGE CONTRACT====================-->
										<div class="tab-pane" id="MC">
											<div style="overflow-x:auto;">
												<center>
													<?php if(!empty($ud['marriage_contract'])){ ?>
														<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Marriage Contract (if married) </b></h4>
														<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Marriage Contract/'.$ud['marriage_contract'].'') ?>" class="responsive" width="100%" height="760px">   
													<?php }else{  ?>
														<div class="container-no-up">
															<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Marriage Contract (if married) </b></h4>
															<center style="padding-top: 70px">
																<img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px">
															</center> 
														</div>
													<?php } ?>
												</center>
											</div>
										</div>
										<!--====================END MARRIAGE CONTRACT====================-->

										<!--====================BIRTH CERTIFICATE====================-->
										<div class="tab-pane" id="BC">
											<div style="overflow-x:auto;">
												<center>
													<?php if(!empty($ud['birth_certificate'])){ ?>
														<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b> Birth Certificate  </b></h4>
														<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Birth Certificate/'.$ud['birth_certificate'].'') ?>" class="responsive" width="100%" height="760px">   
													<?php }else{  ?>
														<div class="container-no-up">
															<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b> Birth Certificate  </b></h4>
															<center style="padding-top: 70px">
																<img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px">
															</center> 
														</div>
													<?php } ?>
												</center>
											</div>
										</div>
										<!--====================END BIRTH CERTIFICATE====================-->

										<!--====================VALID ID====================-->
										<div class="tab-pane" id="VI">
											<div style="overflow-x:auto;">
												<center>
													<?php if(!empty($ud['valid_id'])){ ?>
														<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Valid ID </b></h4>
														<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Valid ID/'.$ud['valid_id'].'') ?>" class="responsive" width="100%" height="760px">   
													<?php }else{  ?>
														<div class="container-no-up">
															<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Valid ID </b></h4>
															<center style="padding-top: 70px">
																<img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px">
															</center> 
														</div>
													<?php } ?>
												</center>
											</div>
										</div>
										<!--====================END VALID ID====================-->

										<!--====================SUBDIVISION PLAN====================-->
										<div class="tab-pane" id="SP">
											<div style="overflow-x:auto;">
												<center>
													<?php if(!empty($ud['subdivision_plan'])){ ?>
														<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Subdivision Plan  </b></h4>
														<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Subdivision Plan/'.$ud['subdivision_plan'].'') ?>" class="responsive" width="100%" height="760px">   
													<?php }else{  ?>
														<div class="container-no-up">
															<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Subdivision Plan  </b></h4>
															<center style="padding-top: 70px">
																<img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px">
															</center> 
														</div>
													<?php } ?>
												</center>
											</div>
										</div>
										<!--====================END SUBDIVISION PLAN====================-->

										<!--====================SPA====================-->
										<div class="tab-pane" id="SPA">
											<div style="overflow-x:auto;">
												<center>
													<?php if(!empty($ud['spa'])){ ?>
														<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b> Special Power of Attorney of Lot Owner to Lot Owner</b></h4>
														<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/SPA/'.$ud['spa'].'') ?>" class="responsive" width="100%" height="760px">   
													<?php }else{  ?>
														<div class="container-no-up">
															<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Special Power of Attorney of Lot Owner to Lot Owner </b></h4>
															<center style="padding-top: 70px">
																<img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px">
															</center> 
														</div>
													<?php } ?>
												</center>
											</div>
										</div>
										<!--====================END SPA====================-->

										<!--====================DENR/DAR====================-->
										<div class="tab-pane" id="DENR">
											<div style="overflow-x:auto;">
												<center>
													<?php if(!empty($ud['denr_dar'])){ ?>
														<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Supporting Documents from DENR/DAR</b></h4>
														<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/DENR or DAR/'.$ud['denr_dar'].'') ?>" class="responsive" width="100%" height="760px">   
													<?php }else{  ?>
														<div class="container-no-up">
															<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b>Supporting Documents from DENR/DAR </b></h4>
															<center style="padding-top: 70px">
																<img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px">
															</center> 
														</div>
													<?php } ?>
												</center>
											</div>
										</div>
										<!--====================END DENR/DAR====================--> 

										<!--====================OTHER====================-->
										<div class="tab-pane" id="OTHERS">
											<div style="overflow-x:auto;overflow-y:scroll;max-height:800px">
												<center>
													<?php if (!empty($ud['other'])) { ?>
														<h4 style="font-family: verdana; text-align: center; font-size: 20px; color: #2a3f54; padding-top: 5px;"><b><u>OTHER</u></b></h4>

														<?php
															$fileNames = explode(',', $ud['other']);
															foreach ($fileNames as $fileName) {
																// Extract the actual file name and its extension
																list($actualFileName, $fileExtension) = explode('.', trim($fileName));

																$filePath = base_url('assets/img/uploaded_documents/' . $ud['is_no'] . '/OTHER/' . trim($fileName));

																// Display the image
																echo '<img src="' . $filePath . '" class="responsive" width="100%" height="auto" >';

																// Display the new filename
																echo '<h4 id="new_filename">' . $actualFileName . '</h4>';
															}
														?>
													<?php } else { ?>
														<h4 style="font-family: verdana; text-align: center; font-size: 20px; color: #2a3f54; padding-top: 5px;"><b><u>OTHER</u></b></h4>
														<div class="container-no-up">
															<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center>
														</div>
													<?php } ?>
												</center>
											</div>
										</div>
										<!--====================END OTHER====================--> 
									</div>       
								</div>
							</div>
						</div>
						<!--====================END DOCUMENT REQUIREMENTS====================--> 
					</div>
				</div>
			</div>
			<!--====================END BODY====================-->
		</div>
	</div>
</div>
<!--====================END PAGE====================-->

<!--====================LAND MODAL TITLE====================-->
<div class="modal animate bounceInUp land_title_<?php echo $li['is_no']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #00c851; color: white;">
				<button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-text-o"></span> Land Title (Photocopy)</h4>
			</div>
			<div class="modal-body">
				<center>
					<div style="overflow-x:auto;">
						<img src="<?= base_url('assets/img/uploaded_documents/' . $ud['is_no'] . '/Land Title/' . $ud['land_title'] . '') ?> " class="img-responsive">
					</div>
				</center>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" style="color: #00c851; border: 1px solid;">Close</button>
			</div>
		</div>
	</div>
</div>
<!--====================TAX DECLARATION====================-->
<div class="modal animate bounceInUp latest_tax_dec_<?php echo $li['is_no']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #00c851; color: white;">
				<button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-text-o"></span> Latest Tax Declaration (Photocopy)</h4>
			</div>
			<div class="modal-body">
				<center>
					<div style="overflow-x:auto;">
						<?php if (!empty($ud['latest_tax_dec'])) { ?>
							<img src="<?= base_url('assets/img/uploaded_documents/' . $ud['is_no'] . '/Tax Declaration/' . $ud['latest_tax_dec'] . '') ?> " class="img-responsive">
						<?php } ?>
					</div>
				</center>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" style="color: #00c851; border: 1px solid;">Close</button>
			</div>
		</div>
	</div>
</div>
<!--====================LAND SKETCH====================-->
<div class="modal animate bounceInUp land_sketch_<?php echo $li['is_no']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #00c851; color: white;">
				<button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-text-o"></span> Land Sketch</h4>
			</div>
			<div class="modal-body">
				<center>
					<div style="overflow-x:auto;">
						<img src="<?= base_url('assets/img/uploaded_documents/' . $ud['is_no'] . '/Land Sketch/' . $ud['land_sketch'] . '') ?> " class="img-responsive">
					</div>
				</center>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" style="color: #00c851; border: 1px solid;">Close</button>
			</div>
		</div>
	</div>
</div>
<!--====================REVIEW MODAL====================-->
<div class="modal fade review_<?php echo $li['is_no'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" style="margin-top: 100px;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background:#6b8e23;">
				<button type="button" class="close" id="dclose" data-dismiss="modal" aria-hidden="true"><span style="color:white;">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-check-square-o" style="color:white;"></i> <span style="color:#E7E7E7;">Review</span></h4>
			</div>
			<div class="modal-body" style="overflow-y: auto;">
				<center><h6><span style="font-family:verdana; font-size:15px">Are you sure, these documents are complete?</span></h6></center>
			</div>
			<div class="modal-footer">
				<button style="background-color: #6b8e23;border:#6b8e23" type="submit" class="btn  btn-info review" id="<?php echo $li['is_no'] ?>">Yes</button>
				<button style="background-color: maroon;border:maroon" type="button" class="btn btn-warning" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>
<!--====================RETURN MODAL====================-->
<div class="modal fade return_<?php echo $li['is_no'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" style="margin-top: 100px;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background:#6b8e23;">
				<button type="button" class="close" id="dclose" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope" style="color:white;"></i> <span style="color:#E7E7E7;">Write a message</span></h4>
			</div>
			<div class="modal-body">
				<textarea class="form-control incomplete_message" name="incomplete_message" id="incomplete_message"></textarea>
			</div>
			<div class="modal-footer">
				<button style="background-color: #6b8e23;border:#6b8e23" type="submit" class="btn  btn-danger return" id="<?php echo $li['is_no'] ?>">Send</button>
				<button style="background-color: maroon;border:maroon" type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!--====================DISAPPROVAL MODAL====================-->
<div class="modal fade disapprove_<?php echo $li['is_no'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" style="margin-top: 100px;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background:#6b8e23;">
				<button type="button" class="close" id="dclose" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope" style="color:white;"></i> <span style="color:#E7E7E7;">Write a message</span></h4>
			</div>
			<div class="modal-body">
				<textarea class="form-control disapproved_message" name="disapproved_message" id="disapproved_message"></textarea>
			</div>
			<div class="modal-footer">
				<button style="background-color: #6b8e23;border:#6b8e23" type="submit" class="btn  btn-danger disapprove" id="<?php echo $li['is_no'] ?>">Send</button>
				<button style="background-color: maroon;border:maroon" type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!--====================APPROVE MODAL====================-->
<div class="modal fade approve_<?php echo $li['is_no'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" style="margin-top: 100px;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background:#6b8e23;">
				<button type="button" class="close" id="dclose" data-dismiss="modal" aria-hidden="true"><span style="color:white;">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-check-square-o" style="color:white;"></i> <span style="color:#E7E7E7;">Approve</span></h4>
			</div>
			<div class="modal-body" style="overflow-y: auto;">
				<center><h6><span style="font-family:verdana; font-size:15px">Are you sure you want to approve these documents?</span></h6></center>
			</div>
			<div class="modal-footer">
				<button style="background-color: #6b8e23;border:#6b8e23" type="submit" class="btn  btn-info approve" id="<?php echo $li['is_no'] ?>">Yes</button>
				<button style="background-color: maroon;border:maroon" type="button" class="btn btn-warning" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>
<!--====================END MODAL====================-->


<script>
	$(document).ready(function() {
	    // Function to adjust the height of .right_col based on active tab content
	    function adjustRightColHeight() {
	        var activeTabContentHeight = $('.tab-content .tab-pane.active').outerHeight();
	        $('.right_col').css('min-height', activeTabContentHeight + 'px');
	    }

	    // Call adjustRightColHeight initially
	    adjustRightColHeight();

	    // Adjust height when a tab is shown (Bootstrap event)
	    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	        adjustRightColHeight();
	    });
	});
</script>
<script>
	// When the user scrolls down 20px from the top of the document, show the button
	window.onscroll = function () { scrollFunction() };
	function scrollFunction() {
		if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
			document.getElementById("mvTop").style.display = "block";
		} else {
			document.getElementById("mvTop").style.display = "none";
		}
	}

	// When the user clicks on the button, scroll to the top of the document
	function topFunction() {
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
	}
</script>
<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function (event) {
		//REVIEW JQUERY
		$(".review").click(function () {
			var id = $(this).attr("id");
			$.ajax({
				url: "<?php echo base_url('Acquisition/submit_reviewed_documents/"+id+"') ?>",
				type: "post",
				data: { '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>' },
				success: function () {
					// alert("The Request has been Approved");
					window.location.replace("<?php echo base_url('Acquisition/pop_up_reviewed/"+id+"') ?>");
				}
			});
		});
		//APPROVE JQUERY
		$(".approve").click(function () {
			var id = $(this).attr("id");
			$.ajax({
				url: "<?php echo base_url('Acquisition/submit_approved_documents/"+id+"') ?>",
				type: "post",
				data: { '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>' },
				success: function () {
					// alert("The Request has been Approved");
					window.location.replace("<?php echo base_url('Acquisition/pop_up_approved') ?>/" + id + "");
				}
			});
		});
		//RETURN JQUERY 
		$(".return").click(function () {
			var id 		= $(this).attr("id");
			var reason 	= $("#incomplete_message").val(); // Get the reason from the textarea
			$.ajax({
				url: "<?php echo base_url('Acquisition/submit_returned_documents/"+id+"') ?>",
				type: "post",
				data: {
					'is_no': id,
					'incomplete_message': reason, // Send the reason to the server
					'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function (data) {
					window.location.replace("<?php echo base_url('Acquisition/pop_up_returned') ?>/" + id + "");
				}
			});
		});
		//DISAPPROVE JQUERY 
		$(".disapprove").click(function () {
			var id = $(this).attr("id");
			var reason = $("#disapproved_message").val(); // Get the reason from the textarea
			$.ajax({
				url: "<?php echo base_url('Acquisition/submit_disapproved_documents/"+id+"') ?>",
				type: "post",
				data: {
					'is_no': id,
					'disapproved_message': reason, // Send the reason to the server
					'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
				},
				success: function (data) {
					window.location.replace("<?php echo base_url('Acquisition/pop_up_disapproved') ?>/" + id + "");
				}
			});
		});
		//END JQUERY
	});
	const view_zoom_img = (path) =>{
		let item = [{
			src: path,
			title: 'Other uploaded files'
		}];
		let options = {
			index: 0
		};
		let photoviewer = new PhotoViewer(item, options);
	}
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
	.nav-pills > li > a {
        background: linear-gradient(to top, #09203f 0%, #537895 100%);
        color: #fff;
        letter-spacing: 2px;
        padding: 10px 20px;
        width: 100%;
        text-align: center;
    }
    @media (min-width: 576px) {
        .nav-pills > li > a {
            padding-left: 170px;
            padding-right: 160px;
            width: auto;
        }
    }
    .first_panel{
		border: 4px solid #f2f2f2; border-style: outset; background-color: #f2f2f2; margin-bottom: 30px;padding-top:10px
	}
	.restrict{
		border: 1px solid #cccccc
	}
</style>