<?php

namespace App\Tests\Unit\Pipes\Category\Index;

use App\Http\Requests\Category\Index as RequestIndex;
use App\Models\Category;
use App\Passables\Category\Index;
use App\Pipes\Category\Index\Sort;
use App\Tests\TestCase;
use Exception;

class SortTest extends TestCase
{
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
        $passable = new Index();
        $passable->setRequest(
            new RequestIndex()
        );
        $passable->setQuery(Category::query());

        $paginateStep = new Sort();

        $paginateStep->handle(
            $passable,
            function ($passable) {
                $results = $passable->getQuery();
                $orders = $results->getQuery()->orders;

                $this->assertEquals(
                    'id',
                    $orders[0]['column']
                );
                $this->assertEquals(
                    'asc',
                    $orders[0]['direction']
                );
            }
        );
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
        $passable = new Index();
        $passable->setRequest(
            new RequestIndex(
                [
                    'order_column' => 'name',
                ]
            )
        );
        $passable->setQuery(Category::query());

        $paginateStep = new Sort();

        $paginateStep->handle(
            $passable,
            function ($passable) {
                $results = $passable->getQuery();
                $orders = $results->getQuery()->orders;

                $this->assertEquals(
                    'name',
                    $orders[0]['column']
                );
                $this->assertEquals(
                    'asc',
                    $orders[0]['direction']
                );
            }
        );
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
        $passable = new Index();
        $passable->setRequest(
            new RequestIndex(
                [
                    'order_direction' => 'desc',
                ]
            )
        );
        $passable->setQuery(Category::query());

        $paginateStep = new Sort();

        $paginateStep->handle(
            $passable,
            function ($passable) {
                $results = $passable->getQuery();
                $orders = $results->getQuery()->orders;

                $this->assertEquals(
                    'id',
                    $orders[0]['column']
                );
                $this->assertEquals(
                    'desc',
                    $orders[0]['direction']
                );
            }
        );
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
        $passable = new Index();

        $paginateStep = new Sort();

        $paginateStep->handle(
            $passable,
            function ($passable) {
            }
        );
    }
}
