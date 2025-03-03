<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container">
		<?php if($pr['status'] == 'Pending'){ ?>
			<div class="col-md-12 space">
				<div class="col-md-9"></div>
				<div class="col-md-3" style="position: fixed;width: 250px;bottom: 20px;right: 10px;z-index: 99;cursor: pointer;">
					<button style="float: right;" class="btn btn-danger btn-sm" data-dismiss="modal"  data-toggle="modal" data-target=".disapproved_<?php echo $pr['control_no']; ?>" title="Disapprove" ><span class="fa fa-close"></span> Disapproved</button>
					<button style="float: right;" class="btn btn-info btn-sm" data-dismiss="modal"  data-toggle="modal" data-target=".approved_<?php echo $pr['control_no']; ?>" title="Approve" ><span class="fa fa-check"></span> Approved</button>
				</div>
			</div>
		<?php } ?>

		<div class="col-md-12 col-sm-12 col-xs-12">
			<!--====================BODY====================-->
			<div class="x_panel animate slideInDown" style="border:1px; !important;box-shadow: 7px 6px 16px #888888;">
				<div class="x_title">
					<div class="title_left">
						<h2 class="fa fa-money"> <b>Cash Advance <u style="color:#eb5d0c"> <?php if($oi['is_no']) { echo $oi['is_no']; } ?></u></b></h2>
						<div style="float:right">
	                        <a href="#" onclick="window.history.back()" class="btn btn-sm btn-warning"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
	                    </div>
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="col-md-12 form_border">                              
					<center><img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
						<h4 class="modal-title1">CASH ADVANCE</h4>
					</center>
				</div>

				<div class="x_panel" style="border-radius:9px;background-color: #f5f5f5">
													
					<input type="hidden" class="form-control input_border" id="is_no" value="<?php echo ucfirst($li['is_no']) ?> "  name="is_no" readonly>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-12 form-inline">
							<label class="col-md-2">Date Request <b style="float: right;">:</b></label> 
							<span><?php echo $pr['submission_date']?></span>  
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-12 form-inline">
							<label class="col-md-2">CA Control No. <b style="float: right;">:</b></label>   
							<span><?php echo $pr['control_no']?></span>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-12 form-inline">
							<label class="col-md-2">Amount in Figure <b style="float: right;">:</b></label>   
							<span>₱<?php echo number_format($pr['amount'],2)?></span>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-12 form-inline">
							<label class="col-md-2">Amount in Words <b style="float: right;">:</b></label>   
							<?php $this->load->helper('custom'); ?>
							<span style="color:#ff6600"><?php echo number_to_words($pr['amount'],2)?> Pesos</span>
						</div>
					</div>

					<div class="col-md-12"><br/>
						<p class="paragrap">
							Cash Advance for Lot. <b class="txt"><?php echo $li['lot'];?></b>,
							Cad. <b class="txt"><?php echo $li['cad'] ?></b>,
							located at <b class="txt"><i><?php echo $ll['street'] ?>, <?php echo $ll['baranggay']?>, <?php echo $ll['municipality']?>, <?php echo $ll['province']?></i></b>,
							with an area of approximately <b class="txt"><?php echo number_format($li['lot_size'],2) ?></b> (Sq/meter) square meters, under Original Certificate Title No. <b class="txt"><?php echo $li['land_title_no'] ?></b>
							/ Tax Declaration No. <b class="txt"><?php echo $li['tax_dec_no'] ?></b>, 
							in the name of <b class="txt"><i><?php echo ucfirst($oi['firstname']) ?> <?php echo ucfirst($oi['middlename']) ?> <?php echo ucfirst($oi['lastname']) ?></i></b>.
						</p>
					</div>

					<div class="col-md-12 col-xs-12 col-sm-12">
						<div class="row" style="border: 2px solid rgba(128, 128, 128, 0.33);">
							<div class="form-group">
								<label class="control-label col-md-3">Purpose *</label>
								<div class="form-horizontal col-md-9">
									<?php 
										$purposesFull 			= array('Personal','Affidavit of Surrender of Landholdings','Capital Gains Tax','Estate Tax','Notary Fee','Real Property Tax','Documentary Stamp Tax');
										$purposesFromDB 		= $pr['purpose'];
										$purposesFromDBArray 	= explode(', ',$purposesFromDB);
										foreach($purposesFull as $item){
											$checked = in_array($item,$purposesFromDBArray) ? 'checked' : 'disabled';
											echo '<input type="checkbox" name="purs[]"'.$checked.' readonly>'.$item;
											echo '<br/>';
										}
									?>
																			 
									<label class="control-label">Others *</label>
									<textarea  class="form-control col-md-3" style="margin-bottom:10px;max-width:100%" readonly><?php echo $pr['other_purpose'] ?></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>  
			<!--====================END BODY====================-->
		</div>
	</div> 
	<?php include 'modal.php'; ?>
</div>
<!--====================END PAGE CONTENT====================-->

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(event) {
		//DISAPPROVED CASH ADVANCE 
		$(".disapproved").click(function () {
            var id 		= $(this).attr("id");
            var reason 	= $("#disapproved_message").val(); // Get the reason from the textarea
            $.ajax({
                url: "<?php echo base_url('Payment/submit_disapproved_payment/"+id+"') ?>",
                type: "post",
                data: {
                    'is_no': id,
                    'disapproved_message': reason, // Send the reason to the server
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function (data) {
                    window.location.replace("<?php echo base_url('Payment/pop_up_disapproved') ?>/" + id + "");
                }
            });
        });
		//APPROVED CASH ADVANCE
		$(".approved").click(function () {
            var id = $(this).attr("id");
            $.ajax({
                url: "<?php echo base_url('Payment/submit_approved_payment/"+id+"') ?>",
                type: "post",
                data: { '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>' },
                success: function () {
                    window.location.replace("<?php echo base_url('Payment/pop_up_approved/"+id+"') ?>");
                }
            });
        });
		//END APPROVED CASH ADVANCE
	});
</script>