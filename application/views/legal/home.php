<!-- page content -->
<div class="right_col" role="main">
    <div class="row row_container">
        <div class="alert alert-info alert-dismissible animate fadeInDown" role="alert" style="background-color:#001933;border-color:#001933;border:3px outset gray; ">
            <div class="row">
                <div class="col-md-8">
                    <p style="font-size: 20px;font-family: sans-serif;padding-top: 10px;" id="display">
                    <p>
                </div>
                <div class="col-md-4">
                    <div style="float:right;">
                        <p style="font-size: 15px;font-family: sans-serif" id="da"></p>
                        <p style="font-size: 15px;font-family: sans-serif;margin-top: -17px;" id="ti"></p>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="user" value="<?php echo $this->session->userdata('firstname'); ?>">

        <!--VALUE FOR THE DOUGHNUT CHART ========================================================================================================================== -->
        <?php
        $Agricultural_area_new      = 0;
        $commercial_area_new        = 0;
        $Residential_area_new       = 0;

        $Agricultural_area_extra    = 0;
        $commercial_area_extra      = 0;
        $Residential_area_extra     = 0;

        $Agricultural_area_judicial = 0;
        $commercial_area_judicial   = 0;
        $Residential_area_judicial  = 0;

        foreach ($approved_acq1 as $c) {
            if ($c['tag'] == 'Old LAPF-JS' || $c['tag'] == 'New LAPF-JS') {
                if ($c['lot_type'] == 'Agricultural'):
                    $Agricultural_area_judicial += $c['lot_size'];
                endif;
                if ($c['lot_type'] == 'Commercial'):
                    $commercial_area_judicial += $c['lot_size'];
                endif;
                if ($c['lot_type'] == 'Residential'):
                    $Residential_area_judicial += $c['lot_size'];
                endif;
            } else if ($c['tag'] == 'Old LAPF-ES' || $c['tag'] == 'New LAPF-ES') {
                if ($c['lot_type'] == 'Agricultural'):
                    $Agricultural_area_extra += $c['lot_size'];
                endif;
                if ($c['lot_type'] == 'Commercial'):
                    $commercial_area_extra += $c['lot_size'];
                endif;
                if ($c['lot_type'] == 'Residential'):
                    $Residential_area_extra += $c['lot_size'];
                endif;
            } else {
                if ($c['lot_type'] == 'Agricultural'):
                    $Agricultural_area_new += $c['lot_size'];
                endif;
                if ($c['lot_type'] == 'Commercial'):
                    $commercial_area_new += $c['lot_size'];
                endif;
                if ($c['lot_type'] == 'Residential'):
                    $Residential_area_new += $c['lot_size'];
                endif;
            }

        }
        // echo '<td ><input type="hidden" id="agricultural" value="' . $Agricultural_area . '" /></td>';
        // echo '<td ><input type="hidden" id="commercial" value="' . $commercial_area . '" /></td>';
        // echo '<td ><input type="hidden" id="residential" value="' . $Residential_area . '" /></td>';
        
        ?>
        <!--END VALUE FOR THE DOUGHNUT CHART ========================================================================================================================== -->









        <!-- DOUGHNUT CHART ========================================================================================================================== -->
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-6 animated fadeInUp">
                <div class="x_panel  overflow_hidden">

                    <div class="col-mb-4 agricultural">
                        <!-- <div class=" border-buttom">
                                          <center>
                                                <h2><b>Agricultural</b></h2>
                                          </center>
                                          <div class="clearfix"></div>
                                    </div> -->
                        <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                        <br>
                        <br>
                        <div class="row center-div">
                            <div class="col-xs-4">
                                <h5><b>New Aquisition</b></h5>
                            </div>
                            <div class="col-xs-7">
                                <span class="rectangular-span-new "></span>
                            </div>
                        </div>
                        <div class="row center-div">
                            <div class="col-xs-4">
                                <h5><b>Judicial</b></h5>
                            </div>
                            <div class="col-xs-7">
                                <span class="rectangular-span-judicial "></span>
                            </div>
                        </div>
                        <div class="row center-div">
                            <div class="col-xs-4">
                                <h5><b>Extrajudicial</b></h5>
                            </div>
                            <div class="col-xs-7">
                                <span class="rectangular-span-extra "></span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-6 animated fadeInUp">
                <div class="x_panel  overflow_hidden">

                    <div class="col-mb-4 commercial">
                        <!-- <div class=" border-buttom">
                                          <center>
                                                <h2><b>Commercial</b></h2>
                                          </center>
                                          <div class="clearfix"></div>
                                    </div> -->
                        <div id="chartContainer2" style="height: 300px; width: 100%;"></div>
                        <br>
                        <br>
                        <div class="row center-div">
                            <div class="col-xs-4">
                                <h5><b>New Aquisition</b></h5>
                            </div>
                            <div class="col-xs-7">
                                <span class="rectangular-span-new "></span>
                            </div>
                        </div>
                        <div class="row center-div">
                            <div class="col-xs-4">
                                <h5><b>Judicial</b></h5>
                            </div>
                            <div class="col-xs-7">
                                <span class="rectangular-span-judicial "></span>
                            </div>
                        </div>
                        <div class="row center-div">
                            <div class="col-xs-4">
                                <h5><b>Extrajudicial</b></h5>
                            </div>
                            <div class="col-xs-7">
                                <span class="rectangular-span-extra "></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-6 animated fadeInUp">
                <div class="x_panel  overflow_hidden">

                    <div class="col-mb-4 residential">
                        <!-- <div class=" border-buttom">
                                          <center>
                                                <h2><b>Residential</b></h2>
                                          </center>
                                          <div class="clearfix"></div>
                                    </div> -->
                        <div id="chartContainer3" style="height: 300px; width: 100%;"></div>
                        <br>
                        <br>
                        <div class="row center-div">
                            <div class="col-xs-4">
                                <h5><b>New Aquisition</b></h5>
                            </div>
                            <div class="col-xs-7">
                                <span class="rectangular-span-new "></span>
                            </div>
                        </div>
                        <div class="row center-div">
                            <div class="col-xs-4">
                                <h5><b>Judicial</b></h5>
                            </div>
                            <div class="col-xs-7">
                                <span class="rectangular-span-judicial "></span>
                            </div>
                        </div>
                        <div class="row center-div">
                            <div class="col-xs-4">
                                <h5><b>Extrajudicial</b></h5>
                            </div>
                            <div class="col-xs-7">
                                <span class="rectangular-span-extra "></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!--END DOUGHNUT CHART ========================================================================================================================== -->

    </div>
    <br />
