<script src='<?= base_url() ?>resources/tinymce/tinymce.min.js'></script>
<div class="container">
  	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel" style="border-radius: 9px;"><br/>
			<?= form_open_multipart('Payment/view_inprogress/'.$is_no); ?> 
	  			<!--====================BODY====================-->
				<div class="col-md-12 col-sm-12 col-xs-12 space">
				  	<center><img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
						<h4><b>ACKNOWLEDGEMENT RECEIPT</b></h4>
				  	</center>

				  	<textarea class="form-control editor" id="receiptTextarea" name="receipt_file" style="max-width: 100%" rows="15" placeholder="Type Here...">
						<?php if (!empty($ar)) : ?>
							<?= htmlspecialchars($ar); ?>
						<?php else : ?>
							This is to acknowledge receipt the amount of ____________________(₱__________), Philippine Currency, from ____________________, Filipino, of legal age, married to ____________________, and a resident of ____________________, as entire payment of a parcel of land designated as Lot No. <?= empty($li['lot']) ? '' : $li['lot']; ?>, containing an area of <?= empty($li['lot_size']) ? '' : $li['lot_size']; ?> square meters, more or less situated at <?= empty($ll['street']) ? '' : $ll['street']; ?>- <?= empty($ll['baranggay']) ? '' : $ll['baranggay']; ?>, <?= empty($ll['municipality']) ? '' : $ll['municipality']; ?>, <?= empty($ll['province']) ? '' : $ll['province']; ?>, covered by <?= empty($li['tax_dec_no']) ? '' : 'declaration No. ' . $li['tax_dec_no']; ?> <?= empty($li['land_title_no']) ? '' : 'title No. ' . $li['land_title_no']; ?> declared in the name of ____________________.<br/><br/>

							Done this __________th day of, <?= date('Y'); ?> at Tagbilaran City, Bohol, Philippines.<br/><br/>

							Type Name Here<br/>
							Heir- Vendor<br/>
							ID No.______________<br/><br/><br/>

							SIGNED IN THE PRESENCE OF: ____________________<br/><br/>

							SUBSCRIBED AND SWORN TO BEFORE ME, this __________th day of <?= date('F, Y'); ?> at Tagbilaran City, Bohol, Philippines.
						<?php endif; ?>
				  	</textarea>
				</div>
	  			<!--====================END BODY====================-->
			</div>
			<div class="modal-footer">
				<?php
				  	$existing_data 		= $this->Payment_model->check_acknowledgement_receipt($is_no);
				  	$button_text 		= $existing_data ? 'Update' : 'Submit';
				  	$no_data_message 	= empty($existing_data) ? 'No data available. Please submit new data.' : '';
				?>
				<button style="float:right" class="btn btn-custom-primary" name="submit_ar" id="submitReceiptButton"><?= $button_text; ?></button>
				<a href="" class="btn btn-default">Cancel</a>
			</div>
		<?= form_close(); ?>
  	</div>
</div>


<script>
  	tinymce.init({ 
		selector:'.editor',
		theme: 'modern',
		height:600
  	});
</script>