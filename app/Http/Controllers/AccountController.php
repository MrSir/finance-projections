<?php

namespace App\Http\Controllers;

use App\Account;
use App\Category;
use App\Http\Requests\Account\StoreRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['accounts' => Account::all()]);
    }


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
     * @param Request $request
     * @param Account $account
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Account $account)
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
