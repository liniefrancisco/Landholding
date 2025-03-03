<div class="container">
  	<div class="col-md-12 col-sm-12 col-xs-12">
    	<div class="x_panel" style="border-radius:10px;"><br/>
      		<!--====================BODY====================-->
      		<center>
      			<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
        		<h4 style="padding-top: 10px;letter-spacing: 2px;"><b>INTERVIEW SHEET (IS)</b></h4>
      		</center>

      		<div class="col-md-12 col-sm-12 col-xs-12 space">
		        <div class="col-md-4 col-sm-4 col-xs-4 form-inline">
		          	<label>IS No:</label><input class="form-control input_border" type="text" name="js_no" value="<?php echo $li['is_no'];?>"  readonly>
		        </div>
		        <div class="col-md-4 col-sm-4 col-xs-4 form-inline pull-right">
		          	<label>Date Acquired:</label><input class="form-control input_border" type="text" value="<?php echo $li['date_acquired'];?>" name="date"  readonly>
		        </div>
	      	</div>

      		<div class="col-md-12 col-sm-12 col-xs-12 space" style="border-top: 2px solid #ff6600; border-bottom: 2px solid #ff6600;">
        		<center><h5 style="letter-spacing: 15px;"><b>LAND INFORMATION</b></h5></center>
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
		          	<input type="checkbox" name="" value="<?php ?>" disabled readonly <?php if($li['lot_type'] == 'Agricultural'){ echo 'checked'; } ?>><label> Agricultural</label>
		        </div>
		        <div class="col-md-3 col-sm-3 col-xs-3 lot_type">
		          	<input type="checkbox" name="" value="<?php ?>" disabled readonly <?php if($li['lot_type'] == 'Commercial'){ echo 'checked'; } ?>><label> Commercial</label>
		        </div>
		        <div class="col-md-3 col-sm-3 col-xs-3 lot_type">
		          	<input type="checkbox" name="" value="<?php ?>"  disabled readonly <?php if($li['lot_type'] == 'Residential'){ echo 'checked'; } ?>><label> Residential</label>
		        </div>
		    </div>

	      	<div class="col-md-12 col-sm-12 col-xs-12 space"> 
	        	<div class="col-md-3"><label>Lot Owner:</div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="text" name="" value="<?php echo $oi['firstname'] ?>" class="form-control input_border txt_cent" readonly>
		          	<h6 class="name_center"><i>Firstname</i></h6>
		        </div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="text" name="" value="<?php if($oi['middlename']){ echo $oi['middlename']; }else{ echo ""; }  ?>" class="form-control input_border txt_cent" readonly>
		          	<h6 class="name_center"><i>Middlename</i></h6>
		        </div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="text" name="" value="<?php echo $oi['lastname'] ?>" class="form-control input_border txt_cent" readonly>
		          	<h6 class="name_center"><i>Lastname</i></h6>
		        </div>
	      	</div>

	      	<div class="col-md-12 col-sm-12 col-xs-12 space">
	        	<div class="col-md-4 col-sm-4 col-xs-4"><label>Owner Information:</label></div>
		        <div class="col-md-4 col-sm-4 col-xs-4">
		          	<input type="checkbox" name="" value="<?php ?>" disabled readonly <?php if($oi['vital_status'] == 'Alive'){ echo 'checked'; } ?>><label> Alive</label>
		        </div>
		        <div class="col-md-4 col-sm-4 col-xs-4">
		          	<input type="checkbox" name="" value="<?php ?>" disabled readonly <?php if($oi['vital_status'] == 'Deceased'){ echo 'checked'; } ?>><label> Deceased</label>
		        </div>
	      	</div>

      		<div class="col-md-12 col-sm-12 col-xs-12 space"> 
        		<div class="col-md-3"><label>Lot Location:</div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="text" name="" value="<?php echo $ll['street'];?>" class="form-control input_border txt_cent" readonly>
		          	<h6 class="name_center"><i>Street</i></h6>
		        </div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="text" name="" value="<?php echo $ll['baranggay']?>" class="form-control input_border txt_cent" readonly>
		          	<h6 class="name_center"><i>Baranggay</i></h6>
		        </div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="text" name="" value="<?php echo $ll['municipality']?>" class="form-control input_border txt_cent" readonly>
		          	<h6 class="name_center"><i>Municipality</i></h6>
		        </div>

		        <div class="col-md-3 col-sm-3 col-xs-3"></div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="text" name="" value="<?php echo $ll['province']?>" class="form-control input_border txt_cent" readonly>
		          	<h6 class="name_center"><i>Province</i></h6>
		        </div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="text" name="" value="<?php echo $ll['region']?>" class="form-control input_border txt_cent" readonly>
		          	<h6 class="name_center"><i>Region</i></h6>
		        </div>
		        <div class="col-md-3 col-sm-3 col-xs-3">
		          	<input type="text" name="" value="<?php echo $ll['zip_code']?>" class="form-control input_border txt_cent" readonly>
		          	<h6 class="name_center"><i>Zip Code</i></h6>
		        </div>
      		</div>

		    <div class="col-md-12 col-sm-12 col-xs-12 space">
		        <div class="col-md-4 col-sm-4 col-xs-4"><label>Lot Sold:</label></div>
		        <div class="col-md-4 col-sm-4 col-xs-4">
		          	<input type="checkbox" name="" value="<?php ?>" disabled readonly <?php if($li['lot_sold'] == 'Portion'){ echo 'checked'; } ?>><label> Portion</label>
		        </div>
		        <div class="col-md-4 col-sm-4 col-xs-4">
		          	<input type="checkbox" name="" value="<?php ?>" disabled readonly <?php if($li['lot_sold'] == 'Whole'){ echo 'checked'; } ?>><label> Whole</label>
		        </div>
		    </div>

      		<div class="col-md-12 col-sm-12 col-xs-12 space">
        		<div class="col-md-4 col-sm-4 col-xs-4"><label>Purchase Type:</label></div>
		        <div class="col-md-4 col-sm-4 col-xs-4">
		          	<input type="checkbox" name="" value="<?php ?>" disabled readonly <?php if($li['purchase_type'] == 'package'){ echo 'checked'; } ?>><label> package</label>
		        </div>
		        <div class="col-md-4 col-sm-4 col-xs-4">
		          	<input type="checkbox" name="" value="<?php ?>" disabled readonly <?php if($li['purchase_type'] == 'per/sq.m.'){ echo 'checked'; } ?>><label> per sq.m</label>
		        </div>
      		</div>

      		<div class="col-md-12 col-sm-12 col-xs-12 space">
		        <div class="col-md-3 col-sm-3 col-xs-3"></div>
		        <div class="col-md-4 form-inline">
		          	<label>Lot Size:</label> <input type="text" value="<?php echo number_format($li['lot_size'],2) ?>" name="" class="form-control input_border" readonly><label>sq.m</label>
		        </div>
		        <div class="col-md-5 form-inline">
		          	<label>Selling Price per sq.m: ₱</label> <input type="text" value="<?php echo number_format($li['price_per_sqm'],2) ?>" name="" class="form-control input_border" readonly>
		        </div>
      		</div>

		    <div class="col-md-12 col-sm-12 col-xs-12 space">
		        <div class="col-md-12 col-sm-12 col-xs-12"><label>Total Selling Price:</label></div>
		        <div class="col-md-2 col-sm-2 col-xs-2"></div>
		        <div class="col-md-9 col-sm-9 col-xs-9 form-inline">
		          	<label>Amount In Figures: ₱</label><input type="text" value="<?php echo number_format($li['total_price'],2) ?>" name="" class="form-control input_border" readonly>
		        </div>
		        <div class="col-md-2 col-sm-2 col-xs-2"></div>
		        <div class="col-md-9 col-sm-9 col-xs-9 form-inline">
		          	<?php $this->load->helper('custom'); ?>
		          	<label>Amount In Words:</label> <span style="color:#ff6600;text-decoration: underline"><?php echo number_to_words($li['total_price']); ?> Pesos</span>
		        </div>
		    </div>

	      	<div class="col-md-12 col-sm-12 col-xs-12 space">
	        	<label>Restriction/s to Land Title:</label>
	      	</div>
	      	<div class="col-md-12 col-sm-12 col-xs-12 space">
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
		        <div class="col-md-12"><label>Available Proof of Title/Ownership:</label></div>
		        <div class="col-md-3"></div>
		        <div class="col-md-3"><input type="checkbox" name="" disabled readonly value="" <?php if(!empty($ud['land_title'])){ echo 'checked'; } ?>><label>Land Title</label></div>
		        <div class="col-md-3"><input type="checkbox" name="" value="" disabled readonly <?php if(!empty($ud['latest_tax_dec'])){ echo 'checked'; } ?>><label>Tax Declaration</label></div>

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
				                  	<?php if(!empty($ud['latest_tax_dec'])){ ?> 
				                    	<button class="btn btn-success" data-toggle="modal" data-target=".latest_tax_dec_<?php echo $li['is_no'];?>" data-backdrop="static" data-keyboard="false">Latest Tax Declaration</button>
				                  	<?php }else{ echo "";} ?>

				                  	<?php if(!empty($ud['land_title'])){ ?>  
				                    	<button class="btn btn-success" data-toggle="modal" data-target=".land_title_<?php echo $li['is_no'];?>" data-backdrop="static" data-keyboard="false">Land Title</button>
				                  	<?php }else{ echo ""; } ?> 

				                  	<?php if(!empty($ud['brgy_resolution'])){ ?>  
				                    	<button class="btn btn-success" data-toggle="modal" data-target=".brgy_res_<?php echo $li['is_no'];?>" data-backdrop="static" data-keyboard="false">Barangay Resolution</button>
				                  	<?php }else{ echo ""; } ?>               
				                  	<button class="btn btn-success" data-toggle="modal" data-target=".land_sketch_<?php echo $li['is_no'];?>" data-backdrop="static" data-keyboard="false">Land Sketch</button>
				                </center>
			              	</div>
			            </div>
		          	</div>
		        </div>
      		</div>

	      	<div class="col-md-12 col-sm-12 col-xs-12 space" style="border-top: 1px solid #ff6600; border-bottom: 1px solid #ff6600; padding-bottom: 10px;padding-top: 10px;margin-bottom:10px">
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
      		<!--====================END BODY====================-->
    	</div>
  	</div>
</div>