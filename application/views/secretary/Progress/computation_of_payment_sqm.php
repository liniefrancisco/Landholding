<div class="container">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel" style="border-radius:9px;" id="print-cop"> 
			<!--====================BODY====================-->
			<?php echo form_open('Payment/view_inprogress/'.$is_no,array('id' => "edit_cop")); ?>

				<div class="row text-center" style="margin-top: 20px;">
					<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="120px" height="35px">
					<h5 style="text-decoration:underline;text-transform:uppercase;font-weight:bold;padding-top:10px">PAYMENT OF A PARCEL OF LAND SITUATED AT <?php echo $ll['baranggay']?>, <?php echo $ll['municipality']?>, <?php echo $ll['province']?></h5>
				</div>

				<center><div class="change-message">*You have unsaved changes.</div></center><br/>
				<input type="hidden" name="is_no" value="<?php echo $is_no?>">

				<div class="form-inline col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-1"></div>
					<div class="col-md-5">
						<label>NAME OF LOT OWNER:</label>
						<span>
							<?php echo (!empty($oi['firstname'])) ? $oi['firstname'] : ''; ?>
							<?php echo (!empty($oi['middlename'])) ? $oi['middlename'] : ''; ?>
							<?php echo (!empty($oi['lastname'])) ? $oi['lastname'] : ''; ?>
						</span>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-5">
						<label>LOCATION:</label>
						<span>
							<?php echo (!empty($ll['baranggay'])) ? $ll['baranggay'] . ', ' : ''; ?>
							<?php echo (!empty($ll['municipality'])) ? $ll['municipality'] . ', ' : ''; ?>
							<?php echo (!empty($ll['province'])) ? $ll['province'] : ''; ?>
						</span>
					</div>
				</div>

				<div class="form-inline col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-1"></div>
					<div class="col-md-5">
						<label>LOT NUMBER:</label>
						<span><?php echo empty($li['lot']) ? '' : $li['lot']; ?></span>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-5">
						<label>TITLE/TAX DEC.NO.:</label>
						<span>
							<?php
								$landTitleNo = $li['land_title_no'];
								$taxDecNo = $li['tax_dec_no'];

								if (!empty($landTitleNo) && !empty($taxDecNo)) {
									echo $landTitleNo . ' / ' . $taxDecNo;
								} else if (!empty($landTitleNo)) {
									echo $landTitleNo;
								} else if (!empty($taxDecNo)) {
									echo $taxDecNo;
								} else {
									echo "None";
								}
							?>
						</span>
					</div>
				</div>

				<div class="form-inline col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-1"></div>
					<div class="col-md-5">
						<label>WHOLE AREA:</label>
						<span><?php echo empty($li['lot_size']) ? '' : number_format($li['lot_size'],2); ?> square meters, more or less</span>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-5">
						<label>PRICE:</label>
						<span>₱<?php echo empty($li['price_per_sqm']) ? '' : number_format($li['price_per_sqm'],2); ?> per square meter</span>
					</div>
				</div>

				<div class="form-inline col-md-12 col-sm-12 col-xs-12" style="margin-top:30px;">
					<h5 style="font-weight:bold;text-align:center">COMPUTATION OF PAYMENT</h5>
				</div>

				<div class="form-inline col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
					<div class="col-md-3"></div>
					<div class="col-md-2">
						<label>Area</label>
					</div>

					<div class="col-md-7">
						<div class="col-md-3">
							<span><?php echo empty($li['lot_size']) ? '' : number_format($li['lot_size'],2); ?></span>
						</div>
						<div class="col-md-4">
							<span>square meters</span>
						</div>
					</div>
				</div>

				<div class="form-inline col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-3"></div>
					<div class="col-md-2">
						<label>Times Price</label>
					</div>

					<div class="col-md-7">
						<div class="col-md-3">
							<span>x <?php echo empty($li['price_per_sqm']) ? '' : number_format($li['price_per_sqm'],2); ?></span>
						</div>
						<div class="col-md-4">
							<span>per square meters</span>
						</div>
					</div>
				</div>

				<div class="form-inline col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-3"></div>
					<div class="col-md-2"></div>

					<div class="col-md-7">
						<div class="col-md-3" style="border-top: 1px solid #494F55"></div>
						<div class="col-md-4"></div>
					</div>
				</div>

				<div class="form-inline col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<h5 style="font-weight:bold;text-align:center">TOTAL PURCHASE PRICE</h5>
					</div>

					<div class="col-md-5">
						<h5 id="result"></h5>
					</div>
				</div>

				<div class="form-inline col-md-12 col-sm-12 col-xs-12"style="margin-top:40px;">
					<div class="col-md-1"></div>
					<div class="col-md-5">
						<label>CHECKS/PAYEES :</label>
						<span><b>
							<?php echo (!empty($oi['firstname'])) ? $oi['firstname'] : ''; ?>
							<?php echo (!empty($oi['middlename'])) ? $oi['middlename'] : ''; ?>
							<?php echo (!empty($oi['lastname'])) ? $oi['lastname'] : ''; ?>
						</span></b>
					</div>
					<div class="col-md-1"></div>
					<span id="result1"></span>
					<span style="font-weight:bold">- dated - <?php echo date('F j, Y'); ?></span>
				</div>

				<div class="form-inline col-md-12 col-sm-12 col-xs-12" style="margin-top:40px">
					<div class="col-md-1"></div>
					<div class="col-md-11">
					 <span style="font-weight:bold">NOTE :</span>
					</div>
				</div>

				<div class="form-inline col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-1"></div>
					<div class="col-md-11">
						<textarea class="form-control" name="note" placeholder="Type Here..." rows="5" style="max-width:100%;width:100%"><?php echo (!empty($fp_info1['note'])) ? $fp_info1['note'] : ''; ?></textarea>
					</div>
				</div>
				
			</div>
				
			<!--====================END BODY====================-->
			<div class="modal-footer">
				<input type="submit" name="submit_cop" class="btn btn-custom-primary" id="edit_cop_btn" style="color:#ff9900; border:2px solid" value="Save Changes" disabled>
				<a href="" class="btn btn-default">Cancel</a>
			</div>
		</form>
	</div>
</div>


<script>//Script for TOTAL PURCHASE PRICE
	// Get the area and price per square meter values
	var area = <?php echo empty($li['lot_size']) ? 0 : $li['lot_size']; ?>;
	var pricePerSqMeter = <?php echo empty($li['price_per_sqm']) ? 0 : $li['price_per_sqm']; ?>;

	// Calculate the total purchase price
	var totalPrice = area * pricePerSqMeter;

	// Format the total price with commas for thousands separators and ".00" for decimals
		var formattedTotalPrice = new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP', minimumFractionDigits: 2 }).format(totalPrice);

	// Update the "result" element with the calculated total purchase price
	document.getElementById('result').innerHTML = '<strong>' + formattedTotalPrice + '</strong>';
	document.getElementById('result1').innerHTML = '- <strong>' + formattedTotalPrice + '</strong>';
</script>

<script>
	document.addEventListener("DOMContentLoaded", function(event) {
		var $form = $('#edit_cop'),
			origForm = $form.serialize();

		$("#edit_cop_btn").click(function() {
			if($form.serialize() === origForm){
				alert('No changes have been made!');
				return false;
			}
		});

		$('#edit_cop :input').on('change input', function() {
			$('.change-message').toggle($form.serialize() !== origForm);
			$('#edit_cop_btn').prop('disabled', $form.serialize() === origForm);
		});
	});
</script>