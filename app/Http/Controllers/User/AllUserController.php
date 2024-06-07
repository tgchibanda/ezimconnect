<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\CheckoutOrderItem;
use Barryvdh\DomPDF\Facade\Pdf;

class AllUserController extends Controller
{

    public function UserOrderInvoice(Request $request){

        $order = Order::with('division','district','state','user')->where('id',$request->order_id)->where('user_id',Auth::id())->first();
        $orderItem = CheckoutOrderItem::with('product')->where('order_id',$request->order_id)->orderBy('id','DESC')->get();

        $pdf = Pdf::loadView('frontend.order.order_invoice', compact('order','orderItem'))->setPaper('a4')->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    }

    public function UserAccount()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.userdashboard.account_details', compact('userData'));
    }

    public function UserChangePassword()
    {
        return view('frontend.userdashboard.user_change_password');
    } // End Method 


    public function UserOrderPage()
    {
        $id = Auth::user()->id;
        $orders = Order::where('user_id', $id)->orderBy('id', 'DESC')->get();
        return view('frontend.userdashboard.user_order_page', compact('orders'));
    }

    public function UserOrderDetails(Request $request){

        $order = Order::with('division','district','state','user')->where('id',$request->order_id)->where('user_id',Auth::id())->first();
        $orderItem = CheckoutOrderItem::with('product')->where('order_id',$request->order_id)->orderBy('id','DESC')->get();

        return view('frontend.order.order_details',compact('order','orderItem'));

    }
}
