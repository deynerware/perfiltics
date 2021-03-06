<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection( Product::with('category' )->get() );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $json = $request->input( 'json' );
        $params_array = json_decode( $json, true );

        Product::create( $params_array );

        $data = array(
            'data' => [
                'status'        => 'success',
                'code'          => 200,
                'message'       => 'The Product was created correctly'
            ]
        );

        return response()->json( $data, 200 );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show( Product $product )
    {
        $product = new ProductResource( $product );

        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Product $product )
    {
        $json = $request->input( 'json' );
        $params_array = json_decode( $json, true );

        $product->update( $params_array );

        $data = array(
            'data' => [
                'status'        => 'success',
                'code'          => 200,
                'message'       => 'The product was updated correctly'
            ]
        );

        return response()->json( $data, 200 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy( Product $product )
    {
        $product->delete();

        $data = array(
            'data' => [
                'status'        => 'success',
                'code'          => 200,
                'message'       => 'The product was deleted correctly'
            ]
        );

        return response()->json( $data, 200 );
    }
}
