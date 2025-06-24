<?php foreach($crf as $data):?>
	<!-- ACQUISITION CRF -->
	<div class="modal fade" id="AcquisitionCRF_<?= $data['control_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h6 class="fa fa-edit"> Fill in the Form</h6>
				</div>

				<?php echo form_open_multipart('Payment/submit_crf/'); ?>
					<div class="modal-body" style="border-radius:5px;"> 
						<div class="row text-center">
							<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="120px" height="35px">
							<h4 class="modal-title1" style="margin-top:-1px">CHEQUE REQUEST FORM</h4>
							<h5 style="margin-top:-8px;font-family:Times New Roman"><?= $data['pr_type'] ?></h5>
						</div>

						<?php 
							$latest_crf_no = $this->Payment_model->get_latest_crf_no();
						    $new_crf_no = "CRF-0001";
						    if (!empty($latest_crf_no)) {
						        // Extract the numeric part of the latest crf_no
						        $max_id = (int) substr($latest_crf_no, 4);
						        // Increment the numeric part
						        $new_id = $max_id + 1;
						        // Format the new id with leading zeros
						        if ($new_id < 10) {
						            $new_crf_no = "CRF-000" . $new_id;
						        } elseif ($new_id < 100) {
						            $new_crf_no = "CRF-00" . $new_id;
						        } elseif ($new_id < 1000) {
						            $new_crf_no = "CRF-0" . $new_id;
						        } else {
						            $new_crf_no = "CRF-" . $new_id;
						        }
						    }
						?>

						<div class="x_panel" style="border-radius:10px">
							<!-- Hidden -->
							<input  type="hidden" class="form-control" name="control_no" value="<?php echo $data['control_no'] ?>"  readonly>
							<input  type="hidden" class="form-control" name="is_no" value="<?php echo $data['pr_is_no'] ?>"  readonly>
							<input  type="hidden" class="form-control" name="type" value="<?php echo $data['pr_type'] ?>"  readonly>
							<!-- End Hidden -->

							<div class="col-md-12 space">
								<label class="col-md-2">CRF #<b style="float:right">:</b></label>
								<div class="col-md-3">
									<input type="text" class="form-control inb" name="crf_no" value="<?php echo $new_crf_no; ?>" readonly>
								</div>
								<div class="col-md-3"></div>
								<label class="col-md-1">Date<b style="float:right">:</b></label>
								<div class="col-md-3">
									<input type="text" class="form-control inb" name="date_requested" value="<?php echo date("F d, Y") ?>" readonly>
								</div>
							</div>

							<div class="col-md-12">
								<label class="col-md-2">Pay to<b style="float:right">:</b></label>
								<div class="col-md-10">
									<input  type="text" class="form-control inb" name="pay_to" value="<?php echo $data['firstname'] ?> <?php echo $data['middlename'] ?> <?php echo $data['lastname'] ?>"  readonly>
								</div>
							</div> 

							<div class=" col-md-12">
								<label class="col-md-2">Amount in Figure<b style="float:right">:</b></label>
								<div class="col-md-10">
									<input type="text" class="form-control inb" name="r_amount" value="₱ <?php echo number_format($data['pr_amount'],2); ?>" readonly>
								</div>
							</div> 

							<div class="col-md-12">
								<label class="col-md-2">Amount in Words<b style="float:right">:</b></label>
								<div class="col-md-10">
									<?php $this->load->helper('custom'); ?>
									<input type="text" class="form-control inb" name="amount_words" value="<?php echo number_to_words($data['pr_amount']); ?> Pesos" style="color:#ff6600" readonly>
								</div>
							</div> 
										
							<div class="col-md-12">
								<div class="col-md-2"></div>
								<div class="col-md-4">
									<input type="text" class="form-control inb text-center" name="bank" required>
									<center><label>Bank</label></center>
								</div>
								<div class="col-md-3">
									<input type="text" class="form-control inb text-center" name="cheque_no" required>
									<center><label>Cheque No.</label></center> 
								</div>
								<div class="col-md-3">
									<input type="date" class="form-control inb text-center" name="cheque_date" value="<?php echo date("F d, Y"); ?>" required>
									<center><label>Cheque Date</label></center> 
								</div>
							</div>

							<div class="col-sm-12 space">
							    <div class="col-sm-2">
							        <label>Attach File:</label>
							    </div>
							    <div class="col-sm-10">
			                        <input type="file" class="dropify" name="attachments" data-height="300" data-max-file-size="10M" accept=".jpg, .jpeg, .png, .pdf" onchange="previewFile(this);" required>
			                    </div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success btn-md">Submit</button>
						<button type="button" class="btn btn-default btn-md" data-dismiss="modal">Close</button>
					</div>         
				</form>
			</div>
		</div>
	</div>
	<!-- ASPAYMENT CRF -->
	<div class="modal fade" id="AspaymentCRF_<?= $data['is_no'] ?>" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h6 class="fa fa-edit"> Fill in the Form <b style="color:#eb5d0c"><?php echo $data['is_no'] ?></b></h6>
				</div>

				<?php echo form_open_multipart('Payment/submit_crf/'); ?>
					<div class="modal-body" style="border-radius:5px;"> 
						<div class="row text-center">
							<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="150px" height="50px">
							<h5 style="font-family:Times New Roman;font-weight:bold;letter-spacing:3px">CHEQUE REQUEST FORM</h5>
							<h5 style="margin-top:-8px;font-family:Times New Roman">Collateral</h5>
						</div>

						<?php 
							$latest_crf_no = $this->Payment_model->get_latest_crf_no();
						    $new_crf_no = "CRF-0001";
						    if (!empty($latest_crf_no)) {
						        // Extract the numeric part of the latest crf_no
						        $max_id = (int) substr($latest_crf_no, 4);
						        // Increment the numeric part
						        $new_id = $max_id + 1;
						        // Format the new id with leading zeros
						        if ($new_id < 10) {
						            $new_crf_no = "CRF-000" . $new_id;
						        } elseif ($new_id < 100) {
						            $new_crf_no = "CRF-00" . $new_id;
						        } elseif ($new_id < 1000) {
						            $new_crf_no = "CRF-0" . $new_id;
						        } else {
						            $new_crf_no = "CRF-" . $new_id;
						        }
						    }
						?>

						<div class="x_panel" style="border-radius:10px">
							<!-- Hidden -->
							<input  type="hidden" class="form-control" name="control_no" value="<?php echo $data['control_no'] ?>"  readonly>
							<input  type="hidden" class="form-control" name="is_no" value="<?php echo $data['pr_is_no'] ?>"  readonly>
							<input  type="hidden" class="form-control" name="type" value="<?php echo $data['pr_type'] ?>"  readonly>
							<!-- End Hidden -->

							<div class="col-md-12 space">
								<label class="col-md-2">CRF #<b style="float:right">:</b></label>
								<div class="col-md-3">
									<input type="text" class="form-control inb" name="crf_no" value="<?php echo $new_crf_no; ?>" readonly>
								</div>
								<div class="col-md-3"></div>
								<label class="col-md-1">Date<b style="float:right">:</b></label>
								<div class="col-md-3">
									<input type="text" class="form-control inb" name="date_requested" value="<?php echo date("F d, Y") ?>" readonly>
								</div>
							</div>

							<div class="col-md-12">
								<label class="col-md-2">Pay to<b style="float:right">:</b></label>
								<div class="col-md-10">
									<input  type="text" class="form-control inb" name="pay_to" value="If collateral unsay value ani?"  readonly>
								</div>
							</div> 

							<div class=" col-md-12">
								<label class="col-md-2">Amount in Figure<b style="float:right">:</b></label>
								<div class="col-md-10">
									<input type="text" class="form-control inb" name="r_amount" value="₱ <?php echo number_format($data['pr_amount'],2); ?>" readonly>
								</div>
							</div> 

							<div class="col-md-12">
								<label class="col-md-2">Amount in Words<b style="float:right">:</b></label>
								<div class="col-md-10">
									<?php $this->load->helper('custom'); ?>
									<input type="text" class="form-control inb" name="amount_words" value="<?php echo number_to_words($data['pr_amount']); ?> Pesos" style="color:#ff6600" readonly>
								</div>
							</div> 
										
							<div class="col-md-12">
								<div class="col-md-2"></div>
								<div class="col-md-4">
									<input type="text" class="form-control inb text-center" name="bank" required>
									<center><label>Bank</label></center>
								</div>
								<div class="col-md-3">
									<input type="text" class="form-control inb text-center" name="cheque_no" required>
									<center><label>Cheque No.</label></center> 
								</div>
								<div class="col-md-3">
									<input type="date" class="form-control inb text-center" name="cheque_date" value="<?php echo date("F d, Y"); ?>" required>
									<center><label>Cheque Date</label></center> 
								</div>
							</div>

							<div class="col-sm-12 space">
							    <div class="col-sm-2">
							        <label>Attach File:</label>
							    </div>
							    <div class="col-sm-10">
			                        <input type="file" class="dropify" name="attachments" data-height="300" data-max-file-size="10M" accept=".jpg, .jpeg, .png, .pdf" onchange="previewFile(this);" required>
			                    </div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success btn-md">Submit</button>
						<button type="button" class="btn btn-default btn-md" data-dismiss="modal">Close</button>
					</div>         
				</form>
			</div>
		</div>
	</div>
