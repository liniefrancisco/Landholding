<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
    <div class="row row_container">
    	<button onclick="topFunction()" id="mvTop" title="Go to top"><i class="fa fa-arrow-up"></i>Top</button>
    	<?php if($ds['status'] == 'Pending' && $this->session->userdata('user_type') == 'GM'){ ?>
			<div class="col-md-12 space">
				<div class="col-md-9"></div>
				<div class="col-md-3" style="position: fixed;width: 250px;bottom: 20px;right: 10px;z-index: 99;cursor: pointer;">
					<button style="float: right;" class="btn btn-danger btn-sm" data-dismiss="modal"  data-toggle="modal" data-target=".disapproved_<?php echo $ds['is_no']; ?>" title="Disapprove" ><span class="fa fa-close"></span> Disapproved</button>
					<button style="float: right;" class="btn btn-success btn-sm" data-dismiss="modal"  data-toggle="modal" data-target=".approved_<?php echo $ds['is_no']; ?>" title="Approve" ><span class="fa fa-check"></span> Approved</button>
				</div>
			</div>
		<?php } ?>
        <div class="col-md-12 col-sm-12 col-xs-12">
			<!--====================START CONTENT====================-->
			<div class="x_panel animate  fadeInLeft" style="box-shadow: 5px 8px 16px #888888">
				<div class="x_title">
                    <h2 class="fa fa-bank"> <b>Settlement</b></h2>
                    <a href="#" onclick="window.history.back()" class="btn btn-sm btn-warning pull-right"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
                    <div class="clearfix"></div>
                </div>

				<div class="x_panel" style="border-radius:10px;">
					<div class="row text-center space">
                        <img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
                        <h5><b>LAND AS PAYMENT FORM - JUDICIAL SETTLEMENT (LAPF-JS)</b></h5>
                    </div>

					<div class="col-md-12 col-sm-12 col-xs-12 space">
                        <div class="col-md-4 col-xs-4 col-sm-4 form-inline">
                            <label>LAPF-JS #:</label>
                            <input class="form-control" type="text" value="<?php echo $li['is_no'] ?>" readonly>
                        </div>
                        <div class="col-md-4 col-sm-4  col-xs-4 form-inline pull-right">
                        	<?php $date_acq = date_create($li['date_acquired']); ?> 
                            <label>Date:</label>
                            <input class="form-control" type="text" value="<?php echo date_format($date_acq,"F d, Y"); ?>" readonly>
                        </div>
                    </div>
								
					<div class="col-md-12 col-sm-12 col-xs-12 text-center space" style="border-top:1px solid #ff6600; border-bottom:1px solid #ff6600;">
                        <h6 style="letter-spacing:5px;">CUSTOMER BALANCE INFORMATION</h6>
                    </div>

			        <div class="col-md-12 col-sm-12 col-xs-12 space">
                        <div class="col-md-3 col-sm-3 col-xs-3"><label>Case Type:</label></div>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input type="checkbox" <?php if($cbi['case_type'] == "Small claim case"){ echo "checked"; } ?> disabled>
			            	<label>Small claim case</label>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input type="checkbox" <?php if($cbi['case_type'] == "Collection of Sum Money"){ echo "checked"; } ?> disabled>
			              	<label>Collection of Sum Money</label>
                        </div>
                    </div>

                    <div class="col-md-12 space">
                        <div class="col-md-3"><label>Business Unit:</label></div>
                        <div class="col-md-9">
                            <input class="form-control" type="text" value="<?php echo $cbi['business_unit'] ?>" readonly>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 space">
                        <div class="col-md-3 col-sm-3 col-xs-3"><label>Customer Name:</label></div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <input class="form-control text-center" type="text" value="<?php echo $ci['firstname'] ?>" readonly>
                            <h6 class="text-center"><i>Firstname</i></h6>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <input class="form-control text-center" type="text" value="<?php echo $ci['middlename'] ?>" readonly>
                            <h6 class="text-center"><i>Middlename</i></h6>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <input class="form-control text-center" type="text" value="<?php echo $ci['lastname'] ?>" readonly>
                            <h6 class="text-center"><i>Lastname</i></h6>
                        </div>
                    </div>

					<div class="col-md-12 col-sm-12 col-xs-12 space"> 
						<div class="col-md-3 col-sm-3 col-xs-3"><label>Customer Address:</label></div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control text-center" type="text" value="<?php echo $ca['street'] ?>" readonly>
							<h6 class="text-center"><i>Street</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control text-center" type="text" value="<?php echo $ca['barangay'] ?>" readonly>
							<h6 class="text-center"><i>Baranggay</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control text-center" type="text" value="<?php echo $ca['municipality'] ?>" readonly>
							<h6 class="text-center"><i>Town</i></h6>
						</div>

						<div class="col-md-3 col-sm-3 col-xs-3"></div>

						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control text-center" type="text" value="<?php echo $ca['province'] ?>" readonly>
							<h6 class="text-center"><i>Province</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control text-center" type="text" value="<?php echo $ca['country'] ?>" readonly>
							<h6 class="text-center"><i>Country</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control text-center" type="text" value="<?php echo $ca['zip_code'] ?>" readonly>
							<h6 class="text-center"><i>Zip Code</i></h6>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 space" style="border-top:1px solid #ff6600; border-bottom:1px solid #ff6600;">
                        <center><h6 style="letter-spacing:5px;">ATTACHMENT</h6></center>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 space">
                        <div class="col-md-4 col-xs-4 col-sm-4 form-inline">
                            <label>Lot :</label>
                            <input class="form-control" type="text" value="<?php echo $li['lot'] ?>" readonly>
                        </div>
                        <div class="col-md-4 col-sm-4  col-xs-4 form-inline pull-right">
                            <label>Cad :</label>
                            <input class="form-control" type="text" value="<?php echo $li['cad'] ?>" readonly>
                        </div>
                    </div>

					<div class="col-md-12 col-sm-12 col-xs-12 space">
						<div class="col-md-3 col-sm-3 col-xs-3 lot_type" style="height: 29px;"><label>Lot Type:</label></div>
						<div class="col-md-3 col-sm-3 col-xs-3 lot_type">
							<input type="checkbox" value="" <?php if($li['lot_type'] == 'Agricultural'){ echo "checked";} ?> disabled>
							<label> Agricultural</label>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3 lot_type">
							<input type="checkbox" value="" <?php if($li['lot_type'] == 'Commercial'){ echo "checked";} ?> disabled>
							<label> Commercial</label>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3 lot_type">
							<input type="checkbox" value="" <?php if($li['lot_type'] == 'Residential'){ echo "checked";} ?> disabled>
							<label> Residential</label>
						</div>
					</div>
						

					<div class="col-md-12 col-sm-12 col-xs-12 space"> 
						<div class="col-md-3 col-sm-3 col-xs-3"><label>Lot Owner:</label></div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control text-center" type="text" value="<?php echo $oi['firstname'] ?>" readonly>
							<h6 class="text-center"><i>Firstname</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control text-center" type="text" value="<?php echo $oi['middlename'] ?>" readonly>
							<h6 class="text-center"><i>Middlename</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control text-center" type="text" value="<?php echo $oi['lastname'] ?>" readonly>
							<h6 class="text-center"><i>Lastname</i></h6>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 space">
						<div class="col-md-3 col-sm-3 col-xs-3"><label>Gender:</label></div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<input type="checkbox" <?php if($oi['gender'] == 'Male'){ echo "checked"; } ?> disabled>
							<label> Male</label>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<input type="checkbox" <?php if($oi['gender'] == 'Female'){ echo "checked"; } ?> disabled>
							<label> Female</label>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 space">
						<div class="col-md-3 col-sm-3 col-xs-3"><label>Vital Status:</label></div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<input type="checkbox" <?php if($oi['vital_status'] == 'Alive'){ echo "checked"; } ?> disabled>
							<label> Alive</label>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<input type="checkbox" <?php if($oi['vital_status'] == 'Deceased'){ echo "checked"; } ?> disabled>
							<label> Deceased</label>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 space"> 
						<div class="col-md-3 col-sm-3 col-xs-3"><label>Lot Location:</label></div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control text-center" type="text" value="<?php echo $ll['street'] ?>" readonly>
							<h6 class="text-center"><i>Street</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control text-center" type="text" value="<?php echo $ll['baranggay'] ?>" readonly>
							<h6 class="text-center"><i>Baranggay</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control text-center" type="text" value="<?php echo $ll['municipality'] ?>" readonly>
							<h6 class="text-center"><i>Municipality</i></h6>
						</div>

						<div class="col-md-3 col-sm-3 col-xs-3"><label></div>

						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control text-center" type="text" value="<?php echo $ll['province'] ?>" readonly>
							<h6 class="text-center"><i>Province</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control text-center" type="text" value="<?php echo $ll['country'] ?>" readonly>
							<h6 class="text-center"><i>Country</i></h6>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<input class="form-control text-center" type="text" value="<?php echo $ll['zip_code'] ?>" readonly>
							<h6 class="text-center"><i>Zipcode</i></h6>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 space">
						<div class="col-md-3 col-sm-3 col-xs-3"><label>Lot for bidding:</label></div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<input type="checkbox" <?php if($li['lot_sold'] == "Portion"){ echo "checked"; } ?> disabled>
							<label> Portion</label>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<input type="checkbox" <?php if($li['lot_sold'] == "Whole"){ echo "checked"; } ?> disabled>
							<label> Whole</label>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 space">
                        <div class="col-md-3 col-sm-3 col-xs-3 form-inline"><label>Lot Size:</label></div>
                        <div class="col-md-4 col-sm-4 col-xs-4 form-inline">
                            <input class="form-control input_border" type="text" value="<?php echo number_format($li['lot_size'],2) ?>" readonly>
                            <label>sq/m</label>
                        </div>
                    </div>

					<div class="col-md-12 col-sm-12 col-xs-12 space">
						<div class="col-md-4 col-sm-4 col-xs-4">
							<label>Available Proof of Title/Ownership:</label>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<label>
								<input type="checkbox" <?php if(!$ud['oct'] == null){ echo "checked"; } ?> disabled>
								<label> Original Certificate of Title (OCT)</label>
							</label>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							<label>
								<input type="checkbox" <?php if(!$ud['tct'] == null){ echo "checked"; } ?> disabled>
								<label> Transfer Certificate of Title (TCT)</label>
							</label>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-4 col-sm-4 col-xs-4"></div>
						<div class="col-md-4 col-sm-4 col-xs-4" id="oct">
							<?php if(!$ud['oct'] == null){  ?>
								<?php
					                $oct_path = base_url('assets/img/uploaded_documents/' . $ud['is_no'] . '/OCT/' . $ud['oct']);
					            ?>
					            <button class='btn btn-info' onclick="viewImage('<?php echo $oct_path; ?>')">View 
					                <span class="glyphicon glyphicon-folder-open"></span>
					            </button>
							<?php } ?>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4"  id="tct">
							<?php if(!$ud['tct'] == null){ ?>
								<?php
					                $tct_path = base_url('assets/img/uploaded_documents/' . $ud['is_no'] . '/TCT/' . $ud['tct']);
					            ?>
					            <button class='btn btn-info' onclick="viewImage('<?php echo $tct_path; ?>')">View 
					                <span class="glyphicon glyphicon-folder-open"></span>
					            </button>
							<?php } ?>
						</div>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12 text-center space" style="border-top:1px solid #ff6600; border-bottom:1px solid #ff6600;">
                        <h6 style="letter-spacing:5px;">BIDDING DETAILS</h6>
                    </div>

					<div class="col-md-12 col-sm-12 col-xs-12 space">
						<div class="col-md-4 col-sm-4 col-xs-4 form-inline">
							<label>Bid Price: ₱</label>
							<input class="form-control input_border" type="text" value="<?php echo number_format($bd['bid_price'],2) ?>" readonly>
						</div>
						<div class="col-md-6 form-inline">
							<label>Status:</label>
							<input class="form-control input_border" type="text" value="<?php echo $bd['highest_bidder'] ?>" readonly>
							<label>Highest Bidder</label>
						</div>
					</div>
				</div>
			</div>
			<!--====================END START CONTENT====================-->
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
            var status 	= "Disapproved";

            if (reason === "") {
		        alert("Disapproval message is required.");
		        $("#disapproved_message").focus();
		        return false; // Stop form submission
		    }
		    
            $.ajax({
                url: "<?php echo base_url('Aspayment/submit_disapproved_request/"+id+"') ?>",
                type: "post",
                data: {
                    'is_no': id,
                    'disapproved_message': reason, // Send the reason to the server
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function (data) {
                    window.location.replace("<?php echo base_url('Aspayment/pop_up_notification/"+status+"') ?>");
                }
            });
        });
		//APPROVED ASPAYMENT
		$(".approved").click(function () {
            var id 		= $(this).attr("id");
            var status 	= "Approved";
            $.ajax({
                url: "<?php echo base_url('Aspayment/submit_approved/"+id+"') ?>",
                type: "post",
                data: { '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>' },
                success: function () {
                    window.location.replace("<?php echo base_url('Aspayment/pop_up_notification/"+status+"') ?>");
                }
            });
        });
		//END
	});
</script>