<div class="container">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel" style="border-radius:9px;"> 
			<!--====================BODY====================-->
			<center><h5 class="modal-title1">DETAILS</h5></center>
			
			<div class="col-md-12"> 
				<table class="table table-sm table-striped table-bordered dt-responsive nowrap table-hover" cellspacing="0" width="100%">
					<thead class="bg-primary">
						<tr>
							<th>DOCUMENT REQUEST</th>
							<th>DATE REQUEST</th>
							<th><center>AMOUNT</center></th>
							<th><center>STATUS</center></th>
							<th><center>ACTION</center></th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (!empty($fp_info)) {
							$isPendingDisplayed = false; // Flag to check if "Pending" is displayed
							foreach ($fp_info as $fp) {
								if (!empty($fp['purpose_use']) && $fp['lpf_submission_date'] != '0000-00-00') {//Lot Purchase Form
									echo '<tr>';
										echo '<td>Lot Purchase Form</td>';
										echo '<td>' . date("F d, Y", strtotime($fp['lpf_submission_date'])) . '</td>';
										if (!$isPendingDisplayed) {
											echo '<td><center>' . number_format($fp['amount'], 2) . '</center></td>';
											$isPendingDisplayed = true;

											echo '<td>';
													if ($fp['status'] == 'Disapproved') {
														echo '<center>
																<a data-toggle="modal" data-target=".reason_disapproved_' . $fp['is_no'] . '" data-backdrop="static" data-keyboard="false" class="text-danger"><i class="fa fa-eye"> ' . $fp['status'] . '</i></a>
															</center>';
													} else {
														echo '<center><i class="text-success">' . $fp['status'] . '</i></center>';
													}
											echo '</td>';
										} else {
											echo '<td></td>'; // Empty cell for STATUS
											echo '<td></td>'; // Empty cell for AMOUNT
										}
										echo '<td>
												<center>
													<button class="btn btn-default btn-xs btn-round" data-toggle="modal" data-target="#lpf_' . $fp['is_no'] . '" title="View"><i class="fa fa-eye text-primary"></i>View</button>
													<button class="btn btn-default btn-xs btn-round" onclick="printlpf(\'.lpfp' . $fp['is_no'] . '\')" title="Print"><i class="fa fa-print text-danger"></i> Print</button>
												</center>
											</td>';
									echo '</tr>';
								}
								if (!empty($fp['note']) && $fp['cop_submission_date'] != '0000-00-00') {//Computation of Payment
									echo '<tr>';
										echo '<td>Computation of Payment</td>';
										echo '<td>' . date("F d, Y", strtotime($fp['cop_submission_date'])) . '</td>';
										if (!$isPendingDisplayed) {
											echo '<td><center>' . number_format($fp['amount'], 2) . '</center></td>';
											$isPendingDisplayed = true;

											echo '<td>';
													if ($fp['status'] == 'Disapproved') {
														echo '<center>
																<a data-toggle="modal" data-target=".reason_disapproved_' . $fp['is_no'] . '" data-backdrop="static" data-keyboard="false" class="text-danger"><i class="fa fa-eye"> ' . $fp['status'] . '</i></a>
															</center>';
													} else {
														echo '<center><i class="text-success">' . $fp['status'] . '</i></center>';
													}
											echo '</td>';
										} else {
											echo '<td></td>'; // Empty cell for STATUS
											echo '<td></td>'; // Empty cell for AMOUNT
										}
										echo '<td>
												<center>';
													$purchaseType = $li['purchase_type'];
													if($purchaseType == 'per/sq.m.'){
														echo '<button class="btn btn-default btn-xs btn-round" data-toggle="modal" data-target="#cp_sqm_' . $fp['is_no'] . '" title="View"><i class="fa fa-eye text-primary"></i> View</button>';
														echo '<button class="btn btn-default btn-xs btn-round" onclick="printcp(\'.cp_sqm_print_' . $fp['is_no'] . '\')" title="Print"><i class="fa fa-print text-danger"></i> Print</button>';
													}else if($purchaseType == 'package'){
														echo '<button class="btn btn-default btn-xs btn-round" data-toggle="modal" data-target=".cp_package_' . $fp['is_no'] . '" title="View"><i class="fa fa-eye text-primary"></i> View</button>';
														echo '<button class="btn btn-default btn-xs btn-round" onclick="printcp(\'.cp_package_print_' . $fp['is_no'] . '\')" title="Print"><i class="fa fa-print text-danger"></i> Print</button>';
													}
												'</center>
											</td>';
									echo '</tr>';
								}
								if (!empty($fp['notarial_fee']) && $fp['nf_submission_date'] != '0000-00-00') {//Notarial Fee
									echo '<tr>';
										echo '<td>Notarial Fee</td>';
										echo '<td>' . date("F d, Y", strtotime($fp['nf_submission_date'])) . '</td>';
										if (!$isPendingDisplayed) {
											echo '<td><center>' . number_format($fp['amount'], 2) . '</center></td>';
											$isPendingDisplayed = true;

											echo '<td>';
													if ($fp['status'] == 'Disapproved') {
														echo '<center>
																<a data-toggle="modal" data-target=".reason_disapproved_' . $fp['is_no'] . '" data-backdrop="static" data-keyboard="false" class="text-danger"><i class="fa fa-eye"> ' . $fp['status'] . '</i></a>
															</center>';
													} else {
														echo '<center><i class="text-success">' . $fp['status'] . '</i></center>';
													}
											echo '</td>';
										} else {
											echo '<td></td>'; // Empty cell for STATUS
											echo '<td></td>'; // Empty cell for AMOUNT
										}
										echo '<td>
												<center>
													<button class="btn btn-default btn-xs btn-round" data-toggle="modal" data-target="#nf_' . $fp['is_no'] . '" title="View"> <i class="fa fa-eye text-primary"></i>View</button>
													<button class="btn btn-default btn-xs btn-round" onclick="printnf(\'.nfp' . $fp['is_no'] . '\')" title="Print">
													<i class="fa fa-print text-danger"></i> Print</button>
												</center>
											</td>';
									echo '</tr>';
								}
								if (!empty($fp['commission_fee']) && $fp['ac_submission_date'] != '0000-00-00') {//Agent Commission 
									echo '<tr>';
										echo '<td>Agent Commission</td>';
										echo '<td>' . date("F d, Y", strtotime($fp['ac_submission_date'])) . '</td>';
										if (!$isPendingDisplayed) {
											echo '<td><center>' . number_format($fp['amount'], 2) . '</center></td>';
											$isPendingDisplayed = true;

											echo '<td>';
													if ($fp['status'] == 'Disapproved') {
														echo '<center>
																<a data-toggle="modal" data-target=".reason_disapproved_' . $fp['is_no'] . '" data-backdrop="static" data-keyboard="false" class="text-danger"><i class="fa fa-eye"> ' . $fp['status'] . '</i></a>
															</center>';
													} else {
														echo '<center><i class="text-success">' . $fp['status'] . '</i></center>';
													}
											echo '</td>';
										} else {
											echo '<td></td>'; // Empty cell for STATUS
											echo '<td></td>'; // Empty cell for AMOUNT
										}
										echo '<td>
												<center>
													<button class="btn btn-default btn-xs btn-round" data-toggle="modal" data-target=".ac_' . $fp['is_no'] . '" title="View"><i class="fa fa-eye text-primary"></i>View</button>
													<button class="btn btn-default btn-xs btn-round" onclick="printac(\'.acp' . $fp['is_no'] . '\')" title="Print"><i class="fa fa-print text-danger"></i> Print</button>
												</center>
											</td>';
									echo '</tr>';
								}
								if (!empty($fp['acknowledgement_receipt']) && $fp['ar_submission_date'] != '0000-00-00') {//Acknowledgement Receipt
									echo '<tr>';
										echo '<td>Acknowledgement Receipt</td>';
										echo '<td>' . date("F d, Y", strtotime($fp['ar_submission_date'])) . '</td>';
										if (!$isPendingDisplayed) {
											echo '<td><center>' . number_format($fp['amount'], 2) . '</center></td>';
											$isPendingDisplayed = true;
											
											echo '<td>';
													if ($fp['status'] == 'Disapproved') {
														echo '<center>
																<a data-toggle="modal" data-target=".reason_disapproved_' . $fp['is_no'] . '" data-backdrop="static" data-keyboard="false" class="text-danger"><i class="fa fa-eye"> ' . $fp['status'] . '</i></a>
															</center>';
													} else {
														echo '<center><i class="text-success">' . $fp['status'] . '</i></center>';
													}
											echo '</td>';
										} else {
											echo '<td></td>'; // Empty cell for STATUS
											echo '<td></td>'; // Empty cell for AMOUNT
										}
										echo '<td>
												<center>
													<button class="btn btn-default btn-xs btn-round" data-toggle="modal" data-target="#ar_' . $fp['is_no'] . '" title="View"><i class="fa fa-eye text-primary"></i>View</button>
													<button class="btn btn-default btn-xs btn-round" onclick="printar(\'.arp' . $fp['is_no'] . '\')" title="Print"><i class="fa fa-print text-danger"></i> Print</button>
												</center>
											</td>';
									echo '</tr>';
								}
							} 
						} else {
							echo '<tr>';
							echo '<td colspan="4"><center><code>No Full Payment Request</code></center></td>';
							echo '</tr>';
						}
						?>
					</tbody>
				</table>
			</div>
			<!--====================END BODY====================-->
		</div>
	</div>
</div>