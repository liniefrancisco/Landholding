<div class="container">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel" style="border-radius:9px;" id="print-cop"> 
			<!--====================BODY====================-->
			<?php echo form_open('Payment/view_inprogress/'.$is_no,array('id' => "edit_cop")); ?>
				<input type="hidden" name="is_no" value="<?php echo $is_no?>">
				<center style="margin-top: 20px;"><img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
					<h5 style="text-decoration:underline;text-transform:uppercase;font-weight:bold;padding-top:10px">PAYMENT OF A PARCEL OF LAND SITUATED AT <?php echo $ll['baranggay']?>, <?php echo $ll['municipality']?>, <?php echo $ll['province']?></h5>
				</center>

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
						<label>TOTAL PURCHASE PRICE:</label>
						<span>₱<?php echo empty($li['total_price']) ? '' : number_format($li['total_price'],2); ?> package</span>
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
					<div class="col-md-5">
						<span style="font-weight:bold">- ₱<?php echo empty($li['total_price']) ? '' : number_format($li['total_price'],2); ?></span>
						<span style="font-weight:bold">- dated - <?php echo date('F j, Y'); ?></span>
					</div>
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
						<textarea class="form-control" name="note" placeholder="Type Here..." rows="5" style="max-width:100%;width:100%"><?php echo (!empty($getpr_byid_byfp_row['note'])) ? $getpr_byid_byfp_row['note'] : ''; ?></textarea>
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