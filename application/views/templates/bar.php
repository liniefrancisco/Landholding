<div id="loading"
	style="visibility:hidden; background-image:url('<?php echo base_url();?>assets/logo/loading-gif-orange-5.gif')">
</div>
<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view" style="overflow-y: auto; max-height: 100vh;">
					<div class="navbar nav_title" style="border: 0;">
						<a href="" class="site_title"> <span style="font-family:sitka text;font-size: 18px;"><b><img src="<?php echo base_url();?>assets/logo/leaf2.png" width="15%"> </img>Land Holding</b> </span></a>
					</div>
					<div class="clearfix"></div>

					<!--====================menu profile quick info====================-->
					<div class="profile clearfix">
						<div class="profile_pic">
							<a class="view_profile" href="<?= base_url('account')?>">
								<?php
									if(empty($this->session->userdata('image'))){
										echo '<img class="img-circle profile_img" alt="..." src="'.base_url().'assets/logo/default.png"/>';
									}else{
										echo '<img class="img-circle profile_img" alt="..." src="'.base_url().'assets/img/users/'.$this->session->userdata('user_type').'/'.$this->session->userdata('image').'" height="70px"/>';
									}
								?>
							</a>
						</div>

						<div class="profile_info">
							<span>Welcome,</span>
							<h2 style="overflow: hidden;text-overflow:ellipsis;width: 128px;"><?php echo ucfirst($this->session->userdata('firstname')).' '.ucfirst($this->session->userdata('lastname')) ?></h2>
						</div>
					</div>
					<!--====================SIDEBAR MENU====================-->
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<h3>General</h3>
							<div class="clearfix"></div>
							<ul class="nav side-menu">
								<!--====================ADMINISTRATOR SIDEBAR====================-->
								<?php if ($this->session->userdata('user_type') == "Administrator"){ ?>
									<li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
									<li><a href="<?= base_url('Admin/Error_Logs/error_logs');?>"><i class="fa fa-exclamation-triangle"></i> Error Logs <sup><span class="badge_custom bg-red" id="error-logs-badge"></span></sup></a></li>
									<li><a><i class="fa fa-users"></i> User Accounts<span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li><a href="<?= base_url('account/add'); ?>"><i class="fa fa-plus-square"></i> Create Account</a></li>
											<li><a href="<?= base_url('account/lists'); ?>"><i class="fa fa-reorder"></i> List of Account</a></li>
										</ul>
									</li>
								<?php } ?>
								<!--====================SECRETARY SIDEBAR====================-->
								<?php if ($this->session->userdata('user_type') == "Secretary"){ ?>
									<li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
									<li><a href="<?= base_url('Acquisition');?>"><i class="fa fa-edit"></i>New Acquisition</a></li>
									<li><a href="<?= base_url('Acquisition/Acquisition_tbl');?>"><i class="fa fa-thumbs-up"></i>Execute
									 	<?php if ($pending_acq > 0): ?>
								            <sup><span class="badge_custom bg-red"><?php echo $pending_acq; ?></span></sup>
								        <?php endif; ?>
								    </a></li>
									<li><a href="<?= base_url('Payment');?>"><i class="fa fa-area-chart"></i>In Progress
								    </a></li>
									<li><a href="<?= base_url('Owned')?>"><i class="fa fa-map-signs"></i>Owned Land</a></li>
									<li><a href="<?= base_url('About_Us')?>"><i class="fa fa-info"></i>About Us</a></li>
								<?php } ?>
								<!--====================LEGAL SIDEBAR====================-->
								<?php if ($this->session->userdata('user_type') == "Legal"){ ?>
									<li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>

									<li><a><i class="fa fa-edit"></i> Registry <span class="fa fa-chevron-down"></span></a>
	                                    <ul class="nav child_menu">
	                                        <li><a href="<?= base_url('Old_Acquisition'); ?>">Add Land</a></li>
	                                        <li><a>Aspayment <span class="fa fa-chevron-down"></span></a>
	                                            <ul class="nav child_menu">
	                                                <li><a href="<?= base_url('Old_Aspayment/judicial') ?>">Judicial</a></li>
	                                                <li><a href="<?= base_url('Old_Aspayment/extrajudicial') ?>">Extrajudicial</a></li>
	                                            </ul>
	                                        </li>
	                                    </ul>
	                                </li>
	                                <!-- <li><a><i class="fa fa-cloud-upload"></i> Land Titling <span class="fa fa-chevron-down"></span></a>
	                                    <ul class="nav child_menu">
	                                        <li><a href="<?= base_url('Legal_f/land/titling_old'); ?>">Acquisition</a></li>
	                                        <li><a href="<?= base_url('Legal_f/land/extrajudicial'); ?>">Extrajudicial</a></li>
	                                        <li><a href="<?= base_url('Legal_f/land/judicial'); ?>">Judicial</a></li>
	                                    </ul>
	                                </li> -->
	                                <!-- <li><a><i class="fa fa-certificate"></i> Land Profile <span class="fa fa-chevron-down"></span></a>
	                                    <ul class="nav child_menu">
	                                        <li><a href="<?= base_url('Legal_f/land/land_acq_old'); ?>">Acquisition</a></li>
	                                        <li><a href="<?= base_url('Legal_f/land/land_extra_old'); ?>">Extrajudicial</a></li>
	                                        <li><a href="<?= base_url('Legal_f/land/land_judicial_old'); ?>">Judicial</a></li>
	                                    </ul>
	                                </li> -->
	                                <!-- <li><a href="<?= base_url('Legal_f/Aspayment/judicial_request') ?>"><i class="fa fa-gavel"></i>Judicial Request</a></li>
	                                <li><a href="<?= base_url('Legal_f/rpt'); ?>"><i class="fa fa-clipboard"></i>Real Property Tax</a></li>
	                                <li><a href="<?= base_url('Legal_f/report'); ?>"><i class="fa fa-print"></i> Reports</a></li> -->
									<li><a href="<?= base_url('Acquisition/Acquisition_tbl')?>">
										<i class="fa fa-files-o"></i> Document Review
										<?php if ($pending_acq > 0): ?>
								            <sup><span class="badge_custom bg-red"><?php echo $pending_acq; ?></span></sup>
								        <?php endif; ?>
									</a></li>
									<li><a href="<?= base_url('Owned')?>"><i class="fa fa-map-signs"></i>Owned Land</a></li>
									<li><a href="<?= base_url('About_Us')?>"><i class="fa fa-info"></i>About Us</a></li>
								<?php } ?>
								<!--====================ACCOUNTING SIDEBAR====================-->
								<?php if ($this->session->userdata('user_type') == "Accounting"){ ?>
									<li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a> </li>
									<li><a href="<?= base_url('Payment/CRF_tbl'); ?>"><i class="fa fa-edit"></i>Payment Request
										<?php if ($approved_payment > 0): ?>
								            <sup><span class="badge_custom bg-red"><?php echo $approved_payment; ?></span></sup>
								        <?php endif; ?>
								    </a></li>
									<li><a href="<?= base_url('Accounting/Rpt'); ?>"><i class="fa fa-area-chart"></i>Real Property Tax</a></li>
									<li><a href="<?= base_url('Payment/inprogress1_tbl'); ?>"><i class="fa fa-line-chart"></i>In Progress </a></li>
									<li><a href="<?= base_url('Owned');?>"><i class="fa fa-map-signs"></i> Owned</a></li>
									<li><a href="<?= base_url('About_Us')?>"><i class="fa fa-info"></i>About Us</a></li>
								<?php } ?>
								<!--====================GM SIDEBAR====================-->
								<?php if ($this->session->userdata('user_type') == "GM"){ ?>
									<li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
									<li><a href="<?= base_url('Acquisition/Acquisition_tbl'); ?>"><i class="fa fa-thumbs-up"></i>Acquisition Request
								        <?php if ($reviewed_acq > 0): ?>
								            <sup><span class="badge_custom bg-red"><?php echo $reviewed_acq; ?></span></sup>
								        <?php endif; ?>
									</a></li>

									<li><a href="<?= base_url('Payment/Payment_tbl');?>"><i class="fa fa-money"></i>Payment Request 
										<?php if ($pending_payment > 0): ?>
								            <sup><span class="badge_custom bg-red"><?php echo $pending_payment; ?></span></sup>
								        <?php endif; ?>
									</a></li>
									<li><a href="<?= base_url('Owned')?>"><i class="fa fa-map-signs"></i>Owned Land</a></li>
									<li><a href="<?= base_url('About_Us')?>"><i class="fa fa-info"></i>About Us</a></li>
								<?php } ?>
								<!--====================CCD SIDEBAR====================-->
								<?php if ($this->session->userdata('user_type') == "CCD"){ ?>
									<li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i>Home</a></li>
									<li><a><i class="fa fa-edit"></i> Aspayment <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li class="sub_menu"><a href="<?= base_url('Aspayment/judicial');?>">Judicial </a></li>
											<li><a href="<?= base_url('Ccd/Aspayment/extrajudicial');?>">Extrajudicial </a> </li>
										</ul>
									</li>
									<li><a href="<?= base_url('Ccd/Execute/pending_table');?>"><i class="fa fa-thumbs-up"></i>Execute</a></li>
									<li><a href="<?= base_url('Ccd/progress');?>"><i class="fa fa-area-chart"></i>In Progress</a></li>
									<!-- <li><a><i class="fa fa-exchange"></i>Execute<span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<li class="sub_menu"><a href="<?= base_url('Ccd/Requests/pending_extrajudicial');?>">Extrajudicial</a></li>
											<li><a href="<?= base_url('Ccd/Requests/pending_judicial');?>">Judicial</a></li>
										</ul>
									</li> -->
									<li><a href="<?= base_url('Owned')?>"><i class="fa fa-map-signs"></i>Owned Land</a></li>
									<li><a href="<?= base_url('About_Us')?>"><i class="fa fa-info"></i>About Us</a></li>
								<?php } ?>
								<!--====================END CCD SIDEBAR====================-->

							</ul>
						</div>
					</div>
					<!--====================END SIDEBAR MENU====================-->
				</div>
			</div>

						<!--====================TOP NAVIGATION====================-->
						<div class="top_nav">
								<div class="nav_menu">
										<nav>
												<div class="nav toggle"><a id="menu_toggle"><i class="fa fa-bars"></i></a></div>
												<ul class="nav navbar-nav navbar-right" id="load_tap_nav">
														<li><a data-toggle="tooltip" title="logout" class="user-log-out" data-placement="top"
																		href="<?php echo site_url(); ?>logout"><span class="glyphicon glyphicon-off"
																				aria-hidden="true"></span></a></li>

														<?php if ($this->session->userdata('user_type') == "Secretary" || $this->session->userdata('user_type') == "CCD"){ ?>
														<li role="presentation" class="dropdown notif-tab" onclick="scrollSmoothToBottom()">
																<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
																		aria-expanded="false">
																		<i class="fa fa-envelope-o"></i><span class="badge bg-green"
																				id="no_of_notif_tab">0</span>
																</a>

																<ul role="menu" class="dropdown-menu list-unstyled msg_list" id="xz">
																		<?php foreach ($all_notifications as $key => $value) { 
											$date=date_create($value['date']);
											$action_date = date_format($date,"M d y, D g:i a");
										?>
																		<li <?php if($value['status'] == 'read'){ ?> style="background-color: #f1f1f1;"
																				<?php } ?>>
																				<a <?php if($value['form_type'] == 'IS' && $value['action'] == 'disapproved'){ ?>href="<?php echo base_url('requests/view_interview_sheet/'.$value['reference_id']) ?>"
																						<?php }elseif($value['form_type'] == 'IS' && $value['action'] == 'approved'){ ?>
																						href="<?php echo base_url('Secretary/Progress/view_inprogress/'.$value['reference_id']) ?>" <?php }elseif($value['form_type'] == 'LCAF' && $value['action'] == 'approved'){ 
													$rcp = $this->Payment_model->getca_rcpno($value['reference_id']);
													$data = $this->Payment_model->getrcp_isno($rcp['rcp_no']);
												?> href="<?php echo base_url('Progress/view_file/'.$data['is_no']) ?>"
																						<?php }elseif($value['form_type'] == 'LCAF' && $value['action'] == 'disapproved'){ ?>
																						href="<?php echo base_url('requests/disapproved_payments') ?>" <?php }elseif($value['form_type'] == 'RCP'){ 
																							$data = $this->Payment_model->getrcp_isno($value['reference_id']);
																				?> href="<?php echo base_url('progress/view_file/'.$data['is_no']) ?>"
																						<?php }elseif($value['form_type'] == 'LAPF-ES'){ ?>
																						href="<?php echo base_url('aspayment/view_es/'.$value['reference_id']) ?>"
																						<?php }elseif($value['form_type'] == 'LAPF-JS'){ ?>
																						href="<?php echo base_url('aspayment/view_js/'.$value['reference_id']) ?>"
																						<?php } ?> class="open" id="<?php echo $value['id']; ?>"
																						<?php if($value['status'] == 'read'){ ?> style="color: black;" <?php } ?>>
																						<?php if($value['form_type'] == 'IS'){ ?>
																						<i class="fa fa-file-text" style="color: #339933"></i>
																						<?php }elseif($value['form_type'] == 'RCP'){ ?>
																						<i class="fa fa-briefcase" style="color: #990000"></i>
																						<?php }elseif($value['form_type'] == 'LCAF'){ ?>
																						<i class="glyphicon glyphicon-credit-card" style="color:"></i>
																						<?php }elseif($value['form_type'] == 'LAPF-ES'){ ?>
																						<i class="glyphicon glyphicon-briefcase" style="color: green;"></i>
																						<?php }elseif($value['form_type'] == 'LAPF-JS'){ ?>
																						<i class="fa fa-gavel" style="color: brown;"></i>
																						<?php } ?>
																						<span>
																								<span><?php echo $value['form_type']; ?> No.
																										<?php echo $value['reference_id']; ?></span>

																								<span class="time"></span>
																						</span>
																						<span class="message">
																								has been <?php echo $value['action']; ?> on <?php echo $action_date; ?>
																						</span>
																				</a>
																		</li>
																		<?php } if($all_notification_no == 0){ ?>
																		<li>
																				<div class="text-center">
																						<strong>No notification to be shown</strong>
																				</div>
																		</li>
																		<?php }?>
																		<li>
																				<a href="<?php echo base_url('notification') ?>" style="margin-left: 50px;">
																						<strong>See All Notifications </strong>
																						<i class="fa fa-angle-right"></i>
																				</a>
																		</li>
																</ul>
														</li>
														<?php } ?>

												</ul>
										</nav>
								</div>
						</div>
						<!-- /top navigation -->


<script type="text/javascript">
	function scrollSmoothToBottom() {
		$('#xz').animate({
			scrollTop: $(document).height()
		}, "fast");
		return false;
	};

	const dynamic_nav = () => {
		const screen_size = window.innerWidth;
		const sidebar_size = $('.scroll-view').width();
		$('.nav_menu').width((screen_size - sidebar_size) - 15);
	}

	$(document).ready(function() {
		dynamic_nav();
		$(window).on('resize', function() {
			dynamic_nav();
		});
		$('.scroll-view').on('resize', function() {
			dynamic_nav();
		});
	});
</script>

<style type="text/css">
	.left_col .scroll-view {
	    overflow-y: auto;
	    max-height: 100vh;
	}
</style>