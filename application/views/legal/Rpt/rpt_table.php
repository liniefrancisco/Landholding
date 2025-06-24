<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
    <div class="row row_container"> 
        <div class="col-md-12 col-sm-12 col-xs-12">
            <!--====================BODY====================--> 
            <div class="x_panel " style="box-shadow: 5px 8px 16px #888888">
                <div class="x_title">
                    <h6 class="fa fa-tasks"> <b>Real Property Tax</b></h6> 
                    <a href="#" onclick="window.history.back()" class="btn btn-xs btn-warning pull-right"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
                    <div class="clearfix"></div>
                </div>
                <!--====================TAB NAVIGATION====================-->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="javascript:void(0);" onclick="openTab(event, 'per_municipality', this)">
                        <i class="fa fa-building"></i><small> <b>Per Municipality</b></small>
                    </a></li>
                    <li><a href="javascript:void(0);" onclick="openTab(event, 'pending', this)">
                        <i class="fa fa-ellipsis-h"></i><small> <b>Pending</b></small>
                    </a></li>
                    <li><a href="javascript:void(0);" onclick="openTab(event, 'paid', this)">
                        <i class="fa fa-refresh"></i><small> <b>Paid</b></small>
                    </a></li>
                </ul>

                <div class="col-md-12 space">
                    <!--====================PER MUNICIPALITY====================-->
                    <div id="per_municipality" class="tabcontent">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group-sm">
                                    <select class="form-control select2 select2-hidden-accessible" id="region" name="region" onchange="loadProvince()" value="<?php echo set_value('region'); ?>" required>
                                        <option value="">Select Region</option>
                                    </select>
                                    <input type="hidden" id="selectedRegion" name="selectedRegion" readonly>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group-sm">
                                    <select class="form-control" id="province" name="province" onchange="loadCity()" value="<?php echo set_value('province'); ?>"  required>
                                        <option value="">Select Province</option>
                                    </select>
                                    <input type="hidden" id="selectedProvince" name="selectedProvince" readonly>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group-sm">
                                    <select class="form-control" id="town" name="town" value="<?php echo set_value('town'); ?>"  required>
                                        <option value="">Select City/Municipality</option>
                                    </select>
                                    <input type="hidden" id="selectedCity" name="selectedCity" readonly>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group-sm">
                                    <?php
                                        // Get distinct years as array of values only
                                        $query = $this->db->query("SELECT DISTINCT YEAR(posted_date) as year FROM real_property_tax");
                                        $years = array_column($query->result_array(), 'year');

                                        // Add current year if not present
                                        $currentYear = date('Y');
                                        if (!in_array($currentYear, $years)) {
                                            $years[] = $currentYear;
                                        }
                                        // Sort descending (optional)
                                        rsort($years);
                                    ?>

                                    <select class="form-control" id="year" name="year" required>
                                        <option value="">Year</option>
                                        <?php foreach ($years as $year): ?>
                                            <option value="<?= $year ?>"><?= $year ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-default dropdown-toggle" id="optionMenuBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="selectedOption">Options</span> <i class="fa fa-caret-down"></i></button>
                                            <ul class="dropdown-menu bg-white" aria-labelledby="optionMenuBtn">
                                                <li><button class="dropdown-item bg-white btn-xs" id="searchBtn" title="Search"><i class="fa fa-search text-primary"></i> Search</button></li>
                                                <li><button class="dropdown-item bg-white btn-xs" id="generateBtn" title="Generate"><i class="fa fa-file-pdf-o text-danger"></i> Generate Due RPT</button></li>
                                                <li><button class="dropdown-item bg-white btn-xs" id="postBtn" title="Post" data-toggle="modal" data-target="#uploadRptBillingModal"><i class="fa fa-send text-success"></i> Post</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row space">
                            <table id="rpt_datatable" class="table table-sm table-bordered table-hover small" style="border-bottom:2px solid gray">
                                <thead class="bg-primary">
                                    <tr>
                                        <th><input type="checkbox" id="checkAll" onclick="check()"></th>
                                        <th>IS No.</th>
                                        <th>TD No.</th>
                                        <th>Lot Owner</th>
                                        <th>Lot Location</th>
                                        <th>Lot No.</th>
                                        <th>Lot Type</th>
                                        <th>Assessment Lvl</th>
                                        <th>Effective Year</th>
                                        <th><center>Action</center></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <!--====================PENDING====================-->
                    <div id="pending" class="tabcontent" style="display: none;">
                        <table id="pending_rpt_datatable" class="table table-bordered table-hover" style="border-bottom:2px solid gray; width:100%">
                            <thead class="bg-primary">
                                <tr>
                                    <th>Posted Date</th>
                                    <th>IS No.</th>
                                    <th>TD No.</th>
                                    <th>Lot Owner</th>
                                    <th>Lot Location</th>
                                    <th>Lot No.</th>
                                    <th>Lot Type</th>
                                    <th>Assessment Lvl</th>
                                    <th>Effective Year</th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <!--====================PAID====================-->
                    <div id="paid" class="tabcontent" style="display: none;">
                        <table id="paid_rpt_datatable" class="table table-bordered table-hover" style="border-bottom:2px solid gray; width:100%">
                            <thead class="bg-primary">
                                <tr>
                                    <th>Posted Date</th>
                                    <th>IS No.</th>
                                    <th>TD No.</th>
                                    <th>Lot Owner</th>
                                    <th>Lot Location</th>
                                    <th>Lot No.</th>
                                    <th>Lot Type</th>
                                    <th>Assessment Lvl</th>
                                    <th>Effective Year</th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--====================END BODY====================--> 
        </div>
    </div>
