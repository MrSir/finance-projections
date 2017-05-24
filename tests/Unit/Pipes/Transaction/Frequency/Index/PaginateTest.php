<?php

namespace App\Tests\Unit\Pipes\Transaction\Frequency\Index;

use App\Http\Requests\Transaction\Frequency\Index as RequestIndex;
use App\Models\Transaction\Frequency;
use App\Passables\Transaction\Frequency\Index;
use App\Pipes\Transaction\Frequency\Index\Paginate;
use App\Tests\TestCase;
use Exception;

class PaginateTest extends TestCase
{
    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Frequency
     * @group App.Pipes.Transaction.Frequency.Index
     * @group App.Pipes.Transaction.Frequency.Index.Paginate
     * @group App.Pipes.Transaction.Frequency.Index.Paginate.Success
     */
    public function testPaginateSuccess()
    {
        $passable = new Index();
        $passable->setRequest(
            new RequestIndex()
        );
        $passable->setQuery(Frequency::query());

        $paginateStep = new Paginate();

        $paginateStep->handle(
            $passable,
            function ($passable) {
                $results = $passable->getQuery();
                $limit = $results->getQuery()->limit;
                $offset = $results->getQuery()->offset;

                $this->assertEquals(
                    25,
                    $limit
                );
                $this->assertEquals(
                    0,
                    $offset
                );
            }
        );
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Frequency
     * @group App.Pipes.Transaction.Frequency.Index
     * @group App.Pipes.Transaction.Frequency.Index.Paginate
     * @group App.Pipes.Transaction.Frequency.Index.Paginate.Success
     * @group App.Pipes.Transaction.Frequency.Index.Paginate.Success.PerPage
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
        $passable->setQuery(Frequency::query());

        $paginateStep = new Paginate();

        $paginateStep->handle(
            $passable,
            function ($passable) {
                $results = $passable->getQuery();
                $limit = $results->getQuery()->limit;
                $offset = $results->getQuery()->offset;

                $this->assertEquals(
                    10,
                    $limit
                );
                $this->assertEquals(
                    0,
                    $offset
                );
            }
        );
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Frequency
     * @group App.Pipes.Transaction.Frequency.Index
     * @group App.Pipes.Transaction.Frequency.Index.Paginate
     * @group App.Pipes.Transaction.Frequency.Index.Paginate.Success
     * @group App.Pipes.Transaction.Frequency.Index.Paginate.Success.Page
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
        $passable->setQuery(Frequency::query());

        $paginateStep = new Paginate();

        $paginateStep->handle(
            $passable,
            function ($passable) {
                $results = $passable->getQuery();
                $limit = $results->getQuery()->limit;
                $offset = $results->getQuery()->offset;

                $this->assertEquals(
                    25,
                    $limit
                );
                $this->assertEquals(
                    25,
                    $offset
                );
            }
        );
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Transaction
     * @group                    App.Pipes.Transaction.Frequency
     * @group                    App.Pipes.Transaction.Frequency.Index
     * @group                    App.Pipes.Transaction.Frequency.Index.Paginate
     * @group                    App.Pipes.Transaction.Frequency.Index.Paginate.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Frequency paginate failed.
     */
    public function testPaginateFailure()
    {
        $passable = new Index();

        $paginateStep = new Paginate();

        $paginateStep->handle(
            $passable,
            function ($passable) {
            }
        );
    }
}
