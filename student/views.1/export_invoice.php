<?php echo form_open('', "class=\"\" autocomplete=\"off\"") ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $page_header ?></h3>

                </div>

                <div class="panel-body">
                    <div class="clearfix"></div>

                    <div class="panel-body">
                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Enter ID/Email/Name <sup>*</sup></label>
                            <div class="col-md-6">
                                <?php echo form_input('student', set_value('student'), "id=\"inputFullName\" class=\"form-control input-md\" "); ?>
                                <?php echo form_error('student') ?>
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-4 control-label">Start date<sup>*</sup></label>
                            <div class="col-md-6">
                                <?php echo form_input('start_date', set_value('start_date'), "id=\"start_date_from\" class=\"form-control input-md\""); ?>
                                <?php echo form_error('start_date') ?>
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-4 control-label">End date<sup>*</sup></label>
                            <div class="col-md-6">
                                <?php echo form_input('end_date', set_value('end_date'), "id=\"end_date_to\" class=\"form-control input-md\""); ?>
                                <?php echo form_error('end_date') ?>
                            </div>
                        </div>



                    </div>
                    <div class="panel-footer">
                        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Export Invoice &rarr;")); ?>
                        <?php echo form_button(array("type" => "Reset", "class" => "btn btn-danger", "content" => "Reset")); ?>

                    </div>

                </div>
            </div>

        </div>


    </div>

<?php echo form_close(); ?>


