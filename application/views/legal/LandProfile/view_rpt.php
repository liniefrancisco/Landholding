<!--====================PAGE CONTENT====================-->
<div class="x_panel animate slideInDown" style="box-shadow: 5px 8px 16px #888888">
	<div class="x_title">
		<h5><i class="glyphicon glyphicon-stats"></i> <b>Real Property Tax</b></h5>                                
		<div class="clearfix"></div>
	</div>
																				
	<div class="row">
		<div class="container">
			<div class="col-md-12">								
				<div class="x_content">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-6" style="box-shadow: -7px 6px 16px #888888">
							<div class="x_title space">
								<h2><i class="fa fa-align-left"></i></h2>
								<div class="clearfix"></div>
							</div>
							<div class="x_panel" style="border-radius:9px;">
								<!--====================START OF ACCORDION====================-->
								<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
									<!--====================ACQUISITION YEAR====================-->
									<div class="panel">
										<a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
											<h4 class="panel-title">Acquisition Year<i class="glyphicon glyphicon-chevron-down" style="float:right;"></i></h4>
										</a>
										<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height:0px;">
											<div class="panel-body">
												<table class="table table-bordered">
													<thead>
														<tr>
															<th class="text-center">IS Number</th>
															<th class="text-center">Date Acquired</th>
															<th class="text-center">TaxDec Effectivity</th>
														</tr>
													</thead>
													<tbody>
														<?php $date_acq = date_create($li['date_acquired']); ?> 
														<?php $effective_year = isset($aslvl['Effective_year']) ? date_create($aslvl['Effective_year']) : null; ?>
														<tr>
															<td class="text-center"><?= $li['is_no'] ?></td>
															<td class="text-center"><?php echo date_format($date_acq,"F d, Y"); ?></td>
															<td class="text-center"><?php echo isset($aslvl['Effective_year']) ? $aslvl['Effective_year'] : ''; ?></td>
														</tr>
													</tbody>
												</table> 
											</div>
										</div>
									</div>
									<!--====================UNPAID REAL PROPERTY TAX====================-->
									<div class="panel">
										<a class="panel-heading" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
											<h4 class="panel-title">Unpaid Real Property Tax<i class="glyphicon glyphicon-chevron-down" style="float:right;"></i></h4>
										</a>
										<div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="true">
											<div class="panel-body">
												<div class="col-md-12 table-responsive">
													<div style="overflow-x:auto;">
														<table class="table table-bordered">
															<thead>
																<tr>
																	<th class="text-center">Tax No.</th>
																	<th class="text-center">Assessment level</th>
																	<th class="text-center">Amount</th>
																	<th class="text-center">Year</th>
																	<th class="text-center">Status</th>
																</tr>
															</thead>
															<tbody>
																<?php
																	if($li['tag'] == "New" || $li['tag'] == "Old"){
																		if(ucfirst($ll['province']) == "Manila"){
																			$per =  $aslvl['Assessment_Level'] * 0.01;
																			$assessed_value = $li['total_price'] * $per;
																			$rpt = $assessed_value * .02;
																		}else{
																			// $per =  $aslvl['Assessment_Level'] * 0.01;
																			$per = (isset($aslvl['Assessment_Level']) ? $aslvl['Assessment_Level'] : 0) * 0.01;
																			$assessed_value = $li['total_price'] * $per;
																			$rpt = $assessed_value * .01;
																		}
																	}elseif($li['tag'] == "New LAPF-ES" || $li['tag'] == "Old LAPF-ES"){ //partial pa..
																		if(ucfirst($ll['province']) == "Manila"){
																			$per =  $aslvl['Assessment_Level'] * 0.01;
																			$assessed_value = $ab['final_value'] * $per;
																			$rpt = $assessed_value * .02;
																		}else{
																			$per =  $aslvl['Assessment_Level'] * 0.01;
																			$assessed_value = $ab['final_value'] * $per;
																			$rpt = $assessed_value * .01;
																		}
																	}elseif($li['tag'] == "New LAPF-JS" || $li['tag'] == "Old LAPF-JS"){ //not confirm
																		if(ucfirst($ll['province']) == "Manila"){
																			$per =  $aslvl['Assessment_Level'] * 0.01;
																			$assessed_value = $li['total_price'] * $per;
																			$rpt = $assessed_value * .02;
																		}else{
																			$per =  $aslvl['Assessment_Level'] * 0.01;
																			$assessed_value = $li['total_price'] * $per;
																			$rpt = $assessed_value * .01;
																		}
																	}	 
																?>
																<tr>
																	<td class="text-center"><?= $li['tax_dec_no'] ?></td>
																	<td class="text-center">
																		<?php 
																			if (empty($aslvl['Assessment_Level'])) {
																				echo "<code>not set</code>"; 
																			}else{ 
																				echo "". number_format($aslvl['Assessment_Level']) ."%"; 
																			} 
																		?>
																	</td>
																	<td class="text-center"><?= number_format($rpt,2) ?></td>
																	<td class="text-center">
																		<?php
																			$current_year 	= date('Y');
																			$effective_year = isset($aslvl['Effective_year']) ? $aslvl['Effective_year'] : null;
																			$paid_years 	= [];

																			foreach($rpt_yearpaid as $value) {
																			    $year_paid 		= date_create($value['year_paid']);
																			    $paid_years[] 	= date_format($year_paid,"Y");
																			}

																			// Get all expected years from start to current
																			$expected_years = range($effective_year + 1, $current_year);
																			// Get unpaid years by comparing with paid years
																			$unpaid_years = array_diff($expected_years, $paid_years);

																			if (!empty($paid_years)) {
																			    echo "<code>" . implode(', ', $unpaid_years) . "</code>";
																			}
																		?>
																	</td>
																	<td class="text-center">
																	    <?php if (!empty($aslvl['Effective_year'])) { echo "<code>Unpaid</code>"; } ?>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--====================END LATEST REAL PROPERTY TAX====================-->
								</div>								
							</div>
						</div>
						<!--====================PAID RPT====================-->	
						<div class="col-md-6 col-xs-6 col-sm-6" style="box-shadow: 7px 6px 16px #888888" id="tablepay">
							<div class="x_title space">
                                <h4 class="fa fa-area-chart"> Paid RPT</h4>
                                <div class="clearfix"></div>
                            </div>
							<div class="x_panel" style="border-radius:9px;">
								<div class="row">
									<table id="paid_rpt_each" class="table table-striped table-bordered dataTable no-footer" cellspacing="0" width="40%">
										<thead>
											<tr>
												<th><center>Amount</center></th>
												<th><center>Assessment level</center></th>
												<th><center>Date Paid</center></th>
												<th><center>Status</center></th>
												<th><center>Attachment</center></th>
											</tr>
										</thead>
										<tbody >
												<?php 
													foreach($rpt_yearpaid as $data){ 
														if($data['is_no'] == $aslvl['is_no']){
															$year_paid = date_create($data['year_paid']);
												?>
													<tr>
														<td class="text-center"><?php echo number_format($data['amount'],2) ?></td>
														<td class="text-center"><?php echo number_format($aslvl['Assessment_Level']) ?>%</td>
														<td class="text-center"><?php echo date_format($year_paid,"F d, Y"); ?></td>
														<td class="text-center text-success"><?php echo $data['status'] ?></td>

														<td class="text-center">
															<?php if (!empty($data['rpt_file'])) { ?>
																<?php 
																	$rpt_file = base_url('assets/img/rpt_uploads/' . $data['is_no'] . '/' . $data['rpt_file']);
																?>
													            <button class='btn btn-xs btn-default' onclick="viewImage('<?php echo $rpt_file; ?>')"><i class="glyphicon glyphicon-folder-open text-warning"></i> View</button>
													        <?php } ?>
														</td>
													</tr>
												<?php }} ?>
									 	</tbody>  
									</table>										
								</div>
							</div>
						</div>   
						<!--====================END PAID RPT====================-->     
					</div>
				</div>
			</div>    
		</div>
	</div>
</div>  
<!--====================END PAGE CONTENT====================-->

<!-- <script type="text/javascript">
	$('#paid_rpt_each').DataTable();	
</script> -->