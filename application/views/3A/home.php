<div class="right_col" role="main">
	<div class="row row_container">
		<div class="alert alert-info alert-dismissible animate fadeInDown" role="alert"
			style="background-color:#001933;border-color:#001933;border:3px outset gray;">
			<div class="row">
				<div class="col-md-8">
					<p style="font-size: 20px;font-family: sans-serif;padding-top: 10px;" id="display">
					<p>
				</div>
				<div class="col-md-4">
					<div style="float:right;">
						<p style="font-size: 15px;font-family: sans-serif" id="da"></p>
						<p style="font-size: 15px;font-family: sans-serif;margin-top: -19px;" id="ti"></p>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" id="user" value="<?php if ($this->session->userdata('user_type') == "GM") {
			echo "GM. Marlito Uy";
		} ?>">

		<div class="row tile_count">
			<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count" style="color:#fff;">
				<div class="panel panel-primary" style="background-color: #6e91ab;border:none;">
					<div class="x_panel" style="background-color: #6e91ab; border:none;border-radius:10px;">
						<div class="count">
							<p class="numberCircle"><?php echo $pending_acq; ?></p>
							<img src="<?php echo base_url(); ?>assets/logo/folder2.png" width="45%" style="float: right;"></img>
							<span class="count_top"><h4><b>Acquisition</b></h4></span>
						</div>
					</div>
					<div class="panel-footer" style="background-color: #3e6d90;border:none;">
						<a class="hov" href="<?= base_url('Acquisition/Acquisition_tbl') ?>" style="color:#fff;float: right;">More Info <i class="fa fa-arrow-right"></i></a>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>

			<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count" style="color:#fff;">
				<div class="panel panel-primary" style="background-color: #6e91ab;border:none;">
					<div class="x_panel" style="background-color: #6e91ab; border:none;border-radius:10px;">
						<div class="count">
							<p class="numberCircle"><?php echo $pending_payment; ?></p>
							<img src="<?php echo base_url(); ?>assets/logo/folder2.png" width="45%" style="float: right;"></img>
							<span class="count_top"><h4><b>Payment</b></h4></span>
						</div>
					</div>
					<div class="panel-footer" style="background-color: #3e6d90;border:none;">
						<a class="hov" href="<?= base_url('Payment/Payment_tbl') ?>" style="color:#fff;float: right;">More Info <i class="fa fa-arrow-right"></i></a>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>

			<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count" style="color:#fff;">
				<div class="panel panel-primary" style="background-color: #6e91ab;border:none;">
					<div class="x_panel" style="background-color: #6e91ab; border:none;border-radius:10px;">
						<div class="count">
							<p class="numberCircle"><?php echo $pending_acq; ?></p>
							<img src="<?php echo base_url(); ?>assets/logo/folder2.png" width="45%" style="float: right;"></img>
							<span class="count_top"><h4><b>Aspayment</b></h4></span>
						</div>
					</div>
					<div class="panel-footer" style="background-color: #3e6d90;border:none;">
						<a class="hov" href="<?= base_url('Aspayment/Aspayment_tbl') ?>" style="color:#fff;float: right;">More Info <i class="fa fa-arrow-right"></i></a>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>

			<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count" style="color:#fff;">
				<div class="panel panel-primary" style="background-color: #6e91ab;border:none;">
					<div class="x_panel" style="background-color: #6e91ab; border:none;border-radius:10px;">
						<div class="count">
							<p class="numberCircle"><?php echo $approved_acq; ?></p>
							<img src="<?php echo base_url(); ?>assets/logo/folder2.png" width="45%" style="float: right;"></img>
							<span class="count_top"><h4><b>Owned</b></h4></span>
						</div>
					</div>
					<div class="panel-footer" style="background-color: #3e6d90;border:none;">
						<a class="hov" href="<?= base_url('Owned') ?>" style="color:#fff;float: right;">More Info <i class="fa fa-arrow-right"></i></a>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>

		<!--==================== VALUE FOR THE DOUGHNUT CHART ====================-->
		<?php
		$Agricultural_area = 0;
		$commercial_area = 0;
		$Residential_area = 0;

		foreach ($approved_acq1 as $c) {
			if ($c['lot_type'] == 'Agricultural'):
				$Agricultural_area += $c['lot_size'];
			endif;
			if ($c['lot_type'] == 'Commercial'):
				$commercial_area += $c['lot_size'];
			endif;
			if ($c['lot_type'] == 'Residential'):
				$Residential_area += $c['lot_size'];
			endif;

		}
		echo '<td ><input type="hidden" id="agricultural" value="' . $Agricultural_area . '" /></td>';
		echo '<td ><input type="hidden" id="commercial" value="' . $commercial_area . '" /></td>';
		echo '<td ><input type="hidden" id="residential" value="' . $Residential_area . '" /></td>';

		?>
		<!--==================== END VALUE FOR THE DOUGHNUT CHART ====================-->

		<div class="col-md-2"></div>
		<!--==================== DOUGHNUT CHART ====================-->
		<div class="col-md-8 col-sm-8 col-xs-8 animated fadeInUp">
			<div class="x_panel tile fixed_height_320 overflow_hidden" style="height: 34%;">
				<div id="chartContainer" style="height: 200px; width: 100%;"></div>
			</div>
		</div>
		<!--==================== END DOUGHNUT CHART ====================-->
	</div>
</div>

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

	a.hov:hover,
	a.hov:active {
		font-size: 102%;
		font-weight: bold;
	}
</style>
<!-- /page content -->

<script type="text/javascript">

	window.onload = function () {

		var agri = parseFloat($('#agricultural').val());
		var comm = parseFloat($('#commercial').val());
		var resi = parseFloat($('#residential').val());
		var chartData = [];
		if (agri > 0) chartData.push({ y: agri, label: 'Agricultural' })
		if (comm > 0) chartData.push({ y: comm, label: 'Commercial' })
		if (resi > 0) chartData.push({ y: resi, label: 'Residential' })

		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			title: {
				text: "Lot class according to its sizes",
				horizontalAlign: "center"
			},
			data: [{
				type: "doughnut",
				startAngle: 60,
				//innerRadius: 60,
				indexLabelFontSize: 17,
				indexLabel: "{label} - #percent%",
				toolTipContent: "<b>{label}:</b> {y} (#percent%)",
				dataPoints: chartData
			}]
		});
		chart.render();
		const nodata = '<h4 style="position: absolute; z-index: 100; top: 50%; left: 50%; transform: translate(-50%, -50%); margin-top:10%">No Data Available</h4>';
		if (chartData.length == 0)
			$('#chartContainer .canvasjs-chart-container').prepend(nodata);
	}

</script>