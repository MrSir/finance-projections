<?php

namespace App\Tests\Unit\Pipes\Transaction\Index;

use App\Http\Requests\Transaction\Index as RequestIndex;
use App\Models\Transaction;
use App\Passables\Transaction\Index;
use App\Pipes\Transaction\Index\Paginate;
use App\Tests\Unit\Pipes\Index\Paginate as IndexPaginate;
use Exception;

/**
 * Class PaginateTest
 * @package App\Tests\Unit\Pipes\Transaction\Index
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
        $this->setModel(Transaction::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Index
     * @group App.Pipes.Transaction.Index.Paginate
     * @group App.Pipes.Transaction.Index.Paginate.Success
     */
    public function testPaginateSuccess()
    {
        $this->paginateSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Index
     * @group App.Pipes.Transaction.Index.Paginate
     * @group App.Pipes.Transaction.Index.Paginate.Success
     * @group App.Pipes.Transaction.Index.Paginate.Success.PerPage
     */
    public function testPaginatePerPageSuccess()
    {
        $this->paginatePerPageSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Index
     * @group App.Pipes.Transaction.Index.Paginate
     * @group App.Pipes.Transaction.Index.Paginate.Success
     * @group App.Pipes.Transaction.Index.Paginate.Success.Page
     */
    public function testPaginatePageSuccess()
    {
        $this->paginatePageSuccess();
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Transaction
     * @group                    App.Pipes.Transaction.Index
     * @group                    App.Pipes.Transaction.Index.Paginate
     * @group                    App.Pipes.Transaction.Index.Paginate.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Transaction paginate failed.
     */
    public function testPaginateFailure()
    {
        $this->paginateFailure();
    }
}
