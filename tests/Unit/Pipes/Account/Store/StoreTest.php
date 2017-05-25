<?php

namespace App\Tests\Unit\Pipes\Account\Store;

use App\Http\Requests\Account\Store as RequestStore;
use App\Models\Account;
use App\Passables\Account\Store;
use App\Pipes\Account\Store\Create;
use App\Tests\Unit\Pipes\Store\Create as StoreCreate;
use Exception;

/**
 * Class SearchTest
 * @package App\Tests\Unit\Pipes\Account\Store
 */
class StoreTest extends StoreCreate
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
     * @group App.Pipes.Account
     * @group App.Pipes.Account.Store
     * @group App.Pipes.Account.Store.Create
     * @group App.Pipes.Account.Store.Create.Success
     */
    public function testCreateSuccess()
    {
        $params = [
            'name' => 'Testing',
            'description' => 'An account built for testing',
        ];
        $this->setParams($params);

        $responseModel = $this->createSuccess();
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
     * @group                    App.Pipes.Account.Store
     * @group                    App.Pipes.Account.Store.Create
     * @group                    App.Pipes.Account.Store.Create.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Account create failed.
     */
    public function testCreateFailure()
    {
        $this->createFailure();
    }
}
