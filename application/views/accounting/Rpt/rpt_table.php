<!-- Scroll-to-Top Button -->
<button id="mvTop" onclick="topFunction()" title="Go to top">↑ Top</button>

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
                <!--====================TAB NAVIGATION====================-->
				<ul class="nav nav-tabs">
				    <li class="active"><a href="javascript:void(0);" onclick="openTab(event, 'add-crf', this)">
				    	<i class="fa fa-ellipsis-h"></i><small> <b>Create CRF</b></small>
                        <sup>

                        </sup>
				    </a></li>
				    <li><a href="javascript:void(0);" onclick="openTab(event, 'submit-crf', this)">
				    	<i class="fa fa-check-circle"></i><small> <b>Submitted CRF</b></small>
					    <sup>

                        </sup>
                    </a></li>
				</ul>

                <div class="col-md-12">
                    <!--====================ADD CREATE CHECK REQUEST FORM====================-->
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
                                <select class="form-control" id="town" name="town" onchange="loadMunicipality()" value="<?php echo set_value('town'); ?>"  required>
                                    <option value="">Select City/Municipality</option>
                                </select>
                                <input type="hidden" id="selectedCity" name="selectedCity" readonly>
                            </div>
                        </div>
                        <div class="col-sm-1 pull-left">
                            <div class="form-group">
                                <div class="input-group">
                                    <div style="float:right">
                                        <button class="btn btn-primary" id="addCrfButton" disabled>Filter</button>                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal code include from external file -->
                    <?php include 'createcrf_modal.php'; ?>
    
                    <div class="col-md-12 space">
                        <!-- Wrapper para sa table ug spinner -->
                        <div id="tableWrapper" style="position: relative;">
                            <!-- Spinner loader placeholder - naa na siya gawas sa table -->
                            <div id="tableLoader" style="display: none;">
                                <div class="lds-spinner">
                                    <div></div><div></div><div></div><div></div><div></div>
                                    <div></div><div></div><div></div><div></div><div></div>
                                    <div></div><div></div>
                                </div>
                                <p>Loading data, please wait...</p>
                            </div>
                            <!-- ==========FOR CREATE CRF TAB========== -->
                            <div id="add-crf" class="tabcontent space">
                                <table id="Rptax_datatable" class="table table-bordered table-hover small" style="border-bottom:2px solid gray">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th style="text-align: center;">IS No.</th>
                                            <th style="text-align: center;">Lot Owner</th>
                                            <th style="text-align: center;">Lot Type</th>
                                            <th style="text-align: center;">Lot Location</th>
                                            <th style="text-align: center;">Tax Declaration No.</th>
                                            <th style="text-align: center;">Lot No.</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <!-- ==========FOR SUBMITTED CRF TAB========== -->
                        <div id="submit-crf" class="tabcontent space" style="display: none;">
                            <table id="SubmitRptax_datatable" class="table table-bordered table-hover small" style="border-bottom:2px solid gray">
                            <thead class="bg-primary">
                                <tr>
                                <th style="text-align: center;">IS No.</th>
                                <th style="text-align: center;">Lot Owner</th>
                                <th style="text-align: center;">Lot Type</th>
                                <th style="text-align: center;">Lot Location</th>
                                <th style="text-align: center;">Tax Declaration No.</th>
                                <th style="text-align: center;">Lot No.</th>
                                <th style="text-align: center;">Action</th>
                                <!-- <th style="text-align: center;">Submission No.</th>
                                <th style="text-align: center;">Submitter</th>
                                <th style="text-align: center;">Date Submitted</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Action</th> -->
                                </tr>
                            </thead>
                            <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- =================END TAB-PANE NAVIGATION================= -->  
            </div>
            <!--====================END BODY====================--> 
        </div>
    </div>
</div>

<!-- For Movetop function -->
<style>
#mvTop {
  display: none;
  position: fixed;
  bottom: 40px;
  right: 40px;
  z-index: 999;
  font-size: 16px;
  border: none;
  outline: none;
  background-color: #4B5320;
  color: white;
  cursor: pointer;
  padding: 12px 18px;
  border-radius: 4px;
}
#mvTop:hover {
  background-color: #333;
}
</style>


<!--====================END PAGE CONTENT====================-->
    <!-- =============LOAD SPINNER AND STYLES============= -->

<style>
    /* Container wrapping the table */
#tableWrapper {
    position: relative; /* positioning context for loader */
}

/* Spinner loader overlay */
#tableLoader {
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
    background: rgba(255, 255, 255, 0.8);
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    width: 200px;
    display: none; /* hide by default */
}

/* Spinner animation */
.lds-spinner {
    display: inline-block;
    position: relative;
    width: 40px;
    height: 40px;
    color: official; /* you can remove or adjust */
}

.lds-spinner div {
    transform-origin: 20px 20px;
    animation: lds-spinner 1.2s linear infinite;
}

.lds-spinner div:after {
    content: " ";
    display: block;
    position: absolute;
    top: 2px;
    left: 18px;
    width: 4px;
    height: 10px;
    border-radius: 20%;
    background: #4B5320;
}

