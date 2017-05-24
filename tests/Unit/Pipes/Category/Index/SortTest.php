<?php

namespace App\Tests\Unit\Pipes\Category\Index;

use App\Tests\Unit\Pipes\Index\Sort as IndexSort;
use App\Http\Requests\Category\Index as RequestIndex;
use App\Models\Category;
use App\Passables\Category\Index;
use App\Pipes\Category\Index\Sort;
use Exception;

class SortTest extends IndexSort
{
    /**
     * SortTest constructor.
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
        $this->setPipe(Sort::class);
        $this->setModel(Category::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Category
     * @group App.Pipes.Category.Index
     * @group App.Pipes.Category.Index.Sort
     * @group App.Pipes.Category.Index.Sort.Success
     */
    public function testSortSuccess()
    {
        $this->sortSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Category
     * @group App.Pipes.Category.Index
     * @group App.Pipes.Category.Index.Sort
     * @group App.Pipes.Category.Index.Sort.Success
     * @group App.Pipes.Category.Index.Sort.Success.Column
     */
    public function testSortColumnSuccess()
    {
        $this->sortColumnSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Category
     * @group App.Pipes.Category.Index
     * @group App.Pipes.Category.Index.Sort
     * @group App.Pipes.Category.Index.Sort.Success
     * @group App.Pipes.Category.Index.Sort.Success.Direction
     */
    public function testSortDirectionSuccess()
    {
        $this->sortDirectionSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Category
     * @group App.Pipes.Category.Index
     * @group App.Pipes.Category.Index.Sort
     * @group App.Pipes.Category.Index.Sort.Failure
     * @expectedExceptionCode 500
     * @expectedException Exception
     * @expectedExceptionMessage Category sort failed.
     */
    public function testSortFailure()
    {
        $this->sortFailure();
    }
}
