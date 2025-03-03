<div class="container">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel animate fadeIn" style="border-radius:10px;"><br/>
			<!--====================BODY====================-->
			<center>
				<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
				<h4><b>LOT PURCHASE FORM (LPF)</b></h4>
			</center>

			<input type="hidden" name="is_no" value="<?php echo $is_no?>">

			<div class="col-md-12 col-sm-12 col-xs-12 space">
		        <div class="col-md-4 col-sm-4 col-xs-4 form-inline">
		          	<label>LPF Number:</label><input class="form-control input_border" type="text" value="<?= $li['is_no']; ?>" readonly>
		        </div>
		        <div class="col-md-4 col-sm-4 col-xs-4 form-inline pull-right">
		          	<label>Date:</label><input class="form-control input_border" type="text" value="<?= date('F j, Y', strtotime($li['date_acquired'])); ?>" readonly>
		        </div>
	      	</div>

			<div class="col-md-12 space"> 
				<div class="col-md-3 col-sm-3 col-xs-3"><label>Lot Location:</div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<input class="form-control input_border txt_cent" type="text" value="<?= $ll['street']; ?>" readonly>
					<h6 class="name_center"><i>Street</i></h6>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<input class="form-control input_border txt_cent" type="text" value="<?= $ll['baranggay']; ?>" readonly>
					<h6 class="name_center"><i>Baranggay</i></h6>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<input class="form-control input_border txt_cent" type="text" value="<?= $ll['municipality']; ?>" readonly>
					<h6 class="name_center"><i>Municipality</i></h6>
				</div>

				<div class="col-md-3 col-sm-3 col-xs-3"><label></div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<input class="form-control input_border txt_cent" type="text" value="<?= $ll['province']; ?>" readonly>
					<h6 class="name_center"><i>Province</i></h6>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<input class="form-control input_border txt_cent" type="text" value="<?= $ll['country']; ?>" readonly>
					<h6 class="name_center"><i>Country</i></h6>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<input class="form-control input_border txt_cent" type="text" value="<?= $ll['zip_code']; ?>" readonly>
					<h6 class="name_center"><i>Zipcode</i></h6>
				</div>
			</div>

			<div class="col-md-12 space"> 
				<div class="col-md-3 col-sm-3 col-xs-3"><label>Lot Owner:</div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<input class="form-control input_border txt_cent" type="text" value="<?= $oi['firstname']; ?>" readonly>
					<h6 class="name_center"><i>Firstname</i></h6>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-3col-md-3 col-sm-3 col-xs-3">
					<input class="form-control input_border txt_cent" type="text" value="<?= $oi['middlename']; ?>" readonly>
					<h6 class="name_center"><i>Middlename</i></h6>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-3">
					<input class="form-control input_border txt_cent" type="text" value="<?= $oi['lastname']; ?>" readonly>
					<h6 class="name_center"><i>Lastname</i></h6>
				</div>
			</div>

			<?php if (!empty($li['land_title_no'])): ?>
				<div class="col-md-12 space"> 
					<div class="col-md-3 col-sm-3 col-xs-3"><label>Title No.:</div>
					<div class="col-md-9 col-sm-9 col-xs-9">
						<input class="form-control input_border" type="text" value="<?= isset($li['land_title_no']) ? $li['land_title_no'] : ''; ?>" readonly>
					</div>
				</div>
			<?php endif; ?>

			<?php if (!empty($li['tax_dec_no'])): ?>
				<div class="col-md-12 space"> 
					<div class="col-md-3 col-sm-3 col-xs-3"><label>Latest Tax Dec.:</div>
					<div class="col-md-9 col-sm-9 col-xs-9">
						<input class="form-control input_border" type="text" value="<?= $li['tax_dec_no'] ? $li['tax_dec_no'] : ''; ?>" readonly>
					</div>
				</div>
			<?php endif; ?>

			<div class="col-md-12 space">
				<div class="col-md-5 col-sm-5 col-xs-5 form-inline">
					<label>Total Lot Area Purchased:</label>
					<input class="form-control input_border" type="text" value="<?= $li['lot_size']; ?>" readonly>
				</div>
				<div class="col-md-5 col-sm-5 col-xs-5 form-inline" style="float: right">
					<?php if ($li['price_per_sqm'] != 0.00): ?>
						<label>Price per sq.mtrs.:</label>
						<input class="form-control input_border" type="text" value="<?= $li['price_per_sqm']; ?>" readonly>
					<?php endif; ?>
				</div>
			</div>


			<div class="col-md-12 space"><br/>
				<center><div class="col-md-12"><label>Computations: Lot Price (Lot Area x Price/Sq.mtr.)</label></div></center>
			</div>

			<div class="col-md-12 space">
				<div class="col-md-12"><label>Total Selling Price:</label></div>
				<div class="col-md-2"></div>
				<div class="col-md-9 form-inline">
					<label>Amount in Figures:</label>
					<input type="text" value="₱<?php echo number_format($li['total_price'],2) ?>" name="" class="form-control input_border" readonly >
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-9 form-inline">
					<label>Amount in Words: </label> 
					<span style="color:#ff6600"><u><?php echo number_to_words($li['total_price']); ?> Pesos</u></span>
				</div>
			</div>

			<div class="col-md-12 space">
				<div class="col-md-2">
					<label>Purpose/Use:</label>
				</div>
				<div class="col-md-10 col-sm-10 col-xs-10 form-inline">
					<input class="form-control input_border" type="text" name="purpose" value="<?php echo empty($pr['purpose_use']) ? '' : $pr['purpose_use']; ?>" size="100">
				</div>
			</div>
			<!--====================END BODY====================-->
		</div>
	</div>
</div>