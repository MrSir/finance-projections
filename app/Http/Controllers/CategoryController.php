<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Http\Requests\Category\IndexRequest;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $categories = Category::query();

        if($request->has('name')) {
            $categories = $categories->where('name', 'LIKE', '%'.$request->get('name').'%');
        }

        if($request->has('description')) {
            $categories = $categories->where('description', 'LIKE', '%'.$request->get('description').'%');
        }

        if($request->has('createdFrom')) {
            $categories = $categories->where('created_at', '>=', $request->get('createdFrom').' 00:00:00');
        }

        if($request->has('createdAt')) {
            $categories = $categories->where('created_at', '<=', $request->get('createdTo').' 23:59:59');
        }

        return response()->json(['categories' => $categories->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $category = new Category($request->all());
        $category->save();

        return response()->json([
            'message' => 'Successfully stored Category.',
            'category' => $category
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Category $category)
    {
        $category->fill($request->all());
        $category->save();

        return response()->json([
            'category' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'category' => $category
        ]);
    }
}
