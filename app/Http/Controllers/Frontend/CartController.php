<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Helpers\Cart;
use Illuminate\Http\Request;
use \App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function GetCartProducts(){

        $cartItems = Cart::getCartItems();
        $total = 0;
        foreach($cartItems as $item) {
            $total += $item['price'] * $item['qty'];
        }

        return response()->json(array(
            'carts' => $cartItems,
            'cartQty' => count($cartItems),  
            'cartTotal' => $total

        ));

    }


    public function GetSellingPrice(Product $product)
    {

        if ($product->discount_price == NULL) {
            $product_price = $product->selling_price;
        } else {
            $product_price = $product->discount_price;
        }

        return $product_price;
    }

    
    public function AddToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = $request->quantity;
        $product_name = $product->product_name;
        $user = $request->user();
        $product_price = self::GetSellingPrice($product);

        $data = [
            'user_id' => $user ? $user->id : null,
            'name' => $product_name,
            'product_id' => $product->id,
            'qty' => $quantity,
            'price' => $product_price,
            'weight' => 1,
            'options' => json_encode([
                'image' => $product->product_thumbnail,
                'color' => $request->color,
                'size' => $request->size,
            ])
        ];

        $totalQuantity = $quantity;

        if ($user) {
                CartItem::create($data);
            return response()->json(['success' => 'Successfully Added To Cart']);
        } else {
            $cartItems = json_decode($request->cookie('cart_items', '[]'), true);
                $totalQuantity = $quantity;
            if ($product->quantity !== null && $product->quantity < $totalQuantity) {
                return response([
                    'message' => match ($product->quantity) {
                        0 => 'The product is out of stock',
                        1 => 'There is only one item left',
                        default => 'There are only ' . $product->quantity . ' items left'
                    }
                ], 422);
            }
            $cartItems[] = $data;
            Cookie::queue('cart_items', json_encode($cartItems), 60 * 24 * 30);

            return response()->json(['success' => 'Successfully Added To Cart']);
        }
    }
    

    public function MyCart(){

        return view('frontend.mycart.view_mycart');

    }
    
    public function RemoveCart(Request $request)
    {
        $user = $request->user();
        if($user) {
            $cartItem = CartItem::query()->where(['id' => $request->id])->first();
            if($cartItem) {
                $cartItem->delete();
            }
            return response()->json(['success' => 'Product Remove From Cart']);
        } else {
            $cartItems = json_decode($request->cookie('cart_items', '[]'), true);
            foreach($cartItems as $i => &$item) {
                if($item['id'] === $request->id) {
                    array_splice($cartItems, $i, 1);
                    break;
                }
            }
            Cookie::queue('cart_items', json_encode($cartItems), 60 * 24 * 30);
            return response()->json(['success' => 'Product Remove From Cart']);
        }
    }


    public function updateCartQuantity(Request $request, $id)
{
    $user = $request->user();
    $operation = $request->query('operation');
    
    if ($user) {
        $cartItem = CartItem::where(['user_id' => $user->id, 'id' => $id])->first();
        
        if ($cartItem) {
            if ($operation === 'decrement' && $cartItem->qty > 1) {
                $cartItem->decrement('qty', 1);
            } elseif ($operation === 'increment') {
                $cartItem->increment('qty', 1);
            }
        }

        return response()->json('Done');
    } else {
        $cartItems = json_decode($request->cookie('cart_items', '[]'), true);
        
        foreach ($cartItems as &$item) {
            if ($item['product_id'] === $id) {
                if ($operation === 'decrement' && $item['qty'] > 1) {
                    $item['qty'] -= 1;
                } elseif ($operation === 'increment') {
                    $item['qty'] += 1;
                }
                break;
            }
        }
        
        Cookie::queue('cart_items', json_encode($cartItems), 60 * 24 * 30);

        return response()->json('Done');
    }
}

}