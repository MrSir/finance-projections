<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Http\Requests;
use App\Http\Requests\Account\IndexRequest;
use App\Http\Requests\Account\StoreRequest;
use App\Http\Requests\Account\UpdateRequest;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexRequest $request)
    {
        $accounts = Account::query();

        if($request->has('name')) {
            $accounts = $accounts->where('name', 'LIKE', '%'.$request->get('name').'%');
        }

        if($request->has('description')) {
            $accounts = $accounts->where('description', 'LIKE', '%'.$request->get('description').'%');
        }

        if($request->has('createdFrom')) {
            $accounts = $accounts->where('created_at', '>=', $request->get('createdFrom').' 00:00:00');
        }

        if($request->has('createdAt')) {
            $accounts = $accounts->where('created_at', '<=', $request->get('createdTo').' 23:59:59');
        }

        return response()->json(['accounts' => $accounts->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $account = new Account($request->all());
        $account->save();

        return response()->json([
            'message' => 'Successfully stored Account.',
            'account' => $account
        ]);
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
     * @param UpdateRequest $request
     * @param Account $account
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Account $account)
    {
        $account->fill($request->all());
        $account->save();

        return response()->json([
            'account' => $account
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Account $account
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Account $account)
    {
        $account->delete();

        return response()->json([
            'account' => $account
        ]);
    }
}