<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissible fade in" role="alert" style="position: fixed; bottom: 10px; right: 10px; z-index: 99; cursor: pointer;" id="saved">
		<?php echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'. validation_errors('<i class="fa fa-remove"></i> '); ?>
	</div>
<?php } ?>

<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!--====================FLASH DATA====================-->
			<?php if ($this->session->flashdata('notif')) { ?>
				<div class="alert alert-success alert-dismissible fade in" role="alert" id="saved">
					<i class="glyphicon glyphicon-ok"></i> <?php echo $this->session->flashdata('notif'); ?>
				</div>
			<?php } ?>
			<!--====================END FLASH DATA====================-->
			<div class="x_panel animate slideInDown" style="border:1px; !important;box-shadow: 7px 6px 16px #888888;">
				<div class="x_title">
					<div class="title_left">
						<h2 style="word-spacing: 4px; letter-spacing: 1px; font-weight: bold; font-size: 14px;color: #2a3f54;"><i class="fa fa-edit" style="font-size:16px;"></i> Add Land</h2>
						<div style="float:right">
							<a type="a" href="<?= base_url() ?>" class="btn btn-custom-warning btn-hover btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>

				<?php $is_id=0;
					if(empty($is_no)){
						$is_no = "NA-0001";
					}
					foreach ($land_id as $li) {
						$is_id = substr($li['is_no'],3)+1;
						if(strlen($is_id) == 1){
							$is_no = "NA-000".$is_id;
						}elseif(strlen($is_id) == 2){
							$is_no = "NA-00".$is_id;
						}elseif(strlen($is_id) == 3){
							$is_no = "NA-0".$is_id;
						}else{
							$is_no = "NA-".$is_id;
						}
					}  
				?>

				<?php echo form_open('Acquisition', array('id' => 'add_acq'));?>
					<!--====================BODY====================-->
					<div class="x_panel" style="border-radius:9px;">
						<div class="row">        
							<div class="col-md-6 col-sm-6 col-xs-6" style="padding-bottom: 8px;">          
								<div class="form-group">
									<label class="control-label col-md-3" for="first-name">I.S No.</label>
									<div class="col-md-7">
										<input type="text"  name="is_no" value="<?php echo $is_no; ?>" class="form-control" onkeydown="return false" readonly/>
									</div>
								</div> 
							</div>

							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<label class="control-label col-md-3" for="first-name">Date Acquired</label>
									<div class="col-md-7 ">
										<input type="text" class="form-control has-feedback-left" id="date_acquired" readonly name="date_acquired">
										<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
										<span id="inputSuccess2Status2" class="sr-only">(success)</span>
									</div>
								</div>                            
							</div>
					
							<div class="col-md-12 col-xs-12 col-sm-12 text-center" style="border-top: 1px solid #ff6600; border-bottom: 1px solid #ff6600">
								<h5 style="letter-spacing:10px;">LAND INFORMATION</h5>
							</div>

							<input type="hidden"  name="p_by" value="<?php echo ucfirst($this->session->userdata('firstname')).' '.ucfirst($this->session->userdata('lastname'))?>" class="form-control" onkeydown="return false" readonly/>


							<div class="col-md-6 col-sm-6 col-xs-6 form-inline" style="margin-top:10px">
								<label class="control-label col-md-3">Lot No.<span class="required">*</span></label> 
								<div class="col-md-7">
									<input type="text" min="0" name="lot_no" class="form-control" value="<?php echo set_value('lot_no') ?>" required>
								</div>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-6 form-inline" style="margin-top:10px">
								<label class="control-label col-md-3">Cad.<span class="required">*</span></label> 
								<div class="col-md-7">
									<input type="text" min="0"  name="cad_no" class="form-control" value="<?php echo set_value('cad_no') ?>" >
								</div>
							</div>
										
							<div class="col-md-12 col-xs-12 col-sm-12 " style="border:1px solid #E6E9ED; display: inline;margin-top:15px">
								<div class="col-md-3 col-sm-3 col-xs-3" style="border-right: 3px solid #E6E9ED;">
									<h2 style="color:#1a1a1a;font-size:15px"><b>Lot Type:</b></h2>                 
								</div>

								<div class="col-md-3 col-sm-3 col-xs-3" style="border-right: 3px solid #E6E9ED;">
									<label class="r-contain"><input type="radio" name="lot_type" value="Agricultural" <?php if(@$_POST['lot_type'] == "Agricultural"){ echo "checked";} ?> required>Agricultural<span class="checkmark"></span></label>
								</div>

								<div class="col-md-3 col-sm-3 col-xs-3">
									<label class="r-contain"><input type="radio" name="lot_type" value="Commercial" <?php if(@$_POST['lot_type'] == "Commercial"){ echo "checked";} ?> required>Commercial<span class="checkmark"></span></label>
								</div>

								<div class="col-md-3 col-sm-3 col-xs-3" style="border-left: 3px solid #E6E9ED;">
									<label class="r-contain"><input type="radio" name="lot_type" value="Residential" <?php if(@$_POST['lot_type'] == "Residential"){ echo "checked";} ?> required>Residential<span class="checkmark"></span></label>
								</div>
							</div>  

							<div class="row">
								<div class="x_panel2">
									<div class="x_title">
										<h2 style="color:#1a1a1a;font-size:15px"><b>Lot Location:</b></h2>                 
										<div class="clearfix"></div>
									</div>

									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-6">
											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-3 control-label">Region<span class="required">*</span></label>
													<div class="col-md-7">
														<select class="form-control" id="region" name="region" onchange="loadProvince()" value="<?php echo set_value('region'); ?>" required>
															<option value="">Select Region</option>
														</select>
														<input type="hidden" id="selectedRegion" name="selectedRegion" readonly>
													</div>
												</div>
											</div>

											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-3 control-label">Province<span class="required">*</span></label>
													<div class="col-md-7">
														<select class="form-control" id="province" name="province" onchange="loadCity()" value="<?php echo set_value('province'); ?>"  required>
															<option value="">Select Province</option>
														</select>
														<input type="hidden" id="selectedProvince" name="selectedProvince" readonly>
													</div>
												</div>
											</div>

											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-3 control-label">Municipality<span class="required">*</span></label>
													<div class="col-md-7">
														<select class="form-control" id="town" name="town" onchange="loadBrgy()" value="<?php echo set_value('town'); ?>"  required>
															<option value="">Select City/Municipality</option>
														</select>
														<input type="hidden" id="selectedCity" name="selectedCity" readonly>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-6 col-sm-6 col-xs-6">
											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-3 control-label">Baranggay<span class="required">*</span></label>
													<div class="col-md-7">
														<select class="form-control" id="barangay" name="barangay" value="<?php echo set_value('baranggay') ?>" required>
															<option value="">Select Barangay</option>
														</select>
														<input type="hidden" id="selectedBaranggay" name="selectedBaranggay" readonly>
													</div>
												</div>
											</div>
															 
											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-3 control-label">Street<span class="required">*</span></label>
													<div class="col-md-7">
														<input type="text" class="form-control" name="street" id="street" value="<?php echo set_value('street') ?>"  required>
													</div>
												</div>
											</div>
																 
											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-3 control-label">Zip Code<span class="required">*</span></label>
													<div class="col-md-7">
														<input type="text" class="form-control" id="zipcode" name="zipcode" value="<?php echo set_value('zipcode') ?>"  readonly required>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>  
			
							<div class="row">   
								<div class="x_panel2">
									<div class="x_title">
										<h2 style="color:#1a1a1a;font-size:15px"><b>Lot Details:</b></h2>                 
										<div class="clearfix"></div>
									</div>

									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-6">
											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-3 control-label">Lot Sold<span class="required">*</span></label>
													<div class="col-md-7">
														<select class="form-control" name="lot_sold" id="sold" required>
															<option value="">Select</option>
															<option value="Portion"<?php if(@$_POST['lot_sold'] == "Portion"){ echo 'selected'; } ?> >Portion</option>
															<option value="Whole"<?php if(@$_POST['lot_sold'] == "Whole"){ echo 'selected'; } ?> >Whole</option>
														</select>
													</div>
												</div>
											</div>

											<div class="form-horizontal">
												<div class="form-group">
													<label class="col-md-3 control-label">Purchase Type<span class="required">*</span></label>
													<div class="col-md-7">
														<select class="form-control" id="purchase_type" name="purchase_type" required>
															<option value="" >Select</option>
															<option value="package" <?php if(@$_POST['purchase_type'] == "package"){ echo 'selected'; } ?> class="select_op">Package</option>
															<option value="per/sq.m." <?php if(@$_POST['purchase_type'] == "per/sq.m."){ echo 'selected'; } ?> class="select_op">Per/sq.m.</option>
														</select>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-6 col-sm-6 col-xs-6">
											<div class="control-group">
												<div class="controls">
													<label class="control-label col-md-3" for="first-name">Lot Area<span class="required">*</span></label>
													<div class="input-group col-md-7 xdisplay_inputx form-group has-feedback">
														<input id="la_form" name="lot_area" type="text" value="<?php echo set_value('lot_area') ?>"  class="form-control formca" required />
														<div class="input-group-addon">m<sup>2</sup></div>
													</div>
												</div>
											</div> 
											<div class="control-group"  id="Square" <?php if(isset($_POST['selling_price']) && @$_POST['purchase_type'] == "per/sq.m."){ echo 'style="display: block;"'; }else{ echo 'style="display: none;"';} ?>>
												<div class="controls">
													<label class="control-label col-md-3" for="first-name">Selling Price/m2<span class="required">*</span></label>
													<div class="input-group col-md-7 xdisplay_inputx form-group has-feedback">
														<div class="input-group-addon">₱</div>
														<input id="sp_form" name="selling_price" type="text" value="<?php echo set_value('selling_price') ?>"  class="form-control"/>
													</div>
												</div>
											</div> 
											<div class="control-group">
												<div class="controls">
													<label class="control-label col-md-3" for="first-name">Total Purchase Price<span class="required">*</span></label>
													<div class="input-group col-md-7 xdisplay_inputx form-group has-feedback">
														<div class="input-group-addon">₱</div>
														<input id="total_form" name="total_price" type="text" value="<?php echo set_value('total_price') ?>" class="form-control"  />
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row"> 
								<div class="x_panel2">
									<div class="x_title">
										<h2 style="color:#1a1a1a;font-size:15px"><b>Restriction/s to Land Title</b></h2>                 
										<div class="clearfix"></div>
									</div>

									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-2" style="border:3px solid #E6E9ED;">
												<label>Liens</label>
											</div>
											<div class="col-md-9 col-xs-12 col-sm-9" style="border:3px solid #E6E9ED;">
												<textarea style="width: 100%" name="liens" id="liens" class="form-control"><?php echo set_value('liens'); ?></textarea>
											</div>

											<div class="col-md-2" style="border:3px solid #E6E9ED;">
												<label>Easement</label>
											</div>
											<div class="col-md-9 col-xs-12 col-sm-9" style="border:3px solid #E6E9ED;">
												<textarea style="width: 100%" name="easement"  id="ease" class="form-control"><?php echo set_value('easement') ?></textarea>
											</div>

											<div class="col-md-2" style="border:3px solid #E6E9ED;">
												<label>Encumbrances</label>
											</div>
											<div class="col-md-9 col-xs-12 col-sm-9" style="border:3px solid #E6E9ED;">
												<textarea style="width: 100%" name="encumbrances" id="encum" class="form-control"><?php echo set_value('encumbrances') ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--====================END BODY====================-->
					<div class="col-md-12">
						<input class="btn btn-custom-primary btn-sm pull-right send" type="submit" name="submit" value="Proceed">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--====================END PAGE CONTENT====================-->

