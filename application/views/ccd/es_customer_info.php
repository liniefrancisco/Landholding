<?php if (validation_errors()) { ?>
  <div class="alert alert-danger alert-dismissible fade in" role="alert"
    style="position: fixed; bottom: 10px; right: 10px; z-index: 99; cursor: pointer;" id="saved">
    <?php echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' . validation_errors('<i class="fa fa-remove"></i> '); ?>
  </div>
<?php } ?>
<?php if ($this->session->flashdata('error')) { ?>
  <div class="alert alert-danger" role="alert"
    style="position: fixed; bottom: 10px;right: 10px;z-index: 99;cursor: pointer;border-radius: 4px;" id="saved">
    <button type="button" class="close" id="clearMsg"><span aria-hidden="true">&times;</span></button>
    <?php echo $this->session->flashdata('error'); ?>
  </div>
<?php } ?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="row row_container">

    <div class="col-md-12 col-sm-12 col-xs-12">
      <!-- FLASH DATAS =========================================================================================================================================== -->
      <?php if (($this->session->flashdata('notif') == 'You may now proceed!')) { ?>
        <div class="alert alert-info alert-dismissible fade in" role="alert" id="saved">
          <i class="glyphicon glyphicon-ok"></i>
          <?php echo $this->session->flashdata('notif'); ?>
        </div>
      <?php } ?>
      <!-- END FLASH DATAS =========================================================================================================================================== -->
      <!-- start content ======================================================================================================================================= -->
      <div class="x_panel animate fadeIn" style="box-shadow: 5px 8px 16px #888888">
        <div class="x_title">
          <h2><i class="fa fa-bank"></i> Aspayment</h2>
          <div class="title_right">
            <form action="<?= base_url('Aspayment/cancel_es_entry/' . $es_no); ?>"
              onsubmit="return confirm('Are you sure to cancel this Entry?');" method="POST">
              <input type="hidden" value="<?php echo $es_no; ?>" name="es_no">
              <h2><button type="submit" class="btn btn-warning escus_cancel" name="es_cancel"
                  style="background-color: #e65c00;"><i class="glyphicon glyphicon-floppy-remove"></i> Cancel</button>
              </h2>
            </form>
          </div>
          <div class="clearfix"></div>
        </div>

        <?php echo form_open_multipart('Ccd/aspayment/es_customer_info/' . $es_no, array('id' => 'add_custom')); //start form here ?>

        <div class="col-md-12 form_border">
          <div class="col-md-12 space" style="border-top: 2px solid #ff6600; border-bottom: 2px solid #ff6600;">
            <center>
              <h5 style="letter-spacing: 5px;">CUSTOMER BALANCE INFORMATION</h5>
            </center>
          </div>
          <div class="col-md-12 space">
            <div class="col-md-4"><label>Type:</label></div>
            <div class="col-md-4"><label class="r-contain"><input type="radio" value="Bounced Check" name="balance_type"
                  <?php if (@$_POST['balance_type'] == "Bounced Check") {
                    echo "checked";
                  } ?> required>Bounced Check <span
                  class="checkmark"></span></label></div>
            <div class="col-md-4"><label class="r-contain"><input type="radio" value="Bad Account" name="balance_type"
                  <?php if (@$_POST['balance_type'] == "Bad Account") {
                    echo "checked";
                  } ?> required>Bad Account <span
                  class="checkmark"></span></label></div>
          </div>
          <div class="col-md-12 space">
            <div class="col-md-3"><label>Business Unit:</label></div>
            <div class="col-md-4">
              <input type="text" name="business_unit"
                value="<?php if (isset($_POST['business_unit'])) {
                  echo $_POST['business_unit'];
                } ?>"
                class="form-control input_border" required>
            </div>
          </div>
          <div class="col-md-12 space">
            <div class="col-md-3"><label>Customer Name:</label></div>
            <div class="col-md-3">
              <input type="text" name="cfname" value="<?php if (isset($_POST['cfname'])) {
                echo $_POST['cfname'];
              } ?>"
                class="form-control input_border name_center" required>
              <h6 class="name_center"><i>Firstname</i></h6>
            </div>
            <div class="col-md-3">
              <input type="text" name="cmname" value="<?php if (isset($_POST['cmname'])) {
                echo $_POST['cmname'];
              } ?>"
                class="form-control input_border name_center" required>
              <h6 class="name_center"><i>Middlename</i></h6>
            </div>
            <div class="col-md-3">
              <input type="text" name="clname" value="<?php if (isset($_POST['clname'])) {
                echo $_POST['clname'];
              } ?>"
                class="form-control input_border name_center" required>
              <h6 class="name_center"><i>Lastname</i></h6>
            </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12 space">
            <div class="col-md-3 col-sm-3 col-xs-3"><label>Customer Address:</label></div>
            <div class="col-md-3 col-sm-3 col-xs-3">
              <select class="form-control input_border" id="cregion" name="cregion" style="text-align: center;"
                onchange="loadProvince()" required>
                <option value="">Select Region</option>
              </select>
              <h6 class="name_center"><i>Region</i></h6>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3">
              <select class="form-control input_border" id="cprovince" name="cprovince" style="text-align: center;"
                onchange="loadCity()" required>
                <option value="">Select Province</option>
              </select>
              <h6 class="name_center"><i>Province</i></h6>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3">
              <select class="form-control input_border" id="ctown" name="ctown" style="text-align: center;"
                onchange="loadBrgy()" required>
                <option value="">Select City</option>
              </select>
              <h6 class="name_center"><i>City/Municipality</i></h6>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3"></div>
            <div class="ccol-md-3 col-sm-3 col-xs-3">
              <select class="form-control input_border" id="cbarangay" name="cbarangay" style="text-align: center;"
                required>
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
          <div class="col-md-12 space">
            <div class="col-md-12"><label>Please upload the following documents:</label></div>
            <div class="col-md-3"></div>

            <div class="col-md-3">
              <center><label style="font-size: 11px;">Turnover of doubtful account form folder</label>
                <span class='label label-info file-name-label-da' id="file-name-da"></span>
                <label class="btn btn-default" for="da-acc">
                  <input type="file" name="doubtful_account" class="form-control" id="da-acc"
                    onchange="ValidateDa(this);$('#file-name-da').html(this.files[0].name)" style="display: none;">
                  <span class="fa fa-file-image-o"></span> Select File
                </label>
                <i style="color: red;" id="rmsg-da">*required</i>
              </center>
            </div>

            <div class="col-md-3">
              <center><label style="font-size: 11px;">Latest SOA Folder</label><br>
                <span class='label label-info file-name-label-ls' id="file-name-ls"></span>
                <label class="btn btn-default" for="la-soa">
                  <input type="file" name="latest_soa" class="form-control" id="la-soa"
                    onchange="ValidateSoa(this);$('#file-name-ls').html(this.files[0].name)" style="display: none;">
                  <span class="fa fa-file-image-o"></span> Select File
                </label>
                <i style="color: red;" id="rmsg-ls">*required</i>
              </center>
            </div>

            <div class="col-md-3">
              <center><label style="font-size: 11px;">Supporting Documents Folder</label>
                <span class='label label-info file-name-label-sd' id="file-name-sp"></span>
                <label class="btn btn-default" for="sup_docs">
                  <input type="file" name="supporting_docs" class="form-control" id="sup_docs"
                    onchange="ValidateSd(this);$('#file-name-sp').html(this.files[0].name)" style="display: none;">
                  <span class="fa fa-file-image-o"></span> Select File
                </label>
                <i style="color: red;" id="rmsg-sd">*required</i>
              </center>
            </div>
          </div>


        </div>
        <div style="float: right; margin-top: 10px">
          <a href="<?php echo base_url() ?>" class="btn btn-default">Cancel</a>
          <input type="submit" name="submit" class="btn btn-custom-primary send" value="Submit">
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
    border: 1px solid black;
  }

  th {
    text-align: center;
  }

  /*input[type=text]{
      text-transform: capitalize;
  }*/

  .autocomplete-items {
    margin-top: -30px;
  }

  .file-name-label-da {
    overflow: hidden;
    text-overflow: ellipsis;
    width: 150px;
    height: 14px;
    margin-bottom: 10px;
    display: block;
  }

  .file-name-label-ls {
    overflow: hidden;
    text-overflow: ellipsis;
    width: 150px;
    height: 14px;
    margin-bottom: 10px;
    display: block;

  }

  .file-name-label-sd {
    overflow: hidden;
    text-overflow: ellipsis;
    width: 150px;
    height: 14px;
    margin-bottom: 10px;
    display: block;

  }
