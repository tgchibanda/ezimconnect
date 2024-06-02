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

    public function AddMiniCart(){

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


    public function index()
    {
        list($products, $cartItems) = Cart::getProductsAndCartItems();
        $total = 0;
        foreach($products as $product) {
            $total += self::GetSellingPrice($product) * $cartItems[$product->id]['qty'];
        }
        return view('cart.index', compact('cartItems', 'products', 'total'));
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
    

    
    public function RemoveMiniCart(Request $request)
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

    public function updateQuantity(Request $request, Product $product)
    {
        $quantity = (int)$request->post('qty');
        $user = $request->user();

        if ($product->quantity !== null && $product->quantity < $quantity) {
            return response([
                'message' => match ( $product->quantity ) {
                    0 => 'The product is out of stock',
                    1 => 'There is only one item left',
                    default => 'There are only ' . $product->quantity . ' items left'
                }
            ], 422);
        }

        if ($user) {
            CartItem::where(['user_id' => $request->user()->id, 'product_id' => $product->id])->update(['qty' => $quantity]);

            return response([
                'count' => Cart::getCartItemsCount(),
            ]);
        } else {
            $cartItems = json_decode($request->cookie('cart_items', '[]'), true);
            foreach ($cartItems as &$item) {
                if ($item['product_id'] === $product->id) {
                    $item['qty'] = $quantity;
                    break;
                }
            }
            Cookie::queue('cart_items', json_encode($cartItems), 60 * 24 * 30);

            return response(['count' => Cart::getCountFromItems($cartItems)]);
        }
    }
}