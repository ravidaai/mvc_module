<div class="row">
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $page_header ?></h3>

            </div>

            <div class="panel-body">
                <div class="clearfix"></div>
                <?php echo form_open_multipart('', "class=\"\" autocomplete=\"off\"") ?>
                <div class="panel-body">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="">
                                    <label>Credit Card Registration</label>
                                        <select name="credit_card_registration" class="form-control">
<option value = "N" <?php echo strcasecmp($result->credit_card_registration, 'N') == 0 ? "selected" : NULL ?>>CLOSED</option>
<option value = "Y" <?php echo strcasecmp($result->credit_card_registration, 'Y') == 0 ? "selected" : NULL ?>>OPEN</option>
                                        </select>
                                        <?php
                                        //echo form_checkbox('credit_card_registration', set_value('credit_card_registration', $result->credit_card_registration), strcasecmp($result->credit_card_registration, 'Y') == 0 ? TRUE : FALSE);
                                        ?>
                                    
                                    <?php echo form_error('credit_card_registration') ?>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <label>Course Fee (USD)</label>
                                <?php echo form_input('course_rate', set_value('course_rate', isset($result->course_rate) ? $result->course_rate : ''), "class=\"form-control\""); ?>
                                <?php echo form_error('course_rate') ?>
                            </div>

                            <div class="col-md-5">
                                <label>Course Access (Number of Days)</label>
                                <?php echo form_input('course_access_day', set_value('course_access_day', isset($result->course_access_day) ? $result->course_access_day : ''), "class=\"form-control\""); ?>
                                <?php echo form_error('course_access_day') ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Course Title</label>
                                <?php echo form_input('course_title', set_value('course_title', isset($result->course_title) ? $result->course_title : ''), "class=\"form-control\""); ?>
                                <?php echo form_error('course_title') ?>
                            </div>
                        </div>
                    </div>


                   


                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Course Home Header Text</label>
                                <?php
                                $options = array(
                                    "class"=>"form-control",
                                    'name' => 'course_home_header_text',
                                    'rows' => '2',
                                    'cols' => '50',
                                    'value'=> set_value('course_home_header_text', isset($result->course_home_header_text) ? $result->course_home_header_text : '')
                                );
                                echo form_textarea($options);
                                ?>
                                <?php //echo form_textarea('course_home_header_text', set_value('course_home_header_text', isset($result->course_home_header_text) ? $result->course_home_header_text : ''), array("class"=>"form-control", 'rows' => '2','cols' => '50')); ?>
                                <?php echo form_error('course_home_header_text') ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Course Evaluation Header Text</label>
                                <?php
                                $options = array(
                                    "class"=>"form-control",
                                    'name' => 'course_evaluation_header_text',
                                    'rows' => '2',
                                    'cols' => '50',
                                    'value'=> set_value('course_evaluation_header_text', isset($result->course_evaluation_header_text) ? $result->course_evaluation_header_text : '')
                                );
                                echo form_textarea($options);
                                ?>

                                <?php //echo form_textarea('course_evaluation_header_text', set_value('course_evaluation_header_text', isset($result->course_evaluation_header_text) ? $result->course_evaluation_header_text : ''), "class=\"form-control\""); ?>
                                <?php echo form_error('course_evaluation_header_text') ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Support Page Header Text</label>
                                <?php
                                $options = array(
                                    "class"=>"form-control",
                                    'name' => 'support_page_header_text',
                                    'rows' => '2',
                                    'cols' => '50',
                                    'value'=> set_value('support_page_header_text', isset($result->support_page_header_text) ? $result->support_page_header_text : '')
                                );
                                echo form_textarea($options);
                                ?>
                                <?php //echo form_textarea('support_page_header_text', set_value('support_page_header_text', isset($result->support_page_header_text) ? $result->support_page_header_text : ''), "class=\"form-control\""); ?>
                                <?php echo form_error('support_page_header_text') ?>
                            </div>
                        </div>
                    </div>

                   <?php /* ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>“About This Course” Body Text</label>
                                <?php echo form_textarea('about_this_course_body_text', set_value('about_this_course_body_text', isset($result->about_this_course_body_text) ? $result->about_this_course_body_text : ''), "class=\"form-control\""); ?>
                                <?php echo form_error('about_this_course_body_text') ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>“Terms & Privacy” Body Text</label>
                                <?php echo form_textarea('terms_and_privacy_body_text', set_value('terms_and_privacy_body_text', isset($result->terms_and_privacy_body_text) ? $result->course_home_header_text : ''), "class=\"form-control\""); ?>
                                <?php echo form_error('terms_and_privacy_body_text') ?>
                            </div>
                        </div>
                    </div>

                    <?php */ ?>

                    <div class="panel-footer">
                        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Save &rarr;")) ?>
                        

                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>

        </div>
    </div>