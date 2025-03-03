<?php if(validation_errors()){ ?>
              <div class="alert alert-danger alert-dismissible fade in" role="alert"
                  style="position: fixed; bottom: 10px; right: 10px; z-index: 99; cursor: pointer;" id="saved">
                  <?php echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'. validation_errors('<i class="fa fa-remove"></i> '); ?>
              </div>
              <?php } ?>
              <!-- page content -->
              <div class="right_col" role="main">
                  <div class="row row_container">

                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <!-- FLASH DATAS =========================================================================================================================================== -->
                          <?php if($this->session->flashdata('notif')){?>
                          <div class="alert alert-success alert-dismissible fade in" role="alert" id="saved">
                              <i class="glyphicon glyphicon-ok"></i> <?php echo $this->session->flashdata('notif'); ?>
                          </div>
                          <?php } ?>
                          <?php if($this->session->flashdata('error')){?>
                          <div class="alert alert-danger alert-dismissible fade in" role="alert" id="saved">
                              <i class="fa fa-warning"></i> <?php echo $this->session->flashdata('error'); ?>
                          </div>
                          <?php } ?>
                          <!-- END FLASH DATAS =========================================================================================================================================== -->
                          <!-- start content ======================================================================================================================================= -->
                          <div class="x_panel animate  fadeInLeft" style="box-shadow: 5px 8px 16px #888888">
                              <div class="x_title">
                                  <h2
                                      style="word-spacing: 4px; letter-spacing: 1px; font-weight: bold; font-size: 14px;color: #2a3f54;">
                                      <i class="fa fa-bank" style="font-size:16px;"></i> Aspayment</h2>
                                  <div style="float:right;color: #2a3f54;"><b>
                                          <p style="font-size: 13px;font-family: sans-serif;padding-bottom: 3px;letter-spacing: 1px;"
                                              id="da"></p>
                                          <p style="font-size: 13px;font-family: sans-serif;margin-top: -19px;letter-spacing: 1px;"
                                              id="ti"></p>
                                      </b></div>
                                  <div class="clearfix"></div>
                              </div>
                              <?php $es_id= 0;
                                  if(empty($es_no)){
                                    $es_no = "ES-0001";
                                  }
                                  foreach ($extra as $key => $value) {
                                  $es_id = substr($value['is_no'],4)+1; 

                                  if(strlen($es_id) == 1){
                                    $es_no = "ES-000".$es_id;
                                  }elseif(strlen($es_id) == 2){
                                    $es_no = "ES-00".$es_id;
                                  }elseif(strlen($es_id) == 3){
                                    $es_no = "ES-0".$es_id;
                                  }else{
                                    $es_no = "ES-".$es_id;
                                  }      
                            } ?>

                              <?php echo form_open_multipart('Ccd/aspayment/extrajudicial', array('id' => 'add_lot')); //start form here ?>
                              <input type="hidden" value="OCT" name="oct_folder">
                              <input type="hidden" value="TCT" name="tct_folder">
                              <div class="col-md-12 form_border">
                                  <center class="space">
                                      <img src="<?= base_url('assets/logo/AGC.jpg') ?>" width="200px" height="50px">
                                      <h4><b>LAND AS PAYMENT FORM - EXTRAJUDICIAL SETTLEMENT (LAPF-ES)</b></h4>
                                  </center>
                                  <div class="col-md-12 col-sm-12 col-xs-12 space">
                                      <div class="col-md-4 col-sm-4 col-xs-4 form-inline">
                                          <label>LAPF-ES #:</label><input class="form-control input_border" type="text"
                                              name="es_no" value="<?php echo $es_no; ?>" readonly>
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-4 form-inline pull-right">
                                          <label>Date:</label><input class="form-control input_border" type="date"
                                              name="date" id="date-in"  value="<?=date('Y-m-d');?>" readonly>
                                          <!-- <label>Date:</label><input class="form-control input_border" type="date"
                                              placeholder="YYYY-MM-DD" name="date" id="date-in"
                                              onchange="myDateValidation(this)" required> -->
                                      </div>
                                  </div>

                                  <div class="col-md-12 col-sm-12 col-xs-12 space"
                                      style="border-top: 2px solid #ff6600; border-bottom: 2px solid #ff6600;">
                                      <center>
                                          <h5><b style="letter-spacing: 10px;">LAND INFORMATION</b></h5>
                                      </center>
                                  </div>

                                  <div class="col-md-12 col-sm-12 col-xs-12 space">
                                      <div class="col-md-3 col-sm-3 col-xs-3 lot_type" style="height: 29px;"><label>Lot
                                              Type:</label></div>
                                      <div class="col-md-3 col-sm-3 col-xs-3 lot_type"><label class="r-contain">
                                              <input type="radio" name="lot_type" value="Agricultural"
                                                  <?php if(@$_POST['lot_type'] == "Agricultural"){ echo "checked"; } ?>
                                                  required> Agricultural <span class="checkmark"></span></label>
                                      </div>
                                      <div class="col-md-3 col-sm-3 col-xs-3 lot_type"><label class="r-contain">
                                              <input type="radio" name="lot_type" value="Commercial"
                                                  <?php if(@$_POST['lot_type'] == "Commercial"){ echo "checked"; } ?>
                                                  required> Commercial <span class="checkmark"></span></label>
                                      </div>
                                      <div class="col-md-3 col-sm-3 col-xs-3 lot_type"><label class="r-contain">
                                              <input type="radio" name="lot_type" value="Residential"
                                                  <?php if(@$_POST['lot_type'] == "Residential"){ echo "checked"; } ?>
                                                  required> Residential <span class="checkmark"></span></label>
                                      </div>
                                  </div>

                                  <div class="col-md-12 col-sm-12 col-xs-12 space">
                                      <div class="col-md-3 col-sm-3 col-xs-3 form-inline"><label>Lot.</label>
                                          <input type="text" name="lot"
                                              value="<?php if(isset($_POST['lot'])){ echo $_POST['lot']; } ?>"
                                              class="form-control input_border" required>
                                      </div>
                                      <div class="col-md-3 col-sm-3 col-xs-3 form-inline"><label>Cad.</label>
                                          <input type="text" name="cad"
                                              value="<?php if(isset($_POST['cad'])){ echo $_POST['cad']; } ?>"
                                              class="form-control input_border" required>
                                      </div>
                                  </div>

                                  <div class="col-md-12 col-sm-12 col-xs-12 space">
                                      <div class="col-md-3 col-sm-3 col-xs-3"><label>Lot Owner:</div>
                                      <div class="col-md-3 col-sm-3 col-xs-3">
                                          <input type="text" name="ofname"
                                              value="<?php if(isset($_POST['ofname'])){ echo $_POST['ofname']; } ?>"
                                              class="form-control input_border name_center" required>
                                          <h6 class="name_center"><i>Firstname</i></h6>
                                      </div>
                                      <div class="col-md-3 col-sm-3 col-xs-3">
                                          <input type="text" name="omname"
                                              value="<?php if(isset($_POST['omname'])){ echo $_POST['omname']; } ?>"
                                              class="form-control input_border name_center" required>
                                          <h6 class="name_center"><i>Middlename</i></h6>
                                      </div>
                                      <div class="col-md-3 col-sm-3 col-xs-3">
                                          <input type="text" name="olname"
                                              value="<?php if(isset($_POST['olname'])){ echo $_POST['olname']; } ?>"
                                              class="form-control input_border name_center" required>
                                          <h6 class="name_center"><i>Lastname</i></h6>
                                      </div>
                                  </div>

                                  <div class="col-md-12 col-sm-12 col-xs-12 space">
                                      <div class="col-md-4 col-sm-4 col-xs-4"><label>Owner Information:</label></div>
                                      <div class="col-md-4 col-sm-4 col-xs-4"><label class="r-contain">
                                              <input type="radio" name="vital_status" value="Alive"
                                                  <?php if(@$_POST['vital_status'] == "Alive"){ echo "checked"; } ?>
                                                  required> Alive <span class="checkmark"></span></label>
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-4"><label class="r-contain">
                                              <input type="radio" name="vital_status" value="Deceased"
                                                  <?php if(@$_POST['vital_status'] == "Deceased"){ echo "checked"; } ?>
                                                  required> Deceased <span class="checkmark"></span></label>
                                      </div>
                                  </div>

                                  <div class="col-md-12 col-sm-12 col-xs-12 space">
                                      <div class="col-md-3 col-sm-3 col-xs-3"><label>Lot Location:</div>
                                      <div class="col-md-3 col-sm-3 col-xs-3">
                                          <select class="form-control input_border" id="oregion" name="oregion"
                                              style="text-align: center;" onchange="loadProvince()" required>
                                              <option value="">Select Region</option>
                                          </select>
                                          <h6 class="name_center"><i>Region</i></h6>
                                      </div>
                                      <div class="col-md-3 col-sm-3 col-xs-3">
                                          <select class="form-control input_border" id="oprovince" name="oprovince"
                                              style="text-align: center;" onchange="loadCity()" required>
                                              <option value="">Select Province</option>
                                          </select>
                                          <h6 class="name_center"><i>Province</i></h6>
                                      </div>
                                      <div class="col-md-3 col-sm-3 col-xs-3">
                                          <select class="form-control input_border" id="otown" name="otown"
                                              style="text-align: center;" onchange="loadBrgy()" required>
                                              <option value="">Select City</option>
                                          </select>
                                          <h6 class="name_center"><i>City/Municipality</i></h6>
                                      </div>
                                      <div class="col-md-3 col-sm-3 col-xs-3"></div>
                                      <div class="ccol-md-3 col-sm-3 col-xs-3">
                                          <select class="form-control input_border" id="obarangay" name="obarangay"
                                              style="text-align: center;" required>
                                              <option value="">Select Barangay</option>
                                          </select>
                                          <h6 class="name_center"><i>Barangay</i></h6>
                                      </div>
                                      <div class="ccol-md-3 col-sm-3 col-xs-3">
                                          <input type="text" class="form-control input_border" name="ostreet" id="ostreet"
                                              value="<?php echo set_value('street') ?>" required>
                                          <h6 class="name_center"><i>Street</i></h6>
                                      </div>
                                      <div class="ccol-md-3 col-sm-3 col-xs-3">
                                          <input type="text" class="form-control input_border" name="ozipcode"
                                              id="ozipcode" value="<?php echo set_value('zipcode') ?>" required>
                                          <h6 class="name_center"><i>Zipcode</i></h6>
                                      </div>
                                  </div>

                                  <div class="col-md-12 col-sm-12 col-xs-12 space">
                                      <div class="col-md-4 col-sm-4 col-xs-4"><label>Lot for payment:</label></div>
                                      <div class="col-md-4 col-sm-4 col-xs-4"><label class="r-contain">
                                              <input type="radio" name="lot_s" value="Portion"
                                                  <?php if(@$_POST['lot_s'] == "Portion"){ echo "checked"; } ?>
                                                  required> Portion <span class="checkmark"></span></label>
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-4"><label class="r-contain">
                                              <input type="radio" name="lot_s" value="Whole"
                                                  <?php if(@$_POST['lot_s'] == "Whole"){ echo "checked"; } ?> required>
                                              Whole <span class="checkmark"></span></label>
                                      </div>
                                  </div>

                                  <div class="col-md-12 col-sm-12 col-xs-12 space">
                                      <div class="col-md-4 col-sm-4 col-xs-4 form-inline">
                                          <label>Lot Size:</label> <input type="text"
                                              value="<?php if(isset($_POST['lot_size'])){ echo $_POST['lot_size']; } ?>"
                                              name="lot_size" class="form-control input_border" id="lotsize"
                                              required><label>sq/m</label>
                                      </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12 col-xs-12 space">
                                      <div class="col-md-4 col-sm-4 col-xs-4">
                                          <label>Available Proof of Title/Ownership:</label>
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-4">
                                          <label class="r-contain"><input type="radio" name="proof_title" value="oct"
                                                  class="proof"
                                                  required> Original Certificate of Title (OCT) <span
                                                  class="checkmark"></span></label>
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-4">
                                          <label class="r-contain"><input type="radio" name="proof_title" value="tct"
                                                  class="proof"
                                                  required> Transfer Certificate of Title (TCT) <span
                                                  class="checkmark"></span></label>
                                      </div>
                                  </div>

                                  <div class="col-md-12 col-sm-12 col-xs-12 space">
                                      <div class="col-md-4 col-sm-4 col-xs-4">
                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-4" id="oct">
                                          <!-- <input type="file" name="oct" value="" id="oct_file" class="form-control" <?php if(@$_POST['proof_title'] == "oct"){ echo 'style="display: block;"'; }else{ echo 'style="display: none;"'; } ?> onchange="ValidateSingleInput(this);" required> -->

                                          <span class='label label-info file-name-label-oct' id="upload-oct"></span>
                                          <label class="btn btn-default" for="oct_file" id="oct_button"
                                              <?php if(@$_POST['available_proof'] == "oct"){ echo ''; }else{ echo 'style="display: none;"'; } ?>>
                                              <input type="file" name="oct" class="form-control" id="oct_file"
                                                  onchange="ValidateSingleInput(this);$('#upload-oct').html(this.files[0].name)"
                                                  style="display: none;">
                                              <span class="fa fa-file-image-o"></span> Select File
                                          </label>
                                          <i style="color: red; display: none;" id="rmsg-oct">*required</i>

                                      </div>
                                      <div class="col-md-4 col-sm-4 col-xs-4" id="tct">
                                          <!-- <input type="file" name="tct" value="" id="tct_file" class="form-control" <?php if(@$_POST['proof_title'] == "tct"){ echo 'style="display: block;"'; }else{ echo 'style="display: none;"'; } ?> onchange="ValidateSingleInput(this);" required> -->

                                          <span class='label label-info file-name-label-tct' id="upload-tct"></span>
                                          <label class="btn btn-default" for="tct_file" id="tct_button"
                                              <?php if(@$_POST['available_proof'] == "tct"){ echo ''; }else{ echo 'style="display: none;"'; } ?>>
                                              <input type="file" name="tct" class="form-control" id="tct_file"
                                                  onchange="ValidateSingleInput(this);$('#upload-tct').html(this.files[0].name)"
                                                  style="display: none;">
                                              <span class="fa fa-file-image-o"></span> Select File
                                          </label>
                                          <i style="color: red; display: none;" id="rmsg-tct">*required</i>

                                      </div>
                                  </div>

                                  <div class="col-md-12 col-sm-12 col-xs-12 space">
                                      <label>Land Value:</label>
                                      <center>
                                          <table class="table">
                                              <tr>
                                                  <th>BASIS</th>
                                                  <th>AMOUNT</th>
                                              </tr>
                                              <tr>
                                                  <td>MV from Latest Tax Declaration</td>
                                                  <td class="form-inline">₱ <input type="text" name="mv_tax"
                                                          value="<?php if(isset($_POST['mv_tax'])){ echo $_POST['mv_tax']; } ?>"
                                                          class="form-control" id="mv_ltd" required></td>
                                              </tr>
                                              <tr>
                                                  <td>Neighboring Inquiry</td>
                                                  <td class="form-inline">₱ <input type="text" name="neighbor_inq"
                                                          value="<?php if(isset($_POST['neighbor_inq'])){ echo $_POST['neighbor_inq']; } ?>"
                                                          class="form-control" id="neigh_inq" required></td>
                                              </tr>
                                              <tr>
                                                  <td>Assessor</td>
                                                  <td class="form-inline">₱ <input type="text" name="assessor"
                                                          value="<?php if(isset($_POST['assessor'])){ echo $_POST['assessor']; } ?>"
                                                          class="form-control" id="assessor" required></td>
                                              </tr>
                                              <tr>
                                                  <td>Banks</td>
                                                  <td class="form-inline">₱ <input type="text" name="banks"
                                                          value="<?php if(isset($_POST['banks'])){ echo $_POST['banks']; } ?>"
                                                          class="form-control" id="banks" required></td>
                                              </tr>
                                              <tr>
                                                  <td></td>
                                                  <td></td>
                                              </tr>
                                              <tr>
                                                  <td>Final Land Value</td>
                                                  <td class="form-inline">₱ <input type="text" name="final_value"
                                                          value="<?php if(isset($_POST['final_value'])){ echo $_POST['final_value']; } ?>"
                                                          class="form-control" id="final_val" required></td>
                                              </tr>
                                          </table>
                                      </center>
                                  </div>


                              </div>
                              <div style="float: right; margin-top: 10px; ">
                                  <a href="<?php echo base_url('') ?>" class="btn btn-default">Cancel</a>
                                  <input type="submit" name="" class="btn btn-custom-primary send" value="Proceed">
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
table {
    border-collapse: collapse;
}

