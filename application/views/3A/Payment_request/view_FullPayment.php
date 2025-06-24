<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
    <div class="row row_container">
        <button onclick="topFunction()" id="mvTop" title="Go to top"><i class="fa fa-arrow-up"></i>Top</button>
        <?php if($pr['status'] == 'Pending'){ ?>
            <div class="col-md-12 space">
                <div class="col-md-9"></div>
                <div class="col-md-3" style="position: fixed;width: 250px;bottom: 20px;right: 10px;z-index: 99;cursor: pointer;">
                    <button style="float: right;" class="btn btn-danger btn-sm" data-dismiss="modal"  data-toggle="modal" data-target=".disapproved_<?php echo $pr['control_no']; ?>" title="Disapprove" ><span class="fa fa-close"></span> Disapproved</button>
                    <button style="float: right;" class="btn btn-success btn-sm" data-dismiss="modal"  data-toggle="modal" data-target=".approved_<?php echo $pr['control_no']; ?>" title="Approve" ><span class="fa fa-check"></span> Approved</button>
                </div>
            </div>
        <?php } ?>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <!--====================BODY====================-->
            <div class="x_panel animate fadeIn" style="border:1px; !important;box-shadow: 7px 6px 16px #888888;">
                <div class="x_title">
                    <h2 class="fa fa-book" style="font-size:15px"> <b>Land Profile <u style="color:#eb5d0c"> <?php if($oi['is_no']) { echo $oi['is_no']; } ?></u></b></h2>

                    <div style="float:right">
                        <a href="#" onclick="window.history.back()" class="btn btn-sm btn-warning"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!--====================FIRST PANEL====================-->
                <div class="lclto col-md-12 col-sm-12 col-xs-12"><br/>
                    <?php if(!$ud['land_sketch'] == null){ ?>      
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <img src="<?= base_url('assets/img/uploaded_documents/'.$ud['is_no'].'/Land Sketch/'.$ud['land_sketch'].'') ?>" width="150px" height="130px" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19); border: 2px solid #4CAF50;">               
                        </div>
                    <?php }else{ ?>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <img src="<?= base_url('assets/logo/no_file.png') ?>" style="box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19); border: 2px solid #ff6600; max-width: 150px; max-height: 150px;" class="image-responsive">
                        </div>
                    <?php } ?>

                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <label class="col-md-4 small">Lot. <b style="float: right;">:</b></label>   
                        <i class="small"> <?php if($li['lot']){ echo $li['lot']; }else{ echo "None"; } ?></i>
                    </div>

                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <label class="col-md-4 small">Cad. <b style="float: right;">:</b></label>   
                        <i class="small"> <?php if($li['cad']){ echo $li['cad']; }else{ echo "None"; } ?></i>
                    </div>

                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <label class="col-md-4 small">Land Title No. <b style="float: right;">:</b></label> 
                        <i class="small"> <?php if($li['land_title_no']){ echo $li['land_title_no']; }else{ echo "None";} ?></i>
                    </div>

                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <label class="col-md-4 small">Tax Declaration No. <b style="float: right;">:</b></label> 
                        <i class="small"> <?php if($li['tax_dec_no']){ echo $li['tax_dec_no']; }else{ echo "None"; } ?></i>
                    </div>

                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <label class="col-md-4 small">Lot Owner <b style="float: right;">:</b></label> 
                        <i class="small"> <?php echo ucfirst($oi['firstname']) ?> <?php echo ucfirst($oi['lastname']) ?></i>
                    </div>

                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <label class="col-md-4 small">Lot Location <b style="float: right;">:</b></label>
                        <i class="small"> <?php echo ucfirst($ll['street']) ?>- <?php echo ucfirst($ll['baranggay']) ?>, <?php echo ucfirst($ll['municipality']) ?>, <?php echo ucfirst($ll['province']) ?></i>
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-2 text-center"> 
                        <span style="color: #ff6600; font-weight:bold">LAND SKETCH</span>
                    </div>
                </div>
                <!--====================END FIRST PANEL====================-->

                <div class="container"><br/><br/><br/><br/>
                    <!--====================TABPANE====================-->
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li class="active"><a href="#tab_content_is" id="is-tab" role="tab" data-toggle="tab" aria-expanded="true" style="background-color:#001933;color:white;font-size:10px;">INTERVIEW SHEET</a></li>
                        <li role="presentation" ><a  href="#tab_content_doc" role="tab" id="doc-tab" data-toggle="tab" aria-expanded="false" style="background-color:#001933;color:white;font-size:10px;">SELLER DOCUMENTS</a></li>

                        <?php if(!empty($pr['lpf_submission_date'])): ?>
                            <li role="presentation" ><a  href="#tab_content_lpf" role="tab" id="lpf-tab" data-toggle="tab" aria-expanded="false" style="background-color:#001933;color:white;font-size:10px;">LOT PURCHASE FORM</a></li>
                        <?php endif; ?>

                        <?php if(!empty($pr['cop_submission_date'])): ?>
                            <li role="presentation" ><a  href="#tab_content_cop" role="tab" id="cop-tab" data-toggle="tab" aria-expanded="false" style="background-color:#001933;color:white;font-size:10px;">COMPUTATION OF PAYMENT</a></li>
                        <?php endif; ?>

                        <?php if(!empty($pr['notarial_fee'])): ?>
                            <li role="presentation" ><a  href="#tab_content_nf" role="tab" id="nf-tab" data-toggle="tab" aria-expanded="false" style="background-color:#001933;color:white;font-size:10px;">NOTARIAL FEE</a></li>
                        <?php endif; ?>

                        <?php if(!empty($pr['commission_fee'])): ?>
                            <li role="presentation" ><a  href="#tab_content_ac" role="tab" id="ac-tab" data-toggle="tab" aria-expanded="false" style="background-color:#001933;color:white;font-size:10px;">AGENT COMMISSION</a></li>
                        <?php endif; ?>

                        <?php if(!empty($pr['acknowledgement_receipt'])): ?>
                            <li role="presentation" ><a  href="#tab_content_ar" role="tab" id="ar-tab" data-toggle="tab" aria-expanded="false" style="background-color:#001933;color:white;font-size:10px;">ACKNOLEDGEMENT RECEIPT</a></li>
                        <?php endif; ?>
                    </ul>
                    <!--====================END TABPANE====================-->

                    <div id="myTabContent" class="tab-content">
                        <!--====================INTERVIEW SHEET====================-->
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content_is" aria-labelledby="is-tab">
                            <?php $this->load->view('3A/Payment_request/interview_sheet'); ?>                           
                        </div>
                        <!--====================DOCUMENT REQUIREMENTS====================-->
                        <div role="tabpanel" class="tab-pane fade" id="tab_content_doc" aria-labelledby="doc-tab">          
                            <?php $this->load->view('3A/Payment_request/audited_documents'); ?>      
                        </div>
                        <!--====================LOT PURCHASE FORM====================-->
                        <div role="tabpanel" class="tab-pane fade" id="tab_content_lpf" aria-labelledby="lpf-tab">          
                            <?php $this->load->view('3A/Payment_request/lot_purchase_form'); ?>      
                        </div>
                        <!--====================COMPUTATION OF PAYMENT====================-->
                        <div role="tabpanel" class="tab-pane fade" id="tab_content_cop" aria-labelledby="cop-tab">
                            <?php
                                $purchaseType = $li['purchase_type'];
                                if ($purchaseType == 'package') {
                                    $this->load->view('3A/Payment_request/computation_of_payment_package');
                                }elseif ($purchaseType == 'per/sq.m.') {
                                    $this->load->view('3A/Payment_request/computation_of_payment_sqm');
                                }
                            ?>
                        </div>
                        <!--====================NOTARIAL FEE====================-->
                        <div role="tabpanel" class="tab-pane fade" id="tab_content_nf" aria-labelledby="nf-tab">          
                            <?php $this->load->view('3A/Payment_request/notarial_fee'); ?>      
                        </div>
                        <!--====================AGENT COMMISSION====================-->
                        <div role="tabpanel" class="tab-pane fade" id="tab_content_ac" aria-labelledby="ac-tab">          
                            <?php $this->load->view('3A/Payment_request/agent_commission'); ?> 
                        </div>
                        <!--====================ACKNOLEDGEMENT RECEIPT====================-->
                        <div role="tabpanel" class="tab-pane fade" id="tab_content_ar" aria-labelledby="ar-tab">          
                            <?php $this->load->view('3A/Payment_request/acknowledgement_receipt'); ?>      
                        </div>
                        <!--====================END====================-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'modal.php'; ?>
