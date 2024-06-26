<?php

namespace App\Helpers;

use App\Models\CartItem;
use \App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class Cart
{

    public static function GetCartProducts()
    {

        $cartItems = Cart::getCartItems();
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['qty'];
        }

        return response()->json(array(
            'carts' => $cartItems,
            'cartQty' => count($cartItems),
            'cartTotal' => $total

        ));
    }

    public static function Destroy()
    {
        CartItem::where('user_id',Auth::id())->delete();
    }


    public static function getCartItemsCount(): int
    {
        $request = \request();
        $user = $request->user();
        if($user) {
            return CartItem::where('user_id', $user->id)->sum('qty');
        } else {
            $cartItems = self::getCookieCartItems();
            return array_reduce(
                $cartItems,
                fn($carry, $item) => $carry + $item['qty'], 
                0
            );
        }
    }

    public static function getCartItems()
    {
        $request = \request();
        $user = $request->user();
        if($user) {
            return CartItem::where('user_id', $user->id)->get()->map(
                fn($item) => [
                    'id' => $item->id, 
                    'user_id' => $item->user_id, 
                    'product_id' => $item->product_id, 
                    'qty' => $item->qty, 
                    'name' => $item->name, 
                    'price' => $item->price, 
                    'weight' => $item->weight, 
                    'options' => $item->options,
                    'discount' => $item->discount,
                    'tax' => $item->tax
                    ]
            );
        } else {
            return self::getCookieCartItems();
        }
    }

    public static function getCookieCartItems()
    {
        $request = \request();
        return json_decode($request->cookie('cart_items', '[]'), true);
    }

    public static function getCountFromItems($cartItems)
    {
        return array_reduce(
            $cartItems,
            fn($carry, $item) => $carry + $item['qty'], 
            0
        );
    }

    public static function moveCartItemsIntoDb()
    {
        $request = \request();
        $cartItems = self::getCookieCartItems();
        $dbCartItems = CartItem::where(['user_id'=> $request->user()->id])->get()->keyBy('product_id');
        $newCartItems = [];
        foreach ($cartItems as $cartItem) {
            if(isset($dbCartItems[$cartItem['product_id']])){
                continue;
            } 
                $newCartItems[] = [
                    'user_id' => $request->user()->id,
                    'product_id' => $cartItem['product_id'],
                    'name' => $cartItem['name'],
                    'qty' => $cartItem['qty'],
                    'price' => $cartItem['price'],
                    'weight' => 1,
                    'options' => json_encode($cartItem['options'])
                ];
        }
        /* if(!empty($newCartItems)){
            CartItem::insert($newCartItems);
        } */
    }

    public static function getProductsAndCartItems(): array|\Illuminate\Database\Eloquent\Collection
    {
        $cartItems = self::getCartItems();
        $ids = Arr::pluck($cartItems, 'product_id');
        $products = Product::query()->whereIn('id', $ids)->get();
        $cartItems = Arr::keyBy($cartItems, 'product_id');

        return [$products, $cartItems];
    }
}  