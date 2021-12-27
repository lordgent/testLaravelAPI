<?php

namespace App\Http\Controllers;
use App\Models\Transation;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransationController extends Controller
{
    public function index () {
        $data = Transation::orderBy('updated_at', 'DESC')->get();
        $response = [
            'status' => 'success',
            'message' => 'All Transaction',
            'data'=> $data
        ];
        return response()->json($response, 200);
    }
   public function create(Request $request) {
    $name = $request -> nameproduct;
    $idproduct = $request -> idproduct;
    $total = $request -> total;
    $product = Product::find($idproduct);
    if($total > $product -> avilable ) {
        return response()->json([
            'status' => 'failed',
        ], 400); 
     } else {
        $transaction = Transation::create([
            'idproduct' => $idproduct,
            'total' => $total,
         ]);
        $product -> avilable = $product -> avilable - $transaction -> total;
        $product -> sold = $product -> sold + $transaction -> total;
        $product -> save();
       return response()->json([
           'status' => 'success',
           'message' => 'create product success',
       ]);
     }

   }
}
