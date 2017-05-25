<?php

namespace App\Tests\Unit\Pipes\Transaction\Frequency\Update;

use App\Http\Requests\Transaction\Frequency\Update as RequestUpdate;
use App\Models\Transaction\Frequency;
use App\Passables\Transaction\Frequency\Update as PassableUpdate;
use App\Pipes\Transaction\Frequency\Update\Update;
use App\Tests\Unit\Pipes\Update\Update as PipeUpdate;
use Exception;

/**
 * Class UpdateTest
 * @package App\Tests\Unit\Pipes\Transaction\Frequency\Update
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
     * @group App.Pipes.Transaction.Frequency
     * @group App.Pipes.Transaction.Frequency.Update
     * @group App.Pipes.Transaction.Frequency.Update.Update
     * @group App.Pipes.Transaction.Frequency.Update.Update.Success
     */
    public function testUpdateSuccess()
    {
        $params = [
            'name' => 'Testing',
            'description' => 'A category built for testing',
        ];
        $this->setParams($params);
        $this->setModel(Frequency::find(2));

        $responseModel = $this->updateSuccess();
        $dbModel = Frequency::find($responseModel->id);

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
     * @group                    App.Pipes.Transaction.Frequency
     * @group                    App.Pipes.Transaction.Frequency.Update
     * @group                    App.Pipes.Transaction.Frequency.Update.Update
     * @group                    App.Pipes.Transaction.Frequency.Update.Update.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Frequency update failed.
     */
    public function testUpdateFailure()
    {
        $this->updateFailure();
    }
}
