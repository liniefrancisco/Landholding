<script src='<?= base_url() ?>resources/tinymce/tinymce.min.js'></script>
<div class="container">
  	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel" style="border-radius: 9px;"><br/>
  			<!--====================BODY====================-->
			<div class="col-md-12 col-sm-12 col-xs-12 space">
			  	<center><img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
					<h4><b>ACKNOWLEDGEMENT RECEIPT</b></h4>
			  	</center>

			  	<textarea class="form-control editor" id="receiptTextarea" name="receipt_file" style="max-width: 100%" rows="15" placeholder="Type Here..."><?= htmlspecialchars($ar); ?></textarea>
			</div>
  			<!--====================END BODY====================-->
		</div>
  	</div>
</div>


<script>
  	tinymce.init({ 
		selector:'.editor',
		theme: 'modern',
		height:600
  	});
</script>