<?php endforeach; ?>

<script type="text/javascript">//Preview File
	function previewFile(input) {
	    if (!input || !input.files || input.files.length === 0) {
	        return;
	    }

	    const files = input.files;
	    const imageItems = [];
	    const pdfItems = [];

	    // Loop through all the selected files
	    for (let i = 0; i < files.length; i++) {
	        const file = files[i];
	        const reader = new FileReader();
	        
	        reader.onload = function(e) {
	            let fileType = file.type;
	            if (fileType.includes("image")) {
	                // If it's an image, add it to the imageItems array
	                imageItems.push({
	                    src: e.target.result,
	                    title: file.name
	                });
	            } else if (fileType === "application/pdf") {
	                // If it's a PDF, add it to the pdfItems array
	                pdfItems.push(e.target.result);
	            }

	            // Once all files are processed, open the PhotoViewer if there are images
	            if (imageItems.length > 0) {
	                try {
	                    if (typeof PhotoViewer !== "undefined") {
	                        new PhotoViewer(imageItems); // Open PhotoViewer without options
	                    } else {
	                        alert("PhotoViewer is not loaded. Make sure the script is included.");
	                    }
	                } catch (error) {
	                    alert("An error occurred while opening PhotoViewer. Check console for details.");
	                }
	            }

	            // If there are any PDFs, open them in a new window
	            if (pdfItems.length > 0) {
	                pdfItems.forEach(pdf => {
	                    let pdfWindow = window.open();
	                    pdfWindow.document.write(`<iframe src="${pdf}" width="100%" height="100%"></iframe>`);
	                });
	            }
	        };
	        reader.readAsDataURL(file);
	    }
	}
</script>

<script>//Dropify
    $(document).ready(function () {
        var drop = $(".dropify").dropify({
            messages: {
                default: "Drop files here or click to browse",
                replace: "Drag and drop a image or file here or click to replace",
            },
        });
    });
</script>