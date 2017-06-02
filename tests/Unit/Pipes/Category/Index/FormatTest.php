<?php

namespace App\Tests\Unit\Pipes\Category\Index;

use App\Models\Category;
use App\Passables\Category\Index;
use App\Pipes\Category\Index\Format as PipeFormat;
use App\Tests\Unit\Pipes\Index\Format;
use Exception;

/**
 * Class FormatTest
 * @package App\Tests\Unit\Pipes\Category\Index
 */
class FormatTest extends Format
{
    /**
     * UpdateTest constructor.
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
        $this->setPipe(PipeFormat::class);
        $this->setModel(Category::class);
    }

    /**
     * @group App
     * @group App.Pipes
     * @group App.Pipes.Category
     * @group App.Pipes.Category.Index
     * @group App.Pipes.Category.Index.Format
     * @group App.Pipes.Category.Index.Format.Success
     */
    public function testFormatSuccess()
    {
        $this->formatSuccess();
    }

    /**
     * @group                    App
     * @group                    App.Pipes
     * @group                    App.Pipes.Category
     * @group                    App.Pipes.Category.Index
     * @group                    App.Pipes.Category.Index.Format
     * @group                    App.Pipes.Category.Index.Format.Failure
     * @expectedExceptionCode    500
     * @expectedException Exception
     * @expectedExceptionMessage Category format failed.
     */
    public function testFormatFailure()
    {
        $this->formatFailure();
    }
}
