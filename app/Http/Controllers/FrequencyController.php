<?php

namespace App\Http\Controllers;

use App\Models\Transaction\Frequency;
use App\Http\Requests;
use App\Http\Requests\Frequency\IndexRequest;
use App\Http\Requests\Frequency\StoreRequest;
use App\Http\Requests\Frequency\UpdateRequest;

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
        $frequencies = Frequency::query();

        if($request->has('name')) {
            $frequencies = $frequencies->where('name', 'LIKE', '%'.$request->get('name').'%');
        }

        if($request->has('description')) {
            $frequencies = $frequencies->where('description', 'LIKE', '%'.$request->get('description').'%');
        }

        if($request->has('createdFrom')) {
            $frequencies = $frequencies->where('created_at', '>=', $request->get('createdFrom').' 00:00:00');
        }

        if($request->has('createdAt')) {
            $frequencies = $frequencies->where('created_at', '<=', $request->get('createdTo').' 23:59:59');
        }

        return response()->json(['frequencies' => $frequencies->get()]);
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