</div>
<!-- /page content -->
<style>
    .border-buttom {
        padding: 10px;
        border-bottom: 1px solid #ccc;
        margin-bottom: 20px;
    }

    .rectangular-span-new {
        display: inline-block;
        width: 40px;
        height: 15px;
        background-color: #9BBB58;
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .rectangular-span-extra {
        display: inline-block;
        width: 40px;
        height: 15px;
        background-color: #C0504E;
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .rectangular-span-judicial {
        display: inline-block;
        width: 40px;
        height: 15px;
        background-color: #4F81BC;
        box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .center-div {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<script type="text/javascript">
    const Agricultural_area_new = <?= $Agricultural_area_new ?>;
    const commercial_area_new = <?= $commercial_area_new ?>;
    const Residential_area_new = <?= $Residential_area_new ?>;

    const Agricultural_area_extra = <?= $Agricultural_area_extra ?>;
    const commercial_area_extra = <?= $commercial_area_extra ?>;
    const Residential_area_extra = <?= $Residential_area_extra ?>;

    const Agricultural_area_judicial = <?= $Agricultural_area_judicial ?>;
    const commercial_area_judicial = <?= $commercial_area_judicial ?>;
    const Residential_area_judicial = <?= $Residential_area_judicial ?>;
    window.onload = function () {

        var chartData = [];
        var chartData2 = [];
        var chartData3 = [];

        if (Agricultural_area_new !== 0) chartData.push({
            y: Agricultural_area_new
        });
        if (Agricultural_area_judicial !== 0) chartData.push({
            y: Agricultural_area_judicial
        });
        if (Agricultural_area_extra !== 0) chartData.push({
            y: Agricultural_area_extra
        });

        if (commercial_area_new !== 0) chartData2.push({
            y: commercial_area_new
        });
        if (commercial_area_judicial !== 0) chartData2.push({
            y: commercial_area_judicial
        });
        if (commercial_area_extra !== 0) chartData2.push({
            y: commercial_area_extra
        });

        if (Residential_area_new !== 0) chartData3.push({
            y: Residential_area_new
        });
        if (Residential_area_judicial !== 0) chartData3.push({
            y: Residential_area_judicial
        });
        if (Residential_area_extra !== 0) chartData3.push({
            y: Residential_area_extra
        });

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {
                text: "Agricultural",
                horizontalAlign: "center"
            },
            data: [{
                type: "doughnut",
                startAngle: 60,
                indexLabelFontSize: 17,
                indexLabel: "#percent%",
                toolTipContent: "{y} sq m (#percent%)",
                dataPoints: chartData
            }]
        });
        var chart2 = new CanvasJS.Chart("chartContainer2", {
            animationEnabled: true,
            title: {
                text: "Commercial",
                horizontalAlign: "center"
            },
            data: [{
                type: "doughnut",
                startAngle: 60,
                indexLabelFontSize: 17,
                indexLabel: "#percent%",
                toolTipContent: "{y} sq m (#percent%)",
                dataPoints: chartData2
            }]
        });
        var chart3 = new CanvasJS.Chart("chartContainer3", {
            animationEnabled: true,
            title: {
                text: "Residential",
                horizontalAlign: "center"
            },
            data: [{
                type: "doughnut",
                startAngle: 60,
                indexLabelFontSize: 17,
                indexLabel: "#percent%",
                toolTipContent: "{y} sq m (#percent%)",
                dataPoints: chartData3
            }]
        });
        chart.render();
        chart2.render();
        chart3.render();
        const nodata =
            '<h4 style="position: absolute; z-index: 100; top: 50%; left: 50%; transform: translate(-50%, -50%); margin-top: 40%">No Data Available</h4>';
        if (chartData.length == 0)
            $('.agricultural .canvasjs-chart-container').prepend(nodata);
        if (chartData2.length == 0)
            $('.commercial .canvasjs-chart-container').prepend(nodata);
        if (chartData3.length == 0)
            $('.residential .canvasjs-chart-container').prepend(nodata);

    }
</script>