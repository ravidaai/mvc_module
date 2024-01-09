<div class="container">
    <div class="row">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-10">
            <h2 style="color: #9a9898;font-size: 25px;">Support</h2>
        </div>
        <div class="col-lg-1">
        </div>
    </div>


    <div class="row mt-2">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-10">
            <!-- <h3>Course Home</h3> -->
            <p><?php echo $this->setting_model->get('support_page_header_text'); ?></p>

            <?php echo form_open('', "class=\"\" autocomplete=\"off\"") ?>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo form_textarea('support_content', set_value('support_content'), "class=\"form-control\""); ?>
                    <?php echo form_error('support_content') ?>
                </div>
            </div>
            <div class="panel-footer">
                <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Submit")) ?>
                <a href="<?php echo site_url("dashboard/course_home"); ?>" class="btn btn-danger">Cancel</a>
            </div>
            <?php echo form_close(); ?>
        </div>
        <div class="col-lg-1">
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-12">
        </div>
    </div>






</div>