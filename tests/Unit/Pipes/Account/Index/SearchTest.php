<?php

namespace App\Tests\Unit\Pipes\Account\Index;

use App\Tests\Unit\Pipes\Index\Search as IndexSearch;
use App\Passables\Account\Index;
use App\Http\Requests\Account\Index as RequestIndex;
use App\Pipes\Account\Index\Search;
use Exception;

/**
 * Class SearchTest
 * @package App\Tests\Unit\Pipes\Account\Index
 */
class SearchTest extends IndexSearch
{
    /**
     * SearchTest constructor.
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
        $this->setPipe(Search::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Account
     * @group App.Pipes.Account.Index
     * @group App.Pipes.Account.Index.Search
     * @group App.Pipes.Account.Index.Search.Success
     */
    public function testSearchSuccess()
    {
        $this->searchSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Account
     * @group App.Pipes.Account.Index
     * @group App.Pipes.Account.Index.Search
     * @group App.Pipes.Account.Index.Search.Success
     * @group App.Pipes.Account.Index.Search.Success.Name
     */
    public function testSearchByNameSuccess()
    {
        $this->searchByNameSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Account
     * @group App.Pipes.Account.Index
     * @group App.Pipes.Account.Index.Search
     * @group App.Pipes.Account.Index.Search.Success
     * @group App.Pipes.Account.Index.Search.Success.Description
     */
    public function testSearchByDescriptionSuccess()
    {
        $this->searchByDescriptionSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Account
     * @group App.Pipes.Account.Index
     * @group App.Pipes.Account.Index.Search
     * @group App.Pipes.Account.Index.Search.Failure
     * @expectedExceptionCode 500
     * @expectedException Exception
     * @expectedExceptionMessage Account search failed.
     */
    public function testSearchFailure()
    {
        $this->searchFailure();
    }
}
