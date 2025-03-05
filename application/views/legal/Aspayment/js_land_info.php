<?php if (validation_errors()) { ?>
        <div class="alert alert-danger alert-dismissible fade in" role="alert"
            style="position: fixed; bottom: 10px; right: 10px; z-index: 99; cursor: pointer;" id="saved">
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
            <div class="x_panel animate  fadeInLeft" style="box-shadow: 5px 8px 16px #888888">
                <div class="x_title">
                    <h2
                        style="word-spacing: 4px; letter-spacing: 1px; font-weight: bold; font-size: 14px;color: #2a3f54;">
                        <i class="fa fa-bank" style="font-size:16px;"></i> Settlement
                    </h2>
                    <div style="float:right">
                        <a href="#" onclick="window.history.back()" class="btn btn-sm btn-warning"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php $js_id = 0;
                if (empty($js_no)) {
                    $js_no = "JSO-0001";
                }
                foreach ($judicial as $key => $value) {
                        $js_id = substr($value['is_no'], 4) + 1;

                        if (strlen($js_id) == 1) {
                                $js_no = "JSO-000" . $js_id;
                        } elseif (strlen($js_id) == 2) {
                                $js_no = "JSO-00" . $js_id;
                        } elseif (strlen($js_id) == 3) {
                                $js_no = "JSO-0" . $js_id;
                        } else {
                                $js_no = "JSO-" . $js_id;
                        }
                } ?>

                <?php echo form_open_multipart('Legal_f/aspayment/judicial', array('id' => 'add_lot')); //start form here ?>
                <input type="hidden" value="OCT" name="oct_folder">
                <input type="hidden" value="TCT" name="tct_folder">
                <div class="col-md-12 form_border">
                    <center class="space">
                        <img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
                        <h4><b>LAND AS PAYMENT FORM - JUDICIAL SETTLEMENT (LAPF-JS)</b></h4>
                    </center>
                    <div class="col-md-12 col-sm-12 col-xs-12 space">
                        <div class="col-md-4 col-xs-4 col-sm-4 form-inline">
                            <label>LAPF-JS #:</label><input class="form-control input_border" type="text" name="js_no"
                                value="<?php echo $js_no; ?>" readonly>
                        </div>
                        <div class="col-md-4 col-sm-4  col-xs-4 form-inline pull-right">
                            <label>Date:</label><input class="form-control input_border" type="date" name="date"
                             id="date-in" value="<?= date('Y-m-d');?>" readonly>
                            <!-- <label>Date:</label><input class="form-control input_border" type="date" name="date"
                                placeholder="YYYY-MM-DD" id="date-in" onchange="myDateValidation(this)" required> -->
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 space"
                        style="border-top: 2px solid #ff6600; border-bottom: 2px solid #ff6600;">
                        <center>
                            <h5 style="letter-spacing: 10px;"><b>CUSTOMER BALANCE INFORMATION</b></h5>
                        </center>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 space">
                        <div class="col-md-4 col-sm-4 col-xs-4"><label>Case Type:</label></div>
                        <div class="col-md-4 col-sm-4 col-xs-4"><label class="r-contain">
                                <input type="radio" value="Small claim case" name="case_type"
                                    <?php echo set_radio('case_type', 'Small claim case', @$_POST['case_type'] == 'Small claim case'); ?>
                                    required>Small claim case <span class="checkmark"></span></label>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4"><label class="r-contain">
                                <input type="radio" value="Collection of Sum Money" name="case_type"
                                    <?php if (@$_POST['case_type'] == "Collection of Sum Money") {
                                            echo "checked";
                                    } ?>
                                    required>Collection of Sum Money <span class="checkmark"></span></label>
                        </div>
                    </div>


                    <div class="col-md-12 space">
                        <div class="col-md-3"><label>Business Unit:</label></div>
                        <div class="col-md-4"><input type="text" name="business_unit"
                                value="<?= set_value('business_unit'); ?>" class="form-control input_border" required>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 space">
                        <div class="col-md-3 col-sm-3 col-xs-3"><label>Customer Name:</label></div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <input type="text" name="cfname" value="<?= set_value('cfname'); ?>"
                                class="form-control input_border name_center" required>
                            <h6 class="name_center"><i>Firstname</i></h6>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <input type="text" name="cmname" value="<?= set_value('cmname'); ?>"
                                class="form-control input_border name_center" required>
                            <h6 class="name_center"><i>Middlename</i></h6>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <input type="text" name="clname" value="<?= set_value('clname'); ?>"
                                class="form-control input_border name_center" required>
                            <h6 class="name_center"><i>Lastname</i></h6>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 space">
                        <div class="col-md-3 col-sm-3 col-xs-3"><label>Customer Address:</label></div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select class="form-control input_border" id="cregion" name="cregion"
                                style="text-align: center;" onchange="loadProvince('cregion','cprovince')" required>
                                <option value="">Select Region</option>
                            </select>
                            <h6 class="name_center"><i>Region</i></h6>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select class="form-control input_border" id="cprovince" name="cprovince"
                                style="text-align: center;" onchange="loadCity('ctown','cprovince')" required>
                                <option value="">Select Province</option>
                            </select>
                            <h6 class="name_center"><i>Province</i></h6>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select class="form-control input_border" id="ctown" name="ctown"
                                style="text-align: center;" onchange="loadBrgy('cprovince','ctown','cbarangay')"
                                required>
                                <option value="">Select City</option>
                            </select>
                            <h6 class="name_center"><i>City/Municipality</i></h6>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3"></div>
                        <div class="ccol-md-3 col-sm-3 col-xs-3">
                            <select class="form-control input_border" id="cbarangay" name="cbarangay"
                                style="text-align: center;" required>
                                <option value="">Select Barangay</option>
                            </select>
                            <h6 class="name_center"><i>Barangay</i></h6>
                        </div>
                        <div class="ccol-md-3 col-sm-3 col-xs-3">
                            <input type="text" class="form-control input_border" name="cstreet" id="cstreet"
                                value="<?php echo set_value('cstreet') ?>" required>
                            <h6 class="name_center"><i>Street</i></h6>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 space"
                        style="border-top: 1px solid #ff6600; border-bottom: 1px solid #ff6600;">
                        <h5 style="letter-spacing: 2px;">ATTACHMENT</h5>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 space">
                        <div class="col-md-3 col-sm-3 col-xs-3 lot_type" style="height: 29px;"><label>Lot
                                Type:</label></div>
                        <div class="col-md-3 col-sm-3 col-xs-3 lot_type"><label class="r-contain">
                                <input type="radio" name="lot_type" value="Agricultural"
                                    <?php if (@$_POST['lot_type'] == "Agricultural") {
                                            echo "checked";
                                    } ?> required>
                                Agricultural <span class="checkmark"></span></label>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 lot_type"><label class="r-contain">
                                <input type="radio" name="lot_type" value="Commercial"
                                    <?php if (@$_POST['lot_type'] == "Commercial") {
                                            echo "checked";
                                    } ?> required>
                                Commercial <span class="checkmark"></span></label>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 lot_type"><label class="r-contain">
                                <input type="radio" name="lot_type" value="Residential"
                                    <?php if (@$_POST['lot_type'] == "Residential") {
                                            echo "checked";
                                    } ?> required>
                                Residential <span class="checkmark"></span></label>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 space">
                        <div class="col-md-3 col-sm-3 col-xs-3 form-inline"><label>Lot.</label>
                            <input type="text" name="lot"
                                value="<?php if (isset($_POST['lot'])) {
                                        echo $_POST['lot'];
                                } ?>"
                                class="form-control input_border" required>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 form-inline"><label>Cad.</label>
                            <input type="text" name="cad"
                                value="<?php if (isset($_POST['cad'])) {
                                        echo $_POST['cad'];
                                } ?>"
                                class="form-control input_border" required>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 space">
                        <div class="col-md-3 col-sm-3 col-xs-3"><label>Lot Owner:</div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <input type="text" name="ofname"
                                value="<?php if (isset($_POST['ofname'])) {
                                        echo $_POST['ofname'];
                                } ?>"
                                class="form-control input_border name_center" required>
                            <h6 class="name_center"><i>Firstname</i></h6>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <input type="text" name="omname"
                                value="<?php if (isset($_POST['omname'])) {
                                        echo $_POST['omname'];
                                } ?>"
                                class="form-control input_border name_center" required>
                            <h6 class="name_center"><i>Middlename</i></h6>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <input type="text" name="olname"
                                value="<?php if (isset($_POST['olname'])) {
                                        echo $_POST['olname'];
                                } ?>"
                                class="form-control input_border name_center" required>
                            <h6 class="name_center"><i>Lastname</i></h6>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 space">
                        <div class="col-md-4 col-sm-4 col-xs-4"><label>Owner Information:</label></div>
                        <div class="col-md-4 col-sm-4 col-xs-4"><label class="r-contain">
                                <input type="radio" name="vital_status" value="Alive"
                                    <?php if (@$_POST['vital_status'] == "Alive") {
                                            echo "checked";
                                    } ?> required> Alive
                                <span class="checkmark"></span></label>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4"><label class="r-contain">
                                <input type="radio" name="vital_status" value="Deceased"
                                    <?php if (@$_POST['vital_status'] == "Deceased") {
                                            echo "checked";
                                    } ?> required>
                                Deceased <span class="checkmark"></span></label>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 space">
                        <div class="col-md-3 col-sm-3 col-xs-3"><label>Lot Location:</div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select class="form-control input_border" id="oregion" name="oregion"
                                style="text-align: center;" onchange="loadProvince('oregion','oprovince')" required>
                                <option value="">Select Region</option>
                            </select>
                            <h6 class="name_center"><i>Region</i></h6>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select class="form-control input_border" id="oprovince" name="oprovince"
                                style="text-align: center;" onchange="loadCity('otown','oprovince')" required>
                                <option value="">Select Province</option>
                            </select>
                            <h6 class="name_center"><i>Province</i></h6>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select class="form-control input_border" id="otown" name="otown"
                                style="text-align: center;" onchange="loadBrgy('oprovince','otown','obarangay')"
                                required>
                                <option value="">Select City</option>
                            </select>
                            <h6 class="name_center"><i>City/Municipality</i></h6>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3"><label></div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <select class="form-control input_border" id="obarangay" name="obarangay"
                                style="text-align: center;" required>
                                <option value="">Select Barangay</option>
                            </select>
                            <h6 class="name_center"><i>Barangay</i></h6>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <input type="text" class="form-control input_border" name="ostreet" id="ostreet"
                                value="<?php echo set_value('ostreet') ?>" required>
                            <h6 class="name_center"><i>Street</i></h6>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                                          <input type="text" class="form-control input_border" name="ozipcode"
                                              id="ozipcode" value="<?php echo set_value('ozipcode') ?>" required readonly>
                                          <h6 class="name_center"><i>Zipcode</i></h6>
                                      </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 space">
                        <div class="col-md-4 col-sm-4 col-xs-4"><label>Lot for bidding:</label></div>
                        <div class="col-md-4 col-sm-4 col-xs-4"><label class="r-contain">
                                <input type="radio" name="lot_s" value="Portion"
                                    <?php if (@$_POST['lot_s'] == "Portion") {
                                            echo "checked";
                                    } ?> required> Portion
                                <span class="checkmark"></span></label>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4"><label class="r-contain">
                                <input type="radio" name="lot_s" value="Whole"
                                    <?php if (@$_POST['lot_s'] == "Whole") {
                                            echo "checked";
                                    } ?> required>
                                Whole <span class="checkmark"></span></label>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 space">
                        <div class="col-md-4 col-sm-4 col-xs-4 form-inline">
                            <label>Lot Size:</label> <input type="text"
                                value="<?php if (isset($_POST['lot_size'])) {
                                        echo $_POST['lot_size'];
                                } ?>"
                                name="lot_size" class="form-control input_border" id="lotsize"
                                required><label>sq/m</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 space">
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <label>Available Proof of Title/Ownership:</label>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <label class="r-contain"><input type="radio" name="available_proof" value="oct"
                                    <?php if (@$_POST['available_proof'] == "oct") {
                                            echo "checked";
                                    } ?>
                                    class="proof">Original Certificate of Title (OCT) <span
                                    class="checkmark"></span></label>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <label class="r-contain"><input type="radio" name="available_proof" value="tct"
                                    <?php if (@$_POST['available_proof'] == "tct") {
                                            echo "checked";
                                    } ?>
                                    class="proof">Transfer Certificate of Title (TCT) <span
                                    class="checkmark"></span></label>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 space">
                        <input type="hidden" name="oct_folder" value="OCT">
                        <div class="col-md-4 col-sm-4 col-xs-4">
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4" id="oct">
                            <!-- <input type="file" name="oct" value="" id="oct_file" class="form-control" <?php if (@$_POST['available_proof'] == "oct") {
                                    echo 'style="display: block;"';
                            } else {
                                    echo 'style="display: none;"';
                            } ?> onchange="ValidateSingleInput(this);" required> -->
                            <span class='label label-info file-name-label-oct' id="upload-oct"></span>
                            <label class="btn btn-default" for="oct_file" id="oct_button"
                                <?php if (@$_POST['available_proof'] == "oct") {
                                        echo '';
                                } else {
                                        echo 'style="display: none;"';
                                } ?>>
                                <input type="file" name="oct" class="form-control" id="oct_file"
                                    onchange="ValidateSingleInput(this);$('#upload-oct').html(this.files[0].name)"
                                    style="display: none;">
                                <span class="fa fa-file-image-o"></span> Select File
                            </label>
                            <i style="color: red; display: none;" id="rmsg-oct">*required</i>

                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4" id="tct">
                            <!-- <input type="file" name="tct" value="" id="tct_file" class="form-control" <?php if (@$_POST['available_proof'] == "tct") {
                                    echo 'style="display: block;"';
                            } else {
                                    echo 'style="display: none;"';
                            } ?> onchange="ValidateSingleInput(this);" required> -->

                            <span class='label label-info file-name-label-tct' id="upload-tct"></span>
                            <label class="btn btn-default" for="tct_file" id="tct_button"
                                <?php if (@$_POST['available_proof'] == "tct") {
                                        echo '';
                                } else {
                                        echo 'style="display: none;"';
                                } ?>>
                                <input type="file" name="tct" class="form-control" id="tct_file"
                                    onchange="ValidateSingleInput(this);$('#upload-tct').html(this.files[0].name)"
                                    style="display: none;">
                                <span class="fa fa-file-image-o"></span> Select File
                            </label>
                            <i style="color: red; display: none;" id="rmsg-tct">*required</i>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 space"
                        style="border-top: 1px solid #ff6600; border-bottom: 1px solid #ff6600;">
                        <h5>BIDDING DETAILS</h5>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 space">
                        <div class="col-md-4 col-sm-4 col-xs-4 form-inline"><label>Bid Price: ₱</label>
                            <input type="text" name="bid_price"
                                value="<?php if (isset($_POST['bid_price'])) {
                                        echo $_POST['bid_price'];
                                } ?>"
                                class="form-control input_border" id="bidding_price">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 form-inline"><label>Status:</label>
                            <input type="text" name="status"
                                value="<?php if (isset($_POST['status'])) {
                                        echo $_POST['status'];
                                } ?>"
                                class="form-control input_border"><label>Highest Bidder</label>
                        </div>
                    </div>
                </div>
                <div style="float: right; margin-top: 10px;">
                    <a href="<?= base_url() ?>" class="btn btn-default">Cancel</a>
                    <input type="submit" name="" class="btn btn-custom-primary send" value="Submit" >
                </div>
                </form>



            </div>
            <!-- end content  ======================================================================================================================================= -->
        </div>


    </div>
    <br />
