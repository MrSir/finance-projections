<?php

namespace App\Tests\Unit\Pipes\Transaction\Update;

use App\Http\Requests\Transaction\Update as RequestUpdate;
use App\Models\Transaction;
use App\Passables\Transaction\Update as PassableUpdate;
use App\Pipes\Transaction\Update\Update;
use App\Tests\Unit\Pipes\Update\Update as PipeUpdate;
use Carbon\Carbon;
use Exception;

/**
 * Class UpdateTest
 * @package App\Tests\Unit\Pipes\Transaction\Update
 */
class UpdateTest extends PipeUpdate
{
    /**
     * UpdateTest constructor.
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

        $this->setPassable(PassableUpdate::class);
        $this->setRequest(RequestUpdate::class);
        $this->setPipe(Update::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Update
     * @group App.Pipes.Transaction.Update.Update
     * @group App.Pipes.Transaction.Update.Update.Success
     */
    public function testUpdateSuccess()
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
        $this->setModel(Transaction::find(1));

        $responseModel = $this->updateSuccess();
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
     * @group                    App.Pipes.Transaction.Update
     * @group                    App.Pipes.Transaction.Update.Update
     * @group                    App.Pipes.Transaction.Update.Update.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Transaction update failed.
     */
    public function testUpdateFailure()
    {
        $this->updateFailure();
    }
}
