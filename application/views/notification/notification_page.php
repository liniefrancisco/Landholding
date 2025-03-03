<!-- page content -->
<div class="right_col" role="main">
    <div class="row row_container">
         	
         	<div class="col-md-12 col-sm-12 col-xs-12">
<!-- LIST OF LAND OWNED ======================================================================================================================================= -->
		          		<div class="x_panel" style="box-shadow: 5px 8px 16px #888888; height: 580px;">
		          				 <div class="x_title">
				                    <h2 style="word-spacing: 4px; letter-spacing: 1px; font-weight: bold; font-size: 14px;color: #2a3f54; "><i class="fa fa-bell"></i> All Notifications</h2>
				                     <div style="float:right;color: #2a3f54;"><b>
                                <p style="font-size: 13px;font-family: sans-serif;padding-bottom: 3px;letter-spacing: 1px;" id="da"></p>
                                <p style="font-size: 13px;font-family: sans-serif;margin-top: -19px;letter-spacing: 1px;" id="ti"></p></b>
                            </div>
				                    <div class="clearfix"></div>
				                  </div>
                          <!-- style="overflow-x:auto;" -->
		          		<div class="col-md-12"> 
				                
				                <div id="notif_content" ></div>
                        <div class="col-md-4 form-inline">
                          <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                       <h3>
                            <button class="btn btn-success read_all" id="<?php echo $user_n; ?>" style="width: 173px;"><span class="glyphicon glyphicon-pencil" ></span> Mark All as Read</button><br>
                            
                            <button class="btn btn-danger clear_all" id="<?php echo $user_n; ?>" ><span class="glyphicon glyphicon-trash"></span> Clear All Notifications</button>
                      </h3>
                                    
                       </div>
				                
				         </div>       


		          		</div>	
<!--END LIST OF LAND OWNED ======================================================================================================================================= -->

	      <br/>
    </div>
        	
    </div>
    <br />
</div>
<!-- /page content -->

<style type="text/css">
  .notif_content{
    height: 500px;
    max-height: 500px;
    overflow-x: hidden;
    font-size: 15px;  
    /*border: 2px solid #666666;*/  
    padding-left: 40px;
  }
  ul#xzyz {
    list-style-type: none;
    line-height: 80%;
    padding-top: 5px;
    /*margin-left: -30px;*/
    box-shadow: 1px 2px 16px #888888;
    font-size: 12px;

  }

  li.bd {
    position:relative;
    max-width: 600px;
    width: 100%;
    height: 30px;
    border: 1px solid white;
    overflow:hidden;
      text-overflow:ellipsis;
      white-space:nowrap;
      display:inline-block;
      padding-top: 4px;
      padding-left: 10px;
      /*margin-left: -30px;*/
       
  }
 li.bd:hover{
    background-color: #e6e6e6;
  }
</style>



		        
