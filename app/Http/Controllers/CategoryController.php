<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\Destroy as RequestDestroy;
use App\Http\Requests\Category\Index as RequestIndex;
use App\Http\Requests\Category\Store as RequestStore;
use App\Http\Requests\Category\Update as RequestUpdate;
use App\Models\Category;
use App\Pipelines\Category\Destroy;
use App\Pipelines\Category\Index;
use App\Pipelines\Category\Store;
use App\Pipelines\Category\Update;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
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
        $pipeline = new Index();
        $pipeline->fill($request);

        // flush the pipe
        $result = $pipeline->flush();

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
        $pipeline = new Store();
        $pipeline->fill($request);

        // flush the pipe
        $result = $pipeline->flush();

        // handle the response
        return response()
            ->json($result)
            ->setStatusCode($result['code']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RequestUpdate $request
     * @param Category      $category
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RequestUpdate $request, Category $category)
    {
        // instantiate the pipe
        $pipeline = new Update();
        $pipeline->fill(
            $request,
            $category
        );

        // flush the pipe
        $result = $pipeline->flush();

        // handle the response
        return response()
            ->json($result)
            ->setStatusCode($result['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RequestDestroy $request
     * @param Category       $category
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RequestDestroy $request, Category $category)
    {
        // instantiate the pipe
        $pipeline = new Destroy();
        $pipeline->fill(
            $request,
            $category
        );

        // flush the pipe
        $result = $pipeline->flush();

        // handle the response
        return response()
            ->json($result)
            ->setStatusCode($result['code']);
    }
}
