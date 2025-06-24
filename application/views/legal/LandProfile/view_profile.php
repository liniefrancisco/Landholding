<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container">
		<!--====================BUTTON====================-->
		<button onclick="topFunction()" id="mvTop" title="Go to top" style="display: none;"><i class="fa fa-arrow-up"></i>Top</button>
		<div class="alert  alert-dismissible fade in animated zoomIn" role="alert" style="display:none; position:fixed; z-index: 99; bottom: 10px;right: 10px;" id="saved">
			<button type="button" class="close" id="clearMsg"><span aria-hidden="true">&times;</span></button>
			<span id="notif" style="display: inline-block;"></span>
		</div>
		<!--====================BODY====================-->
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!--====================FLASH DATA====================-->
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible fade in" role="alert" id="saved">
                    <i class="glyphicon glyphicon-ok"></i> <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php } ?>
            <!--====================END FLASH DATA====================-->
			<div class="x_panel animate fadeIn" style="border:1px; !important;box-shadow: 7px 6px 16px #888888;">
				<div class="x_title">
					<h2 class="fa fa-book" style="font-size:15px"> <b>Land Profile <u style="color:#eb5d0c"> <?php if ($oi['is_no']) { echo $oi['is_no']; } ?></u></b></h2>
					<a href="#" onclick="window.history.back()" class="btn btn-sm btn-warning pull-right"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
					<div class="clearfix"></div>
				</div>

				<div class="col-md-12 col-sm-12 col-xs-12 first_panel">
					<?php if(!$ud['land_sketch'] == null){ ?>      
						<div class="col-md-2 col-sm-2 col-xs-2">
							<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Land Sketch/'.$ud['land_sketch'].'') ?>" width="150px" height="120px" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19); border: 2px solid #4CAF50;">                                 
						</div>
					<?php }else{ ?>
						<div class="col-md-2 col-sm-2 col-xs-2">
							<img src="<?= base_url('assets/logo/no_file.png') ?>" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19); border: 2px solid #ff6600; max-width: 150px; max-height: 150px;" class="image-responsive">
						</div>
					<?php } ?>
					<div class="col-md-9 col-sm-9 col-xs-9"><label class="col-md-4 small">Lot. <b style="float: right;">:</b></label>  
						<i class="small"> <?php if($li['lot']){ echo $li['lot']; }else{ echo "None"; } ?></i>
					</div>
					<div class="col-md-9 col-sm-9 col-xs-9"><label class="col-md-4 small">Cad. <b style="float: right;">:</b></label>   
						<i class="small"> <?php if($li['cad']){ echo $li['cad']; }else{ echo "None"; } ?></i>
					</div>
					<div class="col-md-9 col-sm-9 col-xs-9"><label class="col-md-4 small">Land Title No. <b style="float: right;">:</b></label> 
						<i class="small"> <?php if($li['land_title_no']){ echo $li['land_title_no']; }else{ echo "None";} ?></i>
					</div>
					<div class="col-md-9 col-sm-9 col-xs-9"><label class="col-md-4 small">Tax Declaration No. <b style="float: right;">:</b></label> 
						<i class="small"> <?php if($li['tax_dec_no']){ echo $li['tax_dec_no']; }else{ echo "None"; } ?></i>
					</div>
					<div class="col-md-9 col-sm-9 col-xs-9"><label class="col-md-4 small">Lot Owner <b style="float: right;">:</b></label> 
						<i class="small"> <?php echo ucfirst($oi['firstname']) ?> <?php echo ucfirst($oi['lastname']) ?></i>
					</div>

					<div class="col-md-9 col-sm-9 col-xs-9"><label class="col-md-4 small">Lot Location <b style="float: right;">:</b></label>
						<i class="small"> <?php echo ucfirst($ll['street']) ?>- <?php echo ucfirst($ll['baranggay']) ?>, <?php echo ucfirst($ll['municipality']) ?>, <?php echo ucfirst($ll['province']) ?></i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12"> 
						<div class="col-md-2 col-sm-2 col-xs-2"><center><label><b style="color: #ff6600;">LAND SKETCH</b></label></center></div>
					</div>
				</div>

				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="col-md-4 col-sm-4 col-xs-4"></div>
					<div class="col-md-6 form-inline">
						<form id="lot_info">
							<select class="form-control" name="view_lot" id="view_select" required>
								<option value="">Select</option>
								<?php 
									if($li['tag'] == "New" || $li['tag'] == "Old" ){
										echo '<option value="IS">Interview Sheet</option>';
									}elseif ($li['tag'] == "New LAPF-ES" || $li['tag'] == "Old LAPF-ES") {
										echo '<option value="LAPF-ES">LAPF-ES</option>';
									}elseif ($li['tag'] == "New LAPF-JS" || $li['tag'] == "Old LAPF-JS") {
										echo '<option value="LAPF-JS">LAPF-JS</option>';
									}
								?>
								<option value="OI">Owner Information</option>
								<option value="OD">Owner Document</option>
								<?php 
									if($li['tag'] == "New" || $li['tag'] == "New LAPF-ES"){
										echo '<option value="SOP">Summary of Payment</option>';
									}
								?>
								<option value="RPT">RPT</option>
								<option value="Titling">Land Titling</option>
							</select>
							<button type="submit" class="btn btn-primary v-identifier" id="<?php echo $li['is_no'] ?>" style="margin-top:4px;"><i class="fa fa-folder-open"></i> View</button>
						</form>
					</div>
				</div>
 
				<div class="col-md-12 space  ledger doas">                    
				</div>
			</div>  
		</div>	
		<!--====================END BODY====================-->		
	</div>
</div>
<!--====================PAGE CONTENT====================-->

<style>
	.first_panel{
		border: 4px solid #f2f2f2; border-style: outset; background-color: #f2f2f2; margin-bottom: 30px;padding-top:10px
	}
</style>
