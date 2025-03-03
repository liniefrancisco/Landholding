<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container"> 
		<button onclick="topFunction()" id="mvTop" title="Go to top"><i class="fa fa-arrow-up"></i>Top</button>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!--====================START CONTENT====================-->
			<div class="x_panel animate zoomIn" style="box-shadow: 5px 8px 16px #888888">
				<div class="x_title">
                    <h2 class="fa fa-bank" style="font-size:15px;"> <b>Settlement</b></h2>
                    <div style="float:right;color: #2a3f54;">
                        <a href="#" onclick="goBack()" class="btn btn-sm btn-warning"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
                    </div>
                    <div class="clearfix"></div>
                </div>


				<div class="x_panel" style="border-radius:10px;">
					<center class="space">
                        <img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
                        <h4><b>LAND AS PAYMENT FORM - EXTRAJUDICIAL SETTLEMENT (LAPF-ES)</b></h4>
                    </center>

					<div class="col-md-12 col-sm-12 col-xs-12 space">
                        <div class="col-md-4 col-xs-4 col-sm-4 form-inline">
                            <label>LAPF-ES #:</label>
                            <input class="form-control input_border" type="text" value="<?php echo $li['is_no'] ?>" readonly>
                        </div>
                        <div class="col-md-4 col-sm-4  col-xs-4 form-inline pull-right">
                        	<?php $date_acq = date_create($li['date_acquired']); ?> 
                            <label>Date:</label>
                            <input class="form-control input_border" type="text" value="<?php echo date_format($date_acq,"F d, Y"); ?>" readonly>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 space" style="border-top:1px solid #ff6600; border-bottom:1px solid #ff6600;">
                        <center><h5 style="letter-spacing: 10px;"><b>LAND INFORMATION</b></h5></center>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 space">
                        <div class="col-md-4 col-xs-4 col-sm-4 form-inline">
                            <label>Lot :</label>
                            <input type="text" name="" value="<?php echo $li['lot'] ?>" class="form-control input_border " readonly>
                        </div>
                        <div class="col-md-4 col-sm-4  col-xs-4 form-inline pull-right">
                            <label>Cad :</label>
                            <input type="text" name="" value="<?php echo $li['cad'] ?>" class="form-control input_border" readonly>
                        </div>
                    </div>

					<div class="col-md-12 col-sm-12 col-xs-12 space">
						<div class="col-md-3 col-sm-3 col-xs-3 lot_type" style="height: 29px;"><label>Lot Type:</label></div>
						<div class="col-md-3 col-sm-3 col-xs-3 lot_type">
							<input type="checkbox" name="lot_type" value="" <?php if($li['lot_type'] == 'Agricultural'){ echo "checked";} ?> disabled>
							<label> Agricultural</label>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3 lot_type">
							<input type="checkbox" name="lot_type" value="" <?php if($li['lot_type'] == 'Commercial'){ echo "checked";} ?> disabled>
							<label> Commercial</label>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3 lot_type">
							<input type="checkbox" name="lot_type" value="" <?php if($li['lot_type'] == 'Residential'){ echo "checked";} ?> disabled>
							<label> Residential</label>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 space"> 
						<div class="col-md-3 col-sm-3 col-xs-3"><label>Lot Owner:</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control input_border txt_cent" type="text" value="<?php echo $oi['firstname'] ?>" readonly>
							<h6 class="txt_cent"><i>Firstname</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control input_border txt_cent" type="text" value="<?php echo $oi['middlename'] ?>" readonly>
							<h6 class="txt_cent"><i>Middlename</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control input_border txt_cent" type="text" value="<?php echo $oi['lastname'] ?>" readonly>
							<h6 class="txt_cent"><i>Lastname</i></h6>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 space">
						<div class="col-md-4 col-sm-4 col-xs-4"><label>Gender:</label></div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<input type="checkbox" <?php if($oi['gender'] == 'Male'){ echo "checked"; } ?> disabled>
							<label> Male</label>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<input type="checkbox" <?php if($oi['gender'] == 'Female'){ echo "checked"; } ?> disabled>
							<label> Female</label>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 space">
						<div class="col-md-4 col-sm-4 col-xs-4"><label>Vital Status:</label></div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<input type="checkbox" <?php if($oi['vital_status'] == 'Alive'){ echo "checked"; } ?> disabled>
							<label> Alive</label>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<input type="checkbox" <?php if($oi['vital_status'] == 'Deceased'){ echo "checked"; } ?> disabled>
							<label> Deceased</label>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 space"> 
						<div class="col-md-3 col-sm-3 col-xs-3"><label>Lot Location:</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control input_border txt_cent" type="text" value="<?php echo $ll['street'] ?>" readonly>
							<h6 class="txt_cent"><i>Street</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control input_border txt_cent" type="text" value="<?php echo $ll['baranggay'] ?>" readonly>
							<h6 class="txt_cent"><i>Baranggay</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control input_border txt_cent" type="text" value="<?php echo $ll['municipality'] ?>" readonly>
							<h6 class="txt_cent"><i>Municipality</i></h6>
						</div>

						<div class="col-md-3 col-sm-3 col-xs-3"><label></div>

						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control input_border txt_cent" type="text" value="<?php echo $ll['province'] ?>" readonly>
							<h6 class="txt_cent"><i>Province</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control input_border txt_cent" type="text" value="<?php echo $ll['country'] ?>" readonly>
							<h6 class="txt_cent"><i>Country</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control input_border txt_cent" type="text" value="<?php echo $ll['zip_code'] ?>" readonly>
							<h6 class="txt_cent"><i>Zipcode</i></h6>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 space">
						<div class="col-md-4 col-sm-4 col-xs-4"><label>Lot for payment:</label></div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<input type="checkbox" <?php if($li['lot_sold'] == "Portion"){ echo "checked"; } ?> disabled>
							<label> Portion</label>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<input type="checkbox" <?php if($li['lot_sold'] == "Whole"){ echo "checked"; } ?> disabled>
							<label> Whole</label>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 space">
                        <div class="col-md-3 col-sm-3 col-xs-3 form-inline"><label>Lot Size:</label></div>
                        <div class="col-md-4 col-sm-4 col-xs-4 form-inline">
                            <input class="form-control input_border" type="text" value="<?php echo number_format($li['lot_size'],2) ?>" readonly>
                            <label>sq/m</label>
                        </div>
                    </div>

					<div class="col-md-12 col-sm-12 col-xs-12 space">
						<div class="col-md-4 col-sm-4 col-xs-4">
							<label>Available Proof of Title/Ownership:</label>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<label>
								<input type="checkbox" <?php if(!$ud['oct'] == null){ echo "checked"; } ?> disabled>
								<label> Original Certificate of Title (OCT)</label>
							</label>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<label>
								<input type="checkbox" <?php if(!$ud['tct'] == null){ echo "checked"; } ?> disabled>
								<label> Transfer Certificate of Title (TCT)</label>
							</label>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 space">
						<div class="col-md-4 col-sm-4 col-xs-4"></div>
						<div class="col-md-4 col-sm-4 col-xs-4" id="oct">
							<?php if(!$ud['oct'] == null){  ?>
								<?php
					                $oct_path = base_url('assets/img/uploaded_documents/' . $ud['is_no'] . '/OCT/' . $ud['oct']);
					            ?>
					            <button class='btn btn-info' onclick="viewImage('<?php echo $oct_path; ?>')">View 
					                <span class="glyphicon glyphicon-folder-open"></span>
					            </button>
							<?php } ?>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4"  id="tct">
							<?php if(!$ud['tct'] == null){ ?>
								<?php
					                $tct_path = base_url('assets/img/uploaded_documents/' . $ud['is_no'] . '/TCT/' . $ud['tct']);
					            ?>
					            <button class='btn btn-info' onclick="viewImage('<?php echo $tct_path; ?>')">View 
					                <span class="glyphicon glyphicon-folder-open"></span>
					            </button>
							<?php } ?>
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
										<input class="form-control input_border" type="text" value="<?php echo number_format($ab['mv_latest_tax_dec'],2)  ?>" readonly>
									</td>
								</tr>
								<tr>
									<td>Neighboring Inquiry</td>
									<td class="form-inline">₱ 
										<input class="form-control input_border" type="text" value="<?php echo number_format($ab['neighboring_inq'],2) ?>" readonly>
									</td>
								</tr>
								<tr>
									<td>Assessor</td>
									<td class="form-inline">₱ 
										<input class="form-control input_border" type="text" value="<?php echo number_format($ab['assesor'],2)  ?>" readonly>
									</td>
								</tr>
								<tr>
									<td>Banks</td>
									<td class="form-inline">₱ 
										<input class="form-control input_border" type="text" value="<?php echo number_format($ab['banks'],2) ?>" readonly>
									</td>
								</tr>
								<tr>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>Final Land Value</td>
									<td class="form-inline">₱ 
										<input class="form-control input_border" type="text" value="<?php echo number_format($ab['final_value'],2) ?>" readonly>
									</td>
								</tr>
							</table>
						</center>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 space" style="border-top:1px solid #ff6600; border-bottom:1px solid #ff6600;">
                        <center><h5 style="letter-spacing: 10px;"><b>CUSTOMER BALANCE INFORMATION</b></h5></center>
                    </div>

					<div class="col-md-12 col-sm-12 col-xs-12 space">
						<div class="col-md-4 col-sm-4 col-xs-4"><label>Type:</label></div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<input type="checkbox" <?php if($cbi['balance_type'] == "Bounced Check"){ echo "checked"; } ?> disabled>
							<label>Bounced Check</label>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<input type="checkbox" <?php if($cbi['balance_type'] == "Bad Account"){ echo "checked"; } ?> disabled>
							<label>Bad Account</label>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 space">
						<div class="col-md-3 col-sm-3 col-xs-3"><label>Business Unit:</label></div>
						<div class="col-md-9 col-sm-9 col-xs-9">
							<input class="form-control input_border" type="text" value="<?php echo $cbi['business_unit'] ?>" readonly>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 space"> 
						<div class="col-md-3 col-sm-3 col-xs-3"><label>Customer Name:</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control input_border txt_cent" type="text" value="<?php echo $ci['firstname'] ?>" readonly>
							<h6 class="txt_cent"><i>Firstname</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control input_border txt_cent" type="text" value="<?php echo $ci['middlename'] ?>" readonly>
							<h6 class="txt_cent"><i>Middlename</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control input_border txt_cent" type="text" value="<?php echo $ci['lastname'] ?>" readonly>
							<h6 class="txt_cent"><i>Lastname</i></h6>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 space"> 
						<div class="col-md-3 col-sm-3 col-xs-3"><label>Customer Address:</label></div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control input_border txt_cent" type="text" value="<?php echo $ca['street'] ?>" readonly>
							<h6 class="txt_cent"><i>Street</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control input_border txt_cent" type="text" value="<?php echo $ca['barangay'] ?>" readonly>
							<h6 class="txt_cent"><i>Baranggay</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control input_border txt_cent" type="text" value="<?php echo $ca['town'] ?>" readonly>
							<h6 class="txt_cent"><i>Town</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3"></div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control input_border txt_cent" type="text" value="<?php echo $ca['province'] ?>" readonly>
							<h6 class="txt_cent"><i>Province</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control input_border txt_cent" type="text" value="<?php echo $ll['country'] ?>" readonly>
							<h6 class="txt_cent"><i>Country</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control input_border txt_cent" type="text" value="<?php echo $ll['zip_code'] ?>" readonly>
							<h6 class="txt_cent"><i>Zipcode</i></h6>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 space" style="border-top:1px solid #ff6600; border-bottom:1px solid #ff6600;">
                        <center><h5 style="letter-spacing: 10px;"><b>DOCUMENTS</b></h5></center>
                    </div>

					<div class="col-md-12 col-sm-12 col-xs-12 space">
						<div class="col-md-5 col-sm-5 col-xs-5">
					        <center>
					            <label>Turnover of Doubtful Account Form Folder</label>
					            <?php
					                $doubtful_account_path = base_url('assets/img/es_uploads/' . $eu['reference_id'] . '/doubtful_account/' . $eu['doubtful_account']);
					            ?>
					            <button class='btn btn-custom-primary' onclick="viewImage('<?php echo $doubtful_account_path; ?>')">View 
					                <span class="glyphicon glyphicon-folder-open"></span>
					            </button>
					        </center>
					    </div>

						<div class="col-md-3 col-sm-3 col-xs-3">
							<center>
					            <label>Latest SOA Folder</label>
					            <?php
					                $latest_soa_path = base_url('assets/img/es_uploads/' . $eu['reference_id'] . '/latest_soa/' . $eu['latest_soa']);
					            ?>
					            <button class='btn btn-custom-primary' onclick="viewImage('<?php echo $latest_soa_path; ?>')">View 
					                <span class="glyphicon glyphicon-folder-open"></span>
					            </button>
					        </center>
						</div>

						<div class="col-md-4 col-sm-4 col-xs-4">
							<center>
					            <label>Supporting Documents Folder</label>
					            <?php
					                $supporting_docs_path = base_url('assets/img/es_uploads/' . $eu['reference_id'] . '/supporting_docs/' . $eu['supporting_docs']);
					            ?>
					            <button class='btn btn-custom-primary' onclick="viewImage('<?php echo $supporting_docs_path; ?>')">View 
					                <span class="glyphicon glyphicon-folder-open"></span>
					            </button>
					        </center>
						</div>
					</div>
				</div>																		 
			</div> 
			<!--====================END START CONTENT====================--> 
		</div>				
	</div>
</div>
<!--====================END PAGE CONTENT====================-->

<script>
	const goBack = () => {
		window.history.back();
	};
</script>

<script>
	function viewImage(path) {
	    let item = [{
	      src: path, // path to image
	      title: 'Attached File' // If you skip it, there will display the original image name
	    }];
	    // define options (if needed)
	    let options = {
	      index: 0 // this option means you will start at first image
	    };
	    // Initialize the plugin
	    let photoviewer = new PhotoViewer(item, options);
	}
</script>

<script>
	// When the user scrolls down 20px from the top of the document, show the button
	window.onscroll = function() {scrollFunction()};

	function scrollFunction() {
		if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
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


<style type="text/css">
	table {
		border-collapse: collapse;
	}
	table, td, th {
		border: 1px solid #cccccc;
	}
	th{
		text-align: center;
	}
	#mvTop {
		display: none;
		position: fixed;
		bottom: 45px;
		right: 23px;
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
</style>