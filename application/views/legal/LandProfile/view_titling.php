<div class="x_panel animate slideInDown" style="border-radius:10px">
  <div class="x_title">
    <h5><i class="fa fa-files-o"></i> Land Titling Documents</h5>
    <div class="clearfix"></div>
  </div>
                               
  <div class="row">
		<div class="container">
			<div class="col-md-12">
        <div class="col-md-12">
          <div class="tabbable tabs-left">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#title" data-toggle="tab">Land Title</a></li>
              <li><a href="#tax" data-toggle="tab">Tax Declaration</a></li>
              <li><a href="#TCT" data-toggle="tab">Transfer Certificate of Title</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="title">
                <center>
                  <?php echo form_open_multipart('Land_Profile/upload_titling/'.$li['is_no'], array('onsubmit' => 'return validate()'));?>
                    <div class="container2 col-md-offset-3">
                      <img id="display-img-title" class="image-responsive" src="<?=base_url()?>assets/logo/folder.png" width="68%" height="90%"/>
                      <input type="file" style="display:none;" id="land_title" name="file" onchange="readURL(this); ValidateSingleInput(this);"/>
                      <div class="overlay2"></div>
                      <div class="upload_btn" id="loadFileXml" onclick="document.getElementById('land_title').click();">
                        <a href="#">Select File</a>
                      </div>
                    </div> 
                    <div class="col-md-offset-1">
                      <button class="btn btn-primary" name="land_title_btn" <?php if(!empty($titling['land_title'])){ echo "disabled";} ?>>
                        <i class="fa fa-upload"></i> Upload File
                      </button>
                    </div>
                  </form>
                </center>
              </div>
              <div class="tab-pane" id="tax">
                <center>
                  <?php echo form_open_multipart('Land_Profile/upload_titling/'.$li['is_no'], array('onsubmit' => 'return validate()'));?>
                    <div class="container2 col-md-offset-3">
                      <img id="display-img-tax" class="image-responsive" src="<?=base_url()?>assets/logo/folder.png" width="68%" height="90%"/>
                      <input type="file" style="display:none;" id="tax_dec" name="file" onchange="readURL(this); ValidateSingleInput(this);"/>
                      <div class="overlay2"></div>
                      <div class="upload_btn" id="loadFileXml" onclick="document.getElementById('tax_dec').click();">
                        <a href="#">Select File</a>
                      </div>
                    </div> 
                    <div class="col-md-offset-1">
                      <button class="btn btn-primary" name="tax_declaration_btn" <?php if(!empty($titling['latest_tax_dec'])){ echo "disabled";} ?>>
                        <i class="fa fa-upload"></i> Upload File
                      </button>
                    </div>
                  </form>
                </center>
              </div>
              <div class="tab-pane" id="TCT">
                <center>
                  <?php echo form_open_multipart('Land_Profile/upload_titling/'.$li['is_no'], array('onsubmit' => 'return validate()'));?>
                    <div class="container2 col-md-offset-3">
                      <img id="display-img-tct" class="image-responsive" src="<?=base_url()?>assets/logo/folder.png" width="68%" height="90%"/>
                      <input type="file" style="display:none;" id="tct" name="file" onchange="readURL(this); ValidateSingleInput(this);"/>
                      <div class="overlay2"></div>
                      <div class="upload_btn" id="loadFileXml" onclick="document.getElementById('tct').click();">
                        <a href="#">Select File</a>
                      </div>
                    </div> 
                    <div class="col-md-offset-1">
                      <button class="btn btn-primary" name="tct_btn" <?php if(!empty($titling['tct'])){ echo "disabled";} ?>>
                        <i class="fa fa-upload"></i> Upload File
                      </button>
                    </div>
                  </form>
                </center>
              </div>

            </div>
          </div>
        </div>
			</div>		
		</div>
	</div>              
</div> 

<script type="text/javascript">
  function readURL(input){
    if(input.files && input.files[0]){
      var reader = new FileReader();
      reader.onload = function (e){
        var inputId = $(input).attr('id');
        if(inputId == 'land_title'){
          $('#display-img-title')
          .attr('src', e.target.result)
          .width(340)
          .height(270);
        }else if(inputId == 'tax_dec'){
          $('#display-img-tax')
          .attr('src', e.target.result)
          .width(340)
          .height(270);
        }else if(inputId == 'tct'){
          $('#display-img-tct')
          .attr('src', e.target.result)
          .width(340)
          .height(270);
        }
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    
  function ValidateSingleInput(oInput){
    var sFileName = oInput.files[0].name;
    if(oInput.type == "land_title"){
      if(sFileName.length > 0){
        var blnValid = false;
        for(var j = 0; j < _validFileExtensions.length; j++){
          var sCurExtension = _validFileExtensions[j];
          if(sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()){
            blnValid = true;
            break;
          }
        }
        if(!blnValid){
          alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
          oInput.value = "";
          return false;
        }          
      }
    }
    return true;
  }
  function validate(){
    let activeTab = $('.tab-pane.active').attr('id');
    let valid = true;
    if(activeTab === 'title'){
      if($("#land_title").val() === ''){
        alert('Please select a Land Title file!');
        valid = false;
      }
    }else if(activeTab === 'tax'){
      if($("#tax_dec").val() === ''){
        alert('Please select a Tax Declaration file!');
        valid = false;
      }
    }else if(activeTab === 'tct'){
      if($("#tct").val() === ''){
        alert('Please select a Transfer Certificate of Title file!');
        valid = false;
      }
    }
    return valid;
  }
</script> 

<style type="text/css">
  .container2 {
    position: relative;
    margin-top: 10px;
    width: 500px;
    height: 300px;
  }
  .overlay2 {
    position: absolute;
    top: 0;
    left: 0;
    width: 68%;
    height: 90%;
    background: rgba(0, 0, 0, 0);
    transition: background 0.5s ease;
  }
  .container2:hover .overlay2 {
    display: block;
    background: rgba(0, 0, 0, .3);
  }
  .upload_btn {
    position: absolute;
    width: 500px;
    left:0;
    top: 150px;
    text-align: center;
    opacity: 0;
    transition: opacity .35s ease;
  }
  .upload_btn a {
    width: 200px;
    padding: 12px 48px;
    text-align: center;
    color: white;
    border: solid 2px white;
    z-index: 1;
    margin-left: -158px;
  }
  .container2:hover .upload_btn {
    opacity: 1;
  }
  .image-responsive{
    margin-left: -165px
  }
</style>