
<header class="all  pt-2 pb-2">
<div class="container">
    <div class="row">


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<!-- <h1 class="logo-title"><a href="<?php //echo site_url(); ?>">American <span>Ways</span></a></h1> -->
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
  

  <?php
echo getFlashMessage('flash_error');
echo getFlashMessage('flash_success');
?>
        
        <h1 class="signin py-2 px-2">Create your password</h1>
        <form action="" class="form-horizontal" method="post" autocomplete="off">
       
            <div class="form-group">
               
            <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_password('new_password', '', "id=\"inputCreatePassword\" class=\"form-control\" autocomplete=\"off\" placeholder=\"Password\""); ?>
                        <?php echo form_error('new_password') ?>
                    </div>
                </div>

                <div class="row mt-3">
                <div class="col-lg-12">
                        <?php echo form_password('conf_password', '', "id=\"inputConfirmPassword\" class=\"form-control\" autocomplete=\"off\" placeholder=\"Confirm Password\""); ?>
                        <?php echo form_error('conf_password') ?>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                    <?php echo form_button(array("type" => "submit", "class" => "btn btn-success btn-block sign-in", "content" => "SUBMIT")) ?>
            </div>
        </form>
    
    


</div>






