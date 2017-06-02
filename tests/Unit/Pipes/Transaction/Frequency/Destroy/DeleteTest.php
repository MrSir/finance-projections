<?php

namespace App\Tests\Unit\Pipes\Transaction\Frequency\Destroy;

use App\Http\Requests\Transaction\Frequency\Destroy as RequestDestroy;
use App\Models\Transaction\Frequency;
use App\Passables\Transaction\Frequency\Destroy as PassableDestroy;
use App\Pipes\Transaction\Frequency\Destroy\Delete;
use App\Tests\Unit\Pipes\Destroy\Delete as PipeDelete;
use Exception;

/**
 * Class DeleteTest
 * @package App\Tests\Unit\Pipes\Transaction\Frequency\Destroy
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
     * @group App.Pipes.Transaction.Frequency
     * @group App.Pipes.Transaction.Frequency.Destroy
     * @group App.Pipes.Transaction.Frequency.Destroy.Delete
     * @group App.Pipes.Transaction.Frequency.Destroy.Delete.Success
     */
    public function testUpdateSuccess()
    {
        $this->setModel(Frequency::find(2));

        $responseModel = $this->deleteSuccess();
        $dbModel = Frequency::find($responseModel->id);

        $this->assertNull($dbModel);
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Transaction
     * @group                    App.Pipes.Transaction.Frequency
     * @group                    App.Pipes.Transaction.Frequency.Destroy
     * @group                    App.Pipes.Transaction.Frequency.Destroy.Delete
     * @group                    App.Pipes.Transaction.Frequency.Destroy.Delete.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Frequency delete failed.
     */
    public function testUpdateFailure()
    {
        $this->deleteFailure();
    }
}
