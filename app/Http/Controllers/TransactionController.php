<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\Destroy as RequestDestroy;
use App\Http\Requests\Transaction\Index as RequestIndex;
use App\Http\Requests\Transaction\Store as RequestStore;
use App\Http\Requests\Transaction\Update as RequestUpdate;
use App\Models\Transaction;
use App\Pipelines\Transaction\Destroy;
use App\Pipelines\Transaction\Index;
use App\Pipelines\Transaction\Store;
use App\Pipelines\Transaction\Update;
use Illuminate\Http\JsonResponse;

/**
 * Class TransactionController
 * @package App\Http\Controllers
 */
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param RequestIndex $request
     *
     * @return JsonResponse
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
     * @param  RequestStore $request
     *
     * @return JsonResponse
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
     * @param Transaction   $transaction
     *
     * @return JsonResponse
     */
    public function update(RequestUpdate $request, Transaction $transaction)
    {
        // instantiate the pipeline
        $pipeline = new Update();
        $pipeline->fill($request, $transaction);

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
     * @param Transaction    $transaction
     *
     * @return JsonResponse
     */
    public function destroy(RequestDestroy $request, Transaction $transaction)
    {
        // instantiate the pipeline
        $pipeline = new Destroy();
        $pipeline->fill($request, $transaction);

        // flush the pipeline
        $result = $pipeline->flush();

        // handle the response
        return response()
            ->json($result)
            ->setStatusCode($result['code']);
    }
}
