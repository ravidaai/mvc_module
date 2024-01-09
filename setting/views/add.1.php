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
                                <div class="col-md-6">
                                    <label>Course Fee (USD)</label>
                                    <?php echo form_input('course_rate', set_value('course_rate',isset($result->course_rate)?$result->course_rate:''), "class=\"form-control\""); ?>
                                    <?php echo form_error('course_rate') ?>
                                </div>

                                <div class="col-md-6">
                                    <label>Course Access (Number of Days)</label>
                                    <?php echo form_input('course_access_day', set_value('course_access_day',isset($result->course_access_day)?$result->course_access_day:''), "class=\"form-control\""); ?>
                                    <?php echo form_error('course_access_day') ?>
                                </div>
                            </div>
                        </div>   
                    
                    <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Web title</label>

                                    <?php echo form_input('title', set_value('Title',isset($result->title)?$result->title:''), "class=\"form-control\""); ?>
                                    <?php echo form_error('title') ?>
                                    </div>
                                </div>

                        </div>

                        

                       

                        

                        

                        

                       

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Email Primary</label>
                                    <?php echo form_input('email_primary', set_value('Email Primary',isset($result->email_primary)?$result->email_primary:''), "class=\"form-control\""); ?>
                                    <?php echo form_error('email_primary') ?>
                                </div>

                                


                            </div>
                        </div>

                        


                        

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                            <label>Google Analytic code</label>
                            <?php echo form_textarea('google_analytic_code', set_value('google_analytic_code', isset($result->google_analytic_code)?$result->google_analytic_code:''), "class=\"form-control\""); ?>
                            <?php echo form_error('google_analytic_code') ?>
                                    </div></div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Google verification code</label>
                                    <?php echo form_input('google_verification_code', set_value('google_verification_code',isset($result->google_verification_code)?$result->google_verification_code:''), "class=\"form-control\""); ?>
                                    <?php echo form_error('google_verification_code') ?>
                                </div>

                                
                            </div>
                        </div>

                       

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                            <label>Meta Keyword</label>
                            <?php echo form_textarea('meta_keyword', set_value('meta_keyword', isset($result->meta_keyword)?$result->meta_keyword:''), "class=\"form-control\""); ?>
                            <?php echo form_error('meta_keyword') ?>
                                    </div>

                                    <div class="col-md-6">
                            <label>Meta Description</label>
                            <?php echo form_textarea('meta_description', set_value('meta_description', isset($result->meta_description)?$result->meta_description:''), "class=\"form-control\""); ?>
                            <?php echo form_error('meta_description') ?>
                                    </div>
                                </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                            <label>Course Home Text One</label>
                            <?php echo form_textarea('course_home_text_one', set_value('course_home_text_one', isset($result->course_home_text_one)?$result->course_home_text_one:''), "class=\"form-control\""); ?>
                            <?php echo form_error('course_home_text_one') ?>
                                    </div>

                                    <div class="col-md-6">
                            <label>Course Home Text Two</label>
                            <?php echo form_textarea('course_home_text_two', set_value('course_home_text_two', isset($result->course_home_text_two)?$result->course_home_text_two:''), "class=\"form-control\""); ?>
                            <?php echo form_error('course_home_text_two') ?>
                                    </div>
                                </div>
                        </div>

                       

                        
                    </div>
                    <div class="panel-footer">
                        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Submit &rarr;")) ?>
                        <?php echo form_button(array("type" => "Reset", "class" => "btn btn-danger", "content" => "Reset")) ?>

                    </div>
                    <?php echo form_close(); ?>
            </div>
        </div>

    </div>
</div>