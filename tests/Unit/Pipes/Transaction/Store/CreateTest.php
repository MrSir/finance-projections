<?php

namespace App\Tests\Unit\Pipes\Transaction\Store;

use App\Http\Requests\Transaction\Store as RequestStore;
use App\Models\Transaction;
use App\Passables\Transaction\Store;
use App\Pipes\Transaction\Store\Create;
use App\Tests\Unit\Pipes\Store\Create as StoreCreate;
use Carbon\Carbon;
use Exception;

/**
 * Class SearchTest
 * @package App\Tests\Unit\Pipes\Transaction\Store
 */
class CreateTest extends StoreCreate
{
    /**
     * SearchTest constructor.
     *
     * @param null   $name
     * @param array  $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct(
            $name,
            $data,
            $dataName
        );

        $this->setPassable(Store::class);
        $this->setRequest(RequestStore::class);
        $this->setPipe(Create::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Store
     * @group App.Pipes.Transaction.Store.Create
     * @group App.Pipes.Transaction.Store.Create.Success
     */
    public function testCreateSuccess()
    {
        $params = [
            "account_id" => 1,
            "destination_account_id" => 2,
            "category_id" => 3,
            "transaction_frequency_id" => 1,
            "is_credit" => true,
            "is_debit" => false,
            "name" => "Testing",
            "description" => "Its for testing",
            "amount" => 100,
            "occurred_at" => Carbon::now(),
        ];
        $this->setParams($params);

        $responseModel = $this->createSuccess();
        $dbModel = Transaction::find($responseModel->id);

        $this->assertEquals(
            $params['name'],
            $responseModel->name
        );
        $this->assertEquals(
            $params['name'],
            $dbModel->name
        );

        $this->assertEquals(
            $params['description'],
            $responseModel->description
        );
        $this->assertEquals(
            $params['description'],
            $dbModel->description
        );
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Transaction
     * @group                    App.Pipes.Transaction.Store
     * @group                    App.Pipes.Transaction.Store.Create
     * @group                    App.Pipes.Transaction.Store.Create.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Transaction create failed.
     */
    public function testCreateFailure()
    {
        $this->createFailure();
    }
}
