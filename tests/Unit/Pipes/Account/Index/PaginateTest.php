<?php

namespace App\Tests\Unit\Pipes\Account\Index;

use App\Http\Requests\Account\Index as RequestIndex;
use App\Models\Account;
use App\Passables\Account\Index;
use App\Pipes\Account\Index\Paginate;
use App\Tests\Unit\Pipes\Index\Paginate as IndexPaginate;
use Exception;

/**
 * Class PaginateTest
 * @package App\Tests\Unit\Pipes\Account\Index
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
        $this->setModel(Account::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Account
     * @group App.Pipes.Account.Index
     * @group App.Pipes.Account.Index.Paginate
     * @group App.Pipes.Account.Index.Paginate.Success
     */
    public function testPaginateSuccess()
    {
        $this->paginateSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Account
     * @group App.Pipes.Account.Index
     * @group App.Pipes.Account.Index.Paginate
     * @group App.Pipes.Account.Index.Paginate.Success
     * @group App.Pipes.Account.Index.Paginate.Success.PerPage
     */
    public function testPaginatePerPageSuccess()
    {
        $this->paginatePerPageSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Account
     * @group App.Pipes.Account.Index
     * @group App.Pipes.Account.Index.Paginate
     * @group App.Pipes.Account.Index.Paginate.Success
     * @group App.Pipes.Account.Index.Paginate.Success.Page
     */
    public function testPaginatePageSuccess()
    {
        $this->paginatePageSuccess();
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Account
     * @group                    App.Pipes.Account.Index
     * @group                    App.Pipes.Account.Index.Paginate
     * @group                    App.Pipes.Account.Index.Paginate.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Account paginate failed.
     */
    public function testPaginateFailure()
    {
        $this->paginateFailure();
    }
}
