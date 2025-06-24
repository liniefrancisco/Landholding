<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!--====================FLASH DATA====================-->
			<?php if ($this->session->flashdata('success')) { ?>
				<div class="alert alert-success alert-dismissible fade in" role="alert" id="saved">
					<i class="glyphicon glyphicon-ok"></i> <?php echo $this->session->flashdata('success'); ?>
				</div>
			<?php } ?>
			<!--====================START CONTENT====================-->
			<div class="x_panel animate zoomIn" style="box-shadow: 5px 8px 16px #888888">
				<div class="x_title">
					<h6 class="fa fa-list"> <b>User Account Lists</b></h6> 
                    <a href="#" onclick="window.history.back()" class="btn btn-xs btn-warning pull-right"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
					<div class="clearfix"></div>
				</div>

				<table class="table table-striped table-bordered table-sm">
					<thead class="bg-primary">
						<tr>
							<th width="1%">No.</th>
							<th>Profile</th>
							<th>User Type</th>
							<th>Date Created</th>
							<th>Last Login</th>
							<th><center>Action</center></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($user_lists as $ul){ 
							if($this->session->userdata('user_id') == $ul['user_id']){}else{
						?>
							<tr>
								<td><center><?php echo $ul['user_id'] ?></center></td>
								<td>
									<?php if(empty($ul['image'])){ ?>
										<img  alt="..." src="<?=base_url()?>assets/logo/default.png" width="40px" height="40px" style="border-radius: 50%;"/>
									<?php }else{ ?>
										<img  alt="..." src="<?=base_url();?>/assets/img/users/<?php echo $ul['user_type']?>/<?php echo $ul['image']?>" width="40px" height="40px" style="border-radius: 50%;"/>
									<?php   }
										echo $ul['firstname'] ." ".$ul['lastname'];
									?>
								</td>
								<td><?php echo $ul['user_type'] ?></td>
								<!-- Safely handle possible null date_created -->
								<td>
									<?php
									 echo  !empty($ul['date_created']) ?
									 		date("M/d/y h:i:s a", strtotime($ul['date_created'])) :
											'Wala'; 
											?>
								</td>
								<!-- Safely handle possible null last_login -->
								<td>
									<?php
									 echo !empty($ul['last_login']) ? 
									 		date("M/d/y h:i:s a", strtotime($ul['last_login'])) : 
									 		''; 
									 ?>
								</td>
								<td><center><button class="btn btn-danger btn-xs" data-dismiss="modal"  data-toggle="modal" data-target=".remove_<?php echo $ul['user_id']; ?>">
									<i class="fa fa-trash"></i> 
								</button>
									</center>
								</td>
							</tr>
						<?php } } ?>
					</tbody>
				</table>		 
			</div>  
			<!--====================END CONTENT====================-->
		</div>					
	</div><br/>
</div>
<!--====================END PAGE CONTENT====================-->

<!--====================MODAL FOR DISAPPROVED====================-->
<?php foreach($user_lists as $ul){  ?>
	<div class="modal fade remove_<?php echo $ul['user_id']?>"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" style="margin-top: 100px;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background:#d9534f;">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h6 class="modal-title" style="color:#fff"><i class="fa fa-trash"></i> Delete</h6>
				</div>
				<div class="modal-body">
					<center><h6><span style="font-family:verdana; font-size:15px">Are you sure, you want to delete <code><?php echo $ul['firstname'] ." ".$ul['lastname']; ?></code> as user?</span></h6></center>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-sm btn-success disapprove" id="<?php echo $ul['user_id']?>">Yes</button>
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">No</button>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<!--====================END MODAL FOR DISAPPROVED====================-->

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(event) {
		$(".disapprove").click(function() {
			var id = $(this).attr("id");
			$.ajax({
				url: "<?php echo base_url('Admin/delete_user/'); ?>" + id,
				type: "post",
				success: function(response) {
					window.location.replace("<?php echo base_url('Admin/ListAccount_tbl'); ?>");
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.error("Error: " + textStatus, errorThrown);
					alert("An error occurred while deleting the user. Please try again.");
				}
			});
		});
	});
</script>