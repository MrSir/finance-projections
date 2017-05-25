<?php

namespace App\Tests\Unit\Pipes\Account\Index;

use App\Http\Requests\Account\Index as RequestIndex;
use App\Models\Account;
use App\Passables\Account\Index;
use App\Pipes\Account\Index\Sort;
use App\Tests\Unit\Pipes\Index\Sort as IndexSort;
use Exception;

/**
 * Class SortTest
 * @package App\Tests\Unit\Pipes\Account\Index
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
        $this->setModel(Account::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Account
     * @group App.Pipes.Account.Index
     * @group App.Pipes.Account.Index.Sort
     * @group App.Pipes.Account.Index.Sort.Success
     */
    public function testSortSuccess()
    {
        $this->sortSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Account
     * @group App.Pipes.Account.Index
     * @group App.Pipes.Account.Index.Sort
     * @group App.Pipes.Account.Index.Sort.Success
     * @group App.Pipes.Account.Index.Sort.Success.Column
     */
    public function testSortColumnSuccess()
    {
        $this->sortColumnSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Account
     * @group App.Pipes.Account.Index
     * @group App.Pipes.Account.Index.Sort
     * @group App.Pipes.Account.Index.Sort.Success
     * @group App.Pipes.Account.Index.Sort.Success.Direction
     */
    public function testSortDirectionSuccess()
    {
        $this->sortDirectionSuccess();
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Account
     * @group                    App.Pipes.Account.Index
     * @group                    App.Pipes.Account.Index.Sort
     * @group                    App.Pipes.Account.Index.Sort.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Account sort failed.
     */
    public function testSortFailure()
    {
        $this->sortFailure();
    }
}
