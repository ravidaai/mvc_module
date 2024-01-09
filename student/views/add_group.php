<?php echo form_open_multipart('', "class=\"\" autocomplete=\"off\"") ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $page_header ?></h3>
                    <ul>
                  
                        <li><a href="<?php echo $this->agent->referrer(); ?>"
                               class="btn btn-success pull-right"
                               role="button" style="margin-right: 15px;"><i class="fa fa-backward"></i> Back</a></li>
                    </ul>
                </div>

                <div class="panel-body">
                    <div class="clearfix"></div>

                    <div class="form-group required row">
                            <label class="col-md-4 control-label">Institution</label>
                            <div class="col-md-6">
                                <?php echo form_input('institution', set_value('institution',isset($result->institution)?$result->institution:''), "id=\"inputFullName\" class=\"form-control input-md\" placeholder=\"Institution\""); ?>
                                <?php echo form_error('institution') ?>
                            </div>
                    </div>

                    <?php /* ?>
                    <div class="form-group required row">
                        <label class="col-md-4 control-label">Session Name</label>
                        <div class="col-md-6">
                            <?php echo form_input('session_name', set_value('session_name',isset($result->session_name)?$result->session_name:''), "id=\"inputFullName\" class=\"form-control input-md\" placeholder=\"Session Name\""); ?>
                            <?php echo form_error('session_name') ?>
                        </div>
                    </div>
                    <?php */ ?>

                    <div class="form-group required row">
                        <label class="col-md-4 control-label">Group Created on</label>
                        <div class="col-md-6">
                            <?php
                            if(isset($result->created)){
                                echo custom_date_format($result->created);
                            }
                            else{
                                echo custom_date_format(current_date());
                            }

                            ?>
                        </div>
                    </div>

                    <div class="form-group required row">
                        <label class="col-md-4 control-label">Group Admin Name</label>
                        <div class="col-md-6">
                            <?php echo form_input('group_name', set_value('group_name',isset($result->group_name)?$result->group_name:''), "id=\"inputFullName\" class=\"form-control input-md\" placeholder=\"Group Name\""); ?>
                            <?php echo form_error('group_name') ?>
                        </div>
                    </div>

                    <div class="form-group required row">
                        <label class="col-md-4 control-label">Position</label>
                        <div class="col-md-6">
                            <?php echo form_input('position_title', set_value('position_title',isset($result->position_title)?$result->position_title:''), "id=\"inputFullName\" class=\"form-control input-md\" placeholder=\"Position Title\""); ?>
                            <?php echo form_error('position_title') ?>
                        </div>
                    </div>

                    <div class="form-group required row">
                            <label class="col-md-4 control-label">Address</label>
                            <div class="col-md-6">
                                <?php echo form_input('address', set_value('address',isset($result->address)?$result->address:''), "id=\"inputFullName\" class=\"form-control input-md\" placeholder=\"Address\""); ?>
                                <?php echo form_error('address') ?>
                            </div>
                        </div>

                    
                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Telephone</label>
                            <div class="col-md-6">
                                <?php echo form_input('telephone', set_value('telephone',isset($result->telephone)?$result->telephone:''), "id=\"inputFullName\" class=\"form-control input-md\" placeholder=\"Telephone\""); ?>
                                <?php echo form_error('telephone') ?>
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
                            <label class="col-md-4 control-label">Start Date</label>
                            <div class="col-md-6">
                                <?php echo form_input('start_date', set_value('start_date',isset($result->start_date)?$result->start_date:current_date()), "class=\"form-control \"  id=\"end_date\" "); ?>
                                <?php echo form_error('start_date') ?>
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-4 control-label">End Date</label>
                            <div class="col-md-6">
                                <?php echo form_input('end_date', set_value('end_date',isset($result->end_date)?$result->end_date:''), "class=\"form-control \"  id=\"start_date_from\""); ?>
                                <?php echo form_error('end_date') ?>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                            <?php echo form_dropdown('status', isset($status)?$status:'', isset($result->status)?$result->status:'', "class=\"form-control\"") ?>
                            <?php echo form_error('status') ?>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-4 control-label">Is Verified</label>
                            <div class="col-md-6">
                            <?php echo form_dropdown('is_verified', isset($is_verified)?$is_verified:'', isset($result->is_verified)?$result->is_verified:'', "class=\"form-control\"") ?>
                            <?php echo form_error('is_verified') ?>
                            </div>
                        </div>

                    <?php     /*
                    <div class="form-group required row">
                            <label class="col-md-4 control-label">Country<sup>*</sup></label>
                            <div class="col-md-6">
                            <?php echo form_dropdown('country', $countryList, set_value('country', isset($result->country)?$result->country:''), "id=\"inputFullName\" class=\"form-control input-md\" placeholder=\"Country\"") ?>
                            <?php echo form_error('country') ?>
                            </div>
                        </div>
*/?>
                        
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


