<header class="all  pt-2 pb-2">
<div class="container">
    <div class="row">


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<?php /* ?>
<h1 class="logo-title"><a href="<?php echo site_url(); ?>">American <span>Ways</span></a></h1>
<?php */ ?>
</div>


    </div>
</div>
</header>

<main class="all py-5">
<div class="container">
<div class="row">
<div class="col-lg-2">

</div>
<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">

<div class="row">
                <div class="form-group col-lg-12">
                <?php
        echo getFlashMessage('flash_error');
        echo getFlashMessage('flash_success');
?>


<h1 class="enroll-title">Contact Us</h1>

</div>
</div>


        <?php echo form_open(site_url('contact'), "method=\"post\" autocomplete=\"off\" ") ?>
       


            
            <div class="row">
                <div class="form-group col-lg-6">
                    <?php echo form_input('full_name', set_value('full_name'), "id=\"full_name\" class=\"form-control\" maxlength=\"20\" placeholder=\"Name\""); ?>
                    <?php echo form_error('full_name') ?>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-lg-6">
                <?php echo form_input('email', set_value('email'), "id=\"input_email\" class=\"form-control\" placeholder=\"Email\""); ?>
                    <?php echo form_error('email') ?>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-lg-8">
                <?php echo form_textarea('message', set_value('message'), "class=\"form-control\" placeholder=\"Message\""); ?>
                    <?php echo form_error('message') ?>
                </div>
            </div>

            
        
       
        <div class="row">
                <div class="form-group col-lg-2 required">
                    <?php echo form_button(array("type" => "submit", "class" => "btn  enroll-submit-btn", "content" => "Submit", "data-inline"=>"true")) ?>
                </div>
                <div class="form-group col-lg-10"></div>
            </div>
        <?php echo form_close(); ?>
</div>

<div class="col-lg-2"></div>

</div>
</div>
</main>



