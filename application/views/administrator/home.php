<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container">
		<div class="alert alert-info alert-dismissible animate fadeInDown" role="alert" style="background-color:#001933;border-color:#001933;border:3px outset gray; ">
			<div class="row">
				<div class="col-md-8"><p style="font-size:20px;font-family: sans-serif;" id="display"><p></div>

				<div class="col-md-4">
					<div style="float:right;">
						<p style="font-size:15px;font-family: sans-serif" id="da"></p>
						<p style="font-size:15px;font-family: sans-serif;margin-top: -17px;" id="ti"></p>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" id="user" value="<?php echo $this->session->userdata('user_type');?>">			
	</div><br />
</div>
<!--====================END PAGE CONTENT====================-->