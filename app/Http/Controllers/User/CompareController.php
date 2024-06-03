<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Compare;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CompareController extends Controller
{
    public function AddToCompare(Request $request, $product_id){

        if (Auth::check()) {
      $exists = Compare::where('user_id',Auth::id())->where('product_id',$product_id)->first();

            if (!$exists) {
               Compare::insert([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'created_at' => Carbon::now(),

               ]);
               return response()->json(['success' => 'Successfully Added To Compare List' ]);
            } else{
                return response()->json(['error' => 'Product Already Added To Compare List' ]);

            } 

        }else{
            return response()->json(['error' => 'You Have To Be Signed In For This Function' ]);
        }

    }

    public function AllCompare()
    {

        return view('frontend.compare.view_compare');

    }

    public function GetCompareProducts()
    {

        $compare = Compare::with('product')->where('user_id',Auth::id())->latest()->get();

        $compareQty = count($compare); 

        return response()->json(['compare'=> $compare, 'compareQty' => $compareQty]);

    }

    public function RemoveCompare($id){

        Compare::where('user_id',Auth::id())->where('id',$id)->delete();
     return response()->json(['success' => 'Product Removed From Your Compare List' ]);
    }

}
