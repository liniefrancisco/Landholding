<div class="container">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel animate fadeIn" style="border-radius:10px;">
			<?php echo form_open('Payment/view_inprogress/'.$is_no,array('id' => "edit_lpf")); ?>
				<!--====================BODY====================-->
				<div class="row text-center space">
					<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="120px" height="35px">
					<h5 class="modal-title1" style="margin-top:-1px">LOT PURCHASE FORM (LPF)</h5>
				</div>

				<center><div class="change-message">*You have unsaved changes.</div></center>
				<!-- Hidden -->
				<input type="hidden" name="is_no" value="<?php echo $is_no?>">
				<!-- End Hidden -->

				<div class="col-md-12 col-sm-12 col-xs-12 form-inline space">
			        <div class="col-md-2 col-sm-2 col-xs-2"><label>LPF Number:</label></div>
			        <div class="col-md-4 col-sm-4 col-xs-4">
			          	<input class="form-control inb" type="text" value="<?= $li['is_no']; ?>" readonly>
			        </div>
			        <div class="col-md-1 col-sm-1 col-xs-1"></div>
			        <div class="col-md-1 col-sm-1 col-xs-1"><label>Date:</label></div>
			        <div class="col-md-4 col-sm-4 col-xs-4">
			          	<input class="form-control inb" type="text" value="<?= date('F j, Y', strtotime($li['date_acquired'])); ?>" readonly>
			        </div>
		      	</div>

				<div class="col-md-12 col-sm-12 col-xs-12 space"> 
					<div class="col-md-2 col-sm-2 col-xs-2"><label>Lot Location:</label></div>
					<div class="col-md-3 col-sm-3 col-xs-3">
						<input class="form-control inb txt_cent" type="text" value="<?= $ll['street']; ?>" readonly>
						<h6 class="text-center"><i>Street</i></h6>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-3">
						<input class="form-control inb txt_cent" type="text" value="<?= $ll['baranggay']; ?>" readonly>
						<h6 class="text-center"><i>Baranggay</i></h6>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<input class="form-control inb txt_cent" type="text" value="<?= $ll['municipality']; ?>" readonly>
						<h6 class="text-center"><i>Municipality</i></h6>
					</div>

					<div class="col-md-2 col-sm-2 col-xs-2"></div>

					<div class="col-md-3 col-sm-3 col-xs-3">
						<input class="form-control inb txt_cent" type="text" value="<?= $ll['province']; ?>" readonly>
						<h6 class="text-center"><i>Province</i></h6>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-3">
						<input class="form-control inb txt_cent" type="text" value="<?= $ll['country']; ?>" readonly>
						<h6 class="text-center"><i>Country</i></h6>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<input class="form-control inb txt_cent" type="text" value="<?= $ll['zip_code']; ?>" readonly>
						<h6 class="text-center"><i>Zipcode</i></h6>
					</div>
				</div>

				<div class="col-md-12 col-sm-12 col-xs-12"> 
					<div class="col-md-2 col-sm-2 col-xs-2"><label>Lot Owner:</div>
					<div class="col-md-3 col-sm-3 col-xs-3">
						<input class="form-control inb txt_cent" type="text" value="<?= $oi['firstname']; ?>" readonly>
						<h6 class="text-center"><i>Firstname</i></h6>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-3col-md-3 col-sm-3 col-xs-3">
						<input class="form-control inb txt_cent" type="text" value="<?= $oi['middlename']; ?>" readonly>
						<h6 class="text-center"><i>Middlename</i></h6>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<input class="form-control inb txt_cent" type="text" value="<?= $oi['lastname']; ?>" readonly>
						<h6 class="text-center"><i>Lastname</i></h6>
					</div>
				</div>

				<?php if (!empty($li['land_title_no'])): ?>
					<div class="col-md-12 col-sm-12 col-xs-12"> 
						<div class="col-md-2 col-sm-2 col-xs-2"><label>Title No.:</label></div>
						<div class="col-md-10 col-sm-10 col-xs-10">
							<input class="form-control inb" type="text" value="<?= isset($li['land_title_no']) ? $li['land_title_no'] : ''; ?>" readonly>
						</div>
					</div>
				<?php endif; ?>

				<?php if (!empty($li['tax_dec_no'])): ?>
					<div class="col-md-12 col-sm-12 col-xs-12"> 
						<div class="col-md-2 col-sm-2 col-xs-2"><label>Latest Tax Dec.:</div>
						<div class="col-md-10 col-sm-10 col-xs-10">
							<input class="form-control inb" type="text" value="<?= $li['tax_dec_no'] ? $li['tax_dec_no'] : ''; ?>" readonly>
						</div>
					</div>
				<?php endif; ?>

				<div class="col-md-12 col-sm-12 col-xs-12 form-inline space">
					<div class="col-md-2 col-sm-2 col-xs-2"><label>Total Lot Area Purchased:</label></div>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<input class="form-control inb" type="text" value="<?= $li['lot_size']; ?>" readonly>
					</div>
					<div class="col-md-2 col-sm-2 col-xs-2"><label>Price per sq.mtrs.:</label></div>
					<div class="col-md-4 col-sm-4 col-xs-4">
						<?php if ($li['price_per_sqm'] != 0.00): ?>
							<input class="form-control inb" type="text" value="<?= $li['price_per_sqm']; ?>" readonly>
						<?php endif; ?>
					</div>
				</div>

				<div class="col-md-12 col-sm-12 col-xs-12 text-center space">
					<h6><b>Computations: Lot Price (Lot Area x Price/Sq.mtr.)</b></h6>
				</div>

				<div class="col-md-12 col-sm-12 col-xs-12 space">
					<div class="col-md-12"><label>Total Selling Price:</label></div>
					<div class="col-md-2"></div>
					<div class="col-md-9 form-inline">
						<label>Amount in Figures:</label>
						<input class="form-control inb" type="text" value="₱<?php echo number_format($li['total_price'],2) ?>" readonly >
					</div>
					<div class="col-md-2"></div>
					<div class="col-md-9 form-inline space">
						<label>Amount in Words: </label> 
						<span style="color:#ff6600"><u><?php echo number_to_words($li['total_price']); ?> Pesos</u></span>
					</div>
				</div>

				<div class="col-md-12 col-sm-12 col-xs-12 Space"><br/><br/>
					<div class="col-md-2 col-sm-2 col-xs-2"><label>Purpose/Use:</label></div>
					<div class="col-md-10 col-sm-10 col-xs-10">
						<input class="form-control inb" type="text" name="purpose" value="<?php echo empty($fp_info1['purpose_use']) ? '' : $fp_info1['purpose_use']; ?>">
					</div>
				</div>
				<!--====================END BODY====================-->
			</div>
			<div class="modal-footer">
				<input type="submit" name="submit_lpf" class="btn btn-custom-primary" id="edit_lpf_btn" style="color:#ff9900; border: 2px solid" value="Save Changes" disabled>
				<a href="" class="btn btn-default">Cancel</a>
			</div>
		</form>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function(event) {
		var $form = $('#edit_lpf'),
			origForm = $form.serialize();

		$("#edit_lpf_btn").click(function() {
			if($form.serialize() === origForm){
				alert('No changes have been made!');
				return false;
			}
		});

		$('#edit_lpf :input').on('change input', function() {
			$('.change-message').toggle($form.serialize() !== origForm);
			$('#edit_lpf_btn').prop('disabled', $form.serialize() === origForm);
		});
	});
</script>