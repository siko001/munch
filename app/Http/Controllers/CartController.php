<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;


class CartController extends Controller {

    //Set the Coupon code if applied, if not be null
    public function cart() {

        $cart =  Cart::content()->first();
        if ($cart) {
            $cartCouponCode = $cart->options->coupon_code;
        } else {
            $cartCouponCode = null;
        }
        return view("cart", compact("cartCouponCode"));
    }

    //Add product to cart
    public function addToCart($id) {
        $product =  Product::findOrFail($id);
        $discount = 0; // Set the discount amount here
        Cart::add([
            "id" => $product->id,
            "name" => $product->name,
            "qty" => 1,
            "price" => $product->price,
            "weight" => 0,
            "options" => ["category" => $product->category, "discount" => $discount] //category for the deal, discount to apply only once
        ]);
        return redirect()->back()->with("success", "Added " . $product->name . " to cart");
    }

    //increment product by 1 in cart if product = 0  remove it
    public function incrementCart($id) {
        $product = Cart::get($id);
        $updatedQty = $product->qty + 1;
        Cart::update($id, $updatedQty);
        return redirect()->back()->with("success", "Added 1 " . $product->name . " to cart");
    }
    //decrement product by 1 in the cart. if product = 0  remove it
    public function decrementCart($id) {
        $product = Cart::get($id);
        $updatedQty = $product->qty - 1;
        if ($updatedQty <= 0) {
            Cart::remove($id);
            return redirect()->back()->with("success", $product->name . " Removed completely from cart");
        } else {
            Cart::update($id, $updatedQty);
            return redirect()->back()->with("success", "Removed 1 " . $product->name . " from cart");
        }
    }

    //Remove 1 item from cart
    public function removeFromCart($id) {
        Cart::remove($id);
    }

    //empty cart and destroy session for cart
    public function emptyCart() {
        cart::destroy();
        return redirect()->back()->with("success", "Cart Emptied");
    }
}
