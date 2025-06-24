<?php foreach($crf1 as $data):?>
	<!-- ACQUISITION CRF -->
	<div class="modal fade" id="ViewAcquisitionCRF_<?= $data['control_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h5 class="fa fa-info"> CRF</h5>
				</div>
				<!--====================BODY====================-->
				<div class="modal-body">  
					<div class="row text-center">
						<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="120px" height="35px">
						<h4 class="modal-title1" style="margin-top:-1px">CHEQUE REQUEST FORM</h4>
						<h5 style="margin-top:-8px;font-family:Times New Roman"><?= $data['pr_type'] ?></h5>
					</div>
					
					<div class="x_panel" style="border-radius:10px">
						<div class="col-md-12 space">
							<label class="col-md-2">CRF #<b style="float:right">:</b></label>
							<div class="col-md-3">
								<input type="text" class="form-control inb" value="<?php echo $data['crf_no'] ?>" readonly>
							</div>
							<div class="col-md-3"></div>
							<label class="col-md-1">Date<b style="float:right">:</b></label>
							<div class="col-md-3">
								<input type="text" class="form-control inb" value="<?php echo date("F d, Y") ?>"  readonly>
							</div>
						</div>

						<div class=" col-md-12">
							<label class="col-md-2">Pay to<b style="float:right">:</b></label>
							<div class="col-md-10" >
								<input  type="text" class="form-control inb" value="<?php echo $data['pay_to'] ?>" readonly>
							</div>
						</div> 

						<div class=" col-md-12">
							<label class="col-md-2">Amount in Figure<b style="float:right">:</b></label>
							<div class="col-md-10" >
								<input type="text" class="form-control inb" value="₱ <?php echo number_format($data['amount'],2); ?>" readonly>
							</div>
						</div> 

						<div class=" col-md-12">
							<label class="col-md-2">Amount in Words<b style="float:right">:</b></label>
							<div class="col-md-10">
								<?php $this->load->helper('custom'); ?>
								<input type="text" value="<?php echo number_to_words($data['amount']); ?> Pesos" style="color:#ff6600" class="form-control inb" readonly>
							</div>
						</div> 

						<div class="col-md-12">
							<div class="col-md-2"></div>
							<div class="col-md-4">
								<input type="text" class="form-control inb text-center" value="<?php echo $data['bank'] ?>" readonly>
								<center><label>Bank</label></center>
							</div>
							<div class="col-md-3">
								<input type="text" class="form-control inb text-center" value="<?php echo $data['cheque_no'] ?>" readonly>
								<center><label>Cheque No.</label></center> 
							</div>
							<div class="col-md-3">
								<input type="text" class="form-control inb text-center"  value="<?php $date_r = date_create($data['cheque_date']); echo date_format($date_r, "F d, Y"); ?>" readonly>
								<center><label>Cheque Date</label></center> 
							</div>
						</div>
														
						<div class="col-md-12 space">
							<label class="col-md-2">Attach File<b style="float:right">:</b></label>
						    <div class="col-md-10">
								<?php if (!empty($data['filename']) && !empty($data['is_no'])) { 
									$prefix = substr($data['is_no'], 0, 2);
									if ($prefix === "NA") {
										$folder = 'uploaded_documents';
									} elseif ($prefix === "ES") {
										$folder = 'es_uploads';
									} elseif ($prefix === "JS") {
										$folder = 'js_uploads';
									} else {
										$folder = 'other_uploads'; // fallback
									}
									$crf = base_url('assets/img/' . $folder . '/' . $data['is_no'] . '/CRF/' . $data['filename']);
								?>
									<button class='btn btn-default' onclick="viewImage('<?php echo $crf; ?>')">View File <span class="glyphicon glyphicon-folder-open text-info"></span></button>
								<?php } ?>
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
	<!-- ASPAYMENT CRF -->
	<div class="modal fade" id="ViewAspaymentCRF_<?= $data['is_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h5 class="fa fa-info"> CRF <b style="color:#eb5d0c"><?php echo $data['is_no'] ?></b></h5>
				</div>
				<!--====================BODY====================-->
				<div class="modal-body">  
					<div class="row text-center">
						<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="150px" height="50px">
						<h5 style="font-family:Times New Roman;font-weight:bold;letter-spacing:3px">CHEQUE REQUEST FORM</h5>
						<h5 style="margin-top:-8px;font-family:Times New Roman"><?= $data['pr_type'] ?></h5>
					</div>
					
					<div class="x_panel" style="border-radius:10px">
						<div class="col-md-12 space">
							<label class="col-md-2">CRF #<b style="float:right">:</b></label>
							<div class="col-md-3">
								<input type="text" class="form-control inb" value="<?php echo $data['crf_no'] ?>" readonly>
							</div>
							<div class="col-md-3"></div>
							<label class="col-md-1">Date<b style="float:right">:</b></label>
							<div class="col-md-3">
								<input type="text" class="form-control inb" value="<?php echo date("F d, Y") ?>"  readonly>
							</div>
						</div>

						<div class=" col-md-12">
							<label class="col-md-2">Pay to<b style="float:right">:</b></label>
							<div class="col-md-10" >
								<input  type="text" class="form-control inb" value="<?php echo $data['pay_to'] ?>" readonly>
							</div>
						</div> 

						<div class=" col-md-12">
							<label class="col-md-2">Amount in Figure<b style="float:right">:</b></label>
							<div class="col-md-10" >
								<input type="text" class="form-control inb" value="₱ <?php echo number_format($data['amount'],2); ?>" readonly>
							</div>
						</div> 

						<div class=" col-md-12">
							<label class="col-md-2">Amount in Words<b style="float:right">:</b></label>
							<div class="col-md-10">
								<?php $this->load->helper('custom'); ?>
								<input type="text" value="<?php echo number_to_words($data['amount']); ?> Pesos" style="color:#ff6600" class="form-control inb" readonly>
							</div>
						</div> 

						<div class="col-md-12">
							<div class="col-md-2"></div>
							<div class="col-md-4">
								<input type="text" class="form-control inb text-center" value="<?php echo $data['bank'] ?>" readonly>
								<center><label>Bank</label></center>
							</div>
							<div class="col-md-3">
								<input type="text" class="form-control inb text-center" value="<?php echo $data['cheque_no'] ?>" readonly>
								<center><label>Cheque No.</label></center> 
							</div>
							<div class="col-md-3">
								<input type="text" class="form-control inb text-center"  value="<?php $date_r = date_create($data['cheque_date']); echo date_format($date_r, "F d, Y"); ?>" readonly>
								<center><label>Cheque Date</label></center> 
							</div>
						</div>
														
						<div class="col-md-12 space">
							<label class="col-md-2">Attach File<b style="float:right">:</b></label>
						    <div class="col-md-10">
								<?php if (!empty($data['filename']) && !empty($data['is_no'])) { 
									$prefix = substr($data['is_no'], 0, 2);
									if ($prefix === "NA") {
										$folder = 'uploaded_documents';
									} elseif ($prefix === "ES") {
										$folder = 'es_uploads';
									} elseif ($prefix === "JS") {
										$folder = 'js_uploads';
									} else {
										$folder = 'other_uploads'; // fallback
									}
									$crf = base_url('assets/img/' . $folder . '/' . $data['is_no'] . '/CRF/' . $data['filename']);
								?>
									<button class='btn btn-default' onclick="viewImage('<?php echo $crf; ?>')">View File <span class="glyphicon glyphicon-folder-open"></span></button>
								<?php } ?>
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