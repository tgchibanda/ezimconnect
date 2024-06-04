<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CheckoutOrderItem; 
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function PendingOrders()
    {
        $orders = Order::where('status','pending')->orderBy('id','DESC')->get();
        return view('backend.order.pending_orders',compact('orders'));
    }

    public function VendorOrders()
    {

        $id = Auth::user()->id;
        $orderitems = CheckoutOrderItem::with('order')->where('vendor_id',$id)->orderBy('id','DESC')->get();
        return view('backend.order.vendor_pending_orders',compact('orderitems'));
    }
}
