<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\MultiImg;

class IndexController extends Controller
{
    public function ProductDetails($id, $slug)
    {

        $product = Product::findOrFail($id);
        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);
        $multiImages = MultiImg::where('product_id',$id)->get();

        $category_id = $product->category_id;
        $relatedProducts = Product::where('category_id', $category_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(4)->get();

        return view('frontend.product.product_details',compact('product','product_color','product_size','multiImages','relatedProducts'));
    }
}
