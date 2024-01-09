<div class="container">
<?php /* ?>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo site_url('dashboard/session') ?>">&larr;  Return to My Students </a>
        </li>
<!--         <li class="breadcrumb-item active">Billing</li>-->
    </ol>

<?php */ ?>
    <!-- DataTables Example -->
    <h1 class="py-3" style="font-size:20px;"><?php echo $sessionQ->session_name; ?> Billing Statement</h1>

    <div class="card mb-3">
    <?php /* ?>    
    <div class="card-header">

            <strong style="font-size: 20px;"><?php echo $sessionQ->session_name; ?> Billing Statement</strong>
        </div>
<?php */ ?>
        <div class="card-body">

        <div class="row">
            <div class="col-md-6">
            <p>
            <h5 class="color-blue" style="color:#1B86F1;">Billing Details</h5>
            <strong>Course Start Date: </strong><?php echo custom_date_format($group->start_date); ?><br>
            <strong>Course End Date: </strong> <?php echo custom_date_format($group->end_date); ?><br>
            <strong>Enrollment: </strong><?php echo $this->members_model->getWhereTotal(array('group_id' => $group->id)); ?>
            <br>
            <strong>Per Student Rate: </strong> $<?php echo $group->per_student_rate; ?> <br>
            <strong>Total Payment Due: </strong>
            $<?php echo $group->per_student_rate * $this->members_model->getWhereTotal(array('group_id' => $group->id)); ?>
            <br>
            <strong>Payment Due Date: </strong> <?php echo custom_date_format($group->payment_due_date); ?><br>
            </p>

            <p>
                <?php
                if ($group->payment_status == 1) {
                    if(!empty($group->stripe_receipt_url) || !is_null($group->stripe_receipt_url)){
                        $payment_status = "​Your payment has been received. Thank you. <a href=\"$group->stripe_receipt_url\" target='_blank'>Click here to check your paid receipt.</a>";
                    }
                    else{
                        $payment_status = "​Your payment has been received. Thank you.";
                    }
                    

                }

                if ($group->payment_status == 0) {
                    $payment_status = "​Your payment is due by " . custom_date_format($group->payment_due_date) . ".";
                }



                ?>
                <strong>Payment Status:</strong> <?php echo $payment_status; ?>
            </p>

            <?php  /*if ($group->payment_status == 0): ?>
                <p>
                    <strong>Payment Options: </strong>


                <hr>
                <a href="<?php echo site_url("dashboard/session_payment/" . $group->id) ?>"><i class="far fa-credit-card"></i> ​Click here​ to pay with credit card.</a> <br>
                <strong>Pay with check: Mail invoice and payment to this address:</strong><br>

                <address>American Ways, New York, USA.</address>
                </p>
            <?php endif; */?>

            <p>
                <?php
                if(@file_exists('./assets/uploads/'.$group->invoice) && !empty($group->invoice)){
                    echo "<a href='".site_url('./assets/uploads/'.$group->invoice)."' class=\"btn btn-primary btn-sm\" target='_blank'>Print Invoice</a>";
                }else{
                    echo "<button class=\"btn btn-primary btn-sm\" disabled>Print Invoice</button>";
                }
                ?>

                <?php
                if(@file_exists('./assets/uploads/'.$group->receipt) && !empty($group->receipt)){
                    echo "<a href='".site_url('./assets/uploads/'.$group->receipt)."' class=\"btn btn-primary btn-sm\" target='_blank'>Print Receipt</a>";
                }else{
                    echo "<button class=\"btn btn-primary btn-sm\" disabled>Print Receipt</button>";
                }
                ?>

            </p>
            </div>
        
            <div class="col-md-6">
                <p>
            <h5 class="color-blue" style="color:#1B86F1;">Pay With Credit Card</h5>
            </p>

            <?php echo form_open(site_url('dashboard/session_payment/' . $group->id), "method=\"post\" autocomplete=\"off\" class=\"require-validation\" data-cc-on-file=\"false\"  data-stripe-publishable-key=\"" . $this->config->item('stripe_key') . "\" id=\"payment-form\"") ?>
            <div class="form-block ">
               

                <div class='form-row row'>
                    <div class='col-md-12 error form-group d-none'>

                        <div class="alert alert-danger  fade show" role="alert">
                            Please correct the errors and try again.

                        </div>
                    </div>
                </div>
            </div>

            <div class="row pb-2" id="session_billing">
                <div class="col-lg-5 required" >
                    <?php echo form_input('card-number', set_value('card-number'), "id=\"card-number\" class=\"form-control card-number\" maxlength=\"16\" placeholder=\"Card Number\""); ?>
                    <?php echo form_error('card-number') ?>
                </div>

                <div class="col-lg-3 required">
                    <?php echo form_input('card-cvc', set_value('card-cvc'), "id=\"card-cvc\" class=\"form-control card-cvc\" maxlength=\"4\" placeholder=\"CVC\""); ?>
                    <?php echo form_error('card-cvc') ?>
                </div>
            
                <div class="col-lg-2 required">
                    <?php echo form_input('card-expiry-month', set_value('card-expiry-month'), "id=\"card-expiry-month\" maxlength=\"2\" class=\"form-control card-expiry-month\" placeholder=\"MM\""); ?>
                    <?php echo form_error('card-expiry-month') ?>
                </div>

                <div class="col-lg-2 required">
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
                <div class="form-group col-lg-4 required">
                    <?php echo form_button(array("type" => "submit", "class" => "btn  enroll-submit-btn", "content" => "Confirm Payment", "disabled" => "disabled", "data-inline" => "true", "id" => "enroll_Submit")) ?>
                </div>
                <div class="form-group col-lg-8"></div>
            </div>

            <div class="row">
                <div class="form-group col-lg-12">
               
            <h5 class="color-blue" style="color:#1B86F1;">Pay With Check</h5>
        
           
                
           

            <p>
            Please mail your payment along with a acopy of your invoice to the following address:<br><br>
                American Ways<br>
                123 Main Street<br>
                New York, NY 12345
            </p>

            </div>
                
            </div>

            <?php echo form_close(); ?>
            </div>
        </div>

            
           

        </div>
        <div class="card-footer small text-muted"></div>
    </div>


</div>               

                
          