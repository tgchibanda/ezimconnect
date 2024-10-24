<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CheckoutOrderItem; 
use App\Helpers\Cart;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Coupon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function PayOrder(Request $request){

        DB::beginTransaction();

        $cartData = json_decode(Cart::GetCartProducts()->getContent(), true);
        $cartTotal = $cartData['cartTotal'];

        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        }else{
            $total_amount = round($cartTotal);
        }

        if($request->payment_methode == 'Stripe'){
            \Stripe\Stripe::setApiKey(config('services.stripe.secret_key'));


            $token = $_POST['stripeToken'];
    
            $charge = \Stripe\Charge::create([
              'amount' => $total_amount*100,
              'currency' => 'usd',
              'description' => 'eZimConnect',
              'source' => $token,
              'metadata' => ['order_id' => uniqid()],
            ]);

            $payment_type = $charge->payment_method;
            $payment_method = 'Stripe';
            $transaction_id = $charge->balance_transaction;
            $currency = $charge->currency;
            $order_number = $charge->metadata->order_id;

        } elseif($request->payment_methode == 'Cash on delivery'){
            $payment_type = 'Cash on delivery';
            $payment_method = 'Cash';
            $transaction_id = 0;
            $currency = 'USD';
            $order_number = 0;
        }
       

        //dd($charge);
        try {
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adress' => $request->address,
            'post_code' => $request->post_code,
            'notes' => $request->notes,

            'payment_type' => $payment_type,
            'payment_method' => $payment_method,
            'transaction_id' => $transaction_id,
            'currency' => $currency,
            'amount' => $total_amount,
            'order_number' => $order_number,

            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'), 
            'status' => 'pending',
            'created_at' => Carbon::now(),  


        ]);


        Order::where('id', $order_id)->update([
            'invoice_no' => 'eZC' . $order_id,
        ]);
        
        $cartData = json_decode(Cart::GetCartProducts()->getContent(), true);

        foreach($cartData['carts'] as $cart){
            $options = json_decode($cart['options'], true);

            CheckoutOrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart['product_id'],
                'vendor_id' => $options['vendor'],
                'color' => $options['color'],
                'size' => $options['size'],
                'qty' => $cart['qty'],
                'price' => $cart['price'],
                'created_at' => Carbon::now(),

            ]);

        } // End Foreach

        if (Session::has('coupon')) {
           Session::forget('coupon');
        }

        Cart::destroy();

        if(Session::has('coupon')){
            Session::forget('coupon');
        }

        // Start Send Email

        $invoice = Order::findOrFail($order_id);

        $data = [

            'invoice_no' => $invoice->invoice_no,
            'amount' => $total_amount,
            'payment_method' => $payment_method,
            'name' => $invoice->name,
            'email' => $invoice->email,

        ];

        $recipients = [$request->email, 'admin@ezimconnect.com'];
        Mail::to($recipients)->send(new OrderMail($data));

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        // End Send Email 

        $notification = array(
            'message' => 'Your Order Place Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification); 

    }
}
