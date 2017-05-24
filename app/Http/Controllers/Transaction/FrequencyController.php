<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction\Frequency;
use App\Http\Requests;
use App\Http\Requests\Frequency\IndexRequest;
use App\Http\Requests\Frequency\StoreRequest;
use App\Http\Requests\Frequency\UpdateRequest;
use App\Pipelines\Transaction\Frequency\Index;

class FrequencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexRequest $request)
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
        $frequency = new Frequency($request->all());
        $frequency->save();

        return response()->json([
            'message' => 'Successfully stored Frequency.',
            'frequency' => $frequency
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
