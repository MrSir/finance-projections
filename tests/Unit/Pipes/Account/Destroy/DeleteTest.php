<?php

namespace App\Tests\Unit\Pipes\Account\Destroy;

use App\Http\Requests\Account\Destroy as RequestDestroy;
use App\Models\Account;
use App\Passables\Account\Destroy as PassableDestroy;
use App\Pipes\Account\Destroy\Delete;
use App\Tests\Unit\Pipes\Destroy\Delete as PipeDelete;
use Exception;

/**
 * Class DeleteTest
 * @package App\Tests\Unit\Pipes\Account\Destroy
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
     * @group App.Pipes.Account
     * @group App.Pipes.Account.Destroy
     * @group App.Pipes.Account.Destroy.Delete
     * @group App.Pipes.Account.Destroy.Delete.Success
     */
    public function testUpdateSuccess()
    {
        $this->setModel(Account::find(2));

        $responseModel = $this->deleteSuccess();
        $dbModel = Account::find($responseModel->id);

        $this->assertNull($dbModel);
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Account
     * @group                    App.Pipes.Account.Destroy
     * @group                    App.Pipes.Account.Destroy.Delete
     * @group                    App.Pipes.Account.Destroy.Delete.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Account delete failed.
     */
    public function testUpdateFailure()
    {
        $this->deleteFailure();
    }
}
