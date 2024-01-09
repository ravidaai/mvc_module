<header class="all  pt-2 pb-2">
        <div class="container">
                <div class="row">


                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?php /* ?><h1 class="logo-title"><a href="<?php echo site_url(); ?>">American <span>Ways</span></a></h1><?php */ ?>
                        </div>


                </div>
        </div>
</header>

<main class="all py-5 full-height ">
        <div class="container">

                <div class="row">

                        <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-5 d-flex justify-content-center"> -->
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mt-5">

                                <?php echo form_open('', "class=\"form-horizontal loginForm\" autocomplete=\"off\"") ?>
                                <?php if (isset($is_verified)) : ?>
                                        <div class="alert alert-success">
                                                <p class="" style="text-align:center;">
                                                        <?php
                                                        echo $is_verified;
                                                        ?>
                                                </p>
                                        </div>
                                <?php endif; ?>


                                <?php
                                //echo getFlashMessage('flash_error');
                                //echo getFlashMessage('flash_success');
                                ?>

                                <h1 class="signin py-2 px-2">Forgot Your Password? </h1>
                                <?php $show_input = true; ?>
                                <?php if (getFlashMessage('flash_success')) : ?>
                                        <?php echo getFlashMessage('flash_success') ?>
                                        <?php $show_input = false; ?>
                                <?php endif; ?>

                                <?php if (getFlashMessage('flash_error')) : ?>
                                        <p class="text-center p-4" style="color:red;">
                                                <?php echo getFlashMessage('flash_error') ?>
                                        </p>
                                <?php endif; ?>

                                <?php if (empty(getFlashMessage('flash_error')) and empty(getFlashMessage('flash_success'))) : ?>
   
                                <p class="text-center" style="word-wrap: break-word;"> Enter your email address below and <br> we will send you a link to reset your password.</p>
                                <?php endif; ?>

                                <?php if ($show_input) : ?>
                                        <form action="" class="form-horizontal" method="post" autocomplete="off">

                                                <div class="form-group row">

                                                        <label class="col-sm-2 col-form-label"><strong>Email</strong></label>
                                                        <div class="col-sm-10">
                                                                <?php echo form_input('user_name', set_value('user_name'), "id=\"inputUserName\" class=\"form-control-login\" placeholder=\"\" autocomplete=\"off\" required autofocus "); ?>
                                                                <?php echo form_error('user_name') ?>
                                                        </div>

                                                </div>

                                                <div class="form-group">
                                                        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success btn-block sign-in", "content" => "SUBMIT")) ?>
                                                </div>
                                        </form>
                                <?php endif; ?>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>
</div>
</div>