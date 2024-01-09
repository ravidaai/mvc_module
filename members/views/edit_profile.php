
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
        <div class="panel-heading">
                <h3 class="panel-title" style="padding-left:20px;"><?php echo $page_header ?></h3>
                <ul>

                    <li><a href="<?php echo $this->agent->referrer(); ?>" class="btn btn-success pull-right" role="button" style="margin-right: 15px;"><i class="fa fa-backward"></i> Back</a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4">
                        <?php echo form_open('', "class=\"\" autocomplete=\"off\"") ?>
                            <div class="form-group">
                                <label>User ID</label>

                                <?php echo form_input('user_name', set_value('user_name',isset($result->user_name)?$result->user_name:''), "class=\"form-control\" placeholder=\"User ID\""); ?>
                                <?php echo form_error('user_name') ?>
                            </div>

                        <div class="form-group">
                            <label>Email</label>

                            <?php echo form_input('email', set_value('email', isset($result->email)?$result->email:''), "class=\"form-control\" placeholder=\"Change Email\""); ?>
                            <?php echo form_error('email') ?>
                        </div>

                        <!--
                        <div class="form-group">
                                <label>Previous Password</label>

                                <?php //echo form_password('old_password', '', "id=\"inputOldPassword\" class=\"form-control\" placeholder=\"Enter previous password\""); ?>
                                <?php //echo form_error('old_password') ?>
                            </div>
-->
                        <div class="form-group">
                            <label>New Password</label>

                            <?php echo form_password('new_password', '', "id=\"inputNewPassword\" class=\"form-control\"  placeholder=\"New password\""); ?>
                            <?php echo form_error('new_password') ?>
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>

                            <?php echo form_password('conf_password', '', "id=\"inputConfirmPassword\" class=\"form-control\" placeholder=\"Confirm password\""); ?>
                            <!-- <small id="emailHelp" class="form-text">Combination: </small> -->
                            <?php echo form_error('conf_password') ?>
                        </div>

                        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Save &rarr;")) ?>
                        <?php //echo form_button(array("type" => "Reset", "class" => "btn btn-danger", "content" => "Reset")) ?>

                        <?php echo form_close(); ?>
                    </div>
                    <!-- /.col-lg-6 (nested) -->

                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
