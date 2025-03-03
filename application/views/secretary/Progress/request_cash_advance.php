<div class="container">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel" style="border-radius:10px;"> 
			<!--====================BODY====================-->
			<center><h5 class="title">DETAILS</h5></center>
			<?php if($this->session->userdata('user_type') == 'Secretary'){ ?>
				<div style="float:right">
				    <?php
				    $hasPendingRequest = false;

				    // Check if there is any 'Pending' request
				    if (!empty($getpr_byid_result)) {
				        foreach ($getpr_byid_result as $pr) {
				            if ($pr['status'] === 'Pending' || $pr['status'] === 'Approved') {
				                $hasPendingRequest = true;
				                break; // Stop checking further once we find a pending request
				            }
				        }
				    }

				    // If there is any pending request, disable the ADD CA button
				    if (!$hasPendingRequest) { ?>
				        <button class="btn btn-success" data-toggle="modal" data-target=".cash_advance" style="border-radius: 9px solid #fff">
				            ADD CA
				        </button>
				    <?php } else { ?>
				        <button class="btn btn-success" style="border-radius: 9px solid #fff" 
				            onclick="new PNotify({
				                title: 'Please be informed',
				                text: '<p>Sorry, You can\'t request right now because your request is still <?php echo $pr['status']; ?>. Please wait until it is processed. Thank You!</p>',
				                type: 'warning',
				                styling: 'bootstrap3'
				            }); remove_notif();"
				        >ADD CA</button>
				    <?php } ?>
				</div>
			<?php } ?>

			<div class="col-md-12"> 
				<span>Note :<i class="text-danger">Please click the status for more information. Thank you!</i></span> 
				<table class="table table-striped table-bordered dt-responsive nowrap table-hover" cellspacing="0" width="100%">
					<thead class="bg-primary">
						<tr>
							<th>CONTROL #</th>
							<th>DATE REQUEST</th>
							<th>PURPOSE</th>
							<th>AMOUNT</th>
							<th><center>STATUS</th>
							<th><center>ACTION</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if(!empty($getpr_byid_byca_result)){
							foreach($getpr_byid_byca_result as $ca){
						?>
								<tr>
									<td><?php echo $ca['control_no'] ?></td>
									<td><?php $date= date_create($ca['submission_date']); echo date_format($date,"F d, Y"); ?></td>
									<td class="purpose-hover">
										<?php echo "<div class='purpose-data' data-toggle='modal' data-target='.show_all_p_".$ca['control_no']."'>".$ca['purpose']." ".$ca['other_purpose']."</div>"; ?>
									</td>
									<td><?php echo number_format($ca['amount'],2); ?></td>            
									<td>
										<?php if($ca['status'] == 'Disapproved') { ?>
											<center><a class="text-danger" data-toggle="modal" data-target=".reason_disapproved_<?php echo $ca['control_no'];?>" data-backdrop="static" data-keyboard="false"><i><?php echo $ca['status'] ?></i></a>
										<?php } elseif($ca['status'] == 'Pending') { ?>
											<center><i class="text-danger" onclick="new PNotify({
												title: 'Please be informed',
												text: '<p>Your request is still reviewed by the General Manager. Thank you!</p>',
												type: 'warning',
												styling: 'bootstrap3'
												}); remove_notif();"><?php echo $ca['status'] ?></i>
											</center>
										<?php } elseif($ca['status'] == 'Approved') { ?>
											<center><i class="text-info" onclick="new PNotify({
												title: 'Please be informed',
												text: '<p>Cheque Request Form is still in process. Thank you!</p>',
												type: 'warning',
												styling: 'bootstrap3'
												}); remove_notif();"><?php echo $ca['status'] ?></i>
											</center>
										<?php } elseif($ca['status'] == 'Paid') { ?>
											<center><i class="text-success" onclick="new PNotify({
												title: 'Please be informed',
												text: '<p>Request Paid. Thank you!</p>',
												type: 'warning',
												styling: 'bootstrap3'
												}); remove_notif();"><?php echo $ca['status'] ?></i>
											</center>
										<?php } ?>
									</td>
									<td>
										<center>
											<button class="btn btn-default btn-xs btn-round" data-toggle="modal" data-target="#rca_<?php echo $ca['control_no']; ?>" title="View"><i class="fa fa-eye text-primary"></i> View</button>

											<button class="btn btn-default btn-xs btn-round" onclick="printModal('.ca<?= $ca['control_no'] ?>')" title="Print"> <i class="fa fa-print text-danger"></i> Print</button>
										</center>
									</td>
								</tr>
							<?php } ?>
						<?php } else { ?>
							<tr>
								<td colspan="6"><center><code> No Cash Advance Request </code></center></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<!--====================END BODY====================-->
		</div>
	</div>
</div>