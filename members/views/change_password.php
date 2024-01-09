<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4">
                        <?php echo form_open('', "class=\"\" autocomplete=\"off\"") ?>
                            <div class="form-group">
                                <label>Previous Password</label>

                                <?php echo form_password('old_password', '', "id=\"inputOldPassword\" class=\"form-control\" placeholder=\"Enter previous password\""); ?>
                                <?php echo form_error('old_password') ?>
                            </div>

                        <div class="form-group">
                            <label>New Password</label>

                            <?php echo form_password('new_password', '', "id=\"inputNewPassword\" class=\"form-control\"  placeholder=\"Enter new password\""); ?>
                            <?php echo form_error('new_password') ?>
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>

                            <?php echo form_password('conf_password', '', "id=\"inputConfirmPassword\" class=\"form-control\" placeholder=\"Enter cofirm password\""); ?>
                            <?php echo form_error('conf_password') ?>
                        </div>

                        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Change Password &rarr;")) ?>
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
