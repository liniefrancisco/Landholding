<div class="col-md-8 ascroll bscroll cscroll dscroll notif_content" >
                        <ul class="menu list-group" id="xzyz">
                                        <?php foreach ($all_notifications as $key => $value) {
                                          $date=date_create($value['date']);
                                          $action_date = date_format($date,"M d y, D g:i a");
                      
                                         ?>

                                          <li class="bd list-group-item" <?php if($value['status'] == 'read'){ ?>
                                                   style="background-color: #e6e6e6;"
                                              <?php } ?>
                                          >
                                            <a onclick="update_notification(this.id);" 
                                               <?php if($value['form_type'] == 'IS' && $value['action'] == 'disapproved'){ ?>href="<?php echo base_url('Requests/view_interview_sheet/'.$value['reference_id']) ?>"  
                                               <?php }elseif($value['form_type'] == 'IS' && $value['action'] == 'approved'){ ?> href="<?php echo base_url('Progress/view_file/'.$value['reference_id']) ?>" 
                                               <?php }elseif($value['form_type'] == 'LCAF' && $value['action'] == 'approved'){ 
                                                      $lpf = $this->Payment_model->getca_lpfno($value['reference_id']);
                                                      $data = $this->Payment_model->getlpf_isno($lpf['rcp_no']);
                                                ?> 
                                                           href="<?php echo base_url('Progress/view_file/'.$data['is_no']) ?>"
                                               <?php }elseif($value['form_type'] == 'LCAF' && $value['action'] == 'disapproved'){ ?> href="<?php echo base_url('Requests/disapproved_payments') ?>"
                                               <?php }elseif($value['form_type'] == 'RCP'){ 
                                                         $data = $this->Payment_model->getlpf_isno($value['reference_id']);
                                                ?>
                                                           href="<?php echo base_url('Progress/view_file/'.$data['is_no']) ?>"
                                               <?php }elseif($value['form_type'] == 'LAPF-ES'){ ?>
                                                           href="<?php echo base_url('Aspayment/view_es/'.$value['reference_id']) ?>"
                                               <?php }elseif($value['form_type'] == 'LAPF-JS'){ ?>
                                                           href="<?php echo base_url('Aspayment/view_js/'.$value['reference_id']) ?>"
                                               <?php } ?>
                                              
                                               class="open" id="<?php echo $value['id']; ?>"
                                            >

                                                <?php if($value['form_type'] == 'IS'){ ?>
                                                    <i class="fa fa-file-text" style="color: #339933"></i> 
                                                <?php }elseif($value['form_type'] == 'RCP'){ ?>
                                                    <i class="fa fa-briefcase" style="color: #990000"></i> 
                                                <?php }elseif($value['form_type'] == 'LCAF'){ ?>
                                                    <i class="glyphicon glyphicon-credit-card" style="color: #0099ff"></i> 
                                                <?php }elseif($value['form_type'] == 'LAPF-ES'){ ?> 
                                                  <i class="glyphicon glyphicon-briefcase" style="color: green;"></i>
                                                <?php }elseif($value['form_type'] == 'LAPF-JS'){ ?>
                                                 <i class="fa fa-gavel" style="color: brown;"></i>
                                                <?php } ?>

                                                <i style="text-align: justify; color: #404040;"><?php echo $value['form_type']; ?> No. <?php echo $value['reference_id']; ?></i> <i style="color: #404040;">has been <?php echo $value['action']; ?> on </i><a href="#" style="color: #404040; text-align: justify; text-transform: lowercase;"><i><?php echo $action_date; ?></i></a>
                                            </a>
                                          </li>
                                        <?php }
                                            if($all_notification_no == 0){
                                         ?>
                                              <li class="bd list-group-item"><a href="#" >No notification to be shown</a></li>
                                         <?php } ?>
                                    </ul>

</div>
<div class="col-md-4">

                      <h3><span class="label label-success"><i class="glyphicon glyphicon-eye-open" style="color: black;"></i> Read Notifications: <?php echo $read_notifications; ?></span></h3>
                      <h3  style="margin-top: 0px;"><span class="label label-warning"><i class="glyphicon glyphicon-eye-close" style="color: black;"></i> Unread Notifications: <?php echo $no_of_notifications; ?></span></h3>
        
</div>
  <script type="text/javascript">
      function update_notification(id){
    
                          $.ajax({
                              url: "<?php echo base_url('Notification/read_notification/"+id+"')?>",
                              type: "post",
                              success:function()
                              {
                                //alert('success');
                                // getNotification();
                              }
                          });
      }

      $(".notif_content").scrollTop($('.notif_content').height());
</script>