<div class="alert  alert-dismissible fade in animated zoomIn" role="alert" style="display:none; position:fixed; z-index: 99; bottom: 10px;right: 10px;" id="saved">
	<button type="button" class="close" id="clearMsg"><span aria-hidden="true">&times;</span></button>
	<span id="notif" style="display: inline-block;"></span>
</div>
<div class="row" id="refresh_me">
	<div class="container">
		<div class="col-md-12">
			<div class="x_panel animate slideInDown" style="box-shadow: 5px 8px 16px #888888">
				<div class="x_title">
					<h5><i class="fa fa-edit"></i> <b>Owner Information</b></h5>
					<div class="clearfix"></div>
				</div>
														 
				<div class="col-md-12 col-sm-12 col-xs-12 profile_details" id="profile_interface">
					<div class="well profile_view">
						<div class="col-sm-12">
							<h5 style="text-decoration:underline grey;font-weight:bold">
								<?php 
									$m = $oi['middlename']; 
									if(isset($m)){
									 	echo $oi['firstname'] ." ". $m[0] .". ". $oi['lastname']; 
									}else{ 
										echo "no record";
									}
								?>
							</h5>
							<ul class="list-unstyled">
								<li class="fa fa-building"> <b>Address:</b>
									<?php
										if(isset($oa['street'])){
											echo $oa['street'] .', '. $oa['baranggay'] .', '. $oa['municipality'] .', '. $oa['province'];
										}else{
											echo "no record";
										}
									?>	
								</li><br>
								<li class="fa fa-male"> <b>Gender:</b>
									<?php if(!empty($oi['gender'])){ echo $oi['gender']; }else{ echo "no record"; } ?>
								</li><br>
								<li class="fa fa-phone"> <b>Vital Status:</b>
									<?php if(isset($oi['vital_status'])){ echo $oi['vital_status']; }else{ echo "no record"; } ?>
								</li>
							</ul>
						</div>
						<div class="col-sm-12 bottom" style="background-color:#dbe0e0">
							<button type="button" class="btn btn-warning btn-xs pull-right" onclick="edit_profile();"><i class="fa fa-folder-open"></i> View</button>
						</div>
					</div>
				</div> 

				<div id="edit_interface" style="display:none;">
					<form id="edit_oi-v"  accept-charset="utf-8">
						<div class="x_panel" style="border-radius:9px; ">
							<center><div class="change-message">*You have unsaved changes.</div></center>
							<div class="row">
								<div class="x_panel2">
									<div class="x_title">
										<h5><b>Owner Name:</b></h5>   
										<div class="clearfix"></div>
									</div>
									<div class="form-group form-inline">                                         
										<div class="col-md-4 col-sm-4 col-xs-4">
											<label class="control-label">Firstname:</label>
											<input type="text" class="form-control" value="<?= $oi['firstname']?>" readonly>
										</div> 
										<div class="col-md-4 col-sm-4 col-xs-4">
											<label class="control-label">Middlename:</label>
											<input type="text" class="form-control" value="<?= $oi['middlename']?>" readonly>
										</div>  
										<div class="col-md-4 col-sm-4 col-xs-4">
											<label class="control-label">Lastname:</label>
											<input type="text" class="form-control" value="<?= $oi['lastname']?>" readonly>
										</div>                                         
									</div>                                     
								</div>
							</div>

							<div class="row space">
								<div class="x_panel2">
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-6">
											<div class="form-horizontal">
												<label class="col-md-3 control-label">Gender:</label>  
												<div class="col-md-9">
													<label class="col-md-3 control-label">
														<input type="checkbox" <?php if($oi['gender'] == 'Male'){ echo 'checked'; } ?> disabled>
														<label>Male</label>
													</label>
													<label class="control-label">
														<input type="checkbox" <?php if($oi['gender'] == 'Female'){ echo 'checked'; } ?> disabled>
														<label>Female</label>
													</label>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-6">
											<div class="form-horizontal">
												<label class="col-md-3 control-label">Vital Status:</label>  
												<div class="col-md-9">
													<label class="col-md-3 control-label">
														<input type="checkbox" <?php if($oi['vital_status'] == 'Alive'){ echo 'checked'; } ?> disabled>
														<label>Alive</label>
													</label>
													<label class="control-label">
														<input type="checkbox" <?php if($oi['vital_status'] == 'Deceased'){ echo 'checked'; } ?> disabled>
														<label>Deceased</label>
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row space">
								<div class="x_panel2">
									<div class="x_title">
										<h5><b>Owner Address:</b></h5>                 
										<div class="clearfix"></div>
									</div>

									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="form-horizontal">
											<div class="form-group">
												<label class="col-md-3 control-label">Region:</label>
												<div class="col-md-9">
													<input type="text" class="form-control" value="<?php echo $oa['region']?>" readonly>
												</div>
											</div>
										</div>
										<div class="form-horizontal">
											<div class="form-group">
												<label class="col-md-3 control-label">Province:</label>
												<div class="col-md-9">
													<input type="text" class="form-control" value="<?php echo $oa['province']?>" readonly>
												</div>
											</div>
										</div>
										<div class="form-horizontal">
											<div class="form-group">
												<label class="col-md-3 control-label">Municipality:</label>
												<div class="col-md-9">
													<input type="text" class="form-control" value="<?php echo $oa['municipality']?>" readonly>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="form-horizontal">
											<div class="form-group">
												<label class="col-md-3 control-label">Baranggay:</label>
												<div class="col-md-9">
													<input type="text" class="form-control" value="<?php echo $oa['baranggay']?>" readonly>
												</div>
											</div>
										</div>
										<div class="form-horizontal">
											<div class="form-group">
												<label class="col-md-3 control-label">Street:</label>
												<div class="col-md-9">
													<input type="text" class="form-control" value="<?= $oa['street'] ?>"  readonly>
												</div>
											</div>
										</div>				
										<div class="form-horizontal">
											<div class="form-group">
												<label class="col-md-3 control-label">Zip Code:</label>
												<div class="col-md-9">
													<input type="text" class="form-control" value="<?= $oa['zip_code'] ?>"  readonly required>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>													
						</div>
						<div class="modal-footer">
							<button class="btn btn-default btn-hover btn-md" onclick="cancel_edit();">Close</button>
						</div>
					</form>              		
				</div>  									 											
			</div>  
		</div>		
	</div>
</div>

<script type="text/javascript">
	function edit_profile(){
		document.getElementById('edit_interface').style.display = 'block';
		$('#profile_interface').hide();
	}
	function cancel_edit(){
		document.getElementById('profile_interface').style.display = 'block';
		$('#edit_interface').hide();
	}
</script>

<style>
	.x_panel2{
		margin-left: 9px;
		width: 98%;
		padding: 10px 17px;
		display: inline-block;
		background: #fff;
		border: 1px solid #E6E9ED;
		-webkit-column-break-inside: avoid;
		-moz-column-break-inside: avoid;
		column-break-inside: avoid;
		opacity: 1;
		transition: all .2s ease;
	}
</style>