<!doctype html>
<html lang="en">
  <head>
    <title><?php echo isset($web_title)?$web_title:'American Ways'; ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo site_url('assets/site/css/style.css'); ?>">
  <style>
  .form-error{
    color: #ea0e0e;
    font-size: 12px;
    font-style: italic;
  }
  </style>
  </head>
  <body>
  <?php $this->load->view($module . '/' . $template); ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
     
     <script type="text/javascript">

        


     $(function() {

      $("#term_condition").click(function () {
        <?php if(strcasecmp($this->setting_model->get('credit_card_registration'), 'Y')==0):?>
            $("#enroll_Submit").attr("disabled", !this.checked);
      <?php else: ?>
            $("#enroll_Submit").attr("disabled", true);
        <?php endif; ?>
            
        });

       
         var $form         = $(".require-validation");
       $('form.require-validation').bind('submit', function(e) {
         var $form         = $(".require-validation"),
             inputSelector = ['input[type=email]', 'input[type=password]',
                              'input[type=text]', 'input[type=file]',
                              'textarea'].join(', '),
             $inputs       = $form.find('.required').find(inputSelector),
             $errorMessage = $form.find('div.error'),
             valid         = true;
             $errorMessage.addClass('d-none');
      
             $('.has-error').removeClass('has-error');
         $inputs.each(function(i, el) {
           var $input = $(el);
           if ($input.val() === '') {
             $input.parent().addClass('has-error');
             $errorMessage.removeClass('d-none');
             e.preventDefault();
           }
         });
          
         if (!$form.data('cc-on-file')) {
           e.preventDefault();
           Stripe.setPublishableKey($form.data('stripe-publishable-key'));
           Stripe.createToken({
             number: $('.card-number').val(),
             cvc: $('.card-cvc').val(),
             exp_month: $('.card-expiry-month').val(),
             exp_year: $('.card-expiry-year').val()
           }, stripeResponseHandler);
         }
         
       });
           
       function stripeResponseHandler(status, response) {
             if (response.error) {
                 $('.error')
                     .removeClass('d-none')
                     .find('.alert')
                     .text(response.error.message);
             } else {
                 var token = response['id'];
                 $form.find('input[type=text]').empty();
                 $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                 $form.get(0).submit();
             }
         }
          
     });
     </script>
  </body>
</html>