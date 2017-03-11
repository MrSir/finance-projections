<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\Transaction\IndexRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $transactions = Transaction::query();

        if ($request->has('name')) {
            $transactions = $transactions->where('name', 'LIKE', '%' . $request->get('name') . '%');
        }

        if ($request->has('description')) {
            $transactions = $transactions->where('description', 'LIKE', '%' . $request->get('description') . '%');
        }

        if ($request->has('createdFrom')) {
            $transactions = $transactions->where('created_at', '>=', $request->get('createdFrom') . ' 00:00:00');
        }

        if ($request->has('createdAt')) {
            $transactions = $transactions->where('created_at', '<=', $request->get('createdTo') . ' 23:59:59');
        }

        $transactions = $transactions->get()
            ->load(
                [
                    'category',
                    'frequency'
                ]
            );

        return response()->json(['transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaction = new Transaction($request->all());
        $transaction->save();

        return Redirect::to('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