<script>
	$(function() {
	    $("#date_acquired").datepicker({
	        dateFormat: 'mm/dd/yy',
	    });
	    // Set current date
	    var d 		= new Date();
	    var month 	= d.getMonth() + 1;
	    var day 	= d.getDate();
	    var output 	= (month < 10 ? '0' : '') + month + '/' + (day < 10 ? '0' : '') + day + '/' + d.getFullYear();
	    $("#date_acquired").val(output);
	});
</script>

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(event) {
		$(function() {
			$('#purchase_type').change(function(){
				if($(this).val() == 'package'){
					$('#package').show();
					$('#Square').hide();
					$("#total_form").prop('readonly',false);
					$('#sp_form').val('');
					$('#total_form').val('');
				}else{
					$('#Square').show();
					$("#total_form").prop('readonly',true);
				} 
				$('#package').hide();
				$('#' + $(this).val()).show();
			});
		}); 

		document.querySelector('.send').addEventListener("click", function(){
			window.btn_clicked = true;
		});

		var $form 	= $('#add_acq'),
		origForm 	= $form.serialize();
		$('#add_acq :input').on('change input', function() {
			if($form.serialize() !== origForm){
				window.onbeforeunload = function(){
					if(!window.btn_clicked){ //was not clicked
						return 'Changes you made not be saved!';
					}
				};
			}
		});                                                     
	});               
</script>