</div>
<!--====================END PAGE CONTENT====================-->
<div class="modal fade" id="uploadRptBillingModal" style="margin-top:100px;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <button type="button" class="close" id="dclose" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" id="myModalLabel"><i class="fa fa-check-square-o"></i> Upload RPT Billing</h5>
            </div>
            <div class="modal-body">
                <label class="col-md-3"><small>Attach File</small></label>
                <input type="file" class="dropify" name="file" data-height="150" data-max-file-size="10M" accept=".jpg, .jpeg, .png, .pdf" onchange="previewFile(this);" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-sm" id="confirmPostBtn">Upload</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="postConfirmationModal" style="margin-top:100px;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <button type="button" class="close" id="dclose" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" id="myModalLabel"><i class="fa fa-check-square-o"></i> Confirmation</h5>
            </div>
            <div class="modal-body">
                <h6>Are you sure you want to post this data?</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm" id="confirmPostBtn">Yes</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>


<script>//updates the dropdown button label to show the selected action (Search, Generate, Post)
    document.getElementById('searchBtn').addEventListener('click', function () {
        document.getElementById('selectedOption').innerHTML = '<i class="fa fa-search text-primary"></i> Search';
    });
    document.getElementById('generateBtn').addEventListener('click', function () {
        document.getElementById('selectedOption').innerHTML = '<i class="fa fa-file-pdf-o text-danger"></i> Generate';
    });
    document.getElementById('postBtn').addEventListener('click', function () {
        document.getElementById('selectedOption').innerHTML = '<i class="fa fa-send text-success"></i> Post';
    });
</script>
<script>//Enables the "Post, Generate" button if all filters (region, province, town) are selected
    function checkFilters() {
        const region   = document.getElementById("region").value;
        const province = document.getElementById("province").value;
        const town     = document.getElementById("town").value;
        const year     = document.getElementById("year").value;

        const postBtn     = document.getElementById("postBtn");
        const generateBtn = document.getElementById("generateBtn");

        const allSelected = region && province && town && year;

        postBtn.disabled = !allSelected;
        generateBtn.disabled = !allSelected;
    }

    // Attach event listeners
    document.getElementById("region").addEventListener("change", checkFilters);
    document.getElementById("province").addEventListener("change", checkFilters);
    document.getElementById("town").addEventListener("change", checkFilters);
    document.getElementById("year").addEventListener("change", checkFilters);
    // Initial check in case values are pre-filled
    checkFilters();
</script>
<script>
    $('#confirmPostBtn').on('click', function() { //Handle Post
        var selected = [];
        $('.row-check:checked').each(function() {
            selected.push($(this).val());
        });

        if (selected.length === 0) {
            alert("Please select at least one item to post.");
            return;
        }
        // AJAX post selected IDs
        $.ajax({
            url: '<?= base_url("Rpt/Post_PerMunicipality") ?>', // Your controller method
            type: 'POST',
            data: { is_no: selected },
            success: function(response) {
                var res = JSON.parse(response); // Parse the JSON string
                if (res.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Posted Successfully',
                        text: 'The selected items have been posted!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: res.message || 'Something went wrong.'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Server Error',
                    text: 'Failed to post data. Please try again.'
                });
            }
        });
    });

    $('#generateBtn').on('click', function (e) {//Handle Generate
        e.preventDefault();

        let region   = $('#selectedRegion').val();
        let province = $('#selectedProvince').val();
        let city     = $('#selectedCity').val();
        let year     = $('#year').val();

        //Encrypt
        let encodedProvince = btoa(province);
        let encodedCity     = btoa(city);
        let encodedYear     = btoa(year);

        let url = "<?php echo base_url('Pdf/generate_due_rpt'); ?>/" + 
                    encodeURIComponent(encodedProvince) + "/" + 
                    encodeURIComponent(encodedCity) + "/" +
                    encodeURIComponent(encodedYear);

        window.open(url, '_blank');
    });
</script>