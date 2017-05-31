<?php

namespace App\Tests\Unit\Pipes\Transaction\Index;

use App\Http\Requests\Transaction\Index as RequestIndex;
use App\Models\Transaction;
use App\Passables\Transaction\Index;
use App\Pipes\Transaction\Index\Sort;
use App\Tests\Unit\Pipes\Index\Sort as IndexSort;
use Exception;

/**
 * Class SortTest
 * @package App\Tests\Unit\Pipes\Transaction\Index
 */
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
        $this->setModel(Transaction::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Index
     * @group App.Pipes.Transaction.Index.Sort
     * @group App.Pipes.Transaction.Index.Sort.Success
     */
    public function testSortSuccess()
    {
        $this->sortSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Index
     * @group App.Pipes.Transaction.Index.Sort
     * @group App.Pipes.Transaction.Index.Sort.Success
     * @group App.Pipes.Transaction.Index.Sort.Success.Column
     */
    public function testSortColumnSuccess()
    {
        $this->sortColumnSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Index
     * @group App.Pipes.Transaction.Index.Sort
     * @group App.Pipes.Transaction.Index.Sort.Success
     * @group App.Pipes.Transaction.Index.Sort.Success.Direction
     */
    public function testSortDirectionSuccess()
    {
        $this->sortDirectionSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Index
     * @group App.Pipes.Transaction.Index.Sort
     * @group App.Pipes.Transaction.Index.Sort.Failure
     * @expectedExceptionCode 500
     * @expectedException Exception
     * @expectedExceptionMessage Transaction sort failed.
     */
    public function testSortFailure()
    {
        $this->sortFailure();
    }
}
