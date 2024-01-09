<header class="registration  pt-2 pb-2">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
<h1 class="logo-title">American <span>Ways</span></h1>
        </div>
        <div class="col-lg-8">

        </div>
    </div>
</div>
</header>

<main class="registration py-5">
<div class="container">
<div class="row">
<?php
                echo getFlashMessage('flash_error');
                echo getFlashMessage('flash_success');
                ?>



                    <div class='form-row row'>
                            <div class='col-md-12 error form-group d-none'>
                                <div class='alert-danger alert'>Please correct the errors and try again.</div>
                            </div>
                        </div>

                        
                        <?php echo form_open(site_url(), " autocomplete=\"off\" class=\"require-validation\" data-cc-on-file=\"false\"  data-stripe-publishable-key=\"".$this->config->item('stripe_key')."\" id=\"payment-form\"") ?>

                        <div class="form-group">
                            <label for="input_first_name">First Name</label>
                            <?php echo form_input('first_name', set_value('first_name'), "id=\"input_first_name\" class=\"form-control\" placeholder=\"First Name\""); ?>
                            <?php echo form_error('first_name') ?>
                        </div>

                        <div class="form-group">
                            <label for="input_last_name">Last Name</label>
                            <?php echo form_input('last_name', set_value('last_name'), "id=\"input_last_name\" class=\"form-control\" placeholder=\"Last Name\""); ?>
                            <?php echo form_error('last_name') ?>
                        </div>

                        <div class="form-group">
                            <label for="input_country">Country</label>
                            <?php echo form_dropdown('country', $countryList, set_value('country'), "class=\"form-control\"") ?>
                                    <?php echo form_error('country') ?>
                        </div>

                        <div class="form-group">
                            <label for="input_institution">Institution</label>
                            <?php echo form_input('institution', set_value('institution'), "id=\"input_institution\" class=\"form-control\" placeholder=\"Institution\""); ?>
                            <?php echo form_error('institution') ?>
                        </div>

                        <div class="form-group">
                            <label for="input_email">Email</label>
                            <?php echo form_input('email', set_value('email'), "id=\"input_email\" class=\"form-control\" placeholder=\"Email\""); ?>
                            <?php echo form_error('email') ?>
                        </div>

                        <div class="form-group">
                            <label for="inputCreatePassword">Password</label>
                            <?php echo form_password('pwd', '', "id=\"inputCreatePassword\" class=\"form-control\" autocomplete=\"off\" placeholder=\"Password\""); ?>
                            <small id="emailHelp" class="form-text text-muted">Combination: one lowercase letter, one uppercase letter, least one number </small>
                            <?php echo form_error('pwd') ?>
                        </div>

                        <div class="form-group">
                            <label for="inputConfirmPassword">Confirm Password</label>
                            <?php echo form_password('conf_password', '', "id=\"inputConfirmPassword\" class=\"form-control\" autocomplete=\"off\" placeholder=\"Cofirm Password\""); ?>
                            <?php echo form_error('conf_password') ?>
                        </div>

                        <!-- <div class="form-group required">
                        <label for="card_name">Name on Card</label>
                        <?php //echo form_input('card_name', set_value('card_name'), "id=\"card_name\" class=\"form-control\" placeholder=\"Name on Card\""); ?>
                            <?php //echo form_error('card_name') ?>
                        </div> -->

                        <div class="form-group required">
                        <label for="card-number">Card Number</label>
                        <?php echo form_input('card-number', set_value('card-number'), "id=\"card-number\" class=\"form-control card-number\" placeholder=\"\""); ?>
                            <?php echo form_error('card-number') ?>
                        </div>

                        <div class="form-group required">
                        <label for="card-cvc">CVC</label>
                        <?php echo form_input('card-cvc', set_value('card-cvc'), "id=\"card-cvc\" class=\"form-control card-cvc\" placeholder=\"ex. 311\""); ?>
                            <?php echo form_error('card-cvc') ?>
                        </div>

                        <div class="form-group required">
                        <label for="card-expiry-month">Expiration Month</label>
                        <?php echo form_input('card-expiry-month', set_value('card-expiry-month'), "id=\"card-expiry-month\" class=\"form-control card-expiry-month\" placeholder=\"MM\""); ?>
                            <?php echo form_error('card-expiry-month') ?>
                        </div>

                        <div class="form-group required">
                        <label for="card-expiry-year">Expiration Year</label>
                        <?php echo form_input('card-expiry-year', set_value('card-expiry-year'), "id=\"card-expiry-year\" class=\"form-control card-expiry-year\" placeholder=\"YYYY\""); ?>
                            <?php echo form_error('card-expiry-year') ?>
                        </div>
      
                        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Register &rarr;")) ?>
                        <?php echo form_button(array("type" => "reset", "class" => "btn btn-danger", "content" => "Reset")) ?>

                        <?php echo form_close(); ?>
</div>
</div>
</main>


