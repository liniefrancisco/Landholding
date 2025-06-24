<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissible fade in" role="alert" style="position: fixed; bottom: 10px; right: 10px; z-index: 99; cursor: pointer;" id="saved">
		<?php echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'. validation_errors('<i class="fa fa-remove"></i> '); ?>
	</div>
<?php } ?>
<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container">
		<button onclick="topFunction()" id="mvTop" title="Go to top"><i class="fa fa-arrow-up"></i>Top</button>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!--====================FLASH DATA====================-->
			<?php if($this->session->flashdata('error')){?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert" id="saved">
					<i class="fa fa-warning"></i>  <?php echo $this->session->flashdata('error'); ?>
				</div>
			<?php } ?>
			<?php if($this->session->flashdata('success')){?>
				<div class="alert alert-success alert-dismissible fade in" role="alert" id="saved">
					<i class="glyphicon glyphicon-ok"></i>  <?php echo $this->session->flashdata('success'); ?>
				</div>
			<?php }?>
			<!--====================END FLASH DATA====================-->
										
			<div class="x_panel animate fadeIn" style="border:1px; !important;box-shadow: 7px 6px 16px #888888;">
				<div class="x_title">
					<label class="fa fa-line-chart" style="font-size:15px"> <b>In Progress <u style="color:#ff6600"><?php if($oi['is_no']){ echo $oi['is_no']; } ?></u></b></label>
					<div style="float:right">
						<a href="#" onclick="window.history.back()" class="btn btn-sm btn-warning"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="lclto col-md-12 col-sm-12 col-xs-12"><br/>
					<?php if(!$ud['land_sketch'] == null){ ?>      
						<div class="col-md-2 col-sm-2 col-xs-2">
							<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Land Sketch/'.$ud['land_sketch'].'') ?>" width="150px" height="130px" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19); border: 2px solid #4CAF50;">               
						</div>
					<?php }else{ ?>
						<div class="col-md-2 col-sm-2 col-xs-2">
							<img src="<?= base_url('assets/logo/no_file.png') ?>" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19); border: 2px solid #ff6600; max-width: 150px; max-height: 150px;" class="image-responsive">
						</div>
					<?php } ?>

					<div class="col-md-9 col-sm-9 col-xs-9">
						<label class="col-md-4 small">Lot. <b style="float: right;">:</b></label>   
						<i class="small"> <?php if($li['lot']){ echo $li['lot']; }else{ echo "None"; } ?></i>
					</div>

					<div class="col-md-9 col-sm-9 col-xs-9">
						<label class="col-md-4 small">Cad. <b style="float: right;">:</b></label>   
						<i class="small"> <?php if($li['cad']){ echo $li['cad']; }else{ echo "None"; } ?></i>
					</div>

					<div class="col-md-9 col-sm-9 col-xs-9">
						<label class="col-md-4 small">Land Title No. <b style="float: right;">:</b></label> 
						<i class="small"> <?php if($li['land_title_no']){ echo $li['land_title_no']; }else{ echo "None";} ?></i>
					</div>

					<div class="col-md-9 col-sm-9 col-xs-9">
						<label class="col-md-4 small">Tax Declaration No. <b style="float: right;">:</b></label> 
						<i class="small"> <?php if($li['tax_dec_no']){ echo $li['tax_dec_no']; }else{ echo "None"; } ?></i>
					</div>

					<div class="col-md-9 col-sm-9 col-xs-9">
						<label class="col-md-4 small">Lot Owner <b style="float: right;">:</b></label> 
						<i class="small"> <?php echo ucfirst($oi['firstname']) ?> <?php echo ucfirst($oi['lastname']) ?></i>
					</div>

					<div class="col-md-9 col-sm-9 col-xs-9">
						<label class="col-md-4 small">Lot Location <b style="float: right;">:</b></label>
						<i class="small"> <?php echo ucfirst($ll['street']) ?>- <?php echo ucfirst($ll['baranggay']) ?>, <?php echo ucfirst($ll['municipality']) ?>, <?php echo ucfirst($ll['province']) ?></i>
					</div>

					<div class="col-md-12 col-sm-12 col-xs-12"> 
						<div class="col-md-2 col-sm-2 col-xs-2"><center><label><b style="color: #ff6600;">LAND SKETCH</b></label></center></div>
					</div>
				</div>

				<!--====================TABPANE====================-->
				<div class="container"><br/><br/><br/><br/>
					<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
						<li class="active"><a href="#tab_content_is" id="is-tab" role="tab" data-toggle="tab" aria-expanded="true" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">Interview Sheet</a></li>

						<li role="presentation" class="dropdown">
							<?php
							$canRequestFullPayment = true;
							$lastStatus = '';
							if (!empty($pr_status)) {
								foreach ($pr_status as $ca) {
									$status = $ca['status']; 
									if ($status === 'Pending' || $status === 'Approved') {
										$canRequestFullPayment = false;
										$lastStatus = $status;
										break;
									}
								}
							}

							if ($canRequestFullPayment) {?>
								<a href="#" id="expenses-tab" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">Request Full Payment<span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<?php if($this->session->userdata('user_type') == 'Secretary'){ ?>
										<li><a href="#lpf" role="tab" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">Lot Purchase Form</a></li>
										<li><a href="#cp" role="tab" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">Computation of Payment</a></li>
										<li><a href="#nf" role="tab" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">Notarial Fee</a></li>
										<?php  if(!empty($bi)){ ?>
											<li><a href="#ac" role="tab" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">Agent Commission</a></li> 
										<?php } ?>
										<li><a href="#ar" role="tab" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">Acknowledgement Receipt</a></li>
										<li><a href="#uod" role="tab" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">Upload Other Documents</a></li>
									<?php } ?>
									<li><a href="#view" role="tab" data-toggle="tab" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">View Details</a></li>
								</ul>
							<?php } else {?>
								<a href="#" id="expenses-tab" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="background-color: #001933; color: white; font-size: 12px;" 
									onclick="new PNotify({
									title: 'Please be informed',
									text: '<p>Sorry, You can\'t request right now, because your previous request is still <?php echo $lastStatus ?>. Please wait until it is paid. Thank You!</p>',
									type: 'warning',
									styling: 'bootstrap3'
									}); remove_notif();">Request Full Payment<span class="caret"></span>
								</a>
							<?php } ?>
						</li>

						<li role="presentation" ><a  href="#rca" role="tab" id="rca-tab" data-toggle="tab" aria-expanded="false" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">Request Cash Advance</a></li>

						<li role="presentation" ><a  href="#tab_content_soa" role="tab" id="soa-tab" data-toggle="tab" aria-expanded="false" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">Summary of Payment</a></li>

						<li role="presentation" ><a  href="#tab_content_doc" role="tab" id="doc-tab" data-toggle="tab" aria-expanded="false" style="background: linear-gradient(to top, #09203f 0%, #537895 100%);color: white">Seller Documents</a></li>
					</ul>

					<div id="myTabContent" class="tab-content">
						<!--====================INTERVIEW SHEET====================-->
						<div role="tabpanel" class="tab-pane fade active in" id="tab_content_is" aria-labelledby="is-tab">
							<?php $this->load->view('secretary/Progress/interview_sheet'); ?>                           
						</div>
						<!--====================REQUEST FULL PAYMENT====================-->
						<div role="tabpanel" class="tab-pane fade" id="lpf" aria-labelledby="expenses-tab">
							<?php $this->load->view('secretary/Progress/lot_purchase_form'); ?>
						</div>

						<div role="tabpanel" class="tab-pane fade" id="cp" aria-labelledby="expenses-tab">
							<?php
								$purchaseType = $li['purchase_type'];
								if ($purchaseType == 'package') {
									$this->load->view('secretary/Progress/computation_of_payment_package');
								}elseif ($purchaseType == 'per/sq.m.') {
									$this->load->view('secretary/Progress/computation_of_payment_sqm');
								}
							?>
						</div>

						<div role="tabpanel" class="tab-pane fade" id="nf" aria-labelledby="expenses-tab">
							<?php $this->load->view('secretary/Progress/notarial_fee'); ?>
						</div>

						<div role="tabpanel" class="tab-pane fade" id="ac" aria-labelledby="expenses-tab">
							<?php $this->load->view('secretary/Progress/agent_commission'); ?>
						</div>

						<div role="tabpanel" class="tab-pane fade" id="ar" aria-labelledby="expenses-tab">
							<?php $this->load->view('secretary/Progress/acknowledgement_receipt'); ?>
						</div>

						<div role="tabpanel" class="tab-pane fade" id="uod" aria-labelledby="expenses-tab">
							<?php $this->load->view('secretary/Progress/upload_other_documents');  ?>
						</div>

						<div role="tabpanel" class="tab-pane fade" id="view" aria-labelledby="expenses-tab">
							<?php $this->load->view('secretary/Progress/view_details');  ?>
						</div>
						<!--====================REQUEST CASH ADVANCE====================-->
						<div role="tabpanel" class="tab-pane fade" id="rca" aria-labelledby="rca-tab">  
							<?php $this->load->view('secretary/Progress/request_cash_advance');  ?>
						</div>
						<!--====================SUMMARY OF PAYMENT====================-->
						<div role="tabpanel" class="tab-pane fade" id="tab_content_soa" aria-labelledby="soa-tab">          
							<?php $this->load->view('secretary/Progress/summary_of_payment'); ?>      
						</div>
						<!--====================DOCUMENT REQUIREMENTS====================-->
						<div role="tabpanel" class="tab-pane fade" id="tab_content_doc" aria-labelledby="doc-tab">          
							<?php $this->load->view('secretary/Progress/audited_documents'); ?>      
						</div>
						<!--====================END====================-->
					</div>
				</div>               
			</div>
		</div><br />
	</div>
	<?php include 'modal.php'; ?>
	<?php include 'print.php'; ?>
