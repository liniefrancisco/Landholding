<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!--====================FLASH DATA====================-->
			<?php if(($this->session->flashdata('notif')=='User Deleted Successfully!')){?>
				<div class="alert alert-info alert-dismissible fade in" role="alert" id="saved">
					<i class="glyphicon glyphicon-ok"></i>  <?php echo $this->session->flashdata('notif'); ?>
				</div>
			<?php } ?>
			<!--====================END FLASH DATA====================-->
			
			<!--====================START CONTENT====================-->
			<div class="x_panel animate zoomIn" style="box-shadow: 5px 8px 16px #888888">
				<div class="x_title">
					<h2 style="word-spacing: 4px; letter-spacing: 1px; font-weight: bold; font-size: 14px;color: #2a3f54;"><i class="fa fa-list"></i> User Account Lists</h2>
					<div style="float:right;color: #2a3f54;">
						<p style="font-size: 13px;font-family: sans-serif;padding-bottom: 3px;letter-spacing: 1px;" id="da"></p>
						<p style="font-size: 13px;font-family: sans-serif;margin-top: -19px;letter-spacing: 1px;" id="ti"></p>
					</div>
					<div class="clearfix"></div>
				</div>

				<table id="datatable-fixed-header" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th width="40"><center>ID. No.</center></th>
							<th>Profile</th>
							<th>User Type</th>
							<th>Date Created</th>
							<th>Last Login</th>
							<th>Action</th>
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
								<td><?php echo  date("M/d/y", strtotime($ul['date_created'])); ?></td>
								<td><?php echo  date("Y F jS h:i:s a", strtotime($ul['last_login'])); ?></td>
								<td><button class="btn btn-danger btn-xs" data-dismiss="modal"  data-toggle="modal" data-target=".remove_<?php echo $ul['user_id']; ?>"><i class="fa fa-trash"></i> </button></td>
							</tr>
						<?php } } ?>
					</tbody>
				</table>		 
			</div>  
			<!--====================END CONTENT====================-->
		</div>					
	</div><br />
</div>
<!--====================END PAGE CONTENT====================-->

<!--====================MODAL FOR DISAPPROVED====================-->
<?php foreach($user_lists as $ul){  ?>
	<div class="modal fade remove_<?php echo $ul['user_id']?>"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" style="margin-top: 100px;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background:#d9534f;">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-trash" style="color:white;"></i><span style="color:#E7E7E7;"> Delete</span></h4>
				</div>

				<div class="modal-body">
					<center><h6><span style="font-family:verdana; font-size:15px">Are you sure, you want to delete <code><?php echo $ul['firstname'] ." ".$ul['lastname']; ?></code> as user?</span></h6></center>
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-sm btn-danger disapprove" id="<?php echo $ul['user_id']?>">Yes</button>
					<button type="button" class="btn btn-sm btn-white" data-dismiss="modal">No</button>
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
				url: "<?php echo base_url('Account/delete_user/'); ?>" + id,
				type: "post",
				success: function(response) {
					// Redirecting to the list page after successful deletion
					window.location.replace("<?php echo base_url('Account/lists'); ?>");
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.error("Error: " + textStatus, errorThrown);
					alert("An error occurred while deleting the user. Please try again.");
				}
			});
		});
	});
</script>


<style>
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
		font-size: 12px;
	}

	th {
		background: #0d2e56;
		color: #fff;
		text-transform: uppercase;
		font-size: 11px;
		&.last {
			border-right: none;
		}
	}
</style>