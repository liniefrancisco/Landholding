<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!--====================BODY====================-->
			<div class="x_panel" style="box-shadow: 5px 8px 16px #888888">
				<div class="x_title">
					<h2 class="fa fa-empire" style="font-size:15px"> List of Land Owned <span>[Note: Click Lot Location to view map.]</span></h2>
					<div style="float:right">
						<a href="#" onclick="goBack()" class="btn btn-sm btn-warning"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
					</div>
					<div class="clearfix"></div>
				</div>

				<table id="ccd_owned_land" class="table table-striped table-bordered" style="border-bottom:1px solid #262626;">
					<thead>
						<tr>
							<th>Lot No.</th>
							<th>Lot Location</th>
							<th>Lot Class</th>
							<th>Lot Area</th>
							<th>Acquired Date</th>
							<th>Acquired Land</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>	
			<!--====================END BODY====================-->
		</div>    
	</div><br/>
</div>
<!--====================END PAGE CONTENT====================-->

<script>
	const goBack = () => {
		window.history.back();
	};
</script>

<style type="text/css">
	table {
		font-family: 'Arial';
		margin: 25px auto;
		border-collapse: collapse; 
		border: 1px solid #eee;
		border-bottom: 2px solid #00cccc;
		box-shadow: 0px 0px 20px rgba(0,0,0,0.10),
			0px 10px 20px rgba(0,0,0,0.05),
			0px 20px 20px rgba(0,0,0,0.05),
			0px 30px 20px rgba(0,0,0,0.05);
	}
	tr {
		&:hover {
			background: #f4f4f4;
			td {
				color: #555;
			}
		}
	}
	th, td {
		color: #595959;
		border: 1px solid #eee;
		padding: 12px 35px;
		border-collapse: collapse;
	}
	th {
		background:linear-gradient(to top, rgb(9, 32, 63) 0%, rgb(83, 120, 149) 100%);
		color: #fff;
		text-transform: uppercase;
		font-size: 12px;
		&.last {
			border-right: none;
		}
	}
</style>









