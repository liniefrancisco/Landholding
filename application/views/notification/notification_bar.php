<?php foreach ($all_notifications as $key => $value) { ?>

                    <li <?php if($value['status'] == 'read'){ ?>
                             style="background-color: #e6e6e6;"
                        <?php } ?>
                    >
                      <a <?php if($value['form_type'] == 'IS' && $value['action'] == 'disapproved'){ ?>href="<?php echo base_url('Requests/view_interview_sheet/'.$value['reference_id']) ?>"  
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
                         <?php } ?>
                        
                         class="open" id="<?php echo $value['id']; ?>"
                      >

                          <?php if($value['form_type'] == 'IS'){ ?>
                              <i class="fa fa-file-text" style="color: #339933"></i> 
                          <?php }elseif($value['form_type'] == 'RCP'){ ?>
                              <i class="fa fa-briefcase" style="color: #990000"></i> 
                          <?php }elseif($value['form_type'] == 'LCAF'){ ?>
                              <i class="glyphicon glyphicon-credit-card" style="color:"></i> 
                          <?php } ?> 

                          <b><?php echo $value['form_type']; ?> No.</b> <i style="text-decoration: underline;"><?php echo $value['reference_id']; ?></i> has been <?php echo $value['action']; ?>
                      </a>
                    </li>
<?php } ?>