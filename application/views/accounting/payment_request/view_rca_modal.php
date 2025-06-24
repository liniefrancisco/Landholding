<?php foreach($rca as $data):?>
	<div class="modal fade" id="view_rca_<?= $data['control_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h6 class="fa fa-info"> RCA</h6>
				</div>
				<!--====================BODY====================-->
				<div class="modal-body"> 
					<div class="row text-center">
						<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="120px" height="35px">
						<h4 class="modal-title1" style="margin-top:-1px">REQUEST CASH ADVANCE</h4>
					</div>
					
					<div class="row">
						<div class="col-md-12 space">
							<label class="col-md-2">Date Requested <b style="float:right">:</b></label>
							<div class="col-md-10">
								<input type="text" class="form-control inb" value="<?php echo $data['pr_submission_date'] ?>" readonly>
							</div>
						</div>
						<div class="col-md-12">
							<label class="col-md-2">CA Control No. <b style="float:right">:</b></label>
							<div class="col-md-10">
								<input type="text" class="form-control inb" value="<?php echo $data['control_no'] ?>" readonly>
							</div>
						</div>
						<div class="col-md-12">
							<label class="col-md-2">Amount in Figure <b style="float:right">:</b></label>
							<div class="col-md-10">
								<input type="text" class="form-control inb" value="₱<?php echo number_format($data['pr_amount'],2)?>" readonly>
							</div>
						</div>
						<div class="col-md-12">
							<label class="col-md-2">Amount in Words <b style="float:right">:</b></label>
							<div class="col-md-10">
								<?php $this->load->helper('custom'); ?>
								<input type="text" class="form-control inb" value="<?php echo number_to_words($data['pr_amount'],2)?> Pesos" style="color:#ff6600" readonly>
							</div>
						</div>
						<div class="col-md-12 space">
							<p class="col-md-12">
								Cash Advance for Lot. <b class="txt"><?php echo $data['lot'];?></b>,
								Cad. <b class="txt"><?php echo $data['cad'] ?></b>,
								located at <b class="txt"><i><?php echo $data['street'] ?>, <?php echo $data['baranggay']?>, <?php echo $data['municipality']?>, <?php echo $data['province']?></i></b>,
								with an area of approximately <b class="txt"><?php echo number_format($data['lot_size'],2) ?></b> (Sq/meter) square meters, under Original Certificate Title No. <b class="txt"><?php echo $data['land_title_no'] ?></b>
								/ Tax Declaration No. <b class="txt"><?php echo $data['tax_dec_no'] ?></b>, 
								in the name of <b class="txt"><i><?php echo ucfirst($data['firstname']) ?> <?php echo ucfirst($data['middlename']) ?> <?php echo ucfirst($data['lastname']) ?></i></b>.
							</p>
						</div>

						<div class="col-md-12 space">
							<div class="col-md-12 form-group" style="border: 2px solid rgba(128, 128, 128, 0.33);">
								<label class="col-md-3">Purpose *</label>
								<div class="col-md-9 form-horizontal">
									<?php 
										$purposesFull 			= array('Personal','Affidavit of Surrender of Landholdings','Capital Gains Tax','Estate Tax','Notary Fee','Real Property Tax','Documentary Stamp Tax');
										$purposesFromDB 		= $data['purpose'];
										$purposesFromDBArray 	= explode(', ',$purposesFromDB);

										foreach($purposesFull as $item){
											$checked = in_array($item,$purposesFromDBArray) ? 'checked' : 'disabled';
											echo '<input type="checkbox" name="purs[]"'.$checked.' disabled>'.$item;
											echo '<br/>';
										}
									?>
																			 
									<label class="control-label">Others *</label>
									<textarea  class="form-control col-md-3" style="margin-bottom:10px;max-width:100%" readonly><?php echo $data['other_purpose'] ?></textarea>
								</div>
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