</div>
<!--====================END PAGE CONTENT====================-->

<script>
	$(document).ready(function() {
	    // Function to adjust the height of .right_col based on active tab content
	    function adjustRightColHeight() {
	        var activeTabContentHeight = $('.tab-content .tab-pane.active').outerHeight();
	        $('.right_col').css('min-height', activeTabContentHeight + 'px');
	    }

	    // Call adjustRightColHeight initially
	    adjustRightColHeight();

	    // Adjust height when a tab is shown (Bootstrap event)
	    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	        adjustRightColHeight();
	    });
	});
</script>

<script>
	function printModal(modalClass) {
		var printContents 		= document.querySelector(modalClass + ' .modal-body').innerHTML;
		var originalContents 	= document.body.innerHTML;
		var printWindow 		= window.open('', '_blank');
		printWindow.document.open();
		printWindow.document.write('<html><head><title>Request Cash Advance</title></head><body>');
		printWindow.document.write(printContents);
		printWindow.document.write('</body></html>');
		printWindow.document.close();
		printWindow.onload = function() {
			printWindow.print();
			printWindow.close();
		};

		document.body.innerHTML = originalContents;
	}
</script>

<script>
	// When the user scrolls down 20px from the top of the document, show the button
	window.onscroll = function() {scrollFunction()};

	function scrollFunction() {
		if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
			document.getElementById("mvTop").style.display = "block";
		}else{
			document.getElementById("mvTop").style.display = "none";
		}
	}

	// When the user clicks on the button, scroll to the top of the document
	function topFunction() {
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
	}
