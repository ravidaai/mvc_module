<?php echo form_open_multipart('', "class=\"\" autocomplete=\"off\"") ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $page_header ?></h3>
                    <ul>

                        <li><a href="<?php echo site_url('student/add/'); ?>"
                               class="btn btn-success pull-right"
                               role="button"><i class="fa fa-plus"></i> Add Student</a></li>

                        <li><a href="<?php echo site_url('student/manage/'); ?>"
                               class="btn btn-success pull-right"
                               role="button" style="margin-right: 15px;"><i class="fa fa-backward"></i> Back</a></li>
                    </ul>
                </div>

                <div class="panel-body">
                    <div class="clearfix"></div>

                    <div class="panel-body">
                        <div class="form-group required row">
                            <label class="col-md-4 control-label">First Name <sup>*</sup></label>
                            <div class="col-md-6">
                                <?php echo form_input('first_name', set_value('first_name',isset($result->first_name)?$result->first_name:''), "id=\"inputFullName\" class=\"form-control input-md\" placeholder=\"First Name\""); ?>
                                <?php echo form_error('first_name') ?>
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Last Name <sup>*</sup></label>
                            <div class="col-md-6">
                                <?php echo form_input('last_name', set_value('last_name',isset($result->last_name)?$result->last_name:''), "id=\"inputFullName\" class=\"form-control input-md\" placeholder=\"Last Name\""); ?>
                                <?php echo form_error('last_name') ?>
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Username (email address)<sup>*</sup></label>
                            <div class="col-md-6">
                                <?php echo form_email('email', set_value('email',isset($result->email)?$result->email:''), "id=\"inputEmail\" class=\"form-control input-md\" placeholder=\"Email\""); ?>
                                <?php echo form_error('email') ?>
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Password<sup>*</sup></label>
                            <div class="col-md-6">
                                <?php echo form_password('pwd', '', "id=\"inputCreatePassword\" class=\"form-control input-md\" placeholder=\"Password\""); ?>
                                <?php echo form_error('pwd') ?>
                            </div>
                        </div>


                        <div class="form-group required row">
                            <label class="col-md-4 control-label"> ConfirmPassword<sup>*</sup></label>
                            <div class="col-md-6">
                                <?php echo form_password('conf_password', '', "id=\"inputCreatePassword\" class=\"form-control input-md\" placeholder=\"Cofirm Password\""); ?>
                                <?php echo form_error('conf_password') ?>
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Gender <sup>*</sup></label>
                            <div class="col-md-6">
                                <div class="radio-inline">
                                    <label>
                                        <?php echo form_radio('gender', 'male', ($_POST['gender']=='male' or $result->gender=="male")? true:false); ?>Male</label>
                                    <?php echo form_error('gender') ?>

                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <?php echo form_radio('gender', 'female', ($_POST['gender']=='female' or $result->gender=="female")? true:false); ?>Female</label>
                                    <?php echo form_error('gender') ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Date of Birth <sup>*</sup></label>
                            <div class="col-md-6">
                                <div class="input-group" >
                                    <?php echo form_input('dob', set_value('dob',isset($result->dob)?$result->dob:''), "id=\"start_date\" class=\"form-control input-md\" placeholder=\"Date of Birth\""); ?>
                                    <?php echo form_error('dob') ?>
                                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
                                </div>


                            </div>


                        </div>



                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Address 1<sup>*</sup></label>
                            <div class="col-md-6">
                                <?php echo form_input('address_one', set_value('address_one',isset($result->address_one)?$result->address_one:''), "id=\"inputFullName\" class=\"form-control input-md\" placeholder=\"Address one\""); ?>
                                <?php echo form_error('address_one') ?>
                            </div>
                        </div>


                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Address 2</label>
                            <div class="col-md-6">
                                <?php echo form_input('address_two', set_value('address_two',isset($result->address_two)?$result->address_two:''), "id=\"inputFullName\" class=\"form-control input-md\" placeholder=\"Address two\""); ?>
                                <?php echo form_error('address_two') ?>
                            </div>
                        </div>


                        <div class="form-group required row">
                            <label class="col-md-4 control-label">City<sup>*</sup></label>
                            <div class="col-md-6">
                                <?php echo form_input('city', set_value('city',isset($result->city)?$result->city:''), "id=\"inputFullName\" class=\"form-control input-md\" placeholder=\"City\""); ?>
                                <?php echo form_error('city') ?>
                            </div>
                        </div>


                        <div class="form-group required row">
                            <label class="col-md-4 control-label">State/Province/Region<sup>*</sup></label>
                            <div class="col-md-6">
                                <?php echo form_input('state_pro_region', set_value('state_pro_region',isset($result->state_pro_region)?$result->state_pro_region:''), "id=\"inputFullName\" class=\"form-control input-md\" placeholder=\"State/Province/Region\""); ?>
                                <?php echo form_error('state_pro_region') ?>

                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-4 control-label">ZIP/Postal Code<sup>*</sup></label>
                            <div class="col-md-6">
                                <?php echo form_input('zip_code', set_value('zip_code',isset($result->zip_code)?$result->zip_code:''), "id=\"inputFullName\" class=\"form-control input-md\" placeholder=\"Zip code\""); ?>
                                <?php echo form_error('zip_code') ?>
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Country<sup>*</sup></label>
                            <div class="col-md-6">
                                <?php echo form_dropdown('country', isset($country)?$country:'', isset($result->country)?$result->country:'', "class=\"form-control\"") ?>
                                <?php echo form_error('country') ?>

                            </div>
                        </div>


                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Phone Number<sup>*</sup></label>
                            <div class="col-md-6">
                                <?php echo form_input('phone', set_value('phone',isset($result->phone)?$result->phone:''), "id=\"inputFullName\" class=\"form-control input-md\" placeholder=\"Phone Number\""); ?>
                                <?php echo form_error('phone') ?>
                            </div>
                        </div>


                        <div class="form-group required row">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-6">


                                <label class="checkbox-inline">
                                    <?php echo form_checkbox('are_you_on_viber', 'yes', ($_POST['are_you_on_viber']=='yes' or $result->are_you_on_viber=="yes")? true:false); ?>Are you on Viber?
                                </label>
                                <label class="checkbox-inline">
                                    <?php echo form_checkbox('are_you_on_whatapps', 'yes', ($_POST['are_you_on_whatapps']=='yes' or $result->are_you_on_whatapps=="yes")? true:false); ?>
                                    Are you on WhatsApp?
                                </label>

                            </div>
                        </div>


                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Facebook Name</label>
                            <div class="col-md-6">
                                <?php echo form_input('fb_name',set_value('first_name',isset($result->first_name)?$result->first_name:''), "id=\"inputFullName\" class=\"form-control input-md\" placeholder=\"https://www.facebook.com/yourpagename\""); ?>
                                <?php echo form_error('fb_name') ?>

                            </div>
                        </div>


                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Linkedin ID</label>
                            <div class="col-md-6">

                                <?php echo form_input('linkedin', set_value('linkedin',isset($result->linkedin)?$result->linkedin:''), "id=\"inputFullName\" class=\"form-control input-md\" placeholder=\"https://www.linkedin.com/in/yourpagename\""); ?>
                                <?php echo form_error('linkedin') ?>
                            </div>
                        </div>



                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Highest Educational Qualification <sup>*</sup></label>
                            <div class="col-md-6">
                                <?php echo form_textarea('highest_edu_qualification', set_value('highest_edu_qualification',isset($result->highest_edu_qualification)?$result->highest_edu_qualification:''), "id=\"inputFullName\" class=\"form-control input-md\" "); ?>
                                <?php echo form_error('highest_edu_qualification') ?>

                            </div>
                        </div>




                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Are you Currently Study? <sup>*</sup></label>
                            <div class="col-md-6">


                                <div class="radio-inline">
                                    <label>
                                        <?php echo form_radio('are_you_current_study', 'yes', ($_POST['are_you_current_study']=='yes' or $result->are_you_current_study=='yes')? true:false); ?>Yes</label>
                                    <?php echo form_error('are_you_current_study') ?>

                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <?php echo form_radio('are_you_current_study', 'no', ($_POST['are_you_current_study']=='yes' or $result->are_you_current_study=='no')? true:false); ?>No</label>
                                    <?php echo form_error('are_you_current_study') ?>
                                </div>

                            </div>
                        </div>


                        <div class="form-group required row">
                            <label class=" col-md-4 control-label">Name of College/University<sup>*</sup></label>
                            <div class="col-md-6">
                                <?php echo form_input('name_college_university', set_value('name_college_university',isset($result->name_college_university)?$result->name_college_university:''), " class=\"form-control input-md\" placeholder=\"Name of college\""); ?>
                                <?php echo form_error('name_college_university') ?>


                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Name of Qualification to be Achieved </label>
                            <div class="col-md-6">
                                <?php echo form_textarea('name_of_qualification_to_achieve', set_value('name_college_university',isset($result->name_college_university)?$result->name_college_university:''), "id=\"inputFullName\" class=\"form-control input-md\" "); ?>
                                <?php echo form_error('name_of_qualification_to_achieve') ?>


                            </div>
                        </div>




                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Employment Status <sup>*</sup></label>
                            <div class="col-md-6">


                                <div class="radio-inline">
                                    <label>
                                        <?php echo form_radio('emp_status', 'Employed', ($_POST['emp_status']=='Employed' or $result->emp_status=='Employed')? true:false); ?>Employed</label>
                                    <?php echo form_error('emp_status') ?>

                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <?php echo form_radio('emp_status', 'Education', ($_POST['emp_status']=='Education' or $result->emp_status=='Education')? true:false); ?>Education</label>
                                    <?php echo form_error('emp_status') ?>
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <?php echo form_radio('emp_status', 'Others', ($_POST['emp_status']=='Others' or $result->emp_status=='Others')? true:false); ?>Others</label>
                                    <?php echo form_error('emp_status') ?>
                                </div>
                                <div class="input_in">

                                    <?php echo form_input('others_value', set_value('others_value',isset($result->others_value)?$result->others_value:''), " class=\"form-control input-md\" placeholder=\"\""); ?>
                                    <?php echo form_error('others_value') ?>
                                </div>
                            </div>
                        </div>


                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Preffered Country to go and Study <sup>*</sup></label>
                            <div class="col-md-6">
                                <?php echo form_dropdown('preferred_country', isset($preferred_country)?$preferred_country:'', isset($result->preferred_country)?$result->preferred_country:'', "class=\"form-control\" id=\"preferred_country_id\"") ?>
                                <?php echo form_error('preferred_country') ?>
                            </div>
                        </div>



                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Preffered College/University<sup>*</sup></label>
                            <div class="col-md-6">

                                <?php echo form_dropdown('preferred_college', isset($preferred_college)?$preferred_college:'', isset($result->preferred_college)?$result->preferred_college:'', "class=\"form-control\" id=\"preferred_college_id\"", $chain) ?>
                                <?php echo form_error('preferred_college') ?>


                            </div>
                        </div>


                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Budget Available for Studies in USD </label>
                            <div class="col-md-6">
                                <?php echo form_textarea('budget_for_study', set_value('budget_for_study',isset($result->budget_for_study)?$result->budget_for_study:''), "id=\"inputFullName\" class=\"form-control input-md\" "); ?>
                                <?php echo form_error('budget_for_study') ?>

                            </div>
                        </div>


                    </div>
                    <div class="panel-footer">
                        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Submit &rarr;")); ?>
                        <?php echo form_button(array("type" => "Reset", "class" => "btn btn-danger", "content" => "Reset")); ?>

                    </div>

                </div>
            </div>

        </div>


    </div>

<?php echo form_close(); ?>


