<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction\Frequency;
use App\Http\Requests;
use App\Http\Requests\Transaction\Frequency\Index as RequestIndex;
use App\Http\Requests\Transaction\Frequency\Store as RequestStore;
use App\Http\Requests\Frequency\UpdateRequest;
use App\Pipelines\Transaction\Frequency\Index;
use App\Pipelines\Transaction\Frequency\Store;

class FrequencyController extends Controller
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
     * @param UpdateRequest $request
     * @param Frequency $frequency
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Frequency $frequency)
    {
        $frequency->fill($request->all());
        $frequency->save();

        return response()->json([
            'frequency' => $frequency
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Frequency $frequency
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Frequency $frequency)
    {
        $frequency->delete();

        return response()->json([
            'frequency' => $frequency
        ]);
    }
}
