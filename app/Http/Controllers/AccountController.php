<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\Index as RequestIndex;
use App\Http\Requests\Account\Store as RequestStore;
use App\Http\Requests\Account\UpdateRequest;
use App\Models\Account;
use App\Pipelines\Account\Index;
use App\Pipelines\Account\Store;

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
     * @param Account       $account
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Account $account)
    {
        $account->fill($request->all());
        $account->save();

        return response()->json(
            [
                'account' => $account,
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Account $account
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Account $account)
    {
        $account->delete();

        return response()->json(
            [
                'account' => $account,
            ]
        );
    }
}
