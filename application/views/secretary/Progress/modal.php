<!--====================MODAL LAND TITLE====================-->       
<div class="modal animate bounceInUp land_title_<?php echo $li['is_no'];?>" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header bg-orange">
				<button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-text-o"></span> Land Title</h4>
			</div>
			<div class="modal-body">
				<div style="overflow-x:auto;">
					<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Land Title/'.$ud['land_title'].'') ?> " class="img-responsive">   
				</div>                                         
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!--====================MODAL TAX DECLERATION====================-->  
<div class="modal animate bounceInUp latest_tax_dec_<?php echo $li['is_no'];?>" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header bg-orange">
				<button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-text-o"></span> Latest Tax Declaration</h4>
			</div>
			<div class="modal-body">
				<div style="overflow-x:auto;">
					<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Tax Declaration/'.$ud['latest_tax_dec'].'') ?> " class="img-responsive">   
				</div>                                        
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!--====================MODAL LAND SKETCH====================-->                 
<div class="modal animate bounceInUp land_sketch_<?php echo $li['is_no'];?>" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header bg-orange">
				<button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-text-o"></span> Land Sketch</h4>
			</div>
			<div class="modal-body">
				<div style="overflow-x:auto;">
					<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Land Sketch/'.$ud['land_sketch'].'') ?> " class="img-responsive">   
				</div>               
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!--====================SHOW PURPOSE MODAL====================-->
<?php foreach($getpr_byid_byca_result as $ca){ ?>  
	<div class="modal animate bounceInUp show_all_p_<?php echo $ca['control_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" style="padding-top:150px">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" id="dclose" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span></button>
					<h4 class="modal-title" id="myModalLabel2"><i class="fa fa-info"></i> Cash Advance Purpose</h4>
				</div>
				<div class="modal-body">
					<?php echo "<h5 style='margin-left: 50px;'>".$ca['purpose']." ".$ca['other_purpose']."</h5>" ?>                            
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<!--====================CA REASON DISAPPROVAL MODAL====================-->
<?php
	if (!empty($getpr_byid_byca_result)) {
		foreach ($getpr_byid_byca_result as $ca) {
?>
	<div class="modal animate bounceInUp reason_disapproved_<?php echo $ca['control_no'];?>" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-red">
					<button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
					<h5 class="modal-title" id="myModalLabel"><span class="fa fa-file-text-o"></span> Reason Disapproved</h5>
				</div>
				<div class="modal-body">
					<span><?php echo $ca['reason_disapproved']?></span>                                        
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<?php }}?>
<!--====================REQUEST CASH ADVANCE MODAL====================-->
<div class="modal fade cash_advance modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg modal-responsive">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" id="dclose" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span></button>
				<h5 class="modal-title"><i class="fa fa-credit-card-alt"></i> <b>Cash Advance</b></h5>
			</div>

			<?php echo form_open('Payment/view_inprogress/'.$is_no.'',array('onsubmit' => "return validate_checkbox()")); ?>
				<div class="modal-body">
					<center>
						<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="45px">
						<h4 class="title_ca">REQUEST CASH ADVANCE</h4>
					</center>

					<div class="x_panel" style="border-radius:10px;background:#E6E9ED;">
						<input type="text" name="is_no" value="<?php echo $is_no ?>" hidden>

						<div class="col-md-12 space">
							<label class="col-md-3">Date Request <b style="float:right">:</b></label>
							<div class="col-md-9">
								<input type="text" class="form-control inb input_border" name="date_request" value="<?= date('M-d-Y');?>" readonly>
							</div>
						</div>

						<div class="col-md-12 space">
							<label class="col-md-3">CA Control No. <b style="float:right">:</b></label>
							<div class="col-md-9">
								<input type="text" class="form-control input_border" name="control_no" value="<?php echo $ca_id ?>" readonly>
							</div>
						</div>

						<div class="col-md-12 space">
							<label class="col-md-3">Amount in Figure <b style="float: right;">:</b></label>
							<div class="col-md-9">
								<input type="text" class="form-control input_border" id="amountInput" name="amount" placeholder="Enter Desired Amount" required>
							</div>
						</div>

						<div class="col-md-12 space">
							<label class="col-md-3">Amount in Words <b style="float: right;">:</b></label>  
							<div class="col-md-9">
								<span id="amountWords" style="text-decoration:underline;color:#ff6600;font-size:14px"></span>
							</div>
						</div>


						<div class="col-md-12 space"><br/>
							<p class="paragrap">
								Cash Advance for Lot. <b class="txt"><?php echo $li['lot'];?></b>,
								Cad. <b class="txt"><?php echo $li['cad'] ?></b>,
								located at <b class="txt"><i><?php echo $ll['street'] ?>, <?php echo $ll['baranggay']?>, <?php echo $ll['municipality']?>, <?php echo $ll['province']?></i></b>,
								with an area of approximately <b class="txt"><?php echo number_format($li['lot_size'],2) ?></b> (Sq/meter) square meters, under Original Certificate Title No. <b class="txt"><?php echo $li['land_title_no'] ?></b>
								/ Tax Declaration No. <b class="txt"><?php echo $li['tax_dec_no'] ?></b>, 
								in the name of <b class="txt"><i><?php echo ucfirst($oi['firstname']) ?> <?php echo ucfirst($oi['lastname']) ?></i></b>.
							</p>
						</div>
							

						<div class="col-md-12 col-xs-12 col-sm-12"><br/>
							<div class="row" style="border:1px solid rgba(128, 128, 128, 0.33);">
								<div class="form-group">
									<label class="control-label col-md-3">Purpose *</label>
									<div class="form-horizontal col-md-9" style="padding-bottom:10px">
										<input type="checkbox" name="purpose[]" id="purp" value="Personal">Personal<br>
										<input type="checkbox" name="purpose[]" id="purp" value="Affidavit of Surrender of Landholdings">Affidavit of Surrender of Landholdings<br>
										<input type="checkbox" name="purpose[]" id="purp" value="Capital Gains Tax">Capital Gains Tax<br>
										<input type="checkbox" name="purpose[]" id="purp" value="Estate Tax">Estate Tax<br>
										<input type="checkbox" name="purpose[]" id="purp" value="Notary Fee">Notary Fee<br>
										<input type="checkbox" name="purpose[]" id="purp" value="Real Property Tax">Real Property Tax<br>
										<input type="checkbox" name="purpose[]" id="purp" value="Documentary Stamp Tax">Documentary Stamp Tax<br>
										<label class="control-label">Others *</label>
										<textarea name="other_purp" id="other_p" class="form-control col-md-3" style="max-width:100%"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div> 
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button class="btn btn-custom-primary" name="submit_ca">Submit</button> 
				</div>
			</form>
		</div>
	</div>
</div>
<!--====================VIEW CASH ADVANCE MODAL====================-->
<?php
	if (!empty($getpr_byid_result)) {
		foreach ($getpr_byid_result as $ca) {
?>
	<div class="modal fade" id="rca_<?php echo $ca['control_no']; ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" id="dclose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h5 class="modal-title"><i class="fa fa-credit-card-alt"></i> <b>Cash Advance</b></h5>
				</div>
				<div class="modal-body">
					<div class="row text-center">
						<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="45px">
						<h4>CASH ADVANCE</h4>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<label class="control-label col-md-2">Date Requested :</label> 
						<div class="col-md-10">
							<span><?php echo $ca['submission_date']?></span>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<label class="col-md-2">CA Control No. :</label> 
						<div class="col-md-10">  
							<span><?php echo $ca['control_no']?></span>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<label class="col-md-2">Amount in Figure :</label>  
						<div class="col-md-10">  
							<span>₱<?php echo number_format($ca['amount'],2)?></span>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 form-inline">
						<label class="col-md-2">Amount in Words :</label>   
						<div class="col-md-10"> 
							<span style="text-decoration:underline;color:#ff6600;font-size:14px"><?php echo number_to_words($ca['amount']); ?> Pesos</span>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<p>
							Cash Advance for Lot. <b class="txt"><?php echo $li['lot'];?></b>,
							Cad. <b class="txt"><?php echo $li['cad'] ?></b>,
							located at <b class="txt"><i><?php echo $ll['street'] ?>, <?php echo $ll['baranggay']?>, <?php echo $ll['municipality']?>, <?php echo $ll['province']?></i></b>,
							with an area of approximately <b class="txt"><?php echo number_format($li['lot_size'],2) ?></b> (Sq/meter) square meters, under Original Certificate Title No. <b class="txt"><?php echo $li['land_title_no'] ?></b>
							/ Tax Declaration No. <b class="txt"><?php echo $li['tax_dec_no'] ?></b>, 
							in the name of <b class="txt"><i><?php echo ucfirst($oi['firstname']) ?> <?php echo ucfirst($oi['middlename']) ?> <?php echo ucfirst($oi['lastname']) ?></i></b>.
						</p>
					</div>

					<div class="col-md-12 col-xs-12 col-sm-12" style="border: 2px solid rgba(128, 128, 128, 0.33);">
						<div class="form-group">
							<label class="control-label col-md-3">Purpose *</label>
							<div class="form-horizontal col-md-9">
								<?php 
									$purposesFull			= array('Personal','Affidavit of Surrender of Landholdings','Capital Gains Tax','Estate Tax','Notary Fee','Real Property Tax','Documentary Stamp Tax');
									$purposesFromDB 		= $ca['purpose'];
									$purposesFromDBArray 	= explode(', ',$purposesFromDB);
									foreach($purposesFull as $item){
										$checked = in_array($item,$purposesFromDBArray) ? 'checked' : 'disabled';
										echo '<input type="checkbox" name="purs[]"'.$checked.' readonly>'.$item;
										echo '<br/>';
									}
								?>									 
								<label class="control-label">Others *</label>
								<textarea  class="form-control col-md-3" style="margin-bottom:10px;max-width:100%" readonly><?php echo $ca['other_purpose'] ?></textarea>
							</div>
						</div>
					</div>
				</div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<?php }} ?>
<!--====================FULL PAYMENT REASON DISAPPROVAL MODAL====================-->
<?php
	if (!empty($fp_info)) {
		foreach ($fp_info as $fp) {
?>
	<div class="modal animate bounceInUp reason_disapproved_<?php echo $fp['is_no'];?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color:maroon; color: white;">
					<button type="button" class="close" id="dclose" data-dismiss="modal"><span aria-hidden="true">×</span></button>
					<h5 class="modal-title" id="myModalLabel"><span class="fa fa-file-text-o"></span> Reason Disapproved</h5>
				</div>
				<div class="modal-body">
					<span><?php echo $fp['reason_disapproved']?></span>                                        
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" style="color: red; border: 1px solid;">Close</button>
				</div>
			</div>
		</div>
	</div>
<?php }}?>
<!--====================LOT PURCHASE FORM MODAL====================-->
<?php 
	foreach($fp_info as $fp){
?>
	<div class="modal fade" id="lpf_<?= $fp['is_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" id="dclose" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span></button>
					<h5 class="modal-title"><i class="fa fa-info"></i> Lot Purchase Form</h5>
				</div>
				<!--==========BODY==========-->
				<div class="modal-body">
					<div class="row text-center">
						<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
						<h5 class="modal-title1">LOT PURCHASE FORM (LPF)</h5>
					</div>

					<div class="x_panel round-border bg-gray" ><!-- style="border-radius:10px;background:#E6E9ED" -->
						<div class="col-md-12 space">
							<label class="col-md-2">LPF Number <b style="float:right">:</b></label>
							<div class="col-md-3">
								<input class="form-control inb" type="text" value="<?= $li['is_no']; ?>" readonly>
							</div>
							<div class="col-md-3"></div>
							<label class="col-md-1">Date <b style="float:right">:</b></label>
							<div class="col-md-3">
								<input class="form-control inb" type="text" value="<?= date('F j, Y', strtotime($li['date_acquired'])); ?>" readonly>
							</div>
						</div>

						<div class="col-md-12 space5">
							<label class="col-md-2">Lot Location <b style="float:right">:</b></label>
							<div class="col-md-10">
								<input class="form-control inb" type="text" value="<?php echo ucfirst($ll['street']) ?>- <?php echo ucfirst($ll['baranggay']) ?>, <?php echo ucfirst($ll['municipality']) ?>, <?php echo ucfirst($ll['province']) ?>" readonly>
							</div>
						</div>

						<div class="col-md-12 space5">
							<label class="col-md-2">Lot Owner <b style="float:right">:</b></label>
							<div class="col-md-10">
								<input class="form-control inb" type="text" value="<?php echo ucfirst($oi['firstname']) ?> <?php echo ucfirst($oi['lastname']) ?>" readonly>
							</div>
						</div>

						<div class="col-md-12 space5">
							<label class="col-md-2">Title No./Tax Dec. <b style="float:right">:</b></label>
							<div class="col-md-10">
								<?php
									$landTitleNo = $li['land_title_no'];
									$taxDecNo = $li['tax_dec_no'];

									if (!empty($landTitleNo) && !empty($taxDecNo)) {
											$displayValue = "{$landTitleNo}/{$taxDecNo}";
									} elseif (!empty($landTitleNo)) {
											$displayValue = $landTitleNo;
									} elseif (!empty($taxDecNo)) {
											$displayValue = $taxDecNo;
									} else {
											$displayValue = ''; // Both are empty, you can set a default value or leave it empty
									}
								?>
								<input class="form-control inb" type="text" value="<?= $displayValue; ?>" readonly>
							</div>
						</div>

						<div class="col-md-12 space5">
							<label class="col-md-2">Lot Area <b style="float:right">:</b></label>
							<div class="col-md-10">
								<input class="form-control inb" type="text" value="<?= $li['lot_size']; ?> sq.mtrs" readonly>
							</div>
						</div>

						<?php if ($li['price_per_sqm'] != 0.00): ?>
							<div class="col-md-12 space5">
								<label class="col-md-2">Price per sq.mtrs. <b style="float:right">:</b></label>
								<div class="col-md-10">
									<input class="form-control inb" type="text" value="<?= $li['price_per_sqm']; ?>" readonly>
								</div>
							</div>
						<?php endif; ?>

						<div class="col-md-12 space5">
							<label class="col-md-2">Computations <b style="float:right">:</b></label>
							<div class="col-md-10">
								<i>Lot Price (lot area x price/sq.mtr.)</i>
							</div>
						</div>

						<div class="col-md-12 space5">
							<label class="col-md-2">Amount in Figures <b style="float:right">:</b></label>
							<div class="col-md-10">
								<input class="form-control inb" type="text" value="₱<?php echo number_format($li['total_price'],2) ?>" readonly>
							</div>
						</div>

						<div class="col-md-12 space5">
							<label class="col-md-2">Amount in Words <b style="float:right">:</b></label>
							<div class="col-md-10">
								<span style="color:#ff6600;text-decoration: underline"><?php echo number_to_words($li['total_price']); ?> Pesos</span>
							</div>
						</div>

						<div class="col-md-12 space5">
							<label class="col-md-2">Purpose/Use <b style="float:right">:</b></label>
							<div class="col-md-10">
								<input class="form-control inb" type="text" value="<?php echo empty($fp['purpose_use']) ? '' : $fp['purpose_use']; ?>" readonly>
							</div>
						</div>

					</div>
				</div>
				<!--==========END BODY==========-->
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<!--====================PER SQM COMPUTATION OF PAYMENT MODAL====================-->
<?php 
	foreach($fp_info as $fp){
?>
	<div class="modal fade"	id="cp_sqm_<?= $fp['is_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" id="dclose" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span></button>
					<h5 class="modal-title"><i class="fa fa-info"></i> Computation Of Payment</h5>
				</div>
				<!--==========BODY==========-->
				<div class="modal-body">
					<div class="row text-center">
						<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
						<h5 style="text-decoration:underline;text-transform:uppercase;font-weight:bold;padding-top:10px">PAYMENT OF A PARCEL OF LAND SITUATED AT <?php echo $ll['baranggay']?>, <?php echo $ll['municipality']?>, <?php echo $ll['province']?></uh5>
					</div>

					<div class="row">
						<div class="form-inline col-md-12 col-sm-12 col-xs-12 space">
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

						<div class="form-inline col-md-12 col-sm-12 col-xs-12 space">
						 <h5 style="font-weight:bold;text-align:center">COMPUTATION OF PAYMENT</h5>
						</div>

						<div class="form-inline col-md-12 col-sm-12 col-xs-12 space">
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
								<h5>₱<?php echo empty($li['total_price']) ? '' : number_format($li['total_price'],2); ?></h5>
							</div>
						</div>

						<div class="form-inline col-md-12 col-sm-12 col-xs-12 space">
							<div class="col-md-1"></div>
							<div class="col-md-5">
								<label>CHECKS/PAYEES :</label>
								<span>
									<?php echo (!empty($oi['firstname'])) ? $oi['firstname'] : ''; ?>
									<?php echo (!empty($oi['middlename'])) ? $oi['middlename'] : ''; ?>
									<?php echo (!empty($oi['lastname'])) ? $oi['lastname'] : ''; ?>
								</span>
							</div>
							<div class="col-md-1"></div>
							<span>- ₱<?php echo empty($li['total_price']) ? '' : number_format($li['total_price'],2); ?></span>
							<span>- dated - <?php echo date('F j, Y'); ?></span>
						</div>

						<div class="form-inline col-md-12 col-sm-12 col-xs-12 space">
							<div class="col-md-1"></div>
							<div class="col-md-11">
								<?php if (!empty($fp['note'])): ?>
									<i><b>NOTE :</b></i>
									<i><b><?php echo $fp['note']; ?></i></b>
								<?php endif; ?>
							</div>
						</div>

					</div>
				</div>
				<!--==========END BODY==========-->
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<!--====================PACKAGE COMPUTATION OF PAYMENT MODAL====================-->
<?php 
	foreach($fp_info as $fp){
?>
<div class="modal fade cp_package_<?= $fp['is_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" id="dclose" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span></button>
				<h5 class="modal-title"><i class="fa fa-info"></i> Computation Of Payment</h5>
			</div>
			<!--==========BODY==========-->
			<div class="modal-body">
				<div class="row text-center">
					<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
					<h5 style="text-decoration:underline;text-transform:uppercase;font-weight:bold;padding-top:10px">PAYMENT OF A PARCEL OF LAND SITUATED AT <?php echo $ll['baranggay']?>, <?php echo $ll['municipality']?>, <?php echo $ll['province']?></h5>
				</div>

				<div class="row">
					<div class="form-inline col-md-12 col-sm-12 col-xs-12 space">
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

					<div class="form-inline col-md-12 col-sm-12 col-xs-12 space">
						<div class="col-md-1"></div>
						<div class="col-md-5">
							<label>CHECKS/PAYEES :</label>
							<span>
								<?php echo (!empty($oi['firstname'])) ? $oi['firstname'] : ''; ?>
								<?php echo (!empty($oi['middlename'])) ? $oi['middlename'] : ''; ?>
								<?php echo (!empty($oi['lastname'])) ? $oi['lastname'] : ''; ?>
							</span>
						</div>
						<div class="col-md-1"></div>
						<div class="col-md-5">
							<span>- ₱<?php echo empty($li['total_price']) ? '' : number_format($li['total_price'],2); ?></span>
							<span>- dated - <?php echo date('F j, Y'); ?></span>
						</div>
					</div>

					<div class="form-inline col-md-12 col-sm-12 col-xs-12 space">
						<div class="col-md-1"></div>
						<div class="col-md-11">
							<?php if (!empty($fp['note'])): ?>
								<i><b>NOTE :</b></i>
								<i><b><?php echo $fp['note']; ?></i></b>
							<?php endif; ?>
						</div>
					</div>

				</div>
			</div>
			<!--==========END BODY==========-->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<!--====================NOTARIAL FEE MODAL====================-->
<?php 
	foreach($fp_info as $fp){
?>
<div class="modal fade"	id="nf_<?= $fp['is_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" id="dclose" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span></button>
				<h5 class="modal-title"><i class="fa fa-info"></i> Notarial Fee</h5>
			</div>
			<!--==========BODY==========-->
			<div class="modal-body">
				<div class="row text-center">
					<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
				</div>
				<div class="row form-inline text-center">
					<h5 style="text-transform:uppercase;font-weight:bold;padding-top:10px">
						<label>₱</label>
						<input class="form-control input_border" value="<?php echo empty($fp['notarial_fee']) ? '' : number_format($fp['notarial_fee'], 2); ?>" readonly>
						- NOTARIAL FEE FOR ATTY. URBANO H. LAGUNAY
					</h5>
				</div>

				<div class="row">
					<div class="form-inline col-md-12 col-sm-12 col-xs-12 space">
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

					<div class="form-inline col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-1"></div>
						<div class="col-md-5">
							<?php if ($li['price_per_sqm'] != 0.00): ?>
								<label>TOTAL PURCHASE PRICE:</label>
								<span>₱<?php echo empty($li['total_price']) ? '' : number_format($li['total_price'],2); ?></span>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<!--==========END BODY==========-->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<!--====================AGENT COMMISSION MODAL====================-->
<?php 
	foreach($fp_info as $fp){
?>
<div class="modal fade ac_<?= $fp['is_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" id="dclose" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span></button>
				<h5 class="modal-title"><i class="fa fa-info"></i> Agent Commission</h5>
			</div>
			<!--==========BODY==========-->
			<div class="modal-body">
				<div class="row text-center">
					<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
				</div>
				<div class="row form-inline text-center">
					<h5 class="modal-title1">AGENT COMMISSION</h5>
					<h5 style="text-transform:uppercase;font-weight:bold;padding-top:10px">
						<label>₱</label>
						<input type="text" class="form-control input_border" id="commission_fee" name="commission_fee" value="<?php echo empty($fp['commission_fee']) ? '' : number_format($fp['commission_fee'], 2); ?>" readonly>-
						PAY TO
						<?php echo (!empty($bi['firstname'])) ? $bi['firstname'] : ''; ?>
						<?php echo (!empty($bi['middlename'])) ? $bi['middlename'] : ''; ?>
						<?php echo (!empty($bi['lastname'])) ? $bi['lastname'] : ''; ?>
					</h5>
				</div>

				<div class="row">
					<div class="form-inline col-md-12 col-sm-12 col-xs-12 space">
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

					<div class="form-inline col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-1"></div>
						<div class="col-md-5">
							<?php if ($li['price_per_sqm'] != 0.00): ?>
								<label>TOTAL PURCHASE PRICE:</label>
								<span>₱<?php echo empty($li['total_price']) ? '' : number_format($li['total_price'],2); ?></span>
							<?php endif; ?>
						</div>
					</div>
				</div>                
			</div>
			<!--==========END BODY==========-->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<!--====================ACKNOWLEDGEMENT RECEIPT MODAL====================-->
<?php 
	foreach($fp_info as $fp){
?>
<script src='<?= base_url() ?>resources/tinymce/tinymce.min.js'></script>
<div class="modal fade" id="ar_<?= $fp['is_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" id="dclose" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span></button>
				<h5 class="modal-title"><i class="fa fa-info"></i> Acknowledgement Receipt</h5>
			</div>
			<!--==========BODY==========-->
			<div class="modal-body">
				<textarea class="form-control editor" id="receiptTextareas" name="receipt_file" style="max-width:100%" rows="5" placeholder="Type Here..." readonly>
					<?php $txt_file = base_url('assets/img/acknowledgement_receipt/'.$is_no.'/'.$fp['acknowledgement_receipt']);
						$text_content = file_get_contents($txt_file);
						echo htmlspecialchars($text_content, ENT_QUOTES, 'UTF-8');
					?>
				</textarea>                            
			</div>
			<!--==========END BODY==========-->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<!--====================END MODAL====================