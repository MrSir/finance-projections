<?php

namespace App\Tests\Unit\Pipes\Category\Index;

use App\Models\Category;
use App\Passables\Category\Index;
use App\Http\Requests\Category\Index as RequestIndex;
use App\Pipes\Category\Index\Paginate;
use App\Pipes\Category\Index\Search;
use App\Tests\TestCase;
use Illuminate\Database\Eloquent\Builder;
use Exception;

class PaginateTest extends TestCase
{
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
        $passable = new Index();
        $passable->setRequest(
            new RequestIndex()
        );
        $passable->setQuery(Category::query());

        $paginateStep = new Paginate();

        $paginateStep->handle(
            $passable,
            function ($passable) {
                $results = $passable->getQuery();
                $limit = $results->getQuery()->limit;
                $offset = $results->getQuery()->offset;

                $this->assertEquals(25, $limit);
                $this->assertEquals(0, $offset);
            }
        );
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
        $passable = new Index();
        $passable->setRequest(
            new RequestIndex(
                [
                    'per_page' => 10,
                ]
            )
        );
        $passable->setQuery(Category::query());

        $paginateStep = new Paginate();

        $paginateStep->handle(
            $passable,
            function ($passable) {
                $results = $passable->getQuery();
                $limit = $results->getQuery()->limit;
                $offset = $results->getQuery()->offset;

                $this->assertEquals(10, $limit);
                $this->assertEquals(0, $offset);
            }
        );
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
        $passable = new Index();
        $passable->setRequest(
            new RequestIndex(
                [
                    'page' => 2,
                ]
            )
        );
        $passable->setQuery(Category::query());

        $paginateStep = new Paginate();

        $paginateStep->handle(
            $passable,
            function ($passable) {
                $results = $passable->getQuery();
                $limit = $results->getQuery()->limit;
                $offset = $results->getQuery()->offset;

                $this->assertEquals(25, $limit);
                $this->assertEquals(25, $offset);
            }
        );
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Category
     * @group App.Pipes.Category.Index
     * @group App.Pipes.Category.Index.Paginate
     * @group App.Pipes.Category.Index.Paginate.Failure
     * @expectedExceptionCode 500
     * @expectedException Exception
     * @expectedExceptionMessage Category paginate failed.
     */
    public function testPaginateFailure()
    {
        $passable = new Index();

        $paginateStep = new Paginate();

        $paginateStep->handle(
            $passable,
            function ($passable) {}
        );
    }
}
