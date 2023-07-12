<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {

    public function addNewProduct(Request $request) {
        $input = $request->validate([
            "name" => "max:30|min:3|required",
            "price" => ["regex:/^[0-9]+(?:\.[0-9]+)?$/", "max:6", "min:1", "required"],
            "description" => "max:120|min:10|required",
            "image" => 'required|image|mimes:jpeg,png,jpg,gif',
            "category" => "required"
        ]);

        if ($input) {
            $input['name'] = ucwords($input['name']);
            $image = $request->file('image');
            $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the image in the storage/app/public/images directory
            $path = $image->storeAs('images', $fileName, 'public');
            $input['image'] = $path;
            $product = new Product($input);
            $product->save();
            return redirect()->back()->with("success", $product->name . " Added Successfully");
        } else {
            return redirect()->back()->with("failure", "something went wrong please try again!");
        }
    }

    public function showAllMenu() {
        $products = Product::get()->all();
        return view("/menu", compact("products"));
    }


    public function showSingleProduct($id) {
        $product = Product::where('id', '=', $id)->first();
        return view("edit-product", compact("product"));
    }

    public function outOfStock($id) {
        $product = Product::findOrFail($id);
        $product->avaliable = false;
        $product->save();

        return redirect()->back()->with("success", "Product Marked as Out Of Stock");
    }

    public function backInStock($id) {
        $product = Product::findOrFail($id);
        $product->avaliable = true;
        $product->save();

        return redirect()->back()->with("success", "Product Marked as Back In Stock");
    }

    public function updateProduct(Request $request, $id) {
        $product = Product::findOrFail($id);
        $incomingFields = $request->validate([
            "name" => "sometimes|max:20",
            "price" => "sometimes|regex:/^[0-9]+(?:\.[0-9]+)?$/|max:5",
            "description" => "sometimes|max:20",
            "category" => "sometimes|max:20",
        ]);


        $defaults = ['name', 'price', 'description', 'category'];

        dd($incomingFields['category']);
        foreach ($defaults as $field) {
            if (empty($incomingFields[$field])) {
                $incomingFields[$field] = $product->$field;
            }
        }

        $product->update($incomingFields);
        $product->save();
        return redirect()->back()->with("success", "Product Updated");
    }



    public function deleteProduct($id) {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with("failure", "Something went wrong Please Try Again");
        }
        $product->delete();

        return redirect("/menu")->with("success", "Product deleted successfully");
    }




    public function getMenu() {
        $products = Product::inRandomOrder()->get();
        return response()->json($products, 200, [], JSON_PRETTY_PRINT);
    }
}
