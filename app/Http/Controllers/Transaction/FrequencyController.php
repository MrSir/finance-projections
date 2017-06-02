<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\Frequency\Index as RequestIndex;
use App\Http\Requests\Transaction\Frequency\Store as RequestStore;
use App\Http\Requests\Transaction\Frequency\Update as RequestUpdate;
use App\Http\Requests\Transaction\Frequency\Destroy as RequestDestroy;
use App\Models\Transaction\Frequency;
use App\Pipelines\Transaction\Frequency\Index;
use App\Pipelines\Transaction\Frequency\Store;
use App\Pipelines\Transaction\Frequency\Update;
use App\Pipelines\Transaction\Frequency\Destroy;
use Illuminate\Http\JsonResponse;

/**
 * Class FrequencyController
 * @package App\Http\Controllers\Transaction
 */
class FrequencyController extends Controller
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
     * @return JsonResponse
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
     * @param RequestUpdate $request
     * @param Frequency     $frequency
     *
     * @return JsonResponse
     */
    public function update(RequestUpdate $request, Frequency $frequency)
    {
        // instantiate the pipe
        $pipe = new Update();
        $pipe->fill(
            $request,
            $frequency
        );

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
     * @param RequestDestroy $request
     * @param Frequency $frequency
     *
     * @return JsonResponse
     */
    public function destroy(RequestDestroy $request, Frequency $frequency)
    {
        // instantiate the pipe
        $pipe = new Destroy();
        $pipe->fill(
            $request,
            $frequency
        );

        // flush the pipe
        $result = $pipe->flush();

        // handle the response
        return response()
            ->json($result)
            ->setStatusCode($result['code']);
    }
}