</style>


<script type="text/javascript">

  document.addEventListener("DOMContentLoaded", function (event) {

    document.querySelector('.send').addEventListener("click", function () {
      window.btn_clicked = true;
    });

    var $form = $('#add_custom'),
      origForm = $form.serialize();

    $('#add_custom :input').on('change input', function () {

      if ($form.serialize() !== origForm) {

        window.onbeforeunload = function () {
          if (!window.btn_clicked) { //was not clicked
            return 'Changes you made not be saved!';
          }
        };

      }
    });

    $('#cbarangay').on('change', function () {
      console.log('barangay', $(this).val());
    });
  });


  var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];
  function ValidateDa(oInput) {
    var sFileName = oInput.files[0].name;

    if (oInput.type == "file") {
      if (sFileName.length > 0) {
        var blnValid = false;
        for (var j = 0; j < _validFileExtensions.length; j++) {
          var sCurExtension = _validFileExtensions[j];
          if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {

            $('.file-name-label-da').css('display', 'block');
            $("#rmsg-da").hide();

            blnValid = true;
            break;
          }
        }

        if (!blnValid) {
          alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
          oInput.value = "";

          $("#file-name-da").hide();
          $("#rmsg-da").show();

          return false;
        }
      }

    }
    return true;
  }

  function ValidateSoa(oInput) {
    var sFileName = oInput.files[0].name;
    if (oInput.type == "file") {
      if (sFileName.length > 0) {
        var blnValid = false;
        for (var j = 0; j < _validFileExtensions.length; j++) {
          var sCurExtension = _validFileExtensions[j];
          if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {

            $('.file-name-label-ls').css('display', 'block');
            $("#rmsg-ls").hide();

            blnValid = true;
            break;
          }
        }

        if (!blnValid) {
          alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
          oInput.value = "";

          $("#file-name-ls").hide();
          $("#rmsg-ls").show();

          return false;
        }
      }

    }
    return true;
  }

  function ValidateSd(oInput) {
    var sFileName = oInput.files[0].name;
    if (oInput.type == "file") {
      if (sFileName.length > 0) {
        var blnValid = false;
        for (var j = 0; j < _validFileExtensions.length; j++) {
          var sCurExtension = _validFileExtensions[j];
          if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {

            $('.file-name-label-sd').css('display', 'block');
            $("#rmsg-sd").hide();

            blnValid = true;
            break;
          }
        }

        if (!blnValid) {
          alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
          oInput.value = "";

          $("#file-name-sp").hide();
          $("#rmsg-sd").show();

          return false;
        }
      }

    }
    return true;
  }

  function loadRegion() {
    $.ajax({
        url: "<?php echo site_url("Registry/getregion") ?>",
        method: "POST",
        success: function(data) {
            var jObj = JSON.parse(data);
            //console.log(jObj);
            for (var c = 0; c < jObj.length; c++) {
                // console.log('region value',  jObj[c].regCode + '|' + jObj[c].regDesc )
                $('#cregion').append('<option value="' + jObj[c].regDesc + '" data-code="' + jObj[c]
                    .regCode + '">' +
                    jObj[c].regDesc + '</option>');

            }

        }
    });
}

loadRegion();

function loadProvince() {
    $("#cprovince").html("");
    $("#cprovince").append('<option value="">Select Province</option>');

    var seleted_op = $('#cregion').find('option:selected');
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
                $('#cprovince').append('<option value="' + data.provDesc + '" data-code="' + data
                    .provCode + '">' + data.provDesc +
                    '</option>');
            });
        }
    });
}

function loadCity() {
    $("#ctown").html("");
    $("#ctown").append('<option value="">Select City/Municipality</option>');
    var selected_op = $('#cprovince').find('option:selected');
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
                $('#ctown').append('<option value="' + data.citymunDesc + '" data-zipcode="' +
                    data.zipcode + '" data-code="' + data.citymunCode + '">' + data
                    .citymunDesc + '</option>');
            });
        }
    });
}

function loadBrgy() {

    $("#cbarangay").html("");
    $("#cbarangay").append('<option value="">Select Barangay</option>');

       var selected_town = $('#ctown').find('option:selected');
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
                $('#cbarangay').append('<option value="' + data
                    .brgyDesc + '" data-code="' + data.brgyCode + '">' + data.brgyDesc +
                    '</option>');
            });
        }
    });
}
</script>