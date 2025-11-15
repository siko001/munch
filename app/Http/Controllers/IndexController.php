<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class IndexController extends Controller {



    //Render the index page
    public function render() {

        //Display 9 random items from the menu
        $products = Product::inRandomOrder()->limit(9)->get();

        //get todays deal
        $activeDeal = Deal::activeDeals();

        //deal's ID
        $activeDealid = Deal::activeDeals()->first();

        //get all deals without today's
        $allDealsExcludingNow = Deal::where("id", "!=", $activeDealid?->id)?->inRandomOrder()->limit(1)->get();
        $cartItem = Cart::content()?->filter(function ($item) {
            return $item?->options?->category;
        });

        //get all "featured" comments rating only 4+ 
        $allcommentsfromusers = Comment::all()->where("rating", ">=", 4);

        

        return view("index", compact("activeDeal", "allDealsExcludingNow", "products", "cartItem", "allcommentsfromusers"));
    }
}
