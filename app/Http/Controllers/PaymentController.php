<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Booking;
use App\Models\Payment;


class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        $api = new Api('rzp_test_uORfgMbLsbY8oM', 'yU5lM9kTqO4N32MMXnfXGfEH');

        $amount = $request->input('amount');

        $order = $api->order->create(array(
            'receipt' => 'order_rcptid_' . time(),
            'amount' => $amount * 100,
            'currency' => 'INR'
        ));

        $orderId = $order['id'];
        $data = [
            'amount' => $amount,
            'client_id' => $request->input('client_id'),
            'company_id' => $request->input('company_id'),
            'starting_date' => $request->input('starting_date'),
            'ending_date' => $request->input('ending_date'),
        ];

        return view('razorpay.checkout', compact('orderId', 'amount', 'data'));
    }

    public function paymentSuccess(Request $request)
    {
        $api = new Api('rzp_test_uORfgMbLsbY8oM', 'yU5lM9kTqO4N32MMXnfXGfEH');

        $payments = $api->payment->fetch($request->razorpay_payment_id);

        $payment = new Payment();
        $payment->client_id = $request->client_id;
        $payment->company_id = $request->company_id;
        $payment->amount = $request->amount;
        $payment->transaction_id = $request->razorpay_payment_id;

        if ($payments->status == 'captured') {
            $booking = new Booking();
            $booking->client_id = $request->client_id;
            $booking->company_id = $request->company_id;
            $booking->starting_date = $request->starting_date;
            $booking->ending_date = $request->ending_date;
            $booking->save();

            $payment->status = 'completed';
            $payment->save();
            return redirect('/user/bookings');


        } else {
            $payment->status = 'failed';
            $payment->save();
            return redirect('/user/payments');
        }
        
    }
}
