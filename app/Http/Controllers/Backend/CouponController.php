<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Carbon;

class CouponController extends Controller
{
    public function AllCoupons(){
        $coupon = Coupon::latest()->get();
        return view('backend.coupon.all_coupons',compact('coupon'));
    }

    public function AddCoupon(){
        
        return view('backend.coupon.add_coupon');
    }

    public function StoreCoupon(Request $request)
    {
        Coupon::create([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
        ]);

        $notification = array(
            'message' => 'Coupon Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.coupons')->with($notification);
    }

    public function EditCoupon(Request $request){

        $coupon = Coupon::findOrFail($request->id);
        return view('backend.coupon.edit_coupon',compact('coupon'));

    }// End Method 


    public function UpdateCoupon(Request $request){

        $coupon_id = $request->id;

         Coupon::findOrFail($coupon_id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'updated_at' => Carbon::now(),
        ]);

       $notification = array(
            'message' => 'Coupon Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.coupons')->with($notification); 


    }// End Method 

     public function RemoveCoupon(Request $request){

        Coupon::findOrFail($request->id)->delete();

         $notification = array(
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 


    }
}
