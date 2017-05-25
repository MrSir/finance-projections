<?php

namespace App\Tests\Unit\Pipes\Transaction\Frequency\Store;

use App\Http\Requests\Transaction\Frequency\Store as RequestStore;
use App\Models\Transaction\Frequency;
use App\Passables\Transaction\Frequency\Store;
use App\Pipes\Transaction\Frequency\Store\Create;
use App\Tests\Unit\Pipes\Store\Create as StoreCreate;
use Exception;

/**
 * Class SearchTest
 * @package App\Tests\Unit\Pipes\Transaction\Frequency\Store
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
     * @group App.Pipes.Transaction.Frequency
     * @group App.Pipes.Transaction.Frequency.Store
     * @group App.Pipes.Transaction.Frequency.Store.Create
     * @group App.Pipes.Transaction.Frequency.Store.Create.Success
     */
    public function testCreateSuccess()
    {
        $params = [
            'name' => 'Testing',
            'description' => 'A category built for testing',
        ];
        $this->setParams($params);

        $responseModel = $this->createSuccess();
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
     * @group                    App.Pipes.Transaction.Frequency.Store
     * @group                    App.Pipes.Transaction.Frequency.Store.Create
     * @group                    App.Pipes.Transaction.Frequency.Store.Create.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Frequency create failed.
     */
    public function testCreateFailure()
    {
        $this->createFailure();
    }
}
