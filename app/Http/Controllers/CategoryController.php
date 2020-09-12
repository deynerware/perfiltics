<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryResource::collection(Category::all()); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $json = $request->input('json');
        $params_array = json_decode($json, true);

        Category::create($params_array);

        $data = array(
            'data' => [
                'status'        => 'success',
                'code'          => 200,
                'message'       => 'The category was created correctly'
            ]
        );

        return response()->json( $data, 200 );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $category = new CategoryResource($category);

        return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $json = $request->input('json');
        $params_array = json_decode($json, true);

        $category->update($params_array);

        $data = array(
            'data' => [
                'status'        => 'success',
                'code'          => 200,
                'message'       => 'The category was updated correctly'
            ]
        );

        return response()->json( $data, 200 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        $data = array(
            'data' => [
                'status'        => 'success',
                'code'          => 200,
                'message'       => 'The category was deleted correctly'
            ]
        );

        return response()->json( $data, 200 );
    }
}
