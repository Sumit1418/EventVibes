<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>
    <div class="container">
        <h1>Payment Checkout</h1>
        {{-- design page and use $data --}}
        <form id="payment-form" action="/user/payment/success" method="POST">
            @csrf
            
            <input type="hidden" name="amount" value="{{ $data['amount'] }}">
            <input type="hidden" name="client_id" value="{{ $data['client_id'] }}">
            <input type="hidden" name="company_id" value="{{ $data['company_id'] }}">
            <input type="hidden" name="starting_date" value="{{ $data['starting_date'] }}">
            <input type="hidden" name="ending_date" value="{{ $data['ending_date'] }}">

            <script src="https://checkout.razorpay.com/v1/checkout.js"
                    data-key="rzp_test_uORfgMbLsbY8oM"
                    data-amount="{{ $amount * 100 }}"
                    data-currency="INR"
                    data-order_id="{{ $orderId }}"
                    data-buttontext="Pay with Razorpay"
                    data-name="EventVibes"
                    data-description="Payment"
                    data-image="{{asset('storage/logo/eventvibes_logo.png') }}"
                    data-prefill.name="{{$_SESSION['user']->name}}"
                    data-prefill.email="{{$_SESSION['user']->email}}"
                    data-prefill.contact="{{$_SESSION['userDetails']->phone}}"
                    data-theme.color="#F37254">
            </script>
            <input type="hidden" name="hidden">
        </form>
    </div>
</body>
</html>
