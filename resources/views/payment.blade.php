@extends('layouts.default')
<style>
  .header{
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .header-title{
    font-size: 32px;
  }

  .payment-content{
    margin: 50px auto;
    padding-bottom: 10px;
    width: 60%;
    min-width: 500px;
    max-width: 700px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 2px 2px 5px #999;
  }

  .payment-content-header{
    padding: 20px;
    background: #315BFB;
    border-radius: 5px 5px 0 0;
  }

  .content-title{
    color: #fff;
    font-size: 20px;
  }

  .payment-form{
    padding: 20px;
  }

  .payment-form table{
    width: 100%;
    text-align: left;
  }

  .payment-form tr{
    height: 50px;
  }

  .payment-form th{
    width: 30%;
    vertical-align: middle;
  }

  .payment-form td{
    width: 70%;
    vertical-align: middle;
  }

  .payment-form input{
    width: 100%;
    line-height: 2;
  }

  .submit-button{
    display: block;
    margin-top: 20px;
    margin-left: auto;
    padding: 10px 20px;
    color: #fff;
    background: #315BFB;
    border: none;
    border-radius: 5px;
    box-shadow: 2px 2px 5px #999;
    cursor: pointer;
  }
</style>

<header class="header">
    @include('components.header-items-1')
</header>

@section('content')
<div class="payment-content">
  <div class="payment-content-header">
    <h2 class="content-title">{{ $reservation->course->course_name }}の精算</h2>
  </div>
  <form action="/pay/process" method="POST" id="payment-form" class="payment-form">
    @csrf
    <table>
      <tr>
        <th>クレジットカード情報</th>
        <td>
          <div id="card-element" class="card-element"></div>
          <div id="card-errors" role="alert"></div>
        </td>
      </tr>
      <tr>
        <th>カード名義</th>
        <td>
          <input id="name" name="name" type="text" value="{{ old('name') }}">
        </td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td>
          <input id="email" name="email" type="email" value="{{ old('email') }}">
        </td>
      </tr>
      <tr>
        <th>金額</th>
        <td>
          <input id="amount" name="amount" type="text" value="{{$amount}}" readonly>
        </td>
      </tr>
    </table>
    <button id="submit-button" class="submit-button">
        支払う
    </button>
  </form>
</div>



<script src="https://js.stripe.com/v3/"></script>
<script>
  // Create a Stripe client
  var stripe = Stripe('{{env('STRIPE_KEY')}}');
  var elements = stripe.elements();
var cardElement = elements.create('card',{hidePostalCode:true});
cardElement.mount('#card-element');

var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();
  
  stripe.createToken(cardElement).then(function(result) {
    if (result.error) {
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Add token to form and submit
      var tokenInput = document.createElement('input');
      tokenInput.setAttribute('type', 'hidden');
      tokenInput.setAttribute('name', 'stripeToken');
      tokenInput.setAttribute('value', result.token.id);
      form.appendChild(tokenInput);
      
      form.submit();
    }
  });
});
</script>
@endsection