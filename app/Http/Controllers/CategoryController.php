<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\Index as RequestIndex;
use App\Http\Requests\Category\Store as RequestStore;
use App\Http\Requests\Category\Update as RequestUpdate;
use App\Models\Category;
use App\Pipelines\Category\Index;
use App\Pipelines\Category\Store;
use App\Pipelines\Category\Update;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param RequestIndex $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RequestIndex $request)
    {
        // instantiate the pipe
        $pipe = new Index();
        $pipe->fill($request);

        // flush the pipe
        $result = $pipe->flush();

        // handle the response
        return response()
            ->json($result)
            ->setStatusCode($result['code']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RequestStore $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RequestStore $request)
    {
        // instantiate the pipe
        $pipe = new Store();
        $pipe->fill($request);

        // flush the pipe
        $result = $pipe->flush();

        // handle the response
        return response()
            ->json($result)
            ->setStatusCode($result['code']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RequestUpdate   $request
     * @param Category $category
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RequestUpdate $request, Category $category)
    {
        // instantiate the pipe
        $pipe = new Update();
        $pipe->fill($request, $category);

        // flush the pipe
        $result = $pipe->flush();

        // handle the response
        return response()
            ->json($result)
            ->setStatusCode($result['code']);
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
