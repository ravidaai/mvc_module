<div class="container">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo site_url('dashboard/session_billing/'.$group->id) ?>">&larr; Return to Billing Statement</a>
        </li>
<!--         <li class="breadcrumb-item active">Credit Card Payment</li>-->
    </ol>


    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">

           <?php echo (!empty($payable_amount)?"<strong>Amount Your Credit Card Will Be Charged: </strong> USD ".$payable_amount:NULL) ?>
        </div>
        <div class="card-body">
            <?php echo form_open(site_url('dashboard/session_payment/' . $group->id), "method=\"post\" autocomplete=\"off\" class=\"require-validation\" data-cc-on-file=\"false\"  data-stripe-publishable-key=\"" . $this->config->item('stripe_key') . "\" id=\"payment-form\"") ?>
            <div class="form-block ">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="form-group-title">Credit Card Information</h4>
                    </div>
                </div>

                <div class='form-row row'>
                    <div class='col-md-12 error form-group d-none'>

                        <div class="alert alert-danger  fade show" role="alert">
                            Please correct the errors and try again.

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-lg-6 required">
                    <?php echo form_input('card-number', set_value('card-number'), "id=\"card-number\" class=\"form-control card-number\" maxlength=\"16\" placeholder=\"Card Number\""); ?>
                    <?php echo form_error('card-number') ?>
                </div>

                <div class="form-group col-lg-6 required">
                    <?php echo form_input('card-cvc', set_value('card-cvc'), "id=\"card-cvc\" class=\"form-control card-cvc\" maxlength=\"4\" placeholder=\"CVC\""); ?>
                    <?php echo form_error('card-cvc') ?>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-lg-6 required">
                    <?php echo form_input('card-expiry-month', set_value('card-expiry-month'), "id=\"card-expiry-month\" maxlength=\"2\" class=\"form-control card-expiry-month\" placeholder=\"MM\""); ?>
                    <?php echo form_error('card-expiry-month') ?>
                </div>

                <div class="form-group col-lg-6 required" style="padding-right:10px;">
                    <?php echo form_input('card-expiry-year', set_value('card-expiry-year'), "id=\"card-expiry-year\" maxlength=\"4\" class=\"form-control card-expiry-year\" placeholder=\"YYYY\""); ?>
                    <?php echo form_error('card-expiry-year') ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="term_condition">
                        <label class="form-check-label" for="term_condition"><strong>I have read and agree to
                                the</strong> <a href="#">Term of Service</a> </label>
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="form-group col-lg-2 required">
                    <?php echo form_button(array("type" => "submit", "class" => "btn  enroll-submit-btn", "content" => "Pay Now", "disabled" => "disabled", "data-inline" => "true", "id" => "enroll_Submit")) ?>
                </div>
                <div class="form-group col-lg-10">


                </div>

            </div>
            <?php echo form_close(); ?>
        </div>
        <div class="card-footer small text-muted"></div>
    </div>


</div>               

                
          