table,
td,
th {
    border: 1px solid gray;
}

th {
    text-align: center;
}

.autocomplete-items {
    margin-top: -30px;
}

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



              <script type="text/javascript">
const default_date = `<?php if(isset($_POST['date'])){ echo $_POST['date']; } ?>`;

function myDateValidation(uInput) {
    var datein = new Date($('#date-in').val());
    var d = new Date();

    if (d < datein) {
        alert('Please input a valid date!');
        uInput.value = "";
        return false;
    }
}
document.addEventListener("DOMContentLoaded", function(event) {

    // $('#date-in').flatpickr({
    //     dateFormat: 'Y-m-d',
    //     defaultDate: default_date
    // });

    $('#ozipcode').on('keydown', function(event) {
        if ($(this).val().length >= 4 && event.key !== 'Backspace') {
            event.preventDefault();
        }
        if (/^[a-zA-Z]$/.test(event.key)) {
            event.preventDefault();
        }
        if (/^[!@#$%^&*()\-_=+[\]{};':."\\|,<>/?`~]$/.test(event.key)) {
            event.preventDefault();
        }
        if (/\s/.test(event.key)) {
            event.preventDefault();
        }
    });

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

    var $form = $('#add_lot'),
        origForm = $form.serialize();

    $('#add_lot :input').on('change input', function() {

        if ($form.serialize() !== origForm) {

            window.onbeforeunload = function() {
                if (!window.btn_clicked) { //was not clicked
                    return 'Changes you made not be saved!';
                }
            };

        }
    });

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
        url: "<?php echo site_url("Ccd/Registry/getregion") ?>",
        method: "POST",
        success: function(data) {
            var jObj = JSON.parse(data);
            //console.log(jObj);
            for (var c = 0; c < jObj.length; c++) {
                // console.log('region value',  jObj[c].regCode + '|' + jObj[c].regDesc )
                $('#oregion').append('<option value="' + jObj[c].regDesc + '" data-code="' + jObj[c]
                    .regCode + '">' +
                    jObj[c].regDesc + '</option>');

            }

        }
    });
}

