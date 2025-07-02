<div class="container">
  	<div class="col-md-12 col-sm-12 col-xs-12">
    	<div class="x_panel" style="border-radius:10px;"><br/>
      		<!--====================BODY====================-->
      		<div class="row text-center">
      			<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="150px" height="50px">
        		<h5 style="letter-spacing:4px;"><b>INTERVIEW SHEET (IS)</b></h5>
      		</div>

      		<div class="col-md-12 col-sm-12 col-xs-12 form-inline space">
		        <div class="col-md-1 col-sm-1 col-xs-1"><label>IS No:</label></div>
		        <div class="col-md-4 col-sm-4 col-xs-4">
		          	<input class="form-control" type="text" value="<?php echo $li['is_no'];?>" readonly style="font-weight: bold;">
		        </div>
		        <div class="col-md-2 col-sm-2 col-xs-2"></div>
		        <div class="col-md-2 col-sm-2 col-xs-2"><label>Date Acquired:</label></div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input class="form-control" type="text" value="<?php echo $li['date_acquired'];?>" readonly>
		        </div>
	      	</div>

      		<div class="col-md-12 col-sm-12 col-xs-12 space text-center" style="border-top: 2px solid #ff6600; border-bottom: 2px solid #ff6600;">
				<h5 style="letter-spacing:10px;">LAND INFORMATION</h5>
			</div>

			<div class="col-md-12 col-sm-12 col-xs-12 form-inline space">
		        <div class="col-md-1 col-sm-1 col-xs-1"><label>Lot:</label></div>
		        <div class="col-md-4 col-sm-4 col-xs-4">
		          	<input class="form-control" type="text" value="<?php echo $li['lot'];?>" readonly>
		        </div>

		        <div class="col-md-2 col-sm-2 col-xs-2"></div>

		        <div class="col-md-1 col-sm-1 col-xs-1"><label>Cad:</label></div>
		        <div class="col-md-4 col-sm-4 col-xs-4">
		          	<input class="form-control" type="text" value="<?php echo $li['cad'];?>" readonly>
		        </div>
	      	</div>

		    <div class="col-md-12 col-sm-12 col-xs-12 space">
		        <div class="col-md-3 col-sm-3 col-xs-3 lot_type" style="height: 29px;"><label>Lot Type:</label></div>
		        <div class="col-md-3 col-sm-3 col-xs-3 lot_type">
		          	<input type="checkbox" <?php if($li['lot_type'] == 'Agricultural'){ echo 'checked'; } ?> disabled>
		          	<label> Agricultural</label>
		        </div>
		        <div class="col-md-3 col-sm-3 col-xs-3 lot_type">
		          	<input type="checkbox" <?php if($li['lot_type'] == 'Commercial'){ echo 'checked'; } ?> disabled>
		          	<label> Commercial</label>
		        </div>
		        <div class="col-md-3 col-sm-3 col-xs-3 lot_type">
		          	<input type="checkbox" <?php if($li['lot_type'] == 'Residential'){ echo 'checked'; } ?> disabled>
		          	<label> Residential</label>
		        </div>
		    </div>

	      	<div class="col-md-12 col-sm-12 col-xs-12 space"> 
	        	<div class="col-md-2 col-sm-2 col-xs-2"><label>Lot Owner:</label></div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="text" class="form-control txt_cent" value="<?php echo $oi['firstname'] ?>" readonly>
		          	<h6 class="txt_cent"><i>Firstname</i></h6>
		        </div>
		        <div class="col-md-4 col-sm-4 col-xs-4">
		          	<input type="text" class="form-control txt_cent" value="<?php if($oi['middlename']){ echo $oi['middlename']; }else{ echo ""; }  ?>"  readonly>
		          	<h6 class="txt_cent"><i>Middlename</i></h6>
		        </div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="text" class="form-control txt_cent" value="<?php echo $oi['lastname'] ?>" readonly>
		          	<h6 class="txt_cent"><i>Lastname</i></h6>
		        </div>
	      	</div>

	      	<div class="col-md-12 col-sm-12 col-xs-12 space">
	        	<div class="col-md-3 col-sm-3 col-xs-3"><label>Owner Information:</label></div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="checkbox" <?php if($oi['vital_status'] == 'Alive'){ echo 'checked'; } ?> disabled>
		          	<label> Alive</label>
		        </div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="checkbox" <?php if($oi['vital_status'] == 'Deceased'){ echo 'checked'; } ?> disabled>
		          	<label> Deceased</label>
		        </div>
	      	</div>

      		<div class="col-md-12 col-sm-12 col-xs-12 space"> 
        		<div class="col-md-2 col-sm-2 col-xs-2"><label>Lot Location:</label></div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="text" class="form-control txt_cent" value="<?php echo $ll['street'];?>" readonly>
		          	<h6 class="txt_cent"><i>Street</i></h6>
		        </div>
		        <div class="col-md-4 col-sm-4 col-xs-4">
		          	<input type="text" class="form-control txt_cent" value="<?php echo $ll['baranggay']?>" readonly>
		          	<h6 class="txt_cent"><i>Baranggay</i></h6>
		        </div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="text" class="form-control txt_cent" value="<?php echo $ll['municipality']?>" readonly>
		          	<h6 class="txt_cent"><i>Municipality</i></h6>
		        </div>

		        <div class="col-md-2 col-sm-2 col-xs-2"></div>

		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="text" class="form-control txt_cent" value="<?php echo $ll['province']?>" readonly>
		          	<h6 class="txt_cent"><i>Province</i></h6>
		        </div>
		        <div class="col-md-4 col-sm-4 col-xs-4">
		          	<input type="text" class="form-control txt_cent" value="<?php echo $ll['region']?>" readonly>
		          	<h6 class="txt_cent"><i>Region</i></h6>
		        </div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="text" class="form-control txt_cent" value="<?php echo $ll['zip_code']?>" readonly>
		          	<h6 class="txt_cent"><i>Zip Code</i></h6>
		        </div>
      		</div>

		    <div class="col-md-12 col-sm-12 col-xs-12 space">
		        <div class="col-md-3 col-sm-3 col-xs-3"><label>Lot Sold:</label></div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="checkbox" <?php if($li['lot_sold'] == 'Portion'){ echo 'checked'; } ?> disabled>
		          	<label> Portion</label>
		        </div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="checkbox" <?php if($li['lot_sold'] == 'Whole'){ echo 'checked'; } ?> disabled>
		          	<label> Whole</label>
		        </div>
		    </div>

      		<div class="col-md-12 col-sm-12 col-xs-12 space">
        		<div class="col-md-3 col-sm-3 col-xs-3"><label>Purchase Type:</label></div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="checkbox" <?php if($li['purchase_type'] == 'package'){ echo 'checked'; } ?> disabled>
		          	<label> package</label>
		        </div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="checkbox" <?php if($li['purchase_type'] == 'per/sq.m.'){ echo 'checked'; } ?> disabled>
		          	<label> per sq.m</label>
		        </div>
      		</div>

      		<div class="col-md-12 col-sm-12 col-xs-12 form-inline space">
		        <div class="col-md-2 col-sm-2 col-xs-2"><label>Lot Size:</label></div>
		        <div class="col-md-4 col-sm-4 col-xs-4">
		          	<input type="text" class="form-control inb" value="<?php echo number_format($li['lot_size'],2) ?>" readonly><label>sq.m</label>
		        </div>
		        <div class="col-md-3 col-sm-3 col-xs-3"><label class="pull-right">Selling Price per sq.m: ₱</label></div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="text" class="form-control inb" value="<?php echo number_format($li['price_per_sqm'],2) ?>"  readonly>
		        </div>
      		</div>

		    <div class="col-md-12 col-sm-12 col-xs-12 form-inline space">
		        <div class="col-md-12 col-sm-12 col-xs-12"><label>Total Selling Price:</label></div>
		        <div class="col-md-2 col-sm-2 col-xs-2"></div>
		        <div class="col-md-9 col-sm-9 col-xs-9">
		          	<label>Amount In Figures: ₱</label>
		          	<input type="text" class="form-control inb" value="<?php echo number_format($li['total_price'],2) ?>" readonly>
		        </div>

		        <div class="col-md-2 col-sm-2 col-xs-2"></div>

		        <div class="col-md-9 col-sm-9 col-xs-9 space">
		          	<?php $this->load->helper('custom'); ?>
		          	<label>Amount In Words:</label> 
		          	<span style="color:#ff6600"><u><?php echo number_to_words($li['total_price']); ?> Pesos</u></span>
		        </div>
		    </div>

	      	<div class="col-md-12 col-sm-12 col-xs-12 space"><label>Restriction/s to Land Title:</label></div>
	      	<div class="col-md-12 col-sm-12 col-xs-12">
		        <div class="col-md-3 col-sm-3 col-xs-3" style="border: 1px solid #cccccc">
		          	<label>Liens</label>
		        </div>
		        <div class="col-md-9 col-sm-9 col-xs-9" style="border: 1px solid #cccccc">
		          	<textarea class="form-control" readonly><?php echo isset($rstr) && isset($rstr['liens']) ? $rstr['liens'] : ''; ?></textarea>
		        </div>

		        <div class="col-md-3 col-sm-3 col-xs-3" style="border: 1px solid #cccccc">
		          	<label>Easement</label>
		        </div>
		        <div class="col-md-9 col-sm-9 col-xs-9" style="border: 1px solid #cccccc">
		          	<textarea class="form-control" readonly><?php echo isset($rstr) && isset($rstr['easement']) ? $rstr['easement'] : ''; ?></textarea>
		        </div>

		        <div class="col-md-3 col-sm-3 col-xs-3" style="border: 1px solid #cccccc">
		          	<label>Encumbrances</label>
		        </div>
		        <div class="col-md-9 col-sm-9 col-xs-9" style="border: 1px solid #cccccc">
		          	<textarea class="form-control" readonly><?php echo isset($rstr) && isset($rstr['encumbrances']) ? $rstr['encumbrances'] : ''; ?></textarea>
		        </div>
	      	</div>

      		<div class="col-md-12 col-sm-12 col-xs-12 space">
		        <div class="col-md-12 col-sm-12 col-xs-12"><label>Available Proof of Title/Ownership:</label></div>
		        <div class="col-md-3 col-sm-3 col-xs-3"></div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		        	<input type="checkbox" <?php if(!empty($ud['land_title'])){ echo 'checked'; } ?> readonly>
		        	<label>Land Title</label>
		        </div>
		        <div class="col-md-3">
		        	<input type="checkbox" <?php if(!empty($ud['latest_tax_dec'])){ echo 'checked'; } ?> disabled>
		        	<label>Tax Declaration</label>
		        </div>

		        <div class="col-md-3 col-sm-3 col-xs-3">
					<div class="panel panel-default" style="width: 200px; border: 2px solid #b3cccc;">
						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							<div class="panel-heading" role="tab" id="headingTwo">
								<center><h4 class="panel-title">View Documents</h4></center>
							</div>
						</a>
						<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
							<div class="panel-body text-center">
								<?php if (!empty($ud['latest_tax_dec'])) { ?>
									<?php $latest_tax_dec = base_url('assets/img/uploaded_documents/' . $ud['is_no'] . '/Tax Declaration/' . $ud['latest_tax_dec']); ?>
						            <button class='btn btn-primary' onclick="viewImage('<?php echo $latest_tax_dec; ?>')">Tax Declaration <span class="glyphicon glyphicon-folder-open"></span></button>
						        <?php } ?>
						        <?php if (!empty($ud['land_title'])) { ?>
						            <?php $land_title = base_url('assets/img/uploaded_documents/' . $ud['is_no'] . '/Land Title/' . $ud['land_title']); ?>
						            <button class='btn btn-primary' onclick="viewImage('<?php echo $land_title; ?>')">Land Title <span class="glyphicon glyphicon-folder-open"></span></button>
						        <?php } ?>
						        <?php if (!empty($ud['brgy_resolution'])) { ?>
						        	<?php $brgy_resolution = base_url('assets/img/uploaded_documents/' . $ud['is_no'] . '/Barangay Resolution/' . $ud['brgy_resolution']); ?>
						            <button class='btn btn-primary' onclick="viewImage('<?php echo $brgy_resolution; ?>')">Barangay Resolution <span class="glyphicon glyphicon-folder-open"></span></button>
						        <?php } ?>
						        <?php if (!empty($ud['land_sketch'])) { ?>
						        	<?php $land_sketch = base_url('assets/img/uploaded_documents/' . $ud['is_no'] . '/Land Sketch/' . $ud['land_sketch']); ?>
						            <button class='btn btn-primary' onclick="viewImage('<?php echo $land_sketch; ?>')">Land Sketch <span class="glyphicon glyphicon-folder-open"></span></button>
						        <?php } ?>
							</div>
						</div>
					</div>
				</div>
      		</div>

	      	<div class="col-md-12 col-sm-12 col-xs-12 text-center space" style="border-top: 2px solid #ff6600; border-bottom: 2px solid #ff6600;margin-bottom:25px">
				<h5 style="letter-spacing:5px;">MAIN CONTACT PERSON</h5>
			</div>


	      	<div class="col-md-6 col-sm-6 col-xs-6 form-inline">
		        <label class="col-md-4 col-sm-4 col-xs-4">Name:</label>
		        <input type="text" class="form-control inb" value="<?php echo $cp['name'] ?>" readonly>
	      	</div>

	      	<div class="col-md-6 col-sm-6 col-xs-6 form-inline">
		        <label class="col-md-4 col-sm-4 col-xs-4">Address:</label>
		        <input type="text" class="form-control inb" value="<?php echo $cp['address'] ?>" readonly>
	      	</div>

	      	<div class="col-md-6 col-sm-6 col-xs-6 form-inline">
		        <label class="col-md-4 col-sm-4 col-xs-4">Telephone No:</label>
		        <input type="text" class="form-control inb" value="<?php echo $cp['tel_no'] ?>" readonly> 
	      	</div>

	      	<div class="col-md-6 col-sm-6 col-xs-6 form-inline">
		        <label class="col-md-4 col-sm-4 col-xs-4">Phone No:</label>
		        <input type="text" class="form-control inb" value="<?php echo $cp['phone_no'] ?>" readonly>
	      	</div>

	      	<div class="col-md-6 col-sm-6 col-xs-6 form-inline">
		        <label class="col-md-4 col-sm-4 col-xs-4">Email Address:</label>
		        <input type="text" class="form-control inb" value="<?php echo $cp['email_ad'] ?>" readonly>
	      	</div>
      		<!--====================END BODY====================-->
    	</div>
  	</div>
</div>