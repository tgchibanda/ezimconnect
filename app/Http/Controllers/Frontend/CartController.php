<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Helpers\Cart;
use Illuminate\Http\Request;
use \App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\ShipDivision;

class CartController extends Controller
{

    public function GetCartProducts()
    {
        return Cart::GetCartProducts();
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
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        
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
                'vendor' => $request->vendor_id,
            ])
        ];

        $totalQuantity = $quantity;

        if ($user) {
            CartItem::create($data);
            return response()->json(['success' => 'Successfully Added To Cart']);
        } else {

            return response()->json(['error' => 'You Have To Be Signed In For This Function']);
           /* $cartItems = json_decode($request->cookie('cart_items', '[]'), true);
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
            */
        }
    }


    public function MyCart()
    {

        return view('frontend.mycart.view_mycart');
    }

    public function RemoveCart(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $cartItem = CartItem::query()->where(['id' => $request->id])->first();
            if ($cartItem) {
                $cartItem->delete();
                if (Session::has('coupon')) {
                    $coupon_name = Session::get('coupon')['coupon_name'];
                    $coupon = Coupon::where('coupon_name', $coupon_name)->first();
                    $cartData = json_decode(Cart::GetCartProducts()->getContent(), true);
                    $cartTotal = $cartData['cartTotal'];
                    $discountAmount = round($cartTotal * $coupon->coupon_discount / 100);
                    Session::put('coupon', [
                        'coupon_name' => $coupon->coupon_name,
                        'coupon_discount' => $coupon->coupon_discount,
                        'discount_amount' => $discountAmount,
                        'total_amount' => round($cartTotal - $discountAmount)
                    ]);
                }
            }
            return response()->json(['success' => 'Product Remove From Cart']);
        } else {
            $cartItems = json_decode($request->cookie('cart_items', '[]'), true);
            foreach ($cartItems as $i => &$item) {
                if ($item['id'] === $request->id) {
                    array_splice($cartItems, $i, 1);
                    if (Session::has('coupon')) {
                        $coupon_name = Session::get('coupon')['coupon_name'];
                        $coupon = Coupon::where('coupon_name', $coupon_name)->first();
                        $cartData = json_decode(Cart::GetCartProducts()->getContent(), true);
                        $cartTotal = $cartData['cartTotal'];
                        $discountAmount = round($cartTotal * $coupon->coupon_discount / 100);
                        Session::put('coupon', [
                            'coupon_name' => $coupon->coupon_name,
                            'coupon_discount' => $coupon->coupon_discount,
                            'discount_amount' => $discountAmount,
                            'total_amount' => round($cartTotal - $discountAmount)
                        ]);
                    }
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


                if (Session::has('coupon')) {
                    $coupon_name = Session::get('coupon')['coupon_name'];
                    $coupon = Coupon::where('coupon_name', $coupon_name)->first();
                    $cartData = json_decode(Cart::GetCartProducts()->getContent(), true);
                    $cartTotal = $cartData['cartTotal'];
                    $discountAmount = round($cartTotal * $coupon->coupon_discount / 100);
                    Session::put('coupon', [
                        'coupon_name' => $coupon->coupon_name,
                        'coupon_discount' => $coupon->coupon_discount,
                        'discount_amount' => $discountAmount,
                        'total_amount' => round($cartTotal - $discountAmount)
                    ]);
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


                    if (Session::has('coupon')) {
                        $coupon_name = Session::get('coupon')['coupon_name'];
                        $coupon = Coupon::where('coupon_name', $coupon_name)->first();
                        $cartData = json_decode(Cart::GetCartProducts()->getContent(), true);
                        $cartTotal = $cartData['cartTotal'];
                        $discountAmount = round($cartTotal * $coupon->coupon_discount / 100);
                        Session::put('coupon', [
                            'coupon_name' => $coupon->coupon_name,
                            'coupon_discount' => $coupon->coupon_discount,
                            'discount_amount' => $discountAmount,
                            'total_amount' => round($cartTotal - $discountAmount)
                        ]);
                    }



                    break;
                }
            }

            Cookie::queue('cart_items', json_encode($cartItems), 60 * 24 * 30);

            return response()->json('Done');
        }
    }

    public function ApplyCoupon(Request $request)
    {

        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();

        if ($coupon) {
            $cartData = json_decode(Cart::GetCartProducts()->getContent(), true);
            $cartTotal = $cartData['cartTotal'];
            $discountAmount = round($cartTotal * $coupon->coupon_discount / 100);

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => $discountAmount,
                'total_amount' => round($cartTotal - $discountAmount)
            ]);

            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Successfully'

            ));
        } else {
            return response()->json(['error' => 'Invalid Coupon']);
        }
    }

    public function CouponCalculation()
    {
        $cartData = json_decode(Cart::GetCartProducts()->getContent(), true);
        $cartTotal = $cartData['cartTotal'];
        if (Session::has('coupon')) {

            return response()->json(array(
                'subtotal' => $cartTotal,
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        } else {
            return response()->json(array(
                'total' => $cartTotal,
            ));
        }
    }

    public function RemoveCoupon()
    {

        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);
    }

    public function CreateCheckout()
    {

        if (Auth::check()) {
            $cartItems = Cart::getCartItems();
            $cartData = json_decode(Cart::GetCartProducts()->getContent(), true);
            $cartTotal = $cartData['cartTotal'];
            if ($cartTotal > 0) {
                $carts = $cartItems;
                $cartQty = count($cartItems);
                $cartTotal = $cartTotal;

                $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();

                return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'cartTotal', 'divisions'));
            } else {

                $notification = array(
                    'message' => 'Add At list One Product',
                    'alert-type' => 'error'
                );

                return redirect()->to('/')->with($notification);
            }
        } else {

            $notification = array(
                'message' => 'You Need to Login To Checkout',
                'alert-type' => 'error'
            );

            return redirect()->route('login')->with($notification);
        }
    }
}
