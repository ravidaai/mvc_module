



<?php echo form_open(site_url('student/customMail'), "class=\"\" autocomplete=\"off\"") ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $page_header ?></h3>
                    <ul>

                       

                        <li><a href="<?php echo $this->input->post('back_url'); ?>"
                               class="btn btn-success pull-right"
                               role="button" style="margin-right: 15px;"><i class="fa fa-backward"></i> Back</a></li>
                    </ul>
                </div>

                <div class="panel-body">
                    <div class="clearfix"></div>

                    <div class="panel-body">
                        

                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Email To</label>
                            <div class="col-md-6">
                            <?php echo form_input("emails",set_value('emails',$email_to), "id=\"emails\" class=\"form-control input-md\""); ?>
                            <?php echo form_error('emails') ?>
                            
                            <?php echo form_hidden("send_email_to",set_value('send_email_to',$send_email_to), "id=\"send_email_to\""); ?>
                        </div>

                        </div>

                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Subject</label>
                            <div class="col-md-6">
                                <?php echo form_input('subject', set_value('subject'), "id=\"subject\" class=\"form-control input-md\" "); ?>
                                <?php echo form_error('subject') ?>
                            </div>
                        </div>


                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Compose Message</label>
                            <div class="col-md-6">
                                <?php echo form_textarea('message', set_value('message'), "id=\"message\" class=\"form-control input-md\" "); ?>
                                <?php echo form_error('message') ?>
                            </div>
                        </div>

                       

                    </div>
                    <div class="panel-footer">
                        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Send Email &rarr;")); ?>
                        <?php //echo form_button(array("type" => "Reset", "class" => "btn btn-danger", "content" => "Reset")); ?>
                        <input type="hidden" value="<?php echo $this->input->post('back_url'); ?>" name="back_url">

                    </div>

                </div>
            </div>

        </div>


    </div>

<?php echo form_close(); ?>


