<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Deal;
use Illuminate\Http\Request;
use App\Http\Requests\CouponRequest;
use Gloudemans\Shoppingcart\Facades\Cart;

class DealController extends Controller {

    //view all active deals
    public function render() {
        $activeDeals = Deal::all();
        return view("deal", compact("activeDeals"));
    }


    //apply deal (polymorpic) automatic apply start from here/ manual apply from the bottom
    public function applyDeal($type) {
        $deal = Deal::activeDeals()->where('type', $type)->first();
        $today = Carbon::now()->englishDayOfWeek;

        //check if the deal applys today
        if (!$deal || $deal->start_date != $today) {
            return redirect()->back()->with("failure", "Not Applicable Today, sorry");
        }

        //apply the fucntion accordingly
        switch ($type) {
            case "pizza":
                return $this->pizza($deal, $type);
                break;
            case "burger":
                return $this->burger($deal, $type);
                break;
            case "pasta":
                return $this->pasta($deal, $type);
                break;
            case "salad":
                return $this->salad($deal, $type);
                break;
            case "side":
                return $this->side($deal, $type);
                break;
            case "total_price":
                return $this->totalPrice($deal, $type);
                break;
            default:
                return redirect()->back()->with("failure", "Invalid deal type");
        }
    }

    public function pizza($deal, $type) {
        // Get the pizzas in the cart
        $deals = Deal::pluck('coupon_code');
        $coupon = $deals->skip(0)->first();
        $discountPercentage = $deal->discount / 100;
        $pizzas = Cart::content()->filter(function ($item) {
            return $item->options->category === 'pizza';
        });

        if ($pizzas->isEmpty()) {
            return redirect("/menu1")->with("failure", "Please apply the deal with a " . $type);
        }

        foreach ($pizzas as $pizza) {
            $discountedPrice = $pizza->price * (1 - $discountPercentage);
            $totalDiscount = $pizza->price - $discountedPrice;
            $pizza->price = $discountedPrice;
            $pizza->options->deal_applied = true;
            $pizza->options->coupon_code = $coupon;
        }

        return redirect("/cart")->with("discount", "Pizza deal applied successfully")->with("totalDiscount", $totalDiscount);
    }


    //burger
    public function burger($deal, $type) {
        // Get the pizzas in the cart
        $deals = Deal::pluck('coupon_code');
        $coupon = $deals->skip(1)->first();
        $discountPercentage = $deal->discount / 100;
        $burgers = Cart::content()->filter(function ($item) {
            return $item->options->category === 'burger';
        });

        if ($burgers->isEmpty()) {
            return redirect("/menu1")->with("failure", "Please apply the deal with a " . $type);
        }

        foreach ($burgers as $burger) {
            $discountedPrice = $burger->price * (1 - $discountPercentage);
            $totalDiscount = $burger->price - $discountedPrice;
            $burger->price = $discountedPrice;
            $burger->options->deal_applied = true;
            $burger->options->coupon_code = $coupon;
        }

        return redirect("/cart")->with("discount", "Burger deal applied successfully")->with("totalDiscount", $totalDiscount);
    }
    //Pasta
    public function pasta($deal, $type) {
        // Get the pizzas in the cart
        $deals = Deal::pluck('coupon_code');
        $coupon = $deals->skip(5)->first();
        $discountPercentage = $deal->discount / 100;
        $pastas = Cart::content()->filter(function ($item) {
            return $item->options->category === 'pasta';
        });

        if ($pastas->isEmpty()) {
            return redirect("/menu1")->with("failure", "Please apply the deal with a " . $type);
        }

        foreach ($pastas as $pasta) {
            $discountedPrice = $pasta->price * (1 - $discountPercentage);
            $totalDiscount = $pasta->price - $discountedPrice;
            $pasta->price = $discountedPrice;
            $pasta->options->deal_applied = true;
            $pasta->options->coupon_code = $coupon;
        }

        return redirect("/cart")->with("discount", "Pasta deal applied successfully")->with("totalDiscount", $totalDiscount);
    }

