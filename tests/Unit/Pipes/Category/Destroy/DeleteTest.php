<?php

namespace App\Tests\Unit\Pipes\Category\Destroy;

use App\Http\Requests\Category\Destroy as RequestDestroy;
use App\Models\Category;
use App\Passables\Category\Destroy as PassableDestroy;
use App\Pipes\Category\Destroy\Delete;
use App\Tests\Unit\Pipes\Destroy\Delete as PipeDelete;
use Exception;

/**
 * Class DeleteTest
 * @package App\Tests\Unit\Pipes\Category\Destroy
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
     * @group App.Pipes.Category
     * @group App.Pipes.Category.Destroy
     * @group App.Pipes.Category.Destroy.Delete
     * @group App.Pipes.Category.Destroy.Delete.Success
     */
    public function testUpdateSuccess()
    {
        $this->setModel(Category::find(2));

        $responseModel = $this->deleteSuccess();
        $dbModel = Category::find($responseModel->id);

        $this->assertNull($dbModel);
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Category
     * @group                    App.Pipes.Category.Destroy
     * @group                    App.Pipes.Category.Destroy.Delete
     * @group                    App.Pipes.Category.Destroy.Delete.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Category delete failed.
     */
    public function testUpdateFailure()
    {
        $this->deleteFailure();
    }
}
