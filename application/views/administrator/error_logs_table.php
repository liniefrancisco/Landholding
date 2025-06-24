<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!--====================START CONTENT====================-->
			<div class="x_panel animate zoomIn" style="box-shadow: 5px 8px 16px #888888">
				<div class="x_title">
					<h6 class="fa fa-exclamation-triangle text-danger"> <b>Error Logs</b></h6> 
                    <a href="#" onclick="window.history.back()" class="btn btn-xs btn-warning pull-right"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
					<div class="clearfix"></div>
				</div>
                <div class="row pull-right">
                    <button id="read_all_logs" class="btn btn-success">Mark All as Read</button>
                    <button id="delete_all_logs" class="btn btn-danger">Delete All Logs</button>
                </div>
				<table id="error_table" class="table table-striped table-bordered table-sm">
					<thead class="bg-primary">
						<tr>
							<th width="1%">No.</th>
							<th width="3%">Type</th>
							<th width="13%">Timestamp</th>
							<th>Message</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>		 
			</div>  
			<!--====================END CONTENT====================-->
		</div>					
	</div><br />
</div>
<!--====================END PAGE CONTENT====================-->

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(event) {
        function fetchErrorLogs() {// Function to fetch error logs
            $.ajax({
                url: "<?= base_url('Admin/get_error_logs') ?>", 
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var tbody = $("#error_table tbody");
                    tbody.empty(); // Clear existing rows
                    
                    data.forEach(function(log, index) {
                        var isRead = localStorage.getItem('log_' + index); 
                        var row = "<tr class='" + (isRead ? "" : "unread-log") + "'>" +
                                  "<td><center>" + (index + 1) + "</center></td>" +
                                  "<td>" + log.timestamp + "</td>" +
                                  "<td>" + log.type + "</td>" +
                                  "<td>" + log.message + "</td>" +
                                  "</tr>";
                        tbody.append(row);
                    });

                    // Attach click event for marking all as read
                    $("#read_all_logs").off().click(function() {
                        markAllLogsAsRead();
                    });
                    // Attach click event for deleting all logs
                    $("#delete_all_logs").off().click(function() {
                        deleteAllLogs();
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error fetching logs: " + textStatus, errorThrown);
                    alert("An error occurred while fetching error logs.");
                }
            });
        }

        function markAllLogsAsRead() {// Function to mark all logs as read
            $("#error_table tbody tr").removeClass('unread-log'); // Remove bold class
            $("#error_table tbody tr").each(function(index) {
                localStorage.setItem('log_' + index, 'read'); // Store read status for each log
            });
        }

        function deleteAllLogs() {// Function to delete all logs
            if (confirm("Are you sure you want to delete all logs?")) {
                $.ajax({
                    url: "<?= base_url('Admin/delete_log_file') ?>", 
                    type: "POST",
                    dataType: "json",
                    success: function(response) {
                        alert(response.message);
                        fetchErrorLogs(); // Refresh logs after deletion
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error deleting all log files: " + textStatus, errorThrown);
                        alert("An error occurred while deleting log files.");
                    }
                });
            }
        }

        // Call function to fetch logs on page load
        fetchErrorLogs();
    });
</script>

<style>
    .unread-log {
        font-weight: bold;
    }
</style>