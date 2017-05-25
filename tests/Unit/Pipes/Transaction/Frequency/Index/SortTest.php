<?php

namespace App\Tests\Unit\Pipes\Transaction\Frequency\Index;

use App\Http\Requests\Transaction\Frequency\Index as RequestIndex;
use App\Models\Transaction\Frequency;
use App\Passables\Transaction\Frequency\Index;
use App\Pipes\Transaction\Frequency\Index\Sort;
use App\Tests\Unit\Pipes\Index\Sort as IndexSort;
use Exception;

/**
 * Class SortTest
 * @package App\Tests\Unit\Pipes\Transaction\Frequency\Index
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
        $this->setModel(Frequency::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Frequency
     * @group App.Pipes.Transaction.Frequency.Index
     * @group App.Pipes.Transaction.Frequency.Index.Sort
     * @group App.Pipes.Transaction.Frequency.Index.Sort.Success
     */
    public function testSortSuccess()
    {
        $this->sortSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Frequency
     * @group App.Pipes.Transaction.Frequency.Index
     * @group App.Pipes.Transaction.Frequency.Index.Sort
     * @group App.Pipes.Transaction.Frequency.Index.Sort.Success
     * @group App.Pipes.Transaction.Frequency.Index.Sort.Success.Column
     */
    public function testSortColumnSuccess()
    {
        $this->sortColumnSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Frequency
     * @group App.Pipes.Transaction.Frequency.Index
     * @group App.Pipes.Transaction.Frequency.Index.Sort
     * @group App.Pipes.Transaction.Frequency.Index.Sort.Success
     * @group App.Pipes.Transaction.Frequency.Index.Sort.Success.Direction
     */
    public function testSortDirectionSuccess()
    {
        $this->sortDirectionSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Frequency
     * @group App.Pipes.Transaction.Frequency.Index
     * @group App.Pipes.Transaction.Frequency.Index.Sort
     * @group App.Pipes.Transaction.Frequency.Index.Sort.Failure
     * @expectedExceptionCode 500
     * @expectedException Exception
     * @expectedExceptionMessage Frequency sort failed.
     */
    public function testSortFailure()
    {
        $this->sortFailure();
    }
}
