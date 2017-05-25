<?php

namespace App\Tests\Unit\Pipes\Account\Update;

use App\Http\Requests\Account\Update as RequestUpdate;
use App\Models\Account;
use App\Passables\Account\Update as PassableUpdate;
use App\Pipes\Account\Update\Update;
use App\Tests\Unit\Pipes\Update\Update as PipeUpdate;
use Exception;

/**
 * Class UpdateTest
 * @package App\Tests\Unit\Pipes\Account\Update
 */
class UpdateTest extends PipeUpdate
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

        $this->setPassable(PassableUpdate::class);
        $this->setRequest(RequestUpdate::class);
        $this->setPipe(Update::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Account
     * @group App.Pipes.Account.Update
     * @group App.Pipes.Account.Update.Update
     * @group App.Pipes.Account.Update.Update.Success
     */
    public function testUpdateSuccess()
    {
        $params = [
            'name' => 'Testing',
            'description' => 'A category built for testing',
        ];
        $this->setParams($params);
        $this->setModel(Account::find(2));

        $responseModel = $this->updateSuccess();
        $dbModel = Account::find($responseModel->id);

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
     * @group                    App.Pipes.Account
     * @group                    App.Pipes.Account.Update
     * @group                    App.Pipes.Account.Update.Update
     * @group                    App.Pipes.Account.Update.Update.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Account update failed.
     */
    public function testUpdateFailure()
    {
        $this->updateFailure();
    }
}
