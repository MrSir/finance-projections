<?php

namespace App\Tests\Unit\Pipes\Transaction\Destroy;

use App\Http\Requests\Transaction\Destroy as RequestDestroy;
use App\Models\Transaction;
use App\Passables\Transaction\Destroy as PassableDestroy;
use App\Pipes\Transaction\Destroy\Delete;
use App\Tests\Unit\Pipes\Destroy\Delete as PipeDelete;
use Exception;

/**
 * Class DeleteTest
 * @package App\Tests\Unit\Pipes\Transaction\Destroy
 */
class DeleteTest extends PipeDelete
{
    /**
     * DeleteTest constructor.
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

        $this->setPassable(PassableDestroy::class);
        $this->setRequest(RequestDestroy::class);
        $this->setPipe(Delete::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Destroy
     * @group App.Pipes.Transaction.Destroy.Delete
     * @group App.Pipes.Transaction.Destroy.Delete.Success
     */
    public function testUpdateSuccess()
    {
        $this->setModel(Transaction::find(1));

        $responseModel = $this->deleteSuccess();
        $dbModel = Transaction::find($responseModel->id);

        $this->assertNull($dbModel);
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Transaction
     * @group                    App.Pipes.Transaction.Destroy
     * @group                    App.Pipes.Transaction.Destroy.Delete
     * @group                    App.Pipes.Transaction.Destroy.Delete.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Transaction delete failed.
     */
    public function testUpdateFailure()
    {
        $this->deleteFailure();
    }
}
