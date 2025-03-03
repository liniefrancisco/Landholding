<div class="container">
	<button onclick="topFunction()" id="mvTop" title="Go to top"><i class="fa fa-arrow-up"></i>Top</button>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel" style="border-radius:10px;">  
			<div class="col-md-12"> 
				<div class="tabbable tabs-left">
					<ul class="nav nav-tabs">
						<li><a href="#LT1" data-toggle="tab" style="background-color: #001933;color: white">Land Title</a></li>
						<li><a href="#TCT1" data-toggle="tab" style="background-color: #001933;color: white">TCT</a></li>
						<li><a href="#DOS1" data-toggle="tab" style="background-color: #001933;color: white">Previous Deed of Sale </a></li>
						<li><a href="#eCAR1" data-toggle="tab" style="background-color: #001933;color: white">e-CAR </a></li>
						<li><a href="#TD1" data-toggle="tab" style="background-color: #001933;color: white">Tax Declaration </a></li>
						<li><a href="#TC1" data-toggle="tab" style="background-color: #001933;color: white"> Tax Clearance</a></li>
						<li><a href="#SP1" data-toggle="tab" style="background-color: #001933;color: white">Sketch Plan </a></li>
						<li><a href="#VM1" data-toggle="tab" style="background-color: #001933;color: white"> Vicinity Map </a></li>
						<li><a href="#CNI1" data-toggle="tab" style="background-color: #001933;color: white"> Certification of No Improvement </a></li>
						<li><a href="#RET1" data-toggle="tab" style="background-color: #001933;color: white"> Real Estate Property Taxes Receipt</a></li>
						<li><a href="#MC1" data-toggle="tab" style="background-color: #001933;color: white">Marriage Contract (if married)</a></li>
						<li><a href="#BC1" data-toggle="tab" style="background-color: #001933;color: white"> Certificate of Birth  </a></li>
						<li><a href="#VI1" data-toggle="tab" style="background-color: #001933;color: white"> Valid IDs </a></li>
						<li><a href="#SUBPLAN1" data-toggle="tab" style="background-color: #001933;color: white">Subdivision Plan </a></li>
						<li><a href="#SPA1" data-toggle="tab" style="background-color: #001933;color: white">SPA of Lot Owner to Lot Owner </a></li>
						<li><a href="#DENR1" data-toggle="tab" style="background-color: #001933;color: white;font-size: 12px;"> DENR/DAR </a></li>
						<li><a href="#DS1" data-toggle="tab" style="background-color: #001933;color: white;font-size: 12px;"> Deed of Sale either (DOAS/ DOEJS/<br> AOSHWSS/ DOC) </a></li>
						<li><a href="#ARU1" data-toggle="tab" style="background-color: #001933;color: white;font-size: 12px;"> Acknowledgement Receipt <br>(Undervalued) </a></li>
						<li><a href="#ARA1" data-toggle="tab" style="background-color: #001933;color: white;font-size: 12px;"> Acknowledgement Receipt <br> (Actual) </a></li>
						<li><a href="#SPOA1" data-toggle="tab" style="background-color: #001933;color: white;font-size: 12px;"> Special Power of Attorney </a></li>
						<li><a href="#OTHERS1" data-toggle="tab" style="background-color: #001933;color: white;font-size: 12px;"> Others</a></li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane active" id="LT1">
							<div style="overflow-x:auto;">
								<center>
									<?php if(!empty($ud['land_title'])){ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Land Title</u></b></h4>
										<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Land Title/'.$ud['land_title'].'') ?>" class="responsive" width="100%" height="1000px">   
									<?php }else{ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Land Title</u></b></h4>
										<div class="container-no-up">
											<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center> 
										</div>
									<?php } ?>
								</center>
							</div>
						</div>

						<div class="tab-pane " id="TCT1">
							<div style="overflow-x:auto;">
								<center>
									<?php if(!empty($ud['tct'])){ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Transfer Certificate of Title</u></b></h4>
										<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/TCT/'.$ud['tct'].'') ?>" class="responsive" width="100%" height="1000px">   
									<?php }else{ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Transfer Certificate of Title</u></b></h4>
										<div class="container-no-up">
											<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center>                     
										</div>
									<?php } ?>
								</center>
							</div>
						</div>

						<div class="tab-pane" id="DOS1">
							<div style="overflow-x:auto;">
								<center>
									<?php if(!empty($ud['previous_deed_of_sale'])){ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Previous Deed of Sale</u></b></h4>
										<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Previous Deed Of Sale/'.$ud['previous_deed_of_sale'].'') ?>" class="responsive" width="100%" height="1000px">   
									<?php }else{  ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Previous Deed of Sale</u></b></h4>
										<div class="container-no-up">
											<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center> 
										</div>
									<?php } ?>
								</center>
							</div>
						</div>

						<div class="tab-pane" id="eCAR1">
							<div style="overflow-x:auto;">
								<center>
									<?php if(!empty($ud['e_car'])){ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Electronic Certificate Authorizing Registration</u></b></h4>
										<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/eCAR/'.$ud['e_car'].'') ?>" class="responsive" width="100%" height="1000px">   
									<?php }else{  ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Electronic Certificate Authorizing Registration</u></b></h4>
										<div class="container-no-up">
											<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center> 
										</div>
									<?php } ?>
								</center>
							</div>
						</div>

						<div class="tab-pane" id="TD1">
							<div style="overflow-x:auto;">
								<center>
									<?php if(!empty($ud['latest_tax_dec'])){ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Tax Declaration</u></b></h4>
										<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Tax Declaration/'.$ud['latest_tax_dec'].'') ?> " class="responsive" width="100%" height="1000px">   
									<?php }else{ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Tax Declaration</u></b></h4>
										<div class="container-no-up">
											<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center> 
										</div>
									<?php } ?>
								</center>
							</div>
						</div>

						<div class="tab-pane" id="TC1">
							<div style="overflow-x:auto;">
								<center>
									<?php if(!empty($ud['tax_clearance'])){ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Tax Clearance</u></b></h4>
										<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Tax Clearance/'.$ud['tax_clearance'].'') ?>" class="responsive" width="100%" height="1000px">   
									<?php }else{  ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Tax Clearance</u></b></h4>
										<div class="container-no-up">
											<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center> 
										</div>
									<?php } ?>
								</center>
							</div>
						</div>

						<div class="tab-pane" id="SP1">
							<div style="overflow-x:auto;">
								<center>
									<?php if(!empty($ud['land_sketch'])){ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Sketch Plan</u></b></h4>
										<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Land Sketch/'.$ud['land_sketch'].'') ?> " class="responsive"  width="100%" height="1000px">
									<?php }else{ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Sketch Plan</u></b></h4>
										<div class="container-no-up">
											<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center> 
										</div>
									<?php } ?> 
								</center>
							</div>
						</div> 

						<div class="tab-pane" id="VM1">
							<div style="overflow-x:auto;">
								<center>
									<?php if(!empty($ud['vicinity_map'])){ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Vicinity Map</u></b></h4>
										<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Vicinity Map/'.$ud['vicinity_map'].'') ?> " class="responsive"  width="100%" height="1000px">  
									<?php }else{ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Vicinity Map</u></b></h4>
										<div class="container-no-up">
											<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center> 
										</div>
									<?php } ?> 
								</center>
							</div>
						</div> 

						<div class="tab-pane" id="CNI1">
							<div style="overflow-x:auto;">
								<center>
									<?php if(!empty($ud['cert_no_improvement'])){ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Certificate of No Improvement</u></b></h4>
										<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Certificate of No Improvement/'.$ud['cert_no_improvement'].'') ?>" class="responsive" width="100%" height="1000px">   
									<?php }else{  ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Certificate of No Improvement</u></b></h4>
										<div class="container-no-up">
											<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center> 
										</div>
									<?php } ?>
								</center>
							</div>
						</div>

						<div class="tab-pane" id="RET1">
							<div style="overflow-x:auto;">
								<center>
									<?php if(!empty($ud['real_estate_tax'])){ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Real Estate Property Tax Receipt</u></b></h4>
										<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Real Estate Tax/'.$ud['real_estate_tax'].'') ?>" class="responsive" width="100%" height="1000px">   
									<?php }else{  ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Real Estate Property Tax Receipt</u></b></h4>
										<div class="container-no-up">
											<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center> 
										</div>
									<?php } ?>
								</center>
							</div>
						</div>

						<div class="tab-pane" id="MC1">
							<div style="overflow-x:auto;">
								<center>
									<?php if(!empty($ud['marriage_contract'])){ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Marriage Certificate</u></b></h4>
										<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Marriage Contract/'.$ud['marriage_contract'].'') ?>" class="responsive" width="100%" height="1000px">   
									<?php }else{  ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Marriage Certificate</u></b></h4>
										<div class="container-no-up">
											<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center> 
										</div>
									<?php } ?>
								</center>
							</div>
						</div>

						<div class="tab-pane" id="BC1">
							<div style="overflow-x:auto;">
								<center>
									<?php if(!empty($ud['birth_certificate'])){ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Birth Certificate</u></b></h4>
										<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Birth Certificate/'.$ud['birth_certificate'].'') ?>" class="responsive" width="100%" height="1000px">   
									<?php }else{  ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Birth Certificate</u></b></h4>
										<div class="container-no-up">
											<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center> 
										</div>
									<?php } ?>
								</center>
							</div>
						</div>

						<div class="tab-pane" id="VI1">
							<div style="overflow-x:auto;">
								<center>
									<?php if(!empty($ud['valid_id'])){ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Valid ID</u></b></h4>
										<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Valid ID/'.$ud['valid_id'].'') ?>" class="responsive" width="100%" height="1000px">   
									<?php }else{  ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Valid ID</u></b></h4>
										<div class="container-no-up">
											<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center> 
										</div>
									<?php } ?>
								</center>
							</div>
						</div>

						<div class="tab-pane" id="SUBPLAN1">
							<div style="overflow-x:auto;">
								<center>
									<?php if(!empty($ud['subdivision_plan'])){ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Subdivision Plan</u></b></h4>
										<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Subdivision Plan/'.$ud['subdivision_plan'].'') ?>" class="responsive" width="100%" height="1000px">   
									<?php }else{  ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Subdivision Plan</u></b></h4>
										<div class="container-no-up">
											<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center> 
										</div>
									<?php } ?>
								</center>
							</div>
						</div>

						<div class="tab-pane" id="SPA1">
							<div style="overflow-x:auto;">
								<center>
									<?php if(!empty($ud['spa'])){ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Special Power of Attorney</u></b></h4>
										<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/SPA/'.$ud['spa'].'') ?>" class="responsive" width="100%" height="1000px">   
									<?php }else{  ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Special Power of Attorney</u></b></h4>
										<div class="container-no-up">
											<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center> 
										</div>
									<?php } ?>
								</center>
							</div>
						</div>

						<div class="tab-pane" id="DENR1">
							<div style="overflow-x:auto;">
								<center>
									<?php if(!empty($ud['denr_dar'])){ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>DENR/DAR</u></b></h4>
										<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/DENR or DAR/'.$ud['denr_dar'].'') ?>" class="responsive" width="100%" height="1000px">   
									<?php }else{  ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>DENR/DAR</u></b></h4>
										<div class="container-no-up">
											<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center> 
										</div>
									<?php } ?>
								</center>
							</div>
						</div>

						<div class="tab-pane" id="DS1">
							<div style="overflow-x:auto;">
								<center>
									<?php if(!empty($ud['DOS'])){ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Deed of Sale(either DOAS, DOEJS, AOSHWSS, DOC</u></b></h4>
										<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Deed of Sale(either DOAS, DOEJS, AOSHWSS, DOC)/'.$ud['DOS'].'') ?>" class="responsive" width="100%" height="1000px" >   
									<?php }else{ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Deed of Sale(either DOAS, DOEJS, AOSHWSS, DOC</u></b></h4>
										<div class="container-no-up">
											<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center> 
										</div>
									<?php } ?>
								</center>
							</div>
						</div>

						<div class="tab-pane" id="ARU1">
							<div style="overflow-x:auto;">
								<center>
									<?php if(!empty($ud['acknowledement_receipt_undervalued'])){ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Acknowledgement Receipt(Undervalued)</u></b></h4>
										<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Acknowledgement Receipt(Undervalued)/'.$ud['acknowledement_receipt_undervalued'].'') ?>" class="responsive" width="100%" height="1000px" >   
									<?php }else{ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Acknowledgement Receipt(Undervalued)</u></b></h4>
										<div class="container-no-up">
											<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center>  
										</div>
									<?php } ?>
								</center>
							</div>
						</div>

						<div class="tab-pane" id="ARA1">
							<div style="overflow-x:auto;">
								<center>
									<?php if(!empty($ud['acknowledement_receipt_actual'])){ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Acknowledgement Receipt(Actual)</u></b></h4>
										<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Acknowledgement Receipt(Actual)/'.$ud['acknowledement_receipt_actual'].'') ?>" class="responsive" width="100%" height="1000px" >   
									<?php }else{ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Acknowledgement Receipt(Actual)</u></b></h4>
										<div class="container-no-up">
											<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center> 
										</div>
									<?php } ?>
								</center>
							</div>
						</div>

						<div class="tab-pane" id="SPOA1">
							<div style="overflow-x:auto;">
								<center>
									<?php if(!empty($ud['special_power_of_attorney'])){ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Special Power of Attorney</u></b></h4>
										<img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Special Power of Attorney/'.$ud['special_power_of_attorney'].'') ?>" class="responsive" width="100%" height="1000px" >   
									<?php }else{ ?>
										<h4 style="font-family: verdana; text-align: center;font-size: 20px;color:#2a3f54;padding-top: 5px; "><b><u>Special Power of Attorney</u></b></h4>
										<div class="container-no-up">
											<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center>  
										</div>
									<?php } ?>
								</center>
							</div>
						</div>

						<div class="tab-pane" id="OTHERS1">
							<div style="overflow-x:auto;overflow-y:scroll;max-height:1040px">
								<center>
									<?php if (!empty($ud['other'])) { ?>
										<h4 style="font-family: verdana; text-align: center; font-size: 20px; color: #2a3f54; padding-top: 5px;"><b><u>OTHER</u></b></h4>

										<?php
											$fileNames = explode(',', $ud['other']);
											foreach ($fileNames as $fileName) {
												// Extract the actual file name and its extension
												list($actualFileName, $fileExtension) = explode('.', trim($fileName));

												$filePath = base_url('assets/img/uploaded_documents/' . $ud['is_no'] . '/OTHER/' . trim($fileName));

												// Display the image
												echo '<img src="' . $filePath . '" class="responsive" width="100%" height="auto" >';

												// Display the new filename
												echo '<h4 id="new_filename">' . $actualFileName . '</h4>';
											}
										?>
									<?php } else { ?>
										<h4 style="font-family: verdana; text-align: center; font-size: 20px; color: #2a3f54; padding-top: 5px;"><b><u>OTHER</u></b></h4>
										<div class="container-no-up">
											<center style="padding-top: 70px"><img src="<?= base_url('assets/logo/no_image.png') ?>" width="300px" height="300px"></center>
										</div>
									<?php } ?>
								</center>
							</div>
						</div>

					</div>
				</div>
			</div>    
		</div>
	</div>
</div>
