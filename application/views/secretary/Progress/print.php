<!--====================PRINT LOT PURCHASE FORM MODAL====================-->
<?php
	foreach ($fp_info as $fp) {
?>
<div class="modal animate bounceInUp lpfp<?= $fp['is_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" >
	<div class="modal-dialog modal-lg modal-responsive">
		<div class="modal-content">
			<!--==========BODY==========-->
			<div class="modal-body">
				<center>
					<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
					<h4 style="font-weight:bold;font-family:Times New Roman">LOT PURCHASE FORM (LPF)</h4>
				</center>

				<div class="row">
					<div class="col-md-12 space">
						<label>LPF Number <b style="margin-left:60px">:</b></label> 
						<label><?php if($li['is_no']){ echo $li['is_no']; }else{ echo "None"; } ?></label>  
					</div>

					<div class="col-md-12 space">
						<label>Date <b style="margin-left:113px">:</b></label>
						<label><?= date('F j, Y', strtotime($li['date_acquired'])); ?></label>
					</div>

					<div class="col-md-12 space">
						<label>Lot Location <b style="margin-left:60px">:</b></label>
						<label><?php echo ucfirst($ll['street']) ?>- <?php echo ucfirst($ll['baranggay']) ?>, <?php echo ucfirst($ll['municipality']) ?>, <?php echo ucfirst($ll['province']) ?></label>
					</div>

					<div class="col-md-12 space">
						<label>Lot Owner <b style="margin-left:73px">:</b></label>
						<label><?php echo ucfirst($oi['firstname']) ?> <?php echo ucfirst($oi['lastname']) ?></label>
					</div>

					<div class="col-md-12 space">
						<label>Title No. /Tax Dec. <b style="margin-left:20px">:</b></label>
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
						<label><?= $displayValue; ?></label>
					</div>

					<div class="col-md-12 space">
						<label>Lot Area <b style="margin-left:86px">:</b></label>
						<label><?= $li['lot_size']; ?> sq.mtrs</label>
					</div>

					<?php if ($li['price_per_sqm'] != 0.00): ?>
						<div class="col-md-12 space">
							<label>Price per sq.mtrs. <b style="margin-left:30px">:</b></label>
							<label><?= $li['price_per_sqm']; ?></label>
						</div>
					<?php endif; ?>

					<div class="col-md-12 space">
						<label>Computations <b style="margin-left:52px">:</b></label>
						<label>Lot Price (lot area x price/sq.mtr.)</label>
					</div>

					<div class="col-md-12 space">
						<label>Amount in Figures <b style="margin-left:21px">:</b></label>
						<label>₱<?php echo number_format($li['total_price'],2) ?></label>
					</div>

					<div class="col-md-12 space">
						<label>Amount in Words <b style="margin-left:28px">:</b></label>
						<label><?php echo number_to_words($li['total_price']); ?> Pesos</label>
					</div>

					<div class="col-md-12 space">
						<label>Purpose/Use <b style="margin-left:61px">:</b></label>
						<label><?php echo empty($getpr_fp['purpose_use']) ? '' : $getpr_fp['purpose_use']; ?></label>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:60px;float:left">
						<div class="col-md-4 col-sm-4 col-xs-4">
							<label>PREPARED BY :</label>   
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4" style="margin-top:25px;text-transform:uppercase;font-weight:bold;text-align:center">
							<label><?php echo (!empty($fp['prepared_by'])) ? $fp['prepared_by'] : ''; ?></label>   
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4" style="text-align:center">
							<label>Clerk, Lagunay & Lagunay Office</label>   
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:60px;float:right">
						<div class="col-md-2 col-sm-2 col-xs-2">
							<label>APPROVED BY :</label>   
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3" style="margin-top:25px;text-transform:uppercase;font-weight:bold;text-align:center">
							<label>MARLITO C. UY</label>   
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3" style="text-align:center">
							<label>Vice-President/General Manager</label>     
						</div>
						<div class="col-md-2 col-sm-2 col-xs-2" style="text-align:center"> 
							<label>ALTURAS GROUP OF COMPANIES</label> 
						</div>
						<div class="col-md-2 col-sm-2 col-xs-2" style="text-align:center">
							<label>City of Tagbilaran</label>   
						</div>
					</div>

				</div>
			</div>
			<!--==========END BODY==========-->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" style="color: #33b5e5; border: 1px solid;">Close</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<!--====================PRINT PACKAGE COMPUTATION OF PAYMENT MODAL====================-->
<?php
foreach ($fp_info as $fp) {
?>
<div class="modal animate bounceInUp cp_package_print_<?= $fp['is_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" >
	<div class="modal-dialog modal-lg modal-responsive">
		<div class="modal-content">
			<!--==========BODY==========-->
			<div class="modal-body">
				<center><img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
				<h4 style="text-transform:uppercase;font-weight:bold">PAYMENT OF A PARCEL OF LAND SITUATED AT <?php echo $ll['baranggay']?>, <?php echo $ll['municipality']?>, <?php echo $ll['province']?></h4></center>

				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>LOT NUMBER <b style="margin-left:97px">-</b></label>   
						<i class="small"> <?php if($li['lot']){ echo $li['lot']; }else{ echo "None"; } ?></i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>WHOLE AREA <b style="margin-left:97px">-</b></label>  
						<i class="small"> <?php echo empty($li['lot_size']) ? '' : number_format($li['lot_size'],2); ?> square meters, more or less</i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>LOCATION <b style="margin-left:120px">-</b></label>  
						<i class="small">
							<?php echo (!empty($ll['baranggay'])) ? $ll['baranggay'] . ', ' : ''; ?>
							<?php echo (!empty($ll['municipality'])) ? $ll['municipality'] . ', ' : ''; ?>
							<?php echo (!empty($ll['province'])) ? $ll['province'] : ''; ?>
						</i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>TITLE/TAX DEC. NO.<b style="margin-left:51px">-</b></label>  
						<i class="small">
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
						</i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>NAME OF LOT OWNER <b style="margin-left:29px">-</b></label>   
						<i class="small">
							<?php echo (!empty($oi['firstname'])) ? $oi['firstname'] : ''; ?>
							<?php echo (!empty($oi['middlename'])) ? $oi['middlename'] : ''; ?>
							<?php echo (!empty($oi['lastname'])) ? $oi['lastname'] : ''; ?>
						</i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>TOTAL PURCHASE PRICE <b style="margin-left:11px">-</b></label>   
						<i class="small">₱<?php echo empty($li['total_price']) ? '' : number_format($li['total_price'],2); ?> package</i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:40px;font-weight:bold;">
						<label>CHECKS/PAYEES :</label>   
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;margin-left:50px;font-weight:bold">  
						<i class="small" style="text-transform:uppercase;">
							<?php echo (!empty($oi['firstname'])) ? $oi['firstname'] : ''; ?>
							<?php echo (!empty($oi['middlename'])) ? $oi['middlename'] : ''; ?>
							<?php echo (!empty($oi['lastname'])) ? $oi['lastname'] : ''; ?>
						</i>
						<span style="margin-left:80px">- ₱<?php echo empty($li['total_price']) ? '' : number_format($li['total_price'],2); ?></span>
						<span style="margin-left:20px">- dated - <?php echo date('F j, Y'); ?></span>
					</div>

					<div class="form-inline col-md-12 col-sm-12 col-xs-12"style="margin-top:40px;">
						<div class="col-md-1"></div>
						<div class="col-md-11">
							<?php if (!empty($fp['note'])): ?>
								<i><b>NOTE :</b></i>
								<i><b><?php echo $fp['note']; ?></i></b>
							<?php endif; ?>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:60px;float:left">
						<div class="col-md-4 col-sm-4 col-xs-4">
							<label>PREPARED BY :</label>   
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4" style="margin-top:25px;text-transform:uppercase;font-weight:bold;text-align:center">
							<label><?php echo (!empty($fp['prepared_by'])) ? $fp['prepared_by'] : ''; ?></label>   
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4" style="text-align:center">
							<label>Clerk, Lagunay & Lagunay Office</label>   
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:60px;float:right">
						<div class="col-md-2 col-sm-2 col-xs-2">
							<label>APPROVED BY :</label>   
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3" style="margin-top:25px;text-transform:uppercase;font-weight:bold;text-align:center">
							<label>MARLITO C. UY</label>   
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3" style="text-align:center">
							<label>Vice-President/General Manager</label>     
						</div>
						<div class="col-md-2 col-sm-2 col-xs-2" style="text-align:center"> 
							<label>ALTURAS GROUP OF COMPANIES</label> 
						</div>
						<div class="col-md-2 col-sm-2 col-xs-2" style="text-align:center">
							<label>City of Tagbilaran</label>   
						</div>
					</div>
				</div>
			</div>
			<!--==========END BODY==========-->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" style="color: #33b5e5; border: 1px solid;">Close</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<!--====================PRINT SQM COMPUTATION OF PAYMENT MODAL====================-->
<?php
foreach ($fp_info as $fp) {
?>
<div class="modal animate bounceInUp cp_sqm_print_<?= $fp['is_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" >
	<div class="modal-dialog modal-lg modal-responsive">
		<div class="modal-content">
			<!--==========BODY==========-->
			<div class="modal-body">
				<center><img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
				<h4 style="text-transform:uppercase;font-weight:bold">PAYMENT OF A PARCEL OF LAND SITUATED AT <?php echo $ll['baranggay']?>, <?php echo $ll['municipality']?>, <?php echo $ll['province']?></h4></center>

				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>LOT NUMBER <b style="margin-left:87px">-</b></label>   
						<i class="small"> <?php if($li['lot']){ echo $li['lot']; }else{ echo "None"; } ?></i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>WHOLE AREA <b style="margin-left:87px">-</b></label>  
						<i class="small"> <?php echo empty($li['lot_size']) ? '' : number_format($li['lot_size'],2); ?> square meters, more or less</i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>LOCATION <b style="margin-left:110px">-</b></label>  
						<i class="small">
							<?php echo (!empty($ll['baranggay'])) ? $ll['baranggay'] . ', ' : ''; ?>
							<?php echo (!empty($ll['municipality'])) ? $ll['municipality'] . ', ' : ''; ?>
							<?php echo (!empty($ll['province'])) ? $ll['province'] : ''; ?>
						</i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>TITLE/TAX DEC. NO.<b style="margin-left:41px">-</b></label>  
						<i class="small">
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
						</i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>NAME OF LOT OWNER <b style="margin-left:19px">-</b></label>   
						<i class="small">
							<?php echo (!empty($oi['firstname'])) ? $oi['firstname'] : ''; ?>
							<?php echo (!empty($oi['middlename'])) ? $oi['middlename'] : ''; ?>
							<?php echo (!empty($oi['lastname'])) ? $oi['lastname'] : ''; ?>
						</i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>PRICE <b style="margin-left:142px">-</b></label>   
						<i class="small">₱<?php echo empty($li['price_per_sqm']) ? '' : number_format($li['price_per_sqm'],2); ?> per square meter</i>
					</div>
					
					<div class="form-inline col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">
					 <h4 style="font-weight:bold;text-align:center">COMPUTATION OF PAYMENT</h4>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;text-align:center">
						<label style="margin-left:100px">Area <b style="margin-left:193px">-</b></label>   
						<span>₱ <?php echo empty($li['lot_size']) ? '' : number_format($li['lot_size'],2); ?></span>
						<i class="small">square meters</i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center">
						<label style="margin-left:120px">Price <b style="margin-left:195px">-</b></label>   
						<span style="text-decoration:underline;">x <?php echo empty($li['price_per_sqm']) ? '' : number_format($li['price_per_sqm'],2); ?></span>
						<i class="small">per square meters</i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;font-weight:bold;text-align:center">
						<label style="margin-right:70px">TOTAL PURCHASE PRICE<span style="margin-left:120px">- ₱<?php echo empty($li['total_price']) ? '' : number_format($li['total_price'],2); ?></span></label>   
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:40px;font-weight:bold;">
						<label>CHECKS/PAYEES :</label>   
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;margin-left:50px;font-weight:bold">  
						<i class="small" style="text-transform:uppercase;">
							<?php echo (!empty($oi['firstname'])) ? $oi['firstname'] : ''; ?>
							<?php echo (!empty($oi['middlename'])) ? $oi['middlename'] : ''; ?>
							<?php echo (!empty($oi['lastname'])) ? $oi['lastname'] : ''; ?>
						</i>
						<span style="margin-left:80px">- ₱<?php echo empty($li['total_price']) ? '' : number_format($li['total_price'],2); ?></span>
						<span style="margin-left:20px">- dated - <?php echo date('F j, Y'); ?></span>
					</div>

					<div class="form-inline col-md-12 col-sm-12 col-xs-12"style="margin-top:40px;">
						<div class="col-md-1"></div>
						<div class="col-md-11">
							<?php if (!empty($fp['note'])): ?>
								<i><b>NOTE :</b></i>
								<i><b><?php echo $fp['note']; ?></i></b>
							<?php endif; ?>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:60px;float:left">
						<div class="col-md-4 col-sm-4 col-xs-4">
							<label>PREPARED BY :</label>   
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4" style="margin-top:25px;text-transform:uppercase;font-weight:bold;text-align:center">
							<label><?php echo (!empty($fp['prepared_by'])) ? $fp['prepared_by'] : ''; ?></label>   
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4" style="text-align:center">
							<label>Clerk, Lagunay & Lagunay Office</label>   
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:60px;float:right">
						<div class="col-md-2 col-sm-2 col-xs-2">
							<label>APPROVED BY :</label>   
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3" style="margin-top:25px;text-transform:uppercase;font-weight:bold;text-align:center">
							<label>MARLITO C. UY</label>   
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3" style="text-align:center">
							<label>Vice-President/General Manager</label>     
						</div>
						<div class="col-md-2 col-sm-2 col-xs-2" style="text-align:center"> 
							<label>ALTURAS GROUP OF COMPANIES</label> 
						</div>
						<div class="col-md-2 col-sm-2 col-xs-2" style="text-align:center">
							<label>City of Tagbilaran</label>   
						</div>
					</div>
				</div>
			</div>
			<!--==========END BODY==========-->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" style="color: #33b5e5; border: 1px solid;">Close</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<!--====================PRINT NOTARIAL FEE MODAL====================-->
<?php 
	foreach($fp_info as $fp){
?>
<div class="modal fade nfp<?= $fp['is_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg modal-responsive">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" id="dclose" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel2"><i class="fa fa-file"></i> NOTARIAL FEE</h4>
			</div>
			<!--==========BODY==========-->
			<div class="modal-body">
				<div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center">
					<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
				</div>

				<div class="form-inline col-md-12 col-sm-12 col-xs-12" style="text-align:center">
					<h4 style="text-transform:uppercase;font-weight:bold">
						<label style="text-decoration:underline">₱ <?php echo empty($fp['notarial_fee']) ? '' : number_format($fp['notarial_fee'], 2); ?></label>
						<label>- NOTARIAL FEE FOR ATTY. URBANO H. LAGUNAY</label>
					</h4>
				</div>

				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>LOT NUMBER <b style="margin-left:115px">-</b></label>   
						<i class="small"> <?php if($li['lot']){ echo $li['lot']; }else{ echo "None"; } ?></i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>WHOLE AREA <b style="margin-left:115px">-</b></label>  
						<i class="small"> <?php echo empty($li['lot_size']) ? '' : number_format($li['lot_size'],2); ?> square meters, more or less</i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>LOCATION <b style="margin-left:138px">-</b></label>  
						<i class="small">
							<?php echo (!empty($ll['baranggay'])) ? $ll['baranggay'] . ', ' : ''; ?>
							<?php echo (!empty($ll['municipality'])) ? $ll['municipality'] . ', ' : ''; ?>
							<?php echo (!empty($ll['province'])) ? $ll['province'] : ''; ?>
						</i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>TITLE/TAX DEC. NO.<b style="margin-left:70px">-</b></label>  
						<i class="small">
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
						</i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>NAME OF LOT OWNER <b style="margin-left:48px">-</b></label>   
						<i class="small">
							<?php echo (!empty($oi['firstname'])) ? $oi['firstname'] : ''; ?>
							<?php echo (!empty($oi['middlename'])) ? $oi['middlename'] : ''; ?>
							<?php echo (!empty($oi['lastname'])) ? $oi['lastname'] : ''; ?>
						</i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<?php if ($li['price_per_sqm'] != 0.00): ?>
							<label>PRICE <b style="margin-left:170px">-</b></label>   
							<i class="small">₱<?php echo empty($li['price_per_sqm']) ? '' : number_format($li['price_per_sqm'],2); ?> per square meter</i>
						<?php endif; ?>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12" style="font-weight:bold">
						<label>TOTAL PURCHASE PRICE <b style="margin-left:15px">-</b></label>   
						<span>₱<?php echo empty($li['total_price']) ? '' : number_format($li['total_price'],2); ?></span>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:60px;float:left">
						<div class="col-md-4 col-sm-4 col-xs-4">
							<label>PREPARED BY :</label>   
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4" style="margin-top:25px;text-transform:uppercase;font-weight:bold;text-align:center">
							<label>ATTY. URBANO H. LAGUNAY</label>   
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4" style="text-align:center">
							<label>ASC-Legal Counsel</label>   
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:60px;float:right">
						<div class="col-md-2 col-sm-2 col-xs-2">
							<label>APPROVED BY :</label>   
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3" style="margin-top:25px;text-transform:uppercase;font-weight:bold;text-align:center">
							<label>MARLITO C. UY</label>   
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3" style="text-align:center">
							<label>Vice-President/General Manager</label>     
						</div>
						<div class="col-md-2 col-sm-2 col-xs-2" style="text-align:center"> 
							<label>ALTURAS GROUP OF COMPANIES</label> 
						</div>
						<div class="col-md-2 col-sm-2 col-xs-2" style="text-align:center">
							<label>City of Tagbilaran</label>   
						</div>
					</div>
				</div>
			</div>
			<!--==========END BODY==========-->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" style="color: #33b5e5; border: 1px solid;">Close</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<!--====================PRINT AGENT COMMISSION MODAL====================-->
<?php 
	foreach($fp_info as $fp){
?>
<div class="modal fade acp<?= $fp['is_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" id="dclose" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span></button>
				<h5 class="modal-title" id="myModalLabel2"><i class="fa fa-file"></i> AGENT COMMISSION</h5>
			</div>
			<!--==========BODY==========-->
			<div class="modal-body">
				<div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center">
					<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
				</div>

				<div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center;margin-top:20px;text-transform:uppercase;font-weight:bold;font-size:20px">
					<label>AGENT COMMISSION</label>
				</div>

				<div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center">
					<label style="text-decoration:underline">(₱<?php echo empty($fp['commission_fee']) ? '' : number_format($fp['commission_fee'], 2); ?></label>
					<label style="text-transform:uppercase">
						- PAY TO
						<?php echo (!empty($bi['firstname'])) ? $bi['firstname'] : ''; ?>
						<?php echo (!empty($bi['middlename'])) ? $bi['middlename'] : ''; ?>
						<?php echo (!empty($bi['lastname'])) ? $bi['lastname'] : ''; ?>)
					</label>
				</div>

				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;">
						<label>LOT NUMBER <b style="margin-left:115px">-</b></label>   
						<i class="small"> <?php if($li['lot']){ echo $li['lot']; }else{ echo "None"; } ?></i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>WHOLE AREA <b style="margin-left:115px">-</b></label>  
						<i class="small"> <?php echo empty($li['lot_size']) ? '' : number_format($li['lot_size'],2); ?> square meters, more or less</i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>LOCATION <b style="margin-left:138px">-</b></label>  
						<i class="small">
							<?php echo (!empty($ll['baranggay'])) ? $ll['baranggay'] . ', ' : ''; ?>
							<?php echo (!empty($ll['municipality'])) ? $ll['municipality'] . ', ' : ''; ?>
							<?php echo (!empty($ll['province'])) ? $ll['province'] : ''; ?>
						</i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>TITLE/TAX DEC. NO.<b style="margin-left:70px">-</b></label>  
						<i class="small">
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
						</i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<label>NAME OF LOT OWNER <b style="margin-left:48px">-</b></label>   
						<i class="small">
							<?php echo (!empty($oi['firstname'])) ? $oi['firstname'] : ''; ?>
							<?php echo (!empty($oi['middlename'])) ? $oi['middlename'] : ''; ?>
							<?php echo (!empty($oi['lastname'])) ? $oi['lastname'] : ''; ?>
						</i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<?php if ($li['price_per_sqm'] != 0.00): ?>
							<label>PRICE <b style="margin-left:170px">-</b></label>   
							<i class="small">₱<?php echo empty($li['price_per_sqm']) ? '' : number_format($li['price_per_sqm'],2); ?> per square meter</i>
						<?php endif; ?>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12" style="font-weight:bold">
						<label>TOTAL PURCHASE PRICE <b style="margin-left:18px">-</b></label>   
						<span>₱<?php echo empty($li['total_price']) ? '' : number_format($li['total_price'], 2); ?></span>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:60px;float:left">
						<div class="col-md-4 col-sm-4 col-xs-4">
							<label>PREPARED BY :</label>   
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4" style="margin-top:25px;text-transform:uppercase;font-weight:bold;text-align:center">
							<label><?php echo (!empty($fp['prepared_by'])) ? $pr['prepared_by'] : ''; ?></label>   
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4" style="text-align:center">
							<label>Clerk, Lagunay & Lagunay Office</label>   
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:60px;float:right">
						<div class="col-md-2 col-sm-2 col-xs-2">
							<label>APPROVED BY :</label>   
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3" style="margin-top:25px;text-transform:uppercase;font-weight:bold;text-align:center">
							<label>MARLITO C. UY</label>   
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3" style="text-align:center">
							<label>Vice-President/General Manager</label>     
						</div>
						<div class="col-md-2 col-sm-2 col-xs-2" style="text-align:center"> 
							<label>ALTURAS GROUP OF COMPANIES</label> 
						</div>
						<div class="col-md-2 col-sm-2 col-xs-2" style="text-align:center">
							<label>City of Tagbilaran</label>   
						</div>
					</div>
				</div>                
			</div>
			<!--==========END BODY==========-->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" style="color: #33b5e5; border: 1px solid;">Close</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<!--====================PRINT ACKNOWLEDGEMENT RECEIPT MODAL====================-->
<?php 
	foreach($fp_info as $fp){
?>
<div class="modal fade arp<?= $fp['is_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" id="dclose" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span></button>
				<h5 class="modal-title"><i class="fa fa-file"></i> <b>Acknowledgement Receipt</b></h5>
			</div>
			<!--==========BODY==========-->
			<div class="modal-body">
				<div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center">
					<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
				</div>

				<div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center;margin-top:20px;text-transform:uppercase;font-weight:bold;font-size:20px">
					<label>ACKNOWLEDGEMENT RECEIPT</label>
				</div>

				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<?php $txt_file = base_url('assets/img/acknowledgement_receipt/'.$is_no.'/'.$fp['acknowledgement_receipt']);
							$text_content = file_get_contents($txt_file);
							echo $text_content;
						?>
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
<!--====================PRINT CASH ADVANCE MODAL====================-->
<?php
	if (!empty($getpr_byid_byca_result)) {
		foreach ($getpr_byid_byca_result as $ca) {
?>
<div class="modal animate bounceInUp ca<?php echo $ca['control_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" >
	<div class="modal-dialog modal-lg modal-responsive">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<center style="padding-top:5px">
						<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="45px">
						<h4 class="title_ca">CASH ADVANCE</h4>
					</center>

					<div class="col-md-12 col-sm-12 col-xs-12 space">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="col-md-12 form-inline">
								<label class="col-md-2">Date Requested :</label> 
								<span><?php echo $ca['submission_date']?></span>  
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="col-md-12 form-inline">
								<label class="col-md-2">CA Control No. :</label>   
								<span><?php echo $ca['control_no']?></span>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="col-md-12 form-inline">
								<label class="col-md-2">Amount in Figure :</label>   
								<span>₱<?php echo number_format($ca['amount'],2)?></span>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="col-md-12 form-inline">
								<label class="col-md-2">Amount in Words :</label>   
								<span><?php echo number_to_words($ca['amount']); ?> Pesos</span>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12 space">
							<p class="paragrap">
								Cash Advance for Lot. <b class="txt"><?php echo $li['lot'];?></b>,
								Cad. <b class="txt"><?php echo $li['cad'] ?></b>,
								located at <b class="txt"><i><?php echo $ll['street'] ?>, <?php echo $ll['baranggay']?>, <?php echo $ll['municipality']?>, <?php echo $ll['province']?></i></b>,
								with an area of approximately <b class="txt"><?php echo number_format($li['lot_size'],2) ?></b> (Sq/meter) square meters, under Original Certificate Title No. <b class="txt"><?php echo $li['land_title_no'] ?></b>
								/ Tax Declaration No. <b class="txt"><?php echo $li['tax_dec_no'] ?></b>, 
								in the name of <b class="txt"><i><?php echo ucfirst($oi['firstname']) ?> <?php echo ucfirst($oi['middlename']) ?> <?php echo ucfirst($oi['lastname']) ?></i></b>.
							</p>
						</div>

						<div class="col-md-12 col-xs-12 col-sm-12" style="padding-bottom:30px;padding-top:10px">
							<div class="row" style="border:1px solid rgba(128, 128, 128, 0.33);">
								<div class="form-group">
									<label class="control-label col-md-3">Purpose *</label>
									<div class="form-horizontal col-md-9" style="padding-bottom:10px">
										<input type="checkbox" name="purpose[]" id="personal" value="Personal" <?php echo (in_array("Personal", explode(', ', $ca['purpose'])) ? 'checked' : ''); ?>>Personal<br>
										<input type="checkbox" name="purpose[]" id="surrender" value="Affidavit of Surrender of Landholdings" <?php echo (in_array("Affidavit of Surrender of Landholdings", explode(', ', $ca['purpose'])) ? 'checked' : ''); ?>>Affidavit of Surrender of Landholdings<br>
										<input type="checkbox" name="purpose[]" id="capital_gains" value="Capital Gains Tax" <?php echo (in_array("Capital Gains Tax", explode(', ', $ca['purpose'])) ? 'checked' : ''); ?>>Capital Gains Tax<br>
										<input type="checkbox" name="purpose[]" id="estate_tax" value="Estate Tax" <?php echo (in_array("Estate Tax", explode(', ', $ca['purpose'])) ? 'checked' : ''); ?>>Estate Tax<br>
										<input type="checkbox" name="purpose[]" id="notary_fee" value="Notary Fee" <?php echo (in_array("Notary Fee", explode(', ', $ca['purpose'])) ? 'checked' : ''); ?>>Notary Fee<br>
										<input type="checkbox" name="purpose[]" id="real_property" value="Real Property Tax" <?php echo (in_array("Real Property Tax", explode(', ', $ca['purpose'])) ? 'checked' : ''); ?>>Real Property Tax<br>
										<input type="checkbox" name="purpose[]" id="documentary_stamp" value="Documentary Stamp Tax" <?php echo (in_array("Documentary Stamp Tax", explode(', ', $ca['purpose'])) ? 'checked' : ''); ?>>Documentary Stamp Tax<br>
										<label class="control-label col-md-2">Others *</label>
										<textarea name="other_purp" id="other_p" class="form-control" style="width:650px;height:80px;margin-left:20px"><?php echo $ca['other_purpose']; ?></textarea>
									</div>
								</div>
							</div>
						</div>

						<div class="form-inline col-md-12 col-sm-12 col-xs-12" style="float:left;margin-top:30px">
							<label style="text-transform:uppercase;font-weight:bold;margin-left:20px"><?php echo ucfirst($oi['firstname']) ?> <?php echo ucfirst($oi['middlename']) ?> <?php echo ucfirst($oi['lastname']) ?></label>
							<div class="col-md-12"style="text-align:center">
								<span>Heir-Vendor</span>
							</div>
						</div>

						<div class="form-inline col-md-12 col-sm-12 col-xs-12" style="float:right;margin-top:30px">
							<div class="col-md-2"style="text-align:center">
								<label style="text-transform:uppercase;font-weight:bold">MARLITO C. UY</label>
							</div>
							<div class="col-md-2" style="text-align:center">
								<span>Vice-President/General Manager</span>
							</div>
							<div class="col-md-2" style="text-align:center">
								<span>ALURAS GROUP OF COMPANIES</span>
							</div>
							<div class="col-md-2" style="text-align:center">
								<span>City of Tagbilaran</span>
							</div>
						</div>

					</div>   
				</div>
			</div>
		</div>
	</div>
</div>
<?php }} ?>
<!--====================END MODAL====================-->