.lds-spinner div:nth-child(1) { transform: rotate(0deg); animation-delay: -1.1s; }
.lds-spinner div:nth-child(2) { transform: rotate(30deg); animation-delay: -1s; }
.lds-spinner div:nth-child(3) { transform: rotate(60deg); animation-delay: -0.9s; }
.lds-spinner div:nth-child(4) { transform: rotate(90deg); animation-delay: -0.8s; }
.lds-spinner div:nth-child(5) { transform: rotate(120deg); animation-delay: -0.7s; }
.lds-spinner div:nth-child(6) { transform: rotate(150deg); animation-delay: -0.6s; }
.lds-spinner div:nth-child(7) { transform: rotate(180deg); animation-delay: -0.5s; }
.lds-spinner div:nth-child(8) { transform: rotate(210deg); animation-delay: -0.4s; }
.lds-spinner div:nth-child(9) { transform: rotate(240deg); animation-delay: -0.3s; }
.lds-spinner div:nth-child(10) { transform: rotate(270deg); animation-delay: -0.2s; }
.lds-spinner div:nth-child(11) { transform: rotate(300deg); animation-delay: -0.1s; }
.lds-spinner div:nth-child(12) { transform: rotate(330deg); animation-delay: 0s; }

@keyframes lds-spinner {
    0% { opacity: 1; }
    100% { opacity: 0; }
}

</style>

   <!-- ==================END LOAD SPINNER AND STYLES================== -->
    
