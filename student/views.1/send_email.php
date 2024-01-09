

<img src="<?php echo site_url('assets/site/img/logo.png') ?>" alt="logo" class="img-responsive" style="padding: 10px;">

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
                            <label class="col-md-4 control-label">Full Name</label>
                            <div class="col-md-6">
                                <?php
                                echo $mem->first_name.' '.$mem->last_name;
                                ?>
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Email To</label>
                            <div class="col-md-6">
                                <?php
                                echo $mem->email;
                                ?>
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Subject</label>
                            <div class="col-md-6">
                                <?php echo form_input('subject', set_value('subject',isset($result->subject)?$result->subject:''), "id=\"subject\" class=\"form-control input-md\" "); ?>
                                <?php echo form_error('subject') ?>
                            </div>
                        </div>


                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Compose Message</label>
                            <div class="col-md-6">
                                <?php echo form_textarea('message', set_value('message',isset($result->message)?$result->message:''), "id=\"message\" class=\"form-control input-md\" "); ?>
                                <?php echo form_error('message') ?>
                            </div>
                        </div>

                        <script>
                            CKEDITOR.replace('message', {
                                filebrowserBrowseUrl: '<?php echo site_url('assets/kcfinder/browse.php'); ?>',
                                filebrowserUploadUrl: '<?php echo site_url('assets/kcfinder/upload.php'); ?>',
                                extraPlugins: 'tableresize',
                            });
                        </script>

                    </div>
                    <div class="panel-footer">
                        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Send Email &rarr;")); ?>
                        <?php echo form_button(array("type" => "Reset", "class" => "btn btn-danger", "content" => "Reset")); ?>

                    </div>

                </div>
            </div>

        </div>


    </div>

<?php echo form_close(); ?>


