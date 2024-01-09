<?php
    $group_model = $this->members_model->fromId($this->uri->segment(4));
    $institution_model = $this->members_model->fromId($group_model->group_id);
    $enrollment = $this->members_model->getWhereTotal(array('group_id'=>$this->uri->segment(4)));
?>
<?php echo form_open_multipart('', "class=\"\" autocomplete=\"off\"") ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"> <?php echo $institution_model->institution; ?> | <?php echo $group_model->session_name; ?> | <?php echo $page_header ?></h3>
                    <ul>
                  
                        <li><a href="<?php echo $this->agent->referrer(); ?>"
                               class="btn btn-success pull-right"
                               role="button" style="margin-right: 15px;"><i class="fa fa-backward"></i> Back</a></li>
                    </ul>
                </div>

                <div class="panel-body">
                


                    <?php
                    // $group_model = $this->members_model->fromId($this->uri->segment(4));
                    // $enrollment = $this->members_model->getWhereTotal(array('group_id'=>$this->uri->segment(4)));
                    ?>

                    <p style="font-size: 14px;">

                        <strong>Institution:</strong> <?php echo $institution_model->institution; ?> <br>
                        <strong>Session:</strong> <?php echo $group_model->session_name; ?><br>
                        <strong>Start Date:</strong> <?php echo custom_date_format($group_model->start_date); ?><br>
                        <strong>End Date:</strong> <?php echo custom_date_format($group_model->end_date); ?><br>
                        <strong>Enrollment:</strong> <?php echo $enrollment; ?>
                    </p>

                    <div class="clearfix"></div>

                    <div class="form-group required row">
                            <label class="col-md-4 control-label">First name</label>
                            <div class="col-md-6">
                                <?php echo form_input('first_name', set_value('first_name',isset($result->first_name)?$result->first_name:''), "id=\"inputFullName\" class=\"form-control input-md\" placeholder=\"first name\""); ?>
                                <?php echo form_error('first_name') ?>
                            </div>
                    </div>

                    <div class="form-group required row">
                        <label class="col-md-4 control-label">Last Name</label>
                        <div class="col-md-6">
                            <?php echo form_input('last_name', set_value('last_name',isset($result->last_name)?$result->last_name:''), "id=\"inputFullName\" class=\"form-control input-md\" placeholder=\"Last Name\""); ?>
                            <?php echo form_error('last_name') ?>
                        </div>
                    </div>

                    <div class="form-group required row">
                            <label class="col-md-4 control-label">Email address<sup>*</sup></label>
                            <div class="col-md-6">
                                <?php echo form_email('email', set_value('email',isset($result->email)?$result->email:''), "id=\"inputEmail\" class=\"form-control input-md\" placeholder=\"Email\""); ?>
                                <?php echo form_error('email') ?>
                            </div>
                        </div>

                    
                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Country</label>
                            <div class="col-md-6">
                                <?php echo form_dropdown('country', $countryList, set_value('country', isset($result->country)?$result->country:''), "id=\"inputFullName\" class=\"form-control input-md\" placeholder=\"Country\"") ?>
                                <?php echo form_error('country') ?>


                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 control-label">Is Verified</label>
                            <div class="col-md-6">
                            <?php echo form_dropdown('is_verified', isset($is_verified)?$is_verified:'', isset($result->is_verified)?$result->is_verified:'', "class=\"form-control\"") ?>
                            <?php echo form_error('is_verified') ?>
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Password<sup>*</sup></label>
                            <div class="col-md-6">
                                <?php echo form_input('pwd', '', "id=\"inputCreatePassword\" class=\"form-control input-md\" placeholder=\"Password\""); ?>
                                <?php echo form_error('pwd') ?>
                            </div>
                        </div>


                        <div class="form-group required row">
                            <label class="col-md-4 control-label"> ConfirmPassword<sup>*</sup></label>
                            <div class="col-md-6">
                                <?php echo form_input('conf_password', '', "id=\"inputCreatePassword\" class=\"form-control input-md\" placeholder=\"Cofirm Password\""); ?>
                                <input type="button" class="button" value="Generate" onClick="generate();" style="margin-top:2px;" >
                                <?php echo form_error('conf_password') ?>
                            </div>
                            
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Reset Password</label>
                            <div class="col-md-6">
                                <a href="<?php echo site_url('student/send_password_link/'.$result->id.'/?back='.current_url()); ?>" class="btn btn-danger">Change Your Password</a>
                            </div>
                        </div>
                        
                    <div class="panel-footer">
                        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Save &rarr;")); ?>
                        <?php //echo form_button(array("type" => "Reset", "class" => "btn btn-danger", "content" => "Reset")); ?>

                    </div>

                </div>
            </div>

        </div>


    </div>

<?php echo form_close(); ?>