<script> //Loads region, province, and city options dynamically using AJAX and stores selected descriptions in hidden fields.
    function loadRegion() {
        $.ajax({
            url: "<?php echo site_url('Acquisition/getregion') ?>",
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
       $('#province').html('<option>Loading...</option>').prop('disabled', true); //Clear the province dropdown
       $('#town').html('<option value="">Select City/Municipality</option>').prop('disabled', true);
       //$('#barangay').html('<option value="">Select Barangay</option>').prop('disabled', true); 

       const reg = $('#region').val();
       if (!reg) return;

       const [regCode, regDesc] = reg.split("|");
       $('#selectedRegion').val(regDesc);

       $.ajax({
            url:"<?php echo site_url("Acquisition/getprovince") ?>",
            method: "POST",
            dataType: 'json',
            data: { regCode },
            success: function(data) {
                const seen = new Set(); 
                $('#province').html('<option value="">Select Province</option>'); // reset again just to be sure

                data.forEach(item => {
                    if (!seen.has(item.provCode)) {
                        seen.add(item.provCode);
                        $('#province').append('<option value="' + item.provCode + '|' + item.provDesc + '">' + item.provDesc + '</option>');                            
                    }                    
                });

                $('#province').prop('disabled', false);
            },
            error: function(xhr, status, error) {
                console.error("Province loading failed:", error);
                $('#province').html('<option value="">Failed to load provinces</option>').prop('disabled', false);
            }
       });
    }

    function loadCity() {
        $('#town').html('<option>Loading...</option>').prop('disabled', true); // Show loading & disable

        const prov = $('#province').val();
        if (!prov) return;

        const [provCode, provDesc] = prov.split("|");
        $('#selectedProvince').val(provDesc);

        $.ajax({
            url: "<?php echo site_url('Acquisition/getcitymun') ?>",
            method: "POST",
            dataType: 'json',
            data: { provCode },
            success: function(data) {
                $('#town').html('<option value="">Select City/Municipality</option>');
                data.forEach(item => {
                    const cityName = item.citymunDesc;
                    $('#town').append('<option value="' + item.citymunCode + '|' + cityName + '|' + item.zipcode + '">' + cityName + '</option>');
                });
                $('#town').prop('disabled', false); // Enable dropdown again here
            },
            error: function(xhr, status, error) {
                console.error("City load failed:", error);
                $('#town').html('<option value="">Failed to load cities</option>').prop('disabled', false); // Still enable even if failed            
            }
        });
    }

        // Enable or disable Filter button based on dropdown selection
        function checkDropdowns() {
            const regionVal = $('#region').val();
            const provinceVal = $('#province').val();
            const townVal = $('#town').val();
            const enable = regionVal && provinceVal && townVal;
            $('#addCrfButton').prop('disabled', !enable);
        }

        let table;

        $(document).ready(function () {
            // Initialize DataTable with server-side processing
            table = $('#Rptax_datatable').DataTable({
            // fixedHeader: false,
                processing: true,
                serverSide: true,
                deferLoading: 0,
                searching: true,
                ordering: false,
            // order: [],
                ajax: {
                    url: "<?php echo base_url('Rpt/Rptax_datatable'); ?>",
                    type: "POST",
                    data: function(d) {
                        const regionVal   = $('#region').val();
                        const provinceVal = $('#province').val();
                        const townVal     = $('#town').val();

                        // Prevent accidental data fetch
                        if (!regionVal || !provinceVal || !townVal) {
                            d.region = '';
                            d.province = '';
                            d.town = '';
                        } else {
                            d.region    = regionVal.split('|')[1];
                            d.province  = provinceVal.split('|')[1];
                            d.town      = townVal.split('|')[1];
                        }
                    },
                    complete: function() {
                        $('#tableLoader').fadeOut(300);
                        $('#Rptax_datatable').css('opacity', '1');
                    }
                },
                columns: [
                    { title: "IS No", data: 0 },
                    { title: "Lot Owner", data: 1 },
                    { title: "Lot Type", data: 2 },
                    { title: "Lot Location", data: 3 },
                    { title: "Tax Declaration No.", data: 4 },
                    { title: "Lot No.", data: 5 },
                    { title: "Action", orderable: false, data: 6 }
                ]
                
            });


            // Region change confirmation
            $('#region').on('change', function () {
                const previousRegion = $(this).data('previous');
                const townVal = $('#town').val();

                if (townVal && !confirm('Changing the region will reset your current selection and loaded data. Do you want to proceed?')) {
                    $(this).val(previousRegion);
                    return;
                }

                $(this).data('previous', $(this).val());

                $('#province').html('<option value="">Select Province</option>');
                $('#town').html('<option value="">Select City/Municipality</option>');
                loadProvince();
                checkDropdowns();
                clearDataTableIfIncomplete();
            });

            $('#province').off().on('change', function () {
                loadCity(); // <<-- Load cities based on selected province
                checkDropdowns();
                clearDataTableIfIncomplete();
            });

            $('#town').on('change', function () {
                checkDropdowns();
                clearDataTableIfIncomplete();
            });

            function clearDataTableIfIncomplete() {
                const regionVal   = $('#region').val();
                const provinceVal = $('#province').val();
                const townVal     = $('#town').val();

                if (!regionVal || !provinceVal || !townVal) {
                    table.clear().draw(); // Manual clear
                    $('#addCrfButton').prop('disabled', true);
                }
            }

            // Mao rani siya ang makapa display ug data sa datatable nato
            $('#addCrfButton').on('click', function() {
                $('#tableLoader').fadeIn(200);
                $('#Rptax_datatable').hide();

                table.ajax.reload(function() {
                    // Callback after data is loaded
                    $('#tableLoader').fadeOut(300);
                    $('#Rptax_datatable').fadeIn(300);
                });
            });

            // Reset button clears dropdowns and table
            $('#resetButton').on('click', function () {
                $('#region').val('');
                $('#province').html('<option value="">Select Province</option>');
                $('#town').html('<option value="">Select City/Municipality</option>');
                $('#addCrfButton').prop('disabled', true);
                table.clear().draw();
            });

            $('#addCrfButton').on('mouseover click', function () {
                const isEnabled = $('#region').val() && $('#province').val() && $('#town').val();
                $(this).prop('disabled', !isEnabled);
            });

            checkDropdowns(); // Initial call to disable button if dropdowns empty
        });

        function loadMunicipality() {
            var formdata = new FormData();
            var region = $('#region').val().split('|')[1];
            var province = $('#province').val().split('|')[1];
            var town = $('#town').val().split('|')[1]; // assumes 'val' is like '123|TownName|Zip'

            formdata.append('region', region);
            formdata.append('province', province);
            formdata.append('town', town);

            $.ajax({
                url: "<?php echo site_url('Acquisition/get_rpt_details'); ?>",
                method: "POST",
                dataType: 'json',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#lot_location').empty();

                    if (data.length === 0) {
                        $('#lot_location').append('<option value="">No data found</option>');
                        return;
                    }

                    $.each(data, function(i, item) {
                        var optionText = item.location_description || 'No Description';
                        var optionValue = item.region + '|' + item.municipality + '|' + item.province;

                        $('#lot_location').append(
                            '<option value="' + optionValue + '">' + optionText + '</option>'
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.log("Error:", error);
                }
            });
        }

</script>

 <!-- For CRF add pr_id, is_no, and type -->
<script>

  $(document).on('click', '.openCrfModalBtn', function () {
    const pr_id  = $(this).data('pr_id') || '';
    const is_no  = $(this).data('is_no') || '';
    const type  = $(this).data('type') || '';

    console.log('Saving to sessionStorage:', pr_id, is_no, type);

    // Save to sessionStorage
    sessionStorage.setItem('pr_id', pr_id);
    sessionStorage.setItem('is_no', is_no);
    sessionStorage.setItem('type', type);

    // Set values to modal form immediately
    $('#pr_id').val(pr_id);
    $('#is_no').val(is_no);
    $('#type').val(type);
    
    $('.crf').modal('show');
  });

  $(document).ready(function () {
    const pr_id = sessionStorage.getItem('pr_id');
    const is_no = sessionStorage.getItem('is_no');
    const type = sessionStorage.getItem('type');

    if (pr_id || is_no || type) {
      console.log('Restoring from sessionStorage:', pr_id, is_no, type);
      $('#pr_id').val(pr_id);
      $('#is_no').val(is_no);
      $('#type').val(type);
    }
  });
  
</script>












