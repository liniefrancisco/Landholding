<?php foreach($pr_approved as $data):?>
<div class="modal fade" id="view_crf_modal_<?= $data['control_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" id="dclose" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span></button>
				<h5><i class="fa fa-file"></i> CRF <u><?php if($data['is_no']){ echo $data['is_no']; } ?></u></h5>
			</div>
			<!--====================BODY====================-->
			<div class="modal-body">  
				<center>
					<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
					<h5 style="font-family:Times New Roman">ALTURAS SUPERMARKET CORPORATION</h5>
					<h5 style="margin-top:-8px;font-family:Times New Roman">B. Inting Street, Tagbilaran City</h5>
					<h4 style="margin-top:-8px;font-family:Times New Roman;font-weight:bold;letter-spacing:3px">CHEQUE REQUEST FORM</h4>
					<p style="margin-top:-10px;font-family:Times New Roman;letter-spacing:2px"><?php echo $data['pr_type'] ?></p>
				</center><br/>
				
				<div class="x_panel" style="border-radius:10px;background:#E6E9ED">
					<div class="col-md-12 space">
						<label class="col-md-2">CRF #<b style="float:right">:</b></label>
						<div class="col-md-3">
							<input type="text" class="form-control input_border"   value="<?php echo $data['crf_no'] ?>" readonly>
						</div>
						<div class="col-md-3"></div>
						<label class="col-md-1">Date<b style="float:right">:</b></label>
						<div class="col-md-3">
							<input type="text" class="form-control input_border" value="<?php echo date('F d, Y', strtotime($data['submission_date'])); ?>"  readonly>
						</div>
					</div>

					<div class=" col-md-12 space5">
						<label class="col-md-2">Pay to<b style="float:right">:</b></label>
						<div class="col-md-10 col-xs-10 col-sm-10" >
							<input  type="text" class="form-control input_border" name="pay_to" value="<?php echo $data['pay_to'] ?>" readonly>
						</div>
					</div> 

					<div class=" col-md-12 space5">
						<label class="col-md-2">Amount in Figure<b style="float:right">:</b></label>
						<div class="col-md-10 col-xs-10 col-sm-10" >
							<input type="text" class="form-control input_border" name="r_amount" value="₱ <?php echo number_format($data['amount'],2); ?>" readonly>
						</div>
					</div> 

					<div class=" col-md-12 space5">
						<label class="col-md-2">Amount in Words<b style="float:right">:</b></label>
						<div class="col-md-10 col-xs-10 col-sm-10" >
							<?php $this->load->helper('custom'); ?>
							<input type="text" name="amount_words" value="<?php echo number_to_words($data['amount']); ?> Pesos" style="color:#ff6600" class="form-control input_border" readonly>
						</div>
					</div> 

					<div class="col-md-12 space5">
						<div class="col-md-2 col-sm-2 col-xs-2"></div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<input type="text" class="form-control input_border txt_cent"  name="bank" value="<?php echo $data['bank'] ?>" readonly>
							<center><label>Bank</label></center>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input type="text" class="form-control input_border txt_cent" name="cheque_no" value="<?php echo $data['cheque_no'] ?>" readonly>
							<center><label>Cheque No.</label></center> 
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input type="text" class="form-control input_border txt_cent"  value="<?php $date_r = date_create($data['cheque_date']); echo date_format($date_r, "F d, Y"); ?>" readonly>
							<center><label>Cheque Date</label></center> 
						</div>
					</div>
													
					<div class="col-md-12 space5"><br/>
						<div class="col-md-2 col-xs-2 col-sm-2 " >
							<label>Attach File:</label> 
						</div>
						<div class="col-md-10 col-xs-10 col-sm-10" >   
						</div>
					</div> 
				</div>  
			</div>
			<!--====================END BODY====================-->
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php endforeach; ?>