loadRegion();

function loadProvince() {
    $("#oprovince").html("");
    $("#oprovince").append('<option value="">Select Province</option>');

    var seleted_op = $('#oregion').find('option:selected');
     var regCode = seleted_op.data('code');

    $.ajax({
        url: "<?php echo site_url("Ccd/Registry/getprovince") ?>",
        method: "POST",
        dataType: 'json',
        data: {
            regCode: regCode
        },
        success: function(data) {
            $.each(data, function(i, data) {
                // console.log('province  value',data.provCode + '|' + data.provDesc);
                $('#oprovince').append('<option value="' + data.provDesc + '" data-code="' + data
                    .provCode + '">' + data.provDesc +
                    '</option>');
            });
        }
    });
}

function loadCity() {
    $("#otown").html("");
    $("#otown").append('<option value="">Select City/Municipality</option>');
    var selected_op = $('#oprovince').find('option:selected');
    var provCode = selected_op.data('code');

    $.ajax({
        url: "<?php echo site_url("Ccd/Registry/getcitymun") ?>",
        method: "POST",
        dataType: 'json',
        data: {
            provCode: provCode
        },
        success: function(data) {
            $.each(data, function(i, data) {
                // console.log('city value',data.citymunCode + '|' + data
                //       .citymunDesc);
                $('#otown').append('<option value="' + data.citymunDesc + '" data-zipcode="' +
                    data.zipcode + '" data-code="' + data.citymunCode + '">' + data
                    .citymunDesc + '</option>');
            });
        }
    });
}

function loadBrgy() {

    $("#obarangay").html("");
    $("#obarangay").append('<option value="">Select Barangay</option>');

       var selected_town = $('#otown').find('option:selected');
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
        url: "<?php echo site_url("Ccd/Registry/getbrgy") ?>",
        method: "POST",
        dataType: 'json',
        data: {
            citymunCode: citymunCode
        },
        success: function(data) {
            $.each(data, function(i, data) {
                // console.log('barangay value',data.brgyCode + '|' + data
                //       .brgyDesc);
                $('#obarangay').append('<option value="' + data
                    .brgyDesc + '" data-code="' + data.brgyCode + '">' + data.brgyDesc +
                    '</option>');
            });
        }
    });
}
              </script>