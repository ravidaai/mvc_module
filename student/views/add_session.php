<?php echo form_open_multipart('', "class=\"\" autocomplete=\"off\"") ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
            <?php
                $groupQuery = $this->members_model->fromId($this->uri->segment(3));
                ?>
                <h3 class="panel-title"><?php echo $groupQuery->institution . ' ' . $page_header ?></h3>
                <ul>
                    <li><a href="<?php echo $this->agent->referrer(); ?>" class="btn btn-success pull-right" role="button" style="margin-right: 15px;"><i class="fa fa-backward"></i> Back</a></li>
                </ul>
            </div>

            <div class="panel-body">
                <div class="clearfix"></div>
                <div class="form-group required row">
                    <label class="col-md-4 control-label">Session Name</label>
                    <div class="col-md-6">
                        <?php echo form_input('session_name', set_value('session_name', isset($result->session_name) ? $result->session_name : ''), "id=\"inputFullName\" class=\"form-control input-md\" placeholder=\"Session Name\""); ?>
                        <?php echo form_error('session_name') ?>
                    </div>
                </div>

                <div class="form-group required row">
                    <label class="col-md-4 control-label">Start Date</label>
                    <div class="col-md-6">
                        <?php echo form_input('start_date', set_value('start_date', isset($result->start_date) ? $result->start_date : current_date()), "class=\"form-control \"  id=\"end_date\" "); ?>
                        <?php echo form_error('start_date') ?>
                    </div>
                </div>

                <div class="form-group required row">
                    <label class="col-md-4 control-label">End Date</label>
                    <div class="col-md-6">
                        <?php echo form_input('end_date', set_value('end_date', isset($result->end_date) ? $result->end_date : ''), "class=\"form-control \"  id=\"start_date_from\""); ?>
                        <?php echo form_error('end_date') ?>
                    </div>
                </div>

                <div class="form-group required row">
                    <label class="col-md-4 control-label">Per Student Rate</label>
                    <div class="col-md-6">
                        <?php echo form_input('per_student_rate', set_value('per_student_rate', isset($result->per_student_rate) ? $result->per_student_rate : ''), "class=\"form-control \" "); ?>
                        <?php echo form_error('per_student_rate') ?>
                    </div>
                </div>

                <div class="form-group required row">
                    <label class="col-md-4 control-label">Payment Due Date</label>
                    <div class="col-md-6">
                        <?php echo form_input('payment_due_date', set_value('payment_due_date', isset($result->payment_due_date) ? $result->payment_due_date : ''), "class=\"form-control \"  id=\"payment_due_date\""); ?>
                        <?php echo form_error('payment_due_date') ?>
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