<?php

namespace App\Tests\Unit\Pipes\Category\Index;

use App\Passables\Category\Index;
use App\Http\Requests\Category\Index as RequestIndex;
use App\Pipes\Category\Index\Search;
use App\Tests\TestCase;
use Illuminate\Database\Eloquent\Builder;
use Exception;

class SearchTest extends TestCase
{
    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Category
     * @group App.Pipes.Category.Index
     * @group App.Pipes.Category.Index.Search
     * @group App.Pipes.Category.Index.Search.Success
     */
    public function testSearchSuccess()
    {
        $passable = new Index();
        $passable->setRequest(
            new RequestIndex()
        );

        $searchStep = new Search();

        $searchStep->handle(
            $passable,
            function ($passable) {
                $results = $passable->getQuery();

                $this->assertEquals(Builder::class, get_class($results));
            }
        );
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Category
     * @group App.Pipes.Category.Index
     * @group App.Pipes.Category.Index.Search
     * @group App.Pipes.Category.Index.Search.Failure
     * @expectedExceptionCode 500
     * @expectedException Exception
     * @expectedExceptionMessage Category search failed.
     */
    public function testSearchFailure()
    {
        $passable = new Index();

        $searchStep = new Search();

        $searchStep->handle(
            $passable,
            function ($passable) {
                $results = $passable->getQuery();

                $this->assertEquals(Builder::class, get_class($results));
            }
        );
    }
}
