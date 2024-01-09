<?php
echo getFlashMessage('flash_error');
echo getFlashMessage('flash_success');
?>
 <h1 class="signin py-2 px-2">Sign in to your account</h1>
<?php echo form_open('', "class=\"form-horizontal\" autocomplete=\"off\"") ?>

    <div class="login-body">
 
            <div class="form-group">
                <div class="col-md-12">
                    <?php echo form_input('user_name', set_value('user_name'), "id=\"inputUserName\" class=\"form-control\" placeholder=\"User ID\" required autofocus "); ?>
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
                <div class="col-md-12">
                <?php echo form_button(array("type" => "submit", "class" => "btn btn-success btn-block sign-in", "content" => "Login&rarr;")) ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                <a href="<?php echo site_url('members/ForgotPassword'); ?>" class="">Forgot your password?</a>
                </div>
            </div>
        
    </div>
    <?php echo form_close(); ?>
    <div class="login-footer">
       
        <p style="text-align:center;">
       <?php echo $this->config->item('copyright'); ?>
        </p>
            
       

    </div>



