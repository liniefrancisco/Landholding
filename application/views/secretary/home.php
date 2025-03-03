<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container">
		<div class="alert alert-info alert-dismissible animate fadeInDown" role="alert" style="background-color:#001933;border-color:#001933;border:3px outset gray; ">
            <div class="row">
                <div class="col-md-8">
                    <p style="font-size: 20px;font-family: sans-serif;padding-top: 10px;" id="display">
                    <p>
                </div>
                <div class="col-md-4">
                    <div style="float:right;">
                        <p style="font-size: 15px;font-family: sans-serif" id="da"></p>
                        <p style="font-size: 15px;font-family: sans-serif;margin-top: -17px;" id="ti"></p>
                    </div>
                </div>
            </div>
        </div>
		<input type="hidden" id="user" value="<?php echo $this->session->userdata('firstname');?>">

		<div class="row tile_count"> 
			<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count" style="color:#fff;">
				<div class="panel panel-primary" style="background-color: #6e91ab;border:none;">
					<div class="x_panel" style="background-color:#6e91ab; border:none;border-radius:10px;">
						<div class="count">
							<p class="numberCircle"><?php echo $pending_acq; ?></p>
							<img src="<?php echo base_url(); ?>assets/logo/folder2.png" width="45%" style="float:right;"></img>
							<span class="count_top"><h4><b>Acquisition</b></h4></span>
						</div>
					</div>
					<div class="panel-footer" style="background-color:#3e6d90;border:none;">
						<a class="hov" href="<?= base_url('Secretary/Execute') ?>" style="color:#fff;float:right;">More Info <i class="fa fa-arrow-right"></i></a>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>

			<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count" style="color:#fff;">
				<div class="panel panel-primary" style="background-color: #6e91ab;border:none;">
					<div class="x_panel" style="background-color:#6e91ab; border:none;border-radius:10px;">
						<div class="count">
							<p class="numberCircle"></p>
							<img src="<?php echo base_url(); ?>assets/logo/folder2.png" width="45%" style="float:right;"></img>
							<span class="count_top"><h4><b>In Progress</b></h4></span>
						</div>
					</div>
					<div class="panel-footer" style="background-color:#3e6d90;border:none;">
						<a class="hov" href="<?= base_url('Secretary/Progress') ?>" style="color:#fff;float:right;">More Info <i class="fa fa-arrow-right"></i></a>
						<div class="clearfix"></div>
					</div>
				</div>
			</div> 

			<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count" style="color:#fff;">
				<div class="panel panel-primary" style="background-color: #6e91ab;border:none;">
					<div class="x_panel" style="background-color:#6e91ab; border:none;border-radius:10px;">
						<div class="count">
							<p class="numberCircle"><?php echo $approved_acq; ?></p>
							<img src="<?php echo base_url(); ?>assets/logo/folder2.png" width="45%" style="float:right;"></img>
							<span class="count_top"><h4><b>Owned</b></h4></span>
						</div>
					</div>
					<div class="panel-footer" style="background-color:#3e6d90;border:none;">
						<a class="hov" href="<?= base_url('Secretary/Owned') ?>" style="color:#fff;float:right;">More Info <i class="fa fa-arrow-right"></i></a>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>        								
		</div>
	</div>
</div>
<!--====================END PAGE CONTENT====================-->


<style>
	.numberCircle {
		display: inline-block;
		border-radius: 60%;
		border: 8px solid #c4c4c4;
		font-size: 48px;
	}
	.numberCircle:before,
	.numberCircle:after {
		content: '\200B';
		display: inline-block;
		line-height: 0px;
		padding-top: 20%;
	}
	.numberCircle:before {
		padding-left: 15px;
	}
	.numberCircle:after {
		padding-right: 15px;
	}
	a.hov:hover, a.hov:active {
		font-size: 102%;
		font-weight: bold;
	}
</style>