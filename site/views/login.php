<header class="all  pt-2 pb-2">
<div class="container">
    <div class="row">


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<?php /* ?>
<h1 class="logo-title"><a href="<?php echo site_url(); ?>">American <span>Ways</span></a></h1>
<?php */?>
</div>


    </div>
</div>
</header>

<main class="all py-5 full-height ">
<div class="container">
        
<div class="row">

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-5 d-flex justify-content-center">



<?php echo form_open('', "class=\"form-horizontal col-lg-5 loginForm\" autocomplete=\"off\"") ?>
<?php if(isset($is_verified)): ?>
        <div class="alert alert-success">
                <p class="" style="text-align:center;">
                <?php
                        echo $is_verified;
                        ?>
                </p>
        </div>
<?php endif;?>
  

        

        <div class="row">
                <div class="col-lg-12">
                <?php
        echo getFlashMessage('flash_error');
        echo getFlashMessage('flash_success');
        ?>
                </div>
        </div>
        
        <h1 class="signin py-2 px-2">Sign in to your account</h1>
        <form action="" class="form-horizontal" method="post" autocomplete="off">
       
            <div class="form-group">
               
                    <?php echo form_input('user_name', set_value('user_name'), "id=\"inputUserName\" class=\"form-control-login\" placeholder=\"User ID\" autocomplete=\"off\" required autofocus "); ?>
                    <?php echo form_error('user_name') ?>
               
            </div>
            <div class="form-group">
               
                    <?php echo form_password('pwd', '', "id=\"inputPassword\" class=\"form-control-login\" placeholder=\"Password\" autocomplete=\"off\" required"); ?>
                    <?php echo form_error('pwd') ?>
               
            </div>
            <div class="form-group">

                    <?php echo form_button(array("type" => "submit", "class" => "btn btn-success btn-block sign-in", "content" => "SIGN IN")) ?>
                    <div class="clearfix"></div>
                    <a href="<?php echo site_url('ForgotPassword'); ?>" class="mt-2 d-block">Forgot your password?</a>

               
            </div>
        </form>
    
    


</div>