    //burger
    public function salad($deal, $type) {
        $deals = Deal::pluck('coupon_code');
        $dealName = $deal->name;
        if ($dealName === "Salad Special Sundays") {
            $coupon = $deals->skip(2)->first();
        } else {
            $coupon = $deals->skip(6)->first();
        }

        // Get the pizzas in the cart
        $discountPercentage = $deal->discount / 100;
        $salads = Cart::content()->filter(function ($item) {
            return $item->options->category === 'salad';
        });

        if ($salads->isEmpty()) {
            return redirect("/menu1")->with("failure", "Please apply the deal with a " . $type);
        }

        foreach ($salads as $salad) {
            $discountedPrice = $salad->price * (1 - $discountPercentage);
            $totalDiscount = $salad->price - $discountedPrice;
            $salad->price = $discountedPrice;
            $salad->options->deal_applied = true;
            $salad->options->coupon_code = $coupon;
        }

        return redirect("/cart")->with("discount", "Salad deal applied successfully")->with("totalDiscount", $totalDiscount);
    }

    //Side

    public function side($deal, $type) {
        // Get the pizzas in the cart
        $deals = Deal::pluck('coupon_code');
        $coupon = $deals->skip(3)->first();
        $discountPercentage = $deal->discount / 100;
        $sides = Cart::content()->filter(function ($item) {
            return $item->options->category === 'side';
        });

        if ($sides->isEmpty()) {
            return redirect("/menu1")->with("failure", "Please apply the deal with a " . $type);
        }

        foreach ($sides as $side) {
            $discountedPrice = $side->price * (1 - $discountPercentage);
            $totalDiscount = $side->price - $discountedPrice;
            $side->price = $discountedPrice;
            $side->options->deal_applied = true;
            $side->options->coupon_code = $coupon;
        }

        return redirect("/cart")->with("discount", "side deal applied successfully")->with("totalDiscount", $totalDiscount);
    }


    public function totalPrice($deal, $type) {
        // Get the pizzas in the cart
        $deals = Deal::pluck('coupon_code');
        $coupon = $deals->skip(4)->first();
        $discountPercentage = $deal->discount / 100;
        $everything = Cart::content();
        $price = Cart::total();
        if ($everything->isEmpty()) {
            return redirect("/menu1")->with("failure", "Please Put 75euro worth for this deal");
        }

        if ($price < 75) {
            return redirect("/menu1")->with("failure", "Please Put 75euro worth for this deal");
        }

        foreach ($everything as $todos) {
            $discountedPrice = $todos->price * (1 - $discountPercentage);
            $totalDiscount = $todos->price - $discountedPrice;
            $todos->price = $discountedPrice;
            $todos->options->deal_applied = true;
            $todos->options->coupon_code = $coupon;
        }

        return redirect("/cart")->with("discount", "Deal applied successfully")->with("totalDiscount", $totalDiscount);
    }



    //if the user decides to enter the cupon Manually gets the same logic like 
    public function applyDealManually(CouponRequest $request) {
        $input = $request->validate([
            "coupon" => "required"
        ]);

        switch ($input["coupon"]) {
            case "420MyPiZzA":
                return  $this->applyDeal("pizza");
                break;
            case "GiVeMEtheBEEF":
                return  $this->applyDeal("burger");
                break;
            case "25%LessBoring":
                return   $this->applyDeal("salad");
                break;
            case "GrAbAsIdE":
                return    $this->applyDeal("side");
                break;
            case "QuaRtErMoRe":
                return   $this->applyDeal("total_price");
                break;
            case "GiVeMePASTaa":
                return   $this->applyDeal("pasta");
                break;
            case "eAtThEGraSS":
                return  $this->applyDeal("salad");
                break;
            default:
                return "Not A Valid Coupon Code";
                break;
        }
    }
}