</div>
<!-- /page content -->



<style type="text/css">
/*input[type=text]{
        text-transform: capitalize;
    }*/
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

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

<!-- DATEPICKER -->
<!-- <script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.js"></script> -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" /> -->

<!-- JQUERIES =========================================================================================================================================== -->


<script type="text/javascript">
function myDateValidation(uInput) {
    var datein = new Date($('#date-in').val());
    var d = new Date();

    if (d < datein) {
        alert('Please input a valid date!');
        uInput.value = "";
        return false;
    }
}


const default_date = `<?php if (isset($_POST['date'])) {
        echo $_POST['date'];
} ?>`;

document.addEventListener("DOMContentLoaded", function(event) {

    // $('#date-in').flatpickr({
    //     defaultDate: default_date
    // });

    //AVAILABLE PROOF OF TITLE/OWNERSHIP JQUERY
    $(".proof").click(function() {
        var a = $(this).attr("value");
        var oct_in = $("#oct_file").val();
        var tct_in = $("#tct_file").val();

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
    //AVAILABLE PROOF OF TITLE/OWNERSHIP JQUERY

    document.querySelector('.send').addEventListener("click", function() {
        window.btn_clicked = true;
    });

    // var $form = $('#add_lot'),
    //     origForm = $form.serialize();

    // $('#add_lot :input').on('change input', function() {

    //     if ($form.serialize() !== origForm) {
    
            window.onbeforeunload = function() {
                if (!window.btn_clicked) { //was not clicked
                    return 'Changes you made not be saved!';
                }
            
            };

    //     }
    // });

    $('#otown').on('change', function() {
        const selected_op = $('#otown').find('option:selected');
        $('#ozipcode').val(selected_op.data('zipcode'));
    });

});

var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];

function ValidateSingleInput(oInput) {

    var sFileName = oInput.files[0].name;
    var oct_in = $("#oct_file").val();
    var tct_in = $("#tct_file").val();
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
                alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(
                    ", "));
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

function loadRegion() {
    $.ajax({
        url: "<?php echo site_url("Legal_f/Registry/getregion") ?>",
        method: "POST",
        success: function(data) {
            var jObj = JSON.parse(data);
            //console.log(jObj);
            for (var c = 0; c < jObj.length; c++) {
                // console.log('region value',  jObj[c].regCode + '|' + jObj[c].regDesc )
                $('#cregion').append('<option value="' + jObj[c].regDesc + '" data-code="' + jObj[c]
                    .regCode + '">' +
                    jObj[c].regDesc + '</option>');
                $('#oregion').append('<option value="' + jObj[c].regDesc + '" data-code="' + jObj[c]
                    .regCode + '">' +
                    jObj[c].regDesc + '</option>');
            }

        }
    });
}

loadRegion();

function loadProvince(region, province) {
    $("#" + province).html("");
    $("#" + province).append('<option value="">Select Province</option>');

    var seleted_op = $('#'+region).find('option:selected');
     var regCode = seleted_op.data('code');

    $.ajax({
        url: "<?php echo site_url("Legal_f/Registry/getprovince") ?>",
        method: "POST",
        dataType: 'json',
        data: {
            regCode: regCode
        },
        success: function(data) {
            $.each(data, function(i, data) {
                // console.log('province  value',data.provCode + '|' + data.provDesc);
                $('#' + province).append('<option value="' + data.provDesc + '" data-code="' + data
                    .provCode + '">' + data.provDesc +
                    '</option>');
            });
        }
    });
}

function loadCity(town, province) {
    $("#" + town).html("");
    $("#" + town).append('<option value="">Select City/Municipality</option>');
    var selected_op = $('#'+province).find('option:selected');
    var provCode = selected_op.data('code');

    $.ajax({
        url: "<?php echo site_url("Legal_f/Registry/getcitymun") ?>",
        method: "POST",
        dataType: 'json',
        data: {
            provCode: provCode
        },
        success: function(data) {
            $.each(data, function(i, data) {
                // console.log('city value',data.citymunCode + '|' + data
                //       .citymunDesc);
                $('#' + town).append('<option value="' + data.citymunDesc + '" data-zipcode="' +
                    data.zipcode + '" data-code="' + data.citymunCode + '">' + data
                    .citymunDesc + '</option>');
            });
        }
    });
}

function loadBrgy(province, town, barangay) {

    $("#" + barangay).html("");
    $("#" + barangay).append('<option value="">Select Barangay</option>');

       var selected_town = $('#'+town).find('option:selected');
       var citymunCode = selected_town.data('code');

    var dist = "";
    var dist1 = [
        "ALBURQUERQUE",
        "ANTEQUERA",
        "BACLAYON",
        "BALILIHAN",
        "CALAPE",
        "CATIGBIAN",
        "CORELLA",
        "CORTES",
        "DAUIS",
        "LOON",
        "MARIBOJOC",
        "PANGLAO",
        "SIKATUNA",
        "TAGBILARAN CITY",
        "TUBIGON"
    ];

    var dist2 = [
        "BIEN UNIDO",
        "BUENAVISTA",
        "CLARIN",
        "DAGOHOY",
        "DANAO",
        "GETAFE",
        "INABANGA",
        "PRES. CARLOS P. GARCIA",
        "SAGBAYAN",
        "SAN ISIDRO",
        "SAN MIGUEL",
        "TALIBON",
        "TRINIDAD",
        "UBAY"
    ];

    var dist3 = [
        "ALICIA",
        "ANDA",
        "BATUAN",
        "BILAR",
        "CANDIJAY",
        "CARMEN",
        "DIMIAO",
        "DUERO",
        "GARCIA HERNANDEZ",
        "GUINDULMAN",
        "JAGNA",
        "LILA",
        "LOAY",
        "LOBOC",
        "MABINI",
        "PILAR",
        "SEVILLA",
        "SIERRA BULLONES",
        "VALENCIA"
    ];

    // if (provDesc == 'BOHOL') {
    //     if (dist1.includes(citymunDesc)) {
    //         $("#district").val("District 1");
    //     } else if (dist2.includes(citymunDesc)) {
    //         $("#district").val("District 2");
    //     } else if (dist3.includes(citymunDesc)) {
    //         $("#district").val("District 3");
    //     }
    // }

    $.ajax({
        url: "<?php echo site_url("Legal_f/Registry/getbrgy") ?>",
        method: "POST",
        dataType: 'json',
        data: {
            citymunCode: citymunCode
        },
        success: function(data) {
            $.each(data, function(i, data) {
                // console.log('barangay value',data.brgyCode + '|' + data
                //       .brgyDesc);
                $('#' + barangay).append('<option value="' + data
                    .brgyDesc + '" data-code="' + data.brgyCode + '">' + data.brgyDesc +
                    '</option>');
            });
        }
    });
}

</script>