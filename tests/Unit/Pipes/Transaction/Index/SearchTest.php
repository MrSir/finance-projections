<?php

namespace App\Tests\Unit\Pipes\Transaction\Index;

use App\Http\Requests\Transaction\Index as RequestIndex;
use App\Passables\Transaction\Index;
use App\Pipes\Transaction\Index\Search;
use App\Tests\Unit\Pipes\Index\Search as IndexSearch;
use Exception;

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
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Index
     * @group App.Pipes.Transaction.Index.Search
     * @group App.Pipes.Transaction.Index.Search.Success
     */
    public function testSearchSuccess()
    {
        $this->searchSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Index
     * @group App.Pipes.Transaction.Index.Search
     * @group App.Pipes.Transaction.Index.Search.Success
     * @group App.Pipes.Transaction.Index.Search.Success.Name
     */
    public function testSearchByNameSuccess()
    {
        $this->searchByNameSuccess();
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Transaction
     * @group App.Pipes.Transaction.Index
     * @group App.Pipes.Transaction.Index.Search
     * @group App.Pipes.Transaction.Index.Search.Success
     * @group App.Pipes.Transaction.Index.Search.Success.Description
     */
    public function testSearchByDescriptionSuccess()
    {
        $this->searchByDescriptionSuccess();
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Transaction
     * @group                    App.Pipes.Transaction.Index
     * @group                    App.Pipes.Transaction.Index.Search
     * @group                    App.Pipes.Transaction.Index.Search.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Transaction search failed.
     */
    public function testSearchFailure()
    {
        $this->searchFailure();
    }
}
