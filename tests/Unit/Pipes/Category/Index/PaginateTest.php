<?php

namespace App\Tests\Unit\Pipes\Category\Index;

use App\Http\Requests\Category\Index as RequestIndex;
use App\Models\Category;
use App\Passables\Category\Index;
use App\Pipes\Category\Index\Paginate;
use App\Tests\Unit\Pipes\Index\Paginate as IndexPaginate;
use Exception;

/**
 * Class PaginateTest
 * @package App\Tests\Unit\Pipes\Category\Index
 */
class PaginateTest extends IndexPaginate
{
    /**
     * PaginateTest constructor.
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

        $this->setPassable(Index::class);
        $this->setRequest(RequestIndex::class);
        $this->setPipe(Paginate::class);
        $this->setModel(Category::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Category
     * @group App.Pipes.Category.Index
     * @group App.Pipes.Category.Index.Paginate
     * @group App.Pipes.Category.Index.Paginate.Success
     */
    public function testPaginateSuccess()
    {
        $this->paginateSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Category
     * @group App.Pipes.Category.Index
     * @group App.Pipes.Category.Index.Paginate
     * @group App.Pipes.Category.Index.Paginate.Success
     * @group App.Pipes.Category.Index.Paginate.Success.PerPage
     */
    public function testPaginatePerPageSuccess()
    {
        $this->paginatePerPageSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Category
     * @group App.Pipes.Category.Index
     * @group App.Pipes.Category.Index.Paginate
     * @group App.Pipes.Category.Index.Paginate.Success
     * @group App.Pipes.Category.Index.Paginate.Success.Page
     */
    public function testPaginatePageSuccess()
    {
        $this->paginatePageSuccess();
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Category
     * @group                    App.Pipes.Category.Index
     * @group                    App.Pipes.Category.Index.Paginate
     * @group                    App.Pipes.Category.Index.Paginate.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Category paginate failed.
     */
    public function testPaginateFailure()
    {
        $this->paginateFailure();
    }
}
