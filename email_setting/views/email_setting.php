<div class="row">
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $page_header ?></h3>

            </div>
<!-- panel-body -->
            <div class="">
                <div class="clearfix"></div>
                <?php echo form_open('', "class=\"\" autocomplete=\"off\" ") ?>
               <!-- panel-body -->
                <div class="" style="background-color: #eee;">
                    <div class="admin_fields_set">
                        <div class="form-group" style="margin-left: 13px;"><strong>Admin display name/email ID in all outgoing emails</strong></div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Name:</label>
                                    <?php echo form_input('admin_name', set_value('admin_name', isset($result->admin_name) ? $result->admin_name : ''), "class=\"form-control width-auto inline-block\""); ?>
                                    <?php echo form_error('admin_name') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email:</label>
                                    <?php echo form_input('out_going_email', set_value('out_going_email', isset($result->out_going_email) ? $result->out_going_email : ''), "class=\"form-control width-auto inline-block\""); ?>
                                    <?php echo form_error('out_going_email') ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="admin_fields_set">
                        <div class="form-group" style="margin-left: 13px;"><strong>User Emails to Admin</strong></div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Emails sent from</th>
                                                    <th>Subject Line Text</th>
                                                    <th>Forward emails to</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Support page
                                                    </td>
                                                    <td>
                                                        <?php echo form_input('support_page_subject', set_value('support_page_subject', isset($result->support_page_subject) ? $result->support_page_subject : ''), "class=\"form-control col-md-3\""); ?>
                                                        <?php echo form_error('support_page_subject') ?>
                                                    </td>
                                                    <td>
                                                        <?php echo form_input('support_page_forward_email_to', set_value('support_page_forward_email_to', isset($result->support_page_forward_email_to) ? $result->support_page_forward_email_to : ''), "class=\"form-control col-md-3\""); ?>
                                                        <?php echo form_error('support_page_forward_email_to') ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        Course Evaluation page
                                                    </td>
                                                    <td>
                                                        <?php echo form_input('course_evaluation_subject', set_value('course_evaluation_subject', isset($result->course_evaluation_subject) ? $result->course_evaluation_subject : ''), "class=\"form-control col-md-3\""); ?>
                                                        <?php echo form_error('course_evaluation_subject') ?>
                                                    </td>
                                                    <td>
                                                        <?php echo form_input('course_evaluation_forward_email_to', set_value('course_evaluation_forward_email_to', isset($result->course_evaluation_forward_email_to) ? $result->course_evaluation_forward_email_to : ''), "class=\"form-control col-md-3\""); ?>
                                                        <?php echo form_error('course_evaluation_forward_email_to') ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        Contact Us
                                                    </td>
                                                    <td>
                                                        <?php echo form_input('contact_us_home_subject', set_value('contact_us_home_subject', isset($result->contact_us_home_subject) ? $result->contact_us_home_subject : ''), "class=\"form-control col-md-3\""); ?>
                                                        <?php echo form_error('contact_us_home_subject') ?>
                                                    </td>
                                                    <td>
                                                        <?php echo form_input('contact_us_home_forward_email_to', set_value('contact_us_home_forward_email_to', isset($result->contact_us_home_forward_email_to) ? $result->contact_us_home_forward_email_to : ''), "class=\"form-control col-md-3\""); ?>
                                                        <?php echo form_error('contact_us_home_forward_email_to') ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="admin_fields_set">
                        <div class="form-group" style="margin-left: 13px;"><strong>“Credit Card Enrollment Successful” Email</strong></div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="col-md-2">Subject Line:</label>
                                    <?php echo form_input('cc_enrollment_successfull_subject', set_value('cc_enrollment_successfull_subject', isset($result->cc_enrollment_successfull_subject) ? $result->cc_enrollment_successfull_subject : ''), "class=\"form-control width-auto inline-block\""); ?>
                                    <?php echo form_error('cc_enrollment_successfull_subject') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="col-md-2">Body Text:</label>
                                    <?php echo form_textarea('cc_enrollment_body_text', set_value('cc_enrollment_body_text', isset($result->cc_enrollment_body_text) ? $result->cc_enrollment_body_text : ''), "class=\"form-control width-auto inline-block col-md-6\""); ?>
                                    <?php echo form_error('cc_enrollment_body_text') ?>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="admin_fields_set">
                        <div class="form-group" style="margin-left: 13px;"><strong>“Invite to Course” Email</strong></div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="col-md-2">Subject Line:</label>
                                    <?php echo form_input('invite_group_subject', set_value('invite_group_subject', isset($result->invite_group_subject) ? $result->invite_group_subject : ''), "class=\"form-control width-auto inline-block\""); ?>
                                    <?php echo form_error('invite_group_subject') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="col-md-2">Body Text:</label>
                                    <?php echo form_textarea('invite_group_email_body_text', set_value('invite_group_email_body_text', isset($result->invite_group_email_body_text) ? $result->invite_group_email_body_text : ''), "class=\"form-control width-auto inline-block col-md-6\" cols=\"70\" "); ?>

                                    <?php echo form_error('invite_group_email_body_text') ?>
                                </div>
                            </div>

                        </div>
                    </div>

                    

                    <div class="admin_fields_set">
                        <div class="form-group" style="margin-left: 13px;"><strong>“Admin Has Changed Your Password” Email</strong></div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="col-md-2">Subject Line:</label>
                                    <?php echo form_input('admin_has_change_pwd_subject', set_value('admin_has_change_pwd_subject', isset($result->admin_has_change_pwd_subject) ? $result->admin_has_change_pwd_subject : ''), "class=\"form-control width-auto inline-block\""); ?>
                                    <?php echo form_error('admin_has_change_pwd_subject') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="col-md-2">Body Text:</label>
                                    <?php echo form_textarea('admin_has_change_pwd_body_text', set_value('admin_has_change_pwd_body_text', isset($result->admin_has_change_pwd_body_text) ? $result->admin_has_change_pwd_body_text : ''), "class=\"form-control width-auto inline-block col-md-6\""); ?>
                                    <?php echo form_error('admin_has_change_pwd_body_text') ?>
                                </div>
                            </div>

                        </div>
                    </div>
                   
                    <div class="admin_fields_set">
                        <div class="form-group" style="margin-left: 13px;"><strong>“Please Change Your Password” Email</strong></div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="col-md-2">Subject Line:</label>
                                    <?php echo form_input('admin_has_send_password_reset_link_subject', set_value('admin_has_send_password_reset_link_subject', isset($result->admin_has_send_password_reset_link_subject) ? $result->admin_has_send_password_reset_link_subject : ''), "class=\"form-control width-auto inline-block\""); ?>
                                    <?php echo form_error('admin_has_send_password_reset_link_subject') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="col-md-2">Body Text:</label>
                                    <?php echo form_textarea('admin_has_send_password_reset_link_body', set_value('admin_has_send_password_reset_link_body', isset($result->admin_has_send_password_reset_link_body) ? $result->admin_has_send_password_reset_link_body : ''), "class=\"form-control width-auto inline-block col-md-6\""); ?>
                                    <?php echo form_error('admin_has_send_password_reset_link_body') ?>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="admin_fields_set">
                        <div class="form-group" style="margin-left: 13px;"><strong>“Reset Password Request” Email</strong></div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="col-md-2">Subject Line:</label>
                                    <?php echo form_input('reset_pwd_request_subject', set_value('reset_pwd_request_subject', isset($result->reset_pwd_request_subject) ? $result->reset_pwd_request_subject : ''), "class=\"form-control width-auto inline-block\""); ?>
                                    <?php echo form_error('reset_pwd_request_subject') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="col-md-2">Body Text:</label>
                                    <?php echo form_textarea('reset_pwd_request_body_text', set_value('reset_pwd_request_body_text', isset($result->reset_pwd_request_body_text) ? $result->reset_pwd_request_body_text : ''), "class=\"form-control width-auto inline-block col-md-6\""); ?>
                                    <?php echo form_error('reset_pwd_request_body_text') ?>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Save &rarr;")) ?>
                    <?php //echo form_button(array("type" => "Reset", "class" => "btn btn-danger", "content" => "Reset")) ?>

                </div>
                <?php echo form_close(); ?>
            </div>
        </div>

    </div>
</div>