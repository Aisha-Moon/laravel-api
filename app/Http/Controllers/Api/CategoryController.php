<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::latest()->get();
        return response()->json([
            'success'=>'true',
            'message'=>'Category Successfully Retrieved',
            'data'=>$categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $data = Validator::make($request->all(), [
            'name' => 'required|string|unique:categories',
        ]);

        // Check if validation fails
        if ($data->fails()) {
            return response()->json([
                'success'=>false,
                'message'=>'Error',
                'errors'=>$data->errors(),

            ], 422);
        }
        $formData=$data->validated();
        $formData['slug']=Str::slug($formData['name']);
        Category::create($formData);

        return response()->json([
            'success'=>true,
            'message'=>'Category successfully created',
            'data'=>[],

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category=Category::find($id);

       if(!$category){
        return response()->json([
            'success'=>false,
            'message'=>'Category not found',
            'errors'=>[],

        ],400);
       }
       return response()->json([
        'success'=>true,
        'message'=>'Successfully',
        'data'=>$category,

      ]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found',
                'errors' => [],
            ], 404);
        }

        $data = Validator::make($request->all(), [
            'name' => 'required|string|unique:categories,name,' . $category->id,
        ]);

        // Check if validation fails
        if ($data->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'errors' => $data->errors(),
            ], 422);
        }

        $formData = $data->validated();
        $formData['slug'] = Str::slug($formData['name']);

        // Use the update method on the specific category instance
        $category->update($formData);

        return response()->json([
            'success' => true,
            'message' => 'Category successfully updated',
            'data' => $category, // Return the updated category data
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found',
                'errors' => [],
            ], 404);
        }
        $category->delete();
        return response()->json([
            'success' => true,
            'message' => 'Category Deleted Successfully',
            'data' => [],
        ]);
    }
}
