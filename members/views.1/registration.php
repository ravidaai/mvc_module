
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4">
                        <?php echo form_open('', "class=\"\" autocomplete=\"off\"") ?>

                        <div class="form-group">
                            <label for="inputFullName">Full Name</label>
                            <?php echo form_input('full_name', set_value('full_name'), "id=\"inputFullName\" class=\"form-control\" placeholder=\"Full Name\""); ?>
                            <?php echo form_error('full_name') ?>
                        </div>

                        <div class="form-group">
                            <label for="inputUserName">User Name</label>
                            <?php echo form_input('user_name', set_value('user_name'), "id=\"inputUserName\" class=\"form-control\" placeholder=\"User Name\""); ?>
                            <?php echo form_error('user_name') ?>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <?php echo form_input('email', set_value('email'), "id=\"inputEmail\" class=\"form-control\" placeholder=\"Email\""); ?>
                            <?php echo form_error('email') ?>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <?php echo form_dropdown('status', isset($status)?$status:'', isset($result->status)?$result->status:'', "class=\"form-control\"") ?>
                            <?php echo form_error('status') ?>
                        </div>

                        <div class="form-group">
                            <label for="inputCreatePassword">Password</label>
                            <?php echo form_password('pwd', '', "id=\"inputCreatePassword\" class=\"form-control\" placeholder=\"Password\""); ?>
                            <?php echo form_error('pwd') ?>
                        </div>

                        <div class="form-group">
                            <label for="inputConfirmPassword">Confirm Password</label>
                            <?php echo form_password('conf_password', '', "id=\"inputConfirmPassword\" class=\"form-control\" placeholder=\"Cofirm Password\""); ?>
                            <?php echo form_error('conf_password') ?>
                        </div>


                        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Register &rarr;")) ?>
                        <?php echo form_button(array("type" => "reset", "class" => "btn btn-danger", "content" => "Reset")) ?>

                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" />

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
