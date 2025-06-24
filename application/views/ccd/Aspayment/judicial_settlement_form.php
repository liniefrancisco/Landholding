<?php if (validation_errors()) { ?>
    <div class="alert alert-danger alert-dismissible fade in" role="alert" style="position: fixed; bottom: 10px; right: 10px; z-index: 99; cursor: pointer;" id="saved">
        <?php echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' . validation_errors('<i class="fa fa-remove"></i> '); ?>
    </div>
<?php } ?>
<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
    <div class="row row_container">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <!--====================FLASH DATA====================-->
            <?php if ($this->session->flashdata('notif')) { ?>
                <div class="alert alert-success alert-dismissible fade in" role="alert" id="saved">
                    <i class="glyphicon glyphicon-ok"></i> <?php echo $this->session->flashdata('notif'); ?>
                </div>
            <?php } ?>
            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert" id="saved">
                    <i class="fa fa-warning"></i> <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>
            <!--====================END FLASH DATA====================-->
            
            <!--====================BODY====================-->
            <div class="x_panel animate  fadeInLeft" style="box-shadow: 5px 8px 16px #888888">
                <div class="x_title">
                    <h2 class="fa fa-bank"><b>Settlement</b></h2>
                    <a href="#" onclick="window.history.back()" class="btn btn-sm btn-warning pull-right"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
                    <div class="clearfix"></div>
                </div>

                <?php 
                    $js_id = 0;
                    if (empty($js_no)) {
                        $js_no = "JS-0001";
                    }
                    foreach ($judicial as $key => $value) {
                        $js_id = substr($value['is_no'], 4) + 1;
                        if (strlen($js_id) == 1) {
                            $js_no = "JS-000" . $js_id;
                        } elseif (strlen($js_id) == 2) {
                            $js_no = "JS-00" . $js_id;
                        } elseif (strlen($js_id) == 3) {
                            $js_no = "JS-0" . $js_id;
                        } else {
                            $js_no = "JS-" . $js_id;
                        }
                    } 
                ?>

                <?php echo form_open_multipart('Aspayment/judicial', array('id' => 'add_lot'));?>
                    <div class="x_panel" style="border-radius:10px;">
                        <div class="row text-center space">
                            <img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
                            <h5><b>LAND AS PAYMENT FORM - JUDICIAL SETTLEMENT (LAPF-JS)</b></h5>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                            <div class="col-md-6 col-xs-6 col-sm-6 form-inline">
                                <label>LAPF-JS #:</label>
                                <input type="text" class="form-control" name="js_no" value="<?php echo $js_no; ?>" readonly>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 form-inline">
                                <div class="form-group pull-right">
                                    <label class="col-md-2">Date:</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control has-feedback-left" name="date" id="date" readonly >
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                </div>                            
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 text-center space" style="border-top:1px solid #ff6600; border-bottom:1px solid #ff6600;">
                            <h6 style="letter-spacing:5px;">CUSTOMER BALANCE INFORMATION</h6>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                            <div class="col-md-3 col-sm-3 col-xs-3"><label>Case Type:</label></div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <label class="r-contain">
                                    <input type="radio" value="Small claim case" name="case_type" <?php echo set_radio('case_type', 'Small claim case', @$_POST['case_type'] == 'Small claim case'); ?> required> Small claim case 
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-5">
                                <label class="r-contain">
                                    <input type="radio" value="Collection of Sum Money" name="case_type" <?php if (@$_POST['case_type'] == "Collection of Sum Money") { echo "checked"; } ?> required>Collection of Sum Money 
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                            <div class="col-md-3"><label>Business Unit:</label></div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="business_unit" value="<?= set_value('business_unit'); ?>" required>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                            <div class="col-md-3 col-sm-3 col-xs-3"><label>Customer Name:</label></div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <input class="form-control text-center" type="text" name="customer_fname" value="<?= set_value('customer_fname'); ?>" required>
                                <h6 class="text-center"><i>Firstname</i></h6>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <input class="form-control text-center" type="text" name="customer_mname" value="<?= set_value('customer_mname'); ?>" required>
                                <h6 class="text-center"><i>Middlename</i></h6>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <input class="form-control text-center" type="text" name="customer_lname" value="<?= set_value('customer_lname'); ?>" required>
                                <h6 class="text-center"><i>Lastname</i></h6>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-3 col-sm-3 col-xs-3"><label>Customer Address:</label></div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <select class="form-control text-center" id="region" name="customer_region" onchange="loadProvince()" value="<?php echo set_value('customer_region'); ?>" required>
                                    <option value="">Select Region</option>
                                </select>
                                <h6 class="text-center"><i>Region</i></h6>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <select class="form-control text-center" id="province" name="customer_province" onchange="loadCity()" value="<?php echo set_value('customer_province'); ?>" required>
                                    <option value="">Select Province</option>
                                </select>
                                <h6 class="text-center"><i>Province</i></h6>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <select class="form-control text-center" id="municipality" name="customer_municipality" onchange="loadBrgy()" value="<?php echo set_value('customer_town'); ?>" required>
                                    <option value="">Select City</option>
                                </select>
                                <h6 class="text-center"><i>City/Municipality</i></h6>
                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-3"></div>

                            <div class="ccol-md-3 col-sm-3 col-xs-3">
                                <select class="form-control text-center" id="barangay" name="customer_barangay" value="<?php echo set_value('customer_barangay'); ?>" required>
                                    <option value="">Select Barangay</option>
                                </select>
                                <h6 class="text-center"><i>Barangay</i></h6>
                            </div>
                            <div class="ccol-md-3 col-sm-3 col-xs-3">
                                <input type="text" class="form-control text-center" name="customer_street" value="<?php echo set_value('customer_street') ?>" required>
                                <h6 class="text-center"><i>Street</i></h6>
                            </div>
                            <div class="ccol-md-3 col-sm-3 col-xs-3">
                                <input type="text" class="form-control text-center" name="customer_zip_code" id="zip_code" value="<?php echo set_value('customer_zip_code') ?>" required readonly>
                                <h6 class="text-center"><i>Zip Code</i></h6>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 text-center space" style="border-top:1px solid #ff6600; border-bottom:1px solid #ff6600;">
                            <h6 style="letter-spacing:5px;">ATTACHMENT</h6>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                            <div class="col-md-6 col-xs-6 col-sm-6 form-inline">
                                <label>Lot :</label>
                                <input class="form-control" type="text" name="lot" value="<?php if (isset($_POST['lot'])) { echo $_POST['lot'];} ?>" required>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 form-inline">
                                <div class="form-group pull-right">
                                    <label>Cad :</label>
                                    <input class="form-control" type="text" name="cad" value="<?php if (isset($_POST['cad'])) { echo $_POST['cad'];} ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                            <div class="col-md-3 col-sm-3 col-xs-3 lot_type" style="height:29px;"><label>Lot Type:</label></div>
                            <div class="col-md-3 col-sm-3 col-xs-3 lot_type">
                                <label class="r-contain">
                                    <input type="radio" name="lot_type" value="Agricultural" <?php if (@$_POST['lot_type'] == "Agricultural") { echo "checked"; } ?> required>Agricultural 
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3 lot_type">
                                <label class="r-contain">
                                    <input type="radio" name="lot_type" value="Commercial" <?php if (@$_POST['lot_type'] == "Commercial") { echo "checked"; } ?> required>Commercial 
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3 lot_type">
                                <label class="r-contain">
                                    <input type="radio" name="lot_type" value="Residential" <?php if (@$_POST['lot_type'] == "Residential") { echo "checked";} ?> required>Residential 
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                            <div class="col-md-3 col-sm-3 col-xs-3"><label>Lot Owner:</div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <input type="text" class="form-control text-center" name="lot_fname" value="<?php if (isset($_POST['lot_fname'])) { echo $_POST['lot_fname']; } ?>" required>
                                <h6 class="text-center"><i>Firstname</i></h6>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <input type="text" class="form-control text-center" name="lot_mname" value="<?php if (isset($_POST['lot_mname'])) { echo $_POST['lot_mname']; } ?>" required>
                                <h6 class="text-center"><i>Middlename</i></h6>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <input type="text" class="form-control text-center" name="lot_lname" value="<?php if (isset($_POST['lot_lname'])) { echo $_POST['lot_lname']; } ?>" required>
                                <h6 class="text-center"><i>Lastname</i></h6>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                            <div class="col-md-3 col-sm-3 col-xs-3"><label>Gender:</label></div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <label class="r-contain">
                                    <input type="radio" name="gender" value="Male" <?php if(@$_POST['gender'] == "Male"){ echo "checked"; } ?> required>Male
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-5">
                                <label class="r-contain">
                                    <input type="radio" name="gender" value="Female" <?php if(@$_POST['gender'] == "Female"){ echo "checked"; } ?> required>Female
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                            <div class="col-md-3 col-sm-3 col-xs-3"><label>Vital Status:</label></div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <label class="r-contain">
                                    <input type="radio" name="vital_status" value="Alive" <?php if (@$_POST['vital_status'] == "Alive") { echo "checked"; } ?> required>Alive
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-5">
                                <label class="r-contain">
                                    <input type="radio" name="vital_status" value="Deceased" <?php if (@$_POST['vital_status'] == "Deceased") { echo "checked"; } ?> required>Deceased 
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                            <div class="col-md-3 col-sm-3 col-xs-3"><label>Lot Location:</div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <select class="form-control text-center" id="region1" name="lot_region" onchange="loadProvince1()" value="<?php echo set_value('lot_region'); ?>" required>
                                    <option value="">Select Region</option>
                                </select>
                                <h6 class="text-center"><i>Region</i></h6>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <select class="form-control text-center" id="province1" name="lot_province" onchange="loadCity1()" value="<?php echo set_value('lot_province'); ?>" required>
                                    <option value="">Select Province</option>
                                </select>
                                <h6 class="text-center"><i>Province</i></h6>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <select class="form-control text-center" id="municipality1" name="lot_town" onchange="loadBrgy1()" value="<?php echo set_value('lot_town'); ?>" required>
                                    <option value="">Select City</option>
                                </select>
                                <h6 class="text-center"><i>City/Municipality</i></h6>
                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-3"><label></div>

                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <select class="form-control text-center" id="barangay1" name="lot_barangay" value="<?php echo set_value('lot_barangay'); ?>" required>
                                    <option value="">Select Barangay</option>
                                </select>
                                <h6 class="text-center"><i>Barangay</i></h6>
                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <input type="text" class="form-control text-center" name="lot_street" value="<?php echo set_value('lot_street') ?>" required>
                                <h6 class="text-center"><i>Street</i></h6>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <input type="text" class="form-control text-center" name="lot_zip_code" id="zip_code1" value="<?php echo set_value('lot_zip_code') ?>" required readonly>
                                <h6 class="text-center"><i>Zipcode</i></h6>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                            <div class="col-md-3 col-sm-3 col-xs-3"><label>Lot for bidding:</label></div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <label class="r-contain">
                                    <input type="radio" name="lot_sold" value="Portion" <?php if (@$_POST['lot_sold'] == "Portion") { echo "checked"; } ?> required> Portion
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-5">
                                <label class="r-contain">
                                    <input type="radio" name="lot_sold" value="Whole" <?php if (@$_POST['lot_sold'] == "Whole") { echo "checked"; } ?> required> Whole 
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                            <div class="col-md-3 col-sm-3 col-xs-3 form-inline"><label>Lot Size:</label></div>
                            <div class="col-md-9 col-sm-9 col-xs-9 form-inline">
                                <input type="text" class="form-control inb" name="lot_size" value="<?php if (isset($_POST['lot_size'])) { echo $_POST['lot_size']; } ?>" required>
                                <label>sq/m</label>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <label>Available Proof of Title/Ownership:</label>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <label class="r-contain">
                                    <input type="radio" name="available_proof" value="oct" <?php if (@$_POST['available_proof'] == "oct") { echo "checked"; } ?> class="proof">Original Certificate of Title (OCT) 
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-5">
                                <label class="r-contain">
                                    <input type="radio" name="available_proof" value="tct" <?php if (@$_POST['available_proof'] == "tct") { echo "checked"; } ?> class="proof">Transfer Certificate of Title (TCT) 
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-4 col-sm-4 col-xs-4"></div>

                            <div class="col-md-4 col-sm-4 col-xs-4" id="oct">
                                <span class='label label-info file-name-label-oct' id="upload-oct"></span>
                                <label class="btn btn-default" for="oct_file" id="oct_button"
                                    <?php if (@$_POST['available_proof'] == "oct") {
                                        echo '';
                                    } else {
                                        echo 'style="display: none;"';
                                    } ?>>
                                    <input type="file" name="oct" class="form-control" id="oct_file" onchange="ValidateSingleInput(this);$('#upload-oct').html(this.files[0].name)" style="display: none;">
                                    <span class="fa fa-file-image-o"></span> Select File
                                </label>
                                <i style="color: red; display: none;" id="rmsg-oct">*required</i>
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-4" id="tct">
                                <span class='label label-info file-name-label-tct' id="upload-tct"></span>
                                <label class="btn btn-default" for="tct_file" id="tct_button"
                                    <?php if (@$_POST['available_proof'] == "tct") {
                                        echo '';
                                    } else {
                                        echo 'style="display: none;"';
                                    } ?>>
                                    <input type="file" name="tct" class="form-control" id="tct_file" onchange="ValidateSingleInput(this);$('#upload-tct').html(this.files[0].name)" style="display: none;">
                                    <span class="fa fa-file-image-o"></span> Select File
                                </label>
                                <i style="color: red; display: none;" id="rmsg-tct">*required</i>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 text-center space" style="border-top:1px solid #ff6600; border-bottom:1px solid #ff6600;">
                            <h6 style="letter-spacing:5px;">BIDDING DETAILS</h6>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 space">
                            <div class="col-md-6 col-sm-6 col-xs-6 form-inline"><label>Bid Price: ₱</label>
                                <input type="text" name="bid_price" value="<?php if (isset($_POST['bid_price'])) { echo $_POST['bid_price']; } ?>" class="form-control inb" id="bidding_price">
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 form-inline"><label>Status:</label>
                                <input type="text" name="status" value="<?php if (isset($_POST['status'])) { echo $_POST['status']; } ?>" class="form-control inb"><label>Highest Bidder</label>
                            </div>
                        </div>
                    </div>
                    <div style="float: right">
                        <a href="<?= base_url() ?>" class="btn btn-default">Cancel</a>
                        <input type="submit" name="" class="btn btn-custom-primary send" value="Submit">
                    </div>
                </form>
            </div>
            <!--====================END BODY====================-->
        </div>
    </div>
