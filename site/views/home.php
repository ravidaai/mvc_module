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

<?php
        echo getFlashMessage('flash_error');
        echo getFlashMessage('flash_success');
?>


<h1 class="enroll-title">Enroll</h1>
<p class="enroll-help-text">
    Course: <?php echo $this->setting_model->get('course_title') ?><br>
    Course Fee: $<?php echo $this->setting_model->get('course_rate').'.00'; ?>, &nbsp; Duration: <?php echo $this->setting_model->get('course_access_day'); ?> days from enrollment date
    
</p>
    <!-- <div class='form-row row'>
            <div class='col-md-12 error form-group d-none'>
            <div class="alert alert-danger fade show" role="alert">
                    Please correct the errors and try again.
                    
                </div>
            </div>
        </div> -->

        
        <?php echo form_open(site_url('enroll'), "method=\"post\" autocomplete=\"off\" class=\"require-validation\" data-cc-on-file=\"false\"  data-stripe-publishable-key=\"".$this->config->item('stripe_key')."\" id=\"payment-form\"") ?>
        <div class="row">
            <div class="col-lg-12">
                <h2 class="form-group-title pl-2">Personal Information</h2>
            </div>
        </div>

        <div class="form-block ">
            
            <div class="row">
                <div class="form-group col-lg-4">
                    <?php echo form_input('first_name', set_value('first_name'), "id=\"input_first_name\" class=\"form-control\" maxlength=\"20\" placeholder=\"First Name\""); ?>
                    <?php echo form_error('first_name') ?>
                </div>

                <div class="form-group col-lg-4">
                    <?php echo form_input('last_name', set_value('last_name'), "id=\"input_last_name\" class=\"form-control\" maxlength=\"20\" placeholder=\"Last Name\""); ?>
                    <?php echo form_error('last_name') ?>
                </div>

                <div class="form-group col-lg-4">
                        <?php echo form_dropdown('country', $countryList, set_value('country'), "class=\"form-control\"") ?>
                        <?php echo form_error('country') ?>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_input('institution', set_value('institution'), "id=\"input_institution\" class=\"form-control\" maxlength=\"50\" placeholder=\"Institution\""); ?>
                        <small class="form-text text-muted">Institution you currently attend or will attend in the United States.</small>
                        <?php echo form_error('institution') ?>
                    </div>
                </div>
            </div>
            

          
            <div class="row">
                <div class="form-group col-lg-4">
                    <?php echo form_input('email', set_value('email'), "id=\"input_email\" class=\"form-control\" placeholder=\"Email\""); ?>
                    <?php echo form_error('email') ?>
                </div>

                <div class="form-group col-lg-4">
                        <?php echo form_password('pwd', '', "id=\"inputCreatePassword\" class=\"form-control\" autocomplete=\"off\" placeholder=\"Password\""); ?>
                        <?php echo form_error('pwd') ?>
                    </div>

                    <div class="form-group col-lg-4">
                        <?php echo form_password('conf_password', '', "id=\"inputConfirmPassword\" class=\"form-control\" autocomplete=\"off\" placeholder=\"Confirm Password\""); ?>
                        <?php echo form_error('conf_password') ?>
                    </div>

                </div>

                <!-- <div class="row">
                    <div class="col-lg-12">
                    <small class="form-text text-muted">Combination: one lowercase letter, one uppercase letter, least one number </small>
                    </div>
                </div> -->
            

        </div>
       
        <div class="row">
            <div class="col-lg-12">
                <h2 class="pl-2 form-group-title">Payment Information</h2>
            </div>
        </div>

        <div class="form-block ">
        <div class="row">
                <div class="col-lg-12">
                    <p>Amount your credit card will be charged: US $<?php echo $this->setting_model->get('course_rate').'.00'; ?></p>
                    
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-5 required">
                    <?php echo form_input('card-number', set_value('card-number'), "id=\"card-number\" class=\"form-control card-number\" maxlength=\"16\" placeholder=\"Card Number\""); ?>
                    <?php echo form_error('card-number') ?>
                </div>

                <div class="form-group col-lg-2 required">
                    <?php echo form_input('card-expiry-month', set_value('card-expiry-month'), "id=\"card-expiry-month\" class=\"form-control card-expiry-month\" placeholder=\"MM\" maxlength=\"2\" "); ?>
                    <?php echo form_error('card-expiry-month') ?>
                </div>

                <div class="form-group col-lg-3 required">
                    <?php echo form_input('card-expiry-year', set_value('card-expiry-year'), "id=\"card-expiry-year\" class=\"form-control card-expiry-year\" placeholder=\"YYYY\" maxlength=\"4\""); ?>
                    <?php echo form_error('card-expiry-year') ?>
                </div>

                <div class="form-group col-lg-2 required">
                    <?php echo form_input('card-cvc', set_value('card-cvc'), "id=\"card-cvc\" class=\"form-control card-cvc\" placeholder=\"CVC\" maxlength=\"4\" "); ?>
                    <?php echo form_error('card-cvc') ?>
                </div>

            </div>

   

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="term_condition">
                        <label class="form-check-label" for="term_condition"><strong>I have read and agree to the</strong> <a href="#">Terms of Service</a> </label>
                    </div>
                </div>
                
            </div>
            


            <div class="row">
                <div class="form-group col-lg-2 required">
                    <?php echo form_button(array("type" => "submit", "class" => "btn  enroll-submit-btn", "content" => "Enroll", "disabled"=>"disabled", "data-inline"=>"true", "id"=>"enroll_Submit")) ?>
                </div>
                <div class="form-group col-lg-10">
                <div class='form-row row'>
            <div class='col-md-12 error form-group d-none'>
            
                <div class="alert alert-danger  fade show" role="alert">
                    Please correct the errors and try again.
                   
                </div>
            </div>
        </div>
</div>
               

            </div>
            
        </div>


       

        <?php echo form_close(); ?>
</div>

<div class="col-lg-2">

</div>

</div>
</div>
</main>



