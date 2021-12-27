<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('updated_at', 'DESC')->get();
        $response = [
            'status' => 'success',
            'message' => 'All Products',
            'data'=> $products
        ];
        return response()->json($response, 200);
    }
    public function create(Request $request) 
    {
        $validator = Validator::make($request->all(),[
            'nameproduct' => 'required',
            'stock' => 'required',
            'idcategory' => 'required'
        ]);
       
        if($validator->fails() ) {
            return response()->json($validator->errors());       
        }

        $product = Product::create([
            'nameproduct' => $request -> nameproduct,
            'stock' => $request->stock,
            'idcategory' => $request->idcategory,
            'avilable' => $request -> stock,
            'sold' => 0,
         ]);
         
        return response()->json([
            'status' => 'success',
            'message' => 'create product success',
            'data' => $product
        ]);
    }

    public function update(Request $request,$id) {
        $name = $request -> nameproduct;
        $stock = $request -> stock;
        
        $product=Product::find($id);
        $product-> nameproduct = $name;
        $product-> stock = $stock;
       $product -> avilable = $stock;
       $product -> save();
        return response()->json([
            "status" => "success",
            "message" => "update Success"
        ], 200);
    }

    public function destroy($id)
    {

        $category = Product::find($id);
        if($category) {
             $destroy = Product::destroy($id);
             return response()->json([
                "status" => "success",
                "message" => "Delete Success"
            ], 200);
    
        }
        return response()->json([
            "status" => "failed",
            "message" => "Category Not Found"
        ], 400);

    }

}
