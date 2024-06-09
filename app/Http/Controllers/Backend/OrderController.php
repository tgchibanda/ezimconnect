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
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function PendingOrders()
    {
        $orders = Order::where('status', 'pending')->orderBy('id', 'DESC')->get();
        return view('backend.order.pending_orders', compact('orders'));
    }

    public function AdminConfirmedOrder()
    {
        $orders = Order::where('status', 'confirmed')->orderBy('id', 'DESC')->get();
        return view('backend.order.confirmed_orders', compact('orders'));
    } // End Method 


    public function AdminProcessingOrder()
    {
        $orders = Order::where('status', 'processing')->orderBy('id', 'DESC')->get();
        return view('backend.order.processing_orders', compact('orders'));
    } // End Method 


    public function AdminDeliveredOrder()
    {
        $orders = Order::where('status', 'delivered')->orderBy('id', 'DESC')->get();
        return view('backend.order.delivered_orders', compact('orders'));
    }

    public function MoveNextStatus(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $new_status = '';
        if ($order->status == 'pending') {
            $new_status = 'confirmed';
        } elseif ($order->status == 'confirmed') {
            $new_status = 'processing';
        } elseif ($order->status == 'processing') {
            $new_status = 'delivered';
        }

        $order->update(['status' => $new_status]);

        $notification = array(
            'message' => 'Order Status Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('pending.orders')->with($notification);
    }

    public function AdminOrderDetails(Request $request)
    {

        $order = Order::with('division', 'district', 'state', 'user')->where('id', $request->id)->first();
        $orderItem = CheckoutOrderItem::with('product')->where('order_id', $request->id)->orderBy('id', 'DESC')->get();

        return view('backend.order.admin_order_details', compact('order', 'orderItem'));
    }

    public function VendorOrderDetails(Request $request)
    {

        $order = Order::with('division', 'district', 'state', 'user')->where('id', $request->order_id)->first();
        $orderItem = CheckoutOrderItem::with('product')->where('order_id', $request->order_id)->orderBy('id', 'DESC')->get();

        return view('backend.order.vendor_order_details', compact('order', 'orderItem'));
    }

    public function AdminInvoiceDownload(Request $request)
    {

        $order = Order::with('division', 'district', 'state', 'user')->where('id', $request->id)->first();
        $orderItem = CheckoutOrderItem::with('product')->where('order_id', $request->id)->orderBy('id', 'DESC')->get();

        $pdf = Pdf::loadView('backend.order.admin_order_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }

    public function VendorReturnOrder()
    {

        $id = Auth::user()->id;
        $orderitem = CheckoutOrderItem::with('order')->where('vendor_id', $id)->orderBy('id', 'DESC')->get();
        return view('backend.order.return_orders', compact('orderitem'));
    }

    public function VendorCompleteReturnOrder()
    {

        $id = Auth::user()->id;
        $orderitem = CheckoutOrderItem::with('order')->where('vendor_id', $id)->orderBy('id', 'DESC')->get();
        return view('backend.order.complete_return_orders', compact('orderitem'));
    }

    public function VendorOrders()
    {

        $id = Auth::user()->id;
        $orderitems = CheckoutOrderItem::with('order')->where('vendor_id', $id)->orderBy('id', 'DESC')->get();
        return view('backend.order.vendor_pending_orders', compact('orderitems'));
    }
}
