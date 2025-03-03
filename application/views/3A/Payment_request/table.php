<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
    <div class="row row_container">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <!--====================FLASH DATAS====================-->
            <?php if($this->session->flashdata('notif')){?>
                <div class="alert alert-success alert-dismissible fade in" role="alert" id="saved">
                    <i class="glyphicon glyphicon-ok"></i>  <?php echo $this->session->flashdata('notif'); ?>
                </div>
            <?php } ?>
            <!--====================END FLASH DATAS====================-->

            <!--====================BODY====================-->
            <div class="x_panel" style="box-shadow: 5px 8px 16px #888888">
                <div class="x_title">
                    <h2  class="fa fa-money"> Payment Request</h2>
                    <div style="float:right">
                        <a href="#" onclick="window.history.back()" class="btn btn-sm btn-warning"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!--====================TABPANE====================-->
                <div class="tab">
                    <button id="button1" class="tablinks active" onclick="openTab(event, 'pending')">
                        <i class="fa fa-ellipsis-h"></i> <b>PENDING</b> 
                        <sup>
                            <?php if ($pending_payment > 0): ?>
                                <span class="badge_custom bg-red"><?php echo $pending_payment; ?></span>
                            <?php endif; ?>
                        </sup>
                    </button>
                    <button id="button2" class="tablinks" onclick="openTab(event, 'approved')">
                        <i class="fa fa-thumbs-up"></i> <b>APPROVED</b> 
                        <sup>
                            <?php if ($approved_payment > 0): ?>
                                <span class="badge_custom bg-red"><?php echo $approved_payment; ?></span>
                            <?php endif; ?>
                        </sup>
                    </button>
                    <button id="button3" class="tablinks" onclick="openTab(event, 'disapproved')">
                        <i class="fa fa-thumbs-down"></i> <b>DISAPPROVED</b>
                        <sup>
                            <?php if ($disapproved_payment > 0): ?>
                                <span class="badge_custom bg-red"><?php echo $disapproved_payment; ?></span>
                            <?php endif; ?>
                        </sup>
                    </button>
                    <button id="button4" class="tablinks" onclick="openTab(event, 'payed')"><i class="fa fa-refresh"></i> <b>PAID</b> 
                        <sup>
                            <?php if ($paid_payment > 0): ?>
                                <span class="badge_custom bg-red"><?php echo $paid_payment; ?></span>
                            <?php endif; ?>
                        </sup>
                    </button>
                </div>
                <!--====================END TABPANE====================-->

                <div class="col-md-12 " style="border: 2px ridge ; border-radius: 5px;">
                    <!--====================PENDING====================-->
                    <div id="pending" class="tabcontent">
                        <h4 class="request">Pending Payment Request</h4>
                        <table id="pending_payment_datatable" class="table table-striped table-bordered table-hover nowrap" style="border-bottom:2px solid gray;width:100%">
                            <thead>
                                <tr>
                                    <th>IS No.</th>
                                    <th>Lot Owner</th>
                                    <th>Lot Type</th>
                                    <th>Lot Location</th>
                                    <th>Type of Request</th>
                                    <th>Date Requested</th>
                                    <th><center>Action<center></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <!--====================APPROVED====================-->
                    <div id="approved" class="tabcontent">
                        <h4 class="request">Approved Payment Request</h4>
                        <table id="approved_payment_datatable" class="table table-striped table-bordered table-hover nowrap" style="border-bottom:2px solid gray;width:100%">
                            <thead>
                                <tr>
                                    <th>IS No.</th>
                                    <th>Lot Owner</th>
                                    <th>Lot Type</th>
                                    <th>Lot Location</th>
                                    <th>Type of Request</th>
                                    <th>Date Requested</th>
                                    <th>Date Approved</th>
                                    <th><center>Action<center></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <!--====================DISAPPROVED====================-->
                    <div id="disapproved" class="tabcontent">
                        <h4 class="request">Disapproved Payment Request</h4>
                        <table id="disapproved_payment_datatable" class="table table-striped table-bordered table-hover nowrap" style="border-bottom:2px solid gray;width:100%">
                            <thead>
                                <tr>
                                    <th>IS No.</th>
                                    <th>Lot Owner</th>
                                    <th>Lot Type</th>
                                    <th>Lot Location</th>
                                    <th>Type of Request</th>
                                    <th>Date Requested</th>
                                    <th>Date Disapproved</th>
                                    <th>Reason Disapproved</th>
                                    <th><center>Action<center></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <!--====================PAID====================-->
                    <div id="payed" class="tabcontent">
                        <h4 class="request">Paid Payment Request</h4>
                        <table id="paid_payment_datatable" class="table table-striped table-bordered table-hover nowrap" style="border-bottom:2px solid gray;width:100%">
                            <thead>
                                <tr>
                                    <th>IS No.</th>
                                    <th>Lot Owner</th>
                                    <th>Lot Type</th>
                                    <th>Lot Location</th>
                                    <th>Type of Request</th>
                                    <th>Date Requested</th>
                                    <th>Date Approved</th>
                                    <th>Date Paid</th>
                                    <th><center>Action<center></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'modal.php'; ?>
</div>
<!--====================PAGE CONTENT====================-->


<!--====================END REASON DISAPPROVAL MODAL====================-->

<script>
    // Set the first button as active on page load
    document.getElementById('button1').classList.add('active');
    document.getElementById('pending').style.display = 'block';

    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;

        // Hide all tab content
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Remove the "active" class from all tab links
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }

        // Show the selected tab content and mark the button as active
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.classList.add("active");
    }
</script>

<style type="text/css">
    table {
        font-family: 'Arial';
        margin: 25px auto;
        border-collapse: collapse;
        border: 1px solid #eee;
        border-bottom: 2px solid #00cccc;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.10),
            0px 10px 20px rgba(0, 0, 0, 0.05),
            0px 20px 20px rgba(0, 0, 0, 0.05),
            0px 30px 20px rgba(0, 0, 0, 0.05);
    }
    tr {
        &:hover {
            background: #f4f4f4;

            td {
                color: #555;
            }
        }
    }
    th,td {
        color: #595959;
        border: 1px solid #eee;
        padding: 12px 35px;
        border-collapse: collapse;
        font-size: 12px;
    }
    th {
        background: linear-gradient(to top, rgb(9, 32, 63) 0%, rgb(83, 120, 149) 100%);
        color: #fff;
        text-transform: uppercase;
        font-size: 11px;

        &.last {
            border-right: none;
        }
    }
    .tab {
        overflow: visible;
        background-color: #f1f1f1;
    }
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 5px 10px;
        transition: 0.3s;
        font-size: 13px;
        border: 1px solid #ccc;
        border-radius: 10px;
        border-right: none;
        background-color: #e9e9e9;
        color: #28282B;
        border-top: 1px solid gray;
        border-left: 1px solid gray;
        border-right: 2px solid #181818;
        border-bottom: 3px solid #181818;
    }
    .tab button:hover {
        background-color: #002347;
        color: white;
    }
    .tab button.active {
        background-color: #002347;
        color: white;
    }
    .tabcontent {
        display: none;
        padding: 6px 12px;
        transition: opacity 0.3s ease;
    }
    .fade-in {
        opacity: 1;
    }
    .request {
        font-family: verdana;
        text-align: center;
        font-size: 16px;
        color: #2a3f54;
        font-weight: bold
    }
</style>