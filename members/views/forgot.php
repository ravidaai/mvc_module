<div class="login-box animated fadeInDown">

    <div class="login-body">
    <h1 class="signin py-2 px-2">Forgot Password?</h1>
        <?php echo form_open('', "class=\"form-horizontal form-signin\" autocomplete=\"off\"") ?>
        <p>
        <?php
        echo getFlashMessage('flash_error');
        echo getFlashMessage('flash_success');
        ?>
        </p>
            <div class="form-group">
                <div class="col-md-12">
                    <?php echo form_input('user_name', set_value('user_name'), "id=\"inputUserName\" class=\"form-control\" placeholder=\"User ID\" required autofocus "); ?>
                    <?php echo form_error('user_name') ?>
                </div>
            </div>

            <div class="form-group">

                <div class="col-md-12">
                    <?php echo form_button(array("type" => "submit", "class" => "btn btn-success btn-block sign-in", "content" => "Submit")) ?>
                    <!-- <a href="<?php //echo site_url('xps') ?>"  class="btn btn-success">&larr; Login</a> -->
                </div>
                
            </div>

        <?php echo form_close(); ?>
    </div>

</div>
