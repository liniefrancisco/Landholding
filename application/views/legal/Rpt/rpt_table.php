<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
    <div class="row row_container"> 
        <div class="col-md-12 col-sm-12 col-xs-12">
            <!--====================BODY====================--> 
            <div class="x_panel " style="box-shadow: 5px 8px 16px #888888">
                <div class="x_title">
                    <h6 class="fa fa-database"> <b>Real Property Tax</b></h6> 
                    <a href="#" onclick="window.history.back()" class="btn btn-xs btn-warning pull-right"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
                    <div class="clearfix"></div>
                </div>

                <div class="col-md-12 space">
                    <div class="col-sm-4">
                        <div class="form-group-sm">
                            <select class="form-control" id="region" name="region" onchange="loadProvince()" value="<?php echo set_value('region'); ?>" required>
                                <option value="">Select Region</option>
                            </select>
                            <input type="hidden" id="selectedRegion" name="selectedRegion" readonly>
                        </div>
                    </div>
                    <div class="col-sm-4">
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
                                <option value="">Select City</option>
                            </select>
                            <input type="hidden" id="selectedCity" name="selectedCity" readonly>
                        </div>
                    </div>

                    <div class="col-sm-1 pull-left">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-default dropdown-toggle" id="optionMenuBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="selectedOption">Options</span> <i class="fa fa-caret-down"></i></button>
                                    <ul class="dropdown-menu bg-white" aria-labelledby="optionMenuBtn">
                                        <li><button class="dropdown-item bg-white" id="searchBtn" title="Search"><i class="fa fa-search text-primary"></i> Search</button></li>
                                        <li><button class="dropdown-item bg-white" id="generateBtn" title="Generate"><i class="fa fa-file-pdf-o text-danger"></i> Generate Due RPT</button></li>
                                        <li><button class="dropdown-item bg-white" id="postBtn" title="Post"><i class="fa fa-send text-success"></i> Post</button></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 space">
                    <table id="rpt_datatable" class="table table-bordered table-hover small" style="border-bottom:2px solid gray">
                        <thead class="bg-primary">
                            <tr>
                                <th><input type="checkbox" id="checkAll" onclick="check()"></th>
                                <th>IS No.</th>
                                <th>TD No.</th>
                                <th>Lot Owner</th>
                                <th>Lot Location</th>
                                <th>Lot No.</th>
                                <th>Lot Type</th>
                                <th><center>Status</center></th>
                                <th><center>Action</center></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <!--====================END BODY====================--> 
        </div>
    </div>
</div>
<!--====================END PAGE CONTENT====================-->

<script>//Loads region, province, and city options dynamically using AJAX and stores selected descriptions in hidden fields
    function loadRegion() {
        $.ajax({
            url: "<?php echo site_url("Acquisition/getregion") ?>",
            method: "POST",
            success: function(data) {
                var jObj = JSON.parse(data);
                for (var c = 0; c < jObj.length; c++) {
                    $('#region').append('<option value="' + jObj[c].regCode + '|' + jObj[c].regDesc + '">' + jObj[c].regDesc + '</option>');
                }
            }
        });
    }
    loadRegion();

    function loadProvince() {
        // Clear the province, city, barangay fields when changing the region
        $("#province").html(""); // Clear the province dropdown
        $("#town").html("");
        $("#barangay").html("");
        $("#selectedRegion").val(""); // Clear the hidden input field

        var reg     = $("#region").val();
        var r       = reg.split("|");
        var regCode = r[0];
        var regDesc = r[1];

        // Save only the region description in the hidden input field
        $("#selectedRegion").val(regDesc);
        // Append the "Select Province" option to the province dropdown
        $('#province').append('<option value="">Select Province</option>');

        $.ajax({
            url: "<?php echo site_url("Acquisition/getprovince") ?>",
            method: "POST",
            dataType: 'json',
            data: {regCode: regCode},
            success: function (data) {
                $.each(data, function (i, data) {
                    $('#province').append('<option value="' + data.provCode + '|' + data.provDesc + '">' + data.provDesc + '</option>');
                });
            }
        });
    }
    function loadCity() {
        $("#town").html("");
        $("#town").append('<option value="">Select City/Municipality</option>');
        $("#selectedCity").val(""); // Clear the hidden input field

        var prov     = $("#province").val();
        var p        = prov.split("|");
        var provCode = p[0];
        var provDesc = p[1];

        // Save only the province description in the hidden input field
        $("#selectedProvince").val(provDesc);

        $.ajax({
            url: "<?php echo site_url("Acquisition/getcitymun") ?>",
            method: "POST",
            dataType: 'json',
            data: {provCode: provCode},
            success: function(data) {
                $.each(data, function(i, data) {
                    var cityName = data.citymunDesc.split(' ')[0];
                    $('#town').append('<option value="' + data.citymunCode + '|' + cityName + '|' + data.zipcode + '">' + cityName + '</option>');
                });
            }
        });

        // Additional code to handle city selection
        $("#town").on("change", function() {
            var selectedOption = $(this).val();
            if (selectedOption) {
                var parts       = selectedOption.split('|');
                var cityName    = parts[1];
                var zipcode     = parts[2];
                $("#zipcode").val(zipcode);
                // Save only the city description in the hidden input field
                $("#selectedCity").val(cityName);
            }else{
                $("#zipcode").val('');
            }
        });
    }
</script>
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

        const postBtn     = document.getElementById("postBtn");
        const generateBtn = document.getElementById("generateBtn");

        const allSelected = region && province && town;

        postBtn.disabled = !allSelected;
        generateBtn.disabled = !allSelected;
    }

    // Attach event listeners
    document.getElementById("region").addEventListener("change", checkFilters);
    document.getElementById("province").addEventListener("change", checkFilters);
    document.getElementById("town").addEventListener("change", checkFilters);
    // Initial check in case values are pre-filled
    checkFilters();
</script>
<script>
    $('#postBtn').on('click', function() {
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
                        $('#rpt_datatable').DataTable().ajax.reload(); // refresh table
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
</script>