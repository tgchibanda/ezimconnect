<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WishlistController extends Controller
{
    public function AddToWishList(Request $request, $product_id)
    {

        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();

            if (!$exists) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),

                ]);
                return response()->json(['success' => 'Successfully Added To Your Wishlist']);
            } else {
                return response()->json(['error' => 'This Product Is Already Added To Wishlist']);
            }
        } else {
            return response()->json(['error' => 'You Have To Be Signed In For This Function']);
        }
    }

    public function AllWishlist()
    {

        return view('frontend.wishlist.view_wishlist');

    }

    public function GetWishlistProducts()
    {

        $wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();

        $wishQty = count($wishlist); 

        return response()->json(['wishlist'=> $wishlist, 'wishQty' => $wishQty]);

    }

    public function RemoveWishlist($id){

        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
     return response()->json(['success' => 'Product Removed From Your Wishlist' ]);
    }
}
