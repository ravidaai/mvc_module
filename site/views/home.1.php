<div class="container">
     
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4">
                        <?php echo form_open(site_url('stripe'), "class=\"\" autocomplete=\"off\"") ?>

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
                            <?php echo form_input('country', set_value('country'), "id=\"input_country\" class=\"form-control\" placeholder=\"Country\""); ?>
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
                            <?php echo form_password('pwd', '', "id=\"inputCreatePassword\" class=\"form-control\" placeholder=\"Password\""); ?>
                            <?php echo form_error('pwd') ?>
                        </div>

                        <div class="form-group">
                            <label for="inputConfirmPassword">Confirm Password</label>
                            <?php echo form_password('conf_password', '', "id=\"inputConfirmPassword\" class=\"form-control\" placeholder=\"Cofirm Password\""); ?>
                            <?php echo form_error('conf_password') ?>
                        </div>


                        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Register &rarr;")) ?>
                        <?php echo form_button(array("type" => "reset", "class" => "btn btn-danger", "content" => "Reset")) ?>

                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" />

                        <?php echo form_close(); ?>
                    </div>
                    <!-- /.col-lg-6 (nested) -->

                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

    
     
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td" >Payment Details</h3>
                        <div class="display-td" >                            
                            <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                        </div>
                    </div>                    
                </div>
                <div class="panel-body">
    
                    <?php if($this->session->flashdata('success')){ ?>
                    <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p><?php echo $this->session->flashdata('success'); ?></p>
                        </div>
                    <?php } ?>
     
                    <form role="form" action="<?php echo site_url('stripe');?>" method="post" class="require-validation"
                                                     data-cc-on-file="false"
                                                    data-stripe-publishable-key="<?php echo $this->config->item('stripe_key') ?>"
                                                    id="payment-form">
     
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Name on Card</label> <input
                                    class='form-control' size='4' type='text'>
                            </div>
                        </div>
     
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Card Number</label> <input
                                    autocomplete='off' class='form-control card-number' size='20'
                                    type='text'>
                            </div>
                        </div>
      
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label> <input autocomplete='off'
                                    class='form-control card-cvc' placeholder='ex. 311' size='4'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text'>
                            </div>
                        </div>
      
                        <div class='form-row row'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.</div>
                            </div>
                        </div>
      
                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash() ?>" />
                            </div>
                        </div>
                             
                    </form>
                </div>
            </div>        
        </div>
    </div>
         
</div>