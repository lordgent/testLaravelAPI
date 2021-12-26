<?php

namespace App\Http\Controllers;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        $products = product::orderBy('updated_at', 'DESC')->get();
        $response = [

            'status' => 'success',
            'message' => 'All Products',
            'data'=> $products
        ];
        return response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nameproduct' => 'required',
            'stock' => 'required',
            'idcategory' => 'required'
        ]);
       
        if($validator->fails() ) {
            return response()->json($validator->errors());       
        }

        $product = product::create([
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = product::find($id);

        if($product === null) {
            return response()->json([
                'status' => 'bad requets',
                'data' => 'product not found'
        
            ], 400);
        }
        return response()->json([
            'status' => 'success',
            'data' => $product
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request -> nameproduct;


        $product = product::find($id);
        $product -> nameproduct = $data;
        $product->save();

        if($product === null) {
            return response()->json([
                'status' => 'bad requets',
                'data' => 'product not found'
            ], 400);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'product product success'
        ], 200);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = product::find($id);

        if($product === null) {
            return response()->json([
                'status' => 'bad requets',
                'data' => 'product not found'
        
            ], 400);
        }
        $product -> delete();
        return response()->json([
            'status' => 'success',
            'message' => 'delete product success'
        ], 200);
        
    }
public function titleCategory(Request $request, $id) {
  

}


}
