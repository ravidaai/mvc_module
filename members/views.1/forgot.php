<div class="login-box animated fadeInDown">

    <div class="login-body">
    <div class="text-center mb-15"><img src="https://via.placeholder.com/150?text=LOGO"></div>
        <div class="login-title text-center"><strong>Enter</strong>,Your Email</div>
        <?php echo form_open('', "class=\"form-horizontal form-signin\" autocomplete=\"off\"") ?>
        <p>
        <?php
        echo getFlashMessage('flash_error');
        echo getFlashMessage('flash_success');
        ?>
        </p>
            <div class="form-group">
                <div class="col-md-12">
                    <?php echo form_input('user_name', set_value('user_name'), "id=\"inputUserName\" class=\"form-control\" placeholder=\"User Name / Email\" required autofocus "); ?>
                    <?php echo form_error('user_name') ?>
                </div>
            </div>

            <div class="form-group">

                <div class="col-md-6">
                    <?php echo form_button(array("type" => "submit", "class" => "btn btn-primary", "content" => "Submit")) ?>
                    <a href="<?php echo site_url('members/login') ?>"  class="btn btn-success">&larr; Login</a>
                </div>
                <div class="col-md-6">
                
                </div>
            </div>

        <?php echo form_close(); ?>
    </div>

</div>