</div>
<!--====================END PAGE====================-->

<script>
    document.addEventListener("DOMContentLoaded", function (event) {
        //APPROVED FULL PAYMENT
        $(".approved").click(function () {
            var id      = $(this).attr("id");
            var status  = "Approved";
            
            $.ajax({
                url: "<?php echo base_url('Payment/submit_approved_request/"+id+"') ?>",
                type: "post",
                data: { '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>' },
                success: function () {
                    window.location.replace("<?php echo base_url('Payment/pop_up_notification/"+status+"') ?>");
                }
            });
        });
        //DISAPPROVED CASH ADVANCE
        $(".disapproved").click(function () {
            var id      = $(this).attr("id");
            var reason  = $("#disapproved_message").val();
            var status  = "Disapproved";

            if (reason === "") {
                alert("Disapproval message is required.");
                $("#disapproved_message").focus();
                return false; // Stop form submission
            }

            $.ajax({
                url: "<?php echo base_url('Payment/submit_disapproved_request/"+id+"') ?>",
                type: "post",
                data: {
                    'is_no': id,
                    'disapproved_message': reason, // Send the reason to the server
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function (data) {
                    window.location.replace("<?php echo base_url('Payment/pop_up_notification/"+status+"') ?>");
                }
            });
        });
        //END DISAPPROVED CASH ADVANCE
    });
</script>

<script>
    $(document).ready(function() {
        // Function to adjust the height of .right_col based on active tab content
        function adjustRightColHeight() {
            var activeTabContentHeight = $('.tab-content .tab-pane.active').outerHeight();
            $('.right_col').css('min-height', activeTabContentHeight + 'px');
        }

        // Call adjustRightColHeight initially
        adjustRightColHeight();

        // Adjust height when a tab is shown (Bootstrap event)
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            adjustRightColHeight();
        });
    });
</script>

<script>
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
            document.getElementById("mvTop").style.display = "block";
        } else {
            document.getElementById("mvTop").style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>