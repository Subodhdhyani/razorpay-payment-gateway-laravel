<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Razorpay Payment</title>
    <link rel="stylesheet" type="text/css" href="{{url('bootstrap/css/bootstrap.min.css')}}">
</head>
<body>
<h1 class="text-center">Laravel Razorpay Payment</h1>

@if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
@endif

@if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
@endif




<form action="{{ route('razorpay') }}" method="post">
        @csrf
        {{--In Here first it go to the razorpay api/server make payment and then return with response & then go the form post--}}
        {{--We pass record to the razorpay ,the all other detail can pass with data-notes.column_name(except amount etc) & data-prefill can shown/prefilled on payment page --}}
        {{--See Razorpay Quick Integration > Build Integration Docs--}}
        {{--Also if by button then Payment Gatewat>Web Inte. >Config Payment method>Sample Code--}}
        <script src="https://checkout.razorpay.com/v1/checkout.js"
        data-key = "{{ env('RAZORPAY_KEY_ID') }}"
        data-amount = "600000"
        currency = "INR"
        data-buttontext ="Make Payment by Razorpay Button "
        data-image = "https://uxwing.com/wp-content/themes/uxwing/download/brands-and-social-media/razorpay-icon.png"
        data-notes.customer_name = "Larvel User"
        data-notes.customer_email = "testing@laravel.com" 
        data-notes.product_id = "7"
        data-notes.product_name = "Mobile"
        data-notes.quantity = "1"
        data-notes.address = "India"
        
        data-prefill.name = "Laravel User" 
        data-prefill.contact="919234567890"
      
        ></script>
        {{--<button type="submit" class="btn btn-primary">Make Razorpay Payment</button>--}}
</form>

<a href="{{route('display')}}" class="btn btn-danger mt-4">Show All Payment/Make Refund</a>

<script src="{{url('bootstrap/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>    
</body>
</html>