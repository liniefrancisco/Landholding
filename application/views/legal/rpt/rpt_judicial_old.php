<!-- page content -->
<div class="right_col" role="main">
  <div class="row row_container">

    <div class="col-md-12 col-sm-12 col-xs-12">

      <!-- start content ======================================================================================================================================= -->
      <div class="x_panel" style="box-shadow: 5px 8px 16px #888888">
        <div class="x_title">
          <h2 style="word-spacing: 4px; letter-spacing: 1px; font-weight: bold; font-size: 14px;color:#2a3f54;"><i
              class="fa fa-database" style="font-size: 16px;"></i>Land Titling</h2>
          <div style="float:right;color:#2a3f54"><b>
              <p style="font-size: 13px;font-family: sans-serif;padding-bottom: 3px;letter-spacing: 1px;" id="da"></p>
              <p style="font-size: 13px;font-family: sans-serif;margin-top: -19px;letter-spacing: 1px;" id="ti"></p>
            </b></div>
          <div class="clearfix"></div>
        </div>

        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">

            <div class="tab">
                <a href="<?php echo base_url('Legal_f/Rpt/rpt_judicial_old'); ?>"> <button class="tablinks active">
                    <b>OLD ACQUISITION</b></button></a>
                <a href="<?php echo base_url('Legal_f/Rpt/rpt_judicial_new'); ?>"> <button class="tablinks ">
                    <b>NEW ACQUISITION</b></button></a>
              </div>

              <br>
              <div class="card shadow">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover" id="old_acquisition">
                      <thead style="background-color:#00538C">
                        <tr>
                          <th class="fw-bold" style="color: white">I.S NO.</th>
                          <th class="fw-bold" style="color: white">OWNER</th>
                          <th class="fw-bold" style="color: white">TAX DECLERATION NO.</th>
                          <th class="fw-bold" style="color: white">LOT TYPE</th>
                          <th class="fw-bold" style="color: white">LOT LOCATION</th>
                          <th class="fw-bold" style="color: white">ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- end content  ======================================================================================================================================= -->
    </div>


  </div>
  <br />
</div>
<!-- /page content -->


<style type="text/css">
  /*TABLE STYLE =============================================================================================================*/


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

  th,
  td {
    color: #595959;
    border: 1px solid #eee;
    padding: 12px 35px;
    border-collapse: collapse;
    font-size: 12px;
  }

  td {
    height: 20px;
  }

  th {
    background: #0d2e56
      /*#339933*/
    ;
    color: #fff;
    text-transform: uppercase;
    font-size: 11px;

    &.last {
      border-right: none;
    }
  }

  .tab {
    overflow: visible;
    /* background-color: #f1f1f1; */
  }

  .tab button {
    background-color: inherit;
    /* float: left; */
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



  /*END TABLE STYLE =============================================================================================================*/
</style>
<script>
$(document).ready(function(){
  $("#old_acquisition").DataTable({
    "serverSide": true,
      ajax: {
        url: '<?= site_url('Legal_f/Rpt/fetch_rpt_datatable/judicial');?>',
        data:{
          tag:'Old LAPF-JS'
        },
        type: "POST",
        dataSrc: function (data) {
          if (data == "") {
            return [];
          } else {
            return data.data;
          }
        }
      },
      order: [],
      responsive: false,
      fixedHeader: true,
      columnDefs: [{
        "targets": [5], // 6th and 7th column / numbering column
        "orderable": false, //set not orderable
      },],
    });

});

const viewImage = (path) => {
        console.log('path',path);
        let item = [{
            src: path,
            title: 'View Paid History'
        }];
        let options = {
            index: 0
        };
        let photoviewer = new PhotoViewer(item, options);
    }
    
</script>