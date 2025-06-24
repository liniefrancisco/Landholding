<div class="container">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel" style="border-radius:9px;" id="print-nf">
			<!--====================BODY====================-->
			<?php echo form_open('Payment/view_inprogress/'.$is_no,array('id' => "edit_nf")); ?>
				<div class="row form-inline text-center space">
					<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="120px" height="35px">
					<div class="change-message">*You have unsaved changes.</div>
					<div class="form-inline space" style="font-weight:bold">
						<label>₱</label>
						<input type="text" class="form-control inb" id="notarial_fee" name="notarial_fee" value="<?php echo empty($fp_info1['notarial_fee']) ? '' : number_format($fp_info1['notarial_fee'],2); ?>">- NOTARIAL FEE FOR ATTY. URBANO H. LAGUNAY
					</div>
				</div><br/>

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
				<input type="submit" name="submit_nf" class="btn btn-custom-primary" id="edit_nf_btn" style="color:#ff9900; border:2px solid" value="Save Changes" disabled>
				<a href="" class="btn btn-default">Cancel</a>
			</div>
		</form>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function(event) {
		var $form = $('#edit_nf'),
			origForm = $form.serialize();

		$("#edit_nf_btn").click(function() {
			if($form.serialize() === origForm){
				alert('No changes have been made!');
				return false;
			}
		});

		$('#edit_nf :input').on('change input', function() {
			$('.change-message').toggle($form.serialize() !== origForm);
			$('#edit_nf_btn').prop('disabled', $form.serialize() === origForm);
		});
	});
</script>