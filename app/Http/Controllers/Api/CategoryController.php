<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
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
    $categories = Category::latest()->get();
    return new SuccessResource([
        'message' => 'All categories',
        'data' => CategoryResource::collection($categories),
    ]);
}


    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
{
    // The validation has already been performed by CategoryStoreRequest
    $formData = $request->validated();
    $formData['slug'] = Str::slug($formData['name']);

    // Your logic to save the data to the database or perform other actions

    return (new SuccessResource(['message' => 'Category successfully created']))->response()->setStatusCode(201);
}

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
{
    return new SuccessResource([
        'message' => 'Category details',
        'data' => new CategoryResource($category),
    ]);
}



    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {




        $formData = $request->validated();
        $formData['slug'] = Str::slug($formData['name']);

        // Use the update method on the specific category instance
        $category->update($formData);

        return (new SuccessResource(['message' => 'Category successfully updated']))->response()->setStatusCode(200);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        $category->delete();
        return (new SuccessResource(['message' => 'Category successfully deleted']))->response()->setStatusCode(204);

    }
}
