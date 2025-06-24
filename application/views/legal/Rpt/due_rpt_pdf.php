<!DOCTYPE html>
<html>
	<head>
		<title>Due Real Property Tax</title>
		<link href="<?php echo base_url();?>assets/import/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<div style="border-bottom:2px solid black">
			<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="170px" height="40px"> 
			<h4 class="serif" style="margin-left:350px;margin-top:-40px;font-weight:bold">LandHolding Management System</h4> 
			<h5 class="serif" style="margin-left:380px; padding-top:-10px">Summary of Unpaid RPT as of year <?= $year ?></h5>
		</div>

		<table class="table table-striped table-bordered" style="margin-top:20px">
			<thead>
				<tr>
					<th style="background-color:#3B444B;color:#fff;font-size:10px;text-align:center">TAX DEC #</th>
					<th style="background-color:#3B444B;color:#fff;font-size:10px;text-align:center">OWNER</th>
					<th style="background-color:#3B444B;color:#fff;font-size:10px;text-align:center">LOCATION</th>
					<th style="background-color:#3B444B;color:#fff;font-size:10px;text-align:center">LOT #</th>
					<th style="background-color:#3B444B;color:#fff;font-size:10px;text-align:center">SIZE (sq.m)</th>
					<th style="background-color:#3B444B;color:#fff;font-size:10px;text-align:center">EFFECTIVE YEAR</th>
					<th style="background-color:#3B444B;color:#fff;font-size:10px;text-align:center">ASS'T LVL</th>
					<th style="background-color:#3B444B;color:#fff;font-size:10px;text-align:center">ASS'T VALUE</th>
					<th style="background-color:#3B444B;color:#fff;font-size:10px;text-align:center">STATUS</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(!empty($land_info)){
						foreach($lot_location as $ll){
							foreach($land_info as $li){
								if($li['is_no'] == $ll['is_no']){
									// Check if this land already posted for the given year
					                $has_posted_rpt = $this->db
									                       ->where('is_no', $li['is_no'])
									                       ->where('YEAR(posted_date)', $year)
									                       ->get('real_property_tax')
									                       ->num_rows() > 0;
									if ($has_posted_rpt) {
					                    continue; // skip if RPT is already posted for this year
					                }

									$assessment = $this->db->get_where('assessments', array('is_no' => $li['is_no']))->row_array();
					                $rpt = $this->db->order_by('year_paid', 'asc')
					                				->get_where('real_property_tax', ['is_no' => $li['is_no']])
					                				->result_array();

					               	if (ucfirst($ll['province']) == "Manila") {
	                                    $per            = $assessment['Assessment_Level'] * 0.01;
	                                    $assessed_value = $li['total_price'] * $per;
	                                    $rpt            = $assessed_value * .02;
	                                } else {
	                                    $per            = $assessment['Assessment_Level'] * 0.01;
	                                    $assessed_value = $li['total_price'] * $per;
	                                    $rpt            = $assessed_value * .01;
	                                }
				?>
					<tr>
						<td style="font-size:10px">New TD</td>
						<td style="font-size:10px">New Owner</td>
						<td style="font-size:10px"><?= ucfirst($ll['municipality']) ?></td>
						<td style="font-size:10px;text-align:center"><?= $li['lot'] ?></td>
						<td style="font-size:10px;text-align:center"><?= number_format($li['lot_size'],2) ?></td>
						<td style="font-size:10px;text-align:center"><?= isset($assessment['Effective_year']) ? $assessment['Effective_year'] : '-' ?></td>
						<td style="font-size:10px;text-align:center"><?= isset($assessment['Assessment_Level']) ? $assessment['Assessment_Level'] : '-' ?></td>
						<td style="font-size:10px;text-align:center"><?= number_format($rpt,2) ?></td>
						<td style="font-size:10px;text-align:center"><code>Unpaid</code></td>
					   <!-- 	<td style="font-size:10px;text-align:center">
							<?php
								$Effective_year = $assessment['Effective_year'];
								$year_paid = [];
								foreach($rpt as $tax){
									$year_paid[] = date('Y', strtotime($tax['year_paid']));
								}
								$unpaid_year = is_numeric($Effective_year) ? array_diff(range($Effective_year + 1, date('Y')), $year_paid) : [];
								echo "<code>" . (count($unpaid_year) ? count($unpaid_year) . " year(s)" : "N/A") . "</code>";
							?>
						</td> -->
					</tr>
				<?php }}}}else{
					echo "<tr>
							<td colspan='7' style='font-size: 10px; color: red;'><center>No records to be shown</center></td>
						</tr>";
				} ?>
			</tbody>
		</table>
	</body>
</html>  

<style type="text/css">
	.serif{
		font-family:"Times New Roman",Times,serif
	}
	th,td{
		border: 1px solid black;
		padding:6px;
	}
</style>