</script>

<script>
	function validate_checkbox(){
		var op = $("#other_p").val().length;
		var check = $('input[id=purp]:checked').length;

		if(!check > 0 && op == 0){
			$('.errModal').modal('show') 
			return false;
		}else{
			var conf = confirm('Confirm your submission.');
			if(conf === true){
				return true;
			}else{
				return false;
			}
	 }
	}
</script>

<script>
	function convertNumberToWords(number) {
	if (number < 0 || number > 999999999) {
		throw new Error("Number is out of range");
	}
	
	const Gn = Math.floor(number / 1000000);
	number -= Gn * 1000000;
	const kn = Math.floor(number / 1000);
	number -= kn * 1000;
	const Hn = Math.floor(number / 100);
	number -= Hn * 100;
	const Dn = Math.floor(number / 10);
	const n = number % 10;
	
	let res = "";
	
	if (Gn) {
		res += convertNumberToWords(Gn) + " Million";
	}
	
	if (kn) {
		res += (res === "" ? "" : " ") + convertNumberToWords(kn) + " Thousand";
	}
	
	if (Hn) {
		res += (res === "" ? "" : " ") + convertNumberToWords(Hn) + " Hundred";
	}
	
	const ones = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];
	
	const tens = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];
	
	if (Dn || n) {
		if (res !== "") {
			res += " and ";
		}
		if (Dn < 2) {
			res += ones[Dn * 10 + n];
		} else {
			res += tens[Dn];
			if (n) {
				res += "-" + ones[n];
			}
		}
	}
	
	if (res === "") {
		res = "zero";
	}
	
	return res;
}

