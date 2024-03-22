<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use Razorpay\Api\Api;

use Illuminate\Http\Request;

class RazorpayController extends Controller
{
    public function razorpay(Request $request)
    {
        //dd($request->all()); in here we receive razorpay payment id from frontend or razorpay pay page
        //payment id receive from server when make payment via frontend razorpay api
        //at this moment the status is pending/authorized if we can do dd($request->all()) because it do payment at razo server and here it not store into db/capture/verify
        //in here order id not created because we do not pass from frontend because we directly make payment on button
        if(isset($request->razorpay_payment_id) && $request->razorpay_payment_id != '')
        {
            $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
            //fetch all detail of payment by razo id which pass from frontend
            
            $payment = $api->payment->fetch($request->razorpay_payment_id);
            //dd($payment);
            //by above dd the status is still authorized and it completed/capture when we do capture by below line
            //capture is used for verifying the payment or status capture/completed
            $response = $payment->capture(array('amount'=>$payment->amount));
            //dd($response);
            //after capture/completed store inside db
            $payment = new Payment();
            // the response column  for store record can be seen by dd($response);
            $payment->payment_id = $response['id'];
            $payment->product_id = $response['notes']['product_id'];
            $payment->product_name = $response['notes']['product_name'];
            $payment->booking_number = 'Raz_' . mt_rand(10000, 99999);
            $payment->customer_name = $response['notes']['customer_name'];
            $payment->customer_email = $response['notes']['customer_email'];
            $payment->mobile = $response['contact'];
            $payment->address = $response['notes']['address'];
            $payment->amount = $response['amount']/100;
            $payment->currency = $response['currency'];
            $payment->quantity = $response['notes']['quantity'];
            $payment->payment_status = $response['status'];
            $payment->payment_method = 'Razorpay';
            
            $payment->save();

             return back()->with('success','Payment Successfully Payment id :   ' .$payment->payment_id);

        } else {
            return back()->with('error','Payment Failed');
        }
        
    }

   

    function refund($id){
        $record = Payment::findOrFail($id); 
        $paymentId = $record->payment_id;
        $amount = $record->amount;
     $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
     //$api->payment->fetch($paymentId)->refund(array("amount"=> "100", "speed"=>"normal", "notes"=>array("notes_key_1"=>"Beam me up Scotty.", "notes_key_2"=>"Engage"), "receipt"=>"Receipt No. 11"));
     //check first already refund or not on server by  fetch the payment detail the below line code by doc/github repo
     $payment = $api->payment->fetch($paymentId);
     //dd($payment);
     if ($payment->status == 'refunded') {
        return back()->with('error', 'This payment has already been refunded.');
      }
     //make refund the below code doc/github repo 
     $refund = $api->payment->fetch($paymentId)->refund([
        'amount' => $amount*100, 
        'speed' => 'normal', 
        'notes' => [
            'reason' => 'Refund for order cancellation'
        ]
    ]);
    //dd($refund);
    if ($refund){  //if refunded successfully on razorpay server than also modified in db
          $change_status_db = Payment::where('payment_id',$paymentId)->first();
          $change_status_db->payment_status = "refunded";
          $change_status_db->save();
        
        
          return back()->with('success','Refund successful');
    
        } else {
        return back()->with('error','Refund failed');
        }
}

}

