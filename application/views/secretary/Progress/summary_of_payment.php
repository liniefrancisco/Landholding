<div class="container">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel" style="border-radius:10px;"> 
			<?php
				$get_remaining_balance 	= $this->Payment_model->getLatestRemainingBalance($is_no);
				$a_paid 				= $this->Payment_model->getpaid_ca($is_no);
			?>

			<center><h5 class="modal-title1">DETAILS</h5></center>

			<div class="col-md-12 col-sm-12 col-xs-12">
				<a href="<?php echo base_url('Pdf/summary_of_payment/'.$is_no);?>" target="blank">
					<button type="button" class="btn btn-md btn-default btn-sm" style="border-color:#cc5a5a;float: right;"><img src="<?php echo base_url();?>/assets/logo/pdf.png" width="10px" height="10px"> <b>Generate to PDF</b></button>
				</a>
			</div>
												
			<div class="col-md-12 table-responsive ">
				<table class="table table-striped table-bordered dt-responsive nowrap table-hover" cellspacing="0" width="100%" style="background-color: #f2f2f2;">
					<thead class="bg-primary">
						<tr>
							<th>Payee</th>
							<th>Total Amount Payable</th>
							<th>Transaction Date</th>
							<th>Control No.</th>
							<th>Type of Request</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $oi['firstname'] ?>  <?php if($oi['middlename']){  $m = $oi['middlename']; echo $m[0].'. '; }else{ echo " "; }  ?><?php echo $oi['lastname'] ?></td>
							<td>₱ <?php echo number_format($li['total_price'],2) ?></td>

							<?php foreach($getpt_byid_result as $pt){
								foreach($getpr_byid_result as $pr){
									if($pt['pr_id'] == $pr['id']){
										if($pr['status'] == 'Paid'){
							?>       
								<td><?php echo date("M. d, Y H:i:s", strtotime($pt['transaction_date'])); ?></td>              
								<td><?php echo $pr['control_no']?></td>
								<td><?php echo $pr['type']?></td>
								<td><?php echo number_format($pt['amount'],2); ?></td>
								<tr></tr><td colspan="2"></td>
							<?php }}}} ?>

							<?php if($a_paid == 0){ 
								echo '<td colspan="4"><center><code> No Payment History </code></center></td>';
							}else{ ?>
								<td colspan="5">
									<label class="text-danger" style="float:right">Balance:  ₱<?php echo number_format($get_remaining_balance['remaining_balance'],2) ?></label>
								</td>
							<?php }?>         
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>                            
</div>