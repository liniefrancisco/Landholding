<!--====================PAGE CONTENT====================-->
<div class="right_col" role="main">
    <div class="row row_container">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <!--====================FLASH DATAS====================-->
            <?php if($this->session->flashdata('success')){?>
                <div class="alert alert-success alert-dismissible fade in" role="alert" id="saved">
                    <i class="glyphicon glyphicon-ok"></i>  <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php } ?>
            <!--====================END FLASH DATAS====================-->

            <!--====================BODY====================-->
            <div class="x_panel" style="box-shadow: 5px 8px 16px #888888">
                <div class="x_title">
                    <h6 class="fa fa-money"> <b>Payment Request</b></h6> 
                    <a href="#" onclick="window.history.back()" class="btn btn-xs btn-warning pull-right"><span class="fa fa-arrow-left" style="color:#fff"></span> Back</a>
                    <div class="clearfix"></div>
                </div>
                <!--====================TAB NAVIGATION====================-->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="javascript:void(0);" onclick="openTab(event, 'pending', this)">
                        <i class="fa fa-ellipsis-h"></i><small> <b>Pending</b></small>
                        <sup>
                            <?php if ($pending_payment > 0): ?>
                                <span class="badge_custom bg-red"><?php echo $pending_payment; ?></span>
                            <?php endif; ?>
                        </sup>
                    </a></li>
                    <li><a href="javascript:void(0);" onclick="openTab(event, 'approved', this)">
                        <i class="fa fa-thumbs-up"></i><small> <b>Approved</b></small>
                        <sup>
                            <?php if ($approved_payment > 0): ?>
                                <span class="badge_custom bg-red"><?php echo $approved_payment; ?></span>
                            <?php endif; ?>
                        </sup>
                    </a></li>
                    <li><a href="javascript:void(0);" onclick="openTab(event, 'disapproved', this)">
                        <i class="fa fa-thumbs-down"></i><small> <b>Disapproved</b></small>
                        <sup>
                            <?php if ($disapproved_payment > 0): ?>
                                <span class="badge_custom bg-red"><?php echo $disapproved_payment; ?></span>
                            <?php endif; ?>
                        </sup>
                    </a></li>
                    <li><a href="javascript:void(0);" onclick="openTab(event, 'paid', this)">
                    <i class="fa fa-refresh"></i><small> <b>Paid</b></small>
                        <sup>
                            <?php if ($paid_payment > 0): ?>
                                <span class="badge_custom bg-red"><?php echo $paid_payment; ?></span>
                            <?php endif; ?>
                        </sup>
                    </a></li>
                </ul>
                <div class="col-md-12">
                    <!--====================PENDING====================-->
                    <div id="pending" class="tabcontent space">
                        <table id="pending_datatable" class="table table-bordered table-hover small" style="border-bottom:2px solid gray;width:100%">
                            <thead class="bg-primary">
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
                    <div id="approved" class="tabcontent space" style="display: none;">
                        <table id="approved_datatable" class="table table-bordered table-hover small" style="border-bottom:2px solid gray;width:100%">
                            <thead class="bg-primary">
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
                    <div id="disapproved" class="tabcontent space" style="display: none;">
                        <table id="disapproved_datatable" class="table table-bordered table-hover small" style="border-bottom:2px solid gray;width:100%">
                            <thead class="bg-primary">
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
                    <div id="paid" class="tabcontent space" style="display: none;">
                        <table id="paid_datatable" class="table table-bordered table-hover small" style="border-bottom:2px solid gray;width:100%">
                            <thead class="bg-primary">
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