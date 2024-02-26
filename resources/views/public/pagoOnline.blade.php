@extends('layouts.public')
@section('title')
<title> Pago Online</title>
@endsection
@section('content')
<div class="container">
  
    <div class="row py-5">
        <div class="col-md-12">
            <div class="login_wrap">
                <div class="px-5 py-5 bg-white">

                    <div class="heading_s1 d-flex align-items-center bg-white" style="justify-content: space-between;">
                        <h1>Pago Online:</h1>

                        <div class="d-flex">                            
                            <i style="font-size:30px;" class="mr-2 fab fa-cc-stripe"></i>  
                            <i style="font-size:30px;" class="mr-2 fab fa-cc-mastercard"></i>
                            <i style="font-size:30px;" class="fab fa-cc-visa"></i>                      
                        </div>
                    </div>

                    <div class="row">
                    
                        @if (Session::has('success'))
                            <div class="alert alert-success text-center">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif
                        
                        <form 
                                role="form" 
                                action="{{ route('stripe.post') }}" 
                                method="post" 
                                class="require-validation col-md-12"
                                data-cc-on-file="false"
                                data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                id="payment-form">
                            @csrf
                        
                            <div class="row">
                                <div class='col-md-4 form-group required'>
                                    <label class='control-label'>Nombre de tu Tarjeta de Crédito:</label> 
                                    <input placeholder="ej: John Doe"
                                        class="form-control" size="4" type="text">
                                </div>
                            
                                <div class='col-md-4 form-group required'>
                                    <label class='control-label'>Número tu Tarjeta de Crédito:</label> 
                                    <input placeholder="ej: 4242 4242 4242 4242"
                                        autocomplete='off' class='form-control card-number' size='20'
                                        type='text'>
                                </div>

                                <div class='col-md-4 form-group required'>
                                    <label class='control-label'>Correo Electrónico:</label> 
                                    <input placeholder="ej: johndoe@email.com" name="email"
                                        class='form-control'
                                        type='text'>
                                </div>
                            
                                <div class='col-md-4 form-group cvc required'>
                                    <label class='control-label'>CVC:</label> <input autocomplete='off'
                                        class='form-control card-cvc' placeholder='ej: 124' size='4'
                                        type='text'>
                                </div>
                                <div class='col-md-4 form-group expiration required'>
                                    <label class='control-label'>Mes de Vencimiento:</label> <input
                                        class='form-control card-expiry-month' placeholder='MM' size='2'
                                        type='text'>
                                </div>
                                <div class='col-md-4 form-group expiration required'>
                                    <label class='control-label'>Año de Vencimiento:</label> <input
                                        class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                        type='text'>
                                </div>
                            
                                <div class='col-md-12 error form-group d-none'>
                                    <div class='alert-danger alert'>Error: Por favor, revise sus datos e intente nuevamente.</div>
                                </div>
                            
                                <div class="col-md-12">
                                    <button class="btn btn-fill-out" type="submit">Pague Ahora ($35)</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>        
        </div>
    </div>
      
</div>
@endsection

@section('stripe')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  
<script type="text/javascript">
$(function() {
   
    var $form = $(".require-validation");
   
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',  'input[type=text]', 'input[type=file]', 'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
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
            /* token contains id, last4, and card type */
            var token = response['id'];
               
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
   
});
</script>
@endsection