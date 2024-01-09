<?php
echo getFlashMessage('flash_error');
echo getFlashMessage('flash_success');
?>

<?php echo form_open('', "class=\"form-horizontal\" autocomplete=\"off\"") ?>

    <div class="login-body">
        <div class="text-center mb-15"><img src="https://via.placeholder.com/150?text=LOGO"></div>
        <div class="login-title text-center"><strong>Welcome</strong>, Please login</div>
        <form action="" class="form-horizontal" method="post">
            <div class="form-group">
                <div class="col-md-12">
                    <?php echo form_input('user_name', set_value('user_name'), "id=\"inputUserName\" class=\"form-control\" placeholder=\"User Name / Email\" required autofocus "); ?>
                    <?php echo form_error('user_name') ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <?php echo form_password('pwd', '', "id=\"inputPassword\" class=\"form-control\" placeholder=\"Password\" required"); ?>
                    <?php echo form_error('pwd') ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <a href="<?php echo site_url('members/ForgotPassword'); ?>" class="btn btn-link btn-block">Forgot your password?</a>
                </div>
                <div class="col-md-6">
                    <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Login&rarr;")) ?>
                    <?php echo form_button(array("type" => "reset", "class" => "btn btn-danger", "content" => "Reset")) ?>

                </div>
            </div>
        </form>
    </div>
    <div class="login-footer">
       
        <p style="text-align:center;">
        &copy; <?php echo date('Y'); ?> <?php echo $this->config->item('copyright'); ?>
        </p>
            
       

    </div>

</form>

