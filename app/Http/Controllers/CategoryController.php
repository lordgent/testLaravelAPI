<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    public function index() {
        $category = Category::orderBy('updated_at', 'DESC')->get();
        $response = [

            'status' => 'success',
            'message' => 'All Category',
            'data'=> $category
        ];
        return response()->json($response, 200);
    }
     
    public function create(Request $request) {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            
        ]);
       
        if($validator->fails() ) {
            return response()->json($validator->errors());       
        }

        $category = Category::create([
            'title' => $request -> title,
         ]);

         
        return response()->json([
            'status' => 'success',
            'message' => 'create category success',
            'data' => $category
        ]);
    }
    public function update(Request $request,$id) {

        $product=Category::find($id);
        $product->update($request->all());
        return response()->json([
            "status" => "success",
            "message" => "update Success"
        ], 200);
    }
    public function destroy($id)
    {

        $category = Category::find($id);
        if($category) {
             $destroy = Category::destroy($id);
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