document.getElementById('amountInput').addEventListener('input', function () {
	var amountInFigures = this.value;
	var amountInWords = convertNumberToWords(parseFloat(amountInFigures));
	document.getElementById('amountWords').textContent = amountInWords + " Pesos";
});
</script>

<script>
	tinymce.init({ 
		selector:'.editor',
		theme: 'modern',
		height:600
	});
</script>

<script>
	function printcp(modalClass) {
		var printContents = document.querySelector(modalClass + ' .modal-body').innerHTML;
		var originalContents = document.body.innerHTML;

		var printWindow = window.open('', '_blank');
		printWindow.document.open();
		printWindow.document.write('<html><head><title>Computation of Payment</title></head><body>');
		printWindow.document.write(printContents);
		printWindow.document.write('</body></html>');
		printWindow.document.close();
		printWindow.onload = function() {
			printWindow.print();
			printWindow.close();
		};

		document.body.innerHTML = originalContents;
	}
</script>

<script>
	function printnf(modalClass) {
		var printContents = document.querySelector(modalClass + ' .modal-body').innerHTML;
		var originalContents = document.body.innerHTML;

		var printWindow = window.open('', '_blank');
		printWindow.document.open();
		printWindow.document.write('<html><head><title>Notarial Fee</title></head><body>');
		printWindow.document.write(printContents);
		printWindow.document.write('</body></html>');
		printWindow.document.close();
		printWindow.onload = function() {
			printWindow.print();
			printWindow.close();
		};

		document.body.innerHTML = originalContents;
	}
</script>

<script>
	function printac(modalClass) {
		var printContents = document.querySelector(modalClass + ' .modal-body').innerHTML;
		var originalContents = document.body.innerHTML;

		var printWindow = window.open('', '_blank');
		printWindow.document.open();
		printWindow.document.write('<html><head><title>AGENT COMMISSION</title></head><body>');
		printWindow.document.write(printContents);
		printWindow.document.write('</body></html>');
		printWindow.document.close();
		printWindow.onload = function() {
		printWindow.print();
		printWindow.close();
		};

		document.body.innerHTML = originalContents;
	}
</script>

<script>
	function printar(modalClass) {
		var printContents = document.querySelector(modalClass + ' .modal-body').innerHTML;
		var originalContents = document.body.innerHTML;
		var printWindow = window.open('', '_blank');
		printWindow.document.open();
		printWindow.document.write('<html><head><title>AGENT COMMISSION</title></head><body>');
		printWindow.document.write(printContents);
		printWindow.document.write('</body></html>');
		printWindow.document.close();
		printWindow.onload = function() {
		printWindow.print();
		printWindow.close();
		};

		document.body.innerHTML = originalContents;
	}
</script>

<script>
	function printlpf(modalClass) {
		var printContents = document.querySelector(modalClass + ' .modal-body').innerHTML;
		var originalContents = document.body.innerHTML;
		var printWindow = window.open('', '_blank');
		printWindow.document.open();
		printWindow.document.write('<html><head><title>LOT PURCHASE FORM</title></head><body>');
		printWindow.document.write(printContents);
		printWindow.document.write('</body></html>');
		printWindow.document.close();
		printWindow.onload = function() {
		printWindow.print();
		printWindow.close();
		};

		document.body.innerHTML = originalContents;
	}
</script>