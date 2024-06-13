<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MultiImg;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User; 
 
class IndexController extends Controller
{

    public function Index()
    {

        $hot_deals = Product::where('hot_deals', 1)
                            ->whereNotNull('discount_price')
                            ->inRandomOrder()
                            ->limit(3)
                            ->get();

        $special_offer = Product::where('special_offer', 1)
                         ->inRandomOrder()
                         ->limit(3)
                         ->get();

        $new = Product::where('status',1)->orderBy('id','DESC')->limit(3)->get();

        $special_deals = Product::where('special_deals', 1)
                         ->inRandomOrder()
                         ->limit(3)
                         ->get();

        return view('frontend.index',compact('hot_deals','special_offer','new','special_deals'));

    } // End Method 

     public function ProductDetails($id,$slug)
     {

        $product = Product::findOrFail($id);

        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);

        $multiImages = MultiImg::where('product_id',$id)->get();

        $cat_id = $product->category_id;
        $relatedProducts = Product::where('category_id', $cat_id)
        ->where('id', '!=', $id)
        ->inRandomOrder()
        ->limit(4)
        ->get();

        return view('frontend.product.product_details',compact('product','product_color','product_size','multiImages','relatedProducts'));

     } // End Method 


     public function VendorDetails($id)
     {

        $vendor = User::findOrFail($id);
        $vproducts = Product::where('vendor_id',$id)->get();
        return view('frontend.vendor.vendor_details',compact('vendor','vproducts'));

     } // End Method 


     public function AllVendors()
     {

        $vendors = User::where('status','active')->where('role','vendor')->orderBy('id','DESC')->get();
        return view('frontend.vendor.all_vendors',compact('vendors'));

     } // End Method 


     public function CatWiseProducts(Request $request,$id,$slug)
     {
      $products = Product::where('status',1)->where('category_id',$id)->orderBy('id','DESC')->get();
      $categories = Category::orderBy('category_name','ASC')->get();

      $breadcat = Category::where('id',$id)->first();

      $newProducts = Product::orderBy('id','DESC')->limit(3)->get();

      return view('frontend.product.category_view',compact('products','categories','breadcat','newProducts'));

     }// End Method 


      public function SubCatWiseProducts(Request $request,$id,$slug)
      {
      $products = Product::where('status',1)->where('subcategory_id',$id)->orderBy('id','DESC')->get();
      $categories = Category::orderBy('category_name','ASC')->get();

      $breadsubcat = SubCategory::where('id',$id)->first();

      $newProducts = Product::orderBy('id','DESC')->limit(3)->get();

      return view('frontend.product.view_subcategory',compact('products','categories','breadsubcat','newProducts'));

     }// End Method 


     public function ProductViewAjax($id)
     {

        $product = Product::with('category','brand')->findOrFail($id);
        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);

        return response()->json(array(

         'product' => $product,
         'color' => $product_color,
         'size' => $product_size,

        ));

     }// End Method 


     public function ProductSearch(Request $request)
     {

         $request->validate(['search' => "required"]);

         $item = $request->search;
         $categories = Category::orderBy('category_name','ASC')->get();
         $products = Product::where('product_name','LIKE',"%$item%")->get();
         $newProduct = Product::orderBy('id','DESC')->limit(3)->get();
         return view('frontend.product.search',compact('products','item','categories','newProduct'));

     }// End Method 


     public function SearchProduct(Request $request)
     {

       $request->validate(['search' => "required"]);

        $item = $request->search;
        $products = Product::where('product_name','LIKE',"%$item%")->select('product_name','product_slug','product_thumbnail','selling_price','id')->limit(6)->get();

        return view('frontend.product.search_product',compact('products'));

     }// End Method 
     


}
 