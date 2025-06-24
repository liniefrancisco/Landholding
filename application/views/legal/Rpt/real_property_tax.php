<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
    <div class="row row_container">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <!--====================FLASH DATA====================-->
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible fade in" role="alert" id="saved">
                    <i class="glyphicon glyphicon-ok"></i> <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php } ?>
            <!--====================START CONTENT====================-->
            <div class="x_panel animate rotateInDownLeft" style="border:1px; !important;box-shadow: 7px 6px 16px #888888;">
                <div class="x_title">
                    <h4 class="fa fa-Upload"> <b>Upload RPT <u style="color:#eb5d0c"> <?php if ($oi['is_no']) { echo $oi['is_no']; } ?></u></b></h4>
                    <a href="#" onclick="window.history.back()" class="btn btn-sm btn-warning pull-right"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
                    <div class="clearfix"></div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12 first_panel">
                    <?php if(!$ud['land_sketch'] == null){ ?>      
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Land Sketch/'.$ud['land_sketch'].'') ?>" width="150px" height="120px" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19); border: 2px solid #4CAF50;">                                 
                        </div>
                    <?php }else{ ?>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <img src="<?= base_url('assets/logo/no_file.png') ?>" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19); border: 2px solid #ff6600; max-width: 150px; max-height: 150px;" class="image-responsive">
                        </div>
                    <?php } ?>
                    <div class="col-md-9 col-sm-9 col-xs-9"><label class="col-md-4 small">Lot. <b style="float: right;">:</b></label>  
                        <i class="small"> <?php if($li['lot']){ echo $li['lot']; }else{ echo "None"; } ?></i>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9"><label class="col-md-4 small">Cad. <b style="float: right;">:</b></label>   
                        <i class="small"> <?php if($li['cad']){ echo $li['cad']; }else{ echo "None"; } ?></i>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9"><label class="col-md-4 small">Land Title No. <b style="float: right;">:</b></label> 
                        <i class="small"> <?php if($li['land_title_no']){ echo $li['land_title_no']; }else{ echo "None";} ?></i>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9"><label class="col-md-4 small">Tax Declaration No. <b style="float: right;">:</b></label> 
                        <i class="small"> <?php if($li['tax_dec_no']){ echo $li['tax_dec_no']; }else{ echo "None"; } ?></i>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9"><label class="col-md-4 small">Lot Owner <b style="float: right;">:</b></label> 
                        <i class="small"> <?php echo ucfirst($oi['firstname']) ?> <?php echo ucfirst($oi['lastname']) ?></i>
                    </div>

                    <div class="col-md-9 col-sm-9 col-xs-9"><label class="col-md-4 small">Lot Location <b style="float: right;">:</b></label>
                        <i class="small"> <?php echo ucfirst($ll['street']) ?>- <?php echo ucfirst($ll['baranggay']) ?>, <?php echo ucfirst($ll['municipality']) ?>, <?php echo ucfirst($ll['province']) ?></i>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12"> 
                        <div class="col-md-2 col-sm-2 col-xs-2"><center><label><b style="color: #ff6600;">LAND SKETCH</b></label></center></div>
                    </div>
                </div>

                <?php 
                    $query  = $this->db->get_where('assessments', array('is_no' => $li['is_no']));
                    $count  = $query->num_rows();

                    if($count == 0){
                ?>
                    <div class="col-md-12 text-center space" id="set">
                        <button class="btn btn-primary" 
                                onclick="new PNotify({
                                    title: 'Please be guided',
                                    text: 'Enter only single or double digits for the percentage of assessment level',
                                    type: 'warning',
                                    styling: 'bootstrap3'
                                }); launch_set_up();">Tax Payment Schedule
                        </button>
                    </div>
                    <!--====================ASSESSMENT LEVEL MODAL====================-->
                    <div class="col-md-12 animate rotateInDownLeft space" style="display: none;" id="set_up">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 col-xs-6 col-sm-6" style="box-shadow: 7px 6px 16px #888888;">
                            <div class="x_title">
                                <h6 class="fa fa-edit"> <b>Tax Payment Schedule</b></h6>
                                <div class="clearfix"></div>
                            </div>
                            <?php echo form_open('Rpt/submit_RPT/' . $li['is_no']); ?>  
                                <div class="x_panel" style="border-radius:9px;">
                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                        <label class="col-md-4"><small>TaxDec Effectivity of Assessment</small><code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-calendar-o"></i></div>
                                            <input class="form-control" type="text" name="effective_year" id="effective_year" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                        <label class="col-md-4"><small>Assessment Level</small><code>*</code></label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-percent"></i></div>
                                            <input class="form-control" type="text" step="1" name="ass_lvl" id="ass_lvl" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-xs btn-primary pull-right" name="submit_assmnt_lvl"  value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--====================END ASSESSMENT LEVEL MODAL====================-->
                <?php }else{ ?>
                    <div class="col-md-12">
                        <!--====================FLASH DATA====================-->
                        <div class="col-md-12">
                            <div class="col-md-2"></div>
                            <div class="col-md-7">
                                <?php if (($this->session->flashdata('notif') == 'The year you have selected has been already paid!')) { ?>
                                    <div class="alert alert-warning alert-dismissible fade in" role="alert" id="saved">
                                        <i class="glyphicon glyphicon-remove"></i>
                                        <?php echo $this->session->flashdata('notif'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!--====================REAL PROPERTY TAX MODAL====================-->
                        <div class="col-md-1"></div>
                        <div class="col-md-7" style="box-shadow: -3px 0px 16px #888888;">
                            <div class="x_title space">
                                <h4 class="fa fa-area-chart"> <b>Real Property Tax</b></h4>
                                <button class="btn btn-warning btn-xs pull-right" data-toggle="modal" data-target=".edit-ass-lvl-old"><i class="glyphicon glyphicon-pencil"></i></button>
                                <div class="clearfix"></div>
                            </div>
                            <?php echo form_open_multipart('Rpt/submit_RPT/'.$li['is_no']);?>
                                <div class="x_panel" style="border-radius:9px;">
                                    <div class="col-md-6 col-sm-6 col-xs-6 form-inline">
                                        <label class="col-md-4"><b class="pull-right">:</b><small>TaxDec Effectivity</small></label>
                                        <div class="input-group col-md-8">
                                            <div class="input-group-addon"><i class="fa fa-calendar-o"></i></div>
                                            <input type="text" class="form-control" name="effective_year" id="effective_year1" value="<?php echo $asmnts_row['Effective_year']; ?>" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 form-inline">
                                        <label class="col-md-4"><b class="pull-right">:</b><small>Year Paid</small></label>
                                        <div class="input-group col-md-8">
                                            <input type="date" class="form-control" name="year_paid" id="year_paid" onchange="validate_choosen_date_old();" required/>
                                        </div>
                                    </div>
                                    <?php
                                        if (ucfirst($ll['province']) == "Manila") {
                                            $per            = $asmnts_row['Assessment_Level'] * 0.01;
                                            $assessed_value = $li['total_price'] * $per;
                                            $rpt            = $assessed_value * .02;
                                        } else {
                                            $per            = $asmnts_row['Assessment_Level'] * 0.01;
                                            $assessed_value = $li['total_price'] * $per;
                                            $rpt            = $assessed_value * .01;
                                        }
                                    ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-2"><b class="pull-right">:</b><small>Amount</small></label>
                                        <div class="input-group">
                                            <div class="input-group-addon">₱</div>
                                            <input type="text" class="form-control" min="0" name="amount" value="<?php echo number_format($rpt, 2) ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-3"><small>Attach File</small></label>
                                        <input type="file" class="dropify" name="file" data-height="150" data-max-file-size="10M" accept=".jpg, .jpeg, .png, .pdf" onchange="previewFile(this);" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-md btn-success pull-right" name="submit_rpt">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!--====================UPLOADED YEARS MODAL====================-->
                        <div class="col-md-3">
                            <div class="x_panel" style="box-shadow: 7px 6px 16px #888888;">
                                <div class="x_title">
                                    <h4 class="fa fa-calendar"> <b>Uploaded Years</b></h4>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel">
                                            <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <h4 class="panel-title">View<i class="glyphicon glyphicon-chevron-down pull-right"></i></h4>
                                            </a>
                                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false">
                                                <div class="panel-body">
                                                    <table id="land_datatable" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline">
                                                        <?php foreach ($rpt_result as $key => $value) { ?>
                                                            <tr>
                                                                <td id="paid_year" data-value="<?=$value['year_paid']?>" data-is_no="<?=$value['is_no']?>" style="cursor: pointer;" title="View Details">
                                                                    <center>
                                                                        <?php 
                                                                            $date = date_create($value['year_paid']);
                                                                            $year = date_format($date, "Y");
                                                                            print_r($year);
                                                                        ?>
                                                                    </center>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                        if ($rpt_num == 0) { ?>
                                                            <tr><td><center><code>no record</code></center></td></tr>
                                                        <?php } ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--====================END UPLOADED YEARS MODAL====================-->
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!--====================EDIT ASSESSMENT LEVEL MODAL====================-->
    <div class="modal fade edit-ass-lvl-old" tabindex="-1" role="dialog" aria-hidden="true" style="margin-top: 100px;">
        <div class="modal-dialog modal-md">
            <div class="modal-content" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);">
                <div class="modal-header bg-info">
                    <h2 class="fa fa-edit"> <b>Edit Tax Payment Schedule</b></h2>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <?php echo form_open('Rpt/submit_RPT/' . $li['is_no']); ?>
                    <div class="modal-body">
                        <div class="x_panel" style="border-radius:9px;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="col-md-4"><small>TaxDec Effectivity of Assessment</small><code>*</code></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar-o"></i></div>
                                    <input class="form-control" type="text" name="effective_year" value="<?php echo $asmnts_row['Effective_year']; ?>" required/>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="col-md-4"><small>Assessment Level</small><code>*</code></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-percent"></i></div>
                                    <input class="form-control" type="text" step="1" name="ass_lvl" id="ass_lvl" value="<?php echo number_format($asmnts_row['Assessment_Level']); ?>" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info" name="update_assmnt_lvl">Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--====================ALERT MODAL====================-->
    <div class="modal fade" id="alert_modal" tabindex="-1" role="dialog" aria-hidden="true" style="margin-top: 100px;" >
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);">
                <div class="modal-header bg-orange">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel2"><span class="fa fa-warning"></span> Alert</h4>
                </div>
                <div class="modal-body">
                    <label>You cannot select a date which is below the Effective Year!</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="alert_modal_first" tabindex="-1" role="dialog" aria-hidden="true" style="margin-top: 100px;" >
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);">
                <div class="modal-header bg-orange">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel2"><span class="fa fa-warning"></span> Alert</h4>
                </div>
                <div class="modal-body">
                    <label>Year Paid should not be the same as Effective Year!</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="alert_modal_second" tabindex="-1" role="dialog" aria-hidden="true" style="margin-top: 100px;" >
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);">
                <div class="modal-header bg-orange">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel2"><span class="fa fa-warning"></span> Alert</h4>
                </div>
                <div class="modal-body">
                    <label>The date you've selected is invalid!</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!--====================END ALERT MODAL====================-->
