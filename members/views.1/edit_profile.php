<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4">
                        <?php echo form_open('', "class=\"\" autocomplete=\"off\"") ?>
                            <div class="form-group">
                                <label>Full Name</label>

                                <?php echo form_input('full_name', set_value('full_name',isset($result->full_name)?$result->full_name:''), "class=\"form-control\" placeholder=\"Change Full Name\""); ?>
                                <?php echo form_error('full_name') ?>
                            </div>

                        <div class="form-group">
                            <label>Email</label>

                            <?php echo form_input('email', set_value('email', isset($result->email)?$result->email:''), "class=\"form-control\" placeholder=\"Change Email\""); ?>
                            <?php echo form_error('email') ?>
                        </div>



                        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Change Profile &rarr;")) ?>
                        <?php echo form_button(array("type" => "Reset", "class" => "btn btn-danger", "content" => "Reset")) ?>


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
