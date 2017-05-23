<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\Category\Index as IndexRequest;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Pipelines\Category\Index;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexRequest $request)
    {
        $pipe = new Index();

        $result = $pipe->fill($request)
            ->flush();

        if ($result->getStatus() == 0) {
            return response()->json($result->getResponse());
        }

        return response()
            ->setStatusCode(500)
            ->json($pipe->burst($result));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $category = new Category($request->all());
        $category->save();

        return response()->json(
            [
                'message' => 'Successfully stored Category.',
                'category' => $category,
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
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
     * @param Category      $category
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Category $category)
    {
        $category->fill($request->all());
        $category->save();

        return response()->json(
            [
                'category' => $category,
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(
            [
                'category' => $category,
            ]
        );
    }
}