</div><!-- right_col -->

<script>//Assessment Level
    function launch_set_up(){//Display Assessment Level Modal
        document.getElementById('set_up').style.display = 'block';
        $('#set').hide();
    }
    $(function () {//Effectivity of Assessment
        $("#effective_year").datepicker({
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy',
            onClose: function (dateText, inst) {
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).val(year);
            },
            beforeShow: function (input, inst) {
                $(this).datepicker('option', 'defaultDate', new Date($(this).val(), 0, 1));
            }
        }).focus(function () {
            $(".ui-datepicker-calendar, .ui-datepicker-month").hide();
        });
        // Set current year
        $("#effective_year").val(new Date().getFullYear());
    });
    $('#ass_lvl').on('keydown', function(event){//only enter valid numbers
        if ($(this).val() + Number(event.key) > 100) {
            event.preventDefault();// Prevent numbers over 100
        }
        if ($(this).val() === '' && event.key === '0') {
            event.preventDefault();// Prevent starting with 0
        }
        if (/^[a-zA-Z]$/.test(event.key)) {
            event.preventDefault();// Prevent letters
        }
        if (/^[!@#$%^&*()\-_=+[\]{};':"\\|,<>/?`~]$/.test(event.key)) {
            event.preventDefault();// Prevent special characters
        }
        if (/\./.test(event.key)) {
            event.preventDefault();// Prevent decimal points
        }
        if (/\s/.test(event.key)) {
            event.preventDefault();// Prevent spaces
        }
    });
</script>   

<script>//RPT
    function validate_choosen_date_old() {//Year Paid Validation
        var today       = new Date();
        var todayStr    = today.toISOString().split('T')[0]; // yyyy-mm-dd

        var yearPaidVal     = $('#year_paid').val();
        var yearPaid        = new Date(yearPaidVal).getFullYear(); // extract year only
        var effectiveYear   = parseInt($('#effective_year1').val());

        if (yearPaidVal > todayStr) {
            $('#alert_modal_second').modal('show'); // Future date
            $('#year_paid').val('');
        }else if (yearPaid < effectiveYear) {
            $('#alert_modal').modal('show'); // Paid before effectivity
            $('#year_paid').val('');
        }else if (yearPaid === effectiveYear) {
            $('#alert_modal_first').modal('show'); // Paid before effectivity
        }
    }
    $(document).ready(function () {//Dropify
        var drop = $(".dropify").dropify({
            messages: {
                default: "Drop files here or click to browse",
                replace: "Drag and drop a image or file here or click to replace",
            },
        });
    });
    function previewFile(input) {//Preview File
        if (!input || !input.files || input.files.length === 0) {
            return;
        }
        const files         = input.files;
        const imageItems    = [];
        const pdfItems      = [];

        // Loop through all the selected files
        for (let i = 0; i < files.length; i++) {
            const file      = files[i];
            const reader    = new FileReader();
            
            reader.onload = function(e) {
                let fileType = file.type;
                if (fileType.includes("image")) {
                    // If it's an image, add it to the imageItems array
                    imageItems.push({
                        src: e.target.result,
                        title: file.name
                    });
                } else if (fileType === "application/pdf") {
                    // If it's a PDF, add it to the pdfItems array
                    pdfItems.push(e.target.result);
                }
                // Once all files are processed, open the PhotoViewer if there are images
                if (imageItems.length > 0) {
                    try {
                        if (typeof PhotoViewer !== "undefined") {
                            new PhotoViewer(imageItems); // Open PhotoViewer without options
                        } else {
                            alert("PhotoViewer is not loaded. Make sure the script is included.");
                        }
                    } catch (error) {
                        alert("An error occurred while opening PhotoViewer. Check console for details.");
                    }
                }
                // If there are any PDFs, open them in a new window
                if (pdfItems.length > 0) {
                    pdfItems.forEach(pdf => {
                        let pdfWindow = window.open();
                        pdfWindow.document.write(`<iframe src="${pdf}" width="100%" height="100%"></iframe>`);
                    });
                }
            };
            reader.readAsDataURL(file);
        }
    }
</script>

<style>
    .first_panel{
        border: 4px solid #f2f2f2; border-style: outset; background-color: #f2f2f2; margin-bottom: 30px;padding-top:10px
    }
</style>