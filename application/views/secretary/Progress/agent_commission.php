<div class="container">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel" style="border-radius:9px;" id="print-ac"> 
			<!--====================BODY====================-->
			<?php echo form_open('Payment/view_inprogress/'.$is_no,array('id' => "edit_ac")); ?>
				<input type="hidden" name="is_no" value="<?php echo $is_no?>">
				<center style="margin-top: 20px;">
					<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
					<div class="form-inline col-md-12 col-sm-12 col-xs-12" style="text-align:center">
						<h5 style="text-transform:uppercase;font-weight:bold;padding-top:10px">AGENT COMMISSION</h5>
						<h5 style="text-transform:uppercase;font-weight:bold;padding-top:10px"><label>₱</label><input type="text" class="form-control inb" id="commission_fee" name="commission_fee" value="<?php echo empty($getpr_fp['commission_fee']) ? '' : number_format($getpr_fp['commission_fee'],2); ?>">-
							PAY TO
							<?php echo (!empty($bi['firstname'])) ? $bi['firstname'] : ''; ?>
							<?php echo (!empty($bi['middlename'])) ? $bi['middlename'] : ''; ?>
							<?php echo (!empty($bi['lastname'])) ? $bi['lastname'] : ''; ?>
						</h5>
					</div>
				</center>

				<div class="form-inline col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
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
									echo "No title or tax declaration available";
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
						<?php if ($li['price_per_sqm'] != 0.00): ?>
							<label>PRICE:</label>
							<span>₱<?php echo number_format($li['price_per_sqm'], 2); ?> per square meter</span>
						<?php else: ?>
							<label>TOTAL PURCHASE PRICE:</label>
							<span>₱<?php echo empty($li['total_price']) ? '' : number_format($li['total_price'], 2); ?></span>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-inline col-md-12 col-sm-12 col-xs-12" style="margin-bottom:50px">
					<div class="col-md-1"></div>
					<div class="col-md-5">
						<?php if ($li['price_per_sqm'] != 0.00): ?>
							<label>TOTAL PURCHASE PRICE:</label>
							<span>₱<?php echo empty($li['total_price']) ? '' : number_format($li['total_price'],2); ?></span>
						<?php endif; ?>
					</div>
				</div>
				<!--====================END BODY====================-->
			</div>
			<div class="modal-footer">
				<input type="submit" name="submit_ac" class="btn btn-custom-primary" id="edit_ac_btn" style="color:#ff9900; border: 2px solid" value="Save Changes" disabled>
				<a href="" class="btn btn-default">Cancel</a>
			</div>
		</form>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function(event) {
		var $form = $('#edit_ac'),
			origForm = $form.serialize();

		$("#edit_ac_btn").click(function() {
			if($form.serialize() === origForm){
				alert('No changes have been made!');
				return false;
			}
		});

		$('#edit_ac :input').on('change input', function() {
			$('.change-message').toggle($form.serialize() !== origForm);
			$('#edit_ac_btn').prop('disabled', $form.serialize() === origForm);
		});
	});
</script>