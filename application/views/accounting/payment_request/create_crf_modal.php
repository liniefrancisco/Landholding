<?php foreach($pr_approved as $data):?>
<div class="modal fade" id="crf_<?= $data['control_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" id="dclose" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span></button>
				<h5><i class="fa fa-edit"></i> Fill in the Form <u><?php echo $data['pr_is_no'] ?></u></h5>
			</div>
			<!--==========BODY==========-->
			<?php echo form_open('Payment/submit_crf/' . $data['control_no'] . '/' . $data['pr_is_no'] . '/' . $data['pr_type']); ?>
				<div class="modal-body" style="border-radius: 5px;" > 
					<center>
						<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
						<h5 style="font-family:Times New Roman">ALTURAS SUPERMARKET CORPORATION</h5>
						<h5 style="margin-top:-8px;font-family:Times New Roman">B. Inting Street, Tagbilaran City</h5>
						<h4 style="margin-top:-8px;font-family:Times New Roman;font-weight:bold;letter-spacing:3px">CHEQUE REQUEST FORM</h4>
						<h5 style="margin-top:-8px;font-family:Times New Roman;"><?= $data['pr_type'] ?></h5>
					</center>

					<?php 
						$latest_crf_no = $this->Payment_model->get_latest_crf_no();
					    $new_crf_no = "CRF-0001";
					    if (!empty($latest_crf_no)) {
					        // Extract the numeric part of the latest crf_no
					        $max_id = (int) substr($latest_crf_no, 4);
					        // Increment the numeric part
					        $new_id = $max_id + 1;
					        // Format the new id with leading zeros
					        if ($new_id < 10) {
					            $new_crf_no = "CRF-000" . $new_id;
					        } elseif ($new_id < 100) {
					            $new_crf_no = "CRF-00" . $new_id;
					        } elseif ($new_id < 1000) {
					            $new_crf_no = "CRF-0" . $new_id;
					        } else {
					            $new_crf_no = "CRF-" . $new_id;
					        }
					    }
					?>

					<div class="x_panel" style="border-radius:10px;background:#E6E9ED">
						<input type="hidden" name="is_no" value="<?=$data['pr_is_no']; ?>" class="form-control inb" readonly>
						<div class="col-md-12 space">
							<label class="col-md-2">CRF #<b style="float:right">:</b></label>
							<div class="col-md-3">
								<input type="text" class="form-control inb" name="crf_no" value="<?php echo $new_crf_no; ?>" readonly>
							</div>
							<div class="col-md-3"></div>
							<label class="col-md-1">Date<b style="float:right">:</b></label>
							<div class="col-md-3">
								<input type="text" class="form-control inb" value="<?php echo date("F d, Y") ?>" name="date_requested" readonly>
							</div>
						</div>

						<div class=" col-md-12 space">
							<label class="col-md-2">Pay to<b style="float:right">:</b></label>
							<div class="col-md-10 col-xs-10 col-sm-10" >
								<input  type="text" class="form-control inb" name="pay_to" value="<?php echo $data['firstname'] ?> <?php echo $data['middlename'] ?> <?php echo $data['lastname'] ?>"  readonly>
							</div>
						</div> 

						<div class=" col-md-12 space">
							<label class="col-md-2">Amount in Figure<b style="float:right">:</b></label>
							<div class="col-md-10 col-xs-10 col-sm-10" >
								<input type="text" class="form-control inb" name="r_amount" value="₱ <?php echo number_format($data['pr_amount'],2); ?>" readonly>
							</div>
						</div> 

						<div class=" col-md-12 space">
							<label class="col-md-2">Amount in Words<b style="float:right">:</b></label>
							<div class="col-md-10 col-xs-10 col-sm-10" >
								<?php $this->load->helper('custom'); ?>
								<input type="text" name="amount_words" value="<?php echo number_to_words($data['pr_amount']); ?> Pesos" style="color:#ff6600" class="form-control input_border" readonly>
							</div>
						</div> 
									
						<div class="col-md-12 col-xs-12 col-sm-12"><br/>
							<div class="col-md-2 col-sm-2 col-xs-2"></div>
							<div class="col-md-4 col-sm-4 col-xs-4">
								<input type="text" class="form-control inb txt_cent"  name="bank"required>
								<center><label>Bank</label></center>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3">
								<input type="text" class="form-control inb txt_cent" name="cheque_no" required>
								<center><label>Cheque No.</label></center> 
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3">
								<input type="date" class="form-control inb txt_cent" value="<?php echo date("F d, Y"); ?>" name="cheque_date" required>
								<center><label>Cheque Date</label></center> 
							</div>
						</div>

						<div class="div6 col-md-12 col-xs-12 col-sm-12"><br/>
							<div class="col-md-2 col-xs-2 col-sm-2 " >
								<label>Attach File:</label> 
							</div>
							<div class="col-md-10 col-xs-10 col-sm-10" >
								<input type="file" class="form-control" name="attachments[]" id="attachments" multiple>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="submit_crf_ca" class="btn btn-success btn-lg"> Save</button>
					<button type="button" class="btn btn-lg btn-default" data-dismiss="modal">Close</button>
				</div>         
			</form>
		</div>
	</div>
</div>
<?php endforeach; ?>