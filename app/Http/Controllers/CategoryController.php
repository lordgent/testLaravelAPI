<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
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
    public function update($id) {

    }
}