</div>
<!--====================PAGE CONTENT====================-->

<script type="text/javascript">//Date
    $(function() {
        $("#date").datepicker({
            dateFormat: 'mm/dd/yy',
        });
        // Set current date
        var d       = new Date();
        var month   = d.getMonth() + 1;
        var day     = d.getDate();
        var output  = (month < 10 ? '0' : '') + month + '/' + (day < 10 ? '0' : '') + day + '/' + d.getFullYear();
        $("#date").val(output);
    });
</script>
<script type="text/javascript">//Load Customer Address
    function loadRegion() {//Load Region
        $.ajax({
            url: "<?php echo site_url("Aspayment/getregion") ?>",
            method: "POST",
            dataType: "json",
            success: function (data) {
                $('#region').empty().append('<option value="">Select Region</option>');
                data.forEach(region => {
                    $('#region').append(`<option value="${region.regCode}">${region.regDesc}</option>`);
                });
            },
            error: function (xhr, status, error) {
                console.error("Error loading regions:", xhr.responseText);
            }
        });
    }
    loadRegion();
    function loadProvince() {//Load Province
        let regCode = $("#region").val();
        if (!regCode) {
            $("#province").html('<option value="">Select Province</option>');
            return;
        }

        $.ajax({
            url: "<?php echo site_url("Aspayment/getprovince") ?>",
            method: "POST",
            dataType: "json",
            data: { regCode: regCode },
            success: function (data) {
                $('#province').empty().append('<option value="">Select Province</option>');
                data.forEach(province => {
                    $('#province').append(`<option value="${province.provCode}">${province.provDesc}</option>`);
                });
            },
            error: function (xhr, status, error) {
                console.error("Error loading provinces:", xhr.responseText);
            }
        });
    }
    function loadCity() {//Load Municipality
        let provCode = $("#province").val();

        if (!provCode) {
            $("#municipality").html('<option value="">Select City/Municipality</option>');
            $("#zip_code").val("");
            return;
        }

        $.ajax({
            url: "<?php echo site_url("Aspayment/getcitymun") ?>",
            method: "POST",
            dataType: "json",
            data: { provCode: provCode },
            success: function (data) {
                $('#municipality').empty().append('<option value="">Select City/Municipality</option>');
                $.each(data, function(i, data) {
                    var cityName = data.citymunDesc.split(' ')[0];
                    $('#municipality').append('<option value="' + data.citymunCode + '|' + cityName + '|' + data.zipcode + '">' + cityName + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error("Error loading cities:", xhr.responseText);
            }
        });
        $("#municipality").on("change", function() {
            let selectedOption = $(this).val();
            if (selectedOption) {
                let parts       = selectedOption.split('|');
                let cityName    = parts[1];
                let zipcode     = parts[2];

                $("#zip_code").val(zipcode);
            } else {
                $("#zip_code").val('');
            }
        });
    }
    function loadBrgy() {//Load Barangay
        let selectedOption = $("#municipality").val();
        if (!selectedOption) {
            $("#barangay").html('<option value="">Select Barangay</option>');
            return;
        }
        let citymunCode = selectedOption.split('|')[0]; // Extract only the citymunCode

        $.ajax({
            url: "<?php echo site_url("Aspayment/getbrgy") ?>",
            method: "POST",
            dataType: "json",
            data: { citymunCode: citymunCode },
            success: function (data) {
                $('#barangay').empty().append('<option value="">Select Barangay</option>');
                data.forEach(brgy => {
                    $('#barangay').append(`<option value="${brgy.brgyCode}">${brgy.brgyDesc}</option>`);
                });
            },
            error: function (xhr, status, error) {
                console.error("Error loading barangays:", xhr.responseText);
            }
        });
    }
</script>
<script type="text/javascript">//Load Lot Location
    function loadRegion1() {//Load Region
        $.ajax({
            url: "<?php echo site_url("Aspayment/getregion") ?>",
            method: "POST",
            dataType: "json",
            success: function (data) {
                $('#region1').empty().append('<option value="">Select Region</option>');
                data.forEach(region => {
                    $('#region1').append(`<option value="${region.regCode}">${region.regDesc}</option>`);
                });
            },
            error: function (xhr, status, error) {
                console.error("Error loading regions:", xhr.responseText);
            }
        });
    }
    loadRegion1();
    function loadProvince1() {//Load Province
        let regCode = $("#region1").val();
        if (!regCode) {
            $("#province1").html('<option value="">Select Province</option>');
            return;
        }

        $.ajax({
            url: "<?php echo site_url("Aspayment/getprovince") ?>",
            method: "POST",
            dataType: "json",
            data: { regCode: regCode },
            success: function (data) {
                $('#province1').empty().append('<option value="">Select Province</option>');
                data.forEach(province => {
                    $('#province1').append(`<option value="${province.provCode}">${province.provDesc}</option>`);
                });
            },
            error: function (xhr, status, error) {
                console.error("Error loading provinces:", xhr.responseText);
            }
        });
    }
    function loadCity1() {//Load Municipality
        let provCode = $("#province1").val();

        if (!provCode) {
            $("#municipality1").html('<option value="">Select City/Municipality</option>');
            $("#zip_code1").val("");
            return;
        }

        $.ajax({
            url: "<?php echo site_url("Aspayment/getcitymun") ?>",
            method: "POST",
            dataType: "json",
            data: { provCode: provCode },
            success: function (data) {
                $('#municipality1').empty().append('<option value="">Select City/Municipality</option>');
                $.each(data, function(i, data) {
                    var cityName = data.citymunDesc.split(' ')[0];
                    $('#municipality1').append('<option value="' + data.citymunCode + '|' + cityName + '|' + data.zipcode + '">' + cityName + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error("Error loading cities:", xhr.responseText);
            }
        });
        $("#municipality1").on("change", function() {
            let selectedOption = $(this).val();
            if (selectedOption) {
                let parts       = selectedOption.split('|');
                let cityName    = parts[1];
                let zipcode     = parts[2];

                $("#zip_code1").val(zipcode);
            } else {
                $("#zip_code1").val('');
            }
        });
    }
    function loadBrgy1() {//Load Barangay
        let selectedOption = $("#municipality1").val();
        if (!selectedOption) {
            $("#barangay1").html('<option value="">Select Barangay</option>');
            return;
        }
        let citymunCode = selectedOption.split('|')[0]; // Extract only the citymunCode

        $.ajax({
            url: "<?php echo site_url("Aspayment/getbrgy") ?>",
            method: "POST",
            dataType: "json",
            data: { citymunCode: citymunCode },
            success: function (data) {
                $('#barangay1').empty().append('<option value="">Select Barangay</option>');
                data.forEach(brgy => {
                    $('#barangay1').append(`<option value="${brgy.brgyCode}">${brgy.brgyDesc}</option>`);
                });
            },
            error: function (xhr, status, error) {
                console.error("Error loading barangays:", xhr.responseText);
            }
        });
    }
</script>
<script type="text/javascript">//Available Proof of Title
    document.addEventListener("DOMContentLoaded", function(event) {
        //AVAILABLE PROOF OF TITLE/OWNERSHIP JQUERY
        $(".proof").click(function() {
            var a       = $(this).attr("value");
            var oct_in  = $("#oct_file").val();
            var tct_in  = $("#tct_file").val();

            if (a == "oct") {
                $("#oct_button").show();
                $("#tct_button").hide();
                $("#rmsg-tct").hide();
                $(".file-name-label-tct").hide();
                if (oct_in) {
                    $("#rmsg-oct").hide();
                } else {
                    $("#rmsg-oct").show();
                }
                $("#oct_file").prop('required', true);
                $("#tct_file").prop('required', false);
                $('#tct_file').val('');
            } else {
                $("#tct_button").show();
                $("#oct_button").hide();
                $("#rmsg-oct").hide();
                $(".file-name-label-oct").hide();
                if (tct_in) {
                    $("#rmsg-tct").hide();
                } else {
                    $("#rmsg-tct").show();
                }

                $("#tct_file").prop('required', true);
                $("#oct_file").prop('required', false);
                $('#oct_file').val('');
            }
        });
        //End

        document.querySelector('.send').addEventListener("click", function() {
            window.btn_clicked = true;
        });

        var $form   = $('#add_lot'),
        origForm    = $form.serialize();
        $('#add_lot :input').on('change input', function() {
            if ($form.serialize() !== origForm) {
                window.onbeforeunload = function() {
                    if (!window.btn_clicked) { //was not clicked
                        return 'Changes you made not be saved!';
                    }
                };
            }
        });
    });

    var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];
    function ValidateSingleInput(oInput) {
        var sFileName   = oInput.files[0].name;
        var oct_in      = $("#oct_file").val();
        var tct_in      = $("#tct_file").val();
        if (oInput.type == "file") {
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() ==
                        sCurExtension.toLowerCase()) {
                        if (oct_in) {
                            $(".file-name-label-oct").show();
                            $("#rmsg-oct").hide();
                        } else {
                            $("#rmsg-tct").hide();
                            $(".file-name-label-tct").show();
                        }
                        blnValid = true;
                        break;
                    }
                }

                if (!blnValid) {
                    alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    oInput.value = "";
                    if (oct_in) {
                        $("#rmsg-oct").show();
                        $(".file-name-label-oct").hide();
                    } else {
                        $("#rmsg-tct").show();
                        $(".file-name-label-tct").hide();
                    }
                    return false;
                }
            }
        }
        return true;
    }
</script>
<style type="text/css">
    .file-name-label-oct {
        overflow: hidden;
        text-overflow: ellipsis;
        width: 128px;
        height: 14px;
        margin-top: 10px;
        display: block;
        float: left;
    }
    .file-name-label-tct {
        overflow: hidden;
        text-overflow: ellipsis;
        width: 128px;
        height: 14px;
        margin-top: 10px;
        display: block;
        float: left;
    }
</style>