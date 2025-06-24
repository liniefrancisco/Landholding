<!DOCTYPE html>
<html>
	<head>
		<title>Summary of Payment</title>
		<link href="<?php echo base_url();?>/assets/import/vendors/bootstrap/dist/css/bootstrap.min.css" rel="text/stylesheet">
	</head>
	<body>
		<div style="border-bottom:2px solid black">
			<img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="170px" height="40px"> 
			<h4 class="serif" style="margin-left:350px;margin-top:-40px;font-weight:bold">Land Holding Management System</h4> 
			<h5 class="serif" style="margin-left:380px; padding-top:-10px">Summary of Payment as of <?php echo date('F-d-Y') ?></h5>
		</div>
		<?php
    		$get_remaining_balance = $this->Payment_model->getLatestRemainingBalance($is_no);
		?>
		<table class="table table-striped table-bordered space">
		    <thead>
		        <tr>
		            <th style="background-color:#3B444B;color:#fff;font-size:11px;text-align:center;width:22%">PAYEE</th>
		            <th style="background-color:#3B444B;color:#fff;font-size:11px;text-align:center">AMOUNT PAYABLE</th>
		            <th style="background-color:#3B444B;color:#fff;font-size:11px;text-align:center">TRANSACTION DATE</th>
		            <th style="background-color:#3B444B;color:#fff;font-size:11px;text-align:center">CONTROL NO.</th>
		            <th style="background-color:#3B444B;color:#fff;font-size:11px;text-align:center">TYPE OF REQUEST</th>
		            <th style="background-color:#3B444B;color:#fff;font-size:11px;text-align:center">AMOUNT</th>
		        </tr>
		    </thead>
		    <tbody>
		        <?php
		            $payee_name   = $oi['firstname'] . ($oi['middlename'] ? ' ' . $oi['middlename'][0] . '. ' : ' ') . $oi['lastname'];
		            $payee_amount = number_format($li['total_price'], 2);
		            $has_payment  = false;
		            $rows         = [];

		            foreach ($getpt_byid_result as $pt) {
		                foreach ($getpr_byid_result as $pr) {
		                    if ($pt['pr_id'] == $pr['id'] && $pr['status'] == 'Paid') {
		                        $has_payment = true;
		                        $rows[] = [
		                            'transaction_date' => date("M. d, Y H:i:s", strtotime($pt['transaction_date'])),
		                            'control_no'       => $pr['control_no'],
		                            'type'             => $pr['type'],
		                            'amount'           => number_format($pt['amount'], 2),
		                            'balance'          => number_format($get_remaining_balance['remaining_balance'], 2)
		                        ];
		                    }
		                }
		            }

		            $rowspan = count($rows);

		            if ($rowspan > 0) {
		                foreach ($rows as $index => $row) {
		                    echo "<tr>";
		                    if ($index == 0) {
		                        echo "<td rowspan='{$rowspan}' style='font-size:11px;text-align:center'>{$payee_name}</td>";
		                        echo "<td rowspan='{$rowspan}' style='font-size:11px;text-align:center'>₱ {$payee_amount}</td>";
		                    }
		                    echo "<td style='font-size:11px;text-align:center'>{$row['transaction_date']}</td>";
		                    echo "<td style='font-size:11px;text-align:center'>{$row['control_no']}</td>";
		                    echo "<td style='font-size:11px;text-align:center'>{$row['type']}</td>";
		                    echo "<td style='font-size:11px;text-align:center'>₱ {$row['amount']}</td>";
		                    echo "</tr>";
		                }
		                echo "<tr>
		                        <td colspan='6' style='font-size:11px;text-align:right'><code>Balance: ₱{$row['balance']}</code></td>
		                      </tr>";
		            } else {
		                echo "<tr>
		                        <td style='font-size:11px;text-align:center'>{$payee_name}</td>
		                        <td style='font-size:11px;text-align:center'>₱ {$payee_amount}</td>
		                        <td colspan='4' style='font-size:11px;text-align:center'><code>No Payment History</code></td>
		                      </tr>";
		            }
		        ?>
		    </tbody>
		</table>
	</body>
</html>     
					
<style type="text/css">
	.serif {
		font-family:"Times New Roman",Times,serif
	}
	th,td{
		border: 1px solid black;
		padding:6px;
	}
</style>