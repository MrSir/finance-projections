<?php

namespace App\Tests\Unit\Pipes\Category\Update;

use App\Http\Requests\Category\Update as RequestUpdate;
use App\Models\Category;
use App\Passables\Category\Update as PassableUpdate;
use App\Pipes\Category\Update\Update;
use App\Tests\Unit\Pipes\Update\Update as PipeUpdate;
use Exception;

/**
 * Class SearchTest
 * @package App\Tests\Unit\Pipes\Category\Update
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
     * @group App.Pipes.Category
     * @group App.Pipes.Category.Update
     * @group App.Pipes.Category.Update.Update
     * @group App.Pipes.Category.Update.Update.Success
     */
    public function testUpdateSuccess()
    {
        $params = [
            'name' => 'Testing',
            'description' => 'A category built for testing',
        ];
        $this->setParams($params);
        $this->setModel(Category::find(2));

        $responseModel = $this->updateSuccess();
        $dbModel = Category::find($responseModel->id);

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
     * @group                    App.Pipes.Category
     * @group                    App.Pipes.Category.Update
     * @group                    App.Pipes.Category.Update.Update
     * @group                    App.Pipes.Category.Update.Update.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Category update failed.
     */
    public function testUpdateFailure()
    {
        $this->updateFailure();
    }
}
