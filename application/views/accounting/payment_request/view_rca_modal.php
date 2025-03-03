<?php foreach($pr_approved as $data): ?>
<div class="modal fade" id="view_rca_<?= $data['control_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" id="dclose" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span></button>
				<h5><i class="fa fa-file"></i> RCA <u><?php if($data['is_no']){ echo $data['is_no']; } ?></u></h5>
			</div>
			<!--====================BODY====================-->
			<div class="modal-body"> 
				<center><img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
					<h5 style="font-family:Times New Roman">ALTURAS SUPERMARKET CORPORATION</h5>
					<h5 style="margin-top:-8px;font-family:Times New Roman">B. Inting Street, Tagbilaran City</h5>
					<h4 style="margin-top:-8px;font-family:Times New Roman;font-weight:bold;letter-spacing:3px">REQUEST CASH ADVANCE</h4>
				</center>
				
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-12 form-inline">
							<label class="col-md-2">Date Requested <b style="float: right;">:</b></label> 
							<span><?php echo $data['submission_date']?></span>  
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-12 form-inline">
							<label class="col-md-2">CA Control No. <b style="float: right;">:</b></label>   
							<span><?php echo $data['control_no']?></span>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-12 form-inline">
							<label class="col-md-2">Amount in Figure <b style="float: right;">:</b></label>   
							<span>₱<?php echo number_format($data['amount'],2)?></span>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-12 form-inline">
							<label class="col-md-2">Amount in Words <b style="float: right;">:</b></label>   
							<?php $this->load->helper('custom'); ?>
							<span style="color:#ff6600"><?php echo number_to_words($data['amount'],2)?> Pesos</span>
						</div>
					</div>

					<div class="col-md-12"><br/>
						<div class="col-md-12 form-inline">
							<p class="paragrap">
								Cash Advance for Lot. <b class="txt"><?php echo $data['lot'];?></b>,
								Cad. <b class="txt"><?php echo $data['cad'] ?></b>,
								located at <b class="txt"><i><?php echo $data['street'] ?>, <?php echo $data['baranggay']?>, <?php echo $data['municipality']?>, <?php echo $data['province']?></i></b>,
								with an area of approximately <b class="txt"><?php echo number_format($data['lot_size'],2) ?></b> (Sq/meter) square meters, under Original Certificate Title No. <b class="txt"><?php echo $data['land_title_no'] ?></b>
								/ Tax Declaration No. <b class="txt"><?php echo $data['tax_dec_no'] ?></b>, 
								in the name of <b class="txt"><i><?php echo ucfirst($data['firstname']) ?> <?php echo ucfirst($data['middlename']) ?> <?php echo ucfirst($data['lastname']) ?></i></b>.
							</p>
						</div>
					</div>

					<div class="col-md-12 col-xs-12 col-sm-12">
						<div class="row" style="border: 2px solid rgba(128, 128, 128, 0.33);">
							<div class="form-group">
								<label class="control-label col-md-3">Purpose *</label>
								<div class="form-horizontal col-md-9">
									<?php 
										$purposesFull=array('Personal','Affidavit of Surrender of Landholdings','Capital Gains Tax','Estate Tax','Notary Fee','Real Property Tax','Documentary Stamp Tax');
										$purposesFromDB= $data['purpose'];
										$purposesFromDBArray=explode(', ',$purposesFromDB);
										foreach($purposesFull as $item){
											$checked = in_array($item,$purposesFromDBArray) ? 'checked' : 'disabled';
											echo '<input type="checkbox" name="purs[]"'.$checked.'>'.$item;
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
			</div>
			<!--====================END BODY====================-->
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php endforeach; ?>