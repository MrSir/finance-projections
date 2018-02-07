<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\Destroy as RequestDestroy;
use App\Http\Requests\Account\Index as RequestIndex;
use App\Http\Requests\Account\Store as RequestStore;
use App\Http\Requests\Account\Update as RequestUpdate;
use App\Models\Account;
use App\Pipelines\Account\Index;
use App\Pipelines\Account\Store;
use App\Pipelines\Account\Update;
use App\Pipelines\Account\Destroy;

/**
 * Class AccountController
 * @package App\Http\Controllers
 */
class AccountController extends Controller
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
        // instantiate the pipeline
        $pipeline = new Index();
        $pipeline->fill($request);

        // flush the pipeline
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
        // instantiate the pipeline
        $pipeline = new Store();
        $pipeline->fill($request);

        // flush the pipeline
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
     * @param Account       $account
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RequestUpdate $request, Account $account)
    {
        // instantiate the pipeline
        $pipeline = new Update();
        $pipeline->fill(
            $request,
            $account
        );

        // flush the pipeline
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
     * @param Account        $account
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RequestDestroy $request, Account $account)
    {
        // instantiate the pipeline
        $pipeline = new Destroy();
        $pipeline->fill(
            $request,
            $account
        );

        // flush the pipeline
        $result = $pipeline->flush();

        // handle the response
        return response()
            ->json($result)
            ->setStatusCode($result['code']);
    }
}
