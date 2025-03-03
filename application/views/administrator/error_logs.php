<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
	<div class="row row_container">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<!--====================START CONTENT====================-->
			<div class="x_panel animate zoomIn" style="box-shadow: 5px 8px 16px #888888">
				<div class="x_title">
					<h2 style="word-spacing: 4px; letter-spacing: 1px; font-weight: bold; font-size: 14px;color: #2a3f54;"><i class="fa fa-exclamation-triangle"></i> Error Logs</h2>
					<div style="float:right;color: #2a3f54;">
						<p style="font-size: 13px;font-family: sans-serif;padding-bottom: 3px;letter-spacing: 1px;" id="da"></p>
						<p style="font-size: 13px;font-family: sans-serif;margin-top: -19px;letter-spacing: 1px;" id="ti"></p>
					</div>
					<div class="clearfix"></div>
				</div>

				<table id="datatable-fixed-header" class="table table-striped table-bordered table-sm">
					<thead>
						<tr>
							<th width="40">No.</th>
							<th>Type</th>
							<th>Timestamp</th>
							<th>Message</th>
							<th>Action</th>
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
        // Function to fetch error logs
        function fetchErrorLogs() {
            $.ajax({
                url: "<?= base_url('Admin/Error_Logs/get_error_logs') ?>", // Adjust the URL to match your actual endpoint
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var tbody = $("#datatable-fixed-header tbody");
                    tbody.empty(); // Clear any existing rows
                    
                    data.forEach(function(log, index) {
                        var isRead = localStorage.getItem('log_' + index); // Check if log is read
                        var row = "<tr class='" + (isRead ? "" : "unread-log") + "'>" +
                                  "<td><center>" + (index + 1) + "</center></td>" +
                                  "<td>" + log.timestamp + "</td>" +
                                  "<td>" + log.type + "</td>" +
                                  "<td>" + log.message + "</td>" +
                                  "<td>" +
                                    "<button class='btn btn-info btn-sm read-log' data-log='" + log.message + "' data-index='" + index + "'>Read</button> " +
                                    "<button class='btn btn-danger btn-sm delete-log' data-filename='" + log.file + "'>Delete</button>" +
                                  "</td>" +
                                  "</tr>";
                        tbody.append(row);
                    });

                    // Attach click event handlers after rows are added
                    $(".read-log").click(function() {
                        var logMessage = $(this).data('log');
                        var index = $(this).data('index');
                        markLogAsRead(index); // Mark log as read
                        $(this).closest("tr").removeClass('unread-log'); // Remove 'unread-log' class when Read button is clicked
                        localStorage.setItem('log_' + index, 'read'); // Store read status in localStorage
                        //alert(logMessage); // You can customize this to display the log message in a modal or other UI component
                    });

                    $(".delete-log").click(function() {
                        var filename = $(this).data('filename');
                        deleteLogFile(filename);
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error fetching logs: " + textStatus, errorThrown);
                    alert("An error occurred while fetching error logs.");
                }
            });
        }

        // Function to delete a log file
        function deleteLogFile(filename) {
            $.ajax({
                url: "<?= base_url('Admin/Error_Logs/delete_log_file') ?>",
                type: "POST",
                data: { filename: filename },
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                        //alert(response.message);
                        fetchErrorLogs(); // Refresh the log list after deletion
                    } else {
                        alert(response.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error deleting log file: " + textStatus, errorThrown);
                    alert("An error occurred while deleting the log file.");
                }
            });
        }

        // Function to mark a log as read
        function markLogAsRead(index) {
            // Send an AJAX request to mark the log as read in the backend
            // You need to implement this functionality in your backend
            // After successful marking as read, remove the 'unread-log' class from the corresponding row
            // $("tr:eq(" + index + ")").removeClass('unread-log');
            // You can also store the read status in local storage or cookies for persistence
        }

        // Call the function to fetch error logs when the page loads
        fetchErrorLogs();
    });
</script>

<style>
    .unread-log {
        font-weight: bold;
